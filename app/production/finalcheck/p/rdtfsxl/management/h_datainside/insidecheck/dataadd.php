<?php
require '../../../config.php';

$status = 'enable';
$code_type = 'pf';
$processname = $_POST['processname'];

// get nilai ng maksimal
$q1 = mysqli_query($connect_pro, "SELECT c_code_incheck FROM finalcheck_list_incheck WHERE c_date_add = (SELECT max(c_date_add) FROM finalcheck_list_incheck)");
$d1 = mysqli_fetch_array($q1);
$code_number = substr($d1['c_code_incheck'], 2);
$code_number = $code_number + 1;
$code_number = "in" . $code_number;

// get seq maksimal
$q3 = mysqli_query($connect_pro, "SELECT MAX(c_seq) as maksimal FROM finalcheck_list_incheck");
$d3 = mysqli_fetch_array($q3);
$seq_number = $d3['maksimal'];
$seq_number = $seq_number + 1;

$q2 = mysqli_query($connect_pro, "INSERT INTO finalcheck_list_incheck SET c_code_incheck = '$code_number',c_code_type = '$code_type', c_detail = '$processname', c_status = '$status',c_seq = $seq_number, c_date_add = '$now'");

if ($q2) {
    echo json_encode(array("status" => "berhasil"));
} else {
    echo json_encode(array("status" => "gagal"));
}
