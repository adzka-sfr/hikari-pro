<?php
// setting default timezone
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();

$servername = "localhost";
$username = "root";
$password = "";

// database
$db1 = "hikari";
$db2 = "hikari_project";
$db3 = "hikari_log";

// Create connection for main database (hikari)
$connect = new mysqli($servername, $username, $password, $db1);
// Create connection for project database (hikari_project)
$connect_pro = new mysqli($servername, $username, $password, $db2);
// Create connection for log database (hikari_log)
$connect_log = new mysqli($servername, $username, $password, $db3);

// Check connection
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
// jangan lupa mengganti base url
// fungsi base_url
$_SESSION['base_url'] = "https://hikari.local/hikari";
// $_SESSION['base_url'] = "https://172.17.192.242/hikari";
function base_url($url = null)
{
  // $base_url = "https://172.17.192.242/hikari";
  $base_url = "https://hikari.local/hikari";
  if ($url != null) {
    return $base_url . "/" . $url;
  } else {
    return $base_url;
  }
}
