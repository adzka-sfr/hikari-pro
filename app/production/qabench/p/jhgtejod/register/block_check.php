<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));
$yesterday = date('Y-m-d', strtotime("-1day", strtotime($now)));
$location = $_SESSION['role'];

// cek untuk stock terlebih dahulu
$q1 = mysqli_query($connect_pro, "SELECT c_status, c_message FROM qa_fitur WHERE c_fitur = 'stock' AND c_location = '$location'");
$d1 = mysqli_fetch_array($q1);
if ($d1['c_status'] == 0) {
    // echo "stock-ng";
    echo json_encode(array("status" => "stock-ng", "message" => $d1['c_message']));
} else {
    // cek apakah fitur register tersedia
    $q2 = mysqli_query($connect_pro, "SELECT c_status, c_message FROM qa_fitur WHERE c_fitur = 'register' AND c_location = '$location'");
    $d2 = mysqli_fetch_array($q2);
    if ($d2['c_status'] == 0) {
        // echo "register-disable";
        echo json_encode(array("status" => "register-disable", "message" => $d2['c_message']));
    } else {
        // echo "oke";
        echo json_encode(array("status" => "oke"));
    }
}
