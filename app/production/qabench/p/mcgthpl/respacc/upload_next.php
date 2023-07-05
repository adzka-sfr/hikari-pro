<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
session_start();
$now = date('Y-m-d H:i:s');

// require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
require('../../../../../../_assets/src/add/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
// require('spreadsheet-reader-master/SpreadsheetReader.php');
require('../../../../../../_assets/src/add/spreadsheet-reader-master/SpreadsheetReader.php');

$approval = $_SESSION['id'];
$dir = $_POST['dir'];

$Reader = new SpreadsheetReader($dir);

foreach ($Reader as $Key => $Row) {
    // import data excel mulai baris ke-2 (karena ada header pada baris 1)
    if ($Key < 1) continue;

    if ($Row[1] == '') {
        $alasan = '-';
    } else {
        $alasan = $Row[1];
    }
    // cek terlebih dahulu status no seri (terpacking / sudah tereset)
    $sql = mysqli_query($connect_pro, "SELECT COUNT(id) AS total FROM qa_log WHERE c_serialpiano = '$Row[0]'");
    $data = mysqli_fetch_array($sql);
    if ($data['total'] > 0) {
        // status masih packing
        // cari acard dari data yang sudah ditemukan
        $sql3 = mysqli_query($connect_pro, "SELECT c_acard FROM qa_log WHERE c_serialpiano = '$Row[0]'");
        $data3 = mysqli_fetch_array($sql3);

        // cek apakah sudah pernah dilakukan reset
        $sql2 = mysqli_query($connect_pro, "SELECT COUNT(id) AS total FROM qa_log WHERE c_serialpiano = '$Row[0]' AND c_action != 'reset'");
        $data2 = mysqli_fetch_array($sql2);
        if ($data2['total'] > 0) {
            // lakukan reset serial number
            // get data from qa_log
            $sql11 = mysqli_query($connect_pro, "SELECT * FROM  qa_log WHERE c_serialpiano = '$Row[0]' AND c_action = 'packing'");
            $data11 = mysqli_fetch_array($sql11);

            // update qa_bench
            $q1 = mysqli_query($connect_pro, "UPDATE qa_bench SET c_packed = NULL WHERE c_serialbench = '$data11[c_serialbench]'");
            if ($data11['c_serialbench'] != '-') {
                $q1a = mysqli_query($connect_pro, "INSERT INTO qa_adjustlog SET c_action = 'reset', c_pic = '$approval', c_serialnumber = '$data11[c_serialbench]', c_type = 'bench', c_location = '$data11[c_location]', c_date = '$now', c_note = '$alasan'");
            }

            // update qa_userp
            $q2 = mysqli_query($connect_pro, "UPDATE qa_userp SET c_packed = NULL WHERE c_serialuserp = '$data11[c_serialuserp]'");
            if ($data11['c_serialuserp'] != '-') {
                $q2a = mysqli_query($connect_pro, "INSERT INTO qa_adjustlog SET c_action = 'reset', c_pic = '$approval', c_serialnumber = '$data11[c_serialuserp]', c_type = 'userpackage', c_location = '$data11[c_location]', c_date = '$now', c_note = '$alasan'");
            }

            // insert qa_adjustlog piano
            $q3 = mysqli_query($connect_pro, "INSERT INTO qa_adjustlog SET c_action = 'reset', c_pic = '$approval', c_serialnumber = '$Row[0]', c_type = 'piano', c_location = '$data11[c_location]', c_date = '$now', c_note = '$alasan'");

            // update qa_log c_action -> reset
            $q4 = mysqli_query($connect_pro, "UPDATE qa_log SET c_action = 'reset' WHERE c_serialpiano = '$Row[0]'");

            // insert ke database qa reset
            $query = mysqli_query($connect_pro, "INSERT INTO qa_reset SET c_serial = '$Row[0]', c_status = 'Reset berhasil', c_acard = '$data3[c_acard]', c_section = '$approval' , c_note = '$alasan', c_date = '$now'");
        } else {
            // sudah tereset semua
            $query = mysqli_query($connect_pro, "INSERT INTO qa_reset SET c_serial = '$Row[0]', c_status = 'Sudah tereset sebelumnya', c_acard = '$data3[c_acard]', c_section = '$approval', c_note = '$alasan', c_date = '$now'");
        }
    } else {
        // no seri tidak ditemukan
        $query = mysqli_query($connect_pro, "INSERT INTO qa_reset SET c_serial = '$Row[0]', c_status = 'Serial number tidak dikenali', c_acard = '-', c_section = '$approval', c_note = '$alasan', c_date = '$now'");
    }

    // isi common
    // $query = mysqli_query($connect_pro, "INSERT INTO tes SET seri = '$Row[0]'");
}

if ($query) {
    echo "selesai";
} else {
    echo "error";
}
