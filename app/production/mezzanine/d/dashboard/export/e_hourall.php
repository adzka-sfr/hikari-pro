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
$now = date('Y-m-d H:i:s');
require '../../../../../../_assets/src/add/export_excel/vendor/autoload.php';
include '../koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// mendapatkan tanggal pada hari ini
$time = date('l, d-m-Y H:i:s');

// membuat spread sheet baru
$spreadsheet = new Spreadsheet();

// membuat sheet baru
$sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Seasoning 2 Hours'); //deklarasi nama sheet
$spreadsheet->addSheet($sheet, 0); // menambahkan sheet baru ke dalam worksheet/spreadsheet dengan format (sheetnya, index sheetnya)

$sheet2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Seasoning 16 Hours');
$spreadsheet->addSheet($sheet2, 1); // add

// untuk mengaktifkan worksheet
$spreadsheet->setActiveSheetIndex(0);
// isi judul
$sheet->setCellValue('A1', 'Downloaded at : ' . $time . ' WIB');
$sheet->setCellValue('A3', 'Summary of Seasoning 2 Hours');
$sheet->setCellValue('A5', 'Slip');
$sheet->setCellValue('B5', 'GMC');
$sheet->setCellValue('C5', 'Model');
$sheet->setCellValue('D5', 'Cabinet Name');
$sheet->setCellValue('E5', 'On Process / Finish');
$sheet->setCellValue('F5', 'Category');
$sheet->setCellValue('G5', 'Qty');
$sheet->setCellValue('H5', 'Scanned In');
$sheet->setCellValue('I5', 'Settled Down - Time');
$sheet->setCellValue('J5', 'Status');

// ==================START================== //
// data
$b = 6;
$sql = mysqli_query($con_pro, "SELECT * from to_ongoing_slip order by time_out desc");
while ($data = mysqli_fetch_array($sql)) {

    // mengetahui downtime
    $awal = new DateTime($data['time_in']);
    $akhir = new DateTime($now);
    $diff = $awal->diff($akhir);

    // untuk mengetahui status dan pemberian warna
    if ($data['time_out'] >= $now) {
        $info = 'NOT READY';
        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('A' . $b)
            ->getFont()->getColor()->setARGB('9C0006');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('A' . $b)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('A' . $b)
            ->getFill()->getStartColor()->setARGB('FFC7CE'); // deklarasi warna

        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('J' . $b)
            ->getFont()->getColor()->setARGB('9C0006');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('J' . $b)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('J' . $b)
            ->getFill()->getStartColor()->setARGB('FFC7CE'); // deklarasi warna

    } elseif ($data['time_out'] < $now && $diff->d < 1) {
        $info = 'READY';
        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('A' . $b)
            ->getFont()->getColor()->setARGB('006100');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('A' . $b)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('A' . $b)
            ->getFill()->getStartColor()->setARGB('C6EFCE'); // deklarasi warna

        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('J' . $b)
            ->getFont()->getColor()->setARGB('006100');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('J' . $b)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('J' . $b)
            ->getFill()->getStartColor()->setARGB('C6EFCE'); // deklarasi warna
    } else {
        $info = 'READY';
        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('A' . $b)
            ->getFont()->getColor()->setARGB('9C5700');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('A' . $b)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('A' . $b)
            ->getFill()->getStartColor()->setARGB('FFEB9C'); // deklarasi warna

        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('J' . $b)
            ->getFont()->getColor()->setARGB('9C5700');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('J' . $b)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('J' . $b)
            ->getFill()->getStartColor()->setARGB('FFEB9C'); // deklarasi warna
    }

    // insert isi
    $sheet->setCellValue('A' . $b, $data['slip']);
    $sheet->setCellValue('B' . $b, $data['kode']);
    $sheet->setCellValue('C' . $b, $data['model']);
    $sheet->setCellValue('D' . $b, $data['nama_kabinet']);
    $sheet->setCellValue('E' . $b, $data['muka']);
    $sheet->setCellValue('F' . $b, $data['kategori']);
    $sheet->setCellValue('G' . $b, $data['qty']);
    $sheet->setCellValue('H' . $b, $data['time_in']);
    $sheet->setCellValue('I' . $b, $diff->d . ' hari ' . $diff->h . ' jam ' . $diff->i . ' menit '); // downtime
    $sheet->setCellValue('J' . $b, $info); // status
    $b++;
}

