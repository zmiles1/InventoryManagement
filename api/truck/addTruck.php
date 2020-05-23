<?php
   // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/truck.php';

$database = new Database();
$db = $database->getConnection();

$truck = new Truck($db);


        $truckNumber = $_POST['truckNumber'];
        $truckVIN = $_POST['truckVIN'];
        $truckPlateNumber = $_POST['truckPlateNumber'];
        $truckMaxCoops = $_POST['truckMaxCoops'];
        $truckTransmission = $_POST['truck_transmission'];

    $truck->truck_number = $truckNumber;
    $truck->truck_vin = $truckVIN;
    $truck->truck_plate_number = $truckPlateNumber;
    $truck->truck_max_coops = $truckMaxCoops;
    $truck->truck_transmission = $truckTransmission;

    $stmt = $truck->create();
	$result = $stmt->fetch();

?>