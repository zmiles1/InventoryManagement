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
$user->active_status = isset($_GET['id']) ? $_GET['id'] : die();

// get user details
$result = $user->readbystat();
//get number of rows
$numsRow = $result->rowCount();

//checks if there is any data in the user table
if($numsRow > 0){

    //initialize user array
    $users_arr=array();
    $users_arr["data"]=array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $user_obj=array(
            "user_ID" =>  $user_ID,
            "username" => $name_string,
            "firstname" => $first_name,
            "lastname" => $last_name,
            "role" => $permission_set,
            "status"=>$active_status
        );

        //push user obj in the 'users_arr' data
        array_push($users_arr["data"], $user_obj);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show user data in json format
    echo json_encode($users_arr);



}else{
    // set response code - 404 Not found
    http_response_code(404);

    // send error message
    echo json_encode(
        array("message" => "User does not exist.")
    );
}

?>
