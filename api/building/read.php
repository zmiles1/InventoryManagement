<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/building.php';

// instantiate database and farm object
$database = new Database();
$db = $database->getConnection();

// initialize object
$building = new Building($db);

// query farms
$stmt = $building->read();
$num = $stmt->rowCount();

/// check if more than 0 record found
if($num>0){
    // farms array
    $building_arr=array();
    $building_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to 
        // just $name only
        extract($row);

        $building_item=array(
            "building_id" => $building_id,
            "building_number" => $building_number,
            "building_floor" => $building_floor,
        );

        array_push($building_arr["records"], $building_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show farm data in json format
    echo json_encode($building_arr);
}else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user no farms found
    echo json_encode(
        array("meesage" => "No buildings found.")
    );
}
?>
