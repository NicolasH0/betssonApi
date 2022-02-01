<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');


include_once "../../config/Database.php";
include_once "../../models/Customer.php";

$database = new Database();
$db = $database->connection();

$customer = new Customer($db);

$data = [
    'id' =>is_numeric($_POST['id']) ? $_POST['id'] : die('ID must be numeric'),
    'firstName' => $_POST['firstName'],
    'lastName' => $_POST['lastName'],
    'gender' => $_POST['gender'],
    'email' => $_POST['email'],
    'countryCode' => $_POST['countryCode'],
    'balance' => is_numeric($_POST['balance']) ? $_POST['balance'] : die('Balance must be numeric'),
    'bonusBalance' => is_numeric($_POST['bonusBalance']) ? $_POST['bonusBalance'] : die('Bonus balance must be numeric'),
];

$customer->params = [];
$setParam="";
foreach ($data as $key=>$value) {
    if (isset($key) && $key != "id") {
        $setParam .= "`$key` = :$key,";
        $customer->params[$key] = htmlspecialchars(strip_tags($value));
    }
}
$customer->setParam = rtrim($setParam,",");

$customer->id = $data['id'];

if ($customer->update()) {
    echo json_encode(array('message'=>'Customer Updated'));
}else{
    echo json_encode(array('message'=> 'Customer Not Updated'));
}