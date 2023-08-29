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

// update data manpow_st_ongoing
$connect->query("INSERT INTO data_upload_general_log SET c_banyak_data = $highestRow, c_date = '$now', c_file = '$filepath'");

echo json_encode(array("status" => "berhasil"));
