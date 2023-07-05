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
$gmcbench = $_POST['gmcbench'];
$serialbench = $_POST['serialbench'];

// cek apakah bench terdaftar atau tidak
$sql = mysqli_query($connect_pro, "SELECT id, c_location, c_gmc, c_packed FROM qa_bench WHERE c_serialbench = '$serialbench'");
$data = mysqli_fetch_array($sql);

if (empty($data['id'])) {
    $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan Bench - Packing', c_error = 'Melakukan scan bench dengan serial number yang tidak terdaftar', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serialbench', c_type = 'Bench'");
    echo json_encode(array("status" => "bench-tidak-terdaftar"));
} else {
    // cek apakah bench sudah didaftarkan
    if ($data['c_location'] == "") {
        $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan Bench - Packing', c_error = 'Melakukan scan bench dengan serial number yang belum terdaftar', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serialbench', c_type = 'Bench'");
        echo json_encode(array("status" => "bench-belum-terdaftar"));
    } else {
        // cek apakah didaftarkan pada area terkait
        if ($data['c_location'] != $location) {
            $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan Bench - Packing', c_error = 'Melakukan scan bench yang sudah terdaftar di bagian lain', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serialbench', c_type = 'Bench'");
            echo json_encode(array("status" => "bench-bagian-lain"));
        } else {
            // cek apakah sinkron dengan kebutuhan piano (match atau tidak pasangan antara piano dengan bench)
            if ($data['c_gmc'] != $gmcbench) {
                $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan Bench - Packing', c_error = 'Melakukan scan bench yang bukan spesifikasinya', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serialbench', c_type = 'Bench'");
                echo json_encode(array("status" => "bench-tidak-match"));
            } else {
                // cek apakah sudah pernah digunakan atau belum
                if ($data['c_packed'] != "") {
                    $q4 = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_action = 'packing' AND c_serialbench = '$serialbench'");
                    $d4 = mysqli_fetch_array($q4);
                    $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan Bench - Packing', c_error = 'Melakukan scan bench yang seharusnya sudah ter-packing', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serialbench', c_type = 'Bench'");
                    echo json_encode(array("status" => "bench-sudah-digunakan", "jenis" => "Bench", "info" => $d4['c_serialbench'], "serialbench" => $d4['c_serialbench'], "serialpiano" => $d4['c_serialpiano'], "serialuserp" => $d4['c_serialuserp'], "namepiano" => $d4['c_namepiano'], "gmcpiano" => $d4['c_gmcpiano'], "packingdate" => $d4['c_date']));
                } else {
                    echo json_encode(array("status" => "bench-match"));
                }
            }
        }
    }
}
