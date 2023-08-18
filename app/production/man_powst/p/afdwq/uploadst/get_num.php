<?php
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$today = date('Y-m-d');

require('../../../../../../_assets/src/add/phpspreadsheet/vendor/autoload.php');
$connect_cok = new mysqli("localhost", "root", "", "hikari_project");

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

// get max col
$highestColumn = $worksheet->getHighestColumn();

$connect = new mysqli("localhost", "root", "", "test");
$q = mysqli_query($connect_cok, "SELECT COUNT(id) as total FROM manpow_st WHERE c_date LIKE '$today%'");
$d = mysqli_fetch_array($q);

$persen = ($d['total'] / $highestRow) * 100;
$persen = number_format($persen, 2, '.', '');

echo json_encode(array("persen" => $persen, "progress" => $d['total'], "total" => $highestRow));
