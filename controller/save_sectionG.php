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

$recordId = $data['record_id'] ?? null;

if (!$recordId) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'record_id missing.',
    ]);
    exit;
}
$filariasis = $data['filariasis'] ?? [];
$rabies  = $data['rabies']  ?? [];
$schistosomiasis  = $data['schistosomiasis']  ?? [];
$sth  = $data['sth']  ?? [];
$leprosy  = $data['leprosy']  ?? [];
$hiv  = $data['hiv']  ?? [];

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

    // ── Filariasis ─────────────────────────────────────────────────────────────
    if (!empty($filariasis)) {
        $sqlM = '
            INSERT INTO g_filariasis
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($filariasis as $row) {
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
// ── Rabies ─────────────────────────────────────────────────────────────
    if (!empty($rabies)) {
        $sqlM = '
            INSERT INTO g_rabies
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($rabies as $row) {
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
// ── Schistosomiasis ─────────────────────────────────────────────────────────────
    if (!empty($schistosomiasis)) {
        $sqlM = '
            INSERT INTO g_schistosomiasis
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($schistosomiasis as $row) {
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
// ── STH ─────────────────────────────────────────────────────────────
    if (!empty($sth)) {
        $sqlM = '
            INSERT INTO g_sth
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($sth as $row) {
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
// ── Leprosy ─────────────────────────────────────────────────────────────
    if (!empty($leprosy)) {
        $sqlM = '
            INSERT INTO g_leprosy
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($leprosy as $row) {
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
// ── HIV ─────────────────────────────────────────────────────────────
    if (!empty($hiv)) {
        $sqlM = '
            INSERT INTO g_hiv
                (record_id, indicator, male, female, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?)
        ';

        foreach ($hiv as $row) {
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