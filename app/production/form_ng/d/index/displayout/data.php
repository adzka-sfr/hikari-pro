<?php
// get process
$sql4 = mysqli_query($connect_pro, "SELECT c_process, c_checker FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber]' AND c_process = 'oc3'");
$data4 = mysqli_fetch_array($sql4);
if (!empty($data4['c_process'])) {
    $lastprocess = 'oc3';
} else {
    $sql4 = mysqli_query($connect_pro, "SELECT c_process, c_checker FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber]' AND c_process = 'oc2'");
    $data4 = mysqli_fetch_array($sql4);
    if (!empty($data4['c_process'])) {
        $lastprocess = 'oc2';
    } else {
        $sql4 = mysqli_query($connect_pro, "SELECT c_process, c_checker FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber]' AND c_process = 'oc1'");
        $data4 = mysqli_fetch_array($sql4);
        if (!empty($data4['c_process'])) {
            $lastprocess = 'oc1';
        }
    }
}

// get type (furniture or polyester)
$sql5 = mysqli_query($connect_pro, "SELECT cat.c_category FROM formng_resultro res JOIN formng_register reg ON res.c_serialnumber = reg.c_serialnumber JOIN formng_category cat ON reg.c_gmc = cat.c_gmc WHERE res.c_serialnumber = '$_SESSION[cardnumber]' limit 1");
$data5 = mysqli_fetch_array($sql5);
$tipe = $data5['c_category']

?>
<div class="row">
    <div class="col-4">
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <blink><b>TBO</b></blink>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <center>
                    <div class="containere">
                        <?php
                        if ($tipe == 'p') {
                        ?>
                            <img src="reguler/tbo.jpg" style="width:100%;">
                        <?php
                        } elseif ($tipe == 'f') {
                        ?>
                            <img src="furniture/tbo.png" style="width:100%;">
                        <?php
                        }
                        ?>

                        <?php
                        $section = '1 top board outside';
                        if ($lastprocess == 'oc1') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng1 != ''");
                        } elseif ($lastprocess == 'oc2') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng2 != ''");
                        } elseif ($lastprocess = 'oc3') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng3 != ''");
                        }

                        while ($g1 = mysqli_fetch_array($gq1)) {
                            $top = $g1['c_top'];
                            $left = $g1['c_left'];
                            $label = $g1['c_arealabel'];
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 50%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #B92C3A; "><?= $label ?></button>
                        <?php
                        }
                        ?>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <blink><b>TBI</b></blink>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <center>
                    <div class="containere">
                        <?php
                        if ($tipe == 'p') {
                        ?>
                            <img src="reguler/tbi.jpg" style="width:100%;">
                        <?php
                        } elseif ($tipe == 'f') {
                        ?>
                            <img src="furniture/tbi.png" style="width:100%;">
                        <?php
                        }
                        ?>
                        <?php
                        $section = '2 top board inside';
                        if ($lastprocess == 'oc1') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng1 != ''");
                        } elseif ($lastprocess == 'oc2') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng2 != ''");
                        } elseif ($lastprocess = 'oc3') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng3 != ''");
                        }
                        while ($g1 = mysqli_fetch_array($gq1)) {
                            $top = $g1['c_top'];
                            $left = $g1['c_left'];
                            $label = $g1['c_arealabel'];
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 50%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #B92C3A; "><?= $label ?></button>
                        <?php
                        }
                        ?>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <blink><b>UK</b></blink>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <center>
                    <div class="containere">
                        <?php
                        if ($tipe == 'p') {
                        ?>
                            <img src="reguler/uk.jpg" style="width:100%;">
                        <?php
                        } elseif ($tipe == 'f') {
                        ?>
                            <img src="furniture/uk.png" style="width:100%;">
                        <?php
                        }
                        ?>
                        <?php
                        $section = '3 upper keyboard';
                        if ($lastprocess == 'oc1') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng1 != ''");
                        } elseif ($lastprocess == 'oc2') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng2 != ''");
                        } elseif ($lastprocess = 'oc3') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng3 != ''");
                        }
                        while ($g1 = mysqli_fetch_array($gq1)) {
                            $top = $g1['c_top'];
                            $left = $g1['c_left'];
                            $label = $g1['c_arealabel'];
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 50%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #B92C3A; "><?= $label ?></button>
                        <?php
                        }
                        ?>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 5px;">
    <div class="col-1">
        <!-- batas kiri -->
    </div>
    <div class="col-4">
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <blink><b>B</b></blink>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <center>
                    <div class="containere">
                        <?php
                        if ($tipe == 'p') {
                        ?>
                            <img src="reguler/b.jpg" style="width:100%;">
                        <?php
                        } elseif ($tipe == 'f') {
                        ?>
                            <img src="furniture/b.png" style="width:100%;">
                        <?php
                        }
                        ?>
                        <?php
                        $section = '4 body';
                        if ($lastprocess == 'oc1') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng1 != ''");
                        } elseif ($lastprocess == 'oc2') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng2 != ''");
                        } elseif ($lastprocess = 'oc3') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng3 != ''");
                        }
                        while ($g1 = mysqli_fetch_array($gq1)) {
                            $top = $g1['c_top'];
                            $left = $g1['c_left'];
                            $label = $g1['c_arealabel'];
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 50%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #B92C3A; "><?= $label ?></button>
                        <?php
                        }
                        ?>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <div class="col-2">
        <!-- tengah -->
    </div>
    <div class="col-4">
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <blink><b>BB</b></blink>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <center>
                    <div class="containere">
                        <?php
                        if ($tipe == 'p') {
                        ?>
                            <img src="reguler/bb.jpg" style="width:100%;">
                        <?php
                        } elseif ($tipe == 'f') {
                        ?>
                            <img src="furniture/bb.png" style="width:100%;">
                        <?php
                        }
                        ?>
                        <?php
                        $section = '5 body back';
                        if ($lastprocess == 'oc1') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng1 != ''");
                        } elseif ($lastprocess == 'oc2') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng2 != ''");
                        } elseif ($lastprocess = 'oc3') {
                            $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$_SESSION[cardnumber]' AND c_ng3 != ''");
                        }
                        while ($g1 = mysqli_fetch_array($gq1)) {
                            $top = $g1['c_top'];
                            $left = $g1['c_left'];
                            $label = $g1['c_arealabel'];
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 50%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #B92C3A; "><?= $label ?></button>
                        <?php
                        }
                        ?>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <div class="col-1">
        <!-- batas kanan -->
    </div>
</div>