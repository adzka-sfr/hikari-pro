<?php
include '../koneksi.php';

$nama = md5("yi_ma");
$pass = md5("masterkabinet");

$cek = mysqli_query($conn, "SELECT * from authen where name = '$nama'");
$data = mysqli_fetch_array($cek);
if (empty($data)) {
    mysqli_query($conn, "INSERT into authen set name = '$nama', pass = '$pass'");
} else {
    echo "data sudah ada";
}
