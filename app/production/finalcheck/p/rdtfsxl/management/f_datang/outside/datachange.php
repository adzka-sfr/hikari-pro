<?php
require '../../../config.php';

$code_ng = $_POST['code_ng'];
$result = $_POST['result'];

// ubah data
$q1 = mysqli_query($connect_pro, "UPDATE finalcheck_list_ng SET c_status = '$result' WHERE c_code_ng = '$code_ng'");

if($q1){
    echo json_encode(array("status" => "berhasil"));
}
