<?php
require '../../../config.php';

$gmc = $_POST['gmc'];
$name = $_POST['name'];
$completeness = $_POST['completeness'];
$outside = $_POST['outside'];

// cek apakah piano sudah pernah didaftarkan
$q1 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as total FROM finalcheck_list_piano WHERE c_gmc = '$gmc'");
$d1 = mysqli_fetch_array($q1);
if ($d1['total'] != 0) {
    echo json_encode(array("status" => "exist"));
} else {
    $q2 = mysqli_query($connect_pro, "INSERT INTO finalcheck_list_piano SET c_gmc = '$gmc', c_name = '$name', c_code_type = '$outside', c_code_model = '$completeness'");
    if ($q2) {
        echo json_encode(array("status" => "berhasil"));
    } else {
        echo json_encode(array("status" => "gagal"));
    }
}
