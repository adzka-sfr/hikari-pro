<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');
$now = '2022-11-01';
$kalender = CAL_GREGORIAN;
$bulan = date('m', strtotime($now));
$tahun = date('Y', strtotime($now));
$bulan_sutena = date('F', strtotime($now));

$hari = cal_days_in_month($kalender, $bulan, $tahun);

if ($_GET['p'] == 'db') {
    include "dashboard.php";
} elseif ($_GET['p'] == 'pu') {
    include "planup.php";
} elseif ($_GET['p'] == 'pg') {
    include "plangp.php";
} else {
    include "create_slip/create_slip.php";
}
