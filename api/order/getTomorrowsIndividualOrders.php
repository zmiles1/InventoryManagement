<?php
//Returns the list of tomorrows orders corresponding to the given store id
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

$id = $_POST['store_id'];

$order->store_id = $id;

$stmt = $order->getTomorrowsIndividualOrders();
$orders = array();
foreach($stmt->fetchAll() as $row){
    $inner_array = array(
	"bird_type" => $row['bird_type'],
	"number_coops" => $row['number_coops']
    );
    $orders[] = $inner_array;
}

echo json_encode($orders);
?>
