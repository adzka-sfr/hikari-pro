<div class="row">
    <div class="col-12">
        <script>
            $(document).ready(function() {
                $('#table_ng_dept').DataTable({
                    paging: false
                });

            });
        </script>
        <table id="table_ng_dept" class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width: 5px;">No</th>
                <th style="width: 300px;">Dept</th>
                <th style="width: 100px;">Total Temuan</th>
                <th style="width: 100px;">Status</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $sql = mysqli_query($connect_pro, "SELECT distinct c_dept FROM formng_listng order by id asc");
                $thismonth = date('Y-m', strtotime($now));
                $lastmonth = date('Y-m', strtotime('-1month', strtotime($thismonth)));

                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                    $total_ng11 = 0;
                    $total_ng22 = 0;

                    // THIS MONTH //

                    //cek pada hasil pengecekan outside
                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(r.c_ng) as total FROM formng_resultong r JOIN formng_listng l ON r.c_ng = l.c_ng WHERE l.c_dept = '$data[c_dept]' AND r.c_inspectiondate LIKE '$thismonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_ng2a = $data2['total'];

                    $total_ng11 = $total_ng2a;

                    // LAST MONTH //

                    //cek pada hasil pengecekan outside
                    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(r.c_ng) as total FROM formng_resultong r JOIN formng_listng l ON r.c_ng = l.c_ng WHERE l.c_dept = '$data[c_dept]' AND r.c_inspectiondate LIKE '$lastmonth%'");
                    $data2 = mysqli_fetch_array($sql2);
                    $total_ng2a = $data2['total'];

                    $total_ng22 = $total_ng2a;

                    //get data persentase status
                    if ($total_ng22 == 0) {
                        $persen = ($total_ng11 / 1) * 100;
                    } else {
                        $persen = (($total_ng11 - $total_ng22) / $total_ng22) * 100;
                        $persen = number_format($persen, 2, '.', '');
                    }

                ?>
                    <tr>
                        <td style="text-align: center; vertical-align:top;padding-top:15px;"><?= $no ?></td>
                        <td style="vertical-align:top;padding-top:15px;"><?= $data['c_dept'] ?></td>
                        <td style="text-align: center; vertical-align:top;padding-top:15px;"><?= $total_ng11 ?></td>
                        <td style="text-align: center; ">
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