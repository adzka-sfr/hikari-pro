<?php
include("../koneksi.php");

$sql = mysqli_query($connect, "SELECT * FROM cab_stock order by updated desc");
$result = array();

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}

echo json_encode(array("result" => $data));
