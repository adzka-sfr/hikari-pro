<?php
require '../../../../../../_config/koneksi.php';

$old_pass = $_POST['old_pass'];
$new_pass = $_POST['new_pass'];

//query
$query  = "SELECT * FROM auth WHERE id='$_SESSION[id]' AND pass='$old_pass'";
$result     = mysqli_query($connect, $query);
$row         = mysqli_fetch_array($result);

if (!empty($row)) {
    echo "oke";
    mysqli_query($connect, "UPDATE auth set pass = '$new_pass' where id = '$_SESSION[id]'");
} else {

    echo "error";
}
