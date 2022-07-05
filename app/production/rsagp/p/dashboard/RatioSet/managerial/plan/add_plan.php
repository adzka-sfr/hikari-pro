<?php
// agar varibel null tertutup
error_reporting(0);

include('../../_config/koneksi.php');
$tanggal = $_POST['tanggal'];
if (isset($_POST['add'])) {
    // cek weekend
    $weekend = strtotime($tanggal);
    $name_piano = $_POST['name_piano'];
    $day = date('l', $weekend);
    if ($day !== 'Saturday' && $day !== 'Sunday') {
        $query = mysqli_query($conn, "SELECT tanggal, name_piano FROM planing WHERE tanggal = '$tanggal' AND name_piano = '$name_piano'");
        if ($query->num_rows > 0) {
            echo "<script>
         document.location.href = 'plan.php';
         alert('tanggal sudah terdaftar')
         ;</script>";
        } else {
            $tanggal = $_POST['tanggal'];
            // $name_piano = $_POST['name_piano'];
            $qty = $_POST['qty'];
            $data_masuk = mysqli_query($conn, "INSERT INTO planing set tanggal = '$tanggal', name_piano='$name_piano', qty='$qty'");
            // input plan 
            $qryy = mysqli_query($conn, "SELECT b.name_cabinet as name_cabinet, b.name_piano, b.qtyperunit as qtyperunit, b.pcs_plan FROM inventory_fix a INNER JOIN prioritas b ON a.gmc_c = b.gmc_c WHERE b.name_piano = '$name_piano'");
            while ($ambill = mysqli_fetch_array($qryy)) {
                $tambah_qtyy = $ambill['pcs_plan'] + ($qty * $ambill['qtyperunit']);
                mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$tambah_qtyy' WHERE name_cabinet = '$ambill[name_cabinet]' AND name_piano = '$name_piano'");
            }
            // update qty_prioritas
            $qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE name_piano = '$name_piano'");
            while ($ambilll = mysqli_fetch_array($qryyy)) {
                $qty_prior = $ambilll['pcs_inventory'] - $ambilll['pcs_plan'];
                mysqli_query($conn, "UPDATE prioritas SET pcs_prioritas = '$qty_prior' WHERE name_cabinet = '$ambilll[name_cabinet]' AND name_piano = '$name_piano'");
            }
            echo "<script>
            document.location.href = 'plan.php';
            alert('data berhasil ditambah');</script>";
        }
    } else {
        echo "<script>
         document.location.href = 'plan.php';
         alert('data di hari weekend')
         ;</script>";
    }
}
