<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");


// get type (furniture or polyester)
$sql2 = mysqli_query($connect_pro, "SELECT c_category FROM formng_category WHERE c_gmc = '$_SESSION[gmcpdf]'");
$data2 = mysqli_fetch_array($sql2);

$serial = $_SESSION['pdf'];
$namepiano = $_SESSION['namepianopdf'];
$type = $data2['c_category'];

?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="image/logo_icon.png">

    <title>Preview</title>

    <style>
        @font-face {
            font-family: "Inter";
            src: url("font/Inter-Regular.ttf") format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: "Inter";
            src: url("font/Inter-Medium.ttf") format("truetype");
            font-weight: 500;
            font-style: normal;
        }

        @font-face {
            font-family: "Inter";
            src: url("font/Inter-Bold.ttf") format("truetype");
            font-weight: 700;
            font-style: normal;
        }

        @font-face {
            font-family: "Space Mono";
            src: url("font/SpaceMono-Regular.ttf") format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: "Typewrite Bold";
            src: url("font/Typewriter-Bold.ttf");
        }

        @font-face {
            font-family: "Typewrite Thin";
            src: url("font/Typewriter-Thin.ttf");
        }

        body {
            font-size: 0.75rem;
            font-family: "Inter", sans-serif;
            font-weight: 400;
            color: #000000;
            margin: 0 auto;
            position: relative;
        }

        #pspdfkit-header {
            font-size: 0.625rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 400;
            color: #717885;
            margin-top: 2.5rem;
            margin-bottom: 2.5rem;
            width: 100%;
        }

        .header-columns {
            display: flex;
            justify-content: space-between;
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }

        .logo {
            height: 1.5rem;
            width: auto;
            margin-right: 1rem;
        }

        .logotype {
            display: flex;
            align-items: center;
            font-weight: 700;
        }

        h2 {
            font-family: "Space Mono", monospace;
            font-size: 1.25rem;
            font-weight: 400;
        }

        h4 {
            font-family: "Space Mono", monospace;
            font-size: 1rem;
            font-weight: 400;
        }

        .page {
            margin-left: 5rem;
            margin-right: 5rem;
        }

        .intro-table {
            display: flex;
            justify-content: space-between;
            margin: 3rem 0 3rem 0;
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
        }

        .intro-form {
            display: flex;
            flex-direction: column;
            border-right: 1px solid #000000;
            width: 50%;
        }

        .intro-form:last-child {
            border-right: none;
        }

        .intro-table-title {
            font-size: 0.625rem;
            margin: 0;
        }

        .intro-form-item {
            padding: 1.25rem 1.5rem 1.25rem 1.5rem;
        }

        .intro-form-item:first-child {
            padding-left: 0;
        }

        .intro-form-item:last-child {
            padding-right: 0;
        }

        .intro-form-item-border {
            padding: 1.25rem 0 0.75rem 1.5rem;
            border-bottom: 1px solid #000000;
        }

        .intro-form-item-border:last-child {
            border-bottom: none;
        }

        .form {
            display: flex;
            flex-direction: column;
            margin-top: 6rem;
        }

        .no-border {
            border: none;
        }

        .border {
            border: 1px solid #000000;
        }

        .border-bottom {
            border: 1px solid #000000;
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .signer {
            display: flex;
            justify-content: space-between;
            gap: 2.5rem;
            margin: 2rem 0 2rem 0;
        }

        .signer-item {
            flex-grow: 1;
        }

        input {
            color: #4537de;
            font-family: "Space Mono", monospace;
            text-align: center;
            margin-top: 1.5rem;
            height: 4rem;
            width: 100%;
            box-sizing: border-box;
        }

        input#date,
        input#notes {
            text-align: left;
        }

        .signature {
            height: fit-content;
        }

        .intro-text {
            width: 60%;
        }

        .table-box table,
        .summary-box table {
            width: 100%;
            font-size: 0.625rem;
        }

        .table-box table {
            padding-top: 2rem;
        }

        .table-box td:first-child,
        .summary-box td:first-child {
            width: 5%;
        }

        .table-box td:last-child,
        .summary-box td:last-child {
            text-align: center;
            width: 10%;
        }

        .table-box table tr.heading td {
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
            height: 1.5rem;
        }

        .table-box table tr.item td,
        .summary-box table tr.item td {
            border-bottom: 1px solid #d7dce4;
            height: 1.5rem;
        }

        .summary-box table tr.no-border-item td {
            border-bottom: none;
            height: 1.5rem;
        }

        .summary-box table tr.total td {
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
            height: 1.5rem;
        }

        .summary-box table tr.item td:first-child,
        .summary-box table tr.total td:first-child {
            border: none;
            height: 1.5rem;
        }

        #pspdfkit-footer {
            font-size: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
            color: #717885;
            margin-top: 2.5rem;
            bottom: 2.5rem;
            position: absolute;
            width: 100%;
        }

        .footer-columns {
            display: flex;
            justify-content: space-between;
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }
    </style>

    <!-- style untuk koordinat -->
    <style>
        /* Container diperlukan untuk memosisikan tombol. Sesuaikan lebarnya sesuai dengan kebutuhan*/
        .containere {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        /* Buat gambar menjadi responsif */
        .containere img {
            width: 100%;
            height: auto;
        }

        /* Style tombol dan letakkan di tengah container / gambar */
        .containere .bton {
            position: absolute;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: #0000FF;
            color: white;
            font-size: 12px;
            /* padding: 12px 24px; */
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }
    </style>
    <!-- style untuk koordinat -->

    <!-- html2pdf CDN link -->
    <script src="html2pdf.bundle.min.js" referrerpolicy="no-referrer"></script>
</head>

<body>
    <?php

    // get checker
    $sql99 = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_serialnumber = '$serial'");
    $data99 = mysqli_fetch_array($sql99);
    ?>
    <div class="page" style="padding-top: 0px; margin-top: 0px;">
        <div class="intro-table" style="padding-top: 0px; margin-top: 10px; margin-bottom: 0px;">
            <div class="intro-form intro-form-item" style="padding: 10px;">
                <button onclick="history.back()" style="border: none; height: 30px; background-color: #5A6268; border-radius: 5px; color: #ffffff; font-weight: bold; cursor: pointer;">Back to List</button>
            </div>

            <div class="intro-form intro-form-item" style="padding: 10px;">
                <button id="download-button" style="border: none; height: 30px; background-color: #AA0A00; border-radius: 5px; color: #ffffff; font-weight: bold; cursor: pointer;">Download as PDF</button>
            </div>
        </div>
    </div>

    <div id="invoice">
        <!-- HALAMAN 1 -->
        <div id="pspdfkit-header">
            <div class="header-columns">
                <div class="logotype">
                    <img class="logo" src="image/logo_icon.png" />
                    <p>PT Yamaha Indonesia</p>
                </div>

                <div>
                    <p>[inside check]</p>
                </div>
            </div>
        </div>

        <div class="page" style="page-break-after: always">
            <div>
                <h2><?= $serial ?> #<?= $namepiano ?></h2>
            </div>

            <div class="table-box">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr class="heading">
                            <td>No</td>
                            <td style="width: 40%;">Item</td>
                            <td style="text-align: center; width: 40%;">Check</td>
                            <td>Repair</td>
                        </tr>

                        <?php
                        $no = 0;
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_item, c_status FROM formng_resulti WHERE c_serialnumber = '$serial' order by id limit 0,22");
                        while ($data = mysqli_fetch_array($sql)) {
                            $sql3 = mysqli_query($connect_pro, "SELECT c_item FROM formng_checkinside WHERE c_code = '$data[c_item]'");
                            $data3 = mysqli_fetch_array($sql3);
                            $no++;
                        ?>
                            <tr class="item">
                                <td><?= $no ?></td>
                                <td><?= $data3['c_item'] ?></td>
                                <td style="text-align: center;"><?php
                                                                if ($data['c_status'] == 'OK') {
                                                                    echo 'PASS';
                                                                } else {
                                                                    // echo 'NG';
                                                                    $sql4 = mysqli_query($connect_pro, "SELECT c_detail FROM formng_resulti WHERE c_serialnumber = '$serial' AND c_item = '$data[c_item]'");
                                                                    while ($data4 = mysqli_fetch_array($sql4)) {
                                                                        echo $data4['c_detail'] . "</br>";
                                                                    }
                                                                }
                                                                ?></td>
                                <td><?php
                                    // if ($data['c_status'] == 'NG') {
                                    //     if (!empty($data['c_repairdate'])) {
                                    //         echo 'OK';
                                    //     } else {
                                    //         echo 'NOT YET';
                                    //     }
                                    // } else {
                                    //     echo '-';
                                    // }
                                    $sql5 = mysqli_query($connect_pro, "SELECT c_repair FROM formng_resulti WHERE c_serialnumber = '$serial' AND c_item = '$data[c_item]'");
                                    $data5 = mysqli_fetch_array($sql5);
                                    if ($data5['c_repair'] != '') {
                                        $sql5 = mysqli_query($connect_pro, "SELECT c_repair FROM formng_resulti WHERE c_serialnumber = '$serial' AND c_item = '$data[c_item]'");
                                        $data5 = mysqli_fetch_array($sql5);
                                        echo $data5['c_repair'];
                                    } else {
                                        echo "-";
                                    }

                                    ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- HALAMAN 1 -->

        <!-- HALAMAN 2 -->
        <div id="pspdfkit-header">
            <div class="header-columns">
                <div class="logotype">
                    <img class="logo" src="image/logo_icon.png" />
                    <p>PT Yamaha Indonesia</p>
                </div>

                <div>
                    <p>[inside check]</p>
                </div>
            </div>
        </div>
        <div class="page" style="page-break-after: always">
            <div>
                <h2><?= $serial ?> #<?= $namepiano ?></h2>
            </div>

            <div class="table-box">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr class="heading">
                            <td>No</td>
                            <td style="width: 40%;">Item</td>
                            <td style="text-align: center; width: 40%;">Check</td>
                            <td>Repair</td>
                        </tr>

                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_item, c_status FROM formng_resulti WHERE c_serialnumber = '$serial' order by id limit 22,100");
                        while ($data = mysqli_fetch_array($sql)) {
                            $sql3 = mysqli_query($connect_pro, "SELECT c_item FROM formng_checkinside WHERE c_code = '$data[c_item]'");
                            $data3 = mysqli_fetch_array($sql3);
                            $no++;
                        ?>
                            <tr class="item">
                                <td><?= $no ?></td>
                                <td><?= $data3['c_item'] ?></td>
                                <td style="text-align: center;"><?php
                                                                if ($data['c_status'] == 'OK') {
                                                                    echo 'PASS';
                                                                } else {
                                                                    // echo 'NG';
                                                                    $sql4 = mysqli_query($connect_pro, "SELECT c_detail FROM formng_resulti WHERE c_serialnumber = '$serial' AND c_item = '$data[c_item]'");
                                                                    while ($data4 = mysqli_fetch_array($sql4)) {
                                                                        echo $data4['c_detail'] . "</br>";
                                                                    }
                                                                }
                                                                ?></td>
                                <td><?php
                                    // if ($data['c_status'] == 'NG') {
                                    //     if (!empty($data['c_repairdate'])) {
                                    //         echo 'OK';
                                    //     } else {
                                    //         echo 'NOT YET';
                                    //     }
                                    // } else {
                                    //     echo '-';
                                    // }
                                    $sql5 = mysqli_query($connect_pro, "SELECT c_repair FROM formng_resulti WHERE c_serialnumber = '$serial' AND c_item = '$data[c_item]'");
                                    $data5 = mysqli_fetch_array($sql5);
                                    if ($data5['c_repair'] != '') {
                                        $sql5 = mysqli_query($connect_pro, "SELECT c_repair FROM formng_resulti WHERE c_serialnumber = '$serial' AND c_item = '$data[c_item]'");
                                        $data5 = mysqli_fetch_array($sql5);
                                        echo $data5['c_repair'];
                                    } else {
                                        echo "-";
                                    }

                                    ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>



            <div class="signer">
                <div class="form signer-item" style="width: 40%;">

                    <label for="signature" class="label">Note:</label>
                    <br>
                    <div style="width: 100%; height: 80px; padding: 10px; " class="border signature">
                        <?php
                        $sqlnote = mysqli_query($connect_pro, "SELECT c_noteincheck FROM formng_register WHERE c_serialnumber = '$serial'");
                        $data_n = mysqli_fetch_array($sqlnote);
                        if (!empty($data_n['c_noteincheck'])) {
                        ?>
                            <pre style="font-size: smaller;"><?= $data_n['c_noteincheck'] ?></pre>
                        <?php
                        }
                        ?>
                    </div>
                </div>


                <div class="form signer-item">
                    <label for="signature" class="label"></label>
                    <br>
                    <div style="width: 100%; padding: 10px;" class=" signature">

                    </div>
                </div>




                <div class="form signer-item">

                    <label for="signature" class="label">Checked by:</label>
                    <br>
                    <div style="width: fit-content; padding: 10px;" class="border signature">
                        <table style="border-collapse: collapse; color: #FF130F; border: 2px solid #FF130F;">
                            <tr>
                                <td style="text-align: center; width: 200px; font-weight: bold; font-size: larger; font-family: 'Typewrite Bold'; border: 2px solid #FF130F;"><?= $data99['c_incheckby'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y', strtotime($data99['c_finishincheck'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


        </div>

        <!-- HALAMAN 2 -->

        <!-- HALAMAN 3 -->
        <div id="pspdfkit-header">
            <div class="header-columns">
                <div class="logotype">
                    <img class="logo" src="image/logo_icon.png" />
                    <p>PT Yamaha Indonesia</p>
                </div>

                <div>
                    <p>[completeness check]</p>
                </div>
            </div>
        </div>
        <div class="page" style="page-break-after: always">
            <div>
                <h2><?= $serial ?> #<?= $namepiano ?></h2>
            </div>

            <div class="table-box">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr class="heading">
                            <td>No</td>
                            <td>Item</td>
                            <td style="text-align: center; width: 10%;">Check 1</td>
                            <td style="text-align: center; width: 10%;">Repair</td>
                            <td style="text-align: center; width: 10%;">Check 2</td>
                            <td style="text-align: center; width: 10%;">Repair</td>
                            <td style="text-align: center; width: 10%;">Check 3</td>
                            <td>Repair</td>

                        </tr>

                        <?php
                        $no = 0;
                        $sql = mysqli_query($connect_pro, "SELECT c.c_partname, r.c_result1, r.c_repairdate1, r.c_result2, r.c_repairdate2, r.c_result3, r.c_repairdate3 FROM formng_resultc r JOIN formng_checkcomplete c ON r.c_code = c.c_code WHERE r.c_serialnumber = '$serial' limit 0,33");
                        while ($data = mysqli_fetch_array($sql)) {
                            $no++;
                        ?>
                            <tr class="item">
                                <td><?= $no ?></td>
                                <td><?= $data['c_partname'] ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($data['c_result1'] == 'OK') {
                                        echo 'PASS';
                                    } else {
                                        echo 'X';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if (!empty($data['c_repairdate1'])) {
                                        echo 'OK';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($data['c_result2'] == 'OK') {
                                        echo 'PASS';
                                    } else {
                                        echo 'X';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if (!empty($data['c_repairdate2'])) {
                                        echo 'OK';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($data['c_result3'] == 'OK') {
                                        echo 'PASS';
                                    } else {
                                        echo 'X';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if (!empty($data['c_repairdate3'])) {
                                        echo 'OK';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>


        </div>

        <!-- HALAMAN 3 -->

        <!-- HALAMAN 4 -->
        <div id="pspdfkit-header">
            <div class="header-columns">
                <div class="logotype">
                    <img class="logo" src="image/logo_icon.png" />
                    <p>PT Yamaha Indonesia</p>
                </div>

                <div>
                    <p>[completeness check]</p>
                </div>
            </div>
        </div>
        <div class="page" style="page-break-after: always">
            <div>
                <h2><?= $serial ?> #<?= $namepiano ?></h2>
            </div>

            <div class="table-box">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr class="heading">
                            <td>No</td>
                            <td>Item</td>
                            <td style="text-align: center; width: 10%;">Check 1</td>
                            <td style="text-align: center; width: 10%;">Repair</td>
                            <td style="text-align: center; width: 10%;">Check 2</td>
                            <td style="text-align: center; width: 10%;">Repair</td>
                            <td style="text-align: center; width: 10%;">Check 3</td>
                            <td>Repair</td>

                        </tr>

                        <?php
                        $no = 0;
                        $sql = mysqli_query($connect_pro, "SELECT c.c_partname, r.c_result1, r.c_repairdate1, r.c_result2, r.c_repairdate2, r.c_result3, r.c_repairdate3 FROM formng_resultc r JOIN formng_checkcomplete c ON r.c_code = c.c_code WHERE r.c_serialnumber = '$serial' limit 33,100");
                        while ($data = mysqli_fetch_array($sql)) {
                            $no++;
                        ?>
                            <tr class="item">
                                <td><?= $no ?></td>
                                <td><?= $data['c_partname'] ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($data['c_result1'] == 'OK') {
                                        echo 'PASS';
                                    } else {
                                        echo 'X';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if (!empty($data['c_repairdate1'])) {
                                        echo 'OK';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($data['c_result2'] == 'OK') {
                                        echo 'PASS';
                                    } else {
                                        echo 'X';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if (!empty($data['c_repairdate2'])) {
                                        echo 'OK';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($data['c_result3'] == 'OK') {
                                        echo 'PASS';
                                    } else {
                                        echo 'X';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if (!empty($data['c_repairdate3'])) {
                                        echo 'OK';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="signer">
                <div class="form signer-item">
                    <label for="signature" class="label">Checked 1 by:</label>
                    <br>
                    <div style="width: fit-content; padding: 10px;" class="border signature">
                        <table style="border-collapse: collapse; color: #FF130F; border: 2px solid #FF130F;">
                            <tr>
                                <td style="text-align: center; width: 200px; font-weight: bold; font-size: larger; font-family: 'Typewrite Bold'; border: 2px solid #FF130F;"><?= $data99['c_complete1by'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y', strtotime($data99['c_finishcomplete1'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form signer-item">
                    <label for="signature" class="label">Checked 2 by:</label>
                    <br>
                    <div style="width: fit-content; padding: 10px;" class="border signature">
                        <table style="border-collapse: collapse; color: #FF130F; border: 2px solid #FF130F;">
                            <tr>
                                <td style="text-align: center; width: 200px; font-weight: bold; font-size: larger; font-family: 'Typewrite Bold'; border: 2px solid #FF130F;"><?= $data99['c_complete2by'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y', strtotime($data99['c_finishcomplete2'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form signer-item">
                    <label for="signature" class="label">Checked 3 by:</label>
                    <br>
                    <div style="width: fit-content; padding: 10px;" class="border signature">
                        <table style="border-collapse: collapse; color: #FF130F; border: 2px solid #FF130F;">
                            <tr>
                                <td style="text-align: center; width: 200px; font-weight: bold; font-size: larger; font-family: 'Typewrite Bold'; border: 2px solid #FF130F;"><?= $data99['c_complete3by'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y', strtotime($data99['c_finishcomplete3'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


        </div>

        <!-- HALAMAN 4 -->

        <!-- HALAMAN 5 -->
        <div id="pspdfkit-header">
            <div class="header-columns">
                <div class="logotype">
                    <img class="logo" src="image/logo_icon.png" />
                    <p>PT Yamaha Indonesia</p>
                </div>

                <div>
                    <p>[outside check]</p>
                </div>
            </div>
        </div>
        <div class="page" style="page-break-after: always">
            <div>
                <h2><?= $serial ?> #<?= $namepiano ?></h2>
            </div>
            <div class="intro-table">
                <div class="intro-form intro-form-item">
                    <div class="containere">
                        <?php
                        if ($type == 'f') {
                        ?>
                            <img src="image/furniture/tbo.png" alt="top board outside">
                        <?php
                        } elseif ($type == 'p') {
                        ?>
                            <img src="image/reguler/tbo.jpg" alt="top board outside">
                        <?php
                        }
                        ?>


                        <?php
                        $section = '1 top board outside';
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_arealabel, c_areacode FROM formng_resulto1 WHERE c_serialnumber = '$serial' AND c_section = '$section'");
                        while ($data = mysqli_fetch_array($sql)) {
                            $sql1 = mysqli_query($connect_pro, "SELECT c_top, c_left FROM formng_basecoor WHERE c_btn_id = '$data[c_areacode]'");
                            $data1 = mysqli_fetch_array($sql1);
                            $top = $data1['c_top'];
                            $left = $data1['c_left'];
                        ?>
                            <button class="bton" style="width: 40px; height: 25px; opacity: 50%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #FF130F; " data-bs-toggle="modal" data-bs-target="#a1"><?= $data['c_arealabel'] ?></button>
                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="intro-form">
                    <div class="intro-form-item-border">
                        <p class="intro-table-title">Section 1:</p>
                        <p>Top Board Outside</p>
                    </div>
                    <div class="table-box">
                        <table cellpadding="0" cellspacing="0" style="padding-left: 5px; padding-right: 5px;">
                            <tbody>
                                <tr class="heading">
                                    <td style="width: 10%;">Area</td>
                                    <td>Cabinet</td>
                                    <td>NG Found</td>
                                    <td style="width: 10%;">Checker</td>
                                </tr>


                                <?php
                                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber  = '$serial' AND c_section = '$section' order by c_section");
                                $data = mysqli_fetch_array($sql);
                                if (!empty($data)) {

                                    $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber  = '$serial' AND c_section = '$section' order by c_section");
                                    while ($data = mysqli_fetch_array($sql)) {
                                        if (!empty($data['c_inspectiondate1'])) {
                                ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng1'] ?></td>
                                                <td><?= $data['c_checker1'] ?><br>(C1)</td>
                                            </tr>
                                        <?php
                                        }

                                        if (!empty($data['c_inspectiondate2'])) {
                                        ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng2'] ?></td>
                                                <td><?= $data['c_checker2'] ?><br>(C2)</td>
                                            </tr>
                                        <?php
                                        }

                                        if (!empty($data['c_inspectiondate3'])) {
                                        ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng3'] ?></td>
                                                <td><?= $data['c_checker3'] ?><br>(C3)</td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <tr class="item">
                                        <td colspan="4">No NG found in this section</td>
                                    </tr>
                                <?php
                                }


                                ?>
                                <tr class="item">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr class="item">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="intro-table">
                <div class="intro-form intro-form-item">
                    <div class="containere">
                        <?php
                        if ($type == 'f') {
                        ?>
                            <img src="image/furniture/tbi.png" alt="top board inside">
                        <?php
                        } elseif ($type == 'p') {
                        ?>
                            <img src="image/reguler/tbi.jpg" alt="top board inside">
                        <?php
                        }
                        ?>


                        <?php
                        $section = '2 top board inside';
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_arealabel, c_areacode FROM formng_resulto1 WHERE c_serialnumber = '$serial' AND c_section = '$section'");
                        while ($data = mysqli_fetch_array($sql)) {
                            $sql1 = mysqli_query($connect_pro, "SELECT c_top, c_left FROM formng_basecoor WHERE c_btn_id = '$data[c_areacode]'");
                            $data1 = mysqli_fetch_array($sql1);
                            $top = $data1['c_top'];
                            $left = $data1['c_left'];
                        ?>
                            <button class="bton" style="width: 40px; height: 25px; opacity: 50%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #FF130F; " data-bs-toggle="modal" data-bs-target="#a1"><?= $data['c_arealabel'] ?></button>
                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="intro-form">
                    <div class="intro-form-item-border">
                        <p class="intro-table-title">Section 2:</p>
                        <p>Top Board Inside</p>
                    </div>
                    <div class="table-box">
                        <table cellpadding="0" cellspacing="0" style="padding-left: 5px; padding-right: 5px;">
                            <tbody>
                                <tr class="heading">
                                    <td style="width: 10%;">Area</td>
                                    <td>Cabinet</td>
                                    <td>NG Found</td>
                                    <td style="width: 10%;">Checker</td>
                                </tr>

                                <?php
                                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber  = '$serial' AND c_section = '$section' order by c_section");
                                $data = mysqli_fetch_array($sql);
                                if (!empty($data)) {
                                    $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber  = '$serial' AND c_section = '$section' order by c_section");
                                    while ($data = mysqli_fetch_array($sql)) {
                                        if (!empty($data['c_inspectiondate1'])) {
                                ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng1'] ?></td>
                                                <td><?= $data['c_checker1'] ?><br>(C1)</td>
                                            </tr>
                                        <?php
                                        }

                                        if (!empty($data['c_inspectiondate2'])) {
                                        ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng2'] ?></td>
                                                <td><?= $data['c_checker2'] ?><br>(C2)</td>
                                            </tr>
                                        <?php
                                        }

                                        if (!empty($data['c_inspectiondate3'])) {
                                        ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng3'] ?></td>
                                                <td><?= $data['c_checker3'] ?><br>(C3)</td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <tr class="item">
                                        <td colspan="4">No NG found in this section</td>
                                    </tr>
                                <?php
                                }

                                ?>
                                <tr class="item">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr class="item">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- HALAMAN 5 -->

        <!-- HALAMAN 6 -->
        <div id="pspdfkit-header">
            <div class="header-columns">
                <div class="logotype">
                    <img class="logo" src="image/logo_icon.png" />
                    <p>PT Yamaha Indonesia</p>
                </div>

                <div>
                    <p>[outside check]</p>
                </div>
            </div>
        </div>
        <div class="page" style="page-break-after: always">
            <div>
                <h2><?= $serial ?> #<?= $namepiano ?></h2>
            </div>

            <div class="intro-table">
                <div class="intro-form intro-form-item">
                    <div class="containere">
                        <?php
                        if ($type == 'f') {
                        ?>
                            <img src="image/furniture/uk.png" alt="upper keyboard">
                        <?php
                        } elseif ($type == 'p') {
                        ?>
                            <img src="image/reguler/uk.jpg" alt="upper keyboard">
                        <?php
                        }
                        ?>


                        <?php
                        $section = '3 upper keyboard';
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_arealabel, c_areacode FROM formng_resulto1 WHERE c_serialnumber = '$serial' AND c_section = '$section'");
                        while ($data = mysqli_fetch_array($sql)) {
                            $sql1 = mysqli_query($connect_pro, "SELECT c_top, c_left FROM formng_basecoor WHERE c_btn_id = '$data[c_areacode]'");
                            $data1 = mysqli_fetch_array($sql1);
                            $top = $data1['c_top'];
                            $left = $data1['c_left'];
                        ?>
                            <button class="bton" style="width: 40px; height: 25px; opacity: 50%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #FF130F; " data-bs-toggle="modal" data-bs-target="#a1"><?= $data['c_arealabel'] ?></button>
                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="intro-form">
                    <div class="intro-form-item-border">
                        <p class="intro-table-title">Section 3:</p>
                        <p>Upper Keyboard</p>
                    </div>
                    <div class="table-box">
                        <table cellpadding="0" cellspacing="0" style="padding-left: 5px; padding-right: 5px;">
                            <tbody>
                                <tr class="heading">
                                    <td style="width: 10%;">Area</td>
                                    <td>Cabinet</td>
                                    <td>NG Found</td>
                                    <td style="width: 10%;">Checker</td>
                                </tr>

                                <?php
                                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber  = '$serial' AND c_section = '$section' order by c_section");
                                $data = mysqli_fetch_array($sql);
                                if (!empty($data)) {
                                    $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber  = '$serial' AND c_section = '$section' order by c_section");
                                    while ($data = mysqli_fetch_array($sql)) {
                                        if (!empty($data['c_inspectiondate1'])) {
                                ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng1'] ?></td>
                                                <td><?= $data['c_checker1'] ?><br>(C1)</td>
                                            </tr>
                                        <?php
                                        }

                                        if (!empty($data['c_inspectiondate2'])) {
                                        ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng2'] ?></td>
                                                <td><?= $data['c_checker2'] ?><br>(C2)</td>
                                            </tr>
                                        <?php
                                        }

                                        if (!empty($data['c_inspectiondate3'])) {
                                        ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng3'] ?></td>
                                                <td><?= $data['c_checker3'] ?><br>(C3)</td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <tr class="item">
                                        <td colspan="4">No NG found in this section</td>
                                    </tr>
                                <?php
                                }

                                ?>
                                <tr class="item">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr class="item">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="intro-table">
                <div class="intro-form intro-form-item">
                    <div class="containere">
                        <?php
                        if ($type == 'f') {
                        ?>
                            <img src="image/furniture/b.png" alt="body">
                        <?php
                        } elseif ($type == 'p') {
                        ?>
                            <img src="image/reguler/b.jpg" alt="body">
                        <?php
                        }
                        ?>


                        <?php
                        $section = '4 body';
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_arealabel, c_areacode FROM formng_resulto1 WHERE c_serialnumber = '$serial' AND c_section = '$section'");
                        while ($data = mysqli_fetch_array($sql)) {
                            $sql1 = mysqli_query($connect_pro, "SELECT c_top, c_left FROM formng_basecoor WHERE c_btn_id = '$data[c_areacode]'");
                            $data1 = mysqli_fetch_array($sql1);
                            $top = $data1['c_top'];
                            $left = $data1['c_left'];
                        ?>
                            <button class="bton" style="width: 40px; height: 25px; opacity: 50%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #FF130F; " data-bs-toggle="modal" data-bs-target="#a1"><?= $data['c_arealabel'] ?></button>
                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="intro-form">
                    <div class="intro-form-item-border">
                        <p class="intro-table-title">Section 4:</p>
                        <p>Body</p>
                    </div>
                    <div class="table-box">
                        <table cellpadding="0" cellspacing="0" style="padding-left: 5px; padding-right: 5px;">
                            <tbody>
                                <tr class="heading">
                                    <td style="width: 10%;">Area</td>
                                    <td>Cabinet</td>
                                    <td>NG Found</td>
                                    <td style="width: 10%;">Checker</td>
                                </tr>

                                <?php
                                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber  = '$serial' AND c_section = '$section' order by c_section");
                                $data = mysqli_fetch_array($sql);
                                if (!empty($data)) {
                                    $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber  = '$serial' AND c_section = '$section' order by c_section");
                                    while ($data = mysqli_fetch_array($sql)) {
                                        if (!empty($data['c_inspectiondate1'])) {
                                ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng1'] ?></td>
                                                <td><?= $data['c_checker1'] ?><br>(C1)</td>
                                            </tr>
                                        <?php
                                        }

                                        if (!empty($data['c_inspectiondate2'])) {
                                        ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng2'] ?></td>
                                                <td><?= $data['c_checker2'] ?><br>(C2)</td>
                                            </tr>
                                        <?php
                                        }

                                        if (!empty($data['c_inspectiondate3'])) {
                                        ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng3'] ?></td>
                                                <td><?= $data['c_checker3'] ?><br>(C3)</td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <tr class="item">
                                        <td colspan="4">No NG found in this section</td>
                                    </tr>
                                <?php
                                }

                                ?>
                                <tr class="item">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr class="item">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- HALAMAN 6 -->

        <!-- HALAMAN 7 -->
        <div id="pspdfkit-header">
            <div class="header-columns">
                <div class="logotype">
                    <img class="logo" src="image/logo_icon.png" />
                    <p>PT Yamaha Indonesia</p>
                </div>

                <div>
                    <p>[outside check]</p>
                </div>
            </div>
        </div>
        <div class="page" style="page-break-after: always">
            <div>
                <h2><?= $serial ?> #<?= $namepiano ?></h2>
            </div>

            <div class="intro-table">
                <div class="intro-form intro-form-item">
                    <div class="containere">
                        <?php
                        if ($type == 'f') {
                        ?>
                            <img src="image/furniture/bb.png" alt="body back">
                        <?php
                        } elseif ($type == 'p') {
                        ?>
                            <img src="image/reguler/bb.jpg" alt="body back">
                        <?php
                        }
                        ?>


                        <?php
                        $section = '5 body back';
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_arealabel, c_areacode FROM formng_resulto1 WHERE c_serialnumber = '$serial' AND c_section = '$section'");
                        while ($data = mysqli_fetch_array($sql)) {
                            $sql1 = mysqli_query($connect_pro, "SELECT c_top, c_left FROM formng_basecoor WHERE c_btn_id = '$data[c_areacode]'");
                            $data1 = mysqli_fetch_array($sql1);
                            $top = $data1['c_top'];
                            $left = $data1['c_left'];
                        ?>
                            <button class="bton" style="width: 40px; height: 25px; opacity: 50%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #FF130F; " data-bs-toggle="modal" data-bs-target="#a1"><?= $data['c_arealabel'] ?></button>
                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="intro-form">
                    <div class="intro-form-item-border">
                        <p class="intro-table-title">Section 5:</p>
                        <p>Body Back</p>
                    </div>
                    <div class="table-box">
                        <table cellpadding="0" cellspacing="0" style="padding-left: 5px; padding-right: 5px;">
                            <tbody>
                                <tr class="heading">
                                    <td style="width: 10%;">Area</td>
                                    <td>Cabinet</td>
                                    <td>NG Found</td>
                                    <td style="width: 10%;">Checker</td>
                                </tr>

                                <?php
                                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber  = '$serial' AND c_section = '$section' order by c_section");
                                $data = mysqli_fetch_array($sql);
                                if (!empty($data)) {
                                    $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber  = '$serial' AND c_section = '$section' order by c_section");
                                    while ($data = mysqli_fetch_array($sql)) {
                                        if (!empty($data['c_inspectiondate1'])) {
                                ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng1'] ?></td>
                                                <td><?= $data['c_checker1'] ?><br>(C1)</td>
                                            </tr>
                                        <?php
                                        }

                                        if (!empty($data['c_inspectiondate2'])) {
                                        ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng2'] ?></td>
                                                <td><?= $data['c_checker2'] ?><br>(C2)</td>
                                            </tr>
                                        <?php
                                        }

                                        if (!empty($data['c_inspectiondate3'])) {
                                        ?>
                                            <tr class="item">
                                                <td><?= $data['c_arealabel'] ?></td>
                                                <td><?= $data['c_cabinet'] ?></td>
                                                <td><?= $data['c_ng3'] ?></td>
                                                <td><?= $data['c_checker3'] ?><br>(C3)</td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <tr class="item">
                                        <td colspan="4">No NG found in this section</td>
                                    </tr>
                                <?php
                                }

                                ?>
                                <tr class="item">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr class="item">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>





            <div>
                <label for="signature" class="label">Note:</label>
                <br>
                <div style="width: 40%; height: 50px; padding: 10px;" class="border signature">
                    <ul>
                        <!-- <li>Ganti Fallboard - Approved by Fatma</li> -->
                        <?php
                        $sqlnote = mysqli_query($connect_pro, "SELECT c_outcheck1by, c_outcheck2by, c_outcheck3by, c_notecheck1, c_notecheck2, c_notecheck3 FROM formng_register WHERE c_serialnumber = '$serial'");
                        $data_n = mysqli_fetch_array($sqlnote);

                        if (!empty($data_n['c_notecheck1'])) {
                        ?>
                            <li><?= $data_n['c_notecheck1'] ?> - Approved by <?= $data_n['c_outcheck1by'] ?></li>
                        <?php
                        }

                        if (!empty($data_n['c_notecheck2'])) {
                        ?>
                            <li><?= $data_n['c_notecheck2'] ?> - Approved by <?= $data_n['c_outcheck2by'] ?></li>
                        <?php
                        }

                        if (!empty($data_n['c_notecheck3'])) {
                        ?>
                            <li><?= $data_n['c_notecheck3'] ?> - Approved by <?= $data_n['c_outcheck3by'] ?></li>
                        <?php
                        }

                        ?>
                    </ul>
                </div>
            </div>



























            <div class="signer">
                <div class="form signer-item">
                    <label for="signature" class="label">Checked 1 by:</label>
                    <br>
                    <div style="width: fit-content; padding: 10px;" class="border signature">
                        <table style="border-collapse: collapse; color: #FF130F; border: 2px solid #FF130F;">
                            <tr>
                                <td style="text-align: center; width: 200px; font-weight: bold; font-size: larger; font-family: 'Typewrite Bold'; border: 2px solid #FF130F;"><?= $data99['c_outcheck1by'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y', strtotime($data99['c_finishoutcheck1'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form signer-item">
                    <label for="signature" class="label">Checked 2 by:</label>
                    <br>
                    <div style="width: fit-content; padding: 10px;" class="border signature">
                        <table style="border-collapse: collapse; color: #FF130F; border: 2px solid #FF130F;">
                            <tr>
                                <td style="text-align: center; width: 200px; font-weight: bold; font-size: larger; font-family: 'Typewrite Bold'; border: 2px solid #FF130F;"><?= $data99['c_outcheck2by'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y', strtotime($data99['c_finishoutcheck2'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form signer-item">
                    <label for="signature" class="label">Checked 3 by:</label>
                    <br>
                    <div style="width: fit-content; padding: 10px;" class="border signature">
                        <table style="border-collapse: collapse; color: #FF130F; border: 2px solid #FF130F;">
                            <tr>
                                <td style="text-align: center; width: 200px; font-weight: bold; font-size: larger; font-family: 'Typewrite Bold'; border: 2px solid #FF130F;"><?= $data99['c_outcheck3by'] ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y', strtotime($data99['c_finishoutcheck3'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- HALAMAN 7 -->

    </div>

    <script>
        const button = document.getElementById("download-button");

        function generatePDF() {
            // Choose the element that your content will be rendered to.
            const element = document.getElementById("invoice");
            // Choose the element and save the PDF for your user.
            html2pdf().from(element).save("<?= $serial ?>.pdf");
        }

        button.addEventListener("click", generatePDF);
    </script>
</body>

</html>