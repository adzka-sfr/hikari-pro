<?php
include_once '../../../../../../_config/koneksi.php';
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

// fungsi base_loc = base lokal
function base_loc($url = null)
{

    $base_loc = $_SESSION['base_url'] . "/app/production/rsagp/p/dashboard";
    if ($url != null) {
        return $base_loc . "/" . $url;
    } else {
        return $base_loc;
    }
}
