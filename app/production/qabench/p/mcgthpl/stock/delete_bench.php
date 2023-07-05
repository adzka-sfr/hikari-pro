<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));
$yesterday = date('Y-m-d', strtotime("-1day", strtotime($now)));

// data lemparan
$serial = $_POST['serial'];
$pic = $_SESSION['nama'];
$note = $_POST['note'];

// get data to input to log
$q1 = mysqli_query($connect_pro, "SELECT * FROM qa_bench WHERE c_serialbench = '$serial'");
$d1 = mysqli_fetch_array($q1);

// add to log
$deletelog = mysqli_query($connect_pro, "INSERT INTO qa_adjustlog SET c_action = 'delete', c_pic = '$pic', c_serialnumber = '$serial', c_type = 'bench', c_location = '$d1[c_location]', c_date = '$now', c_note = '$note'");

if ($deletelog) {
    $sql = mysqli_query($connect_pro, "DELETE FROM qa_bench WHERE c_serialbench = '$serial'");
}


if ($sql) {
    echo "data-telah-dihapus";
} else {
    echo "error";
}
