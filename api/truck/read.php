<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/truck.php';

// instantiate database and farm object
$database = new Database();
$db = $database->getConnection();

// initialize object
$truck= new Truck($db);

$stmt = $truck->read();
$num = $stmt->rowCount();

/// check if more than 0 record found
if($num>0){

    $truck_arr=array();
    $truck_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $truck_item=array(
            "truck_status" => $truck_status,
            "truck_vin" => $truck_vin,
            "truck_plate_number" => $truck_plate_number,
            "truck_transmission" => $truck_transmission,
            "truck_number" => $truck_number,
            "truck_max_coops" => $truck_max_coops,
            "truck_id" => $truck_id

        );

        array_push($truck_arr["records"], $truck_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show farm data in json format
    echo json_encode($truck_arr);

}else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no farms found
    echo json_encode(
        array("truck" => "No trucks found.")
    );
}
?>