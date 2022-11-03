<?php
include("../koneksi.php");

$tanggal_now = date('Y-m-d');
$sql_date = mysqli_query($connect_cm, "SELECT max(tanggal) as maks from plan");
$data_date = mysqli_fetch_array($sql_date);

// cek plan esok hari
$tanggal = date('Y-m-d', strtotime('+1days'));
$cek_plan = mysqli_query($connect_cm, "SELECT count(common) as total from plan where tanggal = '$tanggal'");
$cek_plan_d = mysqli_fetch_array($cek_plan);
$num = $cek_plan_d['total'];
$save_tgl = $tanggal; // $save_tgl untuk menyimpan tanggal yang memiliki plan

// jika data lebih dari maks maka di kasih nilai default yaitu 1 untuk menghindari perulangan num
if ($tanggal == $data_date['maks']) {
    $num = 1;
}

// cek jika hari besoknya ternyata data masih kosong
if ($num == 0) {
    while ($num == 0) {
        $tanggal = date('Y-m-d', strtotime('+1days', strtotime($tanggal)));
        $cek_plan2 = mysqli_query($connect_cm, "SELECT count(common) as total from plan where tanggal = '$tanggal'");
        $cek_plan_d2 = mysqli_fetch_array($cek_plan2);
        if ($cek_plan_d2['total'] != 0) {
            $num = $cek_plan_d2['total'];
            $save_tgl = $tanggal; // $save_tgl untuk menyimpan tanggal yang memiliki plan
        }
        // echo $save_tgl;
    }
}

$sql1 = mysqli_query($connect_cm, "SELECT distinct(plan.common) as phb, act_daily.b450 from plan join act_daily on plan.common = act_daily.phb WHERE plan.tanggal = '$save_tgl'");
$act_daily = 0;
while ($data1 = mysqli_fetch_array($sql1)) {
    $act_daily = $act_daily + $data1['b450'];
}

// while ($row = mysqli_fetch_assoc($q_baris)) {
//     $data[] = $row;
// }

$a = array("plan" => "$num", "actual" => "$act_daily");
$data[] = $a;

echo json_encode(array("result" => $data));
