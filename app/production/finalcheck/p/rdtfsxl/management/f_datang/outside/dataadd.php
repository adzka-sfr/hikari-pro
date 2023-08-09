<?php
require '../../../config.php';

$area = 'outside';
$dept = $_POST['dept'];
$status = 'enable';
$processcode = '-';
$ngname = $_POST['ngname'];

// get nilai ng maksimal
$q1 = mysqli_query($connect_pro, "SELECT c_code_ng FROM finalcheck_list_ng WHERE c_date_add = (SELECT max(c_date_add) FROM finalcheck_list_ng)");
$d1 = mysqli_fetch_array($q1);
$ng_number = substr($d1['c_code_ng'], 2);
$ng_number = $ng_number + 1;
$ng_number = "ng" . $ng_number;

$q2 = mysqli_query($connect_pro, "INSERT INTO finalcheck_list_ng SET c_code_ng = '$ng_number', c_group = '$processcode', c_area = '$area', c_name = '$ngname', c_dept = '$dept', c_status = '$status', c_date_add = '$now'");

if ($q2) {
    echo json_encode(array("status" => "berhasil"));
} else {
    echo json_encode(array("status" => "gagal"));
}
