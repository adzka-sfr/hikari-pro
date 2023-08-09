<?php
require "../../../config.php";
$serialnumber = $_POST['serialnumber'];

// get informasi piano
$q0 = mysqli_query($connect_pro, "SELECT b.c_name, b.c_code_type FROM finalcheck_register a INNER JOIN finalcheck_list_piano b ON a.c_gmc = b.c_gmc WHERE a.c_serialnumber = '$serialnumber'");
$d0 = mysqli_fetch_array($q0);
$pianoname = $d0['c_name'];
$type = $d0['c_code_type'];
?>

<style>
    @font-face {
        font-family: "Isi";
        src: url("management/l_export/export-content/font/Inter-Regular.ttf") format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    @font-face {
        font-family: "Judul";
        src: url("management/l_export/export-content/font/SpaceMono-Regular.ttf") format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    @font-face {
        font-family: "Instansi";
        src: url("management/l_export/export-content/font/Inter-Bold.ttf") format("truetype");
        font-weight: 500;
        font-style: normal;
    }

    @font-face {
        font-family: "Section";
        src: url("management/l_export/export-content/font/Inter-Regular.ttf") format("truetype");
        font-weight: lighter;
        font-style: normal;
    }

    /*
    @font-face {
        font-family: "Section";
        src: url("management/l_export/export-content/font/Typewriter-Thin.ttf") format("truetype");
    }

    @font-face {
        font-family: "Inter";
        src: url("font/Inter-Bold.ttf") format("truetype");
        font-weight: 700;
        font-style: normal;
    }

    @font-face {
        font-family: "Typewrite Bold";
        src: url("font/Typewriter-Bold.ttf");
    }
     */

    /* body {
        font-size: 0.75rem;
        font-family: "Inter", sans-serif;
        font-weight: 400;
        color: #000000;
        margin: 0 auto;
        position: relative;
    } */

    /* padding untuk judul */
    .pagercik {
        padding-left: 1rem;
        padding-right: 1rem;
        margin-top: 20px;
    }

    /* padding untuk content */
    .pagercok {
        padding-left: 5rem;
        padding-right: 5rem;
    }

    /* instansi font */
    .instansi-text {
        font-size: 12px;
        font-family: Instansi;
        letter-spacing: 2px;
        color: #000000;
    }

    .section-text {
        font-family: Section;
        font-size: 12px;
        letter-spacing: 2px;
        color: #000000;
    }

    .judul-text {
        font-family: Judul;
        padding-top: 0px;
        padding-bottom: 0px;
        color: #000000;
    }

    .halaman-text {
        font-family: Section;
        font-size: 12px;
        color: #000000;
    }

    .table-contentne {
        font-family: Isi;
        font-size: 0.625rem;
    }

    .td-isi {
        padding-top: 2px;
        padding-bottom: 2px;
    }

    .border-txt {
        border-style: solid;
        border-color: #000000;
        border-width: thin;
        width: 100%;
        font-size: 12px;
        height: 100px;
        padding-left: 3px;
    }

    .border-sign {
        border-style: solid;
        border-color: #000000;
        border-width: thin;
        width: 100%;
        font-size: 12px;
        height: 70px;
        padding-left: 3px;
        margin-bottom: 0px;
    }

    .border-date {
        border-style: solid;
        border-color: #000000;
        border-width: thin;
        width: 100%;
        font-size: 12px;
        padding-left: 3px;
        border-top: #ffffff;
        margin-top: 0px;
    }

    /* tombol download */
    .pdfbtn {
        border: none;
        width: 100%;
        height: 30px;
        background-color: #AA0A00;
        border-radius: 5px;
        color: #ffffff;
        font-weight: bold;
        cursor: pointer;
    }

    .pdfbtn:hover {
        background-color: #8E0C00;
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
<script src="management/l_export/export-content/html2pdf.bundle.min.js" referrerpolicy="no-referrer"></script>

<div class="row">
    <div class="col-12">
        <button id="download-button" class="pdfbtn">Download as PDF <i class="fa fa-file-pdf-o"></i></button>
    </div>
</div>

<div id="invoice">
    <!-- Halaman inside 1/2 start -->
    <div class="row pagercik">
        <div class="col-6">
            <img height="20px" src="management/l_export/export-content/image/logo_icon.png" alt="logo YI"> <span class="instansi-text">PT YAMAHA INDONESIA</span>
        </div>
        <div class="col-6" style="text-align: right;">
            <span class="section-text">[INSIDE CHECK]</span><span class="halaman-text">(1/2)</span>
        </div>
    </div>
    <div class="row" style="page-break-after: always;">
        <div class="col-12 pagercok">
            <h2 class="judul-text"><?= $serialnumber ?> #<?= $pianoname ?></h2>
            <table class="table table-contentne">
                <thead>
                    <th style="text-align: center; width: 5%;">No</th>
                    <th style="width: 45%;">Item</th>
                    <th style="width: 30%;">Check</th>
                    <th style="width: 15%; text-align: center;">Repair</th>
                </thead>
                <tbody>
                    <?php
                    $a = 0;
                    $q1 = mysqli_query($connect_pro, "SELECT b.c_detail, a.c_code_ng FROM finalcheck_inside a INNER JOIN finalcheck_list_incheck b ON a.c_code_incheck = b.c_code_incheck WHERE a.c_serialnumber = '$serialnumber' ORDER BY b.c_seq LIMIT 0,26");
                    while ($d1 = mysqli_fetch_array($q1)) {
                        $a++;

                        // set pass or get the name of NG
                        if ($d1['c_code_ng'] != '') {
                            $listng = explode("/", $d1['c_code_ng']);
                            $res = array();
                            foreach ($listng as $value) {
                                $q2 = mysqli_query($connect_pro, "SELECT c_name FROM finalcheck_list_ng WHERE c_code_ng = '$value'");
                                $d2 = mysqli_fetch_array($q2);
                                array_push($res, $d2['c_name']);
                            }
                            $res_incheck = implode("<br>", $res);

                            if ($d1['c_code_ng'] == 'ng145' or $d1['c_code_ng'] == 'ng146' or $d1['c_code_ng'] == '147') {
                                $pic_repair = '-';
                            } else {
                                // nitip get nama tukang repair
                                $q3 = mysqli_query($connect_pro, "SELECT c_inside_pic FROM finalcheck_repairtime WHERE c_serialnumber  ='$serialnumber'");
                                $d3 = mysqli_fetch_array($q3);

                                $pic_repair = $d3['c_inside_pic'];
                            }
                        } else {
                            $res_incheck = "PASS";
                            $pic_repair = "-";
                        }
                    ?>
                        <tr>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $a ?></td>
                            <td style="padding-top: 2px; padding-bottom: 2px;"><?= $d1['c_detail'] ?></td>
                            <td style="padding-top: 2px; padding-bottom: 2px;"><?= $res_incheck ?></td>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $pic_repair ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Halaman inside 1/2 end -->

    <!-- Halaman inside 2/2 start -->
    <div class="row pagercik">
        <div class="col-6">
            <img height="20px" src="management/l_export/export-content/image/logo_icon.png" alt="logo YI"> <span class="instansi-text">PT YAMAHA INDONESIA</span>
        </div>
        <div class="col-6" style="text-align: right;">
            <span class="section-text">[INSIDE CHECK]</span><span class="halaman-text">(2/2)</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 pagercok">
            <h2 class="judul-text"><?= $serialnumber ?> #<?= $pianoname ?></h2>
            <table class="table table-contentne">
                <thead>
                    <th style="text-align: center; width: 5%;">No</th>
                    <th style="width: 45%;">Item</th>
                    <th style="width: 30%;">Check</th>
                    <th style="width: 15%; text-align: center;">Repair</th>
                </thead>
                <tbody>
                    <?php
                    $q1 = mysqli_query($connect_pro, "SELECT b.c_detail, a.c_code_ng FROM finalcheck_inside a INNER JOIN finalcheck_list_incheck b ON a.c_code_incheck = b.c_code_incheck WHERE a.c_serialnumber = '$serialnumber' ORDER BY b.c_seq LIMIT 26,1000");
                    while ($d1 = mysqli_fetch_array($q1)) {
                        $a++;

                        // set pass or get the name of NG
                        if ($d1['c_code_ng'] != '') {
                            $listng = explode("/", $d1['c_code_ng']);
                            $res = array();
                            foreach ($listng as $value) {
                                $q2 = mysqli_query($connect_pro, "SELECT c_name FROM finalcheck_list_ng WHERE c_code_ng = '$value'");
                                $d2 = mysqli_fetch_array($q2);
                                array_push($res, $d2['c_name']);
                            }
                            $res_incheck = implode("<br>", $res);

                            if ($d1['c_code_ng'] == 'ng145' or $d1['c_code_ng'] == 'ng146' or $d1['c_code_ng'] == '147') {
                                $pic_repair = '-';
                            } else {
                                // nitip get nama tukang repair
                                $q3 = mysqli_query($connect_pro, "SELECT c_inside_pic FROM finalcheck_repairtime WHERE c_serialnumber  ='$serialnumber'");
                                $d3 = mysqli_fetch_array($q3);

                                $pic_repair = $d3['c_inside_pic'];
                            }
                        } else {
                            $res_incheck = "PASS";
                            $pic_repair = "-";
                        }
                    ?>
                        <tr>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $a ?></td>
                            <td style="padding-top: 2px; padding-bottom: 2px;"><?= $d1['c_detail'] ?></td>
                            <td style="padding-top: 2px; padding-bottom: 2px;"><?= $res_incheck ?></td>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $pic_repair ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" style="page-break-after: always;">
        <div class="col-6 pagercok">
            <span style="color: #000000;">Note:</span>
            <div class="border-txt" style="font-size: 0.625rem; color: #000000;">
                <?php
                $qn1 = mysqli_query($connect_pro, "SELECT c_inside FROM finalcheck_note WHERE c_serialnumber = '$serialnumber'");
                $dn1 = mysqli_fetch_array($qn1);
                if ($dn1['c_inside'] != '') {
                    echo $dn1['c_inside'];
                }
                ?>
            </div>
        </div>
        <div class="col-6 pagercok">
            <span style="color: #000000;">Checked:</span>
            <?php
            $q4 = mysqli_query($connect_pro, "SELECT a.c_inside, b.c_repair_inside_o FROM finalcheck_pic a INNER JOIN finalcheck_repairtime b ON a.c_serialnumber = b.c_serialnumber WHERE a.c_serialnumber = '$serialnumber'");
            $d4 = mysqli_fetch_array($q4);
            $inside_pic = $d4['c_inside'];
            $tanggal_kirim = date('d-m-Y H:i A', strtotime($d4['c_repair_inside_o']));
            ?>
            <div class="border-sign" style="text-align: center; padding-top: 10px;"><span class="stamp checkcard"><?= $inside_pic ?></span></div>
            <div class="border-date"><span style="font-size: 0.625rem; color: #000000;">Date : <?= $tanggal_kirim ?></span></div>
        </div>
    </div>
    <!-- Halaman inside 2/2 end -->

    <!-- Halaman completeness 1/1 start -->
    <div class="row pagercik">
        <div class="col-6">
            <img height="20px" src="management/l_export/export-content/image/logo_icon.png" alt="logo YI"> <span class="instansi-text">PT YAMAHA INDONESIA</span>
        </div>
        <div class="col-6" style="text-align: right;">
            <span class="section-text">[COMPLETENESS]</span><span class="halaman-text">(1/1)</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 pagercok">
            <h2 class="judul-text"><?= $serialnumber ?> #<?= $pianoname ?></h2>
            <table class="table table-contentne">
                <thead>
                    <th style="text-align: center; width: 5%;">No</th>
                    <th style="width: 35%;">Item</th>
                    <th style="width: 10%; text-align: center;">Check 1</th>
                    <th style="width: 10%; text-align: center;">Repair</th>
                    <th style="width: 10%; text-align: center;">Check 2</th>
                    <th style="width: 10%; text-align: center;">Repair</th>
                    <th style="width: 10%; text-align: center;">Check 3</th>
                    <th style="width: 10%; text-align: center;">Repair</th>
                </thead>
                <tbody>
                    <?php
                    $a = 0;
                    $q1 = mysqli_query($connect_pro, "SELECT b.c_detail, a.c_resultsatu, a.c_resultdua, a.c_resulttiga, a.c_repairsatu, a.c_repairdua, a.c_repairtiga FROM finalcheck_completeness a INNER JOIN finalcheck_list_completeness b ON a.c_code_completeness = b.c_code_completeness WHERE a.c_serialnumber = '$serialnumber'");
                    while ($d1 = mysqli_fetch_array($q1)) {
                        $a++;

                        if ($d1['c_resultsatu'] == 'Y') {
                            $res1 = 'PASS';
                        } else {
                            $res1 = 'NG';
                        }

                        if ($d1['c_resultdua'] == 'Y') {
                            $res2 = 'PASS';
                        } else {
                            $res2 = 'NG';
                        }

                        if ($d1['c_resulttiga'] == 'Y') {
                            $res3 = 'PASS';
                        } else {
                            $res3 = 'NG';
                        }

                        if ($d1['c_repairsatu'] != '') {
                            $qn2a = mysqli_query($connect_pro, "SELECT c_outsidesatu_pic FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber'");
                            $dn2a = mysqli_fetch_array($qn2a);
                            if ($dn2a['c_outsidesatu_pic'] != '') {
                                $repair1 = $dn2a['c_outsidesatu_pic'];
                            } else {
                                $repair1 = '-';
                            }
                        } else {
                            $repair1 = '-';
                        }

                        if ($d1['c_repairdua'] != '') {
                            $qn2b = mysqli_query($connect_pro, "SELECT c_outsidedua_pic FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber'");
                            $dn2b = mysqli_fetch_array($qn2b);
                            if ($dn2a['c_outsidedua_pic'] != '') {
                                $repair2 = $dn2a['c_outsidedua_pic'];
                            } else {
                                $repair2 = '-';
                            }
                        } else {
                            $repair2 = '-';
                        }

                        if ($d1['c_repairtiga'] != '') {
                            $qn2c = mysqli_query($connect_pro, "SELECT c_outsidetiga_pic FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber'");
                            $dn2c = mysqli_fetch_array($qn2c);
                            if ($dn2a['c_outsidetiga_pic'] != '') {
                                $repair3 = $dn2a['c_outsidetiga_pic'];
                            } else {
                                $repair3 = '-';
                            }
                        } else {
                            $repair3 = '-';
                        }

                    ?>
                        <tr>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $a ?></td>
                            <td style="padding-top: 2px; padding-bottom: 2px;"><?= $d1['c_detail'] ?></td>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $res1 ?></td>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $repair1 ?></td>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $res2 ?></td>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $repair2 ?></td>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $res3 ?></td>
                            <td style="text-align: center; padding-top: 2px; padding-bottom: 2px;"><?= $repair3 ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <?php
        $qn2 = mysqli_query($connect_pro, "SELECT c_completenesssatu, c_completenessdua, c_completenesstiga FROM finalcheck_note WHERE c_serialnumber = '$serialnumber'");
        $dn2 = mysqli_fetch_array($qn2);

        if ($dn2['c_completenesssatu'] != '') {
            $completeness_note1 = $dn2['c_completenesssatu'];
        } else {
            $completeness_note1 = '';
        }

        if ($dn2['c_completenessdua'] != '') {
            $completeness_note2 = $dn2['c_completenessdua'];
        } else {
            $completeness_note2 = '';
        }

        if ($dn2['c_completenesstiga'] != '') {
            $completeness_note3 = $dn2['c_completenesstiga'];
        } else {
            $completeness_note3 = '';
        }
        ?>
        <div class="col-12 pagercok">
            <div class="row">
                <div class="col-4">
                    <span style="color: #000000;">Note 1:</span>
                    <div class="border-txt" style="font-size: 0.625rem; color: #000000; height: 50px;">
                        <?= $completeness_note1 ?>
                    </div>
                </div>
                <div class="col-4">
                    <span style="color: #000000;">Note 2:</span>
                    <div class="border-txt" style="font-size: 0.625rem; color: #000000; height: 50px;">
                        <?= $completeness_note2 ?>
                    </div>
                </div>
                <div class="col-4">
                    <span style="color: #000000;">Note 3:</span>
                    <div class="border-txt" style="font-size: 0.625rem; color: #000000; height: 50px;">
                        <?= $completeness_note3 ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="page-break-after: always;">
        <div class="col-12 pagercok">
            <?php
            $q4 = mysqli_query($connect_pro, "SELECT a.c_outsidesatu,a.c_outsidedua,a.c_outsidetiga, b.c_repair_outsidesatu_o, b.c_repair_outsidedua_o, b.c_repair_outsidetiga_o FROM finalcheck_pic a INNER JOIN finalcheck_repairtime b ON a.c_serialnumber = b.c_serialnumber WHERE a.c_serialnumber = '$serialnumber'");
            $d4 = mysqli_fetch_array($q4);
            $outside_pic1 = $d4['c_outsidesatu'];
            $tanggal_kirim1 = date('d-m-Y H:i A', strtotime($d4['c_repair_outsidesatu_o']));
            $outside_pic2 = $d4['c_outsidedua'];
            $tanggal_kirim2 = date('d-m-Y H:i A', strtotime($d4['c_repair_outsidedua_o']));
            $outside_pic3 = $d4['c_outsidetiga'];
            $tanggal_kirim3 = date('d-m-Y H:i A', strtotime($d4['c_repair_outsidetiga_o']));
            ?>
            <div class="row">
                <div class="col-4">
                    <span style="color: #000000;">Checked 1:</span>
                    <div class="border-sign" style="text-align: center; padding-top: 10px;"><span class="stamp checkcard"><?= $outside_pic1 ?></span></div>
                    <div class="border-date"><span style="font-size: 0.625rem; color: #000000;">Date : <?= $tanggal_kirim1 ?></span></div>
                </div>
                <div class="col-4">
                    <span style="color: #000000;">Checked 2:</span>
                    <div class="border-sign" style="text-align: center; padding-top: 10px;"><span class="stamp checkcard"><?= $outside_pic2 ?></span></div>
                    <div class="border-date"><span style="font-size: 0.625rem; color: #000000;">Date : <?= $tanggal_kirim2 ?></span></div>
                </div>
                <div class="col-4">
                    <span style="color: #000000;">Checked 3:</span>
                    <div class="border-sign" style="text-align: center; padding-top: 10px;"><span class="stamp checkcard"><?= $outside_pic3 ?></span></div>
                    <div class="border-date"><span style="font-size: 0.625rem; color: #000000;">Date : <?= $tanggal_kirim3 ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Halaman completeness 1/1 end -->

    <!-- Halaman outside 1/? start -->
    <div class="row pagercik">
        <div class="col-6">
            <img height="20px" src="management/l_export/export-content/image/logo_icon.png" alt="logo YI"> <span class="instansi-text">PT YAMAHA INDONESIA</span>
        </div>
        <div class="col-6" style="text-align: right;">
            <span class="section-text">[OUTSIDE]</span><span class="halaman-text">(1/1)</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 pagercok">
            <h2 class="judul-text"><?= $serialnumber ?> #<?= $pianoname ?></h2>
            <div class="row">
                <div class="col-6">
                    <table class="table table-contentne">
                        <thead>
                            <th style="text-align: center; width: 5%;">No</th>
                            <th style="width: 85%;">NG/CABINET</th>
                            <th style="width: 10%; text-align: center;">Repaired</th>
                        </thead>
                        <tbody>
                            <?php
                            // hitung dullu ada ng outside atau tidak
                            $q6 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_outside WHERE c_serialnumber = '$serialnumber'");
                            $d6 = mysqli_fetch_array($q6);
                            if ($d6['total'] == 0) {
                            ?>
                                <tr>
                                    <td colspan="3" style="text-align: center;">All is good!</td>
                                </tr>
                                <?php
                            } else {
                                $sql2 = mysqli_query($connect_pro, "SELECT DISTINCT a.c_number_ng, a.c_code_ng, a.c_repair, b.c_name as ng_name FROM finalcheck_outside a  INNER JOIN finalcheck_list_ng b ON a.c_code_ng = b.c_code_ng WHERE a.c_serialnumber = '$serialnumber' ORDER BY a.c_number_ng ASC");
                                while ($data2 = mysqli_fetch_array($sql2)) {
                                    $cabinet = array();
                                    $processcab = array();
                                    $statusrep = array();
                                    $sql3 = mysqli_query($connect_pro, "SELECT a.c_code_cabinet, a.c_process, a.c_repair, b.c_name as cab_name FROM finalcheck_outside a INNER JOIN finalcheck_list_cabinet b ON a.c_code_cabinet = b.c_code_cabinet WHERE a.c_serialnumber = '$serialnumber' AND c_code_ng = '$data2[c_code_ng]'");
                                    while ($data3 = mysqli_fetch_array($sql3)) {
                                        $validasio = '';
                                        if ($data3['c_repair'] == 'Y') {
                                            $validasio = 'checked';
                                        }
                                        array_push($cabinet, $data3['cab_name']);
                                        array_push($processcab, $data3['c_process']);
                                        array_push($statusrep, $validasio);
                                    }
                                    $row = count($cabinet);
                                ?>
                                    <tr>
                                        <td rowspan="<?= $row + 1 ?>" style="text-align: center; padding-top: 2px; padding-bottom: 2px;">
                                            <?= $data2['c_number_ng'] ?><br>
                                        </td>
                                        <td colspan="2" style="padding-top: 2px; padding-bottom: 2px;">
                                            <b><?= $data2['ng_name'] ?></b>
                                        </td>
                                    </tr>
                                    <?php
                                    for ($eh = 0; $eh < $row; $eh++) {
                                        if ($processcab[$eh] == 'oc1') {
                                            $color_cab = '#DC4646';
                                            $proses = '(c1)';
                                            // get tukang repair
                                            $repq = mysqli_query($connect_pro, "SELECT c_outsidesatu_pic FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber'");
                                            $repd = mysqli_fetch_array($repq);
                                            $outside_repair = $repd['c_outsidesatu_pic'];
                                        } elseif ($processcab[$eh] == 'oc2') {
                                            $color_cab  = '#5AA65A';
                                            $proses = '(c2)';
                                            // get tukang repair
                                            $repq = mysqli_query($connect_pro, "SELECT c_outsidedua_pic FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber'");
                                            $repd = mysqli_fetch_array($repq);
                                            $outside_repair = $repd['c_outsidedua_pic'];
                                        } elseif ($processcab[$eh] == 'oc3') {
                                            $color_cab = '#1340FF';
                                            $proses = '(c3)';
                                            // get tukang repair
                                            $repq = mysqli_query($connect_pro, "SELECT c_outsidetiga_pic FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber'");
                                            $repd = mysqli_fetch_array($repq);
                                            $outside_repair = $repd['c_outsidetiga_pic'];
                                        } else {
                                            $proses = '(?)';
                                            $color_cab = '#000';
                                            $outside_repair = '?';
                                        }
                                    ?>
                                        <tr>
                                            <td style="color: <?= $color_cab ?>; padding-top: 2px; padding-bottom: 2px;">
                                                <?= $proses . " " . $cabinet[$eh] ?>
                                            </td>
                                            <td style="padding-top: 2px; padding-bottom: 2px;">
                                                <?= $outside_repair ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <?php
                    $qim = mysqli_query($connect_pro, "SELECT DISTINCT c_image FROM finalcheck_list_coordinate WHERE c_code_type = '$type' ORDER BY c_seq ASC");
                    while ($dim = mysqli_fetch_array($qim)) {
                    ?>
                        <div class="containere" style="margin-bottom: 20px;">
                            <?php
                            if ($type == 'p') {
                                $image_src = 'management/l_export/export-content/image/reguler/' . $dim['c_image'] . '.jpg';
                            } else {
                                $image_src = 'management/l_export/export-content/image/furniture/' . $dim['c_image'] . '.png';
                            }
                            ?>
                            <img src="<?= $image_src ?>" alt="image1" style="opacity: 60%;">
                            <?php
                            $c_code_type = $type;
                            $c_image = $dim['c_image'];
                            $qtbo = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_coordinate, b.c_top, b.c_left FROM finalcheck_loc a INNER JOIN finalcheck_list_coordinate b ON a.c_code_coordinate = b.c_code_coordinate WHERE a.c_serialnumber = '$serialnumber' AND b.c_code_type = '$c_code_type' AND b.c_image = '$c_image'");
                            while ($dtbo = mysqli_fetch_array($qtbo)) {
                                $label_get = array();
                                $label = array();
                                $process_get = array();
                                $process = array();
                                $qtbolab = mysqli_query($connect_pro, "SELECT c_number_ng, c_process FROM finalcheck_loc WHERE c_serialnumber = '$serialnumber' AND c_code_coordinate = '$dtbo[c_code_coordinate]'");

                                while ($dtbolab = mysqli_fetch_array($qtbolab)) {
                                    array_push($label_get, $dtbolab['c_number_ng']);
                                    array_push($process_get, $dtbolab['c_process']);
                                }
                                $cnt = count($label_get);
                                foreach ($label_get as $key => $val) {
                                    if (($key + 1) == $cnt) {
                                        array_push($label, $val);
                                    } else {
                                        array_push($label, $val . ', ');
                                    }

                                    if (($key + 1) % 2 == 0) {
                                        array_push($label, '<br>');
                                    }
                                }

                                $cnt2 = count($process_get);
                                foreach ($process_get as $key2 => $val2) {
                                    if (($key2 + 1) == $cnt2) {
                                        array_push($process, $val2);
                                    } else {
                                        array_push($process, $val2 . ', ');
                                    }

                                    if (($key2 + 1) % 2 == 0) {
                                        array_push($process, '<br>');
                                    }
                                }

                            ?>
                                <button class="btn ingpo" style="width: 23px; border-color: #000000; height: 23px; top: <?= $dtbo['c_top'] ?>%; left: <?= $dtbo['c_left'] ?>%;">
                                    <?php
                                    $row = count($label);
                                    for ($s = 0; $s < $row; $s++) {
                                        if ($process[$s] == 'oc1') {
                                            $color_cab = '#DC4646';
                                        } elseif ($process[$s] == 'oc2') {
                                            $color_cab  = '#5AA65A';
                                        } elseif ($process[$s] == 'oc3') {
                                            $color_cab = '#1340FF';
                                        } elseif ($process[$s] == 'oc1, ') {
                                            $color_cab  = '#DC4646';
                                        } elseif ($process[$s] == 'oc1<br>') {
                                            $color_cab  = '#DC4646';
                                        } elseif ($process[$s] == 'oc2, ') {
                                            $color_cab  = '#5AA65A';
                                        } elseif ($process[$s] == 'oc2<br>') {
                                            $color_cab  = '#5AA65A';
                                        } elseif ($process[$s] == 'oc3, ') {
                                            $color_cab  = '#1340FF';
                                        } elseif ($process[$s] == 'oc3<br>') {
                                            $color_cab  = '#1340FF';
                                        } else {
                                            $color_cab = '#000';
                                        }
                                    ?>
                                        <span style="padding: 0px; color: <?= $color_cab ?>;"><?= $label[$s] ?></span>
                                    <?php
                                    }
                                    ?>
                                </button>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <?php
        $qn3 = mysqli_query($connect_pro, "SELECT c_outsidesatu, c_outsidedua, c_outsidetiga FROM finalcheck_note WHERE c_serialnumber = '$serialnumber'");
        $dn3 = mysqli_fetch_array($qn3);

        if ($dn3['c_outsidesatu'] != '') {
            $outside_note1 = $dn3['c_outsidesatu'];
        } else {
            $outside_note1 = '';
        }

        if ($dn3['c_outsidedua'] != '') {
            $outside_note2 = $dn3['c_outsidedua'];
        } else {
            $outside_note2 = '';
        }

        if ($dn3['c_outsidetiga'] != '') {
            $outside_note3 = $dn3['c_outsidetiga'];
        } else {
            $outside_note3 = '';
        }
        ?>
        <div class="col-12 pagercok">
            <div class="row">
                <div class="col-4">
                    <span style="color: #000000;">Note 1:</span>
                    <div class="border-txt" style="font-size: 0.625rem; color: #000000; height: 50px;">
                        <?= $outside_note1 ?>
                    </div>
                </div>
                <div class="col-4">
                    <span style="color: #000000;">Note 2:</span>
                    <div class="border-txt" style="font-size: 0.625rem; color: #000000; height: 50px;">
                        <?= $outside_note2 ?>
                    </div>
                </div>
                <div class="col-4">
                    <span style="color: #000000;">Note 3:</span>
                    <div class="border-txt" style="font-size: 0.625rem; color: #000000; height: 50px;">
                        <?= $outside_note3 ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="page-break-after: always;">
        <div class="col-12 pagercok">
            <?php
            $q5 = mysqli_query($connect_pro, "SELECT a.c_outsidesatu,a.c_outsidedua,a.c_outsidetiga, b.c_repair_outsidesatu_o, b.c_repair_outsidedua_o, b.c_repair_outsidetiga_o FROM finalcheck_pic a INNER JOIN finalcheck_repairtime b ON a.c_serialnumber = b.c_serialnumber WHERE a.c_serialnumber = '$serialnumber'");
            $d5 = mysqli_fetch_array($q5);
            $outside_pic1 = $d5['c_outsidesatu'];
            $tanggal_kirim1 = date('d-m-Y H:i A', strtotime($d5['c_repair_outsidesatu_o']));
            $outside_pic2 = $d5['c_outsidedua'];
            $tanggal_kirim2 = date('d-m-Y H:i A', strtotime($d5['c_repair_outsidedua_o']));
            $outside_pic3 = $d5['c_outsidetiga'];
            $tanggal_kirim3 = date('d-m-Y H:i A', strtotime($d5['c_repair_outsidetiga_o']));
            ?>
            <div class="row">
                <div class="col-4">
                    <span style="color: #000000;">Checked 1:</span>
                    <div class="border-sign" style="text-align: center; padding-top: 10px;"><span class="stamp checkcard"><?= $outside_pic1 ?></span></div>
                    <div class="border-date"><span style="font-size: 0.625rem; color: #000000;">Date : <?= $tanggal_kirim1 ?></span></div>
                </div>
                <div class="col-4">
                    <span style="color: #000000;">Checked 2:</span>
                    <div class="border-sign" style="text-align: center; padding-top: 10px;"><span class="stamp checkcard"><?= $outside_pic2 ?></span></div>
                    <div class="border-date"><span style="font-size: 0.625rem; color: #000000;">Date : <?= $tanggal_kirim2 ?></span></div>
                </div>
                <div class="col-4">
                    <span style="color: #000000;">Checked 3:</span>
                    <div class="border-sign" style="text-align: center; padding-top: 10px;"><span class="stamp checkcard"><?= $outside_pic3 ?></span></div>
                    <div class="border-date"><span style="font-size: 0.625rem; color: #000000;">Date : <?= $tanggal_kirim3 ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Halaman outside 1/? end -->
</div>
<script>
    const button = document.getElementById("download-button");

    function generatePDF() {
        // Choose the element that your content will be rendered to.
        const element = document.getElementById("invoice");
        // Choose the element and save the PDF for your user.
        html2pdf().from(element).save("<?= $serialnumber ?>.pdf");
    }

    button.addEventListener("click", generatePDF);
</script>