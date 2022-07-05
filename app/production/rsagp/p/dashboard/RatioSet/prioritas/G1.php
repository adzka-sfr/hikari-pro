<?php
include("../_config/koneksi.php");
$sql1 = mysqli_query($conn, "SELECT * FROM prioritas order by pcs_prioritas");
$ambil = mysqli_fetch_array($sql1);
$sql = mysqli_query($conn, "SELECT * FROM prioritas where dest = \"G 150\" and pcs_prioritas < '$ambil[safety_stock]' order by pcs_prioritas asc");
$result = array();

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}

echo json_encode(array("result" => $data));
