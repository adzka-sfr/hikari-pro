<?php
// get connection
require '../config.php';

// get data lemparan
$stat = $_POST['stat'];

if ($stat == 'update') {
    $serialnumber = $_POST['serialnumber'];
    $note = $_POST['note'];

    // [UPDATE : finalcheck_note] ketika on blur langsung update
    $sql = mysqli_query($connect_pro, "UPDATE finalcheck_note SET c_completenesstiga = '$note' WHERE c_serialnumber = '$serialnumber'");

    if ($sql) {
        echo json_encode(array("note3" => $note));
    }
} else {
    $serialnumber = $_POST['serialnumber'];
    // [SELECT : finalcheck_note] ketika baru load
    $sql = mysqli_query($connect_pro, "SELECT c_completenesssatu, c_completenessdua, c_completenesstiga FROM finalcheck_note WHERE c_serialnumber = '$serialnumber'");
    $data = mysqli_fetch_array($sql);

    if ($sql) {
        echo json_encode(array("note1" => $data['c_completenesssatu'], "note2" => $data['c_completenessdua'], "note3" => $data['c_completenesstiga']));
    }
}
