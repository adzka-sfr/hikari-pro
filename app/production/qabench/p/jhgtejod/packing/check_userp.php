<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$location = $_SESSION['role'];
$c_pic = $_SESSION['id'];
$today = date('Y-m-d', strtotime($now));

// data lemparan
$gmcuserp = $_POST['gmcuserp'];
$serialuserp = $_POST['serialuserp'];

// cek apakah userp terdaftar atau tidak
$sql = mysqli_query($connect_pro, "SELECT id, c_location, c_gmc, c_packed FROM qa_userp WHERE c_serialuserp = '$serialuserp'");
$data = mysqli_fetch_array($sql);

if (empty($data['id'])) {
    $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan User Package - Packing', c_error = 'Melakukan scan user package dengan serial number yang tidak terdaftar', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serialuserp', c_type = 'User Package'");
    echo json_encode(array("status" => "userp-tidak-terdaftar"));
} else {
    // cek apakah userp sudah didaftarkan
    if ($data['c_location'] == "") {
        $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan User Package - Packing', c_error = 'Melakukan scan user package dengan serial number yang belum terdaftar', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serialuserp', c_type = 'User Package'");
        echo json_encode(array("status" => "userp-belum-terdaftar"));
    } else {
        // cek apakah didaftarkan pada area terkait
        if ($data['c_location'] != $location) {
            $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan User Package - Packing', c_error = 'Melakukan scan user package yang sudah terdaftar di bagian lain', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serialuserp', c_type = 'User Package'");
            echo json_encode(array("status" => "userp-bagian-lain"));
        } else {
            // cek apakah sinkron dengan kebutuhan piano (match atau tidak pasangan antara piano dengan userp)
            if ($data['c_gmc'] != $gmcuserp) {
                $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan User Package - Packing', c_error = 'Melakukan scan user package yang bukan spesifikasinya', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serialuserp', c_type = 'User Package'");
                echo json_encode(array("status" => "userp-tidak-match"));
            } else {
                // cek apakah sudah pernah digunakan atau belum
                if ($data['c_packed'] != "") {
                    $q4 = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_action = 'packing' AND c_serialuserp = '$serialuserp'");
                    $d4 = mysqli_fetch_array($q4);
                    $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan User Package - Packing', c_error = 'Melakukan scan user package yang seharusnya sudah ter-packing', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serialuserp', c_type = 'User Package'");
                    echo json_encode(array("status" => "userp-sudah-digunakan", "jenis" => "User Package", "info" => $d4['c_serialuserp'], "serialuserp" => $d4['c_serialuserp'], "serialpiano" => $d4['c_serialpiano'], "serialuserp" => $d4['c_serialuserp'], "namepiano" => $d4['c_namepiano'], "gmcpiano" => $d4['c_gmcpiano'], "packingdate" => $d4['c_date']));
                } else {
                    // echo "userp-match";
                    echo json_encode(array("status" => "userp-match"));
                }
            }
        }
    }
}
