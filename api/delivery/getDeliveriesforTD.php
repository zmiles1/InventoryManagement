<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/delivery.php';

$database = new Database();
$db = $database->getConnection();

$delivery = new Delivery($db);

// set ID property of record to read
$delivery->driver_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();


$stmt = $delivery->getDeliveryListTD();
$num = $stmt->rowCount();
if($num>0){
        $delivery_arr=array();
        $delivery_arr["records"]=array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $delivery_item=array(
                        "delivery_id" => $delivery_id,
                );
                array_push($delivery_arr["records"], $delivery_item);
        }
        http_response_code(200);
        echo json_encode($delivery_arr);
}else{
        http_response_code(404);
        echo json_encode(
                array("message" => "Deliveries not found.")
        );
}
?>

