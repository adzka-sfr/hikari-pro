<div class="row">
    <div class="col-12">
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width: 33%;">Checker 1</th>
                <th style="width: 33%;">Checker 2</th>
                <th style="width: 33%;">Checker 3</th>
            </thead>
            <tbody>
                <?php
                $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber = '$serial_number'");
                $data2 = mysqli_fetch_array($sql2);

                if (!empty($data2)) {
                    $stampng = '<div class="containere">
                                <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #B92C3A; ">QC REJECTED</button>
                            </div>';
                    $stampok = '';
                    $date_ng1 = $data2['c_inspectiondate1'];
                    $date_ng1 = date('d-m-Y', strtotime($date_ng1));
                    $checker1 = $data2['c_checker1'];
                } else {
                    $stampng = '';
                    $stampok = '<div class="containere">
                            <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #358809; ">QC PASSED</button>
                        </div>';
                    $date_ng1 = '';
                    $checker1 = $_SESSION['nama'];
                }
                ?>
                <tr>
                    <td style="height: 60px;">
                        <?= $stampng ?>
                    </td>
                    <td style="height: 60px;"></td>
                    <td style="height: 60px;"></td>
                </tr>
                <tr style="text-align: left; ">
                    <td style="padding: 0px; height: 20px;">
                        <div class="row">
                            <div class="col-3">
                                Date :
                            </div>
                            <div class="col-8">
                                <?= $date_ng1 ?>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 0px; height: 20px;"></td>
                    <td style="padding: 0px; height: 20px;"></td>
                </tr>
                <tr>
                    <td style="height: 60px;">
                        <?php
                        $sql3 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1 FROM formng_register WHERE c_serialnumber = '$serial_number'");
                        $data3 = mysqli_fetch_array($sql3);

                        if (!empty($data3['c_finishoutcheck1'])) {
                            $date_ok1 = date('d-m-Y', strtotime($data3['c_finishoutcheck1']));
                            $stampok =
                                '<div class="containere">
                            <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #358809; ">QC PASSED</button>
                        </div>';
                        } else {
                            $date_ok1 = '';
                            $stampok = '';
                        }
                        ?>
                        <?= $stampok ?>
                    </td>
                    <td style="height: 60px;"></td>
                    <td style="height: 60px;"></td>
                </tr>
                <tr style="text-align: left; ">
                    <td style="padding: 0px; height: 20px;">
                        <div class="row">
                            <div class="col-3">
                                Date :
                            </div>
                            <div class="col-8">
                                <?= $date_ok1 ?>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 0px; height: 20px;"></td>
                    <td style="padding: 0px; height: 20px;"></td>
                </tr>
                <tr style="text-align: center; ">
                    <td style="padding: 5px; font-weight: bold;">Vera</td>
                    <td style="padding: 5px; font-weight: bold;"></td>
                    <td style="padding: 5px; font-weight: bold;"></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <?php
    $dver_sql = mysqli_query($connect_pro, "SELECT c_inspectiondate1  FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' ORDER BY id asc limit 1 ");
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
                <th>
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
                <th colspan="5">
                    <div class="row">
                        <div class="col-4">
                            Process : <u>Out Side Check 1</u>
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
            $verif_sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' ORDER BY c_section, c_arealabel ");
            $no = 0;
            $count_ng1 = 0;
            while ($verif_data1 = mysqli_fetch_array($verif_sql1)) {
                // no
                $count_ng1++;
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
                    <td>
                        <?= $no ?>
                        <?php
                        $r1 = '';
                        $r2 = '';
                        $r3 = '';
                        if (!empty($verif_data1['c_ng1'])) {
                            if (!empty($verif_data1['c_repairdate1'])) {
                                $count_ng1--;
                                $r1 = '<div class="containere">
                            <button class="bton retro" style="width:30px; border-radius: 0px; rotate: -3deg; font-size: 10px; opacity: 50%; top: 0px; left: 90%; background-color: #CF9502; ">R1</button>
                        </div>';
                            }
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
                            if (!empty($verif_data1['c_repairdate2'])) {
                                $r2 = '<div class="containere">
                            <button class="bton retro" style="width:30px; border-radius: 0px; rotate: -3deg; font-size: 10px; opacity: 50%; top: 17px; left: 90%; background-color: #CF9502; ">R2</button>
                        </div>';
                            }
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
                            if (!empty($verif_data1['c_repairdate2'])) {
                                $r3 = '<div class="containere">
                            <button class="bton retro" style="width:30px; border-radius: 0px; rotate: -3deg; font-size: 10px; opacity: 50%; top: 34px; left: 90%; background-color: #CF9502; ">R3</button>
                        </div>';
                            }
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
                    <td style="text-align: left; width: 20%;">
                        <?= $r1 ?>
                        <?= $r2 ?>
                        <?= $r3 ?>
                        <?= $ng ?>

                    </td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>


        </table>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <?php
        $sql4 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1 FROM formng_register WHERE c_serialnumber = '$serial_number'");
        $data4 = mysqli_fetch_array($sql4);
        if (!empty($data4['c_finishoutcheck1'])) {
        ?>
            <div class="row">
                <div class="col-12" style="text-align: center; padding-top: 10px;">
                    <button disabled name="str" class="btn btn-success">Data has been sent to Check 2</button>
                </div>
            </div>
        <?php
        } else {
        ?>
            <form method="post">
                <?php
                if ($count_ng1 > 0) {
                    $dis = 'disabled';
                } else {
                    $dis = '';
                }
                ?>
                <div class="row">
                    <div class="col-12">
                        <input <?= $dis ?> required name="agree" value="agree" type="checkbox"> Saya yakin piano <b><?= $piano_name ?></b> sudah dilakukan repair dengan semestinya <?= $count_ng1 ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="text-align: center; padding-top: 10px;">

                        <button <?= $dis ?> type="submit" name="str" class="btn btn-success">Send to Check 2</button>
                    </div>
                </div>
            </form>
        <?php
        }
        ?>

    </div>
</div>


<?php
// jika klik button bisa diserahkan ke repair
if (isset($_POST['str'])) {
    $tgl_fo1 = date('Y-m-d H:i:s', strtotime($now));
    $ppp1 = mysqli_query($connect_pro, "UPDATE formng_register SET c_finishoutcheck1 = '$tgl_fo1', c_outcheck1by = '$_SESSION[nama]' WHERE c_serialnumber = '$serial_number'");
    if ($ppp1) {
?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Success',
                    html: 'Piano <br><b><?= $piano_name ?></b><br> has been sent to Check 2 !',
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
        // }
    }
}
?>