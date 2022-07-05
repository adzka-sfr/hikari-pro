<?php
// agar varibel null tertutup
// error_reporting(0);

include('../../_config/koneksi.php');
$tanggal = $_POST['tanggal'];
if (isset($_POST['tambah'])) {
    // cek weekend
    $weekend = strtotime($tanggal);
    $day = date('l', $weekend);
    if ($day !== 'Saturday' && $day !== 'Sunday') {
        // ubah ke format date for search tanggal
        $dt = new DateTime($tanggal);
        $format_tanggal = $dt->format('Y-m-d H:i:s');
        $format_tanggal_pendek = $dt->format('Y-m-d');
        $name_kabinet = $_POST['name_kabinet'];
        $qty = $_POST['qty'];
        // input inventory acc
        if ($name_kabinet == "") {
            echo "<script>
            document.location.href = 'data.php';
            alert('Failed! Please select cabinet');</script>";
        } else {
            $qry = mysqli_query($conn, "SELECT p.name_cabinet,p.name_piano,p.name_ori_cabinet, p.gmc_c, p.dest, p.qtyperunit as ratio, i.pcs FROM inventory_fix i JOIN bd_piano_fix p ON p.gmc_c = i.gmc_c WHERE p.name_cabinet = '$name_kabinet'");
            $ambil = mysqli_fetch_array($qry);
            $pcs_baru = $ambil['pcs'] + $qty;
            mysqli_query($conn, "UPDATE inventory_fix SET tanggal = '$format_tanggal_pendek', updated = '$format_tanggal', pcs = $pcs_baru WHERE gmc_c = '$ambil[gmc_c]'");
            // input data inventory_hist
            mysqli_query($conn, "INSERT INTO inventory_hist set tanggal = '$format_tanggal_pendek', name_piano = '$ambil[name_piano]', name_ori_cabinet = '$ambil[name_ori_cabinet]', dest = '$ambil[dest]', name_cabinet = '$ambil[name_cabinet]', gmc_c = '$ambil[gmc_c]', updated = '$format_tanggal', pcs = $qty");

            // input ke prioritas | karena qty actual sudah dikurangi dengan CO maka harus buat sendiri lagi  qry nya
            $qryy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$ambil[gmc_c]'");
            while ($ambill = mysqli_fetch_array($qryy)) {
                $tambah_qtyy = $ambill['pcs_inventory'] + $qty;
                mysqli_query($conn, "UPDATE prioritas SET pcs_inventory = '$tambah_qtyy' WHERE gmc_c = '$ambil[gmc_c]'");
            }
            // update qty_prioritas
            $qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$ambil[gmc_c]'");
            while ($ambilll = mysqli_fetch_array($qryyy)) {
                $qty_prior = $ambilll['pcs_inventory'] - $ambilll['pcs_plan'];
                mysqli_query($conn, "UPDATE prioritas SET pcs_prioritas = '$qty_prior' WHERE gmc_c = '$ambil[gmc_c]'");
            }
            echo "<script>
            document.location.href = 'data.php';
            alert('data berhasil diinput');</script>";
        }
    }
} else {
    echo "<script>
         document.location.href = 'data.php';
         alert('data di hari weekend')
         ;</script>";
}
