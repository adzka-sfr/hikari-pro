<?php
$username = "KSTAFFRO";
$password = "yikstaff";
$db = "(DESCRIPTION =(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521)))(CONNECT_DATA = (SERVICE_NAME = YIKSTAFF)))";

$connection = oci_connect($username, $password, $db);

if (!$connection) {
    $e = oci_error();
    echo htmlentities($e['message']);
    exit();
}

// Information K-Staff
// - penulisan work center menggunakan huruf kapital
// - penulisan tanggal menggunakan format -> 2022/08/26 14:23:00
