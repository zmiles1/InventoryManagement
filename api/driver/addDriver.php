<?php
   // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/driver.php';

$database = new Database();
$db = $database->getConnection();

$driver = new Driver($db);


    $first_name = $_POST['first_name'];
    $last_name =$_POST['last_name'];
    $driverUser = $_POST['driverUser'];
    $driverBirth= $_POST['driverBirth'];
    $driverLN = $_POST['driverLN'];
    $driverME = $_POST['driverME'];
    $driverState =$_POST['driverState'];
    $driverLE = $_POST['driverLE'];
    $driverPhone = $_POST['driverPhone'];
    $driverTransmission = $_POST['driverTransmission'];
    $driverLT = $_POST['driverLT'];


    $driver->first_name = $first_name;
    $driver->last_name = $last_name;
    $driver->user_ID = $driverUser;
    $driver->date_of_birth = $driverBirth;
    $driver->license_number = $driverLN;
    $driver->medical_expiration = $driverME;
    $driver->license_st = $driverState;
    $driver->license_expiration = $driverLE;
    $driver->phone_number = $driverPhone;
    $driver->transmission_type = $driverTransmission;
    $driver->license_type = $driverLT;
    $stmt = $driver->driverCreate();
	$result = $stmt->fetch();


?>
