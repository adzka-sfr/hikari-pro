<?php
// agar varibel null tertutup
// error_reporting(0);

include('../_config/koneksi.php');
$tanggal = $_POST['tanggal'];
$name_kabinet = $_POST['name_kabinet'];
if (isset($_POST['add'])) {
    // cek weekend
    $weekend = strtotime($tanggal);
    $day = date('l', $weekend);
    if ($day !== 'Saturday' && $day !== 'Sunday') {
        $query = mysqli_query($conn, "SELECT tanggal, name_kabinet FROM inventory WHERE AND tanggal = '$tanggal' AND name_kabinet = $name_kabinet");
        if ($query->num_rows > 0) {
            echo "<script>
         document.location.href = 'data.php';
         alert('data pada tanggal terpilih sudah terdaftar!')
         ;</script>";
        } else {
            $tanggal = $_POST['tanggal'];
            $name_kabinet = $_POST['name_kabinet'];
            $qty = $_POST['qty'];
            $qry = mysqli_query($conn, "SELECT * from model_kabinet_fixed WHERE name_kabinet = '$name_kabinet'");
            $ambil = mysqli_fetch_array($qry);
            echo $tanggal;
            echo '<br>';
            echo $name_kabinet;
            echo '<br>';
            echo $qty;
            echo '<br>';
            mysqli_query($conn, "DELETE FROM inventory WHERE name_kabinet = '$name_kabinet'");
            // mysqli_query($conn, "INSERT INTO inventory set update = '$tanggal', name_kabinet='$name_kabinet', name_ori_kabinet = '$ambil[name_ori_kabinet]', name_piano = '$ambil[name_piano]', destination = '$ambil[destination]', gmc = '$ambil[gmc]', qty='$qty'");
            // echo "<script>
            // document.location.href = 'data.php';
            // alert('data berhasil ditambah');</script>";
        }
    } else {
        echo "<script>
         document.location.href = 'data.php';
         alert('data di hari weekend')
         ;</script>";
    }
}
