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

        .containere .ingpo {
            position: absolute;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: transparent;
            opacity: 100%;
            padding: 0px;
            font-size: 8px;
            font-weight: bold;
            border: solid 1px;
            border-radius: 5px;
            border-color: #DC3545;
            cursor: pointer;
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
                <div class="intro-form">
                    <div class="table-box">
                        <table cellpadding="0" cellspacing="0" style="padding-left: 5px; padding-right: 5px;">
                            <tbody>
                                <tr class="heading" style="font-weight: bold;">
                                    <td style="width: 10%; text-align: left;">No</td>
                                    <td style="width: 70%; text-align: left;">NG</td>
                                    <td style="width: 30%; text-align: center;">Repaired</td>
                                </tr>
                                <?php
                                $sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial'");
                                $data = mysqli_fetch_array($sql);
                                if (empty($data)) {
                                    // kosong
                                ?>
                                    <tr class="item">
                                        <td colspan="3">No NG Found</td>
                                    </tr>
                                    <?php
                                } else {
                                    // tidak kosong
                                    $sql = mysqli_query($connect_pro, "SELECT DISTINCT  c_numberng, c_ng FROM formng_resultong WHERE c_serialnumber = '$serial' ORDER BY c_numberng ASC");
                                    while ($data = mysqli_fetch_array($sql)) {
                                        // list cabinet aktif
                                        $cab_active = array();
                                        $nolist = 0;
                                        $active_sql = mysqli_query($connect_pro, "SELECT c_cabinet, c_repaired, c_process FROM formng_resultong WHERE c_serialnumber = '$serial' AND c_numberng = $data[c_numberng]");
                                        while ($active_data = mysqli_fetch_array($active_sql)) {
                                            $cab_active[] = array($active_data['c_cabinet'], $active_data['c_repaired'], $active_data['c_process']);
                                            $nolist++;
                                        }
                                        $count_cabactive = count($cab_active);

                                        // warna pena untuk nama ng
                                        $merah_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial' AND c_numberng = '$data[c_numberng]' AND c_process = 'oc1'");
                                        $merah_data = mysqli_fetch_array($merah_sql);
                                        if (!empty($merah_data)) {
                                            $warna_pen = '#DC4646';
                                        } else {
                                            $hijau_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial' AND c_numberng = '$data[c_numberng]' AND c_process = 'oc2'");
                                            $hijau_data = mysqli_fetch_array($hijau_sql);
                                            if (!empty($hijau_data)) {
                                                $warna_pen = '#5AA65A';
                                            } else {
                                                $biru_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial' AND c_numberng = '$data[c_numberng]' AND c_process = 'oc3'");
                                                $biru_data = mysqli_fetch_array($biru_sql);
                                                if (!empty($biru_data)) {
                                                    $warna_pen = '#1340FF';
                                                } else {
                                                    $warna_pen = '#000000';
                                                }
                                            }
                                        }
                                    ?>
                                        <tr class="item">
                                            <td style="width: 10%; text-align: left;"><?= $data['c_numberng'] ?></td>
                                            <td style="width: 70%; text-align: left; color: <?= $warna_pen ?>;"><?= $data['c_ng'] ?></td>
                                            <td><?= $cab_active[0][1] ?></td>
                                        </tr>
                                        <?php
                                        // for ($a = 0; $a < $count_cabactive; $a++) {
                                        //     // warna pena untuk nama cabinet
                                        //     $c_cabinet = $cab_active[$a][0];
                                        //     $c_process = $cab_active[$a][2];
                                        //     $c_repaired = $cab_active[$a][1];
                                        //     if ($c_process == 'oc1') {
                                        //         $warna_pen = '#DC4646';
                                        //     } elseif ($c_process == 'oc2') {
                                        //         $warna_pen = '#5AA65A';
                                        //     } elseif ($c_process == 'oc3') {
                                        //         $warna_pen = '#1340FF';
                                        //     } else {
                                        //         $warna_pen = '#000000';
                                        //     }
                                        ?>
                                        <!-- <tr class="item">
                                                <td></td>
                                                <td style="text-align: left; color: <?= $warna_pen ?>;"><?= $c_cabinet ?></td>
                                                <td style="text-align: center;"><?= $c_repaired ?></td>
                                            </tr> -->
                                        <?php
                                        // }
                                        ?>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="intro-form intro-form-item" style="margin-left: 10%;">
                    <div class="containere" style="margin-bottom: 30px;">
                        <?php
                        if ($type == 'f') {
                            $c_section = 'ftbo';
                        ?>
                            <img src="image/furniture/tbo.png" alt="top board outside" style="opacity: 60%;">
                        <?php
                        } elseif ($type == 'p') {
                            $c_section = 'ptbo';
                        ?>
                            <img src="image/reguler/tbo.jpg" alt="top board outside" style="opacity: 60%;">
                        <?php
                        }

                        $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial';");
                        while ($data = mysqli_fetch_array($sql)) {
                            $isi = array();
                            $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial' AND c_code = '$data[c_code]'");
                            while ($data1 = mysqli_fetch_array($sql1)) {
                                $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                            }
                            $countisi = count($isi);
                        ?>
                            <button class="ingpo" style="width: 20px; height: 20px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
                                <?php
                                for ($f = 0; $f < $countisi; $f++) {
                                    if ($isi[$f][1] == 'oc1') {
                                        $pen = '#DC4646';
                                    } elseif ($isi[$f][1] == 'oc2') {
                                        $pen = '#5AA65A';
                                    } elseif ($isi[$f][1] == 'oc3') {
                                        $pen = '#1340FF';
                                    }
                                    if ($f == 0) {
                                ?>
                                        <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                    <?php
                                    } elseif (($f % 2) == 0) {
                                    ?>
                                        <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                    <?php
                                    } else {
                                    ?>
                                        , <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span><br>
                                <?php
                                    }
                                }
                                ?>
                            </button>
                        <?php
                        }
                        ?>

                    </div>
                    <div class="containere" style="margin-bottom: 30px;">
                        <?php
                        if ($type == 'f') {
                            $c_section = 'ftbi';
                        ?>
                            <img src="image/furniture/tbi.png" alt="top board inside" style="opacity: 60%;">
                        <?php
                        } elseif ($type == 'p') {
                            $c_section = 'ptbi';
                        ?>
                            <img src="image/reguler/tbi.jpg" alt="top board inside" style="opacity: 60%;">
                        <?php
                        }
                        $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial';");
                        while ($data = mysqli_fetch_array($sql)) {
                            $isi = array();
                            $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial' AND c_code = '$data[c_code]'");
                            while ($data1 = mysqli_fetch_array($sql1)) {
                                $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                            }
                            $countisi = count($isi);
                        ?>
                            <button class="ingpo" style="width: 20px; height: 20px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
                                <?php
                                for ($f = 0; $f < $countisi; $f++) {
                                    if ($isi[$f][1] == 'oc1') {
                                        $pen = '#DC4646';
                                    } elseif ($isi[$f][1] == 'oc2') {
                                        $pen = '#5AA65A';
                                    } elseif ($isi[$f][1] == 'oc3') {
                                        $pen = '#1340FF';
                                    }
                                    if ($f == 0) {
                                ?>
                                        <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                    <?php
                                    } elseif (($f % 2) == 0) {
                                    ?>
                                        <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                    <?php
                                    } else {
                                    ?>
                                        , <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span><br>
                                <?php
                                    }
                                }
                                ?>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="containere" style="margin-bottom: 30px;">
                        <?php
                        if ($type == 'f') {
                            $c_section = 'fuk';
                        ?>
                            <img src="image/furniture/uk.png" alt="upper keyboard" style="opacity: 60%;">
                        <?php
                        } elseif ($type == 'p') {
                            $c_section = 'puk';
                        ?>
                            <img src="image/reguler/uk.jpg" alt="upper keyboard" style="opacity: 60%;">
                        <?php
                        }
                        $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial';");
                        while ($data = mysqli_fetch_array($sql)) {
                            $isi = array();
                            $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial' AND c_code = '$data[c_code]'");
                            while ($data1 = mysqli_fetch_array($sql1)) {
                                $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                            }
                            $countisi = count($isi);
                        ?>
                            <button class="ingpo" style="width: 20px; height: 20px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
                                <?php
                                for ($f = 0; $f < $countisi; $f++) {
                                    if ($isi[$f][1] == 'oc1') {
                                        $pen = '#DC4646';
                                    } elseif ($isi[$f][1] == 'oc2') {
                                        $pen = '#5AA65A';
                                    } elseif ($isi[$f][1] == 'oc3') {
                                        $pen = '#1340FF';
                                    }
                                    if ($f == 0) {
                                ?>
                                        <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                    <?php
                                    } elseif (($f % 2) == 0) {
                                    ?>
                                        <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                    <?php
                                    } else {
                                    ?>
                                        , <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span><br>
                                <?php
                                    }
                                }
                                ?>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="containere" style="margin-bottom: 30px;">
                        <?php
                        if ($type == 'f') {
                            $c_section = 'fb';
                        ?>
                            <img src="image/furniture/b.png" alt="body" style="opacity: 60%;">
                        <?php
                        } elseif ($type == 'p') {
                            $c_section = 'pb';
                        ?>
                            <img src="image/reguler/b.jpg" alt="body" style="opacity: 60%;">
                        <?php
                        }
                        $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial';");
                        while ($data = mysqli_fetch_array($sql)) {
                            $isi = array();
                            $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial' AND c_code = '$data[c_code]'");
                            while ($data1 = mysqli_fetch_array($sql1)) {
                                $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                            }
                            $countisi = count($isi);
                        ?>
                            <button class="ingpo" style="width: 20px; height: 20px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
                                <?php
                                for ($f = 0; $f < $countisi; $f++) {
                                    if ($isi[$f][1] == 'oc1') {
                                        $pen = '#DC4646';
                                    } elseif ($isi[$f][1] == 'oc2') {
                                        $pen = '#5AA65A';
                                    } elseif ($isi[$f][1] == 'oc3') {
                                        $pen = '#1340FF';
                                    }
                                    if ($f == 0) {
                                ?>
                                        <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                    <?php
                                    } elseif (($f % 2) == 0) {
                                    ?>
                                        <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                    <?php
                                    } else {
                                    ?>
                                        , <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span><br>
                                <?php
                                    }
                                }
                                ?>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="containere" style="margin-bottom: 30px;">
                        <?php
                        if ($type == 'f') {
                            $c_section = 'fbb';
                        ?>
                            <img src="image/furniture/bb.png" alt="back body" style="opacity: 60%;">
                        <?php
                        } elseif ($type == 'p') {
                            $c_section = 'pbb';
                        ?>
                            <img src="image/reguler/bb.jpg" alt="back body" style="opacity: 60%;">
                        <?php
                        }
                        $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial';");
                        while ($data = mysqli_fetch_array($sql)) {
                            $isi = array();
                            $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial' AND c_code = '$data[c_code]'");
                            while ($data1 = mysqli_fetch_array($sql1)) {
                                $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                            }
                            $countisi = count($isi);
                        ?>
                            <button class="ingpo" style="width: 20px; height: 20px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
                                <?php
                                for ($f = 0; $f < $countisi; $f++) {
                                    if ($isi[$f][1] == 'oc1') {
                                        $pen = '#DC4646';
                                    } elseif ($isi[$f][1] == 'oc2') {
                                        $pen = '#5AA65A';
                                    } elseif ($isi[$f][1] == 'oc3') {
                                        $pen = '#1340FF';
                                    }
                                    if ($f == 0) {
                                ?>
                                        <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                    <?php
                                    } elseif (($f % 2) == 0) {
                                    ?>
                                        <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                    <?php
                                    } else {
                                    ?>
                                        , <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span><br>
                                <?php
                                    }
                                }
                                ?>
                            </button>
                        <?php
                        }
                        ?>
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

            <?php
            $sql_cfs = mysqli_query($connect_pro, "SELECT id, c_ng, c_ok, c_checker, c_note FROM formng_cfs WHERE c_serialnumber = '$serial'");
            $data_cfs = mysqli_fetch_array($sql_cfs);

            if (!empty($data_cfs['id'])) {
            ?>
                <div>
                    <br>
                    <label for="signature" class="label">Check Fungsi Silent:</label>
                    <br>
                    <table style="border-collapse: collapse; border: 1px solid #000000; width: 400px;">
                        <tr>
                            <td style="text-align: center; padding: 10px; width: 50%; border: 1px solid #000000;">
                                <?php
                                if (!empty($data_cfs['c_ng'])) {
                                ?>
                                    <table style="border-collapse: collapse; color: #FF130F; border: 2px solid #FF130F;">
                                        <tr>
                                            <td style="text-align: center; width: 200px; font-weight: bold; font-size: larger; font-family: 'Typewrite Bold'; border: 2px solid #FF130F;"><?= $data_cfs['c_checker'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y H:i:s', strtotime($data_cfs['c_ng'])) ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                            </td>
                            <td style="text-align: center; padding: 10px; width: 50%; font-family: 'Typewrite Bold'; border: 1px solid #000000;">
                                <?php
                                if (!empty($data_cfs['c_ok'])) {
                                ?>
                                    <table style="border-collapse: collapse; color: #FF130F; border: 2px solid #FF130F;">
                                        <tr>
                                            <td style="text-align: center; width: 200px; font-weight: bold; font-size: larger; font-family: 'Typewrite Bold'; border: 2px solid #FF130F;"><?= $data_cfs['c_checker'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y H:i:s', strtotime($data_cfs['c_ok'])) ?></td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-family: 'Typewrite Thin'; border: 1px solid #000000;">NG</td>
                            <td style="text-align: center; font-family: 'Typewrite Thin'; border: 1px solid #000000;">OK</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 10px;">
                                Note : <br>
                                <p><?= $data_cfs['c_note'] ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php
            }
            ?>






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
                                <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y H:i:s', strtotime($data99['c_finishoutcheck1'])) ?></td>
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
                                <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y H:i:s', strtotime($data99['c_finishoutcheck2'])) ?></td>
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
                                <td style="text-align: center; font-family: 'Typewrite Thin'; border: 2px solid #FF130F;"><?= date('d-m-Y H:i:s', strtotime($data99['c_finishoutcheck3'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- HALAMAN 6 -->

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