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
                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_checkinside order by id asc");
                $thismonth = date('Y-m', strtotime($now));
                $lastmonth = date('Y-m', strtotime('-1month', strtotime($now)));

                while ($data = mysqli_fetch_array($sql)) {
                    $no++;

                    //cek pada hasil pengecekan outside this month
                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_item) as total FROM formng_resulti WHERE c_item = '$data[c_code]' AND c_status = 'NG' AND c_inspectiondate LIKE '$thismonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_cab11 = $data2['total'];

                    //cek pada hasil pengecekan outside last month
                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_item) as total FROM formng_resulti WHERE c_item = '$data[c_code]' AND c_status = 'NG' AND c_inspectiondate LIKE '$lastmonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_cab22 = $data2['total'];

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
                        <td style="vertical-align:top;padding-top:15px;"><?= $data['c_item'] ?></td>
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