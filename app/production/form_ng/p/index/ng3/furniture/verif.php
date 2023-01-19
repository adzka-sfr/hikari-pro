<div class="row">
    <?php
    $dver_sql = mysqli_query($connect_pro, "SELECT c_inspectiondate1 FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' ORDER BY id asc limit 1 ");
    $dver = mysqli_fetch_array($dver_sql);
    if (empty($dver)) {
        $tanggal = date('l, d M Y', strtotime($now));
    } else {
        $tanggal = $dver['c_inspectiondate1'];
        $tanggal = date('l, d M Y', strtotime($tanggal));
    }
    ?>
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr>
                <th colspan="4">
                    <div class="row">
                        <div class="col-4">
                            No.Seri :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="text-align: center;"><u><?= $serial_number ?></u></div>
                    </div>
                </th>
                <th colspan="2">
                    <div class="row">
                        <div class="col-12">
                            Model :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <u><?= $piano_name ?></u>
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th colspan="4">
                    <div class="row">
                        <div class="col-12">
                            Process :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <u>Out Side Check 1</u>
                        </div>
                    </div>
                </th>
                <th style="width: 30%;">
                    <div class="row">
                        <div class="col-12">
                            Inspection Date :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <u><?= $tanggal ?></u>
                        </div>
                    </div>
                </th>
                <th>
                    <div class="row">
                        <div class="col-12">
                            Checker :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <u><?= $_SESSION['nama'] ?></u>
                        </div>
                    </div>
                </th>

            </tr>
            <tr style="text-align: center;">
                <th style="width: 5%; height: 10px;">No</th>
                <th>Section</th>
                <th>Area</th>
                <th>NG</th>
                <th style="width: 60%;" rowspan="100" colspan="2">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div class="containere">
                                    <img src="../image/furniture/top_board_outside.png" style="width:100%;">
                                    <?php
                                    $section = '1 top board outside';
                                    $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$serial_number'");
                                    while ($g1 = mysqli_fetch_array($gq1)) {
                                        $top = $g1['c_top'];
                                        $left = $g1['c_left'];
                                        $label = $g1['c_arealabel'];
                                    ?>
                                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #B92C3A; "><?= $label ?></button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            TBO
                            <div class="separator"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div class="containere">
                                    <img src="../image/furniture/top_board_inside.png" style="width:100%;">
                                    <?php
                                    $section = '2 top board inside';
                                    $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$serial_number'");
                                    while ($g1 = mysqli_fetch_array($gq1)) {
                                        $top = $g1['c_top'];
                                        $left = $g1['c_left'];
                                        $label = $g1['c_arealabel'];
                                    ?>
                                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #B92C3A; "><?= $label ?></button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            TBI
                            <div class="separator"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div class="containere">
                                    <img src="../image/furniture/area_depan.png" style="width:100%;">
                                    <?php
                                    $section = '3 upper keyboard';
                                    $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$serial_number'");
                                    while ($g1 = mysqli_fetch_array($gq1)) {
                                        $top = $g1['c_top'];
                                        $left = $g1['c_left'];
                                        $label = $g1['c_arealabel'];
                                    ?>
                                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #B92C3A; "><?= $label ?></button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            UK
                            <div class="separator"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div class="containere">
                                    <img src="../image/furniture/area_samping.png" style="width:100%;">
                                    <?php
                                    $section = '4 body';
                                    $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$serial_number'");
                                    while ($g1 = mysqli_fetch_array($gq1)) {
                                        $top = $g1['c_top'];
                                        $left = $g1['c_left'];
                                        $label = $g1['c_arealabel'];
                                    ?>
                                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #B92C3A; "><?= $label ?></button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            B
                            <div class="separator"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div class="containere">
                                    <img src="../image/furniture/area_belakang.png" style="width:100%;">
                                    <?php
                                    $section = '5 body back';
                                    $gq1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 fr JOIN formng_basecoor fb ON fr.c_areacode = fb.c_btn_id WHERE fr.c_section = '$section' AND fr.c_serialnumber = '$serial_number'");
                                    while ($g1 = mysqli_fetch_array($gq1)) {
                                        $top = $g1['c_top'];
                                        $left = $g1['c_left'];
                                        $label = $g1['c_arealabel'];
                                    ?>
                                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #B92C3A; "><?= $label ?></button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </center>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            BB
                            <div class="separator"></div>
                        </div>
                    </div>
                </th>
            </tr>
            <?php
            $verif_sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' ORDER BY c_areacode");
            $no = 0;
            while ($verif_data1 = mysqli_fetch_array($verif_sql1)) {
                // no
                $no++;

                // section
                if ($verif_data1['c_section'] == '1 top board outside') {
                    $section = 'TBO';
                } elseif ($verif_data1['c_section'] == '2 top board inside') {
                    $section = 'TBI';
                } elseif ($verif_data1['c_section'] == '3 upper keyboard') {
                    $section = 'UK';
                } elseif ($verif_data1['c_section'] == '4 body') {
                    $section = 'B';
                } elseif ($verif_data1['c_section'] == '5 body back') {
                    $section = 'BB';
                }

                // area
                $area = $verif_data1['c_arealabel'];

                // ng
                // ng
                if (!empty($verif_data1['c_ng1'])) {
                    $ng = $verif_data1['c_ng1'];
                }

                if (!empty($verif_data1['c_ng2'])) {
                    $ng = $verif_data1['c_ng2'];
                }

                if (!empty($verif_data1['c_ng3'])) {
                    $ng = $verif_data1['c_ng3'];
                }
                // $ng = $verif_data1['c_ng1'];
            ?>
                <tr style="text-align: center; height: 10px;">
                    <td><?= $no ?>
                        <?php
                        if (!empty($verif_data1['c_ng1'])) {
                        ?>
                            <div style="height: 5px; width: auto; background-color: #FF5739; "></div>
                        <?php
                        } else {
                        ?>
                            <div style="height: 5px; width: auto; background-color: #fff; "></div>
                        <?php
                        }
                        ?>
                        <?php
                        if (!empty($verif_data1['c_ng2'])) {
                        ?>
                            <div style="height: 5px; width: auto; background-color: #69C33B; "></div>
                        <?php
                        } else {
                        ?>
                            <div style="height: 5px; width: auto; background-color: #fff; "></div>
                        <?php
                        }
                        ?>
                        <?php
                        if (!empty($verif_data1['c_ng3'])) {
                        ?>
                            <div style="height: 5px; width: auto; background-color: #41A5E1; "></div>
                        <?php
                        } else {
                        ?>
                            <div style="height: 5px; width: auto; background-color: #fff; "></div>
                        <?php
                        }
                        ?>
                    </td>
                    <td><?= $section ?></td>
                    <td><?= $area ?></td>
                    <td style="text-align: left; width: 20%;"><?= $ng ?></td>
                </tr>
            <?php
            }
            ?>


        </table>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <input required name="agree" value="agree" type="checkbox"> Saya yakin piano <b><?= $piano_name ?></b> sudah bisa diserahkan ke proses Repair
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align: center; padding-top: 10px;">
                    <button type="submit" name="str" class="btn btn-success">Send to Repair</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
// jika dah oke dan klik print akan mereset session
if (isset($_POST['cancel'])) {
    $_SESSION['queue'] = "tbo";
?>
    <script>
        window.location = 'index.php';
    </script>
    <?php
}

// jika klik button bisa diserahkan ke repair
if (isset($_POST['str'])) {
    $drn = date('Y-m-d H:i:s', strtotime($now));
    $sql1 = mysqli_query($connect_pro, "SELECT id FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_ng2 != ''");
    $data1 = mysqli_fetch_array($sql1);
    if (!empty(!empty($data1['id']))) {
        $sql1 = mysqli_query($connect_pro, "SELECT o.c_serialnumber, o.c_pianoname, o.c_checker2, o.c_section, o.c_areacode, o.c_ng2,o.c_cabinet, r.c_gmc  FROM formng_resulto1 o JOIN formng_register r ON o.c_serialnumber = r.c_serialnumber WHERE o.c_serialnumber = '$serial_number' AND c_ng2 != ''");

        while ($data1 = mysqli_fetch_array($sql1)) {
            $ppp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultro SET c_serialnumber = '$data1[c_serialnumber]', c_pianoname = '$data1[c_pianoname]',c_gmc = '$data1[c_gmc]', c_inspectiondate = '$drn', c_checker = '$data1[c_checker2]', c_process = 'oc2', c_section = '$data1[c_section]', c_areacode = '$data1[c_areacode]', c_cabinet = '$data1[c_cabinet]', c_ng = '$data1[c_ng2]'");
        }
        if ($ppp1) {
    ?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Success',
                        html: 'Piano <br><b><?= $piano_name ?></b><br> has been sent to Repair !',
                        type: 'success',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                        // timer: 2000,
                        // showCancelButton: false,
                        // showConfirmButton: false
                    }).then(function() {
                        // disini diarahkan ke halaman print dulu baru unset session dan balik ke halaman index
                        <?php
                        // unset($_SESSION['cardnumber']);
                        ?>
                        window.location = 'index.php';
                    });
                });
            </script>
        <?php
        }
    } else {
        $drn = date('Y-m-d H:i:s', strtotime($now));
        $sql1 = mysqli_query($connect_pro, "SELECT c_gmc FROM formng_register WHERE c_serialnumber = '$serial_number'");
        $data1 = mysqli_fetch_array($sql1);
        $ppp1 = mysqli_query($connect_pro, "INSERT INTO formng_resultro SET c_serialnumber = '$serial_number', c_pianoname = '$piano_name',c_gmc = '$data1[c_gmc]', c_inspectiondate = '$drn', c_checker = '$_SESSION[nama]', c_process = 'oc2'");
        if ($ppp1) {
        ?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Success',
                        html: 'Piano <br><b><?= $piano_name ?></b><br> has been sent to Repair !',
                        type: 'success',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                        // timer: 2000,
                        // showCancelButton: false,
                        // showConfirmButton: false
                    }).then(function() {
                        // disini diarahkan ke halaman print dulu baru unset session dan balik ke halaman index
                        <?php
                        // unset($_SESSION['cardnumber']);
                        ?>
                        window.location = 'index.php';
                    });
                });
            </script>
<?php
        }
    }
}
?>