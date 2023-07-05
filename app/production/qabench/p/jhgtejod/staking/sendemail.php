<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$location = $_SESSION['role'];
$today = date('Y-m-d', strtotime($now));

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
        $sql4 = mysqli_query($connect_pro, "SELECT c_email FROM mail_user WHERE c_mail_group = 'packing_sys'");
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

        $message = "<b>[WARNING] There is some data that doesn't match between system and actual!</b></br>";
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
        if ($retval) {
            // TURN OFF ALL FUNCTION BECAUSE NG STOCK
            $q_funct = mysqli_query($connect_pro, "UPDATE qa_fitur SET c_status = 0, c_message = 'Stock bermasalah' WHERE c_location = '$location' AND c_fitur = 'stock'");
            $q_register = mysqli_query($connect_pro, "INSERT INTO qa_fitur_log SET c_fitur = 'all function', c_status = 'OFF', c_time = '$now', c_approval = 'System', c_message = 'Stock bermasalah', c_location = '$location'");

            echo "email-berhasil";
        } else {
            echo "email-gagal";
        }
    }
}
