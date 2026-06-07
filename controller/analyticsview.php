<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    exit(json_encode(["error" => "Method Not Allowed"]));
}

// Determine which GET action is being requested
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'family_planning':
        echo json_encode(family_planning());
        break;

    case 'prenatal_services':
        echo json_encode(prenatal_services());
        break;
    case 'immunization':
        echo json_encode(immunization());
        break;
    case 'nutrition':
        echo json_encode(nutrition());
        break;
    case 'sick_child':
        echo json_encode(sick_child());
        break;
    case 'oral_health':
        echo json_encode(oral_health());
        break;
    case 'ncd':
        echo json_encode(ncd());
        break;
    case 'vital_statistics':
        echo json_encode(vital_statistics());
        break;
    default:
        http_response_code(404);
        echo json_encode(["error" => "Action endpoint not found"]);
        break;
}

function family_planning()
{
    return general("SELECT id,record_id,indicator,current_begin_total,current_end_total FROM bhw.a_modern where record_id=?;");
}
function prenatal_services()
{
    return general("SELECT * FROM b_prenatal where record_id=? AND indicator REGEXP '^[0-9]';");
}
function immunization()
{
    return general("SELECT * FROM c_a1 where record_id=?;");
}
function nutrition()
{
    return general("SELECT * FROM c_nutrition where record_id=? LIMIT 5;");
}
function sick_child()
{
    return general("SELECT * FROM c_sick where record_id=? LIMIT 5;");
}
function oral_health()
{
    return general("SELECT * FROM d_oral where record_id=? LIMIT 5;");
}
function ncd()
{
    return general("SELECT * FROM e_e1 where record_id=? limit 6 offset 1;");
}
function vital_statistics()
{
    return general("SELECT * FROM vital_natality where record_id=? limit 6;");
}
function general($sql)
{
    //get the id of the report
    $record_id = 34; //replace with whats in the session
    //connect to database
    require '../model/constants.php';
    //$sql = "SELECT id,record_id,indicator,current_begin_total,current_end_total FROM bhw.a_modern where record_id=?;";
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // throw exceptions on error
    //perform sql statement
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    $db->set_charset('utf8mb4');

    if ($db->connect_errno) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $db->connect_error]);
        exit;
    }

    $stmt = $db->prepare($sql);
    // "i" denotes that $id is an integer bind variable
    $stmt->bind_param("s", $record_id);
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    //close resources
    $stmt->close();
    $db->close();

    return $result->fetch_all(MYSQLI_ASSOC);
    //return the results
}
