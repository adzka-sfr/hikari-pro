<?php
// mengambil semua data panel
$sql_tcp = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where kategori = 'PANEL'");
$data_tcp = mysqli_fetch_array($sql_tcp);
if ($data_tcp['total'] == 0) {
    $tcp = 0;
} else {
    $tcp = $data_tcp['total'];
}

$sql_cp = mysqli_query($con_pro, "SELECT * from ongoing_slip where kategori = 'PANEL' order by time_out desc");

// mengambil semua data small short
$sql_tcss = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where kategori = 'SMALL SHORT'");
$data_tcss = mysqli_fetch_array($sql_tcss);
if ($data_tcss['total'] == 0) {
    $tcss = 0;
} else {
    $tcss = $data_tcss['total'];
}

$sql_css = mysqli_query($con_pro, "SELECT * from ongoing_slip where kategori = 'SMALL SHORT' order by time_out desc");

// mengambil semua data small long
$sql_tcsl = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where kategori = 'SMALL LONG'");
$data_tcsl = mysqli_fetch_array($sql_tcsl);
if ($data_tcsl['total'] == 0) {
    $tcsl = 0;
} else {
    $tcsl = $data_tcsl['total'];
}

$sql_csl = mysqli_query($con_pro, "SELECT * from ongoing_slip where kategori = 'SMALL LONG' order by time_out desc");
