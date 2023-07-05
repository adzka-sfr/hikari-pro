<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();

$today = date('Y-m-d', strtotime($now));
// data
$location = $_SESSION['role'];

// cek dulu apakah ada isi
$q1 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) AS isi FROM qa_staking_pre_pre WHERE c_location = '$location'");
$d1 = mysqli_fetch_array($q1);

if ($d1['isi'] == 0) {
    // echo "kosong-blok";
    echo json_encode(array("status" => "kosong-blok"));
} else {
    $q2 = mysqli_query($connect_pro, "SELECT * FROM qa_staking_pre_pre WHERE c_location = '$location'");
    while ($d2 = mysqli_fetch_array($q2)) {
        $sql = mysqli_query($connect_pro, "INSERT INTO qa_count_staking SET c_type = '$d2[c_type]', c_gmc = '$d2[c_gmc]', c_serialnumber = '$d2[c_serialnumber]', c_name = '$d2[c_name]', c_staking_date = '$d2[c_staking_date]', c_location = '$d2[c_location]'");
    }
    if ($sql) {
        $sql1 = mysqli_query($connect_pro, "DELETE FROM qa_staking_pre_pre");
    }
    if ($sql1) {
        // echo "record-berhasil";
        echo json_encode(array("status" => "record-berhasil"));
    }
}
