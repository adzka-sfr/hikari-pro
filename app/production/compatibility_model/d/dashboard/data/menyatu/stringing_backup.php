<?php
include "../../koneksi.php";
$tanggal = date('Y-m-d');

$sql1 = mysqli_query($connect_cm, "SELECT DISTINCT penghubung from sd_b440");
while ($data1 = mysqli_fetch_array($sql1)) {
    // mengambil nama model dan stock yang ada
    $sql2 = mysqli_query($connect_cm, "SELECT COUNT(penghubung) as stock, nama_item from sd_b440 where penghubung = '$data1[penghubung]'");
    $data2 = mysqli_fetch_array($sql2);

    // mengambil plan
    $sql3 = mysqli_query($connect_cm, "SELECT COUNT(common) as plan from plan where common = '$data1[penghubung]' and tanggal = '$tanggal'");
    $data3 = mysqli_fetch_array($sql3);

    // mengambil actual
    $sql4 = mysqli_query($connect_cm, "SELECT b440 from act_daily where phb = '$data1[penghubung]'");
    $data4 = mysqli_fetch_array($sql4);

    // mengambil wip stringing atau result fixing frame
    $sql5 = mysqli_query($connect_cm, "SELECT count(penghubung) as phb from sd_b450 where penghubung = '$data1[penghubung]'");
    $data5 = mysqli_fetch_array($sql5);

    $a = array("stock" => "$data2[stock]", "nama_model" => "$data2[nama_item]",  "plan" => "$data3[plan]", "actual" => "$data4[b440]", "wip" => "$data5[phb]");
    // $a = array("stock" => "$data2[stock]", "nama_model" => "$data2[nama_item]", "actual" => "$data4[b440]");
    $data[] = $a;
}
rsort($data);
echo json_encode(array("result" => $data));