$c = $b - 1; // isi cuma sampe c

// label total
$sheet->setCellValue('L3', 'Summary'); // total label
$sheet->setCellValue('L5', 'Total in 2 Hours'); // total in label

$sheet->setCellValue('L7', 'by Category'); // category label
$sheet->setCellValue('L8', 'Panel'); // PANEL label
$sheet->setCellValue('L9', 'Small Long'); // SMALL LONG label
$sheet->setCellValue('L10', 'Small Short'); // SMALL SHORT label
$sheet->setCellValue('L11', 'Total'); // Total label

$sheet->setCellValue('L13', 'by OP/F'); // op/f label
$sheet->setCellValue('L14', 'On Process'); // op label
$sheet->setCellValue('L15', 'Finish'); // f label
$sheet->setCellValue('L16', 'Total'); // total label

$sheet->setCellValue('L18', 'Status'); // status label
$sheet->setCellValue('L19', 'Not Ready'); // not ready label
$sheet->setCellValue('L20', 'Ready'); // ready label
$sheet->setCellValue('L21', 'Total'); // total label

// value total by category
$sheet->setCellValue('N5', '=SUM(G6:G' . $c . ')'); // total in value

$sheet->setCellValue('M8', '=SUMIF($F$6:$F$' . $c . ',L8,$G$6:$G$' . $c . ')'); // total panel value
$sheet->setCellValue('M9', '=SUMIF($F$6:$F$' . $c . ',L9,$G$6:$G$' . $c . ')'); // total small long value
$sheet->setCellValue('M10', '=SUMIF($F$6:$F$' . $c . ',L10,$G$6:$G$' . $c . ')'); // total small short value
$sheet->setCellValue('M11', '=SUM(M8:M10)'); // total category value

// value total by op/f
$sheet->setCellValue('M14', '=SUMIF($E$6:$E$' . $c . ',L14,$G$6:$G$' . $c . ')'); // total op value
$sheet->setCellValue('M15', '=SUMIF($E$6:$E$' . $c . ',L15,$G$6:$G$' . $c . ')'); // total f value
$sheet->setCellValue('M16', '=SUM(M14:M15)'); // total op/f value

// value total by status
$sheet->setCellValue('M19', '=SUMIF($J$6:$J$' . $c . ',L19,$G$6:$G$' . $c . ')'); // total not ready value
$sheet->setCellValue('M20', '=SUMIF($J$6:$J$' . $c . ',L20,$G$6:$G$' . $c . ')'); // total ready value
$sheet->setCellValue('M21', '=SUM(M19:M20)'); // total status value

// percentage by category
$sheet->setCellValue('N8', '=M8/$M$11'); // total panel value
$sheet->setCellValue('N9', '=M9/$M$11'); // total small long value
$sheet->setCellValue('N10', '=M10/$M$11'); // total small short value
$sheet->setCellValue('N11', '=M11/$N$5'); // total percentage category value

// percentage by op/f
$sheet->setCellValue('N14', '=M14/$M$16'); // total panel value
$sheet->setCellValue('N15', '=M15/$M$16'); // total small long value
$sheet->setCellValue('N16', '=M16/$N$5'); // total percentage op/f value

// percentage by status
$sheet->setCellValue('N19', '=M19/$M$21'); // total panel value
$sheet->setCellValue('N20', '=M20/$M$21'); // total small long value
$sheet->setCellValue('N21', '=M21/$N$5'); // total small long value
// ===================END=================== //

