<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
$connect_add = new mysqli("localhost", "root", "", "db18silent");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();

$today = date('Y-m-d', strtotime($now));
// data
$serial = $_POST['serial'];
$location = $_SESSION['role'];
$c_pic = $_SESSION['id'];

// get lenght
$length = strlen($serial);

// cek dulu ada tidaknya pada table pre-pre
$q5 = mysqli_query($connect_pro, "SELECT COUNT(id) as isi, c_gmc FROM qa_preregister_pre_pre WHERE c_location = '$location'");
$d5 = mysqli_fetch_array($q5);
if ($d5['isi'] == 0) {
    // masih kosong
    // cek dulu pada tabel sumber masing-masing, harus ada tapi ambil gmc nya dulu
    if ($length == 10) {
        $q6 = mysqli_query($connect_add, "SELECT * FROM tb_reg_cklist WHERE no_ctrl = '$serial'");
        $d6 = mysqli_fetch_array($q6);
        if (empty($d6['item_code'])) {
            // khusus untuk user package karena kalo udah di resgister di hapus maka cek dulu pada tabel qa_userp
            $q9 = mysqli_query($connect_pro, "SELECT c_gmc FROM qa_userp WHERE c_serialuserp = '$serial'");
            $d9 = mysqli_fetch_array($q9);
            if (empty($d9['c_gmc'])) {
                $gmc = 'icikiwir';
            } else {
                $gmc = $d9['c_gmc'];
            }
        } else {
            $gmc = $d6['item_code'];
        }
    } elseif ($length == 14) {
        $q6 = mysqli_query($connect_pro, "SELECT * FROM qa_bench WHERE c_serialbench = '$serial'");
        $d6 = mysqli_fetch_array($q6);
        if (empty($d6['item_code'])) {
            $gmc = 'icikiwir';
        } else {
            $gmc = $d6['c_gmc'];
        }
    } else {
        $gmc = 'icikiwir';
    }
    $q7 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as isi FROM qa_preregister WHERE c_gmc = '$gmc' AND c_location = '$location'");
    $d7 = mysqli_fetch_array($q7);
    if ($d7['isi'] != 0) {
        $q8 = mysqli_query($connect_pro, "SELECT * FROM qa_preregister WHERE c_gmc = '$gmc' AND c_location = '$location'");
        while ($d8 = mysqli_fetch_array($q8)) {
            mysqli_query($connect_pro, "INSERT INTO qa_preregister_pre_pre SET c_gmc = '$d8[c_gmc]', c_name = '$d8[c_name]', c_serialnumber = '$d8[c_serialnumber]', c_location = '$d8[c_location]', c_type = '$d8[c_type]'");
        }
        mysqli_query($connect_pro, "DELETE FROM qa_preregister WHERE c_gmc = '$gmc' AND c_location = '$location'");
        $gmc_set = "boleh";
    } else {
        $gmc_set = "boleh";
    }
} else {
    // sudah ada isi, cek gmcnya
    if ($length == 10) {
        $q6 = mysqli_query($connect_add, "SELECT * FROM tb_reg_cklist WHERE no_ctrl = '$serial'");
        $d6 = mysqli_fetch_array($q6);

        if (empty($d6['no_ctrl'])) {
            // khusus untuk user package karena kalo udah di resgister di hapus maka cek dulu pada tabel qa_userp
            $q9 = mysqli_query($connect_pro, "SELECT c_gmc FROM qa_userp WHERE c_serialuserp = '$serial'");
            $d9 = mysqli_fetch_array($q9);
            if (empty($d9['c_gmc'])) {
                $gmc = 'icikiwir';
            } else {
                $gmc = $d9['c_gmc'];
            }

            if ($d5['c_gmc'] == $gmc) {
                $gmc_set = "boleh";
            } else {
                $gmc_set = "tidak-boleh";
            }
        } else {
            if ($d5['c_gmc'] == $d6['item_code']) {
                $gmc_set = "boleh";
            } else {
                $gmc_set = "tidak-boleh";
            }
        }
    } elseif ($length == 14) {
        $q6 = mysqli_query($connect_pro, "SELECT * FROM qa_bench WHERE c_serialbench = '$serial'");
        $d6 = mysqli_fetch_array($q6);

        if ($d5['c_gmc'] == $d6['c_gmc']) {
            $gmc_set = "boleh";
        } else {
            $gmc_set = "tidak-boleh";
        }
    }
}

/////////////////////////////////////////////////////////////////////////////////////
// cek length no seri
// 10 digit adalah user package
// 14 digit adalah bench

