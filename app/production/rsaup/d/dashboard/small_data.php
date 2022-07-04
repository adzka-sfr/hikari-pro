<?php
$servername = "localhost";
$username = "root";
$password = "";
$db1 = "prioritas_sb";

// Create connection
$conn_rsaup = new mysqli($servername, $username, $password, $db1);

// Check connection
if ($conn_rsaup->connect_error) {
    die("Connection failed: " . $conn_rsaup->connect_error);
}

$sql = mysqli_query($conn_rsaup, "SELECT * from prioritas where kategori = 'small' ORDER BY qty asc, nama_kabinet asc");
$result = array();

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}

echo json_encode(array("result" => $data));
