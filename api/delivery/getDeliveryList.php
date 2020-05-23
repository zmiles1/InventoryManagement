<?php
//Gets the list of tomorrow's assigned routes
//Author: Cassandra Bailey
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/delivery.php';

$database = new Database();
$db = $database->getConnection();

$del = new Delivery($db);

$stmt = $del->getTomorrowsDeliveryList();

$deliveries = array();
foreach($stmt->fetchAll() as $row){
    $inner_array = array(
	"first_name" => $row['first_name'],
	"last_name" => $row['last_name'],
	"truck_number" => $row['truck_number'],
	"truck_driver_id" => $row['truck_driver_id'],
	"truck_id" => $row['truck_id'],
	"driver_id" => $row['driver_id']
    );
    $deliveries[] = $inner_array;
}
echo json_encode($deliveries);
?>
