<div class="row">
    <div class="col-12">
        <script>
            $(document).ready(function() {
                $('#table_ng_cabinet').DataTable({
                    paging: false
                });

            });
        </script>
        <table id="table_ng_cabinet" class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width: 5px;">No</th>
                <th style="width: 300px;">Kabinet</th>
                <th style="width: 100px;">Total Temuan</th>
                <th style="width: 100px;">Status</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_listcabinet order by id asc");
                $thismonth = date('Y-m', strtotime($now));
                $lastmonth = date('Y-m', strtotime('-1month', strtotime($thismonth)));

                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                    //cek pada hasil pengecekan outside bulan ini
                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_cabinet) as total FROM formng_resultong WHERE c_cabinet = '$data[c_name]' AND c_inspectiondate LIKE '$thismonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_cab1 = $data2['total'];

                    $total_cab11 = $total_cab1;

                    //cek pada hasil pengecekan outside bulan lalu
                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_cabinet) as total FROM formng_resultong WHERE c_cabinet = '$data[c_name]' AND c_inspectiondate LIKE '$lastmonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_cab1 = $data2['total'];

                    $total_cab22 = $total_cab1;

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
                        <td style="vertical-align:top;padding-top:15px;"><?= $data['c_name'] ?></td>
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