<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files
include_once '../config/database.php';
include_once '../objects/bird.php';
// instantiate database and farm object
$database = new Database();
$db = $database->getConnection();
// initialize object
$bird = new Bird_type($db);
// query 
$stmt = $bird->getBird();
$num = $stmt->rowCount();

if($num>0){
	$bird_arr=array();
	$bird_arr["records"]=array();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		$bird_item=array(
			"flock_id" => $flock_id,
			"bird_desc" => $bird_desc,
			"farm_name" => $farm_name,
		);

		array_push($bird_arr["records"], $bird_item);
	}

	http_response_code(200);

	echo json_encode($bird_arr);
}else{
	http_response_code(404);

	echo json_encode(
		array("message" => "No store found.")
	);
}
?>
