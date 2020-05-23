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

$storeid = $_POST['storeid'];
$deldate = $_POST['deldate'];
$numcoops = $_POST['numcoops'];
$flockid = $_POST['flockid'];
$invoiceid = $_POST['invoiceid'];

if( !empty($storeid) && !empty($deldate) && !empty($numcoops) && !empty($flockid) && !empty($invoiceid) ) {
	$order->store_id = $storeid;
	$order->delivery_date = $deldate;
	$order->number_coops = $numcoops;
	$order->flock_id = $flockid;
	$order->invoice_id = $invoiceid;

	$stmt = $order->insertOrder();
	$result = $stmt->fetch();
} else {
	echo json_encode(array("message" => "incomplete"));
}
?>
