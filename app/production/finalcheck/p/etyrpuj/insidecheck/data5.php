<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];

// [UPDATE : finalcheck_timestamp(c_inside_o)] keluar inside
$sql = mysqli_query($connect_pro, "UPDATE finalcheck_timestamp SET c_inside_o = '$now' WHERE c_serialnumber = '$serialnumber'");

// [UPDATE : finalcheck_repairtime(c_repair_inside_i)] start masuk repair inside
$sql1 = mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_repair_inside_i = '$now' WHERE c_serialnumber = '$serialnumber'");

// [UPDATE : finalcheck_fetch_inside(c_result, c_result_date)] yang kosong auto OK
$sql2 = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_inside SET c_result = 'OK', c_result_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_result is NULL");

// jika ng adalah ng tidak pakai maka result diisi sebagai OK
$sql3 = mysqli_query($connect_pro, "SELECT c_code_incheck, c_code_ng FROM finalcheck_fetch_inside WHERE c_serialnumber = '$serialnumber'");
// NG tidak pakai
// ng145, ng156, ng147
while ($data3 = mysqli_fetch_array($sql3)) {
    if ($data3['c_code_ng'] == 'ng145' or $data3['c_code_ng'] == 'ng146' or $data3['c_code_ng'] == 'ng147') {
        mysqli_query($connect_pro, "UPDATE finalcheck_fetch_inside SET c_result = 'OK', c_repair = 'OK', c_repair_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_code_incheck = '$data3[c_code_incheck]'");
    }
}
if ($sql) {
    echo json_encode(array("status" => "OK"));
}
