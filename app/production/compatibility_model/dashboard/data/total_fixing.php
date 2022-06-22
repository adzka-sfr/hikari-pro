<?php
include("../koneksi.php");

$q_baris = mysqli_query($connect_cm, "SELECT COUNT(*) as jumlah from sd_b450");
$result = array();

while ($row = mysqli_fetch_assoc($q_baris)) {
    $data[] = $row;
}

echo json_encode(array("result" => $data));
