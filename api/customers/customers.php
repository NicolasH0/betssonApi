<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/Database.php";
include_once "../../models/Customer.php";
$database = new Database();
$db = $database->connection();

$customer = new Customer($db);

$result = $customer->read();
$num = $result->rowCount();

if ($num > 0) {
    // initialize array variable
    $customers_arr = array();
    $customers_arr['customers'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $customers_item = array(
            'id'=>$id,
        );
        array_push($customers_arr['customers'], $customers_item);
    }
    echo json_encode($customers_arr);
} else {
    echo json_encode(array("message"=>"NO DATA"));
}