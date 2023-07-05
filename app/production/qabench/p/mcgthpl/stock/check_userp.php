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
$userp = $_POST['gmc'];
$seq = $_POST['seq'];
$printtime = $_POST['printtime'];
$printtime = date('Y-m-d H:i:s', strtotime($printtime));

$waktu = date('ymd', strtotime($printtime));

// ambil seq sesuai digit
$no_urut = $seq;
if ($no_urut < 10) {
    $no_urut = "000" . $no_urut;
} elseif ($no_urut < 100) {
    $no_urut = "00" . $no_urut;
} elseif ($no_urut < 1000) {
    $no_urut = "0" . $no_urut;
}

// rakit
$serial = "S" . $waktu  . $no_urut;

// cek apakah no seri yang di generate sudah ada ?
$sql = mysqli_query($connect_pro, "SELECT COUNT(c_serialuserp) AS jumlah FROM qa_userp WHERE c_serialuserp = '$serial'");
$data = mysqli_fetch_array($sql);

if ($data['jumlah'] == 0) {
    echo "belum-ada";
} else if ($data['jumlah'] > 0) {
    echo "sudah-ada";
} else {
    echo "error";
}
