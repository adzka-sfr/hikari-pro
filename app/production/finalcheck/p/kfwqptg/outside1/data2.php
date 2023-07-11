<?php
// get connection
require '../config.php';

// get data lemparan
$stat = $_POST['stat'];

if ($stat == 'update') {
    $serialnumber = $_POST['serialnumber'];
    $note = $_POST['note'];

    // [UPDATE : finalcheck_note] ketika on blur langsung update
    $sql = mysqli_query($connect_pro, "UPDATE finalcheck_note SET c_outsidesatu = '$note' WHERE c_serialnumber = '$serialnumber'");

    if ($sql) {
        echo $note;
    }
} else {
    $serialnumber = $_POST['serialnumber'];
    // [SELECT : finalcheck_note] ketika baru load
    $sql = mysqli_query($connect_pro, "SELECT c_outsidesatu FROM finalcheck_note WHERE c_serialnumber = '$serialnumber'");
    $data = mysqli_fetch_array($sql);

    if ($sql) {
        echo $data['c_outsidesatu'];
    }
}
