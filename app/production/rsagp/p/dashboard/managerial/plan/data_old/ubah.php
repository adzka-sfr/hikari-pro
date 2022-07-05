<?php
include('../_config/koneksi.php');

$id = $_GET['id_plan'];
$qty = $_GET['qty'];
$name_piano = $_GET['name_piano'];

//query update

$qryambil = mysqli_query($conn, "SELECT * FROM planing WHERE id_plan = '$id'");
$ambiltok = mysqli_fetch_array($qryambil);
$selisih = $qty - $ambiltok['qty'];
// echo $selisih;
if ($selisih < 0) {
    // update db plan
    mysqli_query($conn, "UPDATE planing SET qty='$qty' WHERE id_plan='$id'");
    $a = abs($selisih);
    // update db priority
    $qryy = mysqli_query($conn, "SELECT a.name_piano as name_piano, a.name_kabinet as name_kabinet, a.qty_plan as qty_plan, a.qty_prioritas as qty_prioritas, a.qty_inventory as qty_inventory, a.gmc as gmc FROM prioritas a INNER JOIN model_kabinet_fixed b ON a.gmc = b.gmc where b.name_piano = '$name_piano'");
    while ($ambill = mysqli_fetch_array($qryy)) {
        $tambah_qtyy = $ambill['qty_plan'] - $a;
        mysqli_query($conn, "UPDATE prioritas SET qty_plan = '$tambah_qtyy' WHERE gmc = '$ambill[gmc]'");
    }
    // update qty_prioritas
    $qryyy = mysqli_query($conn, "SELECT a.name_piano as name_piano, a.name_kabinet as name_kabinet, a.qty_plan as qty_plan, a.qty_prioritas as qty_prioritas, a.qty_inventory as qty_inventory, a.gmc as gmc FROM prioritas a INNER JOIN model_kabinet_fixed b ON a.gmc = b.gmc where b.name_piano = '$name_piano'");
    while ($ambilll = mysqli_fetch_array($qryyy)) {
        $qty_prior = $ambilll['qty_inventory'] - $ambilll['qty_plan'];
        mysqli_query($conn, "UPDATE prioritas SET qty_prioritas = '$qty_prior' where gmc = '$ambilll[gmc]'");
    }
} elseif ($selisih > 0) {
    // update db plan
    mysqli_query($conn, "UPDATE planing SET qty='$qty' WHERE id_plan='$id'");
    // update db priority
    $qryyy = mysqli_query($conn, "SELECT a.name_piano as name_piano, a.name_kabinet as name_kabinet, a.qty_plan as qty_plan, a.qty_prioritas as qty_prioritas, a.qty_inventory as qty_inventory, a.gmc as gmc FROM prioritas a INNER JOIN model_kabinet_fixed b ON a.gmc = b.gmc where b.name_piano = '$name_piano'");
    while ($ambill1 = mysqli_fetch_array($qryyy)) {
        $tambah_qtyyy = $ambill1['qty_plan'] + $selisih;
        mysqli_query($conn, "UPDATE prioritas SET qty_plan = '$tambah_qtyyy' WHERE gmc = '$ambill1[gmc]'");
    }
    // update qty_prioritas
    $qryyy1 = mysqli_query($conn, "SELECT a.name_piano as name_piano, a.name_kabinet as name_kabinet, a.qty_plan as qty_plan, a.qty_prioritas as qty_prioritas, a.qty_inventory as qty_inventory, a.gmc as gmc FROM prioritas a INNER JOIN model_kabinet_fixed b ON a.gmc = b.gmc where b.name_piano = '$name_piano'");
    while ($ambilll3 = mysqli_fetch_array($qryyy1)) {
        $qty_prior2 = $ambilll3['qty_inventory'] - $ambilll3['qty_plan'];
        mysqli_query($conn, "UPDATE prioritas SET qty_prioritas = '$qty_prior2' where gmc = '$ambilll3[gmc]'");
    }
}

if ($qty == 0) {
    mysqli_query($conn, "DELETE FROM `planing`WHERE id_plan='$id'");
}

echo "<script>
document.location.href = 'plan.php';
alert('update success');</script>";
