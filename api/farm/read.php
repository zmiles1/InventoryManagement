<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/farm.php';

// instantiate database and farm object
$database = new Database();
$db = $database->getConnection();

// initialize object
$farm = new Farm($db);

// query farms
$stmt = $farm->read();
$num = $stmt->rowCount();

/// check if more than 0 record found
if($num>0){
    // farms array
    $farms_arr=array();
    $farms_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to 
        // just $name only
        extract($row);

        $farm_item=array(
            "farm_id" => $farm_id,
            "farm_name" => $farm_name,
            "farm_address" => $farm_address,
            "farm_city" => $farm_city
        );

        array_push($farms_arr["records"], $farm_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show farm data in json format
    echo json_encode($farms_arr);
}else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user no farms found
    echo json_encode(
        array("meesage" => "No farms found.")
    );
}
?>