<?php

declare(strict_types=1);

// ── 1. Database credentials ───────────────────────────────────────────────────
//require '../model/constants.php';
require 'checkRecordId.php';

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

$recordId = checkRecordId($data['record_id']);

if (!$recordId) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'record_id missing.',
    ]);
    exit;
}
$e1 = $data['e1'] ?? [];
$e2 = $data['e2'] ?? [];
$e3 = $data['e3'] ?? [];
$e4 = $data['e4'] ?? [];
$e5 = $data['e5'] ?? [];
$e6 = $data['e6'] ?? [];
$e7 = $data['e7'] ?? [];
$e8 = $data['e8'] ?? [];

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
        if (!empty($e1)) {
            execStmt($db, 'DELETE FROM e_e1 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($e2)) {
            execStmt($db, 'DELETE FROM e_e2 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($e3)) {
            execStmt($db, 'DELETE FROM e_e3 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($e4)) {
            execStmt($db, 'DELETE FROM e_e4 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($e5)) {
            execStmt($db, 'DELETE FROM e_e5 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($e6)) {
            execStmt($db, 'DELETE FROM e_e6 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($e7)) {
            execStmt($db, 'DELETE FROM e_e7 WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($e8)) {
            execStmt($db, 'DELETE FROM e_e8 WHERE record_id = ?', 'i', [$recordId]);
        }
    }
    
    // ── e1 ─────────────────────────────────────────────────────────────
    if (!empty($e1)) {
        $sqlM = '
            INSERT INTO e_e1
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($e1 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            // types: i=record_id, s=indicator, d=age_10_14, d=age_15_19, d=age_20_49, d=total, s=remarks
            execStmt($db, $sqlM, 'ssddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
// ── e2 ─────────────────────────────────────────────────────────────
    if (!empty($e2)) {
        $sqlM = '
            INSERT INTO e_e2
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($e2 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'ssddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
// ── e3 ─────────────────────────────────────────────────────────────
    if (!empty($e3)) {
        $sqlM = '
            INSERT INTO e_e3
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($e3 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'ssddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
// ── e4 ─────────────────────────────────────────────────────────────
    if (!empty($e4)) {
        $sqlM = '
            INSERT INTO e_e4
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($e4 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'ssddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
// ── e5 ─────────────────────────────────────────────────────────────
    if (!empty($e5)) {
        $sqlM = '
            INSERT INTO e_e5
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($e5 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'ssddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
// ── e6 ─────────────────────────────────────────────────────────────
    if (!empty($e6)) {
        $sqlM = '
            INSERT INTO e_e6
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($e6 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'ssddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
// ── e7 ─────────────────────────────────────────────────────────────
    if (!empty($e7)) {
        $sqlM = '
            INSERT INTO e_e7
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($e7 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'ssddds', [$rid, $ind, $male, $female, $total, $remarks]);
        }
    }
// ── e8 ─────────────────────────────────────────────────────────────
    if (!empty($e8)) {
        $sqlM = '
            INSERT INTO e_e8
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($e8 as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $male   = toFloat($row['col_1'] ?? null);
            $female   = toFloat($row['col_2'] ?? null);
            $total   = toFloat($row['col_3']     ?? null);
            $remarks = isset($row['col_4']) ? mb_substr(trim((string)$row['col_4']), 0, 1000) : null;

            execStmt($db, $sqlM, 'ssddds', [$rid, $ind, $male, $female, $total, $remarks]);
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