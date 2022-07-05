<?php
require '../_config/koneksi.php';
$id = $_POST['id'];
// $pass      = md5($_POST['pass']);
$pass = $_POST['pass'];
//query
$query  = "SELECT * FROM auth WHERE id='$id' AND pass='$pass'";
$result     = mysqli_query($conn, $query);
$row         = mysqli_fetch_array($result);

if (!empty($row)) {
    echo "oke";
    $_SESSION['id'] = $id;
    $_SESSION['nama'] = $cek_nama['nama'];
    $_SESSION['jabatan'] = $cek_nama['jabatan'];
    $_SESSION['dept'] = $cek_nama['dept'];
    $_SESSION['role'] = $cek_nama['role'];
    echo "<script>window.location='" . base_url() . "';</script>";
} else {
    echo "error";
}
