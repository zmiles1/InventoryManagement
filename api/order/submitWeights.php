<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/order_weights.php';
//instantiate db and connect
$database = new Database();
$db = $database->getConnection();
// initialize user obj
$ow = new Order_Weight($db);
$deldate = $_POST['delivery_date'];
$numcoops = $_POST['num_coops'];
$flockid = $_POST['flock_ID'];
$weight1 = $_POST['weight_1'];
$weight2 = $_POST['weight_2'];
$trailer = $_POST['trailer_num'];
if( !empty($deldate) && !empty($numcoops) && !empty($flockid) && !empty($weight1) && !empty($weight2) && !empty($trailer) ) {
	$ow->delvDate = $deldate;
	$ow->coops = $numcoops;
	$ow->flockID = $flockid;
	$ow->w1 = $weight1;
	$ow->w2 = $weight2;
	$ow->trailer = $trailer;
	$stmt = $ow->submitWeights();
	$result = $stmt->fetch();
} else {
	echo json_encode(array("message" => "incomplete"));
}
?>