// merge kolom
$sheet = $spreadsheet->getActiveSheet()->mergeCells('A1:E1'); // downloaded at
$sheet = $spreadsheet->getActiveSheet()->mergeCells('A3:J3'); // judul summary of
$sheet = $spreadsheet->getActiveSheet()->mergeCells('L3:N3'); // judul summary
$sheet = $spreadsheet->getActiveSheet()->mergeCells('L5:M5'); // judul Total in 2 hours
$sheet = $spreadsheet->getActiveSheet()->mergeCells('L7:N7'); // judul by category
$sheet = $spreadsheet->getActiveSheet()->mergeCells('L13:N13'); // judul by op/f
$sheet = $spreadsheet->getActiveSheet()->mergeCells('L18:N18'); // judul by status

// mengatur lebar dari kolom
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30, 'px');
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(50, 'px');
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(50, 'px');

// border atas
$spreadsheet->getActiveSheet()->getStyle('A5:J' . $b)
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$spreadsheet->getActiveSheet()->getStyle('L5:N5')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$spreadsheet->getActiveSheet()->getStyle('L7:N11')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$spreadsheet->getActiveSheet()->getStyle('L13:N16')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$spreadsheet->getActiveSheet()->getStyle('L18:N21')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// memperbesar font
$spreadsheet->getActiveSheet()->getStyle('A3:L3')
    ->getFont()->setSize(14);

// format number (persen)
$spreadsheet->getActiveSheet()->getStyle('N8:N21')->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_0);

// $spreadsheet->getActiveSheet()->getStyle('N6')->getNumberFormat()
// ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00); // kalau mau ada 2 angka belakang koma

// italic
$spreadsheet->getActiveSheet()->getStyle('A1')
    ->getFont()->setItalic(true);

// font bold
$spreadsheet->getActiveSheet()->getStyle('A3:N5')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('A' . $b . ':J' . $b)
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L5:N5')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L7')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L11:N11')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L13')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L16:N16')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L18')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L21:N21')
    ->getFont()->setBold(true);

// rata tengah
$spreadsheet->getActiveSheet()->getStyle('A3:J5')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('A6:B' . $c)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('E6:G' . $c)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('J6:J' . $c)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('A' . $b)
    ->getAlignment()->setHorizontal('right');
$spreadsheet->getActiveSheet()->getStyle('G' . $b)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('L3')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('L7')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('L13')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('L18')
    ->getAlignment()->setHorizontal('center');

// memberi warna background
// judul (hijau)
$spreadsheet->getActiveSheet()->getStyle('A3')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('A3')
    ->getFill()->getStartColor()->setARGB('A9D08E'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L3')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L3')
    ->getFill()->getStartColor()->setARGB('A9D08E'); // deklarasi warna

// total in (merah)
$spreadsheet->getActiveSheet()->getStyle('L5:N5')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L5:N5')
    ->getFill()->getStartColor()->setARGB('FF0000'); // deklarasi warna

// workcenter (biru)
$spreadsheet->getActiveSheet()->getStyle('A5:J5')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('A5:J5')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L7')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L7')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L11:N11')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L11:N11')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L13')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L13')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L16:N16')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L16:N16')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L18')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L18')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L21:N21')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L21:N21')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

// menambah filter
$spreadsheet->getActiveSheet()->setAutoFilter('A5:J5');

// memberi warna pada font
// $spreadsheet->getActiveSheet()->getStyle('A3')
//     ->getFont()->getColor()->setARGB('FFFFFF');

// untuk mengaktifkan worksheet
$spreadsheet->setActiveSheetIndex(1);
// isi judul
$sheet2->setCellValue('A1', 'Downloaded at : ' . $time . ' WIB');
$sheet2->setCellValue('A3', 'Summary of Seasoning 16 Hours');
$sheet2->setCellValue('A5', 'Slip');
$sheet2->setCellValue('B5', 'GMC');
$sheet2->setCellValue('C5', 'Model');
$sheet2->setCellValue('D5', 'Cabinet Name');
$sheet2->setCellValue('E5', 'On Process / Finish');
$sheet2->setCellValue('F5', 'Category');
$sheet2->setCellValue('G5', 'Qty');
$sheet2->setCellValue('H5', 'Scanned In');
$sheet2->setCellValue('I5', 'Settled Down - Time');
$sheet2->setCellValue('J5', 'Status');

