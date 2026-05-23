<?php
session_start();
require '../model/connection.php';

$json = file_get_contents('php://input'); // Get raw POST data
$data = json_decode($json); // Decode into PHP object

if (isset($_SESSION['record_id'])) {
$record_id = $_SESSION['record_id'];
    //echo "Received: " . $data->name;
    $section = $data->section;
    $tableCollection = array();
    /*switch ($section) {
    case "A":
        $tableCollection = ["a_demand","a_modern"];
        break;
    case "B":
        $tableCollection = ["b_prenatal"];
        break;
    case "C":
        $tableCollection = ["c_a1", "c_a2", "c_a3", "c_a4", "c_nutrition", "c_sick"];
        break;
}*/
    $tableCollection = [
        "a_demand",
        "a_modern",
        "b_prenatal",
        "c_a1",
        "c_a2",
        "c_a3",
        "c_a4",
        "c_nutrition",
        "c_sick",
        "d_oral",
        "e_e1",
        "e_e2",
        "e_e3",
        "e_e4",
        "e_e5",
        "e_e6",
        "e_e7",
        "e_e8",
        "f_water",
        "f_sanitation",
        "g_filariasis",
        "g_rabies",
        "g_schistosomiasis",
        "g_sth",
        "g_leprosy",
        "g_hiv",
        "vital_mortality",
        "vital_natality"
    ];
    $resultCollection = array();
    foreach ($tableCollection as $table) {
        $q = "SELECT * FROM " . $table . " WHERE record_id=".$record_id; //make sure to replace the record_id with the value of the selected year and month
        $result = mysqli_query($connection, $q);

        //if (mysqli_num_rows($result) > 0) {
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        $resultCollection[] = $rows;
        //}
    }
    echo json_encode(['success' => true, 'message' => $resultCollection]);

    /*$sql = "SELECT * FROM a_modern WHERE record_id=1";
$result = mysqli_query($connection, $sql);
$resultCollection = array();
if (mysqli_num_rows($result) > 0) {
    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    echo json_encode(['success' => true, 'message' => $rows]);
} else {
    echo json_encode(['success' => true, 'message' => 'no data found']);
}*/
}
