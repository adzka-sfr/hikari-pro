<?php
include "../../koneksi.php";
$tanggal_now = date('Y-m-d');
$sql_date = mysqli_query($connect_cm, "SELECT max(tanggal) as maks from plan");
$data_date = mysqli_fetch_array($sql_date);

$sql1 = mysqli_query($connect_cm, "SELECT DISTINCT penghubung from sd_b450");
while ($data1 = mysqli_fetch_array($sql1)) {
    $tanggal = date('Y-m-d', strtotime('+1days'));
    // mengambil nama model dan stock yang ada
    $sql2 = mysqli_query($connect_cm, "SELECT COUNT(penghubung) as stock, nama_item from sd_b450 where penghubung = '$data1[penghubung]'");
    $data2 = mysqli_fetch_array($sql2);

    // mengambil plan
     $plan = 0;
    if ($tanggal_now == $data_date['maks']) {
        $plan = 1000;
    }
    $sql3 = mysqli_query($connect_cm, "SELECT COUNT(common) as plan from plan where common = '$data1[penghubung]' and tanggal = '$tanggal'");
    $data3 = mysqli_fetch_array($sql3);

    if ($data3['plan'] != 0) {
        $plan = $data3['plan'];
    } else {
        while ($plan == 0) {
            $tanggal = date('Y-m-d', strtotime('+1days', strtotime($tanggal)));
            $sql3a = mysqli_query($connect_cm, "SELECT COUNT(common) as plan from plan where common = '$data1[penghubung]' and tanggal = '$tanggal'");
            $data3a = mysqli_fetch_array($sql3a);
            if ($data3a['plan'] != 0) {
                $plan = $data3a['plan'];
            } else {
                if ($tanggal >= $data_date['maks']) {
                    $plan = 1000;
                } else {
                    $plan = 0;
                }
            }
        }
    }
    if ($plan == 1000) {
        $plan = 0;
    }

    // mengambil actual
    $sql4 = mysqli_query($connect_cm, "SELECT b450 from act_daily where phb = '$data1[penghubung]'");
    $data4 = mysqli_fetch_array($sql4);

    $a = array("stock" => "$data2[stock]", "nama_model" => "$data2[nama_item]",  "plan" => "$plan", "actual" => "$data4[b450]");
	// $a = array("stock" => "$data2[stock]", "nama_model" => "$data2[nama_item]", "actual" => "$data4[b450]");
    $data[] = $a;
}
rsort($data);
echo json_encode(array("result" => $data));
