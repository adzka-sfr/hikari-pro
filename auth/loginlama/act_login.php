<?php
include '../_config/koneksi.php';

$id     = $_POST['id'];
$pass      = md5($_POST['pass']);
// $password      = $_POST['password'];

//query
$query  = "SELECT * FROM auth WHERE id='$id' AND pass='$pass'";
$result     = mysqli_query($conn, $query);
// $num_row     = mysqli_num_rows($result);
$row         = mysqli_fetch_array($result);

if (!empty($row)) {
    echo "success";
    $_SESSION['status']       = "$row[nama]";
    // $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
    // $_SESSION['username']       = $row['username'];
} else {

    echo "error";
}
