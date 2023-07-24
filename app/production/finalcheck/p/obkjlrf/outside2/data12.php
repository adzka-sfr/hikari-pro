<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];

$q1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total, c_repairdua FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$serialnumber' AND c_resultdua = 'N'");
$d1 = mysqli_fetch_array($q1);

if ($d1['total'] == 0) {
    echo json_encode(array("status" => "DONE"));
} else {
    if ($d1['c_repairdua'] == 'N') {
        echo json_encode(array("status" => "NOT-YET"));
    } else {
        echo json_encode(array("status" => "DONE"));
    }
}
