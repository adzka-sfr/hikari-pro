<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];

// update trend cabinet and trend ng
$q5s = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_process = '$publicprocess'");
$d5s = mysqli_fetch_array($q5s);
if ($d5s != 0) {
    // trend cabinet
    $q5r = mysqli_query($connect_pro, "SELECT c_code_cabinet , COUNT(c_code_cabinet) AS total FROM finalcheck_fetch_outside WHERE c_process = '$publicprocess' GROUP BY c_code_cabinet");
    while ($d5r = mysqli_fetch_array($q5r)) {
        $q5i = mysqli_query($connect_pro, "SELECT c_trend FROM finalcheck_list_cabinet WHERE c_code_cabinet = '$d5r[c_code_cabinet]'");
        $d5i = mysqli_fetch_array($q5i);
        $trend_cabnow = $d5r['total'] + $d5i['c_trend'];
        // update trend
        mysqli_query($connect_pro, "UPDATE finalcheck_list_cabinet SET c_trend = $trend_cabnow WHERE c_code_cabinet = '$d5r[c_code_cabinet]'");
    }

    // trend ng
    $q6r = mysqli_query($connect_pro, "SELECT c_code_ng, COUNT(c_code_ng) as total FROM finalcheck_fetch_outside WHERE c_process = '$publicprocess' GROUP BY c_code_ng");
    while ($d6r = mysqli_fetch_array($q6r)) {
        $q6i = mysqli_query($connect_pro, "SELECT c_trend FROM finalcheck_list_ng WHERE c_code_ng = '$d6r[c_code_ng]'");
        $d6i = mysqli_fetch_array($q6i);
        $trend_ngnow = $d6r['total'] + $d6i['c_trend'];
        // update trend
        mysqli_query($connect_pro, "UPDATE finalcheck_list_ng SET c_trend = $trend_ngnow WHERE c_code_ng = '$d6r[c_code_ng]'");
    }
}

$q1 = mysqli_query($connect_pro, "UPDATE finalcheck_timestamp SET c_outsidesatu_o = '$now' WHERE c_serialnumber = '$serialnumber'");
$q3 = mysqli_query($connect_pro, "UPDATE finalcheck_pic SET c_outsidesatu = '$namkar' WHERE c_serialnumber = '$serialnumber'");

// jika ada yang ng untuk completeness langsung isi untuk repairnya sebagai default N
$com_bypass = '';
$q2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$serialnumber' AND c_resultsatu = 'N'");
$d2 = mysqli_fetch_array($q2);
if ($d2['total'] != 0) {
    mysqli_query($connect_pro, "UPDATE finalcheck_fetch_completeness SET c_repairsatu = 'N' , c_repairsatu_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_resultsatu = 'N'");
} else {
    $com_bypass = 'bypass';
}

// jika ada yang ng untuk outside langsung isi untuk repairnya sebagai default N
$out_bypass = '';
$q4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_process = '$publicprocess'");
$d4 = mysqli_fetch_array($q4);
if ($d4['total'] != 0) {
    mysqli_query($connect_pro, "UPDATE finalcheck_fetch_outside SET c_repair = 'N' , c_repair_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_process = '$publicprocess'");
} else {
    $out_bypass = 'bypass';
}

// jika keduanya bypass maka langsung kirim ke proses berikutnya
if ($com_bypass == 'bypass' and $out_bypass == 'bypass') {
    mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_repair_outsidesatu_o = '$now' WHERE c_serialnumber = '$serialnumber'");
}

if ($q1) {
    echo json_encode(array("status" => "OK"));
}
