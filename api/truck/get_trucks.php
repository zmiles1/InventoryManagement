<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/truck.php';

$database = new Database();
$db = $database->getConnection();

$truck = new Truck($db);

$stmt = $truck->read();
$count = 1;
$trucks = array();
foreach($stmt->fetchAll() as $row){
    $str = "truck" . $count;

    $inner_array = array(
	    "truck_id" => $row['truck_id'],
	    "truck_status" => $row['truck_status'],
	    "truck_vin" => $row['truck_vin'],
	    "truck_plate_number" => $row['truck_plate_number'],
	    "truck_max_coops" => $row['truck_max_coops'],
	    "truck_transmission" => $row['truck_transmition'],
	    "truck_number" => $row['truck_number'],
	    "box_type" => $row['box_type']);

    $count = $count + 1;
    $trucks[] = $inner_array;
}

echo json_encode($trucks);

?>
