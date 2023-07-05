<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();

$sql = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as total FROM qa_staking_pre_pre");
$data = mysqli_fetch_array($sql);
$hasil = $data['total'];
?>
<input readonly style="text-align: center; border-radius: 5px; font-size: 55px; background-color: #F3BBC1;" type="text" class="form-control" value="<?= $hasil ?>">