<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];

$sql = mysqli_query($connect_pro, "SELECT DISTINCT a.c_process, c.c_code_type FROM finalcheck_fetch_outside a INNER JOIN finalcheck_register b ON a.c_serialnumber = b.c_serialnumber INNER JOIN finalcheck_list_piano c ON b.c_gmc = c.c_gmc WHERE a.c_serialnumber = '$serialnumber'");
$data = mysqli_fetch_array($sql);

echo json_encode(array("process" => $data['c_process'], "codetype" => $data['c_code_type']));
