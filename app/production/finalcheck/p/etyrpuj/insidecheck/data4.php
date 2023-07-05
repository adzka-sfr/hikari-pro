<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];
// [SELECT : finalcheck_fetch_incheck] cek apakah masih ada status NG namun belum memilih NG
$sql = mysqli_query($connect_pro, "SELECT COUNT(c_code_incheck) AS total FROM finalcheck_fetch_incheck WHERE c_serialnumber = '$serialnumber' AND c_result = 'NG' AND c_code_ng is null OR c_serialnumber = '$serialnumber' AND c_result = 'NG' AND c_code_ng = ''");
$data = mysqli_fetch_array($sql);

if ($data['total'] == 0) {
    echo json_encode(array("status" => "OK"));
} else {
    $i = 0;
    $a = array();
    // [SELECT : finalcheck_fetch_incheck INNER JOIN finalcheck_list_incheck] untuk mengambil item mana yang belum dimasukkan ng nya
    $sql1 = mysqli_query($connect_pro, "SELECT b.c_detail FROM finalcheck_fetch_incheck a INNER JOIN finalcheck_list_incheck b ON a.c_code_incheck = b.c_code_incheck WHERE a.c_serialnumber = '$serialnumber' AND a.c_result = 'NG' AND a.c_code_ng is null OR a.c_serialnumber = '$serialnumber' AND a.c_result = 'NG' AND a.c_code_ng = ''");
    while ($data1 = mysqli_fetch_array($sql1)) {
        $a[$i] = $data1['c_detail'];
        $i++;
    }

    // di implode agar data yang ditampilkan adalah string (konversi array)
    $info = implode("</li><li>", $a);
    echo json_encode(array("status" => "NG", "info" => "<ul><li>" . $info . "</ul>"));
}
