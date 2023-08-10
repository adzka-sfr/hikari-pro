<?php
require '../../../config.php';

$processname = $_POST['processname'];

// get nilai ng maksimal
$q1 = mysqli_query($connect_pro, "SELECT c_code_completeness FROM finalcheck_list_completeness WHERE c_date_add = (SELECT max(c_date_add) FROM finalcheck_list_completeness)");
$d1 = mysqli_fetch_array($q1);
$code_number = substr($d1['c_code_completeness'], 3);
$code_number = $code_number + 1;
$code_number = "com" . $code_number;

$q2 = mysqli_query($connect_pro, "INSERT INTO finalcheck_list_completeness SET c_code_completeness = '$code_number', c_detail = '$processname', c_date_add = '$now'");

if ($q2) {
    // add to all model yang ada
    // select model dari pusat model (s-B113 JP dll)
    $q3 = mysqli_query($connect_pro, "SELECT c_code_model, c_model FROM finalcheck_list_specific_model");
    while ($d3 = mysqli_fetch_array($q3)) {
        // select max seq pada setiap finalcheck_list_completeness_model
        $q4 = mysqli_query($connect_pro, "SELECT MAX(c_seq) AS maksimal FROM finalcheck_list_completeness_model WHERE c_code_model = '$d3[c_code_model]'");
        $d4 = mysqli_fetch_array($q4);
        $new_seq = $d4['maksimal'] + 1;

        mysqli_query($connect_pro, "INSERT INTO finalcheck_list_completeness_model SET c_code_model = '$d3[c_code_model]', c_model = '$d3[c_model]', c_code_completeness = '$code_number', c_seq = $new_seq, c_status = 'disable'");
    }
    echo json_encode(array("status" => "berhasil"));
} else {
    echo json_encode(array("status" => "gagal"));
}
