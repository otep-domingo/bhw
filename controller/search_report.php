<?php
    session_start();

    include('../model/connection.php');

    header('Content-Type: application/json');

    $errors = array();

    $data = json_decode(file_get_contents("php://input"), true);

    $report_year = $data['year'];
    $report_month = $data['month'];

    $month_year_id = $report_month . "-" . $report_year;

    $checkData = "
        SELECT * 
        FROM m1brgy_report_info
        WHERE month_year_id = '$month_year_id'
    ";

    $result = mysqli_query($connection, $checkData);

    if (mysqli_num_rows($result) > 0) {

        $_SESSION['month_year_id'] = $month_year_id;

        echo json_encode([
            "success" => true
        ]);

    } else {
        $errors[] = "Selected date is empty!";
        $_SESSION['errors'] = $errors;

        echo json_encode([
            "success" => false
        ]);
    }
?>