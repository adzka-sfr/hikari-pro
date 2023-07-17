<?php
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "";
$db = "mezzanine";


// Create connection
$con_pro = new mysqli($servername, $username, $password, $db);

// Check connection
if ($con_pro->connect_error) {
    die("Connection failed: " . $con_pro->connect_error);
}
