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

$customer->id = $data['id'];
//find customer
$customer->read_single();

$currentBalance = $customer->balance;
$data['bonusBalance'] = $customer->bonusBalance;
$data['balance'] = $currentBalance + $data['amount'];

// grant deposit bonus every 3rd deposit
$data['depositCounter'] = $customer->depositCounter + 1;
if($data['depositCounter'] % 3 == 0) {
    $data['bonusBalance'] += $data['amount'] * $customer->bonusPercent / 100;
}

$reportData = [
    'action' => 'deposit',
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