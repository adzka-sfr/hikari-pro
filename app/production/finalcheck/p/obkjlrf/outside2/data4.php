<?php
// get connection
require '../config.php';

// get data lemparan
$codeng = $_POST['codeng'];
$serialnumber = $_POST['serialnumber'];
$batasan_process = $publicprocess;

$cab = array();
$sql = mysqli_query($connect_pro, "SELECT c_code_cabinet FROM finalcheck_fetch_outside WHERE c_code_ng = '$codeng' AND c_serialnumber = '$serialnumber' AND c_process = '$batasan_process'");
while ($data = mysqli_fetch_array($sql)) {
    array_push($cab, $data['c_code_cabinet']);
}

$data = ['cabinet' => $cab];

echo json_encode($data);
