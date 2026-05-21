<?php
/**
 * save_vital_statistics.php
 *
 * Receives a JSON POST body with:
 *   {
 *     "record_id": 42,          // optional; omit or null for new records
 *     "mortality": [ { "indicator":"...", "age_10_14":0, ... }, ... ],
 *     "natality":  [ { "indicator":"...", "male":0, ... }, ... ]
 *   }
 *
 * Returns:
 *   { "success": true }
 *   { "success": false, "message": "..." }
 */

declare(strict_types=1);

// ── 1. Database credentials ───────────────────────────────────────────────────
require '../model/constants.php';

// ── 2. Headers ────────────────────────────────────────────────────────────────
header('Content-Type: application/json; charset=utf-8');

// Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// ── 3. Parse JSON body ────────────────────────────────────────────────────────
$raw  = file_get_contents('php://input');
$data = json_decode($raw, true);

if (json_last_error() !== JSON_ERROR_NONE || $data === null) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON payload.']);
    exit;
}

$recordId  = isset($data['record_id']) ? (int) $data['record_id'] : 2;
$prenatal = $data['prenatal'] ?? [];

// ── 4. Connect (mysqli) ───────────────────────────────────────────────────────
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // throw exceptions on error

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
$db->set_charset('utf8mb4');

if ($db->connect_errno) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $db->connect_error]);
    exit;
}

// ── 5. Helpers ────────────────────────────────────────────────────────────────
function toFloat(mixed $v): ?float
{
    if ($v === null || $v === '') return null;
    $f = filter_var($v, FILTER_VALIDATE_FLOAT);
    return ($f !== false) ? $f : null;
}

// Prepare, bind, execute, and close a statement in one call.
// $types: mysqli bind_param type string (i=int, d=double, s=string)
function execStmt(mysqli $db, string $sql, string $types, array $params): void
{
    $stmt = $db->prepare($sql);
    if (!$stmt) {
        throw new RuntimeException('Prepare failed: ' . $db->error);
    }
    $stmt->bind_param($types, ...$params);
    if (!$stmt->execute()) {
        throw new RuntimeException('Execute failed: ' . $stmt->error);
    }
    $stmt->close();
}

// ── 6. Save inside a transaction ──────────────────────────────────────────────
try {
    $db->begin_transaction();

    // If record_id supplied, delete existing rows first (replace strategy)
    if ($recordId !== null) {
        if (!empty($prenatal)) {
            execStmt($db, 'DELETE FROM b_prenatal WHERE record_id = ?', 'i', [$recordId]);
        }
    }

    // ── Mortality ─────────────────────────────────────────────────────────────
    if (!empty($prenatal)) {
        $sqlM = '
            INSERT INTO b_prenatal
                (record_id, indicator, age_10_14, age_15_19, age_20_49, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ';

        foreach ($prenatal as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $a1014   = toFloat($row['col_1'] ?? null);
            $a1519   = toFloat($row['col_2'] ?? null);
            $a2049   = toFloat($row['col_3'] ?? null);
            $total   = toFloat($row['col_4']     ?? null);
            $remarks = isset($row['col_5']) ? mb_substr(trim((string)$row['col_5']), 0, 1000) : null;

            // types: i=record_id, s=indicator, d=age_10_14, d=age_15_19, d=age_20_49, d=total, s=remarks
            execStmt($db, $sqlM, 'isdddds', [$rid, $ind, $a1014, $a1519, $a2049, $total, $remarks]);
        }
    }

    $db->commit();
    echo json_encode(['success' => true, 'message' => 'Records saved successfully.']);

} catch (RuntimeException | mysqli_sql_exception $e) {
    $db->rollback();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} finally {
    $db->close();
}