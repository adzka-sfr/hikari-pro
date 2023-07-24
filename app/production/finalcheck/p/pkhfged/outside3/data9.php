<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];

$q1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$serialnumber' AND c_resulttiga = 'N'");
$d1 = mysqli_fetch_array($q1);

if ($d1['total'] == 0) {
    $q2 = mysqli_query($connect_pro, "SELECT c_completenesstiga_o, c_outsidetiga_i FROM finalcheck_timestamp WHERE c_serialnumber = '$serialnumber'");
    $d2 = mysqli_fetch_array($q2);
    if (empty($d2['c_completenesstiga_o'])) {
        mysqli_query($connect_pro, "UPDATE finalcheck_timestamp SET c_completenesstiga_o = '$now' WHERE c_serialnumber = '$serialnumber'");
    }
    if (empty($d2['c_outsidetiga_i'])) {
        mysqli_query($connect_pro, "UPDATE finalcheck_timestamp SET c_outsidetiga_i = '$now' WHERE c_serialnumber = '$serialnumber'");
    }

    echo json_encode(array("status" => "DONE"));
} else {
    $q2 = mysqli_query($connect_pro, "SELECT c_completenesstiga_o, c_outsidetiga_i FROM finalcheck_timestamp WHERE c_serialnumber = '$serialnumber'");
    $d2 = mysqli_fetch_array($q2);
    if (empty($d2['c_completenesstiga_o'])) {
        mysqli_query($connect_pro, "UPDATE finalcheck_timestamp SET c_completenesstiga_o = '$now' WHERE c_serialnumber = '$serialnumber'");
    }
    if (empty($d2['c_outsidetiga_i'])) {
        mysqli_query($connect_pro, "UPDATE finalcheck_timestamp SET c_outsidetiga_i = '$now' WHERE c_serialnumber = '$serialnumber'");
    }
    echo json_encode(array("status" => "NOT-YET"));
}
