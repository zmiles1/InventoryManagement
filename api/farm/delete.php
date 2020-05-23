<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/farm.php';

$database = new Database();
$db = $database->getConnection();

$farm = new Farm($db);

// get farm id
$data = json_decode(file_get_contents("php://input"));

//set farm id to be deleted
$farm->farm_id = $data->farm_id;

//delete the farm
if($farm->delete()){

	http_response_code(200);

	echo json_encode(array("message" => "Farm was deleted."));
} else {

	http_response_code(503);

	echo json_encode(array("message" => "Unable to delete farm."));
}
?>
