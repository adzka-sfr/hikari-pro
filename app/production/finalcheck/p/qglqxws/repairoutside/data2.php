<?php
// get connection
require '../config.php';

unset($_SESSION['serialinside']);

if (empty($_SESSION['serialinside'])) {
    echo json_encode(array("status" => "OK"));
}
