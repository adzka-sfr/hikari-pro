<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
session_start();
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$approval  = $_SESSION['id'];
// PHP program to set a date time value in excel sheet
require '../../../../../../_assets/src/add/export_excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// membuat spread sheet baru
$spreadsheet = new Spreadsheet();

// membuat sheet baru
$sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Hasil Reset'); //deklarasi nama sheet
$spreadsheet->addSheet($sheet, 0); // menambahkan sheet baru ke dalam worksheet/spreadsheet dengan format (sheetnya, index sheetnya)

// untuk mengaktifkan worksheet
$spreadsheet->setActiveSheetIndex(0);

// ======= JUDUL ======= //
$sheet->setCellValue('A1', 'Serial Number Piano');
$sheet->setCellValue('A2', 'Data');
$sheet->setCellValue('A3', 'Total Data');

$sheet->setCellValue('B5', 'No');
$sheet->setCellValue('C5', 'Serial Number');
$sheet->setCellValue('D5', 'A-Card');
$sheet->setCellValue('E5', 'Status');
$sheet->setCellValue('F5', 'PIC');
// ======= JUDUL ======= //

// ======= ISI ======= //
$baris = 6;
$no = 1;
$sql = mysqli_query($connect_pro, "SELECT * from qa_reset WHERE c_section = '$approval'");
while ($data = mysqli_fetch_array($sql)) {
    // $dateTime = strtotime("+7 hours", strtotime($data['c_date']));
    // $excelDateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(
    //     $dateTime
    // );

    $sheet->setCellValue('B' . $baris, $no);
    $sheet->setCellValue('C' . $baris, $data['c_serial']);
    $sheet->setCellValue('D' . $baris, $data['c_acard']);
    $sheet->setCellValue('E' . $baris, $data['c_status']);
    $sheet->setCellValue('F' . $baris, $data['c_section']);

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

// font bold
$spreadsheet->getActiveSheet()->getStyle('B5:F5')
    ->getFont()->setBold(true);

// rata tengah
$baris--;
$spreadsheet->getActiveSheet()->getStyle('B5:F5')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('B5:B' . $baris)
    ->getAlignment()->setHorizontal('center');

// border
$spreadsheet->getActiveSheet()->getStyle('B5:F' . $baris)
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// menghapus sheet default
$spreadsheet->removeSheetByIndex(1);

// untuk mengaktifkan worksheet awal yang mau di buka saat membuka dokumen
$spreadsheet->setActiveSheetIndex(0);

// Save .xlsx file to the current directory
$tgle = date('y-m-d');
$filename = 'Hasil Reset ' . $tgle . '.xlsx';
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
