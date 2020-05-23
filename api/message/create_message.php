<?php
   // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/message.php';

$database = new Database();
$db = $database->getConnection();

$message = new Message($db);

            $user_id = $_POST['user_id'];
            $content = $_POST['content'];
            $flockmanager_flag= $_POST['flockmanager_flag'];
            $salesmanager_flag =$_POST['salesmanager_flag'];
            $truckdriver_flag = $_POST['truckdriver_flag'];
if(
    !empty(!empty($content) )
){
    $message->user_id = $user_id;
    $message->content = $content;
    $message->flockmanager_flag = $flockmanager_flag;
    $message->salesmanager_flag = $salesmanager_flag;
    $message->truckdriver_flag = $truckdriver_flag;
    $stmt = $message->create();
	$result = $stmt->fetch();
} else {
	echo json_encode(array("message" => "incomplete"));
}
?>
