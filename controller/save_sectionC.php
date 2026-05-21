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
$immun_a1 = $data['a1'] ?? [];
$immun_a2  = $data['a2']  ?? [];
$immun_a3  = $data['a3']  ?? [];
$immun_a4  = $data['a4']  ?? [];
$nutrition  = $data['nutrition']  ?? [];
$sick  = $data['sick']  ?? [];

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
        if (!empty($immun_a1)) {
            execStmt($db, 'DELETE FROM c_a1 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($immun_a2)) {
            execStmt($db, 'DELETE FROM c_a2 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($immun_a3)) {
            execStmt($db, 'DELETE FROM c_a3 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($immun_a4)) {
            execStmt($db, 'DELETE FROM c_a4 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($nutrition)) {
            execStmt($db, 'DELETE FROM c_nutrition WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($sick)) {
            execStmt($db, 'DELETE FROM c_sick WHERE record_id = ?', 'i', [$recordId]);
        }
    }

    // ── a1 ─────────────────────────────────────────────────────────────
    if (!empty($immun_a1)) {
        $sqlM = '
            INSERT INTO c_a1
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($immun_a1 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            // types: i=record_id, s=indicator, d=age_10_14, d=age_15_19, d=age_20_49, d=total, s=remarks
            execStmt($db, $sqlM, 'isddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
// ── a2 ─────────────────────────────────────────────────────────────
    if (!empty($immun_a2)) {
        $sqlM = '
            INSERT INTO c_a2
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($immun_a2 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'isddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
    // ── a3 ─────────────────────────────────────────────────────────────
    if (!empty($immun_a3)) {
        $sqlM = '
            INSERT INTO c_a3
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($immun_a3 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'isddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
    // ── a4 ─────────────────────────────────────────────────────────────
    if (!empty($immun_a4)) {
        $sqlM = '
            INSERT INTO c_a4
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($immun_a4 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'isddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
// ── nutritin ─────────────────────────────────────────────────────────────
    if (!empty($nutrition)) {
        $sqlM = '
            INSERT INTO c_nutrition
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($nutrition as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'isddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
// ── sick ─────────────────────────────────────────────────────────────
    if (!empty($sick)) {
        $sqlM = '
            INSERT INTO c_sick
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($sick as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'isddds', [$rid, $ind, $male, $female, $total, $remarks]);
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