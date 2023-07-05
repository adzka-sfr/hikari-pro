<?php
session_start();
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$c_serialnumber = $_POST['serialnumber'];
$c_checked = $_SESSION['nama'];
$c_process = $_POST['process'];

// update in repair data
$pp1 = mysqli_query($connect_pro, "UPDATE formng_repairdata SET c_endprocess = '$now' WHERE c_serialnumber = '$c_serialnumber' AND c_process = '$c_process'");
// update in register
$pp1 = mysqli_query($connect_pro, "UPDATE formng_register SET c_finishoutcheck1 = '$now',  c_outcheck1by = '$c_checked' WHERE c_serialnumber = '$c_serialnumber'");

if ($pp1) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($connect_pro);
