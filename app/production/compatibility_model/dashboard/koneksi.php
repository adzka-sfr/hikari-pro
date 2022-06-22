<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "keselarasan_model";


// Create connection
$connect_cm = new mysqli($servername, $username, $password, $db);

// Check connection
if ($connect_cm->connect_error) {
    die("Connection failed: " . $connect_cm->connect_error);
}
