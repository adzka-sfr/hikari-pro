<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloading</title>
    <style>
        .lds-hourglass {
            display: inline-block;
            position: relative;
            width: 10px;
            height: 10px;
        }

        .lds-hourglass:after {
            content: " ";
            display: block;
            border-radius: 50%;
            width: 0;
            height: 0;
            margin: 8px;
            box-sizing: border-box;
            border: 32px solid #dfc;
            border-color: #dfc transparent #dfc transparent;
            animation: lds-hourglass 2.2s infinite;
        }

        @keyframes lds-hourglass {
            0% {
                transform: rotate(0);
                animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
            }

            50% {
                transform: rotate(900deg);
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            }

            100% {
                transform: rotate(1800deg);
            }
        }
    </style>
</head>

<body style="background-color:#263238 ;">
    <!-- <center> -->
    <div style="text-align: center;">
        <div style="margin-top: 200px; margin-right: 100px; color: #dfc; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;" class="lds-hourglass">Downloading</div>
    </div>
</body>

</html>

<?php
date_default_timezone_set('Asia/Jakarta');
$judul = date('F Y');

require 'vendor/autoload.php';
include '../../koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// =================START=================== //
// $sql1 = mysqli_query($connect_cm, "")
// =================END===================== //

// membuat spread sheet baru
$spreadsheet = new Spreadsheet();

// membuat sheet baru
$sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Report B450'); //deklarasi nama sheet
$spreadsheet->addSheet($sheet, 0); // menambahkan sheet baru ke dalam worksheet/spreadsheet dengan format (sheetnya, index sheetnya)

// isi judul
$sheet->setCellValue('A2', $judul . 'Production Schedule / Result For Assembly UP');
$sheet->setCellValue('A4', 'Date');
$sheet->setCellValue('B4', 'Day');
$sheet->setCellValue('C4', 'Over Time');
$sheet->setCellValue('D4', 'U200');
$sheet->setCellValue('D5', 'Plan');
$sheet->setCellValue('E5', 'Actual');
$sheet->setCellValue('F5', 'Status(+/-)');
$sheet->setCellValue('G4', 'Progress');
$sheet->setCellValue('G5', '-1154');

// merge kolom
$spreadsheet->setActiveSheetIndex(0);
$sheet = $spreadsheet->getActiveSheet()->mergeCells('A2:J2'); // judul
$sheet = $spreadsheet->getActiveSheet()->mergeCells('A4:A5'); // Date
$sheet = $spreadsheet->getActiveSheet()->mergeCells('B4:B5'); // Day
$sheet = $spreadsheet->getActiveSheet()->mergeCells('C4:C5'); // Over Time
$sheet = $spreadsheet->getActiveSheet()->mergeCells('D4:F4'); // U200

// mengatur lebar dari kolom
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(55, 'px');
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(100, 'px');
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(71, 'px');
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(73, 'px');
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(73, 'px');
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(73, 'px');
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(65, 'px');

// border atas
$spreadsheet->getActiveSheet()->getStyle('A4:G37')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// memperbesar font
$spreadsheet->getActiveSheet()->getStyle('A2')
    ->getFont()->setSize(14);

// font bold
$spreadsheet->getActiveSheet()->getStyle('A2:G5')
    ->getFont()->setBold(true);

// rata tengah
$spreadsheet->getActiveSheet()->getStyle('A2:F5')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('G4')
    ->getAlignment()->setHorizontal('center');

// memberi warna background
$spreadsheet->getActiveSheet()->getStyle('A2')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('A2')
    ->getFill()->getStartColor()->setARGB('70AD47'); // deklarasi warna

// memberi warna merah pada font
$spreadsheet->getActiveSheet()->getStyle('A2')
    ->getFont()->getColor()->setARGB('FFFFFF');

// menghapus sheet default
$spreadsheet->removeSheetByIndex(1);

$writer = new Xlsx($spreadsheet);
$tgle = date('Y-m-d');
$writer->save('data_hasil/b450_' . $tgle . '.xlsx');
echo "<script>window.location = 'data_hasil/b450_" . $tgle . ".xlsx'</script>";
?>