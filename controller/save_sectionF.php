<?php

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

$recordId  = isset($data['record_id']) ? (int) $data['record_id'] : 1; //<-- change the "1" to NULL once there is a working record_id. record_id can also be set via session
$waterBody = $data['waterBody'] ?? [];
$sanitationBody  = $data['sanitationBody']  ?? [];

// Require at least one section
/*if (empty($mortality) && empty($natality)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No data provided.']);
    exit;
}*/

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
        if (!empty($waterBody)) {
            execStmt($db, 'DELETE FROM f_water WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($sanitationBody)) {
            execStmt($db, 'DELETE FROM f_sanitation WHERE record_id = ?', 'i', [$recordId]);
        }

    }

    // ── Filariasis ─────────────────────────────────────────────────────────────
    if (!empty($waterBody)) {
        $sqlM = '
            INSERT INTO f_water
                (record_id, indicator, count, remarks)
            VALUES (?, ?, ?, ?)
        ';

        foreach ($waterBody as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $count   = toFloat($row['col_1']     ?? null);
            $remarks = isset($row['col_2']) ? mb_substr(trim((string)$row['col_2']), 0, 1000) : null;

            // types: i=record_id, s=indicator, d=age_10_14, d=age_15_19, d=age_20_49, d=total, s=remarks
            execStmt($db, $sqlM, 'isds', [$rid, $ind, $count, $remarks]);
        }
    }
// ── Rabies ─────────────────────────────────────────────────────────────
    if (!empty($sanitationBody)) {
        $sqlM = '
            INSERT INTO f_sanitation
                (record_id, indicator,count, remarks)
            VALUES (?, ?, ?, ?)
        ';

        foreach ($sanitationBody as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $count   = toFloat($row['col_1']     ?? null);
            $remarks = isset($row['col_2']) ? mb_substr(trim((string)$row['col_2']), 0, 1000) : null;

            execStmt($db, $sqlM, 'isds', [$rid, $ind, $count, $remarks]);
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