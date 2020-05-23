<?php
//Takes in the username, old password, and new password. If the username exists, check if 
//old password matches the stored password. If yes, set stored password = new password
//Author: Cassandra Bailey

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

$username = $_POST['username'];
$currPass = $_POST['currPass'];
$newPass = $_POST['newPass'];

$user->name_string = $username;
$user->auth_string = $currPass;

$stmt = $user->changePassword($newPass);
$result = $stmt->fetch();

echo json_encode($result[0]);
?>
