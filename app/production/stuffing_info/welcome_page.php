<!-- ECharts -->
<script src="dist/echarts.min.js"></script>


<?php
//koneksi oracle ---->
date_default_timezone_set('Asia/Jakarta');

/*
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


if (!$connection) {
    $e = oci_error();
    echo htmlentities($e['message']);
    exit();
}
*/

$con_prodinfo = mysqli_connect("localhost","root","","prod_info");

// connection database prod_info
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">

            <?php include "r_stuffing_daily_up_gp.php"; ?>
            
            </div>
        </div>
    </div>
</div>

<?php 
//echo implode(',',$sum_totalplan_bydate);
?>