<?php
// get connection
require '../config.php';

unset($_SESSION['serialoutside']);

if (empty($_SESSION['serialoutside'])) {
    echo json_encode(array("status" => "OK"));
}
