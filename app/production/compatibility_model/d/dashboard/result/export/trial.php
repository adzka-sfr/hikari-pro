<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <!-- <h2 style="margin-top: 200px; color: #dfc;">Downloading</h2> -->
        <div style="margin-top: 200px; margin-right: 100px; color: #dfc; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;" class="lds-hourglass">Downloading</div>
    </div>

    <!-- <div style="margin-top: 300px; margin-left:100px; margin-right: 100px;" class="lds-hourglass"></div> -->
    <!-- </center> -->
</body>

</html>
<?php
// require 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $spreadsheet = new Spreadsheet();

// // membuat sheet baru
// $sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Schedule'); //deklarasi nama sheet
// $spreadsheet->addSheet($sheet, 0); // menambahkan sheet baru ke dalam worksheet/spreadsheet dengan format (sheetnya, index sheetnya)

// // merge kolom
// $spreadsheet->setActiveSheetIndex(0); // diaktifkan untuk melakukan aksi yang membutuhkan aktivasi sheet seperti : merge
// $sheet = $spreadsheet->getActiveSheet()->mergeCells('G1:I1'); // mengambil sheet yang saat ini aktif untuk kemudian dilakukan merge (merge merupakan salah satu aksi yang membutuhkan aktivasi sheet terlebih dahulu)
// $sheet = $spreadsheet->getActiveSheet()->mergeCells('K5:N6');

// // input value ke dalam kolom
// $sheet->setCellValue('A1', 'SCM Cls'); // dilakukan set untuk valuenya dengan format ('kolomnya','isi kolomnya')
// $sheet->setCellValue('B1', 'GMC');
// $sheet->setCellValue('C1', 'Name');
// $sheet->setCellValue('D1', 'Serial');
// $sheet->setCellValue('E1', 'Sloc');
// $sheet->setCellValue('F1', 'Complete Date');
// $sheet->setCellValue('G1', 'Judul');
// $sheet->setCellValue('K5', 'Ini harusnya di K6');

// // custom tampilan
// // memberi garis
// $styleArray = [
//     'borders' => [
//         'allBorders' => [ // untuk saat ini yang aktif adalah memberi garis di semua kolom yang telah dipilih, bisa custom semisal hanya garis kiri, hanya garis kanan dll
//             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
//             'color' => ['argb' => '#263238'], // pemberian warna garisnya
//         ],
//     ],
// ];

// // pengaplikasian hasil custom tampilan
// $sheet->getStyle('A1:L20')->applyFromArray($styleArray); // dilakukan pemilihan kolom terlebih dahulu untuk kemudian dilakukan applying style

// $myworksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Report');
// $spreadsheet->addSheet($myworksheet, 1); // add

// $myworksheet->setCellValue('A1', 'SCM Cls');
// $myworksheet->setCellValue('B1', 'GMC');
// $myworksheet->setCellValue('C1', 'Name');

// $spreadsheet->getSheetByName('Report'); // aktivasi sheet juga bisa dari nama
// ////////////////////////////////////////////////////////////////////////////
// // set style namun tidak menggunakan array
// // memberi warna merah pada font
// $spreadsheet->getActiveSheet()->getStyle('A2')
//     ->getFont()->getColor()->setARGB('70AD47');

// // memberi font bold
// $spreadsheet->getActiveSheet()->getStyle('B2')
//     ->getFont()->setBold(true);

// // rata kanan
// $spreadsheet->getActiveSheet()->getStyle('B2')
//     ->getAlignment()->setHorizontal('left');

// // rata kanan
// $spreadsheet->getActiveSheet()->getStyle('C2')
//     ->getAlignment()->setHorizontal('right');

// // rata tengah
// $spreadsheet->getActiveSheet()->getStyle('C3')
//     ->getAlignment()->setHorizontal('center');

// // memberi garis
// // border atas
// $spreadsheet->getActiveSheet()->getStyle('C2')
//     ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

// // border bawah
// $spreadsheet->getActiveSheet()->getStyle('D2')
//     ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

// // border kiri
// $spreadsheet->getActiveSheet()->getStyle('E2')
//     ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

// // border kanan
// $spreadsheet->getActiveSheet()->getStyle('F2')
//     ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

// // memberi background kolom
// $spreadsheet->getActiveSheet()->getStyle('H2')
//     ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // setup untuk melakukan pengisian warna kolom
// $spreadsheet->getActiveSheet()->getStyle('H2')
//     ->getFill()->getStartColor()->setARGB('04AA6B'); // deklarasi warna

// $spreadsheet->setActiveSheetIndexByName('Report')->getStyle('B2')
//     ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
// $spreadsheet->getActiveSheet()->getStyle('B2')
//     ->getFill()->getStartColor()->setARGB('04AA6B');

// for ($i = 2; $i <= 20; $i++) {
//     $sheet->setCellValue('A' . $i, 'No A' . $i);
//     $sheet->setCellValue('B' . $i, 'data B' . $i);
//     $sheet->setCellValue('C' . $i, 'data C' . $i);
//     $sheet->setCellValue('D' . $i, 'data D' . $i);
//     $sheet->setCellValue('E' . $i, 'data E' . $i);
//     $sheet->setCellValue('F' . $i, 'data F' . $i);
//     $sheet->setCellValue('G' . $i, 'data G' . $i);
//     $sheet->setCellValue('H' . $i, 'data H' . $i);
//     $sheet->setCellValue('I' . $i, 'data I' . $i);
//     $sheet->setCellValue('J' . $i, 'data J' . $i);
//     $sheet->setCellValue('K' . $i, 'data K' . $i);
// }
// $spreadsheet->setActiveSheetIndex(0);
// $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(50, 'px');

// $spreadsheet->removeSheetByIndex(2);

// $writer = new Xlsx($spreadsheet);
// $tgle = date('Y-m-d');
// $writer->save('data_hasil/b450_' . $tgle . '.xlsx');
// echo "<script>window.location = 'data_hasil/b450_" . $tgle . ".xlsx'</script>";

?>