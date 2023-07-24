<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];

$q1 = mysqli_query($connect_pro, "UPDATE finalcheck_timestamp SET c_outsidetiga_o = '$now' WHERE c_serialnumber = '$serialnumber'");
$q3 = mysqli_query($connect_pro, "UPDATE finalcheck_pic SET c_outsidetiga = '$namkar' WHERE c_serialnumber = '$serialnumber'");

// jika ada yang ng untuk completeness langsung isi untuk repairnya sebagai default N
$com_bypass = '';
$q2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$serialnumber' AND c_resulttiga = 'N'");
$d2 = mysqli_fetch_array($q2);
if ($d2['total'] != 0) {
    mysqli_query($connect_pro, "UPDATE finalcheck_fetch_completeness SET c_repairtiga = 'N' , c_repairtiga_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_resulttiga = 'N'");
} else {
    $com_bypass = 'bypass';
}

// jika ada yang ng untuk completeness langsung isi untuk repairnya sebagai default N
$out_bypass = '';
$q4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber'");
$d4 = mysqli_fetch_array($q4);
if ($d4['total'] != 0) {
    mysqli_query($connect_pro, "UPDATE finalcheck_fetch_outside SET c_repair = 'N' , c_repair_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_process = '$publicprocess'");
} else {
    $out_bypass = 'bypass';
}

// jika keduanya bypass maka langsung kirim ke proses berikutnya
if ($com_bypass == 'bypass' and $out_bypass == 'bypass') {
    mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_repair_outsidetiga_o = '$now' WHERE c_serialnumber = '$serialnumber'");
}

if ($q1) {
    echo json_encode(array("status" => "OK"));
}
