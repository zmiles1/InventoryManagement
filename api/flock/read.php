<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/flock.php';

// instantiate database and farm object
$database = new Database();
$db = $database->getConnection();

// initialize object
$flock = new Flock($db);

// query flocks
$stmt = $flock->read();
$num = $stmt->rowCount();

/// check if more than 0 record found
if($num>0){

    // farms array
    $flocks_arr=array();
    $flocks_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to 
        // just $name only
        extract($row);

	$flock_item=array(
	    "flock_id" => $flock_id,
            "farm_id" => $farm_id,
	    "farm_name" => $farm_name,
	    "building_id" => $building_id,
            "building_number" => $building_number,
	    "building_floor" => $building_floor,
	    "bird_type_id" => $bird_type_id, 
            "bird_desc" => $bird_desc,
            "delivery_date" => $delivery_date,
            "hatchlings" => $hatchlings
        );

        array_push($flocks_arr["records"], $flock_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show flock data in json format
    echo json_encode($flocks_arr);
}else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user no flocks found
    echo json_encode(
        array("meesage" => "No flocks found.")
    );
}
?>
