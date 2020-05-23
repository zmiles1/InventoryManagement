<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/order.php';
//instantiate db and connect
$database = new Database();
$db = $database->getConnection();
// initialize user obj
$order = new Order($db);

$order_id = $_POST['id'];

if( !empty($order_id)){
	$order->order_id = $order_id;

	$stmt = $order->removeOrder();
	$result = $stmt->fetch();
}else {
	echo "After you've scrubbed all the floors in Hyrule then we can talk about mercy.";
}
?>
