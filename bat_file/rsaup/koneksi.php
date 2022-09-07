<?php

// Create connection
$connect = mysqli_connect("localhost", "root", "", "prioritas_sb");

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
