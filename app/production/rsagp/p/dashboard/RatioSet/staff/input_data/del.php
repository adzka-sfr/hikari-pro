<?php
include('../../_config/koneksi.php');
$no = $_GET['id_inventory_hist'];

// update from inventory_hist
$qry = mysqli_query($conn, "SELECT * FROM inventory_hist WHERE id_inventory_hist = '$no'");
$qryhist = mysqli_fetch_array($qry);
mysqli_query($conn, "DELETE FROM inventory_hist WHERE id_inventory_hist = '$no'") or die(mysqli_error($conn));

// update from inventory
$qryinvenn = mysqli_query($conn, "SELECT p.name_cabinet, i.gmc_c,p.gmc_c, p.dest, i.pcs FROM inventory_fix i JOIN bd_piano_fix p ON p.gmc_c = i.gmc_c WHERE p.name_cabinet = '$qryhist[name_cabinet]' ");
$qryinven = mysqli_fetch_array($qryinvenn);
$sisa =  $qryinven['pcs'] - $qryhist['pcs'];

if ($sisa == 0) {
    mysqli_query($conn, "UPDATE inventory_fix SET pcs = 0, updated = '0000-00-00 00:00:00', tanggal = NULL WHERE gmc_c = '$qryhist[gmc_c]' ") or die(mysqli_error($conn));
} else {
    mysqli_query($conn, "UPDATE inventory_fix SET pcs = '$sisa' WHERE gmc_c ='$qryhist[gmc_c]'") or die(mysqli_error($conn));
}
// input ke prioritas
// input ke prioritas | karena qty actual sudah dikurangi dengan CO maka harus buat sendiri lagi  qry nya
$qryy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$qryhist[gmc_c]'");
$ambill = mysqli_fetch_array($qryy);
$sisaa =  $ambill['pcs_inventory'] - $qryhist['pcs'];
if ($sisaa == 0) {
    $qryy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$qryhist[gmc_c]'");
    while ($ambill = mysqli_fetch_array($qryy)) {
        mysqli_query($conn, "UPDATE prioritas SET pcs_inventory = 0 WHERE gmc_c = '$qryhist[gmc_c]'");
    }
    // update qty_prioritas
    $qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$qryhist[gmc_c]'");
    while ($ambilll = mysqli_fetch_array($qryyy)) {
        $qty_prior = $ambilll['pcs_inventory'] - $ambilll['pcs_plan'];
        mysqli_query($conn, "UPDATE prioritas SET pcs_prioritas = '$qty_prior' WHERE gmc_c = '$qryhist[gmc_c]'");
    }
} else {
    $qryy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$qryhist[gmc_c]'");
    while ($ambill = mysqli_fetch_array($qryy)) {
        mysqli_query($conn, "UPDATE prioritas SET pcs_inventory = '$sisaa' WHERE gmc_c = '$qryhist[gmc_c]'");
    }
    // update qty_prioritas
    $qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$qryhist[gmc_c]'");
    while ($ambilll = mysqli_fetch_array($qryyy)) {
        $qty_prior = $ambilll['pcs_inventory'] - $ambilll['pcs_plan'];
        mysqli_query($conn, "UPDATE prioritas SET pcs_prioritas = '$qty_prior' WHERE gmc_c = '$qryhist[gmc_c]'");
    }
}

echo "<script>
document.location.href = 'data.php';
alert('delete success');</script>";
