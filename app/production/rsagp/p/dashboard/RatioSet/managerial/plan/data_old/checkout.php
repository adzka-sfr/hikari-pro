<?php
include('../_config/koneksi.php');

$id = $_GET['id_plan'];
$qtyco = $_GET['qtyco'];

//query update
$query = "UPDATE planing SET update_co = NOW(), qtyco='$qtyco' WHERE id_plan='$id'";
mysqli_query($conn, $query);
mysqli_affected_rows($conn);

echo "<script>
document.location.href = 'plan.php';
alert('update success');</script>";
