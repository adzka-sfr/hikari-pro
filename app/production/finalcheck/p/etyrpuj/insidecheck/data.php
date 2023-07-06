<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];
$code = $_POST['code'];
$result = $_POST['res'];

// [UPDATE : finalcheck_fetch_incheck] update status
$sql = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_incheck SET c_result = '$result', c_result_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_code_incheck = '$code'");

// jika status radio button adalah OK, maka c_code_ng di set NULL kembali
if ($result == 'OK') {
    // [UPDATE : finalcheck_fetch_incheck]
    $sql = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_incheck SET c_code_ng = null WHERE c_serialnumber = '$serialnumber' AND c_code_incheck = '$code'");
}

if ($sql) {
    echo "berhasil/" . $serialnumber . "/" . $code . "/" . $result;
}
