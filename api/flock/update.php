<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/flock.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$flock = new Flock($db);

$data = json_decode(file_get_contents("php://input"));

$flock->flock_id = $data->flock_id;

// set farm property values
$flock->farm_id = $data->farm_id;
$flock->building_id = $data->building_id;
$flock->bird_type_id = $data->bird_type_id;
$flock->delivery_date = $data->delivery_date;
$flock->hatchlings = $data->hatchlings;

// update the farm
if($flock->update()){

        http_response_code(200);

        echo json_encode(array("message" => "Flock was updated."));
} else{
        http_response_code(503);

        echo json_encode(array("message" => "Unable to update flock."));
}
?>
