<?php
//Takes in a truck_driver_id and returns the route assigned to it
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

$truck_driver_id = $_POST['truck_driver_id'];

$del->truck_driver_id = $truck_driver_id;

$stmt = $del->getDispatchDeliveries($truck_driver_id);

$deliveries = array();
foreach($stmt->fetchAll() as $row){
    $inner_array = array(
	"stop_number" => $row['stop_number'],
	"total_coops" => $row['total_coops'],
	"store_name" => $row['store_name'],
	"store_address" => $row['store_address'],
	"store_city" => $row['store_city'],
	"store_state" => $row['store_state'],
	"store_phone" => $row['store_phone'],
	"store_id" => $row['store_id']
    );
    $deliveries[] = $inner_array;
}
echo json_encode($deliveries);
?>
