<?php
include('../../_config/pro_koneksi.php');

$model = $_POST['model'];
$tanggal = $_POST['tanggal'];
$plan = $_POST['plan'];
$plan_adj = $_POST['plan_adj'];
$type = $_POST['type'];
$keytag = $tanggal . '|' . $model . '|' . $type;

//query
$query  = "UPDATE plan SET qty = $plan_adj WHERE keytag = '$keytag'";
$sql     = mysqli_query($connect, $query);
$data    = mysqli_fetch_array($sql);

$query1  = "SELECT * from plan WHERE keytag = '$keytag' and qty = $plan_adj";
$result1 = mysqli_query($connect, $query1);
$row1    = mysqli_num_rows($result1);

if ($row1 > 0) {
    echo json_encode(array("statusCode" => "111"));
} else {
    echo json_encode(array("statusCode" => "222"));
}
