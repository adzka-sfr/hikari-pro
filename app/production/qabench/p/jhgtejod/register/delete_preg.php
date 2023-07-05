<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();

$today = date('Y-m-d', strtotime($now));
$location = $_SESSION['role'];

$q1 = mysqli_query($connect_pro, "SELECT id FROM qa_preregister WHERE c_location = '$location'");
$d1 = mysqli_fetch_array($q1);
// cek apakah ada data pada pre-register untuk di lempar ke register (qa bench)
if (empty($d1)) {
    echo "tidak-ada-data";
} else {
    $sql = mysqli_query($connect_pro, "DELETE FROM qa_preregister WHERE c_location = '$location'");
    if ($sql) {
        echo "hapus-berhasil";
    } else {
        echo "server-busy";
    }
}
