<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];
$code = $_POST['code'];
$ngcode = isset($_POST['ngcode']) ? $_POST['ngcode'] : '';

// (A) cek apakah ngcode nilainya kosong (transisi dari  NG ke OK)
// if ($ngcode != '') {
// [a] jika tidak kosong

$sql1 = mysqli_query($connect_pro, "SELECT c_code_ng FROM finalcheck_fetch_incheck WHERE c_serialnumber = '$serialnumber' AND c_code_incheck = '$code'");
$data1 = mysqli_fetch_array($sql1);

$ng = explode('/', $data1['c_code_ng']);

foreach ($ng as $value) {
    $hasil = array();
    foreach ($ngcode as $keyng => $valueng) {
        if ($value == $valueng) {
            array_push($hasil, "OK");
        } else {
            array_push($hasil, "NG");
        }
    }
}

$hasil_insert = implode('/', $hasil);
var_dump($hasil_insert);
die();
// [UPDATE : finalcheck_fetch_inside] ketika result radio button adalah NG, maka code NG akan di masukkan
$sql = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_incheck SET c_repair = '$hasil_insert', c_repair_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_code_incheck = '$code'");
if ($sql) {
    echo "berhasil/" . $serialnumber . "/" . $code . "/" . $ngcode;
}
// } else {
    // [a] kosong
    // echo "ng code null";
// }
