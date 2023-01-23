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
                $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_section FROM formng_basecoor order by id asc");
                $thismonth = date('Y-m', strtotime($now));
                $lastmonth = date('Y-m', strtotime('-1month', strtotime($now)));

                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                    $total_cab11 = 0;
                    $total_cab22 = 0;
                    $nama_proses = substr($data['c_section'], 2);
                    $nama_proses = ucwords($nama_proses);

                    // THIS MONTH //
                    //cek pada hasil pengecekan outside
                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_section) as total FROM formng_resulto1 WHERE c_section = '$data[c_section]' AND c_ng1 != '' AND c_inspectiondate1 LIKE '$thismonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_cab1 = $data2['total'];

                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_section) as total FROM formng_resulto1 WHERE c_section = '$data[c_section]' AND c_ng2 != '' AND c_inspectiondate2 LIKE '$thismonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_cab2 = $data2['total'];

                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_section) as total FROM formng_resulto1 WHERE c_section = '$data[c_section]' AND c_ng3 != '' AND c_inspectiondate3 LIKE '$thismonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_cab3 = $data2['total'];

                    $total_cab11 = $total_cab1 + $total_cab2 + $total_cab3;

                    // LAST MONTH //
                    //cek pada hasil pengecekan outside
                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_section) as total FROM formng_resulto1 WHERE c_section = '$data[c_section]' AND c_ng1 != '' AND c_inspectiondate1 LIKE '$lastmonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_cab1 = $data2['total'];

                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_section) as total FROM formng_resulto1 WHERE c_section = '$data[c_section]' AND c_ng2 != '' AND c_inspectiondate2 LIKE '$lastmonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_cab2 = $data2['total'];

                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_section) as total FROM formng_resulto1 WHERE c_section = '$data[c_section]' AND c_ng3 != '' AND c_inspectiondate3 LIKE '$lastmonth%'");
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
                        <td style="text-align: center;"><?= $no ?></td>
                        <td><?= $nama_proses ?></td>
                        <td style="text-align: center;"><?= $total_cab11 ?></td>
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