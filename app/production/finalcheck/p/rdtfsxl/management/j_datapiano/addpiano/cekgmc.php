<?php
require '../../../config.php';

$username = "B_ACTY";
$password = "SYSTEM";
$db = "(DESCRIPTION =(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521)))(CONNECT_DATA = (SERVICE_NAME = YIKSTAFF)))";

$connection = oci_connect($username, $password, $db);

// get data lemparan
$gmc = isset($_POST['gmc']) ? $_POST['gmc'] : '';

if ($gmc != '') {


    // cek pada oracle
    $sql1 =
        "SELECT B_ACTY.M0010.HMNM AS NAMA
        FROM B_ACTY.M0010
        WHERE  B_ACTY.M0010.HMCD = '$gmc'
        AND B_ACTY.M0010.MAKEKTCD = 'U700'";

    $statment1 = oci_parse($connection, $sql1);
    oci_execute($statment1);
    $data = oci_fetch_array($statment1);

    if (empty($data)) {
        echo json_encode(array("status" => "not-found", "value" => "-"));
    } else {
        echo json_encode(array("status" => "found", "value" => $data['NAMA']));
    }
}else{
    echo json_encode(array("status" => "null", "value" => "x"));
}
