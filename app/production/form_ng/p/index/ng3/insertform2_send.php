<?php
session_start();
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$c_serialnumber = $_POST['serialnumber'];
$c_checked = $_SESSION['nama'];
$c_process = $_POST['process'];

// insert in repairdata
$pp1 = mysqli_query($connect_pro, "INSERT INTO formng_repairdata SET c_serialnumber = '$c_serialnumber', c_process = '$c_process', c_startprocess = '$now'");

if ($pp1) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($connect_pro);
