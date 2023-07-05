<?php
session_start();
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$c_serialnumber = $_POST['serialnumber'];
$c_checked = $_SESSION['nama'];
$c_process = $_POST['process'];

// record cfs
if (!empty($_POST['usefs'])) {
    $c_usecfs = $_POST['usefs'];
    if (!empty($_POST['cfs'])) {
        $c_cfs = $_POST['cfs'];
        $tgl = date('Y-m-d H:i:s');
        $c_note = '';
        if (!empty($_POST['notecfs'])) {
            $c_note = $_POST['notecfs'];
        }
        // sql insert into
        if ($c_cfs == 'ng') {
            $sql = mysqli_query($connect_pro, "INSERT INTO formng_cfs SET c_serialnumber = '$c_serialnumber', c_ng = '$tgl', c_checker = '$c_checked', c_note = '$c_note'");
        } elseif ($c_cfs == 'ok') {
            $sql = mysqli_query($connect_pro, "INSERT INTO formng_cfs SET c_serialnumber = '$c_serialnumber', c_ok = '$tgl', c_checker = '$c_checked', c_note = '$c_note'");
        }
    }
}

// insert in repairdata
$pp1 = mysqli_query($connect_pro, "INSERT INTO formng_repairdata SET c_serialnumber = '$c_serialnumber', c_process = '$c_process', c_startprocess = '$now'");

if ($pp1) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($connect_pro);
