<div class="row">
    <div class="col-12">
        <script>
            $(document).ready(function() {
                $('#table_ng_ng').DataTable({
                    paging: false
                });

            });
        </script>
        <table id="table_ng_ng" class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width: 5%;">No</th>
                <th>Jenis NG</th>
                <th style="width: 20%;">Total Temuan</th>
                <th style="width: 20%;">Status</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_listng order by id asc");
                $thismonth = date('Y-m', strtotime($now));
                $lastmonth = date('Y-m', strtotime('-1month', strtotime($now)));

                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                    $total_ng11 = 0;
                    $total_ng22 = 0;


                    //get data pada bulan ini
                    //cek pada hasil pengecekan inside
                    $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_detail) as total FROM formng_resulti WHERE c_detail = '$data[c_ng]' AND c_inspectiondate LIKE '$thismonth%'");
                    $data1 = mysqli_fetch_array($sql1);
                    $total_ng1 = $data1['total'];

                    //cek pada hasil pengecekan outside
                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_ng1) as total FROM formng_resulto1 WHERE c_ng1 = '$data[c_ng]' AND c_inspectiondate1 LIKE '$thismonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_ng2a = $data2['total'];

                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_ng2) as total FROM formng_resulto1 WHERE c_ng2 = '$data[c_ng]' AND c_inspectiondate2 LIKE '$thismonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_ng2b = $data2['total'];

                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_ng3) as total FROM formng_resulto1 WHERE c_ng3 = '$data[c_ng]' AND c_inspectiondate3 LIKE '$thismonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_ng2c = $data2['total'];

                    $total_ng11 = $total_ng1 + $total_ng2a + $total_ng2b + $total_ng2c;

                    //get data bulan lalu untung perbandingan
                    //cek pada hasil pengecekan inside
                    $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_detail) as total FROM formng_resulti WHERE c_detail = '$data[c_ng]' AND c_inspectiondate LIKE '$lastmonth%'");
                    $data1 = mysqli_fetch_array($sql1);
                    $total_ng1 = $data1['total'];

                    //cek pada hasil pengecekan outside
                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_ng1) as total FROM formng_resulto1 WHERE c_ng1 = '$data[c_ng]' AND c_inspectiondate1 LIKE '$lastmonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_ng2a = $data2['total'];

                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_ng2) as total FROM formng_resulto1 WHERE c_ng2 = '$data[c_ng]' AND c_inspectiondate2 LIKE '$lastmonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_ng2b = $data2['total'];

                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_ng3) as total FROM formng_resulto1 WHERE c_ng3 = '$data[c_ng]' AND c_inspectiondate3 LIKE '$lastmonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_ng2c = $data2['total'];

                    $total_ng22 = $total_ng1 + $total_ng2a + $total_ng2b + $total_ng2c;

                    //get data persentase status
                    if ($total_ng22 == 0) {
                        $persen = ($total_ng11 / 1) * 100;
                    } else {
                        $persen = (($total_ng11 - $total_ng22) / $total_ng22) * 100;
                        $persen = number_format($persen, 2, '.', '');
                    }

                ?>
                    <tr>
                        <td style="text-align: center;  vertical-align:top;padding-top:15px;"><?= $no ?></td>
                        <td style=" vertical-align:top;padding-top:15px;"><?= $data['c_ng'] ?></td>
                        <td style="text-align: center; vertical-align:top;padding-top:15px;">
                            <?= $total_ng11 ?>
                        </td>
                        <td style="text-align: center;">
                            <?php
                            if ($total_ng11 > $total_ng22) {
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
                            } elseif ($total_ng11 < $total_ng22) {
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