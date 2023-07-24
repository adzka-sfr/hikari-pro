<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];
$codeng = $_POST['codeng'];
$process = $_POST['process'];
$result = $_POST['result'];

$sql = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_outside SET c_repair = '$result', c_repair_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_code_ng = '$codeng' AND c_process = '$process'");

if ($sql) {
    $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_repair = 'N' AND c_process = '$process'");
    $data1 = mysqli_fetch_array($sql1);

    if ($data1['total'] == 0) {
        echo json_encode(array('status' => 'berhasil-clear'));
    } else {
        echo json_encode(array('status' => 'berhasil'));
    }
}
