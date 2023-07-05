<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];

// [UPDATE : finalcheck_timestamp(c_inside_o)] keluar inside
$sql = mysqli_query($connect_pro, "UPDATE finalcheck_timestamp SET c_inside_o = '$now' WHERE c_serialnumber = '$serialnumber'");

// [UPDATE : finalcheck_repairtime(c_repair_inside_i)] start masuk repair inside
$sql1 = mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_repair_inside_i = '$now' WHERE c_serialnumber = '$serialnumber'");

// [UPDATE : finalcheck_fetch_incheck(c_result, c_result_date)] yang kosong auto OK
$sql2 = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_incheck SET c_result = 'OK', c_result_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_result is NULL");

if ($sql) {
    echo json_encode(array("status" => "OK"));
}
