<?php
include('../../_config/pro_koneksi.php');

$model = $_POST['model'];
$tanggal = $_POST['tanggal'];
$plan = $_POST['plan'];
$type = $_POST['type'];
$keytag = $tanggal . '|' . $model . '|' . $type;


mysqli_query($conn, "DELETE FROM plan WHERE keytag = '$keytag'");
mysqli_query($conn, "DELETE FROM achieved WHERE keytag = '$keytag'");

$sql2 = "SELECT * from plan WHERE keytag = '$keytag'";
$result = mysqli_query($conn, $sql2);
$row = mysqli_num_rows($result);

if ($row == 0) {
    echo json_encode(array("statusCode" => "111"));
} else {
    echo json_encode(array("statusCode" => "222"));
}
