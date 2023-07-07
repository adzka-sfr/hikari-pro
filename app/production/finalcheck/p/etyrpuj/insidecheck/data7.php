<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];

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

if ($sql3) {
    echo json_encode(array("status" => "OK"));
}