// ==================START================== //
// data
$d = 6;
$sql2 = mysqli_query($con_pro, "SELECT * from ongoing_slip order by time_out desc");
while ($data2 = mysqli_fetch_array($sql2)) {

    // mengetahui downtime
    $awal2 = new DateTime($data2['time_in']);
    $akhir2 = new DateTime($now);
    $diff2 = $awal2->diff($akhir2);

    // untuk mengetahui status dan pemberian warna
    if ($data2['time_out'] >= $now) {
        $info = 'NOT READY';
        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('A' . $d)
            ->getFont()->getColor()->setARGB('9C0006');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('A' . $d)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('A' . $d)
            ->getFill()->getStartColor()->setARGB('FFC7CE'); // deklarasi warna

        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('J' . $d)
            ->getFont()->getColor()->setARGB('9C0006');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('J' . $d)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('J' . $d)
            ->getFill()->getStartColor()->setARGB('FFC7CE'); // deklarasi warna

    } elseif ($data2['time_out'] < $now && $diff2->d < 3) {
        $info = 'READY';
        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('A' . $d)
            ->getFont()->getColor()->setARGB('006100');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('A' . $d)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('A' . $d)
            ->getFill()->getStartColor()->setARGB('C6EFCE'); // deklarasi warna

        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('J' . $d)
            ->getFont()->getColor()->setARGB('006100');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('J' . $d)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('J' . $d)
            ->getFill()->getStartColor()->setARGB('C6EFCE'); // deklarasi warna
    } else {
        $info = 'READY';
        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('A' . $d)
            ->getFont()->getColor()->setARGB('9C5700');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('A' . $d)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('A' . $d)
            ->getFill()->getStartColor()->setARGB('FFEB9C'); // deklarasi warna

        // memberi warna pada font
        $spreadsheet->getActiveSheet()->getStyle('J' . $d)
            ->getFont()->getColor()->setARGB('9C5700');
        // warna background
        $spreadsheet->getActiveSheet()->getStyle('J' . $d)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
        $spreadsheet->getActiveSheet()->getStyle('J' . $d)
            ->getFill()->getStartColor()->setARGB('FFEB9C'); // deklarasi warna
    }

    // insert isi
    $sheet2->setCellValue('A' . $d, $data2['slip']);
    $sheet2->setCellValue('B' . $d, $data2['kode']);
    $sheet2->setCellValue('C' . $d, $data2['model']);
    $sheet2->setCellValue('D' . $d, $data2['nama_kabinet']);
    $sheet2->setCellValue('E' . $d, $data2['muka']);
    $sheet2->setCellValue('F' . $d, $data2['kategori']);
    $sheet2->setCellValue('G' . $d, $data2['qty']);
    $sheet2->setCellValue('H' . $d, $data2['time_in']);
    $sheet2->setCellValue('I' . $d, $diff2->d . ' hari ' . $diff2->h . ' jam ' . $diff2->i . ' menit '); // downtime
    $sheet2->setCellValue('J' . $d, $info); // status
    $d++;
}
$e = $d - 1;

// label total
$sheet2->setCellValue('L3', 'Summary'); // total label
$sheet2->setCellValue('L5', 'Total in 16 Hours'); // total in label

$sheet2->setCellValue('L7', 'by Category'); // category label
$sheet2->setCellValue('L8', 'Panel'); // PANEL label
$sheet2->setCellValue('L9', 'Small Long'); // SMALL LONG label
$sheet2->setCellValue('L10', 'Small Short'); // SMALL SHORT label
$sheet2->setCellValue('L11', 'Total'); // Total label

$sheet2->setCellValue('L13', 'by OP/F'); // op/f label
$sheet2->setCellValue('L14', 'On Process'); // op label
$sheet2->setCellValue('L15', 'Finish'); // f label
$sheet2->setCellValue('L16', 'Total'); // total label

