<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/driver.php';

// instantiate database and farm object
$database = new Database();
$db = $database->getConnection();

// initialize object
$driver = new Driver($db);

$stmt = $driver->readfordriver();
$num = $stmt->rowCount();

/// check if more than 0 record found
if($num>0){

    $driver_arr=array();
    $driver_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $driver_item=array(
            "driverName" => $driverName,
            "user_ID" => $user_ID

        );

        array_push($driver_arr["records"], $driver_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show farm data in json format
    echo json_encode($driver_arr);

}else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no farms found
    echo json_encode(
        array("meesage" => "No messages found.")
    );
}
?>