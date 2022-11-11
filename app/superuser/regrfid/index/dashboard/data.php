<?php
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$sql = mysqli_query($connect_pro, "SELECT * FROM rfid_stock order by name asc");
$result = array();

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}

echo json_encode(array("result" => $data));
