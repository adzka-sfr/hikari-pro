<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];
$codeng = $_POST['codeng'];
$process = $_POST['process'];
$numberng = $_POST['numberng'];

$q1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_process = '$process' AND c_code_ng = '$codeng'");
$d1 = mysqli_fetch_array($q1);

if ($d1['total'] == 0) {
    echo json_encode(array("status" => "GAGAL"));
} else {
    // delete ng
    $q2 = mysqli_query($connect_pro, "DELETE FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_code_ng = '$codeng' AND c_process = '$process'");
    if ($q2) {
        // delete loc
        $q3 = mysqli_query($connect_pro, "DELETE FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_number_ng = $numberng AND c_process = '$process'");

        // update number ng
        $q4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_code_ng = '$codeng'");
        $d4 = mysqli_fetch_array($q4);

        if ($d4['total'] == 0) {
            $q5 = mysqli_query($connect_pro, "SELECT c_number_ng FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_number_ng > $numberng");
            while ($d5 = mysqli_fetch_array($q5)) {
                $number_ng_now = $d5['c_number_ng'] - 1;
                $d6 = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_outside SET c_number_ng = $number_ng_now WHERE c_serialnumber = '$serialnumber' AND c_number_ng = $d5[c_number_ng]");
                $d7 = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_loc SET c_number_ng = $number_ng_now WHERE c_serialnumber = '$serialnumber' AND c_number_ng = $d5[c_number_ng]");
            }
        }
    }
    echo json_encode(array("status" => "OK"));
}
