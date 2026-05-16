<?php
    session_start();
    require '../model/connection.php';

    if (isset($_POST['createNew-btn'])) {
        $_SESSION['form_id'] = "";
        session_destroy();
        header("location: ../pages/analytics.php");
    }

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
        
        // $demand00 = $_POST['demand'][0][0];
        // $demand01 = $_POST['demand'][0][1];
        // $demand02 = $_POST['demand'][0][2];
        // $demand0total = $_POST['demand'][0][3];
        // $demand0remarks = $_POST['demand'][0][4];
        
        $month_year_id = $fhsis_month . '-' . $fhsis_year;
        
        // $fp_tables = [
        //     'fpcu' => $_POST['fpcu'] ?? [],
        //     'fpnapm' => $_POST['fpnapm'] ?? [],
        //     'fpoa' => $_POST['fpoa'] ?? [],
        //     'fpdo' => $_POST['fpdo'] ?? [],
        //     'fpcueo' => $_POST['fpcueo'] ?? [],
        //     'fpnapm2' => $_POST['fpnapm2'] ?? []
        // ];

        // $maxRows = 0;
        // foreach ($fp_tables as $rows) {
        //     $maxRows = max($maxRows, count($rows));
        // }

        // for ($rowIndex = 0; $rowIndex < $maxRows; $rowIndex++) {
        //     $varName = 'fp_tables' . ($rowIndex + 1);
        //     ${$varName} = [];
        //     foreach ($fp_tables as $tableName => $rows) {
        //         ${$varName}[$tableName] = $rows[$rowIndex] ?? [];
        //     }
        // }

        // $form_data = [];
        // for ($rowIndex = 0; $rowIndex < $maxRows; $rowIndex++) {
        //     $varName = 'fp_tables' . ($rowIndex + 1);
        //     $form_data[$varName] = ${$varName};
        // }
        // $form_data = json_encode($form_data, JSON_UNESCAPED_UNICODE);
        // $form_data_escaped = mysqli_real_escape_string($connection, $form_data);

        // $BTL = json_encode($fp_tables1, JSON_UNESCAPED_UNICODE);
        // $NSV = json_encode($fp_tables2, JSON_UNESCAPED_UNICODE);
        // $condom = json_encode($fp_tables3, JSON_UNESCAPED_UNICODE);
        // $pills = json_encode($fp_tables4, JSON_UNESCAPED_UNICODE);
        // $injectibles = json_encode($fp_tables5, JSON_UNESCAPED_UNICODE);
        // $implants = json_encode($fp_tables6, JSON_UNESCAPED_UNICODE);
        // $IUD = json_encode($fp_tables7, JSON_UNESCAPED_UNICODE);
        // $NFPLAM = json_encode($fp_tables8, JSON_UNESCAPED_UNICODE);
        // $NFPBBT = json_encode($fp_tables9, JSON_UNESCAPED_UNICODE);
        // $NFPCMM = json_encode($fp_tables10, JSON_UNESCAPED_UNICODE);
        // $NFPSTM = json_encode($fp_tables11, JSON_UNESCAPED_UNICODE);
        // $NFPSDM = json_encode($fp_tables12, JSON_UNESCAPED_UNICODE);
        // $TotalCurrentUsers = json_encode($fp_tables13, JSON_UNESCAPED_UNICODE);
    
        // Process the submitted data
        $query_report_info = "INSERT INTO m1brgy_report_info (month_year_id, report_for_month, report_year, 
            brgy_name, bhs_name, city_name, province_name, projected_population_year, prepared_by, verified_by, position, prepared_date) 
            VALUES ('$month_year_id', '$fhsis_month', '$fhsis_year', '$barangay_name', '$bhs_name', 
            '$municipality', '$province', '$population', '$prepared_by', '$verified_by', '$position', '$prepared_date')";
        
        // $query_demand = "INSERT INTO m1brgy_section_a (month_year_id, TDS_age_group_1, TDS_age_group_2, TDS_age_group_3, TDS_total, TDS_remarks,
        //     BTL, NSV, condom, pills, injectibles, implants, IUD, NFPLAM, NFPBBT, NFPCMM, NFPSTM, NFPSDM, TotalCurrentUsers) 
        //     VALUES ('$month_year_id', '$demand00', '$demand01', '$demand02', '$demand0total', '$demand0remarks',
        //     '$BTL', '$NSV', '$condom', '$pills', '$injectibles', '$implants', '$IUD', '$NFPLAM', '$NFPBBT', '$NFPCMM', '$NFPSTM', '$NFPSDM', '$TotalCurrentUsers')";

        if (mysqli_query($connection, $query_report_info)) {
            header("Location: ../pages/analytics.php?success=1");
            // header("Location: ../pages/analytics.php");
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }

    if (isset($_POST['search_data'])) {
        $report_year = $_POST['year'];
        $report_month = $_POST['month'];

        $_SESSION['form_id'] = $report_month."-".$report_year;
        
        echo $_SESSION['form_id'];
        header("location: ../pages/analytics.php");
    }
?>