<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));
$yesterday = date('Y-m-d', strtotime("-1day", strtotime($now)));

$c_approval = $_SESSION['nama'];
$id = $_POST['id'];
$c_status = $_POST['status'];
$c_message = $_POST['message'];
$c_fitur = $_POST['namafitur'];
$c_location = $_POST['location'];

// jika sudah aktif hapus message
if ($c_status == 1) {
    // $c_message = "";
    $logstatus = "ON";
} else {
    $logstatus = "OFF";
}

$sql = mysqli_query($connect_pro, "UPDATE qa_fitur SET c_status = $c_status, c_updated = '$now', c_approval = '$c_approval', c_message = '$c_message' WHERE id = '$id'");

if ($sql) {
    $sql_log = mysqli_query($connect_pro, "INSERT INTO qa_fitur_log SET c_fitur = '$c_fitur',c_status = '$logstatus', c_time = '$now', c_approval = '$c_approval', c_message = '$c_message', c_location = '$c_location'");
    echo "sukses";
} else {
    echo "error";
}
