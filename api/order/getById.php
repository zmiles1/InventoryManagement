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

$id = $_POST['id'];

if( !empty($id) ){
	$order->invoice_id = $id;
	$stmt = $order->getById();
	$num = $stmt->rowCount();
	if($num>0){
        	$order_arr=array();
        	$order_arr["records"]=array();
        	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                	extract($row);
                	$order_item=array(
				"coops" => $number_coops,
				"bird" => $bird_desc,
				"id" => $order_id,
                	);
			array_push($order_arr["records"], $order_item);
        	}
        	http_response_code(200);
		echo json_encode($order_arr);
	}
}

?>
