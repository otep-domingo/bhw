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

//$recordId = isset($data['record_id']) ? (int) $data['record_id'] : 1;
$recordId = checkRecordId($data['record_id']);

if (!$recordId) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'record_id missing.',
    ]);
    exit;
}

$demand = $data['demand'] ?? [];
$modern_fp  = $data['modern']  ?? [];

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
    if ($recordId !== null) {
        if (!empty($demand)) {
            execStmt($db, 'DELETE FROM a_demand WHERE record_id = ?', 'i', [$recordId]);
        }
        if (!empty($modern_fp)) {
            execStmt($db, 'DELETE FROM a_modern WHERE record_id = ?', 'i', [$recordId]);
        }

    }
    
    // ── demand ─────────────────────────────────────────────────────────────
    if (!empty($demand)) {
        $sqlM = '
            INSERT INTO a_demand
                (record_id, indicator, age_10_14, age_15_19,age_20_49, total, remarks)
            VALUES (?, ?, ?, ?, ?, ?,?)
        ';

        foreach ($demand as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $age_10_14   = toFloat($row['col_1'] ?? null);
            $age_15_19   = toFloat($row['col_2'] ?? null);
            $age_20_49   = toFloat($row['col_3'] ?? null);
            $total   = toFloat($row['col_4']     ?? null);
            $remarks = isset($row['col_5']) ? mb_substr(trim((string)$row['col_5']), 0, 1000) : null;

            // types: i=record_id, s=indicator, d=age_10_14, d=age_15_19, d=age_20_49, d=total, s=remarks
            execStmt($db, $sqlM, 'ssdddds', [$rid, $ind, $age_10_14, $age_15_19, $age_20_49, $total, $remarks]);
        }
    }

    // ── modern family plannign ─────────────────────────────────────────────────────────────
    if (!empty($modern_fp)) {
        $sqlM = '
            INSERT INTO a_modern
                (record_id, indicator,
                    current_begin_10_14,
                    current_begin_15_19,
                    current_begin_20_49,
                    current_begin_total,
                    new_prev_10_14,
                    new_prev_15_19,
                    new_prev_20_49,
                    new_prev_total ,
                    other_acceptors_10_14,
                    other_acceptors_15_19,
                    other_acceptors_20_49,
                    other_acceptors_total,
                    drop_10_14,		
                    drop_15_19,   	
                    drop_20_49,   	
                    drop_total,     		
                    current_end_10_14,	
                    current_end_15_19,
                    current_end_20_49,
                    current_end_total,
                    new_present_10_14,
                    new_present_15_19,
                    new_present_20_49,
                    new_present_total)
            VALUES (?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ';

        foreach ($modern_fp as $row) {
            $indicator = trim((string)($row['indicator'] ?? ''));
            if ($indicator === '') continue; // skip blank rows

            $rid     = $recordId;
            $ind     = mb_substr($indicator, 0, 500);
            $current_begin_10_14    = toFloat($row['col_1'] ?? null);
            $current_begin_15_19    = toFloat($row['col_2'] ?? null);
            $current_begin_20_49    = toFloat($row['col_3'] ?? null);
            $current_begin_total    = toFloat($row['col_4'] ?? null);
            $new_prev_10_14         = toFloat($row['col_5'] ?? null);
            $new_prev_15_19         = toFloat($row['col_6'] ?? null);
            $new_prev_20_49         = toFloat($row['col_7'] ?? null);
            $new_prev_total         = toFloat($row['col_8'] ?? null); 
            $other_acceptors_10_14  = toFloat($row['col_9'] ?? null);
            $other_acceptors_15_19  = toFloat($row['col_10'] ?? null);
            $other_acceptors_20_49  = toFloat($row['col_11'] ?? null);
            $other_acceptors_total  = toFloat($row['col_12'] ?? null);
            $drop_10_14             = toFloat($row['col_13'] ?? null);	
            $drop_15_19             = toFloat($row['col_14'] ?? null);	
            $drop_20_49             = toFloat($row['col_15'] ?? null);  	
            $drop_total             = toFloat($row['col_16'] ?? null);    		
            $current_end_10_14      = toFloat($row['col_17'] ?? null);
            $current_end_15_19      = toFloat($row['col_18'] ?? null);
            $current_end_20_49      = toFloat($row['col_19'] ?? null);
            $current_end_total      = toFloat($row['col_20'] ?? null);
            $new_present_10_14      = toFloat($row['col_21'] ?? null);
            $new_present_15_19      = toFloat($row['col_22'] ?? null);
            $new_present_20_49      = toFloat($row['col_23'] ?? null);
            $new_present_total      = toFloat($row['col_24'] ?? null);  

            // types: i=record_id, s=indicator, d=age_10_14, d=age_15_19, d=age_20_49, d=total, s=remarks
            execStmt($db, $sqlM, 'ssdddddddddddddddddddddddd', [
                                            $rid,
                                            $ind,
                                            $current_begin_10_14,
                                            $current_begin_15_19,    
                                            $current_begin_20_49,    
                                            $current_begin_total,    
                                            $new_prev_10_14,         
                                            $new_prev_15_19,         
                                            $new_prev_20_49,         
                                            $new_prev_total,         
                                            $other_acceptors_10_14,  
                                            $other_acceptors_15_19,  
                                            $other_acceptors_20_49,  
                                            $other_acceptors_total,  
                                            $drop_10_14,             	
                                            $drop_15_19,             	
                                            $drop_20_49,              	
                                            $drop_total,                		
                                            $current_end_10_14,
                                            $current_end_15_19,     
                                            $current_end_20_49,     
                                            $current_end_total,     
                                            $new_present_10_14,     
                                            $new_present_15_19,     
                                            $new_present_20_49,     
                                            $new_present_total 
                                            ]);
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