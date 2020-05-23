<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/flock.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize new flock object
$flock = new Flock($db);

// set ID property of record to read
$flock->flock_id = isset($_GET['flock_id']) ? $_GET['flock_id'] : die();

// read the details of flock to be edited
$flock->readOne();

if($flock->farm_name != null){
    //create array
$flock_arr = array(
	"farm_id" => $flock->farm_id,
	"farm_name" => $flock->farm_name,
	"building_id" => $flock->building_id,
        "building_number" => $flock->building_number,
	"building_floor" => $flock->building_floor,
	"bird_type_id" => $flock->bird_type_id,
        "bird_desc" => $flock->bird_desc,
        "delivery_date" => $flock->delivery_date,
        "hatchlings" => $flock->hatchlings
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($flock_arr);
} else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell user flock does not exist
    echo json_encode(array("message" => "Flock does not exist."));
}
?>
