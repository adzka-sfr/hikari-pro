<?php
$con = new mysqli("localhost", "root", "", "hikari");

$sql = mysqli_query($con, "SELECT * FROM auth order by dept asc");
$result = array();

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}

echo json_encode(array("result" => $data));
