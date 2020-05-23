<?php
//Returns a list of tomorrow's deliveries which have not yet been assigned to a route
//Author: Cassandra Bailey

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

$stmt = $order->getTomorrowsDeliveries();
$orders = array();

foreach($stmt->fetchAll() as $row){
    $inner_array = array(
			 "store_id" => $row['store_id'],
			 "store_name" => $row['store_name'],
			 "store_address" => $row['store_address'],
			 "store_city" => $row['store_city'],
			 "store_state" => $row['store_state'],
			 "store_phone" => $row['store_phone'],
			 "number_coops" => $row['number_coops']
    );
    $orders[] = $inner_array;
}

echo json_encode($orders);
?>
