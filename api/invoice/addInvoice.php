<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/invoice.php';
//instantiate db and connect
$database = new Database();
$db = $database->getConnection();
// initialize user obj
$invoice = new Invoice($db);
$storeid = $_POST['storeid'];
$deldate = $_POST['deldate'];
if( !empty($storeid) && !empty($deldate) ) {
	$invoice->store_id = $storeid;
	$invoice->invoice_date = $deldate;
	$stmt = $invoice->addInvoice();
	$result = $stmt->fetch();
} else {
	echo json_encode(array("message" => "incomplete"));
}
?>
