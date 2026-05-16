<?php
    require '../model/connection.php';

    $fetch_year = "SELECT DISTINCT report_year FROM m1brgy_report_info 
        ORDER BY report_year DESC";
    $result_year = $connection->query($fetch_year);

    $fetch_month = "SELECT DISTINCT report_for_month FROM m1brgy_report_info 
        ORDER BY FIELD(
        report_for_month,
        'January','February','March','April','May','June',
        'July','August','September','October','November','December'
        )";
    $result_month = $connection->query($fetch_month);
?>