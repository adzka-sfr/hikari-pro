<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];
$code = $_POST['code'];
$ngcode = isset($_POST['ngcode']) ? $_POST['ngcode'] : '';

if ($ngcode != '') {
    // array to string conversion
    $ng = implode("/", $ngcode);

    // [UPDATE : finalcheck_fetch_inside] ketika result radio button adalah NG, maka code NG akan di masukkan
    $sql = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_incheck SET c_code_ng = '$ng' WHERE c_serialnumber = '$serialnumber' AND c_code_incheck = '$code'");
    if ($sql) {
        echo "berhasil";
    }
} else {
    echo "ng code null";
}
