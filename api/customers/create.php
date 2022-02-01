<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once "../../config/Database.php";
include_once "../../models/Customer.php";

$database = new Database();
$db = $database->connection();

$data = [
    'firstName' => empty($_POST['firstName']) ? die('firstName is mandatory') : $_POST['firstName'],
    'lastName' => empty($_POST['lastName']) ? die('lastName is mandatory') : $_POST['lastName'],
    'gender' => empty($_POST['gender']) ? die('gender is mandatory') : $_POST['gender'],
    'email' => empty($_POST['email']) ? die('email is mandatory') : $_POST['email'],
    'countryCode' => empty($_POST['countryCode']) ? die('countryCode is mandatory') : $_POST['countryCode'],
    'balance' => $_POST['balance'] ?? 0,
    'bonusBalance' => $_POST['bonusBalance'] ?? 0,
    'bonusPercent' => rand(5, 20)
];
// check if customer email already exist
$customer = new Customer($db);

$customer->findByEmail($data['email']);

if (!empty($customer->id)) {
    echo json_encode(array('message'=>'Could not create customer -> email already used'));
    die;
}

// create new customer
unset($customer);
$newCustomer = new Customer($db);

$newCustomer->params = [];
$setParam="";
foreach ($data as $key=>$value) {
    if (isset($key) && $key != "customerId") {
        $setParam .= "`$key` = :$key,";
        $newCustomer->params[$key] = htmlspecialchars(strip_tags($value));
    }
}
$newCustomer->setParam = rtrim($setParam,",");

if ($newCustomer->create()) {
    echo json_encode(array('message'=>'New customer created'));
}else{
    echo json_encode(array('message'=> 'customer Not Created'));
}