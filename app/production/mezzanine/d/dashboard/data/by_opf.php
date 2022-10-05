<?php
// mengambil data on process
$sql_topp = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where muka ='ON PROCESS' ");
$data_topp = mysqli_fetch_array($sql_topp);
if ($data_topp['total'] == "") {
    $topp = 0;
} else {
    $topp = $data_topp['total'];
}

$sql_opfp = mysqli_query($con_pro, "SELECT * from ongoing_slip where muka = 'ON PROCESS' order by time_out desc");

// mengambil data finish
$sql_tff = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where muka ='FINISH' ");
$data_tff = mysqli_fetch_array($sql_tff);
if ($data_tff['total'] == "") {
    $tff = 0;
} else {
    $tff = $data_tff['total'];
}

$sql_opff = mysqli_query($con_pro, "SELECT * from ongoing_slip where muka = 'FINISH' order by time_out desc");
