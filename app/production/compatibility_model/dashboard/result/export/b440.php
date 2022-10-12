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

require '../../../../../../_assets/src/add/export_excel/vendor/autoload.php';
include '../../koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// =================START=================== //
// mendapatkan total plan (G5)
$month = date('Y-m');
$maks_sql = mysqli_query($connect_cm, "SELECT MAX(tanggal) as maks from plan where tanggal like '$month%'");
$maks = mysqli_fetch_array($maks_sql);
$sql1 = mysqli_query($connect_cm, "select COUNT(common) as total from plan where tanggal like '$month%'");
$data1 = mysqli_fetch_array($sql1);
$totpla = $data1['total'] * (-1);
$totplamo = $totpla;

// mengisi tanggal (A6-A36)
$jumhar = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
// =================END===================== //

// membuat spread sheet baru
$spreadsheet = new Spreadsheet();

// membuat sheet baru
$sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Report B440'); //deklarasi nama sheet
$spreadsheet->addSheet($sheet, 0); // menambahkan sheet baru ke dalam worksheet/spreadsheet dengan format (sheetnya, index sheetnya)

// isi judul
$sheet->setCellValue('A2', $judul . 'Production Schedule / Result For Assembly UP');
$sheet->setCellValue('A4', 'Date');
$sheet->setCellValue('B4', 'Day');
$sheet->setCellValue('C4', 'Over Time');
$sheet->setCellValue('D4', 'B440');
$sheet->setCellValue('D5', 'Plan');
$sheet->setCellValue('E5', 'Actual');
$sheet->setCellValue('F5', 'Status(+/-)');
$sheet->setCellValue('G4', 'Progress');
$sheet->setCellValue('G5', $totpla);
$sheet->setCellValue('A37', 'Total');

// isi
for ($j = 1; $j <= $jumhar; $j++) {
    // CUSTOMIZE
    $bar = $j + 5; // untuk baris, dimulai dari 6
    $har = date('Y-m') . "-" . $j;
    $tude = date('d');
    $listtude = date('d', strtotime($har));
    if ($listtude <= $tude) {
        // Memeberi warna merah ketika sabtu dan minggu
        $spreadsheet->setActiveSheetIndexByName('Report B440')->getStyle('A' . $bar)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A' . $bar)
            ->getFill()->getStartColor()->setARGB('00B0F0');
    }

    // KOLOM DATE (A)
    $sheet->setCellValue('A' . $bar, $j);

    // KOLOM DAY (B)
    $hari = date('l', strtotime($har));
    $sheet->setCellValue('B' . $bar, $hari);

    // KOLOM OVER TIME (C)

    // KOLOM PLAN (D)
    $haru = $har;
    $plan = 0;
    $sql2 = mysqli_query($connect_cm, "SELECT COUNT(common) as plan from plan where tanggal = '$haru'");
    $data2 = mysqli_fetch_array($sql2);
    $plan = $data2['plan'];

    if ($hari == "Saturday" or $hari == "Sunday") {
        // Memeberi warna merah ketika sabtu dan minggu
        $spreadsheet->setActiveSheetIndexByName('Report B440')->getStyle('A' . $bar . ':G' . $bar)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A' . $bar . ':G' . $bar)
            ->getFill()->getStartColor()->setARGB('FF0000');
    }

    $sheet->setCellValue('D' . $bar, $plan);

    // KOLOM ACTUAL (E)
    $sql3 = mysqli_query($connect_cm, "SELECT b440 from hasil where tanggal = '$har'");
    $data3 = mysqli_fetch_array($sql3);
    if (empty($data3['b440'])) {
        $actual = 0;
    } else {
        $actual = $data3['b440'];
    }
    $sheet->setCellValue('E' . $bar, $actual);

    // KOLOM STATUS (F)
    $sheet->setCellValue('F' . $bar, '=E' . $bar . '-D' . $bar);

    // KOLOM PROGRESS (G)
    $progress = $bar - 1;
    $sheet->setCellValue('G' . $bar, '=G' . $progress . '+E' . $bar);
}

// total tiap kolom
$sheet->setCellValue('D37', '=SUM(D6:D36)');
$sheet->setCellValue('E37', '=SUM(E6:E36)');
$sheet->setCellValue('F37', '=SUM(F6:F36)');

$sheet->setCellValue('G37', '=E37-D37');

// merge kolom
$spreadsheet->setActiveSheetIndex(0);
$sheet = $spreadsheet->getActiveSheet()->mergeCells('A2:J2'); // judul
$sheet = $spreadsheet->getActiveSheet()->mergeCells('A4:A5'); // Date
$sheet = $spreadsheet->getActiveSheet()->mergeCells('B4:B5'); // Day
$sheet = $spreadsheet->getActiveSheet()->mergeCells('C4:C5'); // Over Time
$sheet = $spreadsheet->getActiveSheet()->mergeCells('D4:F4'); // U200
$sheet = $spreadsheet->getActiveSheet()->mergeCells('A37:B37'); // Total

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
$spreadsheet->getActiveSheet()->getStyle('A37:G37')
    ->getFont()->setBold(true);

// rata tengah
$spreadsheet->getActiveSheet()->getStyle('A2:F5')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('G4')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('A6:A36')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('A37')
    ->getAlignment()->setHorizontal('right');

// memberi warna background
// judul
$spreadsheet->getActiveSheet()->getStyle('A2')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('A2')
    ->getFill()->getStartColor()->setARGB('70AD47'); // deklarasi warna

// workcenter
$spreadsheet->getActiveSheet()->getStyle('D4')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('D4')
    ->getFill()->getStartColor()->setARGB('70AD47'); // deklarasi warna

// memberi warna merah pada font
$spreadsheet->getActiveSheet()->getStyle('A2')
    ->getFont()->getColor()->setARGB('FFFFFF');

// menghapus sheet default
$spreadsheet->removeSheetByIndex(1);

$writer = new Xlsx($spreadsheet);
$tgle = date('Y-m-d');
$writer->save('data_hasil/b440_' . $tgle . '.xlsx');
echo "<script>window.location = 'data_hasil/b440_" . $tgle . ".xlsx'</script>";
?>