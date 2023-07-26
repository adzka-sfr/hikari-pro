<?php
// get connection
require '../config.php';
// [a][b]
// get data lemparan
$codecode = $_POST['acard'];

// ambil kode depan
$kode = substr($codecode, 0, 1);
// (A) harus menjalanlan kode dari proses sebelumnya which is serial diawali dengan V- (V-J3232332)
if ($kode == 'V') {
    // # disini ditambahkan pengecekan apakah ada pada tabel register
    // [a] menjalankan code Serial number
    $serialnumber = substr($codecode, 2);
    $q5 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_register WHERE c_serialnumber = '$serialnumber'");
    $d5 = mysqli_fetch_array($q5);

    if ($d5['total'] == 0) {
        echo json_encode(array("status" => "tidak-ada"));
    } else {
        // cek apakah kode yang di scan sudah di close statusnya alias sudah selesai sampai cek 3
        $q600 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber' AND c_repair_outsidetiga_o != ''");
        $d600 = mysqli_fetch_array($q600);
        if ($d600['total'] == 0) {
            // (B) cek apakah kode yang telah di scan sudah selesai pada proses sebelumnya
            $q6 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber' AND c_repair_outsidesatu_o != ''");
            $d6 = mysqli_fetch_array($q6);
            if ($d6['total'] == 0) {
                // update untuk cek 1 sebagai sudah validasi
                mysqli_query($connect_pro, "UPDATE finalcheck_repairtime SET c_repair_outsidesatu_o = '$now' WHERE c_serialnumber = '$serialnumber'");
                mysqli_query($connect_pro, "UPDATE finalcheck_fetch_outside SET c_repair = 'Y', c_repair_date = '$now' WHERE c_serialnumber = '$serialnumber'");
            }

            // cek apakah sudah selesai pada proses sebelumnya
            $q1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber' AND c_repair_outsidesatu_o != ''");
            $d1 = mysqli_fetch_array($q1);
            if ($d1['total'] == 0) {
                // [b] belum selesai pada proses sebelumnya (outside1 check)
                echo json_encode(array("status" => "ada-belum-selesai"));
            } else {
                // [b] sudah selesai pada proses sebelumnya (outside1 check)
                // (C) cek pada finalcheck_timestamp apakah completenessdua_i sudah keisi atau belum
                $q2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_timestamp WHERE c_serialnumber = '$serialnumber' AND c_completenessdua_i !=''");
                $d2 = mysqli_fetch_array($q2);
                if ($d2['total'] == 0) {
                    // [c] jika belum keiisi, update completeness 2 set menjadi N semua
                    // echo json_encode(array("status" => "belum-ada-data"));
                    mysqli_query($connect_pro, "UPDATE finalcheck_fetch_completeness SET c_resultdua = 'N', c_resultdua_date = '$now' WHERE c_serialnumber = '$serialnumber'");

                    // [UPDATE : finalcheck_timestamp (c_completenessdua_i)]
                    mysqli_query($connect_pro, "UPDATE finalcheck_timestamp SET c_completenessdua_i = '$now' WHERE c_serialnumber = '$serialnumber'");

                    echo json_encode(array("status" => "ada", "serialnumber" => $serialnumber));
                } else {
                    // [c] jika sudah ada
                    // (D) cek apakah proses pengecekan sudah selesai
                    $q4 = mysqli_query($connect_pro, "SELECT c_outsidedua_o FROM finalcheck_timestamp WHERE c_serialnumber = '$serialnumber'");
                    $d4 = mysqli_fetch_array($q4);

                    if (!empty($d4['c_outsidedua_o'])) {
                        // disini di cek apakah sudah out repairsatu o -> jika udah ada isi status kasih "ada-sudah-validasi"
                        // jika belum ada isi berarti masih proses validasi
                        echo json_encode(array("status" => "ada-validasi", "serialnumber" => $serialnumber));
                    } else {
                        echo json_encode(array("status" => "ada", "serialnumber" => $serialnumber));
                    }
                }
            }
        } else {
            echo json_encode(array("status" => "closed", "serialnumber" => $serialnumber));
        }
    }
} else {
    // [a] data tidak ditemukan
    echo json_encode(array("status" => "tidak-ada"));
}
