<?php
//koneksi oracle ---->
date_default_timezone_set('Asia/Jakarta');

$username = "B_ACTY";
$password = "SYSTEM";
$db = "(DESCRIPTION =
			(ADDRESS_LIST =
			  (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521))
			)
			(CONNECT_DATA =
			  (SERVICE_NAME = YIKSTAFF)
			)
		)";
$connection = oci_connect($username, $password, $db);

if (!$connection) {
    $e = oci_error();
    echo htmlentities($e['message']);
    exit();
}

// koneksi ke mysql
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$location = $_SESSION['role'];
$c_pic = $_SESSION['id'];
$today = date('Y-m-d', strtotime($now));

// data lemparan
$acard = $_POST['acard'];

if ($acard !== "") {

    $check_class = substr($acard, 0, 1);

    if ($check_class == "U") {
        if ($location == "packing up") {
            $qry_stock = " SELECT B_ACTY.D0610.PLNNO
			, B_ACTY.D0610.ACARDNO 
			, B_ACTY.D0610.HMCD 
			, B_ACTY.D0130.SEIBAN
			, B_ACTY.M0010.HMNM
			, COUNT(B_ACTY.D0610.ACARDNO) AS QTY_ACARD
			FROM B_ACTY.D0610,
				 B_ACTY.D0130,
				 B_ACTY.M0010
			WHERE  B_ACTY.D0610.PLNNO = B_ACTY.D0130.PLNNO
			AND B_ACTY.D0610.HMCD = B_ACTY.M0010.HMCD
			AND B_ACTY.D0610.ACARDNO = '$acard'
			AND B_ACTY.D0610.PLNNO LIKE 'UP%'
			GROUP BY B_ACTY.D0610.PLNNO, B_ACTY.D0610.ACARDNO , B_ACTY.D0610.HMCD, B_ACTY.D0130.SEIBAN, B_ACTY.M0010.HMNM";

            $exc_ora = oci_parse($connection, $qry_stock);

            oci_execute($exc_ora);
            $piano = oci_fetch_array($exc_ora);

            if (isset($piano['QTY_ACARD']) and $piano['QTY_ACARD'] > 0) {
                $serial = $piano['SEIBAN'];
                // cek apakah sudah pernah di packing
                $sql = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_serialpiano = '$serial' AND c_action = 'packing'");
                $data = mysqli_fetch_array($sql);
                if (!empty($data['id'])) {
                    $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan pada A-Card yang sudah ter-packing', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Piano'");
                    echo json_encode(array("status" => "sudah-packing"));
                } else {
                    // apakah menggunakan bench, jika iya dapatkan gmc bench!
                    $gmc =  $piano['HMCD'];
                    $qry_bom_bench = "SELECT M_ACTY.M0031.OYAHMCD, M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM 
                                            FROM M_ACTY.M0031
                                            JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD
                                            WHERE M_ACTY.M0031.OYAHMCD = '$gmc'
                                            AND M_ACTY.M0010.HMSNM LIKE 'BENCH%'
                                            AND M_ACTY.M0010.HMSNM NOT LIKE '%CQ%'
                                            AND M_ACTY.M0010.HMSTATUS != 'CI'";

                    $querybom = oci_parse($connection, $qry_bom_bench);
                    oci_execute($querybom);
                    $row_bench = oci_fetch_array($querybom);
                    $gmc_bench = isset($row_bench['KOHMCD']) ? $row_bench['KOHMCD'] : "";
                    $nm_bench = isset($row_bench['HMSNM']) ? $row_bench['HMSNM'] : "";

                    if ($gmc_bench != "") {
                        // jika tidak kosong, cek apakah stock bench ada, terutama pada area terkait
                        $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as qty_bench FROM qa_bench WHERE c_gmc = '$gmc_bench' AND c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
                        $data1 = mysqli_fetch_array($sql1);

                        $stock_bench = $data1['qty_bench'];
                    } else {
                        $stock_bench = "-";
                    }

                    // apakah menggunakan user package, jika iya dapatkan gmc user package!
                    $qry_bom_userp = "SELECT M_ACTY.M0031.OYAHMCD, M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM 
                                            FROM M_ACTY.M0031
                                            JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD
                                            WHERE M_ACTY.M0031.OYAHMCD = '$gmc'
                                            AND M_ACTY.M0010.HMSNM LIKE 'USER PACKAGE SET%'
                                            AND M_ACTY.M0010.HMSNM NOT LIKE '%CQ%'
                                            AND M_ACTY.M0010.HMSTATUS != 'CI'";

                    $querybom_userp = oci_parse($connection, $qry_bom_userp);
                    oci_execute($querybom_userp);
                    $row_userp = oci_fetch_array($querybom_userp);
                    $gmc_userp = isset($row_userp['KOHMCD']) ? $row_userp['KOHMCD'] : "";
                    $nm_userp = isset($row_userp['HMSNM']) ? $row_userp['HMSNM'] : "";

                    if ($gmc_userp != "") {
                        // jika tidak kosong, cek apakah stock bench ada
                        $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as qty_userp FROM qa_userp WHERE c_gmc = '$gmc_userp' AND c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
                        $data1 = mysqli_fetch_array($sql1);

                        $stock_userp = $data1['qty_userp'];
                    } else {
                        $stock_userp = "-";
                    }

                    // var_dump($stock_bench);
                    // var_dump($stock_userp);
                    // die();

                    // hasil dari pengecekan
                    if ($stock_bench == "0" && $stock_userp == "0") {
                        $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan A-Card dengan stock bench dan user pacakage kosong', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Piano'");
                        echo json_encode(array("status" => "bench-userp-kosong", "benchgmc" => $gmc_bench, "benchname" => $nm_bench, "userpgmc" => $gmc_userp, "userpname" => $nm_userp));
                    } elseif ($stock_bench == "0") {
                        $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan A-Card dengan stock bench kosong', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Piano'");
                        echo json_encode(array("status" => "bench-kosong", "benchgmc" => $gmc_bench, "benchname" => $nm_bench));
                    } elseif ($stock_userp == "0") {
                        $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan A-Card dengan stock user package kosong', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Piano'");
                        echo json_encode(array("status" => "userp-kosong", "userpgmc" => $gmc_userp, "userpname" => $nm_userp));
                    } else {
                        // echo "ada-belum-packing";
                        echo json_encode(array("status" => "ada-belum-packing"));
                    }
                }
            } else {
                $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan A-Card tidak dikenali', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$acard', c_type = 'Piano'");
                echo json_encode(array("status" => "kosong"));
            }
        } else {
            $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan pada A-Card yang bukan wewenangnya', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$acard', c_type = 'Piano'");
            echo json_encode(array("status" => "akses-ditolak"));
        }
    } else if ($check_class == "G") {
        if ($location == "packing gp") {
            $qry_stock = " SELECT B_ACTY.D0780.PLNNO
			, B_ACTY.D0780.ACARDNO 
			, B_ACTY.D0780.HMCD 
			, B_ACTY.D0130.SEIBAN
			, B_ACTY.M0010.HMNM
			, COUNT(B_ACTY.D0780.ACARDNO) AS QTY_ACARD
			FROM B_ACTY.D0780,
				 B_ACTY.D0130,
				 B_ACTY.M0010
			WHERE  B_ACTY.D0780.PLNNO = B_ACTY.D0130.PLNNO
			AND B_ACTY.D0780.HMCD = B_ACTY.M0010.HMCD
			AND B_ACTY.D0780.ACARDNO = '$acard'
			AND B_ACTY.D0780.PLNNO LIKE 'GP%'
			GROUP BY B_ACTY.D0780.PLNNO, B_ACTY.D0780.ACARDNO , B_ACTY.D0780.HMCD, B_ACTY.D0130.SEIBAN, B_ACTY.M0010.HMNM";

            $exc_ora = oci_parse($connection, $qry_stock);

            oci_execute($exc_ora);
            $piano = oci_fetch_array($exc_ora);

            if (isset($piano['QTY_ACARD']) and $piano['QTY_ACARD'] > 0) {
                $serial = $piano['SEIBAN'];
                // cek apakah sudah pernah di packing
                $sql = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_serialpiano = '$serial' AND c_action = 'packing'");
                $data = mysqli_fetch_array($sql);
                if (!empty($data['id'])) {
                    $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan pada A-Card yang sudah ter-packing', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Piano'");
                    echo json_encode(array("status" => "sudah-packing"));
                } else {
                    // apakah menggunakan bench, jika iya dapatkan gmc bench!
                    $gmc =  $piano['HMCD'];
                    $qry_bom_bench = "SELECT M_ACTY.M0031.OYAHMCD, M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM 
                                            FROM M_ACTY.M0031
                                            JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD
                                            WHERE M_ACTY.M0031.OYAHMCD = '$gmc'
                                            AND M_ACTY.M0010.HMSNM LIKE 'BENCH%'
                                            AND M_ACTY.M0010.HMSNM NOT LIKE '%CQ%'
                                            AND M_ACTY.M0010.HMSTATUS != 'CI'";

                    $querybom = oci_parse($connection, $qry_bom_bench);
                    oci_execute($querybom);
                    $row_bench = oci_fetch_array($querybom);
                    $gmc_bench = isset($row_bench['KOHMCD']) ? $row_bench['KOHMCD'] : "";
                    $nm_bench = isset($row_bench['HMSNM']) ? $row_bench['HMSNM'] : "";

                    if ($gmc_bench != "") {
                        // jika tidak kosong, cek apakah stock bench ada, terutama pada area terkait
                        $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as qty_bench FROM qa_bench WHERE c_gmc = '$gmc_bench' AND c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
                        $data1 = mysqli_fetch_array($sql1);

                        $stock_bench = $data1['qty_bench'];
                    } else {
                        $stock_bench = "-";
                    }

                    // apakah menggunakan user package, jika iya dapatkan gmc user package!
                    $qry_bom_userp = "SELECT M_ACTY.M0031.OYAHMCD, M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM 
                                            FROM M_ACTY.M0031
                                            JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD
                                            WHERE M_ACTY.M0031.OYAHMCD = '$gmc'
                                            AND M_ACTY.M0010.HMSNM LIKE 'USER PACKAGE SET%'
                                            AND M_ACTY.M0010.HMSNM NOT LIKE '%CQ%'
                                            AND M_ACTY.M0010.HMSTATUS != 'CI'";

                    $querybom_userp = oci_parse($connection, $qry_bom_userp);
                    oci_execute($querybom_userp);
                    $row_userp = oci_fetch_array($querybom_userp);
                    $gmc_userp = isset($row_userp['KOHMCD']) ? $row_userp['KOHMCD'] : "";
                    $nm_userp = isset($row_userp['HMSNM']) ? $row_userp['HMSNM'] : "";

                    if ($gmc_userp != "") {
                        // jika tidak kosong, cek apakah stock bench ada
                        $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as qty_userp FROM qa_userp WHERE c_gmc = '$gmc_userp' AND c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
                        $data1 = mysqli_fetch_array($sql1);

                        $stock_userp = $data1['qty_userp'];
                    } else {
                        $stock_userp = "-";
                    }

                    // var_dump($stock_bench);
                    // var_dump($stock_userp);
                    // die();

                    // hasil dari pengecekan
                    if ($stock_bench == "0" && $stock_userp == "0") {
                        $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan A-Card dengan stock bench dan user package kosong', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Piano'");
                        echo json_encode(array("status" => "bench-userp-kosong", "benchgmc" => $gmc_bench, "benchname" => $nm_bench, "userpgmc" => $gmc_userp, "userpname" => $nm_userp));
                    } elseif ($stock_bench == "0") {
                        $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan A-Card dengan stock bench kosong', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Piano'");
                        echo json_encode(array("status" => "bench-kosong", "benchgmc" => $gmc_bench, "benchname" => $nm_bench));
                    } elseif ($stock_userp == "0") {
                        $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan A-Card dengan stock user package kosong', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$serial', c_type = 'Piano'");
                        echo json_encode(array("status" => "userp-kosong", "userpgmc" => $gmc_userp, "userpname" => $nm_userp));
                    } else {
                        // echo "ada-belum-packing";
                        echo json_encode(array("status" => "ada-belum-packing"));
                    }
                }
            } else {
                $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan A-Card tidak dikenali', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$acard', c_type = 'Piano'");
                echo json_encode(array("status" => "kosong"));
            }
        } else {
            $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan pada A-Card yang bukan wewenangnya', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$acard', c_type = 'Piano'");
            echo json_encode(array("status" => "akses-ditolak"));
        }
    } else {
        $errlog = mysqli_query($connect_pro, "INSERT INTO qa_errorlog SET c_process = 'Scan A-Card', c_error = 'Melakukan scan A-Card tidak dikenali', c_pic = '$c_pic', c_datetime = '$now', c_location = '$location', c_serial = '$acard', c_type = 'Piano'");
        echo json_encode(array("status" => "kosong"));
    }

    // $qry_stock = " SELECT B_ACTY.D0610.PLNNO
    // 		, B_ACTY.D0610.ACARDNO 
    // 		, B_ACTY.D0610.HMCD 
    // 		, B_ACTY.D0130.SEIBAN
    // 		, B_ACTY.M0010.HMNM
    // 		, COUNT(B_ACTY.D0610.ACARDNO) AS QTY_ACARD
    // 		FROM B_ACTY.D0610,
    // 			 B_ACTY.D0130,
    // 			 B_ACTY.M0010
    // 		WHERE  B_ACTY.D0610.PLNNO = B_ACTY.D0130.PLNNO
    // 		AND B_ACTY.D0610.HMCD = B_ACTY.M0010.HMCD
    // 		AND B_ACTY.D0610.ACARDNO = '$acard'
    // 		AND B_ACTY.D0610.PLNNO LIKE 'UP%'
    // 		GROUP BY B_ACTY.D0610.PLNNO, B_ACTY.D0610.ACARDNO , B_ACTY.D0610.HMCD, B_ACTY.D0130.SEIBAN, B_ACTY.M0010.HMNM";


}

# jika nanti colab dengan sistem final check
# jadi jika a card belum selesai sampai cek 3 akan dilakukan penolakan, namun disini hanya baru melakukan pengecekan terdaftar atau tidaknya pada sistem final check
# perlu ditambahkan logic percabangan untuk melakukan cek apakah piano sudah selesai pengecekan sampai cek 3
// check apakah a card terdaftar atau tidak
// $sql = mysqli_query($connect_pro, "SELECT c_finishoutcheck3 FROM formng_register WHERE c_ctrlnumber = '$acard'");
// $data = mysqli_fetch_array($sql);

// if (empty($data['c_finishoutcheck3'])) {
//     echo "kosong";
// } else {
//     echo "ada";
// }
