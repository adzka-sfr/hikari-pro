<?php
// get connection
require '../config.php';
// [a][b]
// get data lemparan
$codecode = $_POST['acard'];

// ambil kode depan
$kode = substr($codecode, 0, 1);
// (A) harus menjalanlan kode dari proses sebelumnya which is serial diawali dengan X- (X-J3232332)
if ($kode == 'X') {
    // [a] menjalankan code Serial number
    $serialnumber = substr($codecode, 2);
    // (B) cek apakah kode yang telah di scan sudah selesai pada proses sebelumnya
    $q1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber' AND c_repair_inside_o != ''");
    $d1 = mysqli_fetch_array($q1);
    if ($d1['total'] == 0) {
        // [b] belum selesai pada proses sebelumnya (inside check)
        echo json_encode(array("status" => "ada-belum-selesai"));
    } else {
        // [b] sudah selesai pada proses sebelumnya (inside check)
        // (C) cek pada finalcheck_timestamp apakah completenesssatu_i sudah keisi atau belum
        $q2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_timestamp WHERE c_serialnumber = '$serialnumber' AND c_completenesssatu_i !=''");
        $d2 = mysqli_fetch_array($q2);
        if ($d2['total'] == 0) {
            // [c] jika belum keiisi, ambil c_code_model pada tabel finalcheck_list_piano untuk mengambil data pada finalcheck_list_completeness_model
            // echo json_encode(array("status" => "belum-ada-data"));
            $q3 = mysqli_query($connect_pro, "SELECT c.c_code_completeness FROM finalcheck_register a INNER JOIN finalcheck_list_piano b ON a.c_gmc = b.c_gmc INNER JOIN finalcheck_list_completeness_model c ON b.c_code_model = c.c_code_model WHERE a.c_serialnumber = '$serialnumber'");
            while ($d3 = mysqli_fetch_array($q3)) {
                // sekalian insert completeness  awal sebagai N
                mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_completeness SET c_serialnumber = '$serialnumber', c_code_completeness = '$d3[c_code_completeness]', c_resultsatu = 'N', c_resultsatu_date = '$now'");
            }
            // [UPDATE : finalcheck_timestamp (c_completenesssatu_i)]
            mysqli_query($connect_pro, "UPDATE finalcheck_timestamp SET c_completenesssatu_i = '$now' WHERE c_serialnumber = '$serialnumber'");

            echo json_encode(array("status" => "ada", "serialnumber" => $serialnumber));
        } else {
            // [c] jika sudah ada
            // (D) cek apakah proses pengecekan sudah selesai
            $q4 = mysqli_query($connect_pro, "SELECT c_outsidesatu_o FROM finalcheck_timestamp WHERE c_serialnumber = '$serialnumber'");
            $d4 = mysqli_fetch_array($q4);

            if (!empty($d4['c_outsidesatu_o'])) {
                // disini di cek apakah sudah out repairsatu o -> jika udah ada isi status kasih "ada-sudah-validasi"
                // jika belum ada isi berarti masih proses validasi
                echo json_encode(array("status" => "ada-validasi", "serialnumber" => $serialnumber));
            } else {
                echo json_encode(array("status" => "ada", "serialnumber" => $serialnumber));
            }
        }
    }
} else {
    // [a] data tidak ditemukan
    echo json_encode(array("status" => "tidak-ada"));
}
