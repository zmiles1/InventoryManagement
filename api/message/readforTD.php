<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/message.php';

// instantiate database and farm object
$database = new Database();
$db = $database->getConnection();

// initialize object
$message = new Message($db);

$stmt = $message->readfortruckdriver();
$num = $stmt->rowCount();

/// check if more than 0 record found
if($num>0){

    $message_arr=array();
    $message_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $message_item=array(
            "name" => $name,
            "content" => $content,
            "date_created" => $date_created
        );

        array_push($message_arr["records"], $message_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show farm data in json format
    echo json_encode($message_arr);

}else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no farms found
    echo json_encode(
        array("meesage" => "No messages found.")
    );
}
?>

