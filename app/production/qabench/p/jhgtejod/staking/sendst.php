<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$location = $_SESSION['role'];

$today = date('Y-m-d', strtotime($now));
$stts = $_POST['status'];

$q1 = mysqli_query($connect_pro, "SELECT id FROM qa_count_staking WHERE c_location = '$location'");
$d1 = mysqli_fetch_array($q1);
// cek apakah ada data pada tabel stock taking untuk di lempar direkam sebagai data stock taking harian
if (empty($d1)) {
    // tidak ada data
    echo "tidak-ada-data";
} else {

    // hitung dulu ada berapa gmc yang seharusnya menjadi stock
    // dimulai dari bench
    $q2 = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc FROM qa_bench WHERE c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
    $d2 = mysqli_fetch_array($q2);
    if (!empty($d2['c_gmc'])) {
        $q2 = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_bench WHERE c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
        while ($d2 = mysqli_fetch_array($q2)) {
            // hitung ada berapa banyak data seharusnya pada sistem
            $sql3 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as hasil_system FROM qa_bench WHERE c_gmc = '$d2[c_gmc]' AND c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
            $data3 = mysqli_fetch_array($sql3);
            $qty_system = $data3['hasil_system'];

            // hitung ada berapa banyak data aktualnya saat taking (qa_count_staking)
            $sql4 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as hasil_staking FROM qa_count_staking WHERE c_gmc = '$d2[c_gmc]' AND c_location = '$location'");
            $data4 = mysqli_fetch_array($sql4);
            $qty_actual = $data4['hasil_staking'];

            // get status
            if ($qty_actual == $qty_system) {
                $status = "OK";
            } else {
                $status = "NG";
            }
            $c_note = '-';
            $c_type = 'bench';
            $c_name = $d2['c_name'];

            // record data stock taking
            $sql = mysqli_query($connect_pro, "INSERT INTO qa_staking SET c_date = '$now', c_location = '$location', c_pic = '$_SESSION[nama]', c_qtysystem = $qty_system, c_qtyactual = $qty_actual, c_status = '$status', c_note = '$c_note', c_gmc = '$d2[c_gmc]', c_type = '$c_type', c_name = '$c_name'");
            // record data stock taking ke dalam log
            $sqllog = mysqli_query($connect_pro, "INSERT INTO qa_log SET c_action = 'stock taking', c_serialbench = '-', c_namebench = '$c_name', c_gmcbench = '$d2[c_gmc]', c_qty = $qty_actual , c_serialpiano = '-', c_namepiano = '-', c_gmcpiano = '-', c_pic = '$_SESSION[id]', c_date = '$now', c_location = '$location'");
        }
    }

    // kemudian user package
    $q4 = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc FROM qa_userp WHERE c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
    $d4 = mysqli_fetch_array($q4);
    if (!empty($d4['c_gmc'])) {
        $q4 = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_userp WHERE c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
        while ($d4 = mysqli_fetch_array($q4)) {
            // hitung ada berapa banyak data seharusnya pada sistem
            $sql6 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as hasil_system FROM qa_userp WHERE c_gmc = '$d4[c_gmc]' AND c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
            $data6 = mysqli_fetch_array($sql6);
            $qty_system2 = $data6['hasil_system'];

            // hitung ada berapa banyak data aktualnya saat taking (qa_count_staking)
            $sql8 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as hasil_staking FROM qa_count_staking WHERE c_gmc = '$d4[c_gmc]' AND c_location = '$location'");
            $data8 = mysqli_fetch_array($sql8);
            $qty_actual2 = $data8['hasil_staking'];

            // get status
            if ($qty_actual2 == $qty_system2) {
                $status2 = "OK";
            } else {
                $status2 = "NG";
            }
            $c_note = '-';
            $c_type = 'userpackage';
            $c_name = $d4['c_name'];

            // record data stock taking
            $sql = mysqli_query($connect_pro, "INSERT INTO qa_staking SET c_date = '$now', c_location = '$location', c_pic = '$_SESSION[nama]', c_qtysystem = $qty_system2, c_qtyactual = $qty_actual2, c_status = '$status2', c_note = '$c_note', c_gmc = '$d4[c_gmc]', c_type = '$c_type', c_name = '$c_name'");
            // record data stock taking ke dalam log
            $sqllog = mysqli_query($connect_pro, "INSERT INTO qa_log SET c_action = 'stock taking', c_serialbench = '-', c_namebench = '$c_name', c_gmcbench = '$d4[c_gmc]', c_qty = $qty_actual2 , c_serialpiano = '-', c_namepiano = '-', c_gmcpiano = '-', c_pic = '$_SESSION[id]', c_date = '$now', c_location = '$location'");
        }
    }

    if ($sql) {
        // hapus pada data qa staking
        $sqldelete = mysqli_query($connect_pro, "DELETE FROM qa_count_staking WHERE c_location = '$location'");
        // Turn off jika terdapat NG
        if ($stts == 'ng') {
            $sq = mysqli_query($connect_pro, "UPDATE qa_fitur SET c_status = 0, c_message = 'Stock bermasalah' WHERE c_location = '$location' AND c_fitur = 'stock'");
            $sqlog = mysqli_query($connect_pro, "INSERT INTO qa_fitur_log SET c_fitur = 'all function', c_status = 'OFF', c_time = '$now', c_approval = 'System', c_message = 'Stock bermasalah', c_location = '$location'");

            // send email
            // DATA SETUP
            $arr_data = array();
            $user_data = array();

            // cek apakah ada data ng
            $sql = mysqli_query($connect_pro, "SELECT MAX(c_date) as maks_date, c_reported  FROM qa_staking WHERE c_location = '$location' AND c_status = 'NG'");
            $data = mysqli_fetch_array($sql);
            if ($data['maks_date'] == '') {
                echo "data-kosong";
            } else {
                // ada data ng
                $sql3 = mysqli_query($connect_pro, "SELECT c_reported  FROM qa_staking WHERE c_location = '$location' AND c_status = 'NG' AND c_date = '$data[maks_date]'");
                $data3 = mysqli_fetch_array($sql3);
                if ($data3['c_reported'] != '') {
                    echo "sudah-dilaporkan";
                } else {
                    // ambil semua data NG untuk disimpan ke array
                    $no = 0;
                    $sql1 = mysqli_query($connect_pro, "SELECT * FROM qa_staking WHERE c_location = '$location' AND c_date = '$data[maks_date]' AND c_status = 'NG'");
                    while ($data1 = mysqli_fetch_array($sql1)) {
                        $no++;
                        $arr_data[] = "<tr>
                <td>" . $no . "</td>
                <td>" . $data1['c_gmc'] . "</td>
                <td>" . $data1['c_name'] . "</td>
                <td style='text-align: center;'>" . $data1['c_qtysystem'] . "</td>
                <td style='text-align: center;'>" . $data1['c_qtyactual'] . "</td>
                <td>" . $data1['c_pic'] . "</td>
                <td>" . $location . "</td>
            </tr>";
                        // update qa_staking.c_reported
                        $sql2 = mysqli_query($connect_pro, "UPDATE qa_staking SET c_reported = '$now' WHERE c_location = '$location' AND c_date = '$data1[c_date]' AND c_gmc = '$data1[c_gmc]' AND c_status = 'NG'");
                    }
                    $detail = implode($arr_data);

                    // ambil semua data user yang akan dikirimi email
                    $sql4 = mysqli_query($connect_pro, "SELECT c_email FROM qa_email WHERE c_ng = 'active'");
                    while ($data4 = mysqli_fetch_array($sql4)) {
                        $user_data[] = $data4['c_email'];
                    }
                    $user_email = implode(',', $user_data);
                    // ambil semua data user yang akan dikirimi email

                    // DATA SETUP

                    // EMAIL SETUP
                    $to = $user_email;
                    $subject = "Notification Different Stock";
                    $bound = "RANDOM";

                    $header = "From:hikari@music.yamaha.com \r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";

                    $message = "<b>[ATTENTION] There is some data that doesn't match between system and actual!</b></br>";
                    $message .= "</br> Please check the data below :</br>";
                    $message .= "
<style>
table, th, td {
  border: 1px solid;
  border-collapse: collapse;
  padding-left:10px;
  padding-right:10px;
}
</style>
<table>
        <thead>
            <tr>
                <th>No</th>
                <th>GMC</th>
                <th>Name</th>
                <th>QTY System</th>
                <th>QTY Actual</th>
                <th>PIC</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>";
                    $message .= $detail;
                    $message .= "</tbody></table></br>";
                    $message .= "</br><b>[INFO] All function in <u>" . strtoupper($location) . "</u> has been turned off.</b></br>";
                    $message .= "</br></br><i>Don't reply this message!!!</i>";
                    $message .= "</br><i>Email information: </br> ICT-Management Dept.</i>";
                    // EMAIL SETUP

                    // EMAIL ACTION
                    $retval = mail($to, $subject, $message, $header);
                    // EMAIL ACTION
                }
            }
        } else {
            // ambil data maksimal untuk di tmapilkan
            $sql = mysqli_query($connect_pro, "SELECT MAX(c_date) as maks_date, c_reported  FROM qa_staking WHERE c_location = '$location'");
            $data = mysqli_fetch_array($sql);
            // ambil semua data stock taking barusan untuk disimpan ke array
            $no = 0;
            $sql1 = mysqli_query($connect_pro, "SELECT * FROM qa_staking WHERE c_location = '$location' AND c_date = '$data[maks_date]'");
            while ($data1 = mysqli_fetch_array($sql1)) {
                $no++;
                $arr_data[] = "<tr>
                <td>" . $no . "</td>
                <td>" . $data1['c_gmc'] . "</td>
                <td>" . $data1['c_name'] . "</td>
                <td style='text-align: center;'>" . $data1['c_qtysystem'] . "</td>
                <td style='text-align: center;'>" . $data1['c_qtyactual'] . "</td>
                <td>" . $data1['c_pic'] . "</td>
                <td>" . $location . "</td>
            </tr>";
                // update qa_staking.c_reported
                // $sql2 = mysqli_query($connect_pro, "UPDATE qa_staking SET c_reported = '$now' WHERE c_location = '$location' AND c_date = '$data1[c_date]' AND c_gmc = '$data1[c_gmc]' AND c_status = 'NG'");
            }
            $detail = implode($arr_data);

            // ambil semua data user yang akan dikirimi email
            $sql4 = mysqli_query($connect_pro, "SELECT c_email FROM qa_email WHERE c_ok = 'active'");
            while ($data4 = mysqli_fetch_array($sql4)) {
                $user_data[] = $data4['c_email'];
            }
            $user_email = implode(',', $user_data);
            // ambil semua data user yang akan dikirimi email

            // DATA SETUP

            // EMAIL SETUP
            $to = $user_email;
            $subject = "Stock Taking Info";
            $bound = "RANDOM";

            $header = "From:hikari@music.yamaha.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $message = "<b>[INFO] Here's the data of stock taking today " . date('H:i:s d-m-Y', strtotime($now)) . "!</b></br>";
            $message .= "</br> Please check the data below :</br>";
            $message .= "
<style>
table, th, td {
  border: 1px solid;
  border-collapse: collapse;
  padding-left:10px;
  padding-right:10px;
}
</style>
<table>
        <thead>
            <tr>
                <th>No</th>
                <th>GMC</th>
                <th>Name</th>
                <th>QTY System</th>
                <th>QTY Actual</th>
                <th>PIC</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>";
            $message .= $detail;
            $message .= "</tbody></table></br>";
            $message .= "</br></br><i>Don't reply this message!!!</i>";
            $message .= "</br><i>Email information: </br> ICT-Management Dept.</i>";
            // EMAIL SETUP

            // EMAIL ACTION
            $retval = mail($to, $subject, $message, $header);
            // EMAIL ACTION

            // CEK DULU PADA QA REMINDER LOG
            $yesterday = date('Y-m-d', strtotime('-1day', strtotime($now)));
            $qml = mysqli_query($connect_pro, "SELECT COUNT(c_reminder) as total FROM qa_reminder_log WHERE c_rmdate LIKE '$yesterday%' AND c_location = '$location' AND c_status = 'n'");
            $dml = mysqli_fetch_array($qml);

            if ($dml['total'] < 1) {
                //gada ngapa-ngapain
            } else {
                $qml1 = mysqli_query($connect_pro, "SELECT c_reminder FROM qa_reminder_log WHERE c_rmdate LIKE '$yesterday%' AND c_location = '$location' AND c_status = 'n'");
                $dml1 = mysqli_fetch_array($qml1);

                // update register (nyalain lagi)
                $q34 = mysqli_query($connect_pro, "UPDATE qa_fitur SET c_status = 1, c_message = 'Aman' WHERE c_location = '$location' AND c_fitur = 'register'");
                $q4_register = mysqli_query($connect_pro, "INSERT INTO qa_fitur_log SET c_fitur = 'register', c_status = 'ON', c_time = '$now', c_approval = 'System', c_message = 'hasil stock taking aman', c_location = '$location'");

                // update packing (nyalain lagi)
                $q35 = mysqli_query($connect_pro, "UPDATE qa_fitur SET c_status = 1, c_message = 'Aman' WHERE c_location = '$location' AND c_fitur = 'packing'");
                $q5_register = mysqli_query($connect_pro, "INSERT INTO qa_fitur_log SET c_fitur = 'packing', c_status = 'ON', c_time = '$now', c_approval = 'System', c_message = 'hasil stock taking aman', c_location = '$location'");

                $qml2 = mysqli_query($connect_pro, "UPDATE qa_reminder_log SET c_status = 'y', c_stdate = '$now' WHERE c_reminder = '$dml1[c_reminder]'");
            }
            // CEK DULU PADA QA REMINDER LOG

        }
        echo "kirim-berhasil";
    } else {
        echo "server-busy";
    }
}
