<?php
session_start();
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');

$c_serialnumber = $_POST['serialnumber'];
$c_cabinet = $_POST['cabinet'];
$c_repaired = $_SESSION['repair_name'];
$c_process = $_POST['process'];

// update
$pp1  = mysqli_query($connect_pro, "UPDATE formng_resultong SET c_repaired = '$c_repaired', c_repairdate = '$now' WHERE c_serialnumber = '$c_serialnumber' AND c_cabinet = '$c_cabinet' AND c_process = '$c_process'");

#
if ($pp1) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($connect_pro);
