<?php

$servername = "localhost";
$username = "root";
$password = "";

// database
$db1 = "hikari";
$db2 = "hikari_project";
$db3 = "hikari_log";

// Create connection
$connect = new mysqli($servername, $username, $password, $db1);
$connect_pro = new mysqli($servername, $username, $password, $db2);
$connect_log = new mysqli($servername, $username, $password, $db3);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
