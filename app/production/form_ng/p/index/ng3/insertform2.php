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

# check already or not
$check_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$c_serialnumber' AND c_ng = '$c_ng'");
$check_data = mysqli_fetch_array($check_sql);

if (empty($check_data)) {
    // record cabinet
    foreach ($_POST['cab'] as $value) {
        $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultong SET c_serialnumber = '$c_serialnumber', c_numberng = '$c_numberng', c_ng = '$c_ng', c_cabinet = '$value', c_process = '$c_process', c_checker = '$c_checked', c_inspectiondate = '$now'");
    }

    // record location
    if (!empty($_POST['ftbo'])) {
        foreach ($_POST['ftbo'] as $value) {
            $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultoloc SET c_serialnumber = '$c_serialnumber', c_code = '$value', c_numberng = $c_numberng, c_process = '$c_process', c_checked = '$c_checked', c_inspectiondate = '$now'");
        }
    }
    if (!empty($_POST['ftbi'])) {
        foreach ($_POST['ftbi'] as $value) {
            $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultoloc SET c_serialnumber = '$c_serialnumber', c_code = '$value', c_numberng = $c_numberng, c_process = '$c_process', c_checked = '$c_checked', c_inspectiondate = '$now'");
        }
    }
    if (!empty($_POST['fuk'])) {
        foreach ($_POST['fuk'] as $value) {
            $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultoloc SET c_serialnumber = '$c_serialnumber', c_code = '$value', c_numberng = $c_numberng, c_process = '$c_process', c_checked = '$c_checked', c_inspectiondate = '$now'");
        }
    }
    if (!empty($_POST['fb'])) {
        foreach ($_POST['fb'] as $value) {
            $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultoloc SET c_serialnumber = '$c_serialnumber', c_code = '$value', c_numberng = $c_numberng, c_process = '$c_process', c_checked = '$c_checked', c_inspectiondate = '$now'");
        }
    }
    if (!empty($_POST['fbb'])) {
        foreach ($_POST['fbb'] as $value) {
            $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultoloc SET c_serialnumber = '$c_serialnumber', c_code = '$value', c_numberng = $c_numberng, c_process = '$c_process', c_checked = '$c_checked', c_inspectiondate = '$now'");
        }
    }
    if ($pp1) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
} else {
    echo json_encode(array("statusCode" => 203));
}





mysqli_close($connect_pro);
