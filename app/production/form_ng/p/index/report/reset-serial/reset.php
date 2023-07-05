<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$no_seri = $_POST['seripiano'];
$alasan = $_POST['resson'];

$sql = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_serialnumber = '$no_seri'");
$data = mysqli_fetch_array($sql);
// get data to insert reset history
if ($data['c_incheckby'] != '') {
    $c_insideby = $data['c_incheckby'];
} else {
    $c_insideby = '-';
}

if ($data['c_outcheck1by'] != '') {
    $c_outside1by = $data['c_outcheck1by'];
} else {
    if ($data['c_complete1by'] != '') {
        $c_outside1by = $data['c_complete1by'];
    } else {
        $c_outside1by = '-';
    }
}

if ($data['c_outcheck2by'] != '') {
    $c_outside2by = $data['c_outcheck2by'];
} else {
    if ($data['c_complete2by'] != '') {
        $c_outside2by = $data['c_complete2by'];
    } else {
        $c_outside2by = '-';
    }
}

if ($data['c_outcheck3by'] != '') {
    $c_outside3by = $data['c_outcheck3by'];
} else {
    if ($data['c_complete3by'] != '') {
        $c_outside3by = $data['c_complete3by'];
    } else {
        $c_outside3by = '-';
    }
}

if ($c_outside3by != '-') {
    $last_process = 'Outside Check 3';
} else {
    if ($c_outside2by != '-') {
        $last_process = 'Outside Check 2';
    } else {
        if ($c_outside1by != '-') {
            $last_process = 'Outside Check 1';
        } else {
            if ($c_insideby != '-') {
                $last_process = 'Inside Check';
            } else {
                $last_process = 'Belum dilakukan check';
            }
        }
    }
}

$c_reason = $alasan;
$c_serialnumber = $data['c_serialnumber'];
$c_ctrlnumber = $data['c_ctrlnumber'];
$c_pianoname = $data['c_pianoname'];
$c_resetby = $_SESSION['nama'];
$c_datetime = $now;

// insert data ke tabel reset history
$sql = mysqli_query($connect_pro, "INSERT INTO formng_resethistory SET c_datetime = '$c_datetime', c_serialnumber = '$c_serialnumber', c_pianoname = '$c_pianoname', c_ctrlnumber = '$c_ctrlnumber', c_resetby = '$c_resetby', c_insideby = '$c_insideby', c_outside1by = '$c_outside1by', c_outside2by = '$c_outside2by', c_outside3by = '$c_outside3by', c_reason = '$c_reason'");

// hapus data pada proses repair outside
$sql = mysqli_query($connect_pro, "DELETE FROM formng_repairdata WHERE c_serialnumber = '$c_serialnumber'");
// hapus data pada proses outside check Data
$sql = mysqli_query($connect_pro, "DELETE FROM formng_resultong WHERE c_serialnumber = '$c_serialnumber'");
// hapus data pada proses outside check Lokasi
$sql = mysqli_query($connect_pro, "DELETE FROM formng_resultoloc WHERE c_serialnumber = '$c_serialnumber'");
// hapus data pada proses completeness check
$sql = mysqli_query($connect_pro, "DELETE FROM formng_resultc WHERE c_serialnumber = '$c_serialnumber'");
// hapus data pada proses repair inside dan inside check
$sql = mysqli_query($connect_pro, "DELETE FROM formng_resulti WHERE c_serialnumber = '$c_serialnumber'");
// hapus data pada register
$sql = mysqli_query($connect_pro, "DELETE FROM formng_register WHERE c_serialnumber = '$c_serialnumber'");

if ($sql) {
    echo json_encode(array("statusCode" => 200, "serialnumber" => $c_serialnumber, "ctrlnumber" => $c_ctrlnumber, "pianoname" => $c_pianoname, "lastprocess" => $last_process, "reason" => $c_reason));
} else {
    echo json_encode(array("statusCode" => 201));
}
// var_dump($alasan); // kalau ada vardump code berikutnya tidak akan di jalankan
mysqli_close($connect_pro);
