<?php
// get connection
require '../config.php';

// get data lemparan
$code_ng = $_POST['ng']; // ng1
$serialnumber = $_POST['serialnumber'];
$process = $_POST['process'];
$numberng = $_POST['numberng'];

// delete data number ng yang lama
$q1 = mysqli_query($connect_pro, "DELETE FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_code_ng = '$code_ng' AND c_process = '$process'");
$q3 = mysqli_query($connect_pro, "DELETE FROM finalcheck_fetch_loc WHERE c_serialnumber = '$serialnumber' AND c_number_ng = $numberng  AND c_process = '$process'");


foreach ($_POST['cabedit'] as $value) {
    $sql =  mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_outside SET c_serialnumber = '$serialnumber', c_number_ng = $numberng, c_code_ng = '$code_ng', c_code_cabinet = '$value', c_process = '$process', c_result_date = '$now'");
}

if (!empty($_POST['tbo'])) {
    foreach ($_POST['tbo'] as $tbo) {
        mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_loc SET c_serialnumber = '$serialnumber', c_number_ng = $numberng, c_code_coordinate = '$tbo', c_process = '$process', c_date = '$now'");
    }
}

if (!empty($_POST['tbi'])) {
    foreach ($_POST['tbi'] as $tbi) {
        mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_loc SET c_serialnumber = '$serialnumber', c_number_ng = $numberng, c_code_coordinate = '$tbi', c_process = '$process', c_date = '$now'");
    }
}

if (!empty($_POST['uk'])) {
    foreach ($_POST['uk'] as $uk) {
        mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_loc SET c_serialnumber = '$serialnumber', c_number_ng = $numberng, c_code_coordinate = '$uk', c_process = '$process', c_date = '$now'");
    }
}

if (!empty($_POST['b'])) {
    foreach ($_POST['b'] as $b) {
        mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_loc SET c_serialnumber = '$serialnumber', c_number_ng = $numberng, c_code_coordinate = '$b', c_process = '$process', c_date = '$now'");
    }
}

if (!empty($_POST['bb'])) {
    foreach ($_POST['bb'] as $bb) {
        mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_loc SET c_serialnumber = '$serialnumber', c_number_ng = $numberng, c_code_coordinate = '$bb', c_process = '$process', c_date = '$now'");
    }
}

if ($sql) {
    echo json_encode(array("status" => 'berhasil'));
}
