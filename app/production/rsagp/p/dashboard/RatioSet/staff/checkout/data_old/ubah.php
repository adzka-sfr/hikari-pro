<?php
include('../_config/koneksi.php');

$id = $_GET['id_plan'];
$qty = $_GET['qty'];

//query update
$query = "UPDATE planing SET qty='$qty' WHERE id_plan='$id'";
mysqli_query($conn, $query);
mysqli_affected_rows($conn);

echo "<script>
document.location.href = 'plan.php';
alert('update success');</script>";
