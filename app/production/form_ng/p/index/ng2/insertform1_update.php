<?php
session_start();
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$c_serialnumber = $_POST['serialnumber'];
$c_numberng = $_POST['numberng'];
$c_ng = $_POST['ng'];
$c_checked = $_SESSION['nama'];
$c_process = $_POST['process'];

// delete for location
mysqli_query($connect_pro, "DELETE FROM formng_resultoloc WHERE c_serialnumber = '$c_serialnumber' AND c_numberng = '$c_numberng' AND c_process = 'oc1'");
// delete for name of ng
mysqli_query($connect_pro, "DELETE FROM formng_resultong WHERE c_serialnumber = '$c_serialnumber' AND c_numberng = '$c_numberng' AND c_process = 'oc1'");

foreach ($_POST['cab'] as $value) {
    $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultong SET c_serialnumber = '$c_serialnumber', c_numberng = '$c_numberng', c_ng = '$c_ng', c_cabinet = '$value', c_process = '$c_process', c_checker = '$c_checked', c_inspectiondate = '$now'");
}

if (!empty($_POST['ptbo'])) {
    foreach ($_POST['ptbo'] as $value) {
        $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultoloc SET c_serialnumber = '$c_serialnumber', c_code = '$value', c_numberng = $c_numberng, c_process = '$c_process', c_checked = '$c_checked', c_inspectiondate = '$now'");
    }
}

if (!empty($_POST['ptbi'])) {
    foreach ($_POST['ptbi'] as $value) {
        $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultoloc SET c_serialnumber = '$c_serialnumber', c_code = '$value', c_numberng = $c_numberng, c_process = '$c_process', c_checked = '$c_checked', c_inspectiondate = '$now'");
    }
}

if (!empty($_POST['puk'])) {
    foreach ($_POST['puk'] as $value) {
        $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultoloc SET c_serialnumber = '$c_serialnumber', c_code = '$value', c_numberng = $c_numberng, c_process = '$c_process', c_checked = '$c_checked', c_inspectiondate = '$now'");
    }
}

if (!empty($_POST['pb'])) {
    foreach ($_POST['pb'] as $value) {
        $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultoloc SET c_serialnumber = '$c_serialnumber', c_code = '$value', c_numberng = $c_numberng, c_process = '$c_process', c_checked = '$c_checked', c_inspectiondate = '$now'");
    }
}

if (!empty($_POST['pbb'])) {
    foreach ($_POST['pbb'] as $value) {
        $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultoloc SET c_serialnumber = '$c_serialnumber', c_code = '$value', c_numberng = $c_numberng, c_process = '$c_process', c_checked = '$c_checked', c_inspectiondate = '$now'");
    }
}


if ($pp1) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
mysqli_close($connect_pro);
