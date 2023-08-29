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

// get max row
$highestRow = $worksheet->getHighestRow();
$highestRow = $highestRow - 1; // because header

// hitung estimasi
// base kecepatan upload data adalah 100 per menit
$banyak_data = $highestRow;
if ($banyak_data < 100) {
    $est = "kurang dari 1 menit";
} else {
    $upload_fast = 100; // per minutes
    $estimasi = $banyak_data / $upload_fast;

    $jam  = $estimasi / 60;
    $jam = floor($jam);
    $menit = $estimasi % 60;

    $est = $jam . " jam " . $menit . " menit";
}

echo json_encode(array("status" => "berhasil", "total_row" => $highestRow, "estimasi" => $est));
