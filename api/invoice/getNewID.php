<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/invoice.php';

$database = new Database();
$db = $database->getConnection();

$invoice = new Invoice($db);

$stmt = $invoice->getNewID();
$id = $stmt->fetch();

echo json_encode(array("invoice_id" => $id[0]));
?>
