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
$now = date('Y-m-d H:i:s');
require '../../../../../_assets/src/add/export_excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// mendapatkan tanggal pada hari ini
$tgle = date('F_Y', strtotime('+1 month'));
// membuat spread sheet baru
$spreadsheet = new Spreadsheet();

// membuat sheet baru
$sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Plan ' . $tgle); //deklarasi nama sheet
$spreadsheet->addSheet($sheet, 0); // menambahkan sheet baru ke dalam worksheet/spreadsheet dengan format (sheetnya, index sheetnya)

// untuk mengaktifkan worksheet
$spreadsheet->setActiveSheetIndex(0);
// isi judul
$sheet->setCellValue('A1', 'Date (ex: 2022-08-25)');
$sheet->setCellValue('B1', 'Plan Number (ex: UP20221101001470)');
$sheet->setCellValue('C1', 'Finish Good GMC (ex: VFQ2410)');
$sheet->setCellValue('D1', 'Model (ex: B121SC3)');
$sheet->setCellValue('E1', 'Color (ex: PE)');
$sheet->setCellValue('F1', 'Destination (ex: LZ)');

//menambah komentar
$spreadsheet->getActiveSheet()
    ->getComment('A1')
    ->setAuthor('Adzka SFR');
$commentRichText = $spreadsheet->getActiveSheet()
    ->getComment('A1')
    ->getText()->createTextRun('Catatan:');
$commentRichText->getFont()->setBold(true);
$spreadsheet->getActiveSheet()
    ->getComment('A1')
    ->getText()->createTextRun("\r\n");
$spreadsheet->getActiveSheet()
    ->getComment('A1')
    ->getText()->createTextRun('Dimohon untuk memasukan data sesuai dengan contoh yang telah diberikan dan pada kolom yang sudah di tentukan. Terutama untuk format tanggal harus yyyy-mm-dd.');
$spreadsheet->getActiveSheet()
    ->getComment('A1')
    ->setWidth('300px');
$spreadsheet->getActiveSheet()
    ->getComment('A1')
    ->setHeight('200px');

// mengatur lebar dari kolom
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

// font bold
$spreadsheet->getActiveSheet()->getStyle('A1:F1')
    ->getFont()->setBold(true);

// rata tengah
$spreadsheet->getActiveSheet()->getStyle('A1:F1')
    ->getAlignment()->setHorizontal('center');

// menghapus sheet default
$spreadsheet->removeSheetByIndex(1);

$writer = new Xlsx($spreadsheet);

$writer->save('format/upload_plan_' . $tgle . '.xlsx');
echo "<script>window.location = 'format/upload_plan_" . $tgle . ".xlsx'</script>";
?>