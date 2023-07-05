<?php
session_start();
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$c_serialnumber = $_POST['serialnumber'];
$c_numberng = $_POST['numberng'];
$c_checked = $_SESSION['nama'];
$c_process = $_POST['process'];

// delete on record NG
$pp1 = mysqli_query($connect_pro, "DELETE FROM formng_resultong WHERE c_serialnumber = '$c_serialnumber' AND c_numberng = $c_numberng AND c_process = '$c_process'");
// delete on location
$pp1 = mysqli_query($connect_pro, "DELETE FROM formng_resultoloc WHERE c_serialnumber = '$c_serialnumber' AND c_numberng = $c_numberng AND c_process = '$c_process'");

# update sort by numberng
// formng_resultoloc
$sort_sql = mysqli_query($connect_pro, "SELECT c_numberng FROM formng_resultong WHERE c_serialnumber = '$c_serialnumber' AND c_numberng > $c_numberng");
while ($sort_data = mysqli_fetch_array($sort_sql)) {
    $c_numberng = $sort_data['c_numberng'] - 1;
    $pp1 = mysqli_query($connect_pro, "UPDATE formng_resultong SET c_numberng = $c_numberng WHERE c_serialnumber = '$c_serialnumber' AND c_numberng = $sort_data[c_numberng]");
    $pp1 = mysqli_query($connect_pro, "UPDATE formng_resultoloc SET c_numberng = $c_numberng WHERE c_serialnumber = '$c_serialnumber' AND c_numberng = $sort_data[c_numberng]");
}

if ($pp1) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($connect_pro);
