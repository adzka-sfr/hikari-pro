<?php
$connect = new PDO("mysql:host=localhost;dbname=hikari_project;charset=UTF8", "root", "");

// get tanggal maksimal pada manpow_st_ongoing
$q = $connect->query("SELECT MAX(c_date) as waktu, c_banyak_data, c_file FROM manpow_st_ongoing");
$d = $q->fetch();
$waktu = $d['waktu'];
$total = $d['c_banyak_data'];
$filename = $d['c_file'];

// get progress
$q1 = $connect->query("SELECT COUNT(id) as total FROM manpow_st WHERE c_date = '$waktu'");
$d1 = $q1->fetch();
$progress = $d1['total'];

// get percentage
if ($total == 0) {
    $persen = 0;
    $total = 0;
} else {
    $persen = ($progress / $total) * 100;
    $persen = number_format($persen, 2, '.', '');
}

echo json_encode(array("persen" => $persen, "progress" => $progress, "total" => $total));
