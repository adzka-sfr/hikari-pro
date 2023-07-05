<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();

$today = date('Y-m-d', strtotime($now));
// data
$location = $_SESSION['role'];
$c_pic = $_SESSION['id'];
$serial = $_POST['serial'];

// get length of serial number
$length = strlen($serial);

// cek dulu ada tidaknya pada table pre-pre
$q5 = mysqli_query($connect_pro, "SELECT COUNT(id) as isi, c_gmc FROM qa_staking_pre_pre WHERE c_location = '$location'");
$d5 = mysqli_fetch_array($q5);
if ($d5['isi'] == 0) {
    // masih kosong
    // cek dulu pada qa count staking, manatau ada tapi ambil gmc nya dulu
    if ($length == 10) {
        $q6 = mysqli_query($connect_pro, "SELECT * FROM qa_userp WHERE c_serialuserp = '$serial'");
        $d6 = mysqli_fetch_array($q6);
        if (!empty($d6['c_gmc'])) {
            $gmc = $d6['c_gmc'];
        } else {
            $gmc = 'icikiwir';
        }
    } elseif ($length == 14) {
        $q6 = mysqli_query($connect_pro, "SELECT * FROM qa_bench WHERE c_serialbench = '$serial'");
        $d6 = mysqli_fetch_array($q6);
        if (!empty($d6['c_gmc'])) {
            $gmc = $d6['c_gmc'];
        } else {
            $gmc = 'icikiwir';
        }
    } else {
        $gmc = 'icikiwir';
    }
    $q7 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as isi FROM qa_count_staking WHERE c_gmc = '$gmc' AND c_location = '$location'");
    $d7 = mysqli_fetch_array($q7);
    if ($d7['isi'] != 0) {
        $q8 = mysqli_query($connect_pro, "SELECT * FROM qa_count_staking WHERE c_gmc = '$gmc' AND c_location = '$location'");
        while ($d8 = mysqli_fetch_array($q8)) {
            mysqli_query($connect_pro, "INSERT INTO qa_staking_pre_pre SET c_gmc = '$d8[c_gmc]', c_name = '$d8[c_name]', c_serialnumber = '$d8[c_serialnumber]', c_location = '$d8[c_location]', c_type = '$d8[c_type]', c_staking_date = '$d8[c_staking_date]'");
        }
        mysqli_query($connect_pro, "DELETE FROM qa_count_staking WHERE c_gmc = '$gmc' AND c_location = '$location'");
        $gmc_set = "boleh";
    } else {
        $gmc_set = "boleh";
    }
} else {
    // sudah ada isi, cek gmcnya
    if ($length == 10) {
        $q6 = mysqli_query($connect_pro, "SELECT * FROM qa_userp WHERE c_serialuserp = '$serial'");
        $d6 = mysqli_fetch_array($q6);
        //cek isi untuk gmc
        if (empty($d6['c_gmc'])) {
            $gmc_set = "tidak_boleh";
        } else {
            if ($d5['c_gmc'] == $d6['c_gmc']) {
                $gmc_set = "boleh";
            } else {
                $gmc_set = "tidak-boleh";
            }
        }
    } elseif ($length == 14) {
        $q6 = mysqli_query($connect_pro, "SELECT * FROM qa_bench WHERE c_serialbench = '$serial'");
        $d6 = mysqli_fetch_array($q6);
        // cek isi untuk gmc
        if (empty($d6['c_gmc'])) {
            $gmc_set = "icikiwir";
        } else {
            if ($d5['c_gmc'] == $d6['c_gmc']) {
                $gmc_set = "boleh";
            } else {
                $gmc_set = "tidak-boleh";
            }
        }
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// $gmc_set = substr($_SESSION['gmc-set'], 1, 7);

if ($length == 10) {
    $c_type = 'userpackage';
    // cek apakah no seri terdaftar pada qa_userp dan memastikan no seri userp belum di packing
    $q1 = mysqli_query($connect_pro, "SELECT id, c_used, c_packed, c_gmc, c_location FROM qa_userp WHERE c_serialuserp = '$serial' AND c_used IS NOT NULL");
    $d1 = mysqli_fetch_array($q1);

    // #1 percabangan untuk cek apakah no seri terdaftar
    if (!empty($d1['id'])) {
        // #2 percabangan untuk cek apakah no seri dilakukan stock taking oleh bagian terkait
        if ($d1['c_location'] == $location) {
            // #3 cek apakah sudah pernah dipakai atau belum
            if ($d1['c_packed'] == "") {
                // #4 cek apakah sudah pernah dilakukan scan untuk stock taking 
                $q2 = mysqli_query($connect_pro, "SELECT id FROM qa_staking_pre_pre WHERE c_serialnumber = '$serial'");
                $d2 = mysqli_fetch_array($q2);
                if (empty($d2['id'])) {
                    $q3 = mysqli_query($connect_pro, "SELECT * FROM qa_userp WHERE c_serialuserp = '$serial'");
                    $d3 = mysqli_fetch_array($q3);
                    // sebelum dimasukkan ke dalam tabel perhitungan, bandingkan terlebih dahulu untuk gmcnya dengan yang sudah di set sebelumnya
                    if ($gmc_set != "boleh") {
                        $sqlw = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_staking_pre_pre");
                        $dataw = mysqli_fetch_array($sqlw);
                        $gmc = $dataw['c_gmc'];
                        $nama = $dataw['c_name'];
                        echo json_encode(array("status" => "gmc-not-match", "gmc" => $gmc, "nama" => $nama));
                    } else {
                        $sql = mysqli_query($connect_pro, "INSERT INTO qa_staking_pre_pre SET c_gmc = '$d3[c_gmc]', c_type = '$c_type', c_serialnumber = '$d3[c_serialuserp]', c_name = '$d3[c_name]', c_staking_date = '$now', c_location = '$location'");
                        if ($sql) {
                            echo json_encode(array("status" => "masuk"));
                        } else {
                            echo json_encode(array("status" => "error"));
                        }
                    }
                } else {
                    echo json_encode(array("status" => "data-dah-masuk"));
                }
            } else {
                // get info sudah dipakai dimana
                $q4 = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_action = 'packing' AND c_serialuserp = '$serial'");
                $d4 = mysqli_fetch_array($q4);
                $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Stock Taking', c_error = 'Melakukan scan bench yang seharusnya sudah ter-packing', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Bench'");
                echo json_encode(array("status" => "sudah-dipakai", "jenis" => "User Package", "info" => $d4['c_serialuserp'], "serialbench" => $d4['c_serialbench'], "serialpiano" => $d4['c_serialpiano'], "serialuserp" => $d4['c_serialuserp'], "namepiano" => $d4['c_namepiano'], "gmcpiano" => $d4['c_gmcpiano'], "packingdate" => $d4['c_date']));
            }
        } else {
            $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Stock Taking', c_error = 'Melakukan scan bench yang seharusnya menjadi stock bagian lain', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Bench'");
            echo json_encode(array("status" => "bukan-porsi"));
        }
    } else {
        echo json_encode(array("status" => "tidak"));
    }
} elseif ($length == 14) {
    $c_type = 'bench';
    // cek apakah no seri terdaftar pada qa_bench dan memastikan no seri bench belum di packing
    $q1 = mysqli_query($connect_pro, "SELECT id, c_used, c_packed, c_gmc, c_location FROM qa_bench WHERE c_serialbench = '$serial' AND c_used IS NOT NULL");
    $d1 = mysqli_fetch_array($q1);

    // percabangan untuk cek apakah no seri terdaftar
    if (!empty($d1['id'])) {
        // percabangan untuk cek apakah no seri dilakukan stock taking oleh bagian terkait
        if ($d1['c_location'] == $location) {
            // cek apakah sudah pernah dipakai atau belum
            if ($d1['c_packed'] == "") {
                // cek apakah sudah pernah dilakukan scan untuk stock taking
                $q2 = mysqli_query($connect_pro, "SELECT id FROM qa_staking_pre_pre WHERE c_serialnumber = '$serial'");
                $d2 = mysqli_fetch_array($q2);
                if (empty($d2['id'])) {
                    $q3 = mysqli_query($connect_pro, "SELECT * FROM qa_bench WHERE c_serialbench = '$serial'");
                    $d3 = mysqli_fetch_array($q3);

                    // sebelum dimasukkan ke dalam tabel perhitungan, bandingkan terlebih dahulu untuk gmcnya dengan yang sudah di set sebelumnya
                    if ($gmc_set != "boleh") {
                        $sqlw = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_staking_pre_pre");
                        $dataw = mysqli_fetch_array($sqlw);
                        $gmc = $dataw['c_gmc'];
                        $nama = $dataw['c_name'];
                        echo json_encode(array("status" => "gmc-not-match", "gmc" => $gmc, "nama" => $nama));
                    } else {
                        $sql = mysqli_query($connect_pro, "INSERT INTO qa_staking_pre_pre SET c_gmc = '$d3[c_gmc]', c_type = '$c_type', c_serialnumber = '$d3[c_serialbench]', c_name = '$d3[c_name]', c_staking_date = '$now', c_location = '$location'");
                        if ($sql) {
                            echo json_encode(array("status" => "masuk"));
                        } else {
                            echo json_encode(array("status" => "error"));
                        }
                    }
                } else {
                    echo json_encode(array("status" => "data-dah-masuk"));
                }
            } else {
                // get info sudah dipakai dimana
                $q4 = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_action = 'packing' AND c_serialbench = '$serial'");
                $d4 = mysqli_fetch_array($q4);
                $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Stock Taking', c_error = 'Melakukan scan user package yang seharusnya sudah ter-packing', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'User Package'");
                echo json_encode(array("status" => "sudah-dipakai", "jenis" => "Bench", "info" => $d4['c_serialbench'], "serialbench" => $d4['c_serialbench'], "serialpiano" => $d4['c_serialpiano'], "serialuserp" => $d4['c_serialuserp'], "namepiano" => $d4['c_namepiano'], "gmcpiano" => $d4['c_gmcpiano'], "packingdate" => $d4['c_date']));
            }
        } else {
            $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Stock Taking', c_error = 'Melakukan scan bench yang seharusnya menjadi stock bagian lain', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'User Package'");
            echo json_encode(array("status" => "bukan-porsi"));
        }
    } else {
        echo json_encode(array("status" => "tidak"));
    }
} else {
    echo json_encode(array("status" => "tidak"));
}
