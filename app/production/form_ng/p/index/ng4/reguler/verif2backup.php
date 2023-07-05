<div class="row">
    <div class="col-12">
        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="outsidecheck-tab" data-toggle="tab" href="#outsidecheck" role="tab" aria-controls="outsidecheck" aria-selected="true">Outside Check</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="completeness-tab" data-toggle="tab" href="#completeness" role="tab" aria-controls="completeness" aria-selected="false">Completeness</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="outsidecheck" role="tabpanel" aria-labelledby="outsidecheck-tab">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead style="text-align: center;">
                                    <th style="width: 33%;">Checker 1</th>
                                    <th style="width: 33%;">Checker 2</th>
                                    <th style="width: 33%;">Checker 3</th>
                                </thead>
                                <tbody>

                                    <!-- stempel reject -->
                                    <tr>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_inspectiondate1) as jumng FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_inspectiondate1 != ''");
                                            $data2 = mysqli_fetch_array($sql2);

                                            if ($data2['jumng'] > 0) {
                                                $sql2 = mysqli_query($connect_pro, "SELECT c_inspectiondate1, c_checker1 FROM formng_resulto1 WHERE c_serialnumber = '$serial_number'  AND c_inspectiondate1 != ''");
                                                $data2 = mysqli_fetch_array($sql2);
                                                $stampng1 = '<div class="containere">
                                <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #B92C3A; ">QC REJECTED</button>
                            </div>';
                                                $stampok1 = '';
                                                $date_ng1 = $data2['c_inspectiondate1'];
                                                $date_ng1 = date('d-m-Y', strtotime($date_ng1));
                                                $checker1 = $data2['c_checker1'];
                                            } else {
                                                $sql7 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1, c_outcheck1by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                                $data7 = mysqli_fetch_array($sql7);

                                                if (!empty($data7['c_finishoutcheck1'])) {
                                                    $checker1 = $data7['c_outcheck1by'];
                                                    $date_ng1 = '';
                                                    $date_ok1 = $data7['c_finishoutcheck1'];
                                                    $stampng1 = '';
                                                    $stampok1 = '<div class="containere">
                            <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #358809; ">QC PASSED</button>
                        </div>';
                                                } else {
                                                    $stampng1 = '';
                                                    $stampok1 = '';
                                                    $date_ng1 = '';
                                                    $date_ok1 = '';
                                                    $checker1 = '';
                                                }
                                            }
                                            ?>
                                            <?= $stampng1 ?>
                                        </td>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_inspectiondate2) as jumng FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_inspectiondate2 != ''");
                                            $data2 = mysqli_fetch_array($sql2);

                                            if ($data2['jumng'] > 0) {
                                                $sql2 = mysqli_query($connect_pro, "SELECT c_inspectiondate2, c_checker2 FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_inspectiondate2 != ''");
                                                $data2 = mysqli_fetch_array($sql2);
                                                $stampng2 = '<div class="containere">
                                <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #B92C3A; ">QC REJECTED</button>
                            </div>';
                                                $stampok2 = '';
                                                $date_ng2 = $data2['c_inspectiondate2'];
                                                $date_ng2 = date('d-m-Y', strtotime($date_ng2));
                                                $checker2 = $data2['c_checker2'];
                                            } else {
                                                $sql7 = mysqli_query($connect_pro, "SELECT c_finishoutcheck2, c_outcheck2by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                                $data7 = mysqli_fetch_array($sql7);

                                                if (!empty($data7['c_finishoutcheck2'])) {
                                                    $checker2 = $data7['c_outcheck2by'];
                                                    $date_ng2 = '';
                                                    $date_ok2 = $data7['c_finishoutcheck2'];
                                                    $stampng2 = '';
                                                    $stampok2 = '<div class="containere">
                            <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #358809; ">QC PASSED</button>
                        </div>';
                                                } else {
                                                    $stampng2 = '';
                                                    $stampok2 = '';
                                                    $date_ng2 = '';
                                                    $date_ok2 = '';
                                                    $checker2 = '';
                                                }
                                            }
                                            ?>
                                            <?= $stampng2 ?></td>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_inspectiondate3) as jumng FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_inspectiondate3 != ''");
                                            $data2 = mysqli_fetch_array($sql2);

                                            if ($data2['jumng'] > 0) {
                                                $sql2 = mysqli_query($connect_pro, "SELECT c_inspectiondate3, c_checker3 FROM formng_resulto1 WHERE c_serialnumber = '$serial_number'AND c_inspectiondate3 != ''");
                                                $data2 = mysqli_fetch_array($sql2);
                                                $stampng3 = '<div class="containere">
                                <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #B92C3A; ">QC REJECTED</button>
                            </div>';
                                                $stampok3 = '';
                                                $date_ng3 = $data2['c_inspectiondate3'];
                                                $date_ng3 = date('d-m-Y', strtotime($date_ng2));
                                                $checker3 = $data2['c_checker3'];
                                            } else {
                                                $sql7 = mysqli_query($connect_pro, "SELECT c_finishoutcheck3, c_outcheck3by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                                $data7 = mysqli_fetch_array($sql7);

                                                if (!empty($data7['c_finishoutcheck3'])) {
                                                    $checker3 = $data7['c_outcheck3by'];
                                                    $date_ng3 = '';
                                                    $date_ok3 = $data7['c_finishoutcheck3'];
                                                    $stampng3 = '';
                                                    $stampok3 = '<div class="containere">
                            <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #358809; ">QC PASSED</button>
                        </div>';
                                                } else {
                                                    $stampng3 = '';
                                                    $stampok3 = '';
                                                    $date_ng3 = '';
                                                    $date_ok3 = '';
                                                    $checker3 = '';
                                                }
                                            }
                                            ?>
                                            <?= $stampng3 ?></td>
                                    </tr>
                                    <!-- stempel reject -->

                                    <!-- tanggal reject -->
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
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-3">
                                                    Date :
                                                </div>
                                                <div class="col-8">
                                                    <?= $date_ng2 ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-3">
                                                    Date :
                                                </div>
                                                <div class="col-8">
                                                    <?= $date_ng3 ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- tanggal reject -->

                                    <!-- stempel pass -->
                                    <tr>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql3 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1, c_outcheck1by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                            $data3 = mysqli_fetch_array($sql3);

                                            if (!empty($data3['c_finishoutcheck1'])) {
                                                $date_ok1 = date('d-m-Y', strtotime($data3['c_finishoutcheck1']));
                                                $checker1 = $data3['c_outcheck1by'];
                                                $stampok1 =
                                                    '<div class="containere">
                            <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #358809; ">QC PASSED</button>
                        </div>';
                                            } else {
                                                $date_ok1 = '';
                                                $stampok1 = '';
                                            }
                                            ?>
                                            <?= $stampok1 ?>
                                        </td>

                                        <td style="height: 60px;">
                                            <?php
                                            $sql3 = mysqli_query($connect_pro, "SELECT c_finishoutcheck2, c_outcheck2by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                            $data3 = mysqli_fetch_array($sql3);

                                            if (!empty($data3['c_finishoutcheck2'])) {
                                                $date_ok2 = date('d-m-Y', strtotime($data3['c_finishoutcheck2']));
                                                $checker2 = $data3['c_outcheck2by'];
                                                $stampok2 =
                                                    '<div class="containere">
                            <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #358809; ">QC PASSED</button>
                        </div>';
                                            } else {
                                                $date_ok2 = '';
                                                $stampok2 = '';
                                            }
                                            ?>
                                            <?= $stampok2 ?>
                                        </td>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql3 = mysqli_query($connect_pro, "SELECT c_finishoutcheck3, c_outcheck3by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                            $data3 = mysqli_fetch_array($sql3);

                                            if (!empty($data3['c_finishoutcheck3'])) {
                                                $date_ok3 = date('d-m-Y', strtotime($data3['c_finishoutcheck3']));
                                                $checker3 = $data3['c_outcheck3by'];
                                                $stampok3 =
                                                    '<div class="containere">
                            <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #358809; ">QC PASSED</button>
                        </div>';
                                            } else {
                                                $date_ok3 = '';
                                                $stampok3 = '';
                                            }
                                            ?>
                                            <?= $stampok3 ?>
                                        </td>
                                    </tr>
                                    <!-- stempel pass -->

                                    <!-- tanggal pass -->
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
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-3">
                                                    Date :
                                                </div>
                                                <div class="col-8">
                                                    <?= $date_ok2 ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-3">
                                                    Date :
                                                </div>
                                                <div class="col-8">
                                                    <?= $date_ok3 ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- tanggal pass -->

                                    <!-- nama checker -->
                                    <tr style="text-align: center; ">
                                        <td style="padding: 5px; font-weight: bold;"><?= $checker1 ?></td>
                                        <td style="padding: 5px; font-weight: bold;"><?= $checker2 ?></td>
                                        <td style="padding: 5px; font-weight: bold;"><?= $checker3 ?></td>
                                    </tr>
                                    <!-- nama checker -->

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
                                            <div class="col-12" style="text-align: center; font-size: 15px;"><u><?= $serial_number ?></u></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="row">
                                            <div class="col-12">
                                                Model :
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12" style="text-align: center; font-size: 15px;">
                                                <u><?= $piano_name ?></u>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="5">
                                        <div class="row">
                                            <div class="col-4">
                                                Process : <u>Out Side Check 3</u>
                                            </div>
                                        </div>
                                    </th>

                                </tr>
                                <tr style="text-align: center;">
                                    <th style="width: 5%; height: 10px;">No</th>
                                    <th>Section</th>
                                    <th>Area</th>
                                    <th>NG</th>
                                    <th style="width: 60%;" rowspan="100">
                                        <div class="row">
                                            <div class="col-12">
                                                <center>
                                                    <div class="containere">
                                                        <img src="../image/reguler/top_board_outside.jpg" style="width:100%;">
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
                                                        <img src="../image/reguler/top_board_inside.jpg" style="width:100%;">
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
                                                        <img src="../image/reguler/area_depan.jpg" style="width:100%;">
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
                                                        <img src="../image/reguler/area_samping.jpg" style="width:100%;">
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
                                                        <img src="../image/reguler/area_belakang.jpg" style="width:100%;">
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
                                $count_ng3 = 0;
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
                                    if (!empty($verif_data1['c_ng1'])) {
                                        $ng = $verif_data1['c_ng1'];
                                        $cab = $verif_data1['c_cabinet'];
                                    }

                                    if (!empty($verif_data1['c_ng2'])) {
                                        $ng = $verif_data1['c_ng2'];
                                        $cab = $verif_data1['c_cabinet'];
                                    }

                                    if (!empty($verif_data1['c_ng3'])) {
                                        $ng = $verif_data1['c_ng3'];
                                        $cab = $verif_data1['c_cabinet'];
                                        $count_ng3++;
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

                                                    $r1 = '<div class="containere">
                            <button class="bton retro" style="width:100px; border-radius: 0px; rotate: -3deg; font-size: 12px; opacity: 70%; top: 0px; left: 80%; background-color: #FF5739; ">' . $verif_data1['c_repair1'] . '</button>
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
                            <button class="bton retro" style="width:100px; border-radius: 0px; rotate: -3deg; font-size: 12px; opacity: 70%; top: 17px; left: 80%; background-color: #69C33B; ">' . $verif_data1['c_repair2'] . '</button>
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
                                                if (!empty($verif_data1['c_repairdate3'])) {
                                                    $count_ng3--;
                                                    $r3 = '<div class="containere">
                            <button class="bton retro" style="width:100px; border-radius: 0px; rotate: -3deg; font-size: 12px; opacity: 70%; top: 34px; left: 80%; background-color: #41A5E1; ">' . $verif_data1['c_repair3'] . '</button>
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
                                            <?= $cab ?>
                                            <br>
                                            <b> <?= $ng ?> </b>

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

                </div>
                <div class="tab-pane fade" id="completeness" role="tabpanel" aria-labelledby="completeness-tab">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead style="text-align: center;">
                                    <th style="width: 33%;">Checker 1</th>
                                    <th style="width: 33%;">Checker 2</th>
                                    <th style="width: 33%;">Checker 3</th>
                                </thead>
                                <tbody>
                                    <!-- stempel pass -->
                                    <tr>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql5 = mysqli_query($connect_pro, "SELECT c_finishcomplete1 , c_complete1by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                            $data5 = mysqli_fetch_array($sql5);

                                            if (!empty($data5['c_finishcomplete1'])) {
                                                $date_complete1 = $data5['c_finishcomplete1'];
                                                $date_complete1 = date('d-m-Y', strtotime($date_complete1));
                                                $check_complete1 = $data5['c_complete1by'];
                                            ?>
                                                <div class="containere">
                                                    <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #F3750F; ">QC CHECKED</button>
                                                </div>
                                            <?php
                                            } else {
                                                $date_complete1 = '';
                                                $check_complete1 = '';
                                            }
                                            ?>
                                        </td>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql5 = mysqli_query($connect_pro, "SELECT c_finishcomplete2 , c_complete2by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                            $data5 = mysqli_fetch_array($sql5);

                                            if (!empty($data5['c_finishcomplete2'])) {
                                                $date_complete2 = $data5['c_finishcomplete2'];
                                                $date_complete2 = date('d-m-Y', strtotime($date_complete2));
                                                $check_complete2 = $data5['c_complete2by'];
                                            ?>
                                                <div class="containere">
                                                    <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #F3750F; ">QC CHECKED</button>
                                                </div>
                                            <?php
                                            } else {
                                                $date_complete2 = '';
                                                $check_complete2 = '';
                                            }
                                            ?>
                                        </td>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql5 = mysqli_query($connect_pro, "SELECT c_finishcomplete3 , c_complete3by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                            $data5 = mysqli_fetch_array($sql5);

                                            if (!empty($data5['c_finishcomplete3'])) {
                                                $date_complete3 = $data5['c_finishcomplete3'];
                                                $date_complete3 = date('d-m-Y', strtotime($date_complete3));
                                                $check_complete3 = $data5['c_complete3by'];
                                            ?>
                                                <div class="containere">
                                                    <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #F3750F; ">QC CHECKED</button>
                                                </div>
                                            <?php
                                            } else {
                                                $date_complete3 = '';
                                                $check_complete3 = '';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <!-- stempel pass -->

                                    <!-- tanggal pass -->
                                    <tr style="text-align: left; ">
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-3">
                                                    Date :
                                                </div>
                                                <div class="col-8">
                                                    <?= $date_complete1 ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-3">
                                                    Date :
                                                </div>
                                                <div class="col-8">
                                                    <?= $date_complete2 ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-3">
                                                    Date :
                                                </div>
                                                <div class="col-8">
                                                    <?= $date_complete3 ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- tanggal pass -->

                                    <!-- nama checker -->
                                    <tr style="text-align: center; ">
                                        <td style="padding: 5px; font-weight: bold;"><?= $check_complete1 ?></td>
                                        <td style="padding: 5px; font-weight: bold;"><?= $check_complete2 ?></td>
                                        <td style="padding: 5px; font-weight: bold;"><?= $check_complete3 ?></td>
                                    </tr>
                                    <!-- nama checker -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead style="text-align: center;">
                                    <th style="width: 5%;">No</th>
                                    <th>Part Name</th>
                                    <th style="width: fit-content;">Check1</th>
                                    <th style="width: fit-content;">Check2</th>
                                    <th style="width: fit-content;">Check3</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    $sql6 = mysqli_query($connect_pro, "SELECT * FROM formng_resultc WHERE c_serialnumber = '$serial_number'");
                                    while ($data6 = mysqli_fetch_array($sql6)) {
                                        $no++;
                                    ?>
                                        <tr style="text-align: center;">
                                            <td><?= $no ?></td>
                                            <td style="text-align: left;"><?= $data6['c_partname'] ?></td>
                                            <td>
                                                <?php
                                                if ($data6['c_result1'] == 'NO') {
                                                    if (!empty($data6['c_repairdate1'])) {
                                                ?>
                                                        <div class="containere">
                                                            <button class="bton retro" style="width:100px; border-radius: 0px; rotate: -3deg; font-size: 12px; opacity: 70%; top: 0px; left: 50%; background-color: #CF9502; "><?= $data6['c_repair1by'] ?></button>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <img style="height: 40px;" src="<?= base_url('_assets/production/icons/parts/cross.png') ?>" alt="NO">
                                                <?php
                                                } elseif ($data6['c_result1'] == 'OK') {
                                                ?>
                                                    <img style="height: 40px;" src="<?= base_url('_assets/production/icons/parts/check.png') ?>" alt="OK">
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($data6['c_result2'] == 'NO') {
                                                    if (!empty($data6['c_repairdate2'])) {
                                                ?>
                                                        <div class="containere">
                                                            <button class="bton retro" style="width:100px; border-radius: 0px; rotate: -3deg; font-size: 12px; opacity: 70%; top: 0px; left: 50%; background-color: #CF9502; "><?= $data6['c_repair2by'] ?></button>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <img style="height: 40px;" src="<?= base_url('_assets/production/icons/parts/cross.png') ?>" alt="NO">
                                                <?php
                                                } elseif ($data6['c_result2'] == 'OK') {
                                                ?>
                                                    <img style="height: 40px;" src="<?= base_url('_assets/production/icons/parts/check.png') ?>" alt="OK">
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($data6['c_result3'] == 'NO') {
                                                    $count_ng3++;
                                                    if (!empty($data6['c_repairdate3'])) {
                                                        $count_ng3--;
                                                ?>
                                                        <div class="containere">
                                                            <button class="bton retro" style="width:100px; border-radius: 0px; rotate: -3deg; font-size: 12px; opacity: 70%; top: 0px; left: 50%; background-color: #CF9502; "><?= $data6['c_repair3by'] ?></button>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <img style="height: 40px;" src="<?= base_url('_assets/production/icons/parts/cross.png') ?>" alt="NO">
                                                <?php
                                                } elseif ($data6['c_result3'] == 'OK') {
                                                ?>
                                                    <img style="height: 40px;" src="<?= base_url('_assets/production/icons/parts/check.png') ?>" alt="OK">
                                                <?php
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
                    <div class="row">
                        <div class="col-12">
                            <?php
                            $sql4 = mysqli_query($connect_pro, "SELECT c_finishoutcheck3 FROM formng_register WHERE c_serialnumber = '$serial_number'");
                            $data4 = mysqli_fetch_array($sql4);
                            if (!empty($data4['c_finishoutcheck3'])) {
                            ?>
                                <div class="row">
                                    <div class="col-12" style="text-align: center; padding-top: 10px;">
                                        <button disabled name="str" class="btn btn-success">Data has been closed</button>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <form method="post">
                                    <?php
                                    if ($count_ng3 > 0) {
                                        $dis = 'disabled';
                                    } else {
                                        $dis = '';
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <input <?= $dis ?> required name="agree" value="agree" type="checkbox"> Saya yakin piano <b><?= $piano_name ?></b> sudah dilakukan repair dengan semestinya
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" style="text-align: center; padding-top: 10px;">

                                            <button <?= $dis ?> type="submit" name="str" class="btn btn-success">Close check card</button>
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
                        //cek apakah nama tukang validasi sama dengan tukang check
                        $sql = mysqli_query($connect_pro, "SELECT c_checker FROM formng_resultro WHERE c_serialnumber = '$serial_number' AND c_process = 'oc3' limit 1");
                        $data = mysqli_fetch_array($sql);
                        $checker3 = $data['c_checker'];
                        if ($checker3 == $_SESSION['nama']) {
                            $tgl_fo1 = date('Y-m-d H:i:s', strtotime($now));
                            $ppp1 = mysqli_query($connect_pro, "UPDATE formng_register SET c_finishoutcheck3 = '$tgl_fo1', c_outcheck3by = '$_SESSION[nama]' WHERE c_serialnumber = '$serial_number'");
                            if ($ppp1) {
                    ?>
                                <script>
                                    $(document).ready(function() {
                                        Swal.fire({
                                            title: 'Success',
                                            html: 'Piano <br><b><?= $piano_name ?></b><br> has been closed !',
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
                        } else {
                            ?>
                            <script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        title: 'Validasi ditolak!',
                                        html: 'PIC checker dan PIC validasi harus sama<br>untuk serial number ini harus divalidasi oleh <u><?= $checker3 ?></u> !',
                                        type: 'error',
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
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>