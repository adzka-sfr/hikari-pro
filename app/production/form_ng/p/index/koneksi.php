<?php
date_default_timezone_set('Asia/Jakarta');

$servername = "localhost";
$username = "root";
$password = "";
$db = "hikari_p_form_ng";


// Create connection
$connect_p = new mysqli($servername, $username, $password, $db);

// Check connection
if ($connect_p->connect_error) {
    die("Connection failed: " . $connect_p->connect_error);
}
