<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/Database.php";
include_once "../../models/Customer.php";

$database = new Database();
$db = $database->connection();

$customer = new Customer($db);

$customer->id = isset($_GET['id']) ? $_GET['id'] : die('Please provide a customerId');

$customer->read_single();

$data_arr = array(
    'id'=>$customer->id,
    'firstName' => $customer->firstName,
    'lastName' => $customer->lastName,
    'email' => $customer->email,
    'gender' => $customer->lastName,
    'countryCode' => $customer->lastName,
    'bonusPercent' => $customer->lastName,
    'balance' => $customer->balance,
    'bonusBalance' => $customer->bonusBalance,
    'depositCounter' => $customer->depositCounter
);

print_r(json_encode($data_arr));