<?php
require '../../../config.php';

$serialnumber = $_POST['serialnumber'];
$name = $_POST['name'];
$reason = $_POST['reason'];
$validation = $_POST['validation'];

// insert into reset log
$q1 = mysqli_query($connect_pro, "INSERT INTO finalcheck_reset_log SET c_serialnumber = '$serialnumber', c_pic = '$namkar', c_id_pic = '$idkar', c_reason = '$reason', c_validation = '$validation', c_date = '$now'");
if ($q1) {
    // delete pada finalcheck_register
    $q2 = mysqli_query($connect_pro, "DELETE FROM finalcheck_register WHERE c_serialnumber = '$serialnumber'");
    if ($q2) {
        echo json_encode(array("status" => "berhasil"));
    }
}
