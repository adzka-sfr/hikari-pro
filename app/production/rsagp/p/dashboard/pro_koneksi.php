<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "ratio_assy_gp";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);


// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

//fungsi base_url
// function base_url($url = null)
// {
//     $base_url = "http://localhost/training/hikari";
//     if ($url != null) {
//         return $base_url . "/" . $url;
//     } else {
//         return $base_url;
//     }
// }
