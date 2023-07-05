<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();

$q1 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as isi FROM qa_staking_pre_pre");
$d1 = mysqli_fetch_array($q1);

if ($d1['isi'] == 0) {
    $gmclock = "-";
} else {
    $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_staking_pre_pre");
    $data = mysqli_fetch_array($sql);
    $gmclock = "(" . $data['c_gmc'] . ") " . $data['c_name'];
}
?>
<input type="text" style="font-size: small;" readonly value="<?= $gmclock ?>" class="form-control">