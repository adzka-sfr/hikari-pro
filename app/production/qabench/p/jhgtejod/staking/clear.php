<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$location = $_SESSION['role'];

$today = date('Y-m-d', strtotime($now));

$q1 = mysqli_query($connect_pro, "SELECT COUNT(id) as isi FROM qa_staking_pre_pre WHERE c_location = '$location'");
$d1 = mysqli_fetch_array($q1);
// cek apakah ada data pada pre-register untuk di lempar ke register (qa bench)
if ($d1['isi'] == 0) {
    // echo "kosong-blok";
    echo json_encode(array("status" => "kosong-blok"));
} else {
    $sql = mysqli_query($connect_pro, "DELETE FROM qa_staking_pre_pre WHERE c_location = '$location'");
    if ($sql) {
        // echo "clear-berhasil";
        echo json_encode(array("status" => "clear-berhasil"));
    } else {
        // echo "server-busy";
        echo json_encode(array("status" => "server-busy"));
    }
}
