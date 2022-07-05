<?php
include('../../_config/koneksi.php');
if (isset($_POST['submit'])) {
    $safety_stock = $_POST['safety_stock'];
    mysqli_query($conn, "UPDATE prioritas SET safety_stock = '$safety_stock'");
    echo "<script>
    document.location.href = 'priority.php';
    ;</script>";
} else {
    echo "<script>
         document.location.href = 'priority.php';
         alert('data di hari weekend')
         ;</script>";
}
