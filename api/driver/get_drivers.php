<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/driver.php';

$database = new Database();
$db = $database->getConnection();

$driver = new Driver($db);

$stmt = $driver->read();
$drivers = array();
foreach($stmt->fetchAll() as $row){
    $curr_driver = array(
	"driver_id" => $row['driver_id'],
	"first_name" => $row['first_name'],
	"last_name" => $row['last_name'],
	"phone_number" => $row['phone_number'],
	"date_of_birth" => $row['date_of_birth'],
	"license_st" => $row['license_st'],
	"license_number" => $row['license_number'],
	"license_type" => $row['license_type'],
	"license_expiration" => $row['license_expiration'],
	"medical_expiration" => $row['medical_expiration'],
	"transmission_type" => $row['transmission_type']);

    $drivers[] = $curr_driver;
}
echo json_encode($drivers);
?>
