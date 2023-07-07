<?php
// get connection
require '../config.php';

// get data lemparan
$serialnumber = $_POST['serialnumber'];
$item = $_POST['item'];
$ngcode = isset($_POST['ngcode']) ? $_POST['ngcode'] : '';

// [SELECT : finalcheck_fetch_inside] ambil data untuk item yang sedang aktif (code incheck)
$sql1 = mysqli_query($connect_pro, "SELECT c_code_ng FROM finalcheck_fetch_inside WHERE c_serialnumber = '$serialnumber' AND c_code_incheck = '$item'");
$data1 = mysqli_fetch_array($sql1);

// pecah dulu kode ng nya agar menjadi aray
$ng = explode('/', $data1['c_code_ng']);

// buat variabel array untuk menyimpan hasil
$hasil = array();

// mulai cek pada setiap kode ng
foreach ($ng as $val) {
    // deklarasi awal mula sebagai 'gada'
    $a = 'gada';
    // lakukan pengecekan kode ng dengan semua data hasil checklist
    foreach ($ngcode as  $valueng) {
        // jika data sama, maka variable deklarasi akan di timpa menjadi 'ada';
        if ($val == $valueng) {
            $a = 'ada';
        }
    }

    // push data ke variabel array berdasarkan hasil pengecekan
    if ($a == 'gada') {
        array_push($hasil, "NG");
    } else {
        array_push($hasil, "OK");
    }
}

// jadikan menjadi string kembali untuk di insert
$hasil_insert = implode('/', $hasil);
$sql = mysqli_query($connect_pro, "UPDATE finalcheck_fetch_inside SET c_repair = '$hasil_insert', c_repair_date = '$now' WHERE c_serialnumber = '$serialnumber' AND c_code_incheck = '$item'");

if ($sql) {
    echo "berhasil";
}
