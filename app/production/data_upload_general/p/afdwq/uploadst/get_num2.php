<?php
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$today = date('Y-m-d');

$connect_cok = new mysqli("localhost", "root", "", "hikari_project");

$wq = mysqli_query($connect_cok, "SELECT c_banyak_data, c_date FROM manpow_st_ongoing");
$wd = mysqli_fetch_array($wq);
$maxdate = $wd['c_date'];

$q = mysqli_query($connect_cok, "SELECT COUNT(id) as total FROM manpow_st WHERE c_date >= '$maxdate'");
$d = mysqli_fetch_array($q);

$persen = ($d['total'] / $wd['c_banyak_data']) * 100;
$persen = number_format($persen, 2, '.', '');

echo json_encode(array("persen" => $persen, "progress" => $d['total'], "total" => $wd['c_banyak_data']));
