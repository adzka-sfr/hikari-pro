<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));
$yesterday = date('Y-m-d', strtotime("-1day", strtotime($now)));

$c_approval = $_SESSION['nama'];
$id = $_POST['id'];

$sql = mysqli_query($connect_pro, "DELETE FROM qa_email WHERE id = $id");

if ($sql) {
    echo "sukses";
} else {
    echo "error";
}
