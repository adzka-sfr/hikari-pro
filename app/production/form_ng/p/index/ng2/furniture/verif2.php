<script src="<?= base_url('_assets/src/add/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>
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
                    <div class="row" style="padding-top: 0px;">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">
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
                                                <div class="col-4">
                                                    Model :
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12" style="text-align: center; font-size: 15px;"><u><?= $pianoname ?></u></div>
                                            </div>
                                        </th>
                                    </tr>

                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead style="text-align: center;">
                                    <th style="width: 33%;">Pengecek 1</th>
                                    <th style="width: 33%;">Pengecek 2</th>
                                    <th style="width: 33%;">Pengecek 3</th>
                                </thead>
                                <tbody>

                                    <!-- stempel reject -->
                                    <tr>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql21 = mysqli_query($connect_pro, "SELECT COUNT(c_inspectiondate) as jumng FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_process = 'oc1'");
                                            $data21 = mysqli_fetch_array($sql21);

                                            if ($data21['jumng'] > 0) {
                                                $sql21 = mysqli_query($connect_pro, "SELECT c_inspectiondate, c_checker FROM formng_resultong WHERE c_serialnumber = '$serial_number'  AND c_process = 'oc1'");
                                                $data21 = mysqli_fetch_array($sql21);
                                                $stampng1 = '<div class="containere">
                                <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #B92C3A; ">QC REJECTED</button>
                            </div>';
                                                $stampok1 = '';
                                                $date_ng1 = $data21['c_inspectiondate'];
                                                $date_ng1 = date('d-m-Y H:i:s', strtotime($date_ng1));
                                                $checker1 = $data21['c_checker'];
                                            } else {
                                                $sql71 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1, c_outcheck1by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                                $data71 = mysqli_fetch_array($sql71);

                                                if (!empty($data71['c_finishoutcheck1'])) {
                                                    $checker1 = $data71['c_outcheck1by'];
                                                    $date_ng1 = '';
                                                    $date_ok1 = $data71['c_finishoutcheck1'];
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
                                            $sql22 = mysqli_query($connect_pro, "SELECT COUNT(c_inspectiondate) as jumng FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_process = 'oc2'");
                                            $data22 = mysqli_fetch_array($sql22);

                                            if ($data22['jumng'] > 0) {
                                                $sql22 = mysqli_query($connect_pro, "SELECT c_inspectiondate, c_checker FROM formng_resultong WHERE c_serialnumber = '$serial_number'  AND c_process = 'oc2'");
                                                $data22 = mysqli_fetch_array($sql22);
                                                $stampng2 = '<div class="containere">
                                <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #B92C3A; ">QC REJECTED</button>
                            </div>';
                                                $stampok2 = '';
                                                $date_ng2 = $data22['c_inspectiondate'];
                                                $date_ng2 = date('d-m-Y H:i:s', strtotime($date_ng2));
                                                $checker2 = $data22['c_checker'];
                                            } else {
                                                $sql72 = mysqli_query($connect_pro, "SELECT c_finishoutcheck2, c_outcheck2by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                                $data72 = mysqli_fetch_array($sql72);

                                                if (!empty($data72['c_finishoutcheck1'])) {
                                                    $checker2 = $data72['c_outcheck1by'];
                                                    $date_ng2 = '';
                                                    $date_ok2 = $data72['c_finishoutcheck1'];
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
                                            <?= $stampng2 ?>
                                        </td>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql23 = mysqli_query($connect_pro, "SELECT COUNT(c_inspectiondate) as jumng FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_process = 'oc3'");
                                            $data23 = mysqli_fetch_array($sql23);

                                            if ($data23['jumng'] > 0) {
                                                $sql23 = mysqli_query($connect_pro, "SELECT c_inspectiondate, c_checker FROM formng_resultong WHERE c_serialnumber = '$serial_number'  AND c_process = 'oc3'");
                                                $data23 = mysqli_fetch_array($sql23);
                                                $stampng3 = '<div class="containere">
                                <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #B92C3A; ">QC REJECTED</button>
                            </div>';
                                                $stampok3 = '';
                                                $date_ng3 = $data23['c_inspectiondate'];
                                                $date_ng3 = date('d-m-Y H:i:s', strtotime($date_ng3));
                                                $checker3 = $data23['c_checker'];
                                            } else {
                                                $sql73 = mysqli_query($connect_pro, "SELECT c_finishoutcheck3, c_outcheck3by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                                $data73 = mysqli_fetch_array($sql73);

                                                if (!empty($data73['c_finishoutcheck1'])) {
                                                    $checker3 = $data73['c_outcheck1by'];
                                                    $date_ng3 = '';
                                                    $date_ok3 = $data73['c_finishoutcheck1'];
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
                                            <?= $stampng3 ?>
                                        </td>
                                    </tr>
                                    <!-- stempel reject -->

                                    <!-- tanggal reject -->
                                    <tr style="text-align: left; ">
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    Tanggal : <?= $date_ng1 ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    Tanggal : <?= $date_ng2 ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    Tanggal : <?= $date_ng3 ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- tanggal reject -->

                                    <!-- stempel pass -->
                                    <tr>
                                        <td style="height: 60px;">
                                            <?php
                                            $sql31 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1, c_outcheck1by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                            $data31 = mysqli_fetch_array($sql31);

                                            if (!empty($data31['c_finishoutcheck1'])) {
                                                $date_ok1 = date('d-m-Y H:i:s', strtotime($data31['c_finishoutcheck1']));
                                                $checker1 = $data31['c_outcheck1by'];
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
                                            $sql32 = mysqli_query($connect_pro, "SELECT c_finishoutcheck2, c_outcheck2by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                            $data32 = mysqli_fetch_array($sql32);

                                            if (!empty($data32['c_finishoutcheck2'])) {
                                                $date_ok2 = date('d-m-Y', strtotime($data32['c_finishoutcheck2']));
                                                $checker2 = $data32['c_outcheck2by'];
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
                                            $sql33 = mysqli_query($connect_pro, "SELECT c_finishoutcheck3, c_outcheck3by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                                            $data33 = mysqli_fetch_array($sql33);

                                            if (!empty($data33['c_finishoutcheck3'])) {
                                                $date_ok3 = date('d-m-Y', strtotime($data33['c_finishoutcheck3']));
                                                $checker3 = $data33['c_outcheck3by'];
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
                                                <div class="col-12">
                                                    Tanggal : <?= $date_ok1 ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    Tanggal : <?= $date_ok2 ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    Tanggal : <?= $date_ok3 ?>
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
                        <div class="col-12">
                            <table class="table">
                                <tr style="text-align: center;">
                                    <td><i class="fa fa-pencil" style="color: #DC4646 ;"></i> Outside Check 1</td>
                                    <td><i class="fa fa-pencil" style="color: #5AA65A ;"></i> Outside Check 2</td>
                                    <td><i class="fa fa-pencil" style="color: #1340FF ;"></i> Outside Check 3</td>
                                </tr>
                                <?php
                                $verif_sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' ORDER BY c_section, c_arealabel ");
                                $no = 0;
                                $count_ng1 = 0;
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
                                        $count_ng1++;
                                    }

                                    if (!empty($verif_data1['c_ng2'])) {
                                        $ng = $verif_data1['c_ng2'];
                                        $cab = $verif_data1['c_cabinet'];
                                    }

                                    if (!empty($verif_data1['c_ng3'])) {
                                        $ng = $verif_data1['c_ng3'];
                                        $cab = $verif_data1['c_cabinet'];
                                    }
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
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead style="text-align: center;">
                                            <th style="width:5%">No</th>
                                            <th>Detail NG</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // data cabinet
                                            $jumlah_ng = 0;
                                            $cab_list = array();
                                            $nolist = 0;
                                            $cb_sql = mysqli_query($connect_pro, "SELECT * FROM formng_listcabinet WHERE c_status = 'enable'");
                                            while ($cb_data = mysqli_fetch_array($cb_sql)) {
                                                $cab_list[$nolist] = $cb_data['c_name'];
                                                $nolist++;
                                            }
                                            $count_cablist = count($cab_list);

                                            $sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number'");
                                            $data = mysqli_fetch_array($sql);
                                            if (empty($data)) {
                                                // kosong
                                            ?>
                                                <tr>
                                                    <td colspan="2" style="text-align: center;">Tidak ada data</td>
                                                </tr>
                                                <?php
                                            } else {
                                                // tidak kosong

                                                $sql = mysqli_query($connect_pro, "SELECT DISTINCT  c_numberng, c_ng FROM formng_resultong WHERE c_serialnumber = '$serial_number' ORDER BY c_numberng ASC");
                                                while ($data = mysqli_fetch_array($sql)) {
                                                    $idbutton = $serial_number . $data['c_numberng'];
                                                    // list cabinet aktif
                                                    $cab_active = array();
                                                    $nolist = 0;
                                                    $active_sql = mysqli_query($connect_pro, "SELECT c_cabinet, c_repaired FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = $data[c_numberng]");
                                                    while ($active_data = mysqli_fetch_array($active_sql)) {
                                                        $cab_active[] = array($active_data['c_cabinet'], $active_data['c_repaired']);
                                                        $nolist++;
                                                    }
                                                    $count_cabactive = count($cab_active);

                                                    // warna pena untuk nama ng
                                                    $merah_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_process = 'oc1'");
                                                    $merah_data = mysqli_fetch_array($merah_sql);
                                                    if (!empty($merah_data)) {
                                                        $warna_pen = '#DC4646';
                                                    } else {
                                                        $hijau_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_process = 'oc2'");
                                                        $hijau_data = mysqli_fetch_array($hijau_sql);
                                                        if (!empty($hijau_data)) {
                                                            $warna_pen = '#5AA65A';
                                                        } else {
                                                            $biru_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_process = 'oc3'");
                                                            $biru_data = mysqli_fetch_array($biru_sql);
                                                            if (!empty($biru_data)) {
                                                                $warna_pen = '#1340FF';
                                                            } else {
                                                                $warna_pen = '#000000';
                                                            }
                                                        }
                                                    }
                                                ?>
                                                    <!-- isi -->
                                                    <tr>
                                                        <td rowspan="2" style="text-align: center;">
                                                            <div class="row">
                                                                <div class="col-12 mb-4">
                                                                    <?= $data['c_numberng'] ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="font-weight: bold; color: <?= $warna_pen ?>;">
                                                            <div class="row">
                                                                <div class="col-12"><?= $data['c_ng'] ?></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <ul>

                                                                <?php
                                                                for ($a = 0; $a < $count_cabactive; $a++) {
                                                                    // warna pena untuk nama cabinet
                                                                    $c_cabinet = $cab_active[$a][0];
                                                                    $merah_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_cabinet = '$c_cabinet' AND c_process = 'oc1'");
                                                                    $merah_data = mysqli_fetch_array($merah_sql);
                                                                    if (!empty($merah_data)) {
                                                                        $warna_pen = '#DC4646';
                                                                    } else {
                                                                        $hijau_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_cabinet = '$c_cabinet' AND c_process = 'oc2'");
                                                                        $hijau_data = mysqli_fetch_array($hijau_sql);
                                                                        if (!empty($hijau_data)) {
                                                                            $warna_pen = '#5AA65A';
                                                                        } else {
                                                                            $biru_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_cabinet = '$c_cabinet' AND c_process = 'oc3'");
                                                                            $biru_data = mysqli_fetch_array($biru_sql);
                                                                            if (!empty($biru_data)) {
                                                                                $warna_pen = '#1340FF';
                                                                            } else {
                                                                                $warna_pen = '#000000';
                                                                            }
                                                                        }
                                                                    }
                                                                ?>

                                                                    <?php
                                                                    // cek sudah repair atau belum
                                                                    if ($cab_active[$a][1] != '') {
                                                                    ?>
                                                                        <div class="containere">
                                                                            <button class="bton retro" style="width:100px; border-radius: 0px; font-size: 10px; opacity: 70%; top: 9px; left: 70%; background-color: <?= $warna_pen ?>; "><?= $cab_active[$a][1] ?></button>
                                                                        </div>
                                                                        <li style="color: <?= $warna_pen ?>;">
                                                                            <strike><?= $cab_active[$a][0] ?></strike>
                                                                        </li>
                                                                    <?php
                                                                    } else {
                                                                        $jumlah_ng++;
                                                                    ?>
                                                                        <li style="color: <?= $warna_pen ?>;">
                                                                            <?= $cab_active[$a][0] ?>
                                                                        </li>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <!-- isi -->
                                            <?php
                                                }
                                            }

                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <br>
                            <!-- gambar 1 info -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="containere">
                                        <img src="../image/furniture/tbo.png" style="width:100%; opacity: 60%;">
                                        <?php
                                        $c_section = 'ftbo';
                                        $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial_number';");
                                        while ($data = mysqli_fetch_array($sql)) {
                                            $isi = array();
                                            $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$data[c_code]'");
                                            while ($data1 = mysqli_fetch_array($sql1)) {
                                                $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                                            }
                                            $countisi = count($isi);
                                        ?>
                                            <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
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
                            <!-- gambar 1 info -->
                            <br>
                            <hr>
                            <br>
                            <!-- gambar 2 info -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="containere">
                                        <img src="../image/furniture/tbi.png" style="width:100%; opacity: 60%;">
                                        <?php
                                        $c_section = 'ftbi';
                                        $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial_number';");
                                        while ($data = mysqli_fetch_array($sql)) {
                                            $isi = array();
                                            $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$data[c_code]'");
                                            while ($data1 = mysqli_fetch_array($sql1)) {
                                                $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                                            }
                                            $countisi = count($isi);
                                        ?>
                                            <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
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
                            <!-- gambar 2 info -->
                            <br>
                            <hr>
                            <br>
                            <!-- gambar 3 info -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="containere">
                                        <img src="../image/furniture/uk.png" style="width:100%; opacity: 60%;">
                                        <?php
                                        $c_section = 'fuk';
                                        $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial_number';");
                                        while ($data = mysqli_fetch_array($sql)) {
                                            $isi = array();
                                            $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$data[c_code]'");
                                            while ($data1 = mysqli_fetch_array($sql1)) {
                                                $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                                            }
                                            $countisi = count($isi);
                                        ?>
                                            <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
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
                            <!-- gambar 3 info -->
                            <br>
                            <hr>
                            <br>
                            <!-- gambar 4 info -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="containere">
                                        <img src="../image/furniture/b.png" style="width:100%; opacity: 60%;">
                                        <?php
                                        $c_section = 'fb';
                                        $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial_number';");
                                        while ($data = mysqli_fetch_array($sql)) {
                                            $isi = array();
                                            $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$data[c_code]'");
                                            while ($data1 = mysqli_fetch_array($sql1)) {
                                                $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                                            }
                                            $countisi = count($isi);
                                        ?>
                                            <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
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
                            <!-- gambar 4 info -->
                            <br>
                            <hr>
                            <br>
                            <!-- gambar 5 info -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="containere">
                                        <img src="../image/furniture/bb.png" style="width:100%; opacity: 60%;">
                                        <?php
                                        $c_section = 'fbb';
                                        $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial_number';");
                                        while ($data = mysqli_fetch_array($sql)) {
                                            $isi = array();
                                            $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$data[c_code]'");
                                            while ($data1 = mysqli_fetch_array($sql1)) {
                                                $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                                            }
                                            $countisi = count($isi);
                                        ?>
                                            <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
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
                            <!-- gambar 5 info -->
                            <br>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 mb-3 text-center">
                            <form id="sendnextdata">
                                <input type="hidden" name="serialnumber" value="<?= $serial_number ?>">
                                <input type="hidden" name="process" value="<?= $process ?>">
                            </form>
                            <?php
                            // cek jika data sudah di kirim
                            $sql_next = mysqli_query($connect_pro, "SELECT c_outcheck1by FROM formng_register WHERE c_serialnumber = '$serial_number'");
                            $data_next = mysqli_fetch_array($sql_next);
                            if ($data_next['c_outcheck1by'] != '') {
                            ?>
                                <button disabled type="button" id="sendnext" class="btn btn-success">Data telah dikirim <i class="fa fa-thumbs-up"></i></button>
                            <?php
                            } else {
                                // cek apakah sudah bisa send to next atau belum
                                if ($jumlah_ng == 0) {
                                    $disable = '';
                                } else {
                                    $disable = 'disabled';
                                }
                            ?>
                                <button <?= $disable ?> type="button" id="sendnext" class="btn btn-success">Kirim ke Outside Check 2</button>
                                <script>
                                    $(document).ready(function() {
                                        $('#sendnext').click(function() {
                                            Swal.fire({
                                                title: 'Apakah anda yakin?',
                                                text: "Pastikan hasil repair sudah sesuai",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Yes, send it!'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    var isi = $('#sendnextdata').serializeArray();
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'insertform2_next.php',
                                                        data: isi,
                                                        success: function(dataResult) {
                                                            var dataResult = JSON.parse(dataResult);
                                                            if (dataResult.statusCode == 200) {
                                                                Swal.fire({
                                                                    title: 'Berhasil!',
                                                                    text: 'Data piano berhasil dikirim ke Outside Check 2!',
                                                                    icon: 'success',
                                                                    timer: 2000,
                                                                    showCancelButton: false,
                                                                    showConfirmButton: false
                                                                }).then(function() {
                                                                    window.location = 'main.php?p=dash';
                                                                });
                                                            } else if (dataResult.statusCode == 201) {
                                                                Swal.fire({
                                                                    position: 'center',
                                                                    icon: 'error',
                                                                    title: 'Server bermasalah!',
                                                                    showConfirmButton: false,
                                                                    timer: 2000
                                                                })
                                                            }
                                                        }
                                                    });
                                                }
                                            })
                                        })
                                    })
                                </script>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <?php
                    // jika klik button bisa diserahkan ke repair
                    if (isset($_POST['str'])) {
                        //cek apakah nama tukang validasi sama dengan tukang check
                        $sql = mysqli_query($connect_pro, "SELECT c_checker FROM formng_resultro WHERE c_serialnumber = '$serial_number' AND c_process = 'oc1' limit 1");
                        $data = mysqli_fetch_array($sql);
                        $checker1 = $data['c_checker'];
                        if ($checker1 == $_SESSION['nama']) {
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
                        } else {
                            ?>
                            <script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        title: 'Validasi ditolak!',
                                        html: 'PIC checker dan PIC validasi harus sama<br>untuk serial number ini harus divalidasi oleh <u><?= $checker1 ?></u> !',
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

                <div class="tab-pane fade" id="completeness" role="tabpanel" aria-labelledby="completeness-tab">
                    <div class="row" style="padding-top: 0px;">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">
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
                                                <div class="col-4">
                                                    Model :
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12" style="text-align: center; font-size: 15px;"><u><?= $pianoname ?></u></div>
                                            </div>
                                        </th>
                                    </tr>

                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead style="text-align: center;">
                                    <th style="width: 33%;">Pengecek 1</th>
                                    <th style="width: 33%;">Pengecek 2</th>
                                    <th style="width: 33%;">Pengecek 3</th>
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
                                                $date_complete1 = date('d-m-Y H:i:s', strtotime($date_complete1));
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
                                                $date_complete2 = date('d-m-Y H:i:s', strtotime($date_complete2));
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
                                                $date_complete3 = date('d-m-Y H:i:s', strtotime($date_complete3));
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
                                                <div class="col-12">
                                                    Tanggal : <?= $date_complete1 ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    Tanggal : <?= $date_complete2 ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0px; height: 20px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    Tanggal : <?= $date_complete3 ?>
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
                                    <th>Nama Item</th>
                                    <th style="width: fit-content;">Cek1</th>
                                    <th style="width: fit-content;">Cek2</th>
                                    <th style="width: fit-content;">Cek3</th>
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
                                                    if (!empty($data6['c_repairdate3'])) {
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
                </div>
            </div>
        </div>
    </div>
</div>