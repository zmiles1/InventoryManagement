<?php
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
$stmt = $order->getCurrentOrders();
$num = $stmt->rowCount();

if($num>0){
        $order_arr=array();
        $order_arr["records"]=array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $order_item=array(
                        "store" => $store,
			"coops" => $coops,
			"bird" => $bird,
			"date" => $date,
			"id" => $id,
			"flock_id" => $flock_id

                );

                array_push($order_arr["records"], $order_item);
        }

        http_response_code(200);

        echo json_encode($order_arr);
}else{
        http_response_code(404);

        echo json_encode(
                array("message" => "No store found.")
        );
}

?>
