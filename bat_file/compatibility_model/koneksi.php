<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "keselarasan_model";


// Create connection
$connect = new mysqli($servername, $username, $password, $db);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
