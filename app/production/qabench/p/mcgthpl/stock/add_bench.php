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
$bench = $_POST['gmc'];
$seq = $_POST['seq'];
$printtime = $_POST['printtime'];
$printtime = date('Y-m-d H:i:s', strtotime($printtime));

$year = date('y', strtotime($printtime));
$bln = date('m', strtotime($printtime));

// get month code
if ($bln == '01') {
    $monthcode = 'A';
} elseif ($bln == '02') {
    $monthcode = 'B';
} elseif ($bln == '03') {
    $monthcode = 'C';
} elseif ($bln == '04') {
    $monthcode = 'D';
} elseif ($bln == '05') {
    $monthcode = 'E';
} elseif ($bln == '06') {
    $monthcode = 'F';
} elseif ($bln == '07') {
    $monthcode = 'G';
} elseif ($bln == '03') {
    $monthcode = 'H';
} elseif ($bln == '09') {
    $monthcode = 'I';
} elseif ($bln == '10') {
    $monthcode = 'J';
} elseif ($bln == '11') {
    $monthcode = 'K';
} elseif ($bln == '12') {
    $monthcode = 'L';
}

// pecah nama bench dengan gmc
$gmc = substr($bench, 1, 7);
$namabench = substr($bench, 10);

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
$serial = $gmc . $year . $monthcode . $no_urut;

// insert into qa_bench
$sql = mysqli_query($connect_pro, "INSERT INTO qa_bench SET c_gmc = '$gmc', c_serialbench = '$serial', c_name = '$namabench', c_created = '$printtime'");

// insert log
$adjustlog = mysqli_query($connect_pro, "INSERT INTO qa_adjustlog SET c_action = 'add', c_pic = '$pic', c_serialnumber = '$serial', c_type = 'bench',  c_date = '$now'");

if ($sql) {
    echo "data-masuk";
} else {
    echo "error";
}
