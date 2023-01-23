<br>
<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="furniture-tab" data-toggle="tab" href="#furniture" role="tab" aria-controls="furniture" aria-selected="true">Furniture</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="silent-tab" data-toggle="tab" href="#silent" role="tab" aria-controls="silent" aria-selected="false">Silent</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="polyester-tab" data-toggle="tab" href="#polyester" role="tab" aria-controls="polyester" aria-selected="false">Polyester</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="furniture" role="tabpanel" aria-labelledby="furniture-tab">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                        <th style="width: 5%;">No</th>
                        <th>Nama Proses</th>
                        <th style="width: 20%;">Total Temuan</th>
                        <th style="width: 20%;">Status</th>
                    </thead>
                    <tbody>
                        <?php
                        $thismonth = date('Y-m', strtotime($now));
                        $lastmonth = date('Y-m', strtotime('-1month', strtotime($now)));

                        $no = 0;
                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_checkcomplete WHERE c_type = 'f' order by id asc");

                        while ($data = mysqli_fetch_array($sql)) {
                            $no++;
                            $total_cab11 = 0;

                            // THIS MONTH //
                            //cek pada hasil pengecekan outside
                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result1 = 'NO' AND c_inspectiondate1 LIKE '$thismonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab1 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result2 = 'NO' AND c_inspectiondate2 LIKE '$thismonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab2 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result3 = 'NO'  AND c_inspectiondate3 LIKE '$thismonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab3 = $data2['total'];

                            $total_cab11 = $total_cab1 + $total_cab2 + $total_cab3;

                            // LAST MONTH //
                            //cek pada hasil pengecekan outside
                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result1 = 'NO' AND c_inspectiondate1 LIKE '$lastmonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab1 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result2 = 'NO' AND c_inspectiondate2 LIKE '$lastmonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab2 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result3 = 'NO'  AND c_inspectiondate3 LIKE '$lastmonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab3 = $data2['total'];

                            $total_cab22 = $total_cab1 + $total_cab2 + $total_cab3;

                            //get data persentase status
                            if ($total_cab22 == 0) {
                                $persen = ($total_cab11 / 1) * 100;
                            } else {
                                $persen = (($total_cab11 - $total_cab22) / $total_cab22) * 100;
                                $persen = number_format($persen, 2, '.', '');
                            }

                        ?>
                            <tr>
                                <td style="text-align: center; vertical-align:top;padding-top:15px;"><?= $no ?></td>
                                <td style="vertical-align:top;padding-top:15px;"><?= $data['c_partname'] ?></td>
                                <td style="text-align: center; vertical-align:top;padding-top:15px;"><?= $total_cab11 ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($total_cab11 > $total_cab22) {
                                    ?>
                                        <div class="row">
                                            <div class="col-6" style="text-align: left;">
                                                <img style="height: 30px;" src="<?= base_url('_assets/production/icons/parts/up-red.png') ?>" alt="UP">
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                <span><?= $persen ?>%</span>
                                            </div>
                                        </div>
                                    <?php
                                    } elseif ($total_cab11 < $total_cab22) {
                                    ?>
                                        <div class="row">
                                            <div class="col-6" style="text-align: left;">
                                                <img style="height: 30px;" src="<?= base_url('_assets/production/icons/parts/down-green.png') ?>" alt="DOWN">
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                <span><?= $persen ?>%</span>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="row">
                                            <div class="col-6" style="text-align: left;">
                                                <img style="height: 30px;" src="<?= base_url('_assets/production/icons/parts/minus.png') ?>" alt="MINUS">
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                <span><?= $persen ?>%</span>
                                            </div>
                                        </div>
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

    <div class="tab-pane fade" id="silent" role="tabpanel" aria-labelledby="silent-tab">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                        <th style="width: 5%;">No</th>
                        <th>Nama Proses</th>
                        <th style="width: 20%;">Total Temuan</th>
                        <th style="width: 20%;">Status</th>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_checkcomplete WHERE c_type = 's' order by id asc");

                        while ($data = mysqli_fetch_array($sql)) {
                            $no++;
                            $total_cab11 = 0;

                            // THIS MONTH //
                            //cek pada hasil pengecekan outside
                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result1 = 'NO' AND c_inspectiondate1 LIKE '$thismonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab1 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result2 = 'NO' AND c_inspectiondate2 LIKE '$thismonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab2 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result3 = 'NO'  AND c_inspectiondate3 LIKE '$thismonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab3 = $data2['total'];

                            $total_cab11 = $total_cab1 + $total_cab2 + $total_cab3;

                            // LAST MONTH //
                            //cek pada hasil pengecekan outside
                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result1 = 'NO' AND c_inspectiondate1 LIKE '$lastmonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab1 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result2 = 'NO' AND c_inspectiondate2 LIKE '$lastmonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab2 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result3 = 'NO'  AND c_inspectiondate3 LIKE '$lastmonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab3 = $data2['total'];

                            $total_cab22 = $total_cab1 + $total_cab2 + $total_cab3;

                            //get data persentase status
                            if ($total_cab22 == 0) {
                                $persen = ($total_cab11 / 1) * 100;
                            } else {
                                $persen = (($total_cab11 - $total_cab22) / $total_cab22) * 100;
                                $persen = number_format($persen, 2, '.', '');
                            }

                        ?>
                            <tr>
                                <td style="text-align: center; vertical-align:top;padding-top:15px;"><?= $no ?></td>
                                <td style="vertical-align:top;padding-top:15px;"><?= $data['c_partname'] ?></td>
                                <td style="text-align: center; vertical-align:top;padding-top:15px;"><?= $total_cab11 ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($total_cab11 > $total_cab22) {
                                    ?>
                                        <div class="row">
                                            <div class="col-6" style="text-align: left;">
                                                <img style="height: 30px;" src="<?= base_url('_assets/production/icons/parts/up-red.png') ?>" alt="UP">
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                <span><?= $persen ?>%</span>
                                            </div>
                                        </div>
                                    <?php
                                    } elseif ($total_cab11 < $total_cab22) {
                                    ?>
                                        <div class="row">
                                            <div class="col-6" style="text-align: left;">
                                                <img style="height: 30px;" src="<?= base_url('_assets/production/icons/parts/down-green.png') ?>" alt="DOWN">
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                <span><?= $persen ?>%</span>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="row">
                                            <div class="col-6" style="text-align: left;">
                                                <img style="height: 30px;" src="<?= base_url('_assets/production/icons/parts/minus.png') ?>" alt="MINUS">
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                <span><?= $persen ?>%</span>
                                            </div>
                                        </div>
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

    <div class="tab-pane fade" id="polyester" role="tabpanel" aria-labelledby="polyester-tab">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                        <th style="width: 5%;">No</th>
                        <th>Nama Proses</th>
                        <th style="width: 20%;">Total Temuan</th>
                        <th style="width: 20%;">Status</th>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_checkcomplete WHERE c_type = 'p' order by id asc");

                        while ($data = mysqli_fetch_array($sql)) {
                            $no++;
                            $total_cab11 = 0;

                            // THIS MONTH //
                            //cek pada hasil pengecekan outside
                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result1 = 'NO' AND c_inspectiondate1 LIKE '$thismonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab1 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result2 = 'NO' AND c_inspectiondate2 LIKE '$thismonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab2 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result3 = 'NO'  AND c_inspectiondate3 LIKE '$thismonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab3 = $data2['total'];

                            $total_cab11 = $total_cab1 + $total_cab2 + $total_cab3;

                            // LAST MONTH //
                            //cek pada hasil pengecekan outside
                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result1 = 'NO' AND c_inspectiondate1 LIKE '$lastmonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab1 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result2 = 'NO' AND c_inspectiondate2 LIKE '$lastmonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab2 = $data2['total'];

                            $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_code) as total FROM formng_resultc WHERE c_code = '$data[c_code]' AND c_result3 = 'NO'  AND c_inspectiondate3 LIKE '$lastmonth%'");
                            $data2 = mysqli_fetch_array($sql2);
                            $total_cab3 = $data2['total'];

                            $total_cab22 = $total_cab1 + $total_cab2 + $total_cab3;

                            //get data persentase status
                            if ($total_cab22 == 0) {
                                $persen = ($total_cab11 / 1) * 100;
                            } else {
                                $persen = (($total_cab11 - $total_cab22) / $total_cab22) * 100;
                                $persen = number_format($persen, 2, '.', '');
                            }

                        ?>
                            <tr>
                                <td style="text-align: center; vertical-align:top;padding-top:15px;"><?= $no ?></td>
                                <td style="vertical-align:top;padding-top:15px;"><?= $data['c_partname'] ?></td>
                                <td style="text-align: center; vertical-align:top;padding-top:15px;"><?= $total_cab11 ?></td>
                                <td style="text-align: center; ">
                                    <?php
                                    if ($total_cab11 > $total_cab22) {
                                    ?>
                                        <div class="row">
                                            <div class="col-6" style="text-align: left;">
                                                <img style="height: 30px;" src="<?= base_url('_assets/production/icons/parts/up-red.png') ?>" alt="UP">
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                <span><?= $persen ?>%</span>
                                            </div>
                                        </div>
                                    <?php
                                    } elseif ($total_cab11 < $total_cab22) {
                                    ?>
                                        <div class="row">
                                            <div class="col-6" style="text-align: left;">
                                                <img style="height: 30px;" src="<?= base_url('_assets/production/icons/parts/down-green.png') ?>" alt="DOWN">
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                <span><?= $persen ?>%</span>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="row">
                                            <div class="col-6" style="text-align: left;">
                                                <img style="height: 30px;" src="<?= base_url('_assets/production/icons/parts/minus.png') ?>" alt="MINUS">
                                            </div>
                                            <div class="col-6" style="text-align: right;">
                                                <span><?= $persen ?>%</span>
                                            </div>
                                        </div>
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