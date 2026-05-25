<?php
session_start();

declare(strict_types=1);

require '../model/connection.php';

header('Content-Type: application/json; charset=utf-8');

$monthYearId = $_SESSION['month_year_id'] ?? null;
if (!$monthYearId) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Session report ID missing.']);
    exit;
}

$monthYearId = mysqli_real_escape_string($connection, (string)$monthYearId);

$reportQuery = "SELECT id FROM m1brgy_report_info WHERE month_year_id = '$monthYearId' LIMIT 1";
$reportResult = mysqli_query($connection, $reportQuery);
if (!$reportResult || mysqli_num_rows($reportResult) === 0) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Report record not found.']);
    exit;
}

$reportRow = mysqli_fetch_assoc($reportResult);
$recordId = (int)($reportRow['id'] ?? 0);
if ($recordId <= 0) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Invalid record ID.']);
    exit;
}

$demand = [];
$modern = [];

$demandSql = "SELECT indicator, age_10_14, age_15_19, age_20_49, total, remarks FROM a_demand WHERE record_id = $recordId ORDER BY id ASC";
$demandResult = mysqli_query($connection, $demandSql);
if ($demandResult) {
    while ($row = mysqli_fetch_assoc($demandResult)) {
        $demand[] = [
            'indicator' => $row['indicator'],
            'age_10_14' => $row['age_10_14'],
            'age_15_19' => $row['age_15_19'],
            'age_20_49' => $row['age_20_49'],
            'total' => $row['total'],
            'remarks' => $row['remarks'],
        ];
    }
}

$modernSql = "SELECT indicator,
        current_begin_10_14, current_begin_15_19, current_begin_20_49, current_begin_total,
        new_prev_10_14, new_prev_15_19, new_prev_20_49, new_prev_total,
        other_acceptors_10_14, other_acceptors_15_19, other_acceptors_20_49, other_acceptors_total,
        drop_10_14, drop_15_19, drop_20_49, drop_total,
        current_end_10_14, current_end_15_19, current_end_20_49, current_end_total,
        new_present_10_14, new_present_15_19, new_present_20_49, new_present_total
    FROM a_modern
    WHERE record_id = $recordId
    ORDER BY id ASC";
$modernResult = mysqli_query($connection, $modernSql);
if ($modernResult) {
    while ($row = mysqli_fetch_assoc($modernResult)) {
        $modern[] = [
            'indicator' => $row['indicator'],
            'current_begin_10_14' => $row['current_begin_10_14'],
            'current_begin_15_19' => $row['current_begin_15_19'],
            'current_begin_20_49' => $row['current_begin_20_49'],
            'current_begin_total' => $row['current_begin_total'],
            'new_prev_10_14' => $row['new_prev_10_14'],
            'new_prev_15_19' => $row['new_prev_15_19'],
            'new_prev_20_49' => $row['new_prev_20_49'],
            'new_prev_total' => $row['new_prev_total'],
            'other_acceptors_10_14' => $row['other_acceptors_10_14'],
            'other_acceptors_15_19' => $row['other_acceptors_15_19'],
            'other_acceptors_20_49' => $row['other_acceptors_20_49'],
            'other_acceptors_total' => $row['other_acceptors_total'],
            'drop_10_14' => $row['drop_10_14'],
            'drop_15_19' => $row['drop_15_19'],
            'drop_20_49' => $row['drop_20_49'],
            'drop_total' => $row['drop_total'],
            'current_end_10_14' => $row['current_end_10_14'],
            'current_end_15_19' => $row['current_end_15_19'],
            'current_end_20_49' => $row['current_end_20_49'],
            'current_end_total' => $row['current_end_total'],
            'new_present_10_14' => $row['new_present_10_14'],
            'new_present_15_19' => $row['new_present_15_19'],
            'new_present_20_49' => $row['new_present_20_49'],
            'new_present_total' => $row['new_present_total'],
        ];
    }
}

echo json_encode([
    'success' => true,
    'record_id' => $recordId,
    'demand' => $demand,
    'modern' => $modern,
]);

mysqli_close($connection);
