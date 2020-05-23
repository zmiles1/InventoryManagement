<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/User.php';

//database connection
$database = new Database();
$db = $database->getConnection();

// initialize user obj
$user = new User($db);

// set ID property of record to read
$user->user_ID = isset($_GET['user_ID']) ? $_GET['user_ID'] : die();

// get user details
$user->readbyID();

if($user->name_string!=null){
    // create array
    $user_arr = array(
        "user_ID" =>  $user->user_ID,
        "username" => $user->name_string,
        "firstname" => $user->first_name,
        "lastname" => $user->last_name,
        "role" => $user->permission_set,
        "status" =>$user->active_status

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($user_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell user does not exist
    echo json_encode(array("message" => "User does not exist."));
}
?>
