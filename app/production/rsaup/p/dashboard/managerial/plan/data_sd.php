<?php
include("../../_config/pro_koneksi.php");
session_start();
$sql = mysqli_query($conn, "SELECT p.tanggal , p.jenis , p.qty as plan, a.qty as achieved  FROM plan p JOIN achieved a ON p.keytag = a.keytag where p.jenis = 'side' and p.nama_piano = '$_SESSION[model_piano]' order by p.tanggal desc");
$result = array();

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}
echo json_encode(array("result" => $data));
