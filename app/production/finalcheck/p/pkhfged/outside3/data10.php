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
$q4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_process = '$publicprocess'");
$d4 = mysqli_fetch_array($q4);
if ($d4['total'] != 0) {
    mysqli_query($connect_pro, "UPDATE finalcheck_fetch_outside SET c_repair = 'N' , c_repair_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_process = '$publicprocess'");
} else {
    $out_bypass = 'bypass';
}

// jika keduanya bypass maka langsung kirim ke proses berikutnya
if ($com_bypass == 'bypass' and $out_bypass == 'bypass') {
    $bypass = mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_repair_outsidetiga_o = '$now' WHERE c_serialnumber = '$serialnumber'");

    // sent to main table
    if ($bypass) {
        // hitung dulu totalnya data completeness
        $q6 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$serialnumber'");
        $d6 = mysqli_fetch_array($q6);
        // move data from fetch completeness
        $a = 0;
        $q5 = mysqli_query($connect_pro, "SELECT * FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$serialnumber'");
        while ($d5 = mysqli_fetch_array($q5)) {
            mysqli_query($connect_pro, "INSERT INTO finalcheck_completeness SET c_serialnumber = '$d5[c_serialnumber]', c_code_completeness = '$d5[c_code_completeness]', c_resultsatu = '$d5[c_resultsatu]',c_resultdua = '$d5[c_resultdua]', c_resulttiga = '$d5[c_resulttiga]', c_repairsatu = '$d5[c_repairsatu]', c_repairdua = '$d5[c_repairdua]', c_repairtiga = '$d5[c_repairtiga]', c_resultsatu_date = '$d5[c_resultsatu_date]', c_resultdua_date = '$d5[c_resultdua_date]', c_resulttiga_date = '$d5[c_resulttiga_date]', c_repairsatu_date = '$d5[c_repairsatu_date]', c_repairdua_date = '$d5[c_repairdua_date]', c_repairtiga_date = '$d5[c_repairtiga_date]'");
            $a++;
        }
        // hapus jik angka sudah sama
        if ($d6['total'] == $a) {
            mysqli_query($connect_pro, "DELETE FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$serialnumber'");
        }

        // hitung dulu totalnya data outside
        $q7 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber'");
        $d7 = mysqli_fetch_array($q7);
        // move data from fetch outside
        $b = 0;
        $q8 = mysqli_query($connect_pro, "SELECT * FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber'");
        while ($d8 = mysqli_fetch_array($q8)) {
            mysqli_query($connect_pro, "INSERT INTO finalcheck_outside SET c_serialnumber = '$d8[c_serialnumber]', c_number_ng = $d8[c_number_ng], c_code_ng = '$d8[c_code_ng]', c_code_cabinet = '$d8[c_code_cabinet]', c_process = '$d8[c_process]', c_repair = '$d8[c_repair]', c_result_date = '$d8[c_result_date]', c_repair_date = '$d8[c_repair_date]'");
            $b++;
        }
        // hapus jika total sudah sama
        if ($d7['total'] == $b) {
            mysqli_query($connect_pro, "DELETE FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber'");
        }

        // hitung dulu totalnya data loc
        $q9 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber'");
        $d9 = mysqli_fetch_array($q9);

        // move data from fetch loc
        $c = 0;
        $q10 = mysqli_query($connect_pro, "SELECT * FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber'");
        while ($d10 = mysqli_fetch_array($q10)) {
            mysqli_query($connect_pro, "INSERT INTO finalcheck_loc SET c_serialnumber = '$d10[c_serialnumber]', c_number_ng = $d10[c_number_ng], c_code_coordinate = '$d10[c_code_coordinate]', c_process = '$d10[c_process]', c_date = '$d10[c_date]'");
            $c++;
        }
        //hapus jika total sudah sama
        if ($d9['total'] == $c) {
            mysqli_query($connect_pro, "DELETE FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber'");
        }
    }
}

if ($q1) {
    echo json_encode(array("status" => "OK"));
}
