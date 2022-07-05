<?php
// agar varibel null tertutup
// error_reporting(0);

include('../_config/koneksi.php');
$tanggal = $_POST['tanggal'];
if (isset($_POST['add'])) {
    // cek weekend
    $weekend = strtotime($tanggal);
    $day = date('l', $weekend);
    if ($day !== 'Saturday' && $day !== 'Sunday') {
        $query = mysqli_query($conn, "SELECT tanggal, piano_name FROM planing WHERE AND tanggal = '$tanggal' AND piano_name = $piano_name");
        if ($query->num_rows > 0) {
            echo "<script>
         document.location.href = 'plan.php';
         alert('tanggal sudah terdaftar')
         ;</script>";
        } else {
            $tanggal = $_POST['tanggal'];
            $name_piano = $_POST['name_piano'];
            $qty = $_POST['qty'];
            $data_masuk = mysqli_query($conn, "INSERT INTO planing set tanggal = '$tanggal', name_piano='$name_piano', qty='$qty'");
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
