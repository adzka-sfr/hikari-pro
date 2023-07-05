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
$hasil = array();

# A) Check bench
// A.1) Distinct gmc pada system
$q1 = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_bench WHERE c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
while ($d1 = mysqli_fetch_array($q1)) {
    // A.1.a) Hitung pada data system
    $q2 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as hasil_system FROM qa_bench WHERE c_gmc = '$d1[c_gmc]' AND c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
    $d2 = mysqli_fetch_array($q2);

    // A.1.b) Hitung pada data stock taking
    $q3 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as hasil_staking FROM qa_count_staking WHERE c_gmc = '$d1[c_gmc]' AND c_location = '$location'");
    $d3 = mysqli_fetch_array($q3);

    // A.2) Check System vs Actual

    if ($d2['hasil_system'] != $d3['hasil_staking']) {
        $hasil[] = array($d1['c_gmc'], $d1['c_name'], $d2['hasil_system'], $d3['hasil_staking']);
    }
}

# B) Check user package
// B.1) Distinct gmc pada system
$q4 = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_userp WHERE c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
while ($d4 = mysqli_fetch_array($q4)) {
    // B.1.a) Hitung pada data system
    $q5 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as hasil_system FROM qa_userp WHERE c_gmc = '$d4[c_gmc]' AND c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
    $d5 = mysqli_fetch_array($q5);

    // B.1.b) Hitung pada data stock taking
    $q6 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as hasil_staking FROM qa_count_staking WHERE c_gmc = '$d4[c_gmc]' AND c_location = '$location'");
    $d6 = mysqli_fetch_array($q6);

    // B.2) Check System vs Actual
    if ($d5['hasil_system'] != $d6['hasil_staking']) {
        $hasil[] = array($d4['c_gmc'], $d4['c_name'], $d5['hasil_system'], $d6['hasil_staking']);
    }
}
// cek apakah sql aman
if ($q1) {
    // cek isi array
    $isi = count($hasil);
    if ($isi < 1) {
        echo "semua-aman";
    } else {

        echo
        '<table class="table table-bordered">

        <thead style="text-align:center">
            <th>GMC</th>
            <th>Name</th>
            <th>Status</th>
            </thead><tbody>';
        for ($a = 0; $a < $isi; $a++) {
            echo "<tr>
        <td>" . $hasil[$a][0] . "</td>
        <td style='text-align:left'>" . $hasil[$a][1] . "</td>
        <td>NG</td>
        </tr>";
        }
        echo '<tbody></table>';
    }
} else {
    echo "server-error";
}
