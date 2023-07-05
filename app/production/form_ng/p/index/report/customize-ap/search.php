<?php

$username = "B_ACTY";
$password = "SYSTEM";
$db = "(DESCRIPTION =(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521)))(CONNECT_DATA = (SERVICE_NAME = YIKSTAFF)))";

$connection = oci_connect($username, $password, $db);

if (!$connection) {
    $e = oci_error();
    echo htmlentities($e['message']);
    exit();
}


$servername2 = "localhost";
$username2 = "root";
$password2 = "";

// database
$db1 = "hikari";
$db2 = "hikari_project";
$db3 = "hikari_log";
// Create connection for main database (hikari)
$connect = new mysqli($servername2, $username2, $password2, $db1);
// Create connection for project database (hikari_project)
$connect_pro = new mysqli($servername2, $username2, $password2, $db2);
// Create connection for log database (hikari_log)
$connect_log = new mysqli($servername2, $username2, $password2, $db3);


if (empty($_POST['isia'])) {
    $gmc = '';
} else {
    $gmc = $_POST['isia'];
    $gmc = strtoupper($gmc);
    $sql1 =
        "SELECT B_ACTY.M0010.HMNM AS NAMA
        FROM B_ACTY.M0010
        WHERE  B_ACTY.M0010.HMCD = '$gmc'
        AND B_ACTY.M0010.MAKEKTCD = 'U700'";

    $statment1 = oci_parse($connection, $sql1);
    oci_execute($statment1);
    $data = oci_fetch_array($statment1);

    if (empty($data)) {
        echo "-";
    } else {
        echo $data['NAMA'];
    }
}
