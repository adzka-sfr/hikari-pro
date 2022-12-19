<?php
session_start();

// setting default timezone
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$now = date('Y-m-d', strtotime($now));

$servername = "localhost";
$username = "root";
$password = "";

// database
$db1 = "hikari";
$db2 = "hikari_project";
$db3 = "hikari_log";

// Create connection for main database (hikari)
$connect = new mysqli($servername, $username, $password, $db1);
// Create connection for project database (hikari_project)
$connect_pro = new mysqli($servername, $username, $password, $db2);
// Create connection for log database (hikari_log)
$connect_log = new mysqli($servername, $username, $password, $db3);

// $now = date('Y-m-d');
// $now = '2022-11-30';
$month_umpama = date('Y-m', strtotime($now));
$month_judul = date('F', strtotime($now));

// untuk mendapatakan jumlah hari pada satu bulan
$kalenderMasehi = CAL_GREGORIAN;
$bulanSutena = date('m', strtotime($now));
$tahunGajah = date('Y', strtotime($now));
$sumOfDay = cal_days_in_month($kalenderMasehi, $bulanSutena, $tahunGajah);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (empty($_SESSION['antrian'])) {
    $_SESSION['antrian'] = "1";
} else {
    if ($_SESSION['antrian'] == "1") {
        include 'assy.php';
        // include 'woodworking.php';
        // echo $_SESSION['antrian'];
        // echo "</br>";
        $_SESSION['antrian'] = "2";
    } elseif ($_SESSION['antrian'] == "2") {
        include 'assy.php';
        // include 'painting.php';
        // echo $_SESSION['antrian'];
        // echo "</br>";
        $_SESSION['antrian'] = "3";
    } elseif ($_SESSION['antrian'] == "3") {
        include 'assy.php';
        // echo $_SESSION['antrian'];
        // echo "</br>";
        $_SESSION['antrian'] = "1";
    }
}
