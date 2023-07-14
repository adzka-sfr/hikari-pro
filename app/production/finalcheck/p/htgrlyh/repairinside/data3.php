<?php
// get connection
require '../config.php';

$serialnumber = isset($_POST['serialnumber']) ? $_POST['serialnumber'] : '';
$pic = isset($_POST['pic']) ? $_POST['pic'] : '';

$sql = mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_inside_pic = '$pic', c_repair_inside_i = '$now' WHERE c_serialnumber = '$serialnumber'");

if ($sql) {
    echo json_encode(array("status" => "OK"));
}
