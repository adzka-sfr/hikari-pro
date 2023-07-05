<?php
$sql_hours2a = mysqli_query($con_pro, "SELECT  count(distinct slip) as belum from to_ongoing_slip where time_out > '$now'");
$data_hours2a = mysqli_fetch_array($sql_hours2a);
if (empty($data_hours2a)) {
    $belum2 = 0;
} else {
    $belum2 = $data_hours2a['belum'];
}

$sql_hours2b = mysqli_query($con_pro, "SELECT  count(distinct slip) as sudah from to_ongoing_slip where time_out < '$now'");
$data_hours2b = mysqli_fetch_array($sql_hours2b);
if (empty($data_hours2b)) {
    $sudah2 = 0;
} else {
    $sudah2 = $data_hours2b['sudah'];
}

// mengambil semua slip yang ada pada 2 jam
$sql_all2 = mysqli_query($con_pro, "SELECT distinct slip, time_out from to_ongoing_slip order by time_out asc");
