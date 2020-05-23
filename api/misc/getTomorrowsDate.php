<?php
//Returns tomorrows date in Eastern Standard Time
//Author: Cassandra Bailey

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/misc.php';

$database = new Database();
$db = $database->getConnection();

$misc = new Misc($db);

$stmt = $misc->getTomorrowsDate();
$result = $stmt->fetch();

echo json_encode(
           array(
		   "date" => $result['tomDate']));

?>
