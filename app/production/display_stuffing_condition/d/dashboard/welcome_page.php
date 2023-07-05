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

        <ul class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a data-toggle="tab" href="#resume">All Piano</a></li>
			<li role="presentation"><a data-toggle="tab" href="#Stuffing_progres_up">Piano UP</a></li>
			<li role="presentation"><a data-toggle="tab" href="#Stuffing_progres_gp">Piano GP</a></li>
			<li role="presentation"><a data-toggle="tab" href="#week3">Part</a></li>
		</ul>
		<div class="tab-content">
        <div id="Stuffing_progres_up" role="tabpanel" class="tab-pane" aria-labelledby="home-tab" style="padding:10px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                    <h2>Piano UP</h2>
                    <ul class="nav navbar-right panel_toolbox">				
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                    <?php 
                    include "stuffing_up.php"; 
                    ?>
            
                    </div>
                </div>
             </div>
        </div>

        <div id="Stuffing_progres_gp" role="tabpanel" class="tab-pane" aria-labelledby="home-tab" style="padding:10px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                    <h2>Piano UP</h2>
                    <ul class="nav navbar-right panel_toolbox">				
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                    <?php 
                    include "stuffing_gp.php"; 
                    ?>
            
                    
                    </div>
                </div>
             </div>
        </div>
        </div>

</div>

<?php 
//echo implode(',',$sum_totalplan_bydate);
?>