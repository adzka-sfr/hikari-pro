<?php
include '../config.php';
$workcenter = $_POST['workcenter'];

// koneksi kstaff
$username = "B_ACTY";
$password = "SYSTEM";
$db = "(DESCRIPTION =
			(ADDRESS_LIST =
			  (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521))
			)
			(CONNECT_DATA =
			  (SERVICE_NAME = YIKSTAFF)
			)
		)";
$connection = oci_connect($username, $password, $db);
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
        <th style="width: 20%;">GMC</th>
        <th>Name</th>
        <th style="width: 20%;">Standart Time</th>
    </thead>
    <tbody>
        <?php
        $q1 = mysqli_query($connect_pro, "SELECT c_gmc, c_stdval FROM manpow_st WHERE c_workcenter = '$workcenter'");
        while ($d1 = mysqli_fetch_array($q1)) {
            $sql1 =
                "SELECT B_ACTY.M0010.HMNM AS NAMA FROM B_ACTY.M0010 WHERE B_ACTY.M0010.HMCD = '$d1[c_gmc]'";

            $statment1 = oci_parse($connection, $sql1);
            oci_execute($statment1);
            $data = oci_fetch_array($statment1);
        ?>
            <tr>
                <td style="text-align: center;"><?= $d1['c_gmc'] ?></td>
                <td><?= $data['NAMA'] ?></td>
                <td style="text-align: center;"><?= $d1['c_stdval'] ?></td>
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