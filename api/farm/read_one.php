<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/farm.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize new farm object
$farm = new Farm($db);

// set ID property of record to read
$farm->farm_id = isset($_GET['farm_id']) ? $_GET['farm_id'] : die();

// read the details of farm to be edited
$farm->readOne();

if($farm->farm_name != null){
    //create array
    $farm_arr = array(
        "farm_id" => $farm->farm_id,
        "farm_name" => $farm->farm_name,
        "farm_address" => $farm->farm_address,
        "farm_city" => $farm->farm_city
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($farm_arr);
} else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell user farm does not exist
    echo json_encode(array("message" => "Farm does not exist."));
}
?>
