<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];
$code = $_POST['code'];
$ngcode = isset($_POST['ngcode']) ? $_POST['ngcode'] : '';

// (A) cek apakah ngcode nilainya kosong (transisi dari  NG ke OK)
if ($ngcode != '') {
    // [a] jika tidak kosong
    // array to string conversion
    $ng = implode("/", $ngcode);

    // [UPDATE : finalcheck_fetch_inside] ketika result radio button adalah NG, maka code NG akan di masukkan
    $sql = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_inside SET c_code_ng = '$ng' WHERE c_serialnumber = '$serialnumber' AND c_code_incheck = '$code'");
    if ($sql) {
        echo "berhasil";
    }
} else {
    // [a] kosong
    echo "ng code null";
}
