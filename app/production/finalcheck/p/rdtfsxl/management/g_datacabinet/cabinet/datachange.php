<?php
require '../../../config.php';

$code_cabinet = $_POST['code_cabinet'];
$result = $_POST['result'];

// ubah data
$q1 = mysqli_query($connect_pro, "UPDATE finalcheck_list_cabinet SET c_status = '$result' WHERE c_code_cabinet = '$code_cabinet'");

if ($q1) {
    echo json_encode(array("status" => "berhasil"));
}
