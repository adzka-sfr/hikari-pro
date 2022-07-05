<?php
include('../_config/koneksi.php');

$id = $_GET['id_inventory_hist'];
$qty = $_GET['qty'];
$name_kabinet = $_GET['name_kabinet'];


//query update in inventory_hist
if ($qty == 0) {
    mysqli_query($conn, "DELETE FROM inventory_hist WHERE id_inventory_hist = '$id'") or die(mysqli_error($conn));
} else {
    mysqli_query($conn, "UPDATE inventory_hist SET qty='$qty', updated = NOW() WHERE id_inventory_hist='$id'");
}
// query update in inventory
$qry = mysqli_query($conn, "SELECT * FROM inventory WHERE name_kabinet = '$name_kabinet'");
$row = mysqli_fetch_array($qry);


$qryhist = mysqli_query($conn, "SELECT name_kabinet, SUM(qty) as qty FROM inventory_hist WHERE name_kabinet = '$name_kabinet' GROUP BY gmc");
$rowhist = mysqli_fetch_array($qryhist);
if ($row['qty'] != $rowhist['qty']) {
    mysqli_query($conn, "UPDATE inventory SET qty = '$rowhist[qty]' WHERE name_kabinet = '$name_kabinet'");
}


echo "<script>
document.location.href = 'data.php';
alert('update success');</script>";
