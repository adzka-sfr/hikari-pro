<?php
include "../../koneksi.php";
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
        $tanggal = date('Y-m-d', strtotime($tanggal));
        $cek_plan2 = mysqli_query($connect_cm, "SELECT count(common) as total from plan where tanggal = '$tanggal'");
        $cek_plan_d2 = mysqli_fetch_array($cek_plan2);
        if ($cek_plan_d2['total'] != 0) {
            $num = $cek_plan_d2['total'];
            $save_tgl = $tanggal; // $save_tgl untuk menyimpan tanggal yang memiliki plan
        }
        // echo $save_tgl;
    }
}

$sql1 = mysqli_query($connect_cm, "SELECT step1.nama_tampil, plan.common, COUNT(plan.common) as plan from plan JOIN step1 on plan.common = step1.penghubung where plan.tanggal = '$save_tgl' group by plan.common order by plan desc, nama_tampil asc");
while ($data1 = mysqli_fetch_array($sql1)) {
    // mengambil actual
    $sql2 = mysqli_query($connect_cm, "SELECT b450 from act_daily where phb = '$data1[common]'");
    $data2 = mysqli_fetch_array($sql2);

    $a = array("actual" => "$data2[b450]", "nama_model" => "$data1[nama_tampil]", "plan" => "$data1[plan]");
    $data[] = $a;
}

// sort($data);
echo json_encode(array("result" => $data));
