<?php
   // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/store.php';

$database = new Database();
$db = $database->getConnection();

$store = new Store($db);

            $store_id = $_POST['store_id'];

    $store->store_id= $store_id;

    $stmt = $store->deactivateStore();
	$result = $stmt->fetch();

?>