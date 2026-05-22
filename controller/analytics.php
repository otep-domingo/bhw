<?php
    session_start();
    require '../model/connection.php';

    if (isset($_POST['submitReportInformation'])) {
        $errors = array();

        $fhsis_month = trim($_POST['fhsis-month'] ?? '');
        $fhsis_year = trim($_POST['fhsis-year'] ?? '');
        $barangay_name = trim($_POST['barangay-name'] ?? '');
        $bhs_name = trim($_POST['bhs-name'] ?? '');
        $municipality = trim($_POST['municipality'] ?? '');
        $province = trim($_POST['province'] ?? '');
        $population = trim($_POST['population'] ?? '');

        $prepared_by = trim($_POST['prepared-by'] ?? '');
        $verified_by = trim($_POST['verified-by'] ?? '');
        $position = trim($_POST['position'] ?? '');
        $prepared_date = date('Y-m-d');

        // =================== INPUT VALIDATIONS ====================
        if (empty($fhsis_month)) { $errors[] = "FHSIS month is required."; }
        if (empty($fhsis_year)) { $errors[] = "FHSIS year is required.";
        } elseif (strlen($fhsis_year) != 4) { $errors[] = "FHSIS year must be 4 digits."; }

        if (empty($barangay_name)) { $errors[] = "Barangay name is required."; }
        if (empty($bhs_name)) { $errors[] = "BHS name is required."; }

        if (empty($municipality)) { $errors[] = "Municipality is required."; }
        if (empty($province)) { $errors[] = "Province is required."; }

        if (empty($population)) { $errors[] = "Population is required.";
        } elseif ($population < 0) { $errors[] = "Population cannot be negative."; }

        if (empty($prepared_by)) { $errors[] = "Prepared by field is required."; }
        if (empty($verified_by)) { $errors[] = "Verified by field is required."; }
        if (empty($position)) { $errors[] = "Position is required."; }

        // =================== DUPLICATE VALIDATIONS ====================
        $month_year_id = $fhsis_month . '-' . $fhsis_year;

        $check_duplicate = "SELECT * FROM m1brgy_report_info 
                            WHERE month_year_id = '$month_year_id'";

        $duplicate_result = mysqli_query($connection, $check_duplicate);

        if (mysqli_num_rows($duplicate_result) > 0) {
            $errors[] = "Report for selected month and year already exists.";
        }

        // =================== PROCEED IF NO ERROS FOUND ====================
        if (count($errors) == 0) {

            $query_report_info = "INSERT INTO m1brgy_report_info (
                month_year_id, report_for_month, report_year, 
                brgy_name, bhs_name, city_name, province_name, 
                projected_population_year, prepared_by, verified_by, 
                position, prepared_date) 
                VALUES ('$month_year_id', '$fhsis_month', '$fhsis_year', 
                '$barangay_name', '$bhs_name', '$municipality', '$province', 
                '$population', '$prepared_by', '$verified_by', '$position', 
                '$prepared_date')";

            if (mysqli_query($connection, $query_report_info)) {
                $_SESSION['month_year_id'] = $month_year_id;
                header("Location: ../pages/analytics.php?success=1");
                exit();
            } else {
                $errors[] = "Database Error: " . mysqli_error($connection);
            }
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: ../pages/analytics.php");
            exit();
        }
    }
?>