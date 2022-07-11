<?php
// setting default timezone
date_default_timezone_set('Asia/Jakarta');
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "hikari";

// Create connection
$connect = new mysqli($servername, $username, $password, $db);


// Check connection
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

//fungsi base_url
$_SESSION['base_url'] = "http://localhost/training/hikari";
function base_url($url = null)
{
  $base_url = "http://localhost/training/hikari";
  if ($url != null) {
    return $base_url . "/" . $url;
  } else {
    return $base_url;
  }
}
