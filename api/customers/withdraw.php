<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once "../../config/Database.php";
include_once "../../models/Customer.php";
include_once "../../models/Report.php";


$database = new Database();
$db = $database->connection();

$customer = new Customer($db);

$data = [
    'id' => is_numeric($_POST['id']) ? $_POST['id'] : die('ID must be numeric'),
    'amount' => is_numeric($_POST['amount']) ? $_POST['amount'] : die('Amount must be numeric')
];

if ($data['amount'] > 100) {
    die('Maximum withdrawal amount is set to 100');
}

$customer->id = $data['id'];
$customer->read_single();

$currentBalance = $customer->balance;

if ($currentBalance < $data['amount']) {
    die('Balance cannot be negative');
}

$data['balance'] = $currentBalance - $data['amount'];

$reportData = [
    'action' => 'withdraw',
    'amount' => $data['amount'],
    'countryCode' => $customer->countryCode,
    'customerId' => $customer->id,
    'date' => date("Y-m-d H:i:s")
];

unset($data['amount']);

$customer->params = [];
$setParam="";
foreach ($data as $key => $value) {
    if (isset($key) && $key != "id") {
        $setParam .= "`$key` = :$key,";
        $customer->params[$key] = htmlspecialchars(strip_tags($value));
    }
}
$customer->setParam = rtrim($setParam,",");

$report = new Report($db);
$report->params = [];

$setParam= "";
foreach ($reportData as $key => $value) {
    if (isset($key) && $key != "id") {
        $setParam .= "`$key` = :$key,";
        $report->params[$key] = htmlspecialchars(strip_tags($value));
    }
}
$report->setParam = rtrim($setParam,",");

if ($report->create()) {
    echo json_encode(array('message'=>'Report Created'));
}else{
    echo json_encode(array('message'=> 'Report Not Created'));
}


if ($customer->update()) {
    echo json_encode(array('message'=>'Customer Updated'));
}else{
    echo json_encode(array('message'=> 'Customer Not Updated'));
}