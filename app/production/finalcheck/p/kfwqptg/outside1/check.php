<?php
// get connection
require '../config.php';
// [a][b][c][d][e][f][g][h][i]
// get data lemparan
$codecode = $_POST['acard'];

// ambil kode depan
$kode = substr($codecode, 0, 1);
// (A) harus menjalanlan kode dari proses sebelumnya which is serial diawali dengan X- (X-J3232332)
if ($kode == 'X') {
    // [a] menjalankan code Serial number
    $serialnumber = substr($codecode, 2);

    
    echo json_encode(array("status" => "ada"));
} else {
    // [a] data tidak ditemukan
    echo json_encode(array("status" => "tidak-ada"));
}
