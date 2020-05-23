<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Origin, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';
// instantiate flock object
include_once '../objects/flock.php';

$database = new Database();
$db = $database->getConnection();

$flock  = new Flock($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->farm_id) &&
    !empty($data->building_id) &&
    !empty($data->hatchlings) &&
    !empty($data->delivery_date) &&
    !empty($data->bird_type_id) 
){
    // set flock property values
    $flock->farm_id = $data->farm_id;
    $flock->building_id = $data->building_id;
    $flock->hatchlings = $data->hatchlings;
    $flock->delivery_date = $data->delivery_date;
    $flock->bird_type_id = $data->bird_type_id;

    // create the flock
    if($flock->create()){
        // set response code - 201 created
        http_response_code(201);

        // notify the user
        echo json_encode(array("message" => "New flock added!"));
    }
    //if unable to create flock, notify user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);

        echo json_encode(array("message" => "Unable to add flock."));
    }
}

// tell the user data is incomplete
else{
    // set response code - 400 bad request
    http_response_code(400);

    echo json_encode(array("message" => "Unable to add flock. Data is incomplete."));
}
?>
