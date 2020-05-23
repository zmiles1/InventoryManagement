<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/farm.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

$farm = new Farm($db);

$data = json_decode(file_get_contents("php://input"));

$farm->farm_id = $data->farm_id;

// set farm property values
$farm->farm_name = $data->farm_name;
$farm->farm_address = $data->farm_address;
$farm->farm_city = $data->farm_city;

// update the farm
if($farm->update()){

	http_response_code(200);

	echo json_encode(array("message" => "Farm was updated."));
} else{
	http_response_code(503);

	echo json_encode(array("message" => "Unable to update farm."));
}
?>
