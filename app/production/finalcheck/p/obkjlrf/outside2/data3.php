<?php
// get connection
require '../config.php';

// get data lemparan
$code_ng = $_POST['ng']; // ng1
$serialnumber = $_POST['serialnumber'];
$process = $_POST['process'];

// get num NG max
$q1 = mysqli_query($connect_pro, "SELECT MAX(c_number_ng) as maks FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber'");
$d1 = mysqli_fetch_array($q1);

if (empty($d1['maks'])) {
    $number_ng = 1;
} else {
    $number_ng = $d1['maks'] + 1;
}

// cek dulu apakah sudah pernah ada jenis ng tersebut
$q2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_code_ng = '$code_ng'");
$d2 = mysqli_fetch_array($q2);

if ($d2['total'] != 0) {
    echo json_encode(array("status" => 'ng-sudah-ada'));
} else {
    foreach ($_POST['cab'] as $value) {
        $sql =  mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_outside SET c_serialnumber = '$serialnumber', c_number_ng = $number_ng, c_code_ng = '$code_ng', c_code_cabinet = '$value', c_process = '$process', c_result_date = '$now'");
    }

    if (!empty($_POST['tbo'])) {
        foreach ($_POST['tbo'] as $tbo) {
            mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_loc SET c_serialnumber = '$serialnumber', c_number_ng = $number_ng, c_code_coordinate = '$tbo', c_process = '$process', c_date = '$now'");
        }
    }

    if (!empty($_POST['tbi'])) {
        foreach ($_POST['tbi'] as $tbi) {
            mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_loc SET c_serialnumber = '$serialnumber', c_number_ng = $number_ng, c_code_coordinate = '$tbi', c_process = '$process', c_date = '$now'");
        }
    }

    if (!empty($_POST['uk'])) {
        foreach ($_POST['uk'] as $uk) {
            mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_loc SET c_serialnumber = '$serialnumber', c_number_ng = $number_ng, c_code_coordinate = '$uk', c_process = '$process', c_date = '$now'");
        }
    }

    if (!empty($_POST['b'])) {
        foreach ($_POST['b'] as $b) {
            mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_loc SET c_serialnumber = '$serialnumber', c_number_ng = $number_ng, c_code_coordinate = '$b', c_process = '$process', c_date = '$now'");
        }
    }

    if (!empty($_POST['bb'])) {
        foreach ($_POST['bb'] as $bb) {
            mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_loc SET c_serialnumber = '$serialnumber', c_number_ng = $number_ng, c_code_coordinate = '$bb', c_process = '$process', c_date = '$now'");
        }
    }

    if ($sql) {
        echo json_encode(array("status" => 'berhasil'));
    }
}
