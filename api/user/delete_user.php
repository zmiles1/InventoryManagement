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

$userid = $_POST['userid'];
$user->user_ID = $userid;
$stmt = $user->delete_user();
echo $stmt;
?>



