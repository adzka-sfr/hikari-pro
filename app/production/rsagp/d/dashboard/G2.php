<?php
// include("../_config/koneksi.php");

$servername = "localhost";
$username = "root";
$password = "";
$db1 = "ratio_assy_gp";

// Create connection
$conn = new mysqli($servername, $username, $password, $db1);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql1 = mysqli_query($conn, "SELECT * FROM prioritas order by pcs_prioritas");
$ambil = mysqli_fetch_array($sql1);
$sql = mysqli_query($conn, "SELECT pc.name_ori_cabinet, pc.name_piano,SUM(DISTINCT(p.pcs_prioritas)) as pcs_prioritas FROM prioritas p JOIN penghubung_common pc ON p.name_cabinet = pc.name_cabinet WHERE p.dest = \"G 200\" and p.pcs_prioritas < '$ambil[safety_stock]' group by p.name_cabinet ORDER BY `pcs_prioritas` ASC, pc.name_ori_cabinet ASC");
$result = array();

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}

echo json_encode(array("result" => $data));
