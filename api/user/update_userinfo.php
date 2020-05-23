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

if( !empty($data->userName) &&
    !empty($data->firstName) &&
    !empty($data->lastName) &&
    !empty($data->permission)&&
    !empty($data->userid)){

    $user->first_name = $data->firstName;
    $user->last_name = $data->lastName;
    $user->name_string = $data->userName;
    $user->permission_set = $data->permission;
    $user->user_ID = $data->userid;
    $user->active_status =$data->activestatus;

$stmt = $user->update_userinfo();
    $result = $stmt->fetch();
    echo json_encode(array(
            "message" => $result['message']));
}
else{
        echo json_encode(array(
                "message" => "incomplete"));
}
?>

