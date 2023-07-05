<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
session_start();
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
// PHP program to set a date time value in excel sheet
require '../../../../../../../_assets/src/add/export_excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$startdate = $_SESSION['alltim_export_start'];
$enddate = $_SESSION['alltim_export_end'];
$datestatus = $_SESSION['alltim_export_status']; // sd atau pd
$location = $_SESSION['alltim_export_loc']; // packing up atau packing gp

if ($datestatus == 'sd') {
    $status = 'Registered Date';
} else {
    $status = 'Packed Date';
}

if ($location == 'packing up') {
    $anjay = 'UP';
} elseif ($location == 'packing gp') {
    $anjay = 'GP';
}

// membuat spread sheet baru
$spreadsheet = new Spreadsheet();

// membuat sheet baru
$sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Bench Used - ' . $anjay); //deklarasi nama sheet
$spreadsheet->addSheet($sheet, 0); // menambahkan sheet baru ke dalam worksheet/spreadsheet dengan format (sheetnya, index sheetnya)

// untuk mengaktifkan worksheet
$spreadsheet->setActiveSheetIndex(0);

// ======= CREDIT ======= //
$sheet->setCellValue('A1', 'Downloaded at');
$sheet->setCellValue('B1', ': ' . $now . ' WIB');
$sheet->setCellValue('A2', 'Data');
$sheet->setCellValue('B2', ': Bench Used by ' . $status . ' (' . $anjay . ')');
$sheet->setCellValue('A3', 'Start Date');
$sheet->setCellValue('B3', ': ' . $startdate);
$sheet->setCellValue('A4', 'End Date');
$sheet->setCellValue('B4', ': ' . $enddate);
// ======= CREDIT ======= //

// ======= JUDUL ======= //
$sheet->setCellValue('B6', 'No');
$sheet->setCellValue('C6', 'GMC');
$sheet->setCellValue('D6', 'Serial Number');
$sheet->setCellValue('E6', 'Bench Name');
$sheet->setCellValue('F6', 'Printed');
$sheet->setCellValue('G6', 'Registered');
$sheet->setCellValue('H6', 'Packed');
// ======= JUDUL ======= //

// ======= ISI ======= //
$baris = 7;
$no = 1;
$nowtoused = date('Y-m-d', strtotime($now));
if ($datestatus == 'sd') {
    $query = "SELECT * FROM qa_bench WHERE c_used >= '$startdate' AND c_used <= '$enddate' AND c_used IS NOT NULL AND c_packed IS NOT NULL AND c_location = '$location' ORDER BY c_packed DESC";
} else {
    $query = "SELECT * FROM qa_bench WHERE c_packed >= '$startdate' AND c_packed <= '$enddate' AND c_used IS NOT NULL AND c_packed IS NOT NULL AND c_location = '$location' ORDER BY c_packed DESC";
}
$sql = mysqli_query($connect_pro, $query);
while ($data = mysqli_fetch_array($sql)) {
    $dateTime1 = strtotime("+7 hours", strtotime($data['c_created']));
    $excelDateValue1 = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(
        $dateTime1
    );

    $dateTime2 = strtotime("+7 hours", strtotime($data['c_used']));
    $excelDateValue2 = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(
        $dateTime2
    );

    $dateTime3 = strtotime("+7 hours", strtotime($data['c_packed']));
    $excelDateValue3 = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(
        $dateTime3
    );

    $sheet->setCellValue('B' . $baris, $no);
    $sheet->setCellValue('C' . $baris, $data['c_gmc']);
    $sheet->setCellValue('D' . $baris, $data['c_serialbench']);
    $sheet->setCellValue('E' . $baris, $data['c_name']);
    $sheet->setCellValue('F' . $baris, $excelDateValue1);
    $sheet->setCellValue('G' . $baris, $excelDateValue2);
    $sheet->setCellValue('H' . $baris, $excelDateValue3);

    $baris++;
    $no++;
}
// ======= ISI ======= //


// ======= SET UP STYLE ======= //
// mengatur lebar dari kolom
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

// font bold
$spreadsheet->getActiveSheet()->getStyle('B6:H6')
    ->getFont()->setBold(true);

// rata tengah
$baris--;
$spreadsheet->getActiveSheet()->getStyle('B6:H6')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('B7:B' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('C7:C' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('D7:D' . $baris)
    ->getAlignment()->setHorizontal('center');

// menambah filter
$spreadsheet->getActiveSheet()->setAutoFilter('B6:H6');

// border
$spreadsheet->getActiveSheet()->getStyle('B6:H' . $baris)
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// set date format
$spreadsheet->getActiveSheet()->getStyle('F')
    ->getNumberFormat()
    ->setFormatCode(
        \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME
    );
$spreadsheet->getActiveSheet()->getStyle('G')
    ->getNumberFormat()
    ->setFormatCode(
        \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME
    );
$spreadsheet->getActiveSheet()->getStyle('H')
    ->getNumberFormat()
    ->setFormatCode(
        \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME
    );

// menghapus sheet default
$spreadsheet->removeSheetByIndex(1);

// untuk mengaktifkan worksheet awal yang mau di buka saat membuka dokumen
$spreadsheet->setActiveSheetIndex(0);

// Save .xlsx file to the current directory
$tgle = date('Y-m-d');
$filename = 'Bench Used - ' . $anjay . '.xlsx';
try {
    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);
    $content = file_get_contents($filename);
} catch (Exception $e) {
    exit($e->getMessage());
}
ob_end_clean();
header("Content-Disposition: attachment; filename=" . $filename);

unlink($filename);
exit($content);
