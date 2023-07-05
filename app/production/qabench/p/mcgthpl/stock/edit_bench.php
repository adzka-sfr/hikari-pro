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
$pic = $_SESSION['nama'];
$serial = $_POST['serial'];
$registdate = $_POST['registdate'];
$packdate = $_POST['packdate'];
$location = $_POST['location'];
$note = $_POST['note'];

// Update untuk kolom c_used
if ($registdate != '') {
    $registdate = date('Y-m-d H:i:s', strtotime($registdate));

    $sql = mysqli_query($connect_pro, "UPDATE qa_bench SET c_used = '$registdate', c_location = '$location', c_note = '$note' where  c_serialbench  ='$serial' ");
} else {
    $sql = mysqli_query($connect_pro, "UPDATE qa_bench SET c_used = null , c_location = '$location', c_note = '$note' where  c_serialbench  ='$serial' ");
}

// update untuk c_packed 
if ($packdate != '') {
    $packdate = date('Y-m-d H:i:s', strtotime($packdate));

    $sql = mysqli_query($connect_pro, "UPDATE qa_bench SET c_packed = '$packdate', c_location = '$location', c_note = '$note' where  c_serialbench  ='$serial' ");
} else {
    $sql = mysqli_query($connect_pro, "UPDATE qa_bench SET c_packed = null, c_location = '$location', c_note = '$note' where  c_serialbench  ='$serial' ");
}

if ($sql) {
    $adjustlog = mysqli_query($connect_pro, "INSERT INTO qa_adjustlog SET c_action = 'edit', c_pic = '$pic', c_serialnumber = '$serial', c_type = 'bench', c_location = '$location', c_date = '$now', c_note = '$note'");
    echo "data-telah-diedit";
} else {
    echo "error";
}
