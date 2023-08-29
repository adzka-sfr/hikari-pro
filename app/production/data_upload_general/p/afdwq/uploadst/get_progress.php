<?php
$connect = new PDO("mysql:host=localhost;dbname=hikari_project;charset=UTF8", "root", "");

// get tanggal maksimal pada data_upload_general_log
$q = $connect->query("SELECT MAX(c_date) as waktu FROM data_upload_general_log");
$d = $q->fetch();
$waktu = $d['waktu'];

$q2 = $connect->query("SELECT c_banyak_data, c_file FROM data_upload_general_log WHERE c_date = '$waktu'");
$d2 = $q2->fetch();
$total = $d2['c_banyak_data'];
$filename = $d2['c_file'];
// get progress
$q1 = $connect->query("SELECT COUNT(id) as total FROM qa_bench WHERE c_created = '$waktu'");
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

echo json_encode(array("persen" => $persen, "progress" => $progress, "total" => $total, "waktu" => $waktu));
