<?php
session_start();
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$c_serialnumber = $_SESSION['serialnumber_outside3'];
$note = $_POST['note'];

$sql = "UPDATE formng_register SET c_notecheck2 = '$note' WHERE c_serialnumber = '$c_serialnumber'";
if (mysqli_query($connect_pro, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
mysqli_close($connect_pro);
