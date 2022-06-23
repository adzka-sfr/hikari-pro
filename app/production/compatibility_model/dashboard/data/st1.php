<?php
include("../koneksi.php");

$q_baris = mysqli_query($connect_cm, "SELECT COUNT(penghubung) as jumlah FROM sd_b440 GROUP by penghubung");

$br = 0;
while ($hasil_br = mysqli_fetch_array($q_baris)) {
    $br++;
}

$sisa = $br % 2; // 0
$brn = $br - $sisa; // 12
$use_s = $brn / 2; // 6
$use_s2 = $use_s + $sisa; // 6

$sql = mysqli_query($connect_cm, "SELECT nama_item, COUNT(penghubung) as qty FROM sd_b440 GROUP by penghubung ORDER BY qty desc,nama_item asc  limit 0,$use_s");
$result = array();

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}

echo json_encode(array("result" => $data));
