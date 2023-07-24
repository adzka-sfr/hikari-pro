<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];
$code = $_POST['code'];
$result = $_POST['result'];

// [UPDATE : finalcheck_fetch_inside] update status repair
$sql = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_completeness SET c_repairtiga = '$result', c_repairtiga_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_code_completeness = '$code'");

if ($sql) {
    echo "berhasil";
}
