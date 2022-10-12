<?php
include("../koneksi.php");

$q_baris = mysqli_query($connect_cm, "SELECT COUNT(penghubung) as jumlah FROM sd_b450 GROUP by penghubung ORDER BY nama_item");

$br = 0;
while ($hasil_br = mysqli_fetch_array($q_baris)) {
    $br++;
}

$sisa = $br % 2; // 1
$brn = $br - $sisa; // 10
$use_s = $brn / 2; // 5
$use_s2 = $use_s + $sisa; // 6

$sql = mysqli_query($connect_cm, "SELECT nama_item, COUNT(penghubung) as qty FROM sd_b450 GROUP by penghubung ORDER BY qty desc,nama_item asc  limit $use_s,$use_s2");
$result2 = array();

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}

echo json_encode(array("result" => $data));