if ($length == 10) {
    // USER PACKAGE
    // cek apakah no seri terdaftar pada tb_reg_cklist
    $q3 = mysqli_query($connect_add, "SELECT no_ctrl, item_code, item_name FROM tb_reg_cklist WHERE no_ctrl = '$serial'");
    $d3 = mysqli_fetch_array($q3);

    if (empty($d3['no_ctrl'])) {
        $q10 = mysqli_query($connect_pro, "SELECT COUNT(c_serialuserp) as total FROM qa_userp WHERE c_serialuserp = '$serial'");
        $d10 = mysqli_fetch_array($q10);
        if ($d10['total'] == 0) {
            $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Register', c_error = 'Melakukan scan barcode yang tidak dikenali', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Bench / User Package'");
            echo json_encode(array("status" => "tidak-terdaftar"));
        } else {
            $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Register', c_error = 'Melakukan scan barcode yang sudah terdaftar', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Bench / User Package'");
            echo json_encode(array("status" => "sudah-terdaftar"));
        }
    } else {
        // cek dulu apakah sudah pernah dipakai user packagenya alias sudah pernah didaftarkan
        $q4 = mysqli_query($connect_pro, "SELECT id, c_packed FROM qa_userp WHERE c_serialuserp = '$serial'");
        $d4 = mysqli_fetch_array($q4);

        if (!empty($d4['id'])) {
            if (!empty($d4['c_packed'])) {
                $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Register', c_error = 'Melakukan scan user package yang seharusnya sudah ter-packing', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'User Package'");
                $q6 = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_action = 'packing' AND c_serialuserp = '$serial'");
                $d6 = mysqli_fetch_array($q6);
                echo json_encode(array("status" => "sudah-dipacking", "jenis" => "User package", "info" => $d6['c_serialuserp'], "serialbench" => $d6['c_serialbench'], "serialpiano" => $d6['c_serialpiano'], "serialuserp" => $d6['c_serialuserp'], "namepiano" => $d6['c_namepiano'], "gmcpiano" => $d6['c_gmcpiano'], "packingdate" => $d6['c_date']));
            } else {
                // echo "sudah-terdaftar";
                echo json_encode(array("status" => "sudah-terdaftar"));
            }
        } else {
            // cek apakah no seri sudah pernah dilakukan scan pada tabel preregister
            $q5 = mysqli_query($connect_pro, "SELECT id FROM qa_preregister_pre_pre WHERE c_serialnumber = '$serial'");
            $d5 = mysqli_fetch_array($q5);

            if (!empty($d5['id'])) {
                // echo "sudah-register";
                echo json_encode(array("status" => "sudah-register"));
            } else {
                if ($gmc_set != "boleh") {
                    $sqlw = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_preregister_pre_pre");
                    $dataw = mysqli_fetch_array($sqlw);
                    $gmc = $dataw['c_gmc'];
                    $nama = $dataw['c_name'];
                    echo json_encode(array("status" => "gmc-not-match", "gmc" => $gmc, "nama" => $nama));
                } else {
                    // alhamdulillah, akhirnya insert ke dalam pre register
                    $sql = mysqli_query($connect_pro, "INSERT INTO qa_preregister_pre_pre SET c_type = 'userpackage', c_gmc = '$d3[item_code]', c_serialnumber = '$d3[no_ctrl]', c_name = '$d3[item_name]', c_location = '$location'");
                    if ($sql) {
                        // echo "sudah-input";
                        echo json_encode(array("status" => "sudah-input"));
                    } else {
                        // echo "server-busy";
                        echo json_encode(array("status" => "server-busy"));
                    }
                }
            }
        }
    }
} elseif ($length == 14) {
    // BENCH
    // cek apakah no seri terdaftar pada qa_bench
    $q1 = mysqli_query($connect_pro, "SELECT id, c_gmc, c_name, c_used, c_packed  FROM qa_bench WHERE c_serialbench = '$serial'");
    $d1 = mysqli_fetch_array($q1);

    if (empty($d1['id'])) {
        $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Register', c_error = 'Melakukan scan barcode yang tidak dikenali', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Bench / User Package'");
        echo json_encode(array("status" => "tidak-terdaftar"));
    } else {
        // cek dulu apakah sudah pernah dipakai benchnya alias sudah pernah di daftarkan
        if (!empty($d1['c_used'])) {
            if (!empty($d1['c_packed'])) {
                $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Register', c_error = 'Melakukan scan bench yang seharusnya sudah ter-packing', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'User Package'");
                $q6 = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_action = 'packing' AND c_serialbench = '$serial'");
                $d6 = mysqli_fetch_array($q6);
                echo json_encode(array("status" => "sudah-dipacking", "jenis" => "Bench", "info" => $d6['c_serialbench'], "serialbench" => $d6['c_serialbench'], "serialpiano" => $d6['c_serialpiano'], "serialuserp" => $d6['c_serialuserp'], "namepiano" => $d6['c_namepiano'], "gmcpiano" => $d6['c_gmcpiano'], "packingdate" => $d6['c_date']));
            } else {
                // echo "sudah-terdaftar";
                echo json_encode(array("status" => "sudah-terdaftar"));
            }
        } else {
            // cek apakah no seri sudah pernah dilakukan scan pada tabel preregister
            $q2 = mysqli_query($connect_pro, "SELECT id FROM qa_preregister_pre_pre WHERE c_serialnumber = '$serial'");
            $d2 = mysqli_fetch_array($q2);

            if (!empty($d2['id'])) {
                // echo "sudah-register";
                echo json_encode(array("status" => "sudah-register"));
            } else {
                if ($gmc_set != "boleh") {
                    $sqlw = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_preregister_pre_pre");
                    $dataw = mysqli_fetch_array($sqlw);
                    $gmc = $dataw['c_gmc'];
                    $nama = $dataw['c_name'];
                    echo json_encode(array("status" => "gmc-not-match", "gmc" => $gmc, "nama" => $nama));
                } else {
                    // alhamdulillah, akhirnya insert ke dalam pre register
                    $sql = mysqli_query($connect_pro, "INSERT INTO qa_preregister_pre_pre SET c_type = 'bench', c_gmc = '$d1[c_gmc]', c_serialnumber = '$serial', c_name = '$d1[c_name]', c_location = '$location'");
                    if ($sql) {
                        // echo "sudah-input";
                        echo json_encode(array("status" => "sudah-input"));
                    } else {
                        // echo "server-busy";
                        echo json_encode(array("status" => "server-busy"));
                    }
                }
            }
        }
    }
} else {
    $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Register', c_error = 'Melakukan scan barcode yang tidak dikenali', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Bench / User Package'");
    echo json_encode(array("status" => "tidak-terdaftar"));
}
