<?php
// get connection
require '../config.php';

$serialnumber = isset($_POST['serialnumber']) ? $_POST['serialnumber'] : '';
$pic = isset($_POST['pic']) ? $_POST['pic'] : '';
$process = isset($_POST['process']) ? $_POST['process'] : '';

if ($process == 'oc3') {
    $sql = mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_outsidetiga_pic = '$pic', c_repair_outsidetiga_i = '$now' WHERE c_serialnumber = '$serialnumber'");
} elseif ($process == 'oc2') {
    $sql = mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_outsidedua_pic = '$pic', c_repair_outsidedua_i = '$now' WHERE c_serialnumber = '$serialnumber'");
} elseif ($process == 'oc1') {
    $sql = mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_outsidesatu_pic = '$pic', c_repair_outsidesatu_i = '$now' WHERE c_serialnumber = '$serialnumber'");
}

if ($sql) {
    echo json_encode(array("status" => "OK"));
}
