<?php
require('../../../../../../_assets/src/add/phpspreadsheet/vendor/autoload.php');
$connect = new PDO("mysql:host=localhost;dbname=hikari_project;charset=UTF8", "root", "");

date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$today = date('Y-m-d');

// get from post data
$filepath = basename($_FILES['file-0']['name']);
// create new location
$newloc = 'upload/' . $filepath;
// move file to new location
move_uploaded_file($_FILES['file-0']['tmp_name'], $newloc);

// get sheet not shit :)
$spreadsheet = PhpOffice\PhpSpreadsheet\IOFactory::load($newloc);
$worksheet = $spreadsheet->getActiveSheet();
$sheet = $spreadsheet->getActiveSheet()->toArray();

// get max row
$highestRow = $worksheet->getHighestRow();

// get max col
$highestColumn = $worksheet->getHighestColumn();

// get date from manpow_st_ongoing
$q = $connect->query("SELECT MAX(c_date) as waktu FROM data_upload_general_log");
$d = $q->fetch();
$waktu = $d['waktu'];

$username = "B_ACTY";
$password = "SYSTEM";
$db = "(DESCRIPTION =(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521)))(CONNECT_DATA = (SERVICE_NAME = YIKSTAFF)))";
$connection = oci_connect($username, $password, $db);

for ($x = 1; $x < $highestRow; $x++) {
    if ($sheet[$x][0] != '') {
        // get serialnumber
        $c_serialbench = $sheet[$x][0];

        $c_gmc = substr($c_serialbench, 0, 7);
        // get name from k-staff
        $sql1 = "SELECT M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM FROM M_ACTY.M0031 JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD WHERE M_ACTY.M0031.KOHMCD = '$c_gmc'";
        $statment1 = oci_parse($connection, $sql1);
        oci_execute($statment1);
        $ora_result_case1 = oci_fetch_array($statment1);
        if ($ora_result_case1['HMSNM'] != '') {
            $c_name = $ora_result_case1['HMSNM'];
        } else {
            $c_name = 'Cek kembali GMC!';
        }

        // if ($c_name == '') {
        // }
        // $c_serialbench = $c_serialbench . " test";

        $connect->query("INSERT INTO qa_bench SET c_gmc = '$c_gmc', c_serialbench = '$c_serialbench', c_name = '$c_name', c_created = '$waktu'");
        // mysqli_query($connect_cok, "INSERT INTO manpow_st SET c_gmc = '$col_a', c_workcenter = '$col_c', c_stdval = '$col_e', c_date = '$now'");
    }
}
echo json_encode(array("status" => 'berhasil'));
?>

<?php
// date_default_timezone_set('Asia/Jakarta');
// $now = date('Y-m-d H:i:s');

// require('../../../../../../_assets/src/add/phpspreadsheet/vendor/autoload.php');
// $connect_cok = new mysqli("localhost", "root", "", "hikari_project");

// // get from post data
// $filepath = basename($_FILES['file-0']['name']);
// // create new location
// $newloc = 'upload/' . $filepath;
// // move file to new location
// move_uploaded_file($_FILES['file-0']['tmp_name'], $newloc);

// // get sheet not shit :)
// $spreadsheet = PhpOffice\PhpSpreadsheet\IOFactory::load($newloc);
// $worksheet = $spreadsheet->getActiveSheet();
// $sheet = $spreadsheet->getActiveSheet()->toArray();

// // get max row
// $highestRow = $worksheet->getHighestRow();

// // get max col
// $highestColumn = $worksheet->getHighestColumn();

// for ($x = 1; $x < $highestRow; $x++) {
//     if ($sheet[$x][0] != '') {
//         // get GMC
//         $col_a = $sheet[$x][0];

//         // get WC
//         $col_c = $sheet[$x][2];
//         $col_c = substr($col_c, 0, 4);

//         // get ST
//         $col_e = $sheet[$x][4];
//         $col_e = number_format($col_e, 3, '.', '');

//         mysqli_query($connect_cok, "INSERT INTO manpow_st SET c_gmc = '$col_a', c_workcenter = '$col_c', c_stdval = '$col_e', c_date = '$now'");
//     }
// }

// echo json_encode(array("status" => 'berhasil'));
?>