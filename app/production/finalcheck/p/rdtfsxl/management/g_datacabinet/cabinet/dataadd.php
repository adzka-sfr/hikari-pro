<?php
require '../../../config.php';

$status = 'enable';
$cabinetname = $_POST['cabinetname'];

// get nilai ng maksimal
$q1 = mysqli_query($connect_pro, "SELECT c_code_cabinet FROM finalcheck_list_cabinet WHERE c_date_add = (SELECT max(c_date_add) FROM finalcheck_list_cabinet)");
$d1 = mysqli_fetch_array($q1);
$cabinet_number = substr($d1['c_code_cabinet'], 3);
$cabinet_number = $cabinet_number + 1;
$cabinet_number = "cab" . $cabinet_number;

$q2 = mysqli_query($connect_pro, "INSERT INTO finalcheck_list_cabinet SET c_code_cabinet = '$cabinet_number', c_name = '$cabinetname', c_status = '$status', c_date_add = '$now'");

if ($q2) {
    echo json_encode(array("status" => "berhasil"));
} else {
    echo json_encode(array("status" => "gagal"));
}
