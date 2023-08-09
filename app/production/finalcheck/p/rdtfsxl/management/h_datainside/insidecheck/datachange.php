<?php
require '../../../config.php';

$code_incheck = $_POST['code_incheck'];
$result = $_POST['result'];

// ubah data
$q1 = mysqli_query($connect_pro, "UPDATE finalcheck_list_incheck SET c_status = '$result' WHERE c_code_incheck = '$code_incheck'");

if ($q1) {
    echo json_encode(array("status" => "berhasil"));
}
