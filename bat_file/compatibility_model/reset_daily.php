<?php
include 'koneksi.php';
$tanggal = date('Y-m-d');
mysqli_query($connect, "UPDATE act_daily SET tanggal = '$tanggal', b450 = 0, b440 = 0, u200 = 0 ");
