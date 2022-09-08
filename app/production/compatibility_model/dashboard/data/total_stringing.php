<?php
include("../koneksi.php");

$tanggal_now = date('Y-m-d');
// cek plan esok hari
$cek_plan = mysqli_query($connect_cm, "SELECT count(common) as total from plan where tanggal = '$tanggal_now'");
$cek_plan_d = mysqli_fetch_array($cek_plan);
$num = $cek_plan_d['total'];
$save_tgl = $tanggal_now; // $save_tgl untuk menyimpan tanggal yang memiliki plan

$sql1 = mysqli_query($connect_cm, "SELECT distinct(plan.common) as phb, act_daily.b440 from plan join act_daily on plan.common = act_daily.phb WHERE plan.tanggal = '$save_tgl'");
$act_daily = 0;
while ($data1 = mysqli_fetch_array($sql1)) {
    $act_daily = $act_daily + $data1['b440'];
}

// while ($row = mysqli_fetch_assoc($q_baris)) {
//     $data[] = $row;
// }
$a = array("plan" => "$num", "actual" => "$act_daily");
$data[] = $a;

echo json_encode(array("result" => $data));
