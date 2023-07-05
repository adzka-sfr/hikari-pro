<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));
$yesterday = date('Y-m-d', strtotime("-1day", strtotime($now)));
$pic = $_SESSION['nama'];

// data lemparan
$userp = $_POST['gmc'];
$seq = $_POST['seq'];
$printtime = $_POST['printtime'];
$printtime = date('Y-m-d H:i:s', strtotime($printtime));

$waktu = date('ymd', strtotime($printtime));

// ambil seq sesuai digit
$no_urut = $seq;
if ($no_urut < 10) {
    $no_urut = "00" . $no_urut;
} elseif ($no_urut < 100) {
    $no_urut = "0" . $no_urut;
} elseif ($no_urut < 1000) {
    $no_urut = "" . $no_urut;
}

// pecah nama bench dengan gmc
$gmc = substr($userp, 1, 7);
$namauserp = substr($userp, 10);

// rakit
$serial = "S" . $waktu  . $no_urut;

// insert into qa_userp
$sql = mysqli_query($connect_pro, "INSERT INTO qa_userp SET c_gmc = '$gmc', c_serialuserp = '$serial', c_name = '$namauserp', c_created = '$printtime'");
// insert log
$adjustlog = mysqli_query($connect_pro, "INSERT INTO qa_adjustlog SET c_action = 'add', c_pic = '$pic', c_serialnumber = '$serial', c_type = 'userpackage',  c_date = '$now'");

if ($sql) {
    echo "data-masuk";
} else {
    echo "error";
}
