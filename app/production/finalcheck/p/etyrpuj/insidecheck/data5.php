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

// cek apakah semuanya bernilai ok untuk bypass
$qbypass = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_inside WHERE c_serialnumber = '$serialnumber' AND c_result = 'NG'");
$dbypass = mysqli_fetch_array($qbypass);
if($dbypass['total'] == 0){
    // variabel pengaman
    $lock = 0;

    // [SELECT : finalcheck_fetch_inside] mengambil semua data yang ada pada fetch
    $sql = mysqli_query($connect_pro, "SELECT * FROM finalcheck_fetch_inside WHERE c_serialnumber = '$serialnumber'");
    while ($data = mysqli_fetch_array($sql)) {
        $lock++;
        $sql1 = mysqli_query($connect_pro, "INSERT INTO finalcheck_inside SET
    c_serialnumber = '$data[c_serialnumber]',
     c_code_incheck = '$data[c_code_incheck]',
     c_code_ng = '$data[c_code_ng]',
     c_result = '$data[c_result]',
     c_result_date = '$data[c_result_date]',
     c_repair = '$data[c_repair]',
     c_repair_date = '$data[c_repair_date]'
     ");
    }

    // [SELECT : finalcheck_inside] count data dengan serialnumber tsb di dalam tabel untuk mamastikan data sudah sesuai dengan yang di pindah, agar bisa hapus
    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) AS total FROM finalcheck_inside WHERE c_serialnumber = '$serialnumber'");
    $data2 = mysqli_fetch_array($sql2);

    // [DELETE : finalcheck_fetch_inside] jika nantinya angka sama, maka akan di hapus untuk data yang berada dalam fetch
    if ($lock == $data2['total']) {
        $sql3 = mysqli_query($connect_pro, "DELETE FROM finalcheck_fetch_inside WHERE c_serialnumber = '$serialnumber'");
        $sql4 = mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_repair_inside_o = '$now' WHERE c_serialnumber = '$serialnumber'");
    }
}
if ($sql) {
    echo json_encode(array("status" => "OK"));
}
