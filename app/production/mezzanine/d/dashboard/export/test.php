<?php

// PHP program to set a date time value in excel sheet
require '../../../../../../_assets/src/add/export_excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// membuat spread sheet baru
$spreadsheet = new Spreadsheet();

// membuat sheet baru
$sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Seasoning 2 Hours'); //deklarasi nama sheet
$spreadsheet->addSheet($sheet, 0); // menambahkan sheet baru ke dalam worksheet/spreadsheet dengan format (sheetnya, index sheetnya)

// Retrieve the current active worksheet
$sheet = $spreadsheet->getActiveSheet();

// Set the number format mask so that the excel timestamp 
// will be displayed as a human-readable date/time
$spreadsheet->getActiveSheet()->getStyle('A1')
    ->getNumberFormat()
    ->setFormatCode(
        \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME
    );

// Get current date and timestamp
// Convert to an Excel date/time
$dateTime = time();
$excelDateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(
    $dateTime
);

// Set cell A1 with the Formatted date/time value
$sheet->setCellValue('A1', $excelDateValue);

// Write an .xlsx file 
$writer = new Xlsx($spreadsheet);

// Save .xlsx file to the current directory
$tgle = date('Y-m-d');
$filename = 'anjay.xlsx';
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
