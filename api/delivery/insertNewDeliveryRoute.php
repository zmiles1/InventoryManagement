<?php
//Takes in a truck_id, driver_id, and a list of deliveries. A truck_driver_id is created for 
//the combo of truck_id and driver_id. Then each delivery in the list is added to the database 
//with the truck_driver_id
//Author: Cassandra Bailey

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/delivery.php';
//instantiate db and connect
$database = new Database();
$db = $database->getConnection();

$del = new Delivery($db);

$data = json_decode(file_get_contents('php://input'));

if( !empty($data->truck_id) &&
    !empty($data->driver_id) &&
    !empty($data->deliveries)){
        $arr = $data->deliveries;
	$len = count($arr);

	$del->truck_id = $data->truck_id;
	$del->driver_id = $data->driver_id;

	$stmt = $del->setTruckDriver();
	$result = $stmt->fetch();
	$del->truck_driver_id = $result[0];

	for($i=1; $i<=$len; $i++){
	    $stmt = $del->setRouteStop($i, $arr[$i-1]->store_id);
	    $result = $stmt->fetch();
	    $stmt = $del->insertDeliveryOrders(intval($result[0]), $arr[$i-1]->store_id);
	}
}
echo json_encode($result[0]);
?>