$sheet2->setCellValue('L18', 'Status'); // status label
$sheet2->setCellValue('L19', 'Not Ready'); // not ready label
$sheet2->setCellValue('L20', 'Ready'); // ready label
$sheet2->setCellValue('L21', 'Total'); // total label

// value total by category
$sheet2->setCellValue('N5', '=SUM(G6:G' . $e . ')'); // total in value

$sheet2->setCellValue('M8', '=SUMIF($F$6:$F$' . $e . ',L8,$G$6:$G$' . $e . ')'); // total panel value
$sheet2->setCellValue('M9', '=SUMIF($F$6:$F$' . $e . ',L9,$G$6:$G$' . $e . ')'); // total small long value
$sheet2->setCellValue('M10', '=SUMIF($F$6:$F$' . $e . ',L10,$G$6:$G$' . $e . ')'); // total small short value
$sheet2->setCellValue('M11', '=SUM(M8:M10)'); // total category value

// value total by op/f
$sheet2->setCellValue('M14', '=SUMIF($E$6:$E$' . $e . ',L14,$G$6:$G$' . $e . ')'); // total op value
$sheet2->setCellValue('M15', '=SUMIF($E$6:$E$' . $e . ',L15,$G$6:$G$' . $e . ')'); // total f value
$sheet2->setCellValue('M16', '=SUM(M14:M15)'); // total op/f value

// value total by status
$sheet2->setCellValue('M19', '=SUMIF($J$6:$J$' . $e . ',L19,$G$6:$G$' . $e . ')'); // total not ready value
$sheet2->setCellValue('M20', '=SUMIF($J$6:$J$' . $e . ',L20,$G$6:$G$' . $e . ')'); // total ready value
$sheet2->setCellValue('M21', '=SUM(M19:M20)'); // total status value

// percentage by category
$sheet2->setCellValue('N8', '=M8/$M$11'); // total panel value
$sheet2->setCellValue('N9', '=M9/$M$11'); // total small long value
$sheet2->setCellValue('N10', '=M10/$M$11'); // total small short value
$sheet2->setCellValue('N11', '=M11/$N$5'); // total percentage category value

// percentage by op/f
$sheet2->setCellValue('N14', '=M14/$M$16'); // total panel value
$sheet2->setCellValue('N15', '=M15/$M$16'); // total small long value
$sheet2->setCellValue('N16', '=M16/$N$5'); // total percentage op/f value

// percentage by status
$sheet2->setCellValue('N19', '=M19/$M$21'); // total panel value
$sheet2->setCellValue('N20', '=M20/$M$21'); // total small long value
$sheet2->setCellValue('N21', '=M21/$N$5'); // total small long value
// ===================END=================== //

// merge kolom
$sheet2 = $spreadsheet->getActiveSheet()->mergeCells('A1:E1'); // downloaded at
$sheet2 = $spreadsheet->getActiveSheet()->mergeCells('A3:J3'); // judul summary of
$sheet2 = $spreadsheet->getActiveSheet()->mergeCells('L3:N3'); // judul summary
$sheet2 = $spreadsheet->getActiveSheet()->mergeCells('L5:M5'); // judul Total in 2 hours
$sheet2 = $spreadsheet->getActiveSheet()->mergeCells('L7:N7'); // judul by category
$sheet2 = $spreadsheet->getActiveSheet()->mergeCells('L13:N13'); // judul by op/f
$sheet2 = $spreadsheet->getActiveSheet()->mergeCells('L18:N18'); // judul by status

// mengatur lebar dari kolom
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30, 'px');
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(50, 'px');
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(50, 'px');

// border atas
$spreadsheet->getActiveSheet()->getStyle('A5:J' . $d)
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$spreadsheet->getActiveSheet()->getStyle('L5:N5')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$spreadsheet->getActiveSheet()->getStyle('L7:N11')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$spreadsheet->getActiveSheet()->getStyle('L13:N16')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$spreadsheet->getActiveSheet()->getStyle('L18:N21')
    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// memperbesar font
$spreadsheet->getActiveSheet()->getStyle('A3:L3')
    ->getFont()->setSize(14);

