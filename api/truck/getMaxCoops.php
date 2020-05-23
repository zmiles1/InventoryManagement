<?php
//Gets the max number of coops for the truck corresponding to the given truck_id
//Author: Cassandra Bailey

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/truck.php';

$database = new Database();
$db = $database->getConnection();

$truck = new Truck($db);

$id = $_POST['truck_id'];

$truck->truck_id = $id;
$stmt = $truck->getMaxCoops();
$result = $stmt->fetch();

echo json_encode(
	   array(
		 "max_coops" => $result['truck_max_coops']));
?>
