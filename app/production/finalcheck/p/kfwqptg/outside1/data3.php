<?php
// get connection
require '../config.php';

// get data lemparan
$code_ng = $_POST['ng']; // ng1
$serialnumber = $_POST['serialnumber'];
$process = $_POST['process'];

// get num NG max
$q1 = mysqli_query($connect_pro, "SELECT MAX(c_number_ng) as maks FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber'");
$d1 = mysqli_fetch_array($q1);

if (empty($d1['maks'])) {
    $number_ng = 1;
} else {
    $number_ng = $d1['maks'] + 1;
}

foreach ($_POST['cab'] as $value) {
    $sql =  mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_outside SET c_serialnumber = '$serialnumber', c_number_ng = $number_ng, c_code_ng = '$code_ng', c_code_cabinet = '$value', c_process = '$process', c_result_date = '$now'");
}

if ($sql) {
    echo json_encode(array("status" => 'berhasil'));
}
