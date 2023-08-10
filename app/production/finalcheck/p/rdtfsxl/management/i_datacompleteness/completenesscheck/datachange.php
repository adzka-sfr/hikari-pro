<?php
require '../../../config.php';

$model = $_POST['code_model'];
$code_completeness = $_POST['code_completeness'];
$result = $_POST['result'];

// ubah data
$q1 = mysqli_query($connect_pro, "UPDATE finalcheck_list_completeness_model SET c_status = '$result' WHERE c_code_model = '$model' AND c_code_completeness = '$code_completeness'");

if ($q1) {
    echo json_encode(array("status" => "berhasil"));
}
