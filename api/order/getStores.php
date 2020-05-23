<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files
include_once '../config/database.php';
include_once '../objects/order.php';
// instantiate database and farm object
$database = new Database();
$db = $database->getConnection();
// initialize object
$order = new Order($db);
// query 
$stmt = $order->getStores();
$num = $stmt->rowCount();

if($num>0){
	$store_arr=array();
	$store_arr["records"]=array();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		$store_item=array(
			"$store_id" => $store_id,
			"$store_name" => $store_name,
		);

		array_push($store_arr["records"], $store_item);
	}

	http_response_code(200);

	echo json_encode($store_arr);
}else{
	http_response_code(404);

	echo json_encode(
		array("message" => "No store found.")
	);
}
?>
