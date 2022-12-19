<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

// $now = '2022-11-15';
$now = date('Y-m-d');

$date_umpama = $now;
$month_umpama = date('Y-m', strtotime($date_umpama));
$work_center = 'G130';
$otr = 0;
$semua = 0;
$dino = date('D', strtotime($now));

// CEK APAKAH HARI LIBUR ATAU TIDAK
if (($dino == 'Sat') or ($dino == 'Sun')) {
    // echo "libur dulu";
    // echo "</br>";
    $bulanan = "bulanan up dulu";
    $info = "daily ya kosong, kan libur sat";

    // CEK APAKAH SUDAH ADA DATA YANG DI MASUKKAN PADA WEEKEND
    $qlibcek = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$date_umpama' and c_work_center = '$work_center'");
    if (mysqli_num_rows($qlibcek) < 1) {
        // GET AKUMULASI KEMARIN
        // MENDAPATKAN TANGGAL TERTINGGI
        $a1 = mysqli_query($connect_pro, "SELECT MAX(c_date) as maxbro FROM otr_history WHERE c_date LIKE '$month_umpama%' and c_work_center = '$work_center'");
        $b1 = mysqli_fetch_array($a1);

        // MENCARI DATA DARI TANGGAL TERTINGGI
        $a2 = mysqli_query($connect_pro, "SELECT c_otr_qty, c_otr_acc, c_allresult_qty, c_allresult_acc FROM otr_history WHERE c_date = '$b1[maxbro]' and c_work_center = '$work_center'");
        $b2 = mysqli_fetch_array($a2);

        mysqli_query($connect_pro, "INSERT INTO otr_history set c_date = '$date_umpama', c_otr_qty = 0, c_otr_acc = $b2[c_otr_acc], c_allresult_qty = 0, c_allresult_acc = $b2[c_allresult_acc], c_work_center = '$work_center'");
    }
} else {

    // MELAKUKAN APAKAH ADA DATA PADA TABEL PRODUCTION_RESULT_MAINBODY (TABEL HASIL TR)
    $result = $connect_pro->query("SELECT * from production_result_mainbody where c_actual_date like '$date_umpama%' and c_work_center = '$work_center'");
    if ($result->num_rows > 0) {

        // JIKA ADA DATA, MELAKUKAN PERHITUNGAN TERLEBIH DAHULU, TOTAL ADA BERAPA DATA
        $sql = mysqli_query($connect_pro, "SELECT * from production_result_mainbody where c_actual_date like '$date_umpama%' and c_work_center = '$work_center'");
        while ($data = mysqli_fetch_array($sql)) {
            $plan_date = $data['c_plan_date'];
            $actual_date = $data['c_actual_date'];
            $plan_date = date('Y-m-d', strtotime($plan_date));
            $actual_date = date(
                'Y-m-d',
                strtotime($actual_date)
            );
            if ($plan_date == $actual_date) {
                $otr = $otr + $data['c_qty'];
            }
            $semua = $semua + $data['c_qty'];
        }
        // $otr = 0;
        // MEMASUKKAN DATA KE DALAM TABEL OTR HISTORY
        // DIAWALI DENGAN MENGECEK DAN MENGAMBIL DATA BULANAN, JIKA SUDAH ADA MAKA AKAN DIAMBIL DATANYA UNTUK DILAKUKAN AKUMULASI DENGAN DATA BARU
        // JIKA TIDAK ADA DATA PADA BULAN YANG DI MAKSUD, MAKA LANGSUNG MELAKUKAN INSERT

        // MELAKUKAN CEK DAN MENGAMBIL DATA BULANAN
        $sql2 = mysqli_query($connect_pro, "SELECT c_work_center, SUM(c_otr_qty) as otr_acc, SUM(c_allresult_qty) as all_acc from otr_history where c_date like '$month_umpama%' and c_work_center = '$work_center'");
        $data2 = mysqli_fetch_array($sql2);

        if ($data2['c_work_center'] != NULL) {
            // JIKA ADA DATA BULANAN, DIAMBIL NILAI HASIL PENJUMLAHAN SAMPAI TANGGAL TERAKHIR, KEMUDIAN DI TAMBAH DENGAN DATA YANG BARU (TODAY)


            // MELAKUKAN CEK DATA TODAY, JIKA KOSONG MAKA AKAN INSERT DATA TODAY, JIKA ADA MAKA AKAN UPDATE OTR HARIAN (yang di komen paling bawah)
            $sql4 = mysqli_query($connect_pro, "SELECT * FROM otr_history where c_date = '$actual_date' and c_work_center = '$work_center'");
            $data4 = mysqli_fetch_array($sql4);

            if (empty($data4)) {
                // echo "kosong";
                $otr_acc = $data2['otr_acc'] + $otr;
                $all_acc = $data2['all_acc'] + $semua;
                $info = "Data hari " . $date_umpama . " belum ada, telah melakukan insert";
                mysqli_query($connect_pro, "INSERT INTO otr_history set c_date = '$actual_date', c_otr_qty = $otr, c_otr_acc = $otr_acc, c_allresult_qty = $semua, c_allresult_acc = $all_acc, c_work_center = '$work_center'");
            } else {
                // echo "ada";
                // MENGAMBIL AKUMULASI SAMPE HARI INI
                $sql5 = mysqli_query($connect_pro, "SELECT SUM(c_otr_qty) AS yes_otr, SUM(c_allresult_qty) AS yes_all FROM otr_history WHERE c_date LIKE '$month_umpama%' and c_date < '$now' and c_work_center = '$work_center'");
                $data5 = mysqli_fetch_array($sql5);
                $otr_acc = $data5['yes_otr'] + $otr;
                $all_acc = $data5['yes_all'] + $semua;
                $info = "Data hari " . $date_umpama . " sudah ada, telah melakukan update";
                mysqli_query($connect_pro, "UPDATE otr_history set c_otr_qty = $otr, c_otr_acc = $otr_acc, c_allresult_qty = $semua, c_allresult_acc = $all_acc where c_date = '$actual_date' and c_work_center = '$work_center'");
            }
            $bulanan = "Data bulanan sudah ada";
        } else {
            // KALAU DATA PADA BULAN INI GADA LANGSUNG SAJA INSERT
            $info = "Data hari " . $date_umpama . " belum ada, telah melakukan insert";
            $bulanan = "Data bulanan belum ada";
            mysqli_query($connect_pro, "INSERT INTO otr_history set c_date = '$actual_date', c_otr_qty = $otr, c_otr_acc = $otr, c_allresult_qty = $semua, c_allresult_acc = $semua, c_work_center = '$work_center'");
        }
    } else {
        $bulanan = "data bulanan tidak diketahui";
        $info = "(" . $work_center . ") data pada tanggal " . $date_umpama . " kosong";
    }
}

// echo $bulanan;
// echo "</br>";
// echo $info;
