<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php';
include_once '../objects/User.php';
//instantiate db and connect
$database = new Database();
$db = $database->getConnection();
// initialize user obj
$user = new User($db);
$data = json_decode(file_get_contents('php://input'));
if( !empty($data->username) &&
    !empty($data->firstname) &&
    !empty($data->lastname) &&
    !empty($data->permission)){
    $user->first_name = $data->firstname;
    $user->last_name = $data->lastname;
    $user->name_string = $data->username;
    $user->permission_set = $data->permission;
    $stmt = $user->create();
    $result = $stmt->fetch();
    echo json_encode(array(
	    "message" => $result['message']));
}
else{
	echo json_encode(array(
		"message" => "incomplete"));
}
?>
