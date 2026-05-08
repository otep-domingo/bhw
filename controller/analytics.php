<?php
    require '../model/connection.php';

    if (isset($_POST['submitReportInformation'])) {
        $fhsis_month = $_POST['fhsis-month'];
        $fhsis_year = $_POST['fhsis-year'];
        $barangay_name = $_POST['barangay-name'];
        $bhs_name = $_POST['bhs-name'];
        $municipality = $_POST['municipality'];
        $province = $_POST['province'];
        $population = $_POST['population'];

        $prepared_by = $_POST['prepared-by'];
        $verified_by = $_POST['verified-by'];
        $position = $_POST['position'];
        $prepared_date = date('Y-m-d');
        
        $demand00 = $_POST['demand'][0][0];
        $demand01 = $_POST['demand'][0][1];
        $demand02 = $_POST['demand'][0][2];
        $demand0total = $_POST['demand'][0][3];
        $demand0remarks = $_POST['demand'][0][4];
        
        $month_year_id = $fhsis_month . '-' . $fhsis_year;

        // Process the submitted data
        $query_report_info = "INSERT INTO m1brgy_report_info (month_year_id, report_for_month, report_year, 
            brgy_name, bhs_name, city_name, province_name, projected_population_year, prepared_by, verified_by, position, prepared_date) 
            VALUES ('$month_year_id', '$fhsis_month', '$fhsis_year', '$barangay_name', '$bhs_name', 
            '$municipality', '$province', '$population', '$prepared_by', '$verified_by', '$position', '$prepared_date')";
        
        $query_demand = "INSERT INTO m1brgy_section_a (month_year_id, TDS_age_group_1, TDS_age_group_2, TDS_age_group_3, TDS_total, TDS_remarks) 
            VALUES ('$month_year_id', '$demand00', '$demand01', '$demand02', '$demand0total', '$demand0remarks')";

        if (mysqli_query($connection, $query_report_info) && 
        mysqli_query($connection, $query_demand)) {
            // header("Location: ../pages/analytics.html?success=1");
            header("Location: ../pages/analytics.php");
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }
?>