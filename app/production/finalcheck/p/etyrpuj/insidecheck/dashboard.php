<?php
require('../config.php');
?>
<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<div class="row">
    <div class="col-12 mt-3">
        <h5>Hasil <b><?= $_SESSION['nama'] ?></b> hari ini, <b><?= date('d-m-Y', strtotime($now)) ?></b></h5>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <?php
        $hari_ini = date('Y-m-d', strtotime($now));
        $q1 = mysqli_query($connect_pro, "SELECT COUNT(a.c_serialnumber) as total FROM finalcheck_pic a INNER JOIN finalcheck_timestamp b ON a.c_serialnumber = b.c_serialnumber WHERE a.c_inside = '$_SESSION[nama]' AND b.c_inside_o LIKE '$hari_ini%' ");
        $d1 = mysqli_fetch_array($q1);
        $total_piano = $d1['total'];
        ?>
        <h6>Total : <?= $total_piano ?> piano</b>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered" style="font-size: 20px;">
            <thead style="text-align: center;">
                <th style="width: 5%;">No</th>
                <th>No Seri</th>
                <th style="width: 35%;">NG</th>
                <th style="width: 35%;">OK</th>
            </thead>
            <?php
            ?>
            <tbody style="text-align: center;">
                <?php
                if ($total_piano == 0) {
                ?>
                    <tr>
                        <td colspan="4">No Data</td>
                    </tr>
                    <?php
                } else {
                    $no = 0;
                    $q2 = mysqli_query($connect_pro, "SELECT a.c_serialnumber FROM finalcheck_pic a INNER JOIN finalcheck_timestamp b ON a.c_serialnumber = b.c_serialnumber WHERE a.c_inside = '$_SESSION[nama]' AND b.c_inside_o LIKE '$hari_ini%'");
                    while ($d2 = mysqli_fetch_array($q2)) {
                        $no++;

                        // get ng date
                        $q3 = mysqli_query($connect_pro, "SELECT c_result_date FROM finalcheck_inside WHERE c_serialnumber = '$d2[c_serialnumber]' AND c_result = 'NG'");
                        $d3 = mysqli_fetch_array($q3);

                        // get ok date
                        $q4 = mysqli_query($connect_pro, "SELECT c_repair_inside_o FROM finalcheck_repairtime WHERE c_serialnumber = '$d2[c_serialnumber]'");
                        $d4 = mysqli_fetch_array($q4);
                        if (empty($d4['c_repair_inside_o'])) {
                            $ok_date = "Proses repair";
                        } else {
                            $ok_date = date('h:i A', strtotime($d4['c_repair_inside_o']));
                        }

                        if (empty($d3['c_result_date'])) {
                            $ng_date = '-';
                        } else {
                            $ng_date = $d3['c_result_date'];
                            $ng_date = date('h:i A', strtotime($ng_date));
                        }
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $d2['c_serialnumber'] ?></td>
                            <td><?= $ng_date ?></td>
                            <td><?= $ok_date ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>