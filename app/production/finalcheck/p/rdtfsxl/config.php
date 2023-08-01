<?php
# =========================================================================== #
//waktu lokal
date_default_timezone_set('Asia/Jakarta');
session_start();
$now = date('Y-m-d H:i:s');

//koneksi oracle
$username = "B_ACTY";
$password = "SYSTEM";
$db = "(DESCRIPTION =
			(ADDRESS_LIST =
			  (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521))
			)
			(CONNECT_DATA =
			  (SERVICE_NAME = YIKSTAFF)
			)
		)";
$connection = oci_connect($username, $password, $db);

if (!$connection) {
	$e = oci_error();
	echo htmlentities($e['message']);
	exit();
}

//koneksi local
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");

//kumpulan session dari login
$idkar = $_SESSION['id'];
$namkar = $_SESSION['nama'];
$rolkar = $_SESSION['role'];
$depkar = $_SESSION['dept'];
$jabkar = $_SESSION['jabatan'];

$_SESSION['base_url'] = "https://172.17.192.131/hikari-pro";
function base_url($url = null)
{
	$base_url = "https://172.17.192.131/hikari-pro";
	// $base_url = "https://hikari.local/hikari";
	if ($url != null) {
		return $base_url . "/" . $url;
	} else {
		return $base_url;
	}
}
# =========================================================================== #
