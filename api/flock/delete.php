<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/flock.php';

$database = new Database();
$db = $database->getConnection();

$flock = new Flock($db);

// get flock id
$data = json_decode(file_get_contents("php://input"));

//set flock id to be deleted
$flock->flock_id = $data->flock_id;

//delete the flock
if($flock->delete()){

        http_response_code(200);

        echo json_encode(array("message" => "Flock was deleted."));
} else {

        http_response_code(503);

        echo json_encode(array("message" => "Unable to delete flock."));
}
?>
