<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));
$yesterday = date('Y-m-d', strtotime("-1day", strtotime($now)));

$email = $_POST['email'];
$statusst = $_POST['statusstadd'];
$statusng = $_POST['statusngadd'];
$loc = $_POST['location'];

// add domain
$email = $email . "@music.yamaha.com";

$sql = mysqli_query($connect_pro, "INSERT INTO qa_email SET c_email = '$email', c_st = '$statusst', c_ng = '$statusng', c_area = '$loc'");

if ($sql) {
    echo "sukses";
} else {
    echo "error";
}
