<?php
// setting default timezone
date_default_timezone_set('Asia/Jakarta');
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "ratio_assy_gp";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
$connect = new PDO("mysql:host=localhost;dbname=ratio_assy_gp", "root", "");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//fungsi base_url
function base_url($url = null)
{
  $base_url = "http://localhost/yamaha/hikari/app/production/ratio_set_assy_gp/index";
  if ($url != null) {
    return $base_url . "/" . $url;
  } else {
    return $base_url;
  }
}
