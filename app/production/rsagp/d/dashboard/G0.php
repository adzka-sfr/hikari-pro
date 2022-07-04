<?php
$servername = "localhost";
$username = "root";
$password = "";
$db1 = "ratio_assy_gp";

// Create connection
$con_rsagp = new mysqli($servername, $username, $password, $db1);

// Check connection
if ($con_rsagp->connect_error) {
    die("Connection failed: " . $con_rsagp->connect_error);
}

// include("../_config/koneksi.php");
$sql1 = mysqli_query($con_rsagp, "SELECT * FROM prioritas order by pcs_prioritas");
$ambil = mysqli_fetch_array($sql1);
// $sql = mysqli_query($con_rsagp, "SELECT * FROM prioritas where dest = \"G 130\" and pcs_prioritas < '$ambil[safety_stock]' order by pcs_prioritas asc");
$sql = mysqli_query($con_rsagp, "SELECT pc.name_ori_cabinet, pc.name_piano,SUM(DISTINCT(p.pcs_prioritas)) as pcs_prioritas FROM prioritas p JOIN penghubung_common pc ON p.name_cabinet = pc.name_cabinet WHERE p.dest = \"G 130\" and p.pcs_prioritas < '$ambil[safety_stock]' group by p.name_cabinet ORDER BY `pcs_prioritas` asc, pc.name_ori_cabinet asc");
$result = array();

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}

echo json_encode(array("result" => $data));
