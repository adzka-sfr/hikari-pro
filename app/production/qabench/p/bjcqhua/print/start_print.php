<?php
require __DIR__ . '/vendor/mike42/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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

// get time
$today = date('Y-m-d', strtotime($now));
$thn = date('y', strtotime($now));
$bln = date('m', strtotime($now));
$thismonth = date('Y-m');

// get month code
if ($bln == '01') {
    $monthcode = 'A';
} elseif ($bln == '02') {
    $monthcode = 'B';
} elseif ($bln == '03') {
    $monthcode = 'C';
} elseif ($bln == '04') {
    $monthcode = 'D';
} elseif ($bln == '05') {
    $monthcode = 'E';
} elseif ($bln == '06') {
    $monthcode = 'F';
} elseif ($bln == '07') {
    $monthcode = 'G';
} elseif ($bln == '08') {
    $monthcode = 'H';
} elseif ($bln == '09') {
    $monthcode = 'I';
} elseif ($bln == '10') {
    $monthcode = 'J';
} elseif ($bln == '11') {
    $monthcode = 'K';
} elseif ($bln == '12') {
    $monthcode = 'L';
}

// data lemparan
$bench = $_POST['bench'];
$qty = $_POST['qty'];
$lokasiprint = $_POST['lokasiprint'];

// pecah nama bench dengan gmc
$gmc = substr($bench, 1, 7);
$namabench = substr($bench, 10);

// cek no bench terakhir pada bulan ini
$sql3 = mysqli_query($connect_pro, "SELECT id FROM qa_bench WHERE c_gmc = '$gmc' AND c_created LIKE '$thismonth%'");
$data3 = mysqli_fetch_array($sql3);

if (!empty($data3['id'])) {
    $sql3 = mysqli_query($connect_pro, "SELECT MAX(c_serialbench) AS maks FROM qa_bench WHERE c_gmc = '$gmc' AND c_created LIKE '$thismonth%'");
    $data3 = mysqli_fetch_array($sql3);

    $potong = substr($data3['maks'], 10);
    $no_urut = $potong;
} else {
    $no_urut = 0;
}

$c_created = date('Y-m-d H:i:s', strtotime($now));
for ($a = 0; $a < $qty; $a++) {
    $no_urut = $no_urut + 1;
    if ($no_urut < 10) {
        $no_urut = "000" . $no_urut;
    } elseif ($no_urut < 100) {
        $no_urut = "00" . $no_urut;
    } elseif ($no_urut < 1000) {
        $no_urut = "0" . $no_urut;
    }

    $c_serialbench = $gmc . $thn . $monthcode . $no_urut; // qa_bench.c_serialbench

    // echo $no_urut . "</br>";
    $sqlprint = mysqli_query($connect_pro, "INSERT INTO qa_bench SET c_gmc = '$gmc', c_serialbench = '$c_serialbench', c_name = '$namabench', c_created = '$c_created'");

    // get user to know which connector to use
    if ($lokasiprint == 'print label') {
        $device = "smb://172.17.192.208/POS80rif";
    } elseif ($lokasiprint == 'packing gp') {
        $device = "smb://172.17.192.242/POS80";
    } elseif ($lokasiprint == 'packing up') {
        $device = "smb://172.17.192.242/POS80";
    } else {
        $device = "smb://konektortidakketemu";
    }
    try {
        $connector = new WindowsPrintConnector($device);
        $printer = new Printer($connector);
        $printer->initialize();
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode();
        $printer->setEmphasis(true);
        $printer->text($namabench . "\n");
        $printer->text($c_serialbench . "\n");
        $printer->setEmphasis(false);
        $printer->setBarcodeHeight(60);
        $printer->setBarcodeWidth(2);
        // $printer->barcode($c_serialbench, Printer::BARCODE_CODE93);
        $printer->qrCode($c_serialbench, Printer::QR_ECLEVEL_L, 7);
        $printer->text("\n");
        $printer->selectPrintMode();

        //$printer->feed();
        $printer->cut();
        $printer->pulse();
        $printer->close();
    } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
    }
}

// insert qalog
$sql_qalog = mysqli_query($connect_pro, "INSERT INTO qa_log SET
    c_action = 'print label',
    c_serialbench = '-',
    c_namebench = '$namabench',
    c_gmcbench = '$gmc',
    c_serialpiano = '-',
    c_namepiano = '-',
    c_gmcpiano = '-',
    c_qty = '$qty',
    c_pic = '$_SESSION[id]',
    c_date = '$c_created'");

// untuk mengembalikan respon
if ($sqlprint) {
    echo "print-berhasil";
} else {
    echo "error";
}
