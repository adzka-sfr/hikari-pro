<?php
require '../../../config.php';

$type = $_POST['type'];
$modelname = $_POST['modelname'];

// rakitan untuk code model
$c_code_model = $type . "-" . $modelname;

// cek terlebih dahulu apakah pada database model baru apakah sudah pernah ditambahkan
$q1 = mysqli_query($connect_pro, "SELECT COUNT(c_code_model) as total FROM finalcheck_list_specific_model WHERE c_code_model = '$c_code_model'");
$d1 = mysqli_fetch_array($q1);

if ($d1['total'] != 0) {
    echo json_encode(array("status" => "sudah-ada"));
} else {
    $q2 = mysqli_query($connect_pro, "INSERT INTO finalcheck_list_specific_model SET c_code_model = '$c_code_model', c_model = '$modelname'");

    if ($q2) {
        // add all completeness untuk model baru
        $no = 0;
        $q3 = mysqli_query($connect_pro, "SELECT c_code_completeness FROM finalcheck_list_completeness");
        while ($d3 = mysqli_fetch_array($q3)) {
            $no++;
            mysqli_query($connect_pro, "INSERT INTO finalcheck_list_completeness_model SET c_code_model = '$c_code_model', c_model = '$modelname', c_code_completeness = '$d3[c_code_completeness]', c_seq = $no, c_status = 'disable'");
        }
        echo json_encode(array("status" => "berhasil"));
    } else {
        echo json_encode(array("status" => "gagal"));
    }
}
