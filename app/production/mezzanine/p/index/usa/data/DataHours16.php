<?php
// different 3 hari
$days3 = date('Y-m-d H:i:s', strtotime('-3 days', strtotime($now)));


// kurang dari 16 jam
$sql_hours16a = mysqli_query($con_pro, "SELECT count(distinct slip) as belum from ongoing_slip where time_out > '$now'");
$data_hours16a = mysqli_fetch_array($sql_hours16a);
if (empty($data_hours16a)) {
    $awal16 = 0;
} else {
    $awal16 = $data_hours16a['belum'];
}

// lebih dari 16 jam kurang dari 3 hari
$sql_hours16b = mysqli_query($con_pro, "SELECT count(distinct slip) as tengah from ongoing_slip where time_out < '$now' and time_in > '$days3'");
$data_hours16b = mysqli_fetch_array($sql_hours16b);
if (empty($data_hours16b)) {
    $tengah16 = 0;
} else {
    $tengah16 = $data_hours16b['tengah'];
}

// lebih dari 3 hari
$sql_hours16c = mysqli_query($con_pro, "SELECT count(distinct slip) as akhir from ongoing_slip where time_in < '$days3'");
$data_hours16c = mysqli_fetch_array($sql_hours16c);
if (empty($data_hours16c)) {
    $akhir16 = 0;
} else {
    $akhir16 = $data_hours16c['akhir'];
}

// mengambil semua slip yang ada pada 16 jam
$sql_all16 = mysqli_query($con_pro, "SELECT distinct slip, time_out, time_in from ongoing_slip order by time_out asc");