// format number (persen)
$spreadsheet->getActiveSheet()->getStyle('N8:N21')->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_0);

// $spreadsheet->getActiveSheet()->getStyle('N6')->getNumberFormat()
// ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00); // kalau mau ada 2 angka belakang koma

// italic
$spreadsheet->getActiveSheet()->getStyle('A1')
    ->getFont()->setItalic(true);

// font bold
$spreadsheet->getActiveSheet()->getStyle('A3:N5')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('A' . $d . ':J' . $d)
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L5:N5')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L7')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L11:N11')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L13')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L16:N16')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L18')
    ->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('L21:N21')
    ->getFont()->setBold(true);

// rata tengah
$spreadsheet->getActiveSheet()->getStyle('A3:J5')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('A6:B' . $e)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('E6:G' . $e)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('J6:J' . $e)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('A' . $d)
    ->getAlignment()->setHorizontal('right');
$spreadsheet->getActiveSheet()->getStyle('G' . $d)
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('L3')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('L7')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('L13')
    ->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('L18')
    ->getAlignment()->setHorizontal('center');

// memberi warna background
// judul (hijau)
$spreadsheet->getActiveSheet()->getStyle('A3')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('A3')
    ->getFill()->getStartColor()->setARGB('A9D08E'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L3')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L3')
    ->getFill()->getStartColor()->setARGB('A9D08E'); // deklarasi warna

// total in (merah)
$spreadsheet->getActiveSheet()->getStyle('L5:N5')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L5:N5')
    ->getFill()->getStartColor()->setARGB('FF0000'); // deklarasi warna

// workcenter (biru)
$spreadsheet->getActiveSheet()->getStyle('A5:J5')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('A5:J5')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L7')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L7')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L11:N11')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L11:N11')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L13')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L13')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L16:N16')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L16:N16')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L18')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L18')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

$spreadsheet->getActiveSheet()->getStyle('L21:N21')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
$spreadsheet->getActiveSheet()->getStyle('L21:N21')
    ->getFill()->getStartColor()->setARGB('B4C6E7'); // deklarasi warna

// menambah filter
$spreadsheet->getActiveSheet()->setAutoFilter('A5:J5');

// menghapus sheet default
$spreadsheet->removeSheetByIndex(2);

// untuk mengaktifkan worksheet awal yang mau di buka saat membuka dokumen
$spreadsheet->setActiveSheetIndex(0);

// $writer = new Xlsx($spreadsheet);
// $tgle = date('Y-m-d');
// $writer->save('data_hasil/summary_seasoning_2hour_' . $tgle . '.xlsx');
// echo "<script>window.location = 'data_hasil/summary_seasoning_2hour_" . $tgle . ".xlsx'</script>";

$tgle = date('Y-m-d');
$filename = 'data_hasil/summary_seasoning_2hour_' . $tgle . '.xlsx';
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
?>

<?php
//================== ACTIVITY LOG START ==================//
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
session_start();

// log activity record  
$now = date('Y-m-d H:i:s');
$token = $_SESSION['token'];

$l_t = $now;
$sy_n = "Mezzanine"; // Nama Sistem
$p_n = "export all data"; // Nama Proses
$q = "read"; // Query
$e_n = $_SESSION['nama']; // Nama Karyawan
$e_i = $_SESSION['id']; // ID Karyawan
$c_i = $_SERVER['REMOTE_ADDR'];
$c_n = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$s_n = $_SERVER['SCRIPT_NAME'];
$h = $_SERVER['HTTP_HOST'];
mysqli_query($connect_log, "INSERT INTO activity_log set
                                    token = '$token',
                                    log_time = '$l_t',
                                    system_name = '$sy_n',
                                    process_name = '$p_n',
                                    query = '$q',
                                    employee_name = '$e_n',
                                    employee_id = '$e_i',
                                    computer_ip = '$c_i',
                                    computer_name = '$c_n',
                                    script_name = '$s_n',
                                    host = '$h'");

//================== ACTIVITY LOG FINISH ==================//
?>