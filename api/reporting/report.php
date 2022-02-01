<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once "../../config/Database.php";
include_once "../../models/Report.php";

$database = new Database();
$db = $database->connection();

$report = new Report($db);

// use custom day range
if (!empty($_GET['dayInterval'])) {
    $reportsData = $report->findAllByDayInterval($_GET['dayInterval']);
} else {
    //default: 7 days
    $reportsData = $report->findAllByDayInterval();
}
error_reporting(0);
$tmpCountriesArr = [];
$tmpDataArr = [];
$tmpReportArr = [];
$countDeposit = 0;
$countWithdraw = 0;

foreach ($reportsData as $key=> $reportData) {
    $tmpCountriesArr[] = $reportData['countryCode'];
    $tmpDataArr[date('d/m/Y',strtotime($reportData['date']))][] = $reportData;
}

$countries = array_unique($tmpCountriesArr);

foreach ($tmpDataArr as $key => $data) {
    foreach ($data as $reportDataArr) {
        if (!empty($reportDataArr['action']) && in_array($reportDataArr['countryCode'], $countries)) {
            if (!empty($reportDataArr['action']) && $reportDataArr['action'] == 'deposit') {
                $tmpReportArr[$key][$reportDataArr['countryCode']]['totalDeposit'] += $reportDataArr['amount'];
                $tmpReportArr[$key][$reportDataArr['countryCode']]['No of deposit'] += $countDeposit + 1;
            } elseif (!empty($reportDataArr['action']) && $reportDataArr['action'] == 'withdraw') {
                $tmpReportArr[$key][$reportDataArr['countryCode']]['totalWithdraw'] -= $reportDataArr['amount'];
                $tmpReportArr[$key][$reportDataArr['countryCode']]['No of withdraw'] += $countWithdraw + 1;
            }
        }
    }
}
print_r(json_encode($tmpReportArr));

