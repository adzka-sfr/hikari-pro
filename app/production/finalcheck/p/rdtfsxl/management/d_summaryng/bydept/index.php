<?php
include '../../../config.php';
?>
<script src="<?= base_url('_assets/src/add/jquery/jquery-3.4.1.js') ?>"></script>
<script src="<?= base_url('_assets/src/add/datatables_bootstrap5/datatables.js') ?>"></script>
<!-- <script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script> -->
<script src="<?= base_url('_assets/src/add/dropdown_search/select2.min.js') ?>"></script>
<!-- <script src="../source/dropdown_search/select2.min.js"></script> -->
<script src="<?= base_url('_assets/src/add/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>
<!-- <script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script> -->
<script src="<?= base_url('_assets/src/add/EChart/echarts.js') ?>"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<table class="table table-bordered dothemagictotable">
    <thead style="text-align: center;">
        <th>Jenis NG</th>
        <th style="width: 15%;">Bulan lalu</th>
        <th style="width: 15%;">Bulan ini</th>
        <th>Fluktuasi</th>
    </thead>
    <tbody>
        <?php
        $bulan1 = date('Y-m', strtotime("-1month", strtotime($now)));
        $bulan2 = date('Y-m', strtotime($now));

        // get data dept inside ga diambil karena masih satu departemen dengan qc

        $q3 = mysqli_query($connect_pro, "SELECT DISTINCT c_dept FROM finalcheck_list_ng WHERE c_dept != 'inside'");
        while ($d3 = mysqli_fetch_array($q3)) {
            // get data last month
            $q1 = mysqli_query($connect_pro, "SELECT COUNT(a.c_code_ng) as total FROM finalcheck_outside a INNER JOIN finalcheck_list_ng b ON a.c_code_ng = b.c_code_ng WHERE a.c_result_date LIKE '$bulan1%' AND b.c_dept = '$d3[c_dept]'");
            $d1 = mysqli_fetch_array($q1);

            // get data this month
            $q2 = mysqli_query($connect_pro, "SELECT COUNT(a.c_code_ng) as total FROM finalcheck_outside a INNER JOIN finalcheck_list_ng b ON a.c_code_ng = b.c_code_ng WHERE a.c_result_date LIKE '$bulan2%' AND b.c_dept = '$d3[c_dept]'");
            $d2 = mysqli_fetch_array($q2);

            // count percentage
            $bulan_lalu = $d1['total'];
            $bulan_ini = $d2['total'];

            if ($bulan_lalu == 0) {
                $persen = ($bulan_ini / 1) * 100;
            } else {
                $persen = (($bulan_ini - $bulan_lalu) / $bulan_lalu) * 100;
                $persen = number_format($persen, 2, '.', '');
            }
        ?>
            <tr>
                <td><?= $d3['c_dept'] ?></td>
                <td style="text-align: center;"><?= $bulan_lalu ?></td>
                <td style="text-align: center;"><?= $bulan_ini ?></td>
                <td style="text-align: right;">
                    <?= $persen ?>%
                    <sup>
                        <?php
                        if ($persen < 0) {
                        ?>
                            <img style="height: 10px;" src="<?= base_url('_assets/production/icons/parts/down-green.png') ?>" alt="UP">
                        <?php
                        } elseif ($persen > 0) {
                        ?>
                            <img style="height: 10px;" src="<?= base_url('_assets/production/icons/parts/up-red.png') ?>" alt="UP">
                        <?php
                        } else {
                        ?>
                            <img style="height: 10px;" src="<?= base_url('_assets/production/icons/parts/minus.png') ?>" alt="UP">
                        <?php
                        }
                        ?>
                    </sup>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<script>
    $('.dothemagictotable').DataTable({
        scrollY: '700px',
        scrollCollapse: true,
        paging: false,
    });
</script>