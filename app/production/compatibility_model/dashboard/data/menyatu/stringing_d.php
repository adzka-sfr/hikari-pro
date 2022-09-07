<?php
include "../../koneksi.php";
$tanggal = date('Y-m-d');

$tanggal = date('Y-m-d');
$cek_plan = mysqli_query($connect_cm, "SELECT common from plan where tanggal = '$tanggal'");
$cek_plan_d = mysqli_num_rows($cek_plan);

if ($cek_plan_d != 0) {
    $sql1 = mysqli_query($connect_cm, "SELECT step1.nama_tampil, plan.common, COUNT(plan.common) as plan from plan JOIN step1 on plan.common = step1.penghubung where plan.tanggal = '$tanggal' group by plan.common order by plan desc, nama_tampil asc");
    while ($data1 = mysqli_fetch_array($sql1)) {
        // mengambil actual
        $sql2 = mysqli_query($connect_cm, "SELECT b440 from act_daily where phb = '$data1[common]'");
        $data2 = mysqli_fetch_array($sql2);

        // mengambil wip
        $sql3 = mysqli_query($connect_cm, "SELECT count(penghubung) as phb from sd_b450 where penghubung = '$data1[common]'");
        $data3 = mysqli_fetch_array($sql3);

        // mengambil stock
        $sql4 = mysqli_query($connect_cm, "SELECT count(penghubung) as phb from sd_b440 where penghubung = '$data1[common]'");
        $data4 = mysqli_fetch_array($sql4);

        $a = array("actual" => "$data2[b440]", "nama_model" => "$data1[nama_tampil]", "plan" => "$data1[plan]", "wip" => "$data3[phb]", "stock" => "$data4[phb]");
        $data[] = $a;
    }
} else {
    for ($i = 1; $i <= 5; $i++) {
        $a = array("actual" => "0", "nama_model" => "No Data", "plan" => "0", "wip" => "0", "stock" => "0");
        $data[] = $a;
    }
}

// rsort($data);
echo json_encode(array("result" => $data));
