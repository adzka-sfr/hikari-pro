
<?php
require 'autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Schedule');
$spreadsheet->addSheet($sheet, 0);
$spreadsheet->setActiveSheetIndex(0);
$sheet = $spreadsheet->getActiveSheet()->mergeCells('G1:I1');
$sheet = $spreadsheet->getActiveSheet()->mergeCells('K5:N6');

$sheet->setCellValue('A1', 'SCM Cls');
$sheet->setCellValue('B1', 'GMC');
$sheet->setCellValue('C1', 'Name');
$sheet->setCellValue('D1', 'Serial');
$sheet->setCellValue('E1', 'Sloc');
$sheet->setCellValue('F1', 'Complete Date');
$sheet->setCellValue('G1', 'Judul');
$sheet->setCellValue('K5', 'Ini harusnya di K6');

$styleArray = [
  'borders' => [
    'allBorders' => [
      'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      'color' => ['argb' => '#263238'],
    ],
  ],
];

$sheet->getStyle('A1:L20')->applyFromArray($styleArray);
$myworksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Report'); // create
$spreadsheet->addSheet($myworksheet, 1); // add

$myworksheet->setCellValue('A1', 'SCM Cls');
$myworksheet->setCellValue('B1', 'GMC');
$myworksheet->setCellValue('C1', 'Name');

$spreadsheet->getSheetByName('Report');
////////////////////////////////////////////////////////////////////////////
$spreadsheet->getActiveSheet()->getStyle('B2')
  ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
$spreadsheet->getActiveSheet()->getStyle('B2')
  ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
$spreadsheet->getActiveSheet()->getStyle('B2')
  ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$spreadsheet->getActiveSheet()->getStyle('B2')
  ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$spreadsheet->getActiveSheet()->getStyle('B2')
  ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$spreadsheet->getActiveSheet()->getStyle('B2')
  ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$spreadsheet->getActiveSheet()->getStyle('B2')
  ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
$spreadsheet->getActiveSheet()->getStyle('B2')
  ->getFill()->getStartColor()->setARGB('04AA6B');

$spreadsheet->setActiveSheetIndexByName('Report')->getStyle('B2')
  ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
$spreadsheet->getActiveSheet()->getStyle('B2')
  ->getFill()->getStartColor()->setARGB('04AA6B');

for ($i = 0; $i <= 20; $i++) {
  $sheet->setCellValue('A' . $i, 'No A' . $i);
  $sheet->setCellValue('B' . $i, 'data B' . $i);
  $sheet->setCellValue('C' . $i, 'data C' . $i);
  $sheet->setCellValue('D' . $i, 'data D' . $i);
  $sheet->setCellValue('E' . $i, 'data E' . $i);
  $sheet->setCellValue('F' . $i, 'data F' . $i);
}
$spreadsheet->setActiveSheetIndex(0);
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20, 'px');

$spreadsheet->removeSheetByIndex(2);

$writer = new Xlsx($spreadsheet);
$writer->save('Stock Piano FG.xlsx');
echo "<script>window.location = 'Stock Piano FG.xlsx'</script>";
?>