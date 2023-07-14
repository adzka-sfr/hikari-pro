<?php
// get connection
require '../config.php';

$serialnumber = isset($_POST['serialnumber']) ? $_POST['serialnumber'] : '';

if ($serialnumber != '') {
    $_SESSION['serialoutside'] = $serialnumber;
    echo json_encode(array("status" => "OK"));
}
