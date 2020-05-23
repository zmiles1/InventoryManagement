<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/delivery.php';

//database connection
$database = new Database();
$db = $database->getConnection();

// initialize invoice obj
$delivery = new Delivery($db);

// set ID property of record to read
$delivery_id = isset($_GET['delivery_ID']) ? $_GET['delivery_ID'] : die();

// get user details
$delivery->getDeliveryStoreinfo($delivery_id);
if($delivery->store_name!=null){

    // create array
    $storeinfo_arr = array(
        "delivery_date" =>  $delivery->delivery_date,
        "store_name" => $delivery->store_name,
        "store_address" => $delivery->store_address,
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($storeinfo_arr);
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell user does not exist
    echo json_encode(array("message" => "Store Information does not exist."));
}
?>

