<?php
   // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/store.php';

$database = new Database();
$db = $database->getConnection();

$store = new Store($db);

        $store_name = $_POST['customerName'];
        $store_address =$_POST['customerAddress'];
        $store_phone = $_POST['customerPhone'];
        $store_city = $_POST['customerCity'];
        $store_zip = $_POST['customerZip'];
        $store_state = $_POST['customerState'];
    

    $store->store_name = $store_name;
    $store->store_address = $store_address;
    $store->store_phone = $store_phone;
    $store->store_city = $store_city;
    $store->store_zip = $store_zip;
    $store->store_state = $store_state;
    $stmt = $store->create();
	$result = $stmt->fetch();

?>
