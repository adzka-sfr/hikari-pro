<?php
include('../../_config/koneksi.php');

// menangkap data id yang di kirim dari url
$no = $_GET['id_plan'];
$qry = mysqli_query($conn, "SELECT * FROM planing WHERE id_plan = '$no'");
$qryhist = mysqli_fetch_array($qry);
// selisih checkout tertinggi dengan qty plan awal
$selisih = $qryhist['qty'] - $qryhist['qtyCoUp'];
// ada barang yang dicheckout
if ($qryhist['qtyCoUp'] > 0) {
    if ($selisih == 0) {
        echo "<script>
        document.location.href = 'plan.php';
        alert('Sorry! delete is failed. Because inventory has checkout');</script>";
    } else {
        $qtybaru = $qryhist['qty'] - $selisih;
        mysqli_query($conn, "UPDATE planing SET qty = '$qtybaru' WHERE id_plan = '$no'");
        // kurangi/hapus dari qty_plan prioritas
        // input ke prioritas | karena qty actual sudah dikurangi dengan CO maka harus buat sendiri lagi  qry nya
        $name_piano = $qryhist['name_piano'];

        $qryplan = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan, gmc_c FROM prioritas where name_piano = '$name_piano'");
        while ($ambilplan = mysqli_fetch_array($qryplan)) {
            $unitToPcs = $selisih * $ambilplan['qtyperunit'];
            $update_pcs_plan = $ambilplan['pcs_plan'] - $unitToPcs;
            mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$update_pcs_plan' WHERE name_cabinet = '$ambilplan[name_cabinet]' AND name_piano = '$name_piano'");
        }

        // update qty_prioritas
        $qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE name_piano = '$name_piano'");
        while ($ambilll = mysqli_fetch_array($qryyy)) {
            $qty_prior = $ambilll['pcs_inventory'] - $ambilll['pcs_plan'];
            mysqli_query($conn, "UPDATE prioritas SET pcs_prioritas = '$qty_prior' WHERE name_cabinet = '$ambilll[name_cabinet]' AND name_piano = '$name_piano'");
        }
        echo "<script>
        document.location.href = 'plan.php';
        alert('delete success');</script>";
    }
} elseif ($qryhist['qtyCoUp'] < 0) {
    // checkout sudah melebihi qty plan, asumsi ada barang keluar melebihi plan, tetap tidak bisa dihapus, untuk menjaga data prioritas
    echo "<script>
    document.location.href = 'plan.php';
    alert('Sorry! delete is failed. Because checkout is already over planned');</script>";
} else {
    // belum ada checkout, bisa langsung di hapus
    mysqli_query($conn, "DELETE from planing WHERE id_plan = '$no'") or die(mysqli_error($conn));
    // kurangi/hapus dari qty_plan prioritas
    // input ke prioritas | karena qty actual sudah dikurangi dengan CO maka harus buat sendiri lagi  qry nya
    $name_piano = $qryhist['name_piano'];

    $qryplan = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan, gmc_c FROM prioritas where name_piano = '$name_piano'");
    while ($ambilplan = mysqli_fetch_array($qryplan)) {
        $unitToPcs = $qryhist['qty'] * $ambilplan['qtyperunit'];
        $update_pcs_plan = $ambilplan['pcs_plan'] - $unitToPcs;
        mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$update_pcs_plan' WHERE name_cabinet = '$ambilplan[name_cabinet]' AND name_piano = '$name_piano'");
    }
    // update qty_prioritas
    $qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE name_piano = '$name_piano'");
    while ($ambilll = mysqli_fetch_array($qryyy)) {
        $qty_prior = $ambilll['pcs_inventory'] - $ambilll['pcs_plan'];
        mysqli_query($conn, "UPDATE prioritas SET pcs_prioritas = '$qty_prior' WHERE name_cabinet = '$ambilll[name_cabinet]' AND name_piano = '$name_piano'");
    }

    echo "<script>
        document.location.href = 'plan.php';
        alert('delete success');</script>";
}
