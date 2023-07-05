<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));

$c_approval_id = $_SESSION['id'];
$c_approval = $_SESSION['nama'];
$serial = $_POST['serialpiano'];
$reason = $_POST['remason'];

// get data from qa_log
$sql = mysqli_query($connect_pro, "SELECT * FROM  qa_log WHERE c_serialpiano = '$serial' AND c_action = 'packing'");
$data = mysqli_fetch_array($sql);

// update qa_bench
$q1 = mysqli_query($connect_pro, "UPDATE qa_bench SET c_packed = NULL WHERE c_serialbench = '$data[c_serialbench]'");
if ($data['c_serialbench'] != '-') {
    $q1a = mysqli_query($connect_pro, "INSERT INTO qa_adjustlog SET c_action = 'reset', c_pic = '$c_approval_id', c_serialnumber = '$data[c_serialbench]', c_type = 'bench', c_location = '$data[c_location]', c_date = '$now', c_note = '$reason'");
}

// update qa_userp
$q2 = mysqli_query($connect_pro, "UPDATE qa_userp SET c_packed = NULL WHERE c_serialuserp = '$data[c_serialuserp]'");
if ($data['c_serialuserp'] != '-') {
    $q2a = mysqli_query($connect_pro, "INSERT INTO qa_adjustlog SET c_action = 'reset', c_pic = '$c_approval_id', c_serialnumber = '$data[c_serialuserp]', c_type = 'userpackage', c_location = '$data[c_location]', c_date = '$now', c_note = '$reason'");
}

// insert qa_adjustlog piano
$q3 = mysqli_query($connect_pro, "INSERT INTO qa_adjustlog SET c_action = 'reset', c_pic = '$c_approval_id', c_serialnumber = '$serial', c_type = 'piano', c_location = '$data[c_location]', c_date = '$now', c_note = '$reason'");

// update qa_log c_action -> reset
$q4 = mysqli_query($connect_pro, "UPDATE qa_log SET c_action = 'reset' WHERE c_serialpiano = '$serial'");

// log reset
$query = mysqli_query($connect_pro, "INSERT INTO qa_reset SET c_serial = '$serial', c_status = 'Reset berhasil', c_acard = '$data[c_acard]', c_section = '$c_approval_id', c_note = '$reason', c_date = '$now'");

if ($query) {
    echo json_encode(array("status" => "oke"));
} else {
    echo json_encode(array("status" => "error"));
}
