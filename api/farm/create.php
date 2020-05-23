<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Origin, X-Requested-With");

// get database connection
include_once '../config/database.php';
// instantiate farm object
include_once '../objects/farm.php';

$database = new Database();
$db = $database->getConnection();

$farm  = new Farm($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->farm_name) &&
    !empty($data->farm_address) &&
    !empty($data->farm_city)
){
    // set farm property values
    $farm->farm_name = $data->farm_name;
    $farm->farm_address = $data->farm_address;
    $farm->farm_city = $data->farm_city;

    // create the farm
    if($farm->create()){
        // set response code - 201 created
        http_response_code(201);

        // notify the user
        echo json_encode(array("message" => "New farm added!"));
    }
    //if unable to create farm, notify user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);

        echo json_encode(array("message" => "Unable to add farm."));
    }
}

// tell the user data is incomplete
else{
    // set response code - 400 bad request
    http_response_code(400);

    echo json_encode(array("message" => "Unable to add farm. Data is incomplete."));
}
?>
