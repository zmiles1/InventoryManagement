<?php
//Takes in a transmission type and returns the list of drivers who are available to drive 
//that type of transmission tomorrow.
//Author: Cassandra Bailey

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/driver.php';

$database = new Database();
$db = $database->getConnection();

$driver = new Driver($db);

$transmission = $_POST['transmission'];
if(empty($transmission)){
    $transmission = "AUTOMATIC";
}

$driver->transmission_type = $transmission;
$stmt = $driver->getTomorrowsAvailableDrivers();
$drivers = array();
foreach($stmt->fetchAll() as $row){
    $inner_array = array(
	"driver_id" => $row['driver_id'],
	"first_name" => $row['first_name'],
	"last_name" => $row['last_name']
    );
    $drivers[] = $inner_array;
}
echo json_encode($drivers);
?>
