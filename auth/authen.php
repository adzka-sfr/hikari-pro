<?php
require '../_config/koneksi.php';

$id = $_POST['id'];
$pass = $_POST['pass'];

//query
$query  = "SELECT * FROM auth WHERE id='$id' AND pass='$pass'";
$result     = mysqli_query($connect, $query);
$row         = mysqli_fetch_array($result);

if (!empty($row)) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['pass'] = $row['pass'];
    $_SESSION['role'] = strtolower($row['jabatan']);
    echo "oke";
} else {

    echo "error";
}
