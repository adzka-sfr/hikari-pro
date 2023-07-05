<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();

$today = date('Y-m-d', strtotime($now));
$location = $_SESSION['role'];

$q1 = mysqli_query($connect_pro, "SELECT id FROM qa_preregister WHERE c_location = '$location'");
$d1 = mysqli_fetch_array($q1);
// cek apakah ada data pada pre-register untuk di lempar ke register (qa bench)
if (empty($d1)) {
    echo "tidak-ada-data";
} else {



    $q3 = mysqli_query($connect_pro, "SELECT * FROM qa_preregister WHERE c_location = '$location'");
    while ($d3 = mysqli_fetch_array($q3)) {
        // $q4 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) AS total, c_name, c_gmc, c_type FROM qa_preregister WHERE c_gmc = '$d3[c_gmc]' AND c_location = '$location'");
        // $d4 = mysqli_fetch_array($q4);

        if ($d3['c_type'] == 'bench') {
            // INSERT QALOG
            // $sql_qalog = mysqli_query($connect_pro, "INSERT INTO qa_log SET 
            // c_action = 'register',
            // c_serialbench = '-',
            // c_namebench = '$d4[c_name]',
            // c_gmcbench = '$d4[c_gmc]',
            // c_serialpiano = '-',
            // c_namepiano = '-',
            // c_gmcpiano = '-',
            // c_qty = '$d4[total]',
            // c_pic = '$_SESSION[id]',
            // c_date = '$now',
            // c_location = '$location'");

            // UPDATE QA BENCH 
            // $q2 = mysqli_query($connect_pro, "SELECT * FROM qa_preregister WHERE c_location = '$location' AND c_gmc = '$d4[c_gmc]'");
            // while ($d2 = mysqli_fetch_array($q2)) {
            $sql = mysqli_query($connect_pro, "UPDATE qa_bench SET c_used = '$now', c_location = '$location' WHERE c_serialbench = '$d3[c_serialnumber]'");

            // sql log
            $sqllog = mysqli_query($connect_pro, "INSERT INTO qa_log SET 
            c_action = 'register',
            c_serialbench = '$d3[c_serialnumber]',
            c_namebench = '$d3[c_name]',
            c_gmcbench = '$d3[c_gmc]',
            c_serialuserp = '-',
            c_nameuserp = '-',
            c_gmcuserp = '-',
            c_serialpiano = '-',
            c_namepiano = '-',
            c_gmcpiano = '-',
            c_qty = '1',
            c_pic = '$_SESSION[id]',
            c_date = '$now',
            c_location = '$location'");
            // }
        } else if ($d3['c_type'] == 'userpackage') {
            // INSERT QALOG
            // $sql_qalog = mysqli_query($connect_pro, "INSERT INTO qa_log SET 
            // c_action = 'register',
            // c_serialbench = '-',
            // c_namebench = '$d4[c_name]',
            // c_gmcbench = '$d4[c_gmc]',
            // c_serialpiano = '-',
            // c_namepiano = '-',
            // c_gmcpiano = '-',
            // c_qty = '$d4[total]',
            // c_pic = '$_SESSION[id]',
            // c_date = '$now',
            // c_location = '$location'");

            // INSERT QA USERP
            // $q3 = mysqli_query($connect_pro, "SELECT * FROM qa_preregister WHERE c_location = '$location' AND c_gmc = '$d4[c_gmc]'");
            // while ($d3 = mysqli_fetch_array($q3)) {
            $sql = mysqli_query($connect_pro, "INSERT INTO qa_userp SET c_gmc = '$d3[c_gmc]', c_serialuserp = '$d3[c_serialnumber]', c_name = '$d3[c_name]', c_created = '$now', c_used = '$now', c_location = '$location'");

            // sql log
            $sqllog = mysqli_query($connect_pro, "INSERT INTO qa_log SET 
            c_action = 'register',
            c_serialbench = '-',
            c_namebench = '-',
            c_gmcbench = '-',
            c_serialuserp = '$d3[c_serialnumber]',
            c_nameuserp = '$d3[c_name]',
            c_gmcuserp = '$d3[c_gmc]',
            c_serialpiano = '-',
            c_namepiano = '-',
            c_gmcpiano = '-',
            c_qty = '1',
            c_pic = '$_SESSION[id]',
            c_date = '$now',
            c_location = '$location'");
            // }
        }
    }

    if ($sql) {
        mysqli_query($connect_pro, "DELETE FROM qa_preregister WHERE c_location = '$location'");
        echo "register-berhasil";
    } else {
        echo "server-busy";
    }
}
