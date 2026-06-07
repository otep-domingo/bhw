<?php
// ── 1. Database credentials ───────────────────────────────────────────────────
require '../model/constants.php';
// ── 4. Connect (mysqli) ───────────────────────────────────────────────────────
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // throw exceptions on error
function checkRecordId($id)
{
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    $db->set_charset('utf8mb4');

    if ($db->connect_errno) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $db->connect_error]);
        exit;
    }

    $stmt = $db->prepare("SELECT id FROM bhw.m1brgy_report_info where month_year_id = ?");
    // "i" denotes that $id is an integer bind variable
    $stmt->bind_param("s", $id);
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();
    $r = $result->fetch_assoc();

    //close resources
    $stmt->close();
    $db->close();

    return $r['id'];

}
