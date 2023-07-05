<?php
// get connection
require '../config.php';

// get data lemparan
$codecode = $_POST['acard'];

// ambil kode depan
$kode = substr($codecode, 0, 1);

// (A) run code by kode (jika U menjalankan code A-card, jika J menjalankan code Serial number)
if ($kode == 'U') {
    $acard = $codecode;
    // [a] menjalankan code A-card
    // run sql oracle 
    $sql1 =
        "SELECT B_ACTY.D0610.PLNNO 
                                , B_ACTY.D0610.ACARDNO 
                                , B_ACTY.D0610.HMCD 
                                , B_ACTY.D0130.SEIBAN
                                , B_ACTY.M0010.HMNM
                                , COUNT(B_ACTY.D0610.ACARDNO) AS QTY_ACARD
                            FROM B_ACTY.D0610,
                                B_ACTY.D0130
                                , B_ACTY.M0010
                            WHERE  B_ACTY.D0610.PLNNO = B_ACTY.D0130.PLNNO
                                AND B_ACTY.D0610.HMCD = B_ACTY.M0010.HMCD
                                AND B_ACTY.D0610.ACARDNO = '$acard'
                                AND B_ACTY.D0610.PLNNO LIKE 'UP%'
                            GROUP BY B_ACTY.D0610.PLNNO, B_ACTY.D0610.ACARDNO 
                                , B_ACTY.D0610.HMCD
                                , B_ACTY.D0130.SEIBAN
                                , B_ACTY.M0010.HMNM";

    $statment1 = oci_parse($connection, $sql1);
    oci_execute($statment1);
    $data = oci_fetch_array($statment1);

    // (B) cek no A-Card terdaftar atau tidak pada K-staff
    if (empty($data['QTY_ACARD'])) {
        // [b] A-card tidak ditemukan
        echo json_encode(array("status" => "tidak-ada"));
    } else {
        // [b] A-card ditemukan
        $serialnumber = $data['SEIBAN'];
        $plannumber = $data['PLNNO'];
        $acard = $data['ACARDNO'];
        $gmc = $data['HMCD'];
        $pianoname = $data['HMNM'];
        // run sql oracle
        $sql2 = "SELECT B_ACTY.D0600.ACTUALDT FROM B_ACTY.D0600 WHERE B_ACTY.D0600.PLNNO = '$data[PLNNO]' AND B_ACTY.D0600.MAKEKTCD = 'U400'";
        $statment2 = oci_parse($connection, $sql2);
        oci_execute($statment2);
        $data2 = oci_fetch_array($statment2);

        // (C) cek status data pada U400 (apakah sudah TR di proses sebelum inside check)
        if ($data2['ACTUALDT'] == "") {
            // [c] belum dilakukan TR
            echo json_encode(array("status" => "ada-belum-tr"));
        } else {
            // [c] sudah dilakukan TR
            // run sql local
            $sql3 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) AS total FROM finalcheck_register WHERE c_acard = '$acard'");
            $data3 = mysqli_fetch_array($sql3);

            // (D) cek apakah A-card sudah pernah terdaftar (tabel : finalcheck_register)
            if ($data3['total'] == 0) {
                // [d] belum terdaftar
                // [INSERT : finalcheck_register] data didaftarkan ke dalam tabel registrasi
                $sql4 = mysqli_query($connect_pro, "INSERT INTO finalcheck_register SET c_serialnumber = '$serialnumber', c_plannumber = '$plannumber', c_acard = '$acard', c_gmc = '$gmc'");
                if ($sql4) {
                    // [SELECT : finalcheck_register, finalcheck_list_piano(c_code_type), finalcheck_list_incheck(c_code_type) + pf]
                    // [INSERT : finalcheck_fetch_incheck] type pf (polyester furniture)
                    // $sql6 = mysqli_query($connect_pro, "SELECT c_code_incheck FROM finalcheck_list_incheck WHERE c_code_type = 'pf' AND c_status = 'enable'");
                    // while ($data6 = mysqli_fetch_array($sql6)) {
                    //     mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_incheck SET c_serialnumber = '$serialnumber', c_code_incheck = '$data6[c_code_incheck]'");
                    // }

                    // [INSERT : finalcheck_fetch_incheck] dengan type khusus alias bukan pf (polyester furniture)
                    $sql5 = mysqli_query($connect_pro, "SELECT c_code_incheck FROM finalcheck_list_incheck WHERE c_code_type = 'pf' AND c_status = 'enable' OR c_code_type = (SELECT c_code_type FROM finalcheck_list_piano WHERE c_gmc = '$gmc') AND c_status = 'enable'");
                    while ($data5 = mysqli_fetch_array($sql5)) {
                        mysqli_query($connect_pro, "INSERT INTO finalcheck_fetch_incheck SET c_serialnumber = '$serialnumber', c_code_incheck = '$data5[c_code_incheck]'");
                    }
                }

                // [INSERT : finalcheck_timestamp] kolom c_register dan c_inside_i terisi
                mysqli_query($connect_pro, "INSERT INTO finalcheck_timestamp SET c_serialnumber = '$serialnumber', c_register = '$now' , c_inside_i = '$now'");

                // [INSERT : finalcheck_pic] pic c_inside terisi
                mysqli_query($connect_pro, "INSERT INTO finalcheck_pic SET c_serialnumber = '$serialnumber', c_inside = '$namkar'");

                // [INSERT : finalcheck_repairtime] just create
                mysqli_query($connect_pro, "INSERT INTO finalcheck_repairtime SET c_serialnumber = '$serialnumber'");

                // [INSERT : finalcheck_note] create
                mysqli_query($connect_pro, "INSERT INTO finalcheck_note SET c_serialnumber = '$serialnumber'");

                echo json_encode(array("status" => "ada", "pianoserial" => $serialnumber, "pianoname" => $pianoname, "pianogmc" => $gmc, "plannumber" => $plannumber));
            } else {
                // [d] sudah terdaftar
                echo json_encode(array("status" => "ada", "pianoserial" => $serialnumber, "pianoname" => $pianoname, "pianogmc" => $gmc, "plannumber" => $plannumber));
            }
        }
    }
} elseif ($kode == 'J') {
    $serialnumber = $codecode;
    // [a] menjalankan code Serial number
    // run mysql
    $sql7 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) AS total FROM finalcheck_register WHERE c_serialnumber = '$serialnumber'");
    $data7 = mysqli_fetch_array($sql7);

    // (E) cek apakah no seri sudah terdaftar atau belum
    if ($data7['total'] == 0) {
        // [e] no seri belum terdaftar
        echo json_encode(array("status" => "tidak-ada"));
    } else {
        // [e] no seri sudah terdaftar
        // [SELECT : finalcheck_register INNER JOIN finalcheck_list_piano] join dengan tabel piano untuk mengambil nama piano
        $sql8 = mysqli_query($connect_pro, "SELECT a.c_plannumber, a.c_acard, a.c_serialnumber, a.c_gmc, b.c_name FROM finalcheck_register a INNER JOIN finalcheck_list_piano b ON a.c_gmc = b.c_gmc WHERE a.c_serialnumber = '$serialnumber'");
        $data8 = mysqli_fetch_array($sql8);
        $serialnumber = $data8['c_serialnumber'];
        $pianoname = $data8['c_name'];
        $gmc = $data8['c_gmc'];
        $plannumber = $data8['c_plannumber'];

        echo json_encode(array("status" => "ada", "pianoserial" => $serialnumber, "pianoname" => $pianoname, "pianogmc" => $gmc, "plannumber" => $plannumber));
    }
} else {
    echo json_encode(array("status" => "tidak-ada"));
}
