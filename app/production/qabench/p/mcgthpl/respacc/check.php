<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));

$c_approval = $_SESSION['nama'];
$serial = $_POST['serial'];


$sql = mysqli_query($connect_pro, "SELECT COUNT(id) AS total FROM qa_log WHERE c_serialpiano = '$serial' AND c_action = 'packing'");
$data = mysqli_fetch_array($sql);
$isi = $data['total'];

if ($isi == 0) {
    echo json_encode(array("status" => "tidak-ada-data"));
} else {
    $s1 = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_serialpiano = '$serial'  AND c_action = 'packing'");
    $d1 = mysqli_fetch_array($s1);
    echo json_encode(array("status" => "ada", "serial" => $d1['c_serialpiano'], "name" => $d1['c_namepiano'], "bench" => $d1['c_serialbench'], "userp" => $d1['c_serialuserp'], "loc" => $d1['c_location'], "time" => $d1['c_date']));
}

// if ($sql) {
//     echo json_encode(array("status" => "tidak"));
// } else {
//     echo json_encode(array("status" => "error"));
// }
