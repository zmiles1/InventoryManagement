<?php
//Gets the list of tomorrows available trucks which correspond to the driver's tranmission capabilities
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

$transmission = $_POST['transmission'];
if(empty($transmission)){
    $transmission = "MANUAL";
}

$truck->truck_transmission = $transmission;
$stmt = $truck->getTomorrowsAvailableTrucks();
$trucks = array();
foreach($stmt->fetchAll() as $row){
    $inner_array = array(
	"truck_id" => $row['id'],
	"truck_number" => $row['truck_number'],
	"transmission" => $row['truck_transmission']
    );
    $trucks[] = $inner_array;
}

echo json_encode($trucks);
?>
