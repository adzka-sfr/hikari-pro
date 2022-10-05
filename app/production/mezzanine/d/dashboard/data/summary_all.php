<?php
// mencari total summary all 2 jam
$sb = mysqli_query($con_pro, "SELECT SUM(qty) as total from to_ongoing_slip");
$dsb = mysqli_fetch_array($sb);
if ($dsb['total'] == "") {
    $tsb = 0;
} else {
    $tsb = $dsb['total'];
}

// mencari total summary all 16 jam
$sa = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip");
$dsa = mysqli_fetch_array($sa);
if ($dsa['total'] == "") {
    $tsa = 0;
} else {
    $tsa = $dsa['total'];
}

$sumol = $tsb + $tsa;

// mengambil semua data untuk di tampilkan pada tabel 2 jam
$sb1 = mysqli_query($con_pro, "SELECT * from to_ongoing_slip order by time_out desc");

// mengambil semua data untuk di tampilkan pada tabel 16 jam
$sa1 = mysqli_query($con_pro, "SELECT * from ongoing_slip order by time_out desc");
