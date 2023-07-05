<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));
$yesterday = date('Y-m-d', strtotime("-1day", strtotime($now)));

$sql = mysqli_query($connect_pro, "SELECT c_status FROM qa_fitur WHERE c_fitur = 'stock' ORDER BY c_status ASC LIMIT 1");
$data = mysqli_fetch_array($sql);

if ($data['c_status'] == 0) {
    echo json_encode(array("status" => "oke"));
} else if ($data['c_status'] == 1) {
    echo json_encode(array("status" => "stock-ng"));
} else {
    echo json_encode(array("status" => "error"));
}
