<?php
require "../../../config.php";
$serialnumber = $_POST['serialnumber'];

// get informasi piano
$q0 = mysqli_query($connect_pro, "SELECT b.c_name FROM finalcheck_register a INNER JOIN finalcheck_list_piano b ON a.c_gmc = b.c_gmc WHERE a.c_serialnumber = '$serialnumber'");
$d0 = mysqli_fetch_array($q0);
$pianoname = $d0['c_name'];
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
    <?php
    $hal = 1;
    ?>
    <!-- Halaman 1 -->
    <div class="row pagercik">
        <div class="col-6">
            <img height="20px" src="management/l_export/export-content/image/logo_icon.png" alt="logo YI"> <span class="instansi-text">PT YAMAHA INDONESIA</span>
        </div>
        <div class="col-6" style="text-align: right;">
            <span class="section-text">[INSIDE CHECK]</span><span class="halaman-text">(<?= $hal++ ?>)</span>
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

                            // nitip get nama tukang repair
                            $q3 = mysqli_query($connect_pro, "SELECT c_inside_pic FROM finalcheck_repairtime WHERE c_serialnumber  ='$serialnumber'");
                            $d3 = mysqli_fetch_array($q3);

                            $pic_repair = $d3['c_inside_pic'];
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

    <!-- Halaman 2 -->
    <div class="row pagercik">
        <div class="col-6">
            <img height="20px" src="management/l_export/export-content/image/logo_icon.png" alt="logo YI"> <span class="instansi-text">PT YAMAHA INDONESIA</span>
        </div>
        <div class="col-6" style="text-align: right;">
            <span class="section-text">[INSIDE CHECK]</span><span class="halaman-text">(<?= $hal++ ?>)</span>
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

                            // nitip get nama tukang repair
                            $q3 = mysqli_query($connect_pro, "SELECT c_inside_pic FROM finalcheck_repairtime WHERE c_serialnumber  ='$serialnumber'");
                            $d3 = mysqli_fetch_array($q3);

                            $pic_repair = $d3['c_inside_pic'];
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
            <div class="border-txt">
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