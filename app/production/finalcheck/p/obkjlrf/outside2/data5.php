<?php
// get connection
require '../config.php';

// get data lemparan
$numberng = $_POST['numberng'];
$serialnumber = $_POST['serialnumber'];
$batasan_process = $publicprocess;

$num = array();
$sql = mysqli_query($connect_pro, "SELECT c_code_coordinate FROM finalcheck_fetch_loc WHERE c_number_ng = '$numberng' AND c_serialnumber = '$serialnumber' AND c_process = '$batasan_process'");
while ($data = mysqli_fetch_array($sql)) {
    array_push($num, $data['c_code_coordinate']);
}

$data = ['coordinate' => $num];

echo json_encode($data);
