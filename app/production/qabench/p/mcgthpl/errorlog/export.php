<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
session_start();
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
// PHP program to set a date time value in excel sheet
require '../../../../../../_assets/src/add/export_excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$startdate = $_SESSION['logerror_export_start'];
$enddate = $_SESSION['logerror_export_end'];

// membuat spread sheet baru
$spreadsheet = new Spreadsheet();

// membuat sheet baru
$sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Error Log'); //deklarasi nama sheet
$spreadsheet->addSheet($sheet, 0); // menambahkan sheet baru ke dalam worksheet/spreadsheet dengan format (sheetnya, index sheetnya)

// untuk mengaktifkan worksheet
$spreadsheet->setActiveSheetIndex(0);

// ======= CREDIT ======= //
$sheet->setCellValue('A1', 'Downloaded at');
$sheet->setCellValue('B1', ': ' . $now . ' WIB');
$sheet->setCellValue('A2', 'Data');
$sheet->setCellValue('B2', ': Error Log');
$sheet->setCellValue('A3', 'Start Date');
$sheet->setCellValue('B3', ': ' . $startdate);
$sheet->setCellValue('A4', 'End Date');
$sheet->setCellValue('B4', ': ' . $enddate);
// ======= CREDIT ======= //

// ======= JUDUL ======= //
$sheet->setCellValue('B6', 'No');
$sheet->setCellValue('C6', 'Process');
$sheet->setCellValue('D6', 'Error Info');
$sheet->setCellValue('E6', 'Serial');
$sheet->setCellValue('F6', 'Type');
$sheet->setCellValue('G6', 'Time');
$sheet->setCellValue('H6', 'PIC');
// ======= JUDUL ======= //

// ======= ISI ======= //
$baris = 7;
$no = 1;
$sql = mysqli_query($connect_pro, "SELECT * from qa_errorlog WHERE c_datetime > '$startdate' AND c_datetime < '$enddate' ORDER BY id DESC");
while ($data = mysqli_fetch_array($sql)) {
    $dateTime1 = strtotime("+7 hours", strtotime($data['c_datetime']));
    $excelDateValue1 = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(
        $dateTime1
    );

    $sheet->setCellValue('B' . $baris, $no); // center
    $sheet->setCellValue('C' . $baris, $data['c_process']);
    $sheet->setCellValue('D' . $baris, $data['c_error']);
    $sheet->setCellValue('E' . $baris, $data['c_serial']); // center
    $sheet->setCellValue('F' . $baris, $data['c_type']);
    $sheet->setCellValue('G' . $baris, $excelDateValue1);
    $sheet->setCellValue('H' . $baris, $data['c_pic']); // center

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
$spreadsheet->getActiveSheet()->getStyle('E7:E' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('H7:H' . $baris)
    ->getAlignment()->setHorizontal('center');

// menambah filter
$spreadsheet->getActiveSheet()->setAutoFilter('B6:H6');

// border
$spreadsheet->getActiveSheet()->getStyle('B6:H' . $baris)
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// set date format
$spreadsheet->getActiveSheet()->getStyle('G')
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
$filename = 'Error Log.xlsx';
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
