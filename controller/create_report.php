<?php
    session_start();
    require '../model/connection.php';

    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);

    $errors = array();

    $fhsis_month = trim($data['fhsis_month'] ?? '');
    $fhsis_year = trim($data['fhsis_year'] ?? '');
    $barangay_name = trim($data['barangay_name'] ?? '');
    $bhs_name = trim($data['bhs_name'] ?? '');
    $municipality = trim($data['municipality'] ?? '');
    $province = trim($data['province'] ?? '');
    $population = trim($data['population'] ?? '');
    $prepared_by = trim($data['prepared_by'] ?? '');
    $verified_by = trim($data['verified_by'] ?? '');
    $position = trim($data['position'] ?? '');

    $prepared_date = date('Y-m-d');

    // VALIDATIONS
    if (!$fhsis_month) $errors[] = "FHSIS month is required.";
    if (!$fhsis_year || strlen($fhsis_year) != 4) $errors[] = "Valid year is required.";
    if (!$barangay_name) $errors[] = "Barangay is required.";
    if (!$bhs_name) $errors[] = "BHS is required.";
    if (!$municipality) $errors[] = "Municipality is required.";
    if (!$province) $errors[] = "Province is required.";
    if (!$population || $population < 0) $errors[] = "Valid population is required.";
    if (!$prepared_by) $errors[] = "Prepared by required.";
    if (!$verified_by) $errors[] = "Verified by required.";
    if (!$position) $errors[] = "Position required.";

    $month_year_id = $fhsis_month . '-' . $fhsis_year;

    // DUPLICATE CHECK
    $check = mysqli_query($connection,
        "SELECT id FROM m1brgy_report_info WHERE month_year_id='$month_year_id'"
    );

    if (mysqli_num_rows($check) > 0) {
        $errors[] = "Report already exists.";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        echo json_encode([
            "success" => false,
            "errors" => $errors
        ]);
        exit;
    }

    // INSERT
    $query = "INSERT INTO m1brgy_report_info (
        month_year_id, report_for_month, report_year,
        brgy_name, bhs_name, city_name, province_name,
        projected_population_year, prepared_by, verified_by,
        position, prepared_date
    ) VALUES (
        '$month_year_id', '$fhsis_month', '$fhsis_year',
        '$barangay_name', '$bhs_name', '$municipality', '$province',
        '$population', '$prepared_by', '$verified_by',
        '$position', '$prepared_date'
    )";

    if (mysqli_query($connection, $query)) {
        $_SESSION['month_year_id'] = $month_year_id;
        echo json_encode([
            "success" => true
        ]);

    } else {
        echo json_encode([
            "success" => false,
            "errors" => [mysqli_error($connection)]
        ]);
    }
?>