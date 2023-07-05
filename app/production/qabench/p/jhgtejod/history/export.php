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

// membuat spread sheet baru
$spreadsheet = new Spreadsheet();

// membuat sheet baru
$sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Packing ' . $_SESSION['dashboard_export_loc']); //deklarasi nama sheet
$spreadsheet->addSheet($sheet, 0); // menambahkan sheet baru ke dalam worksheet/spreadsheet dengan format (sheetnya, index sheetnya)

if ($_SESSION['dashboard_export_loc'] == 'UP') {
    $location = 'packing up';
} elseif ($_SESSION['dashboard_export_loc'] == 'GP') {
    $location = 'packing gp';
} else {
    $location = 'tidak ada lokasi';
}

// untuk mengaktifkan worksheet
$spreadsheet->setActiveSheetIndex(0);

// ======= CREDIT ======= //
$sheet->setCellValue('A1', 'Downloaded at');
$sheet->setCellValue('B1', ': ' . $now . ' WIB');
$sheet->setCellValue('A2', 'Data');
$sheet->setCellValue('B2', ': Packing ' . $_SESSION['dashboard_export_loc']);
$sheet->setCellValue('A3', 'Start Date');
$sheet->setCellValue('B3', ': ' . $_SESSION['dashboard_export_start']);
$sheet->setCellValue('A4', 'End Date');
$sheet->setCellValue('B4', ': ' . $_SESSION['dashboard_export_end']);
// ======= CREDIT ======= //

// ======= JUDUL ======= //
$sheet->setCellValue('B6', 'No');
$sheet->setCellValue('C6', 'Piano Serial');
$sheet->setCellValue('D6', 'Piano GMC');
$sheet->setCellValue('E6', 'Piano Name');
$sheet->setCellValue('F6', 'Bench Serial');
$sheet->setCellValue('G6', 'Bench GMC');
$sheet->setCellValue('H6', 'Bench Name');
$sheet->setCellValue('I6', 'User Package Serial');
$sheet->setCellValue('J6', 'User Package GMC');
$sheet->setCellValue('K6', 'User Package Name');
$sheet->setCellValue('L6', 'Packing Time');
$sheet->setCellValue('M6', 'PIC');
$sheet->setCellValue('N6', 'Location');
$sheet->setCellValue('O6', 'Status');
// ======= JUDUL ======= //

// ======= ISI ======= //
$baris = 7;
$no = 1;
$sql = mysqli_query($connect_pro, "SELECT * from qa_log WHERE c_date > '$_SESSION[dashboard_export_start]' AND c_date < '$_SESSION[dashboard_export_end]' AND c_location = '$location'  AND c_action = 'packing' OR c_date > '$_SESSION[dashboard_export_start]' AND c_date < '$_SESSION[dashboard_export_end]' AND c_location = '$location'  AND c_action = 'reset' ORDER BY id DESC");
while ($data = mysqli_fetch_array($sql)) {
    $dateTime = strtotime("+7 hours", strtotime($data['c_date']));
    $excelDateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(
        $dateTime
    );

    $sheet->setCellValue('B' . $baris, $no);
    $sheet->setCellValue('C' . $baris, $data['c_serialpiano']);
    $sheet->setCellValue('D' . $baris, $data['c_gmcpiano']);
    $sheet->setCellValue('E' . $baris, $data['c_namepiano']);
    $sheet->setCellValue('F' . $baris, $data['c_serialbench']);
    $sheet->setCellValue('G' . $baris, $data['c_gmcbench']);
    $sheet->setCellValue('H' . $baris, $data['c_namebench']);
    $sheet->setCellValue('I' . $baris, $data['c_serialuserp']);
    $sheet->setCellValue('J' . $baris, $data['c_gmcuserp']);
    $sheet->setCellValue('K' . $baris, $data['c_nameuserp']);
    $sheet->setCellValue('L' . $baris, $excelDateValue);
    $sheet->setCellValue('M' . $baris, $data['c_pic']);
    $sheet->setCellValue('N' . $baris, $data['c_location']);
    $sheet->setCellValue('O' . $baris, $data['c_action']);


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
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

// font bold
$spreadsheet->getActiveSheet()->getStyle('B6:O6')
    ->getFont()->setBold(true);

// rata tengah
$baris--;
$spreadsheet->getActiveSheet()->getStyle('B6:O6')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('B7:B' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('C7:C' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('D7:D' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('F7:F' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('G7:G' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('I7:I' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('J7:J' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('M7:M' . $baris)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('N7:N' . $baris)
    ->getAlignment()->setHorizontal('center');

// menambah filter
$spreadsheet->getActiveSheet()->setAutoFilter('B6:O6');

// border
$spreadsheet->getActiveSheet()->getStyle('B6:O' . $baris)
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// set date format
$spreadsheet->getActiveSheet()->getStyle('L')
    ->getNumberFormat()
    ->setFormatCode(
        \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME
    );

// menghapus sheet default
$spreadsheet->removeSheetByIndex(1);

// untuk mengaktifkan worksheet awal yang mau di buka saat membuka dokumen
$spreadsheet->setActiveSheetIndex(0);

// Save .xlsx file to the current directory
$tgle = date('y-m-d');
$filename = 'Packing ' . $_SESSION['dashboard_export_loc'] . '-' . $tgle . '.xlsx';
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
