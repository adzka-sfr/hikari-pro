<?php
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "";
$db = "hikari_project";


// Create connection
$connect_pro = new mysqli($servername, $username, $password, $db);

// Check connection
if ($connect_pro->connect_error) {
    die("Connection failed: " . $connect_pro->connect_error);
}
