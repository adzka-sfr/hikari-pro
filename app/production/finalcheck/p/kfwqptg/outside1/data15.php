<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];

echo json_encode(array("serialnumber" => $serialnumber));

// isi repair outsidesatu o -> time stamp

// $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_repair = 'N' AND c_process = '$publicprocess'");
// $data1 = mysqli_fetch_array($sql1);

// if ($data1['total'] == 0) {
//     echo json_encode(array("status" => "OK"));
// } else {
//     echo json_encode(array("status" => "BELUM-REPAIR"));
// }
