
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		
		<title>Display Productions</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../../../_bootstrap/css/bootstrap.min.css">
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
		<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->

		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/chosen.min.css" />
		
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/colorbox.min.css" />
		
		    <!-- This is what you need -->
			<script src="assets/dist/sweetalert.js"></script>
			<link rel="stylesheet" href="assets/dist/sweetalert.css">
			<link href="assets/assets/docs.css" rel="stylesheet">
			<!--.......................-->
		
		<!-- <script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="assets/js/dataTables.buttons.min.js"></script>
		<script src="assets/js/buttons.flash.min.js"></script>
		<script src="assets/js/buttons.html5.min.js"></script>
		<script src="assets/js/buttons.print.min.js"></script>
		<script src="assets/js/buttons.colVis.min.js"></script>
		<script src="assets/js/dataTables.select.min.js"></script> -->
		

		<!-- text fonts 
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" /> -->

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

<style>
 @media print {
   .noPrint{
      display: none !important;
   }

}


</style>


<?PHP
$post = isset($_POST['takerespoint']) ? $_POST['takerespoint']:'';


	if ( $post !=="") 
	{

	session_start();
	
	$_SESSION['point'] = substr($post,0,2);
	$_SESSION['nmpoint'] = substr($post,3);
	$_SESSION['inisial'] = substr($post,0,1);

	include "config/koneksi_mysql.php";
	date_default_timezone_set('Asia/Jakarta');
	$tkpoint = $_SESSION['point'];
	$curr_time_m = date('Y-m-d');
	$sel_totalplan = mysqli_query($con,"select qty_plan, working_time from display_plantemp where rslt_point = '$tkpoint' and plan_date = '$curr_time_m'");
	$data_plan = mysqli_fetch_array($sel_totalplan);
	$taktime = $data_plan['working_time']/$data_plan['qty_plan'];
	$n_taktime = round($taktime,2);

?>

	<body class="no-skin" onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
		<div id="navbar" class="navbar navbar-default">
			<div class="navbar-container" id="navbar-container">

				<div class="navbar-header pull-left">
					<a href="index.php" class="navbar-brand">
						<img src="assets/images/header.png" height="30" />
					</a>
					
				</div>
				
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<h5></h5>
											<i class="ace-icon fa fa-hand-o-right white bigger-100"></i>
											<a href="logout.php" class="white">Change Point</a>
										
										
				</div>

			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			
			</script>

			<div class="main-content">
				<div class="main-content-inner">

					<div class="page-content">

						<div class="row">
						
					<!--	<div id="result_all" class="col-xs-3"></div>	-->
						<div class="col-xs-12">
									<div class="widget-box noPrint" >
																	
												<div class="widget-header widget-header-flat">
													<h4 class="widget-title lighter">
														<b>Production Display<b>
														<div class="pull-right">
															
														<b>Takt Time : <a class="green"><?php  echo $n_taktime;?> Menit/Unit</a></b>&nbsp;&nbsp;
														Clock: <b class="red"><span id="clock"></b></span> &nbsp;</div>
													</h4>
													
													
												</div>

										<div class="widget-body">

										<div class="widget-main">						
						
										<div id="pagedata" ></div>
												
										</div>
										</div>
									</div>
						
						
						</div>					

						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer noPrint">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Hikari &copy; <?php echo date('Y');?></span>
						</span>

					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		
<!-- inline scripts related to this page -->
<script type="text/javascript">
$(document).ready(function(){

//	$('#result_all').load('allrakerest.php').fadeIn("slow");
	$('#pagedata').load('pagedata.php').fadeIn();

var auto_refresh = setInterval(function(){
//	$('#result_all').load('allrakerest.php').fadeIn("slow");
	$('#pagedata').load('pagedata.php').fadeIn("slow");
},30000);

});

    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function tampilkanwaktu(){
        //buat object date berdasarkan waktu saat ini
        var waktu = new Date();
        //ambil nilai jam, 
        //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length
        var sh = waktu.getHours() + ""; 
        //ambil nilai menit
        var sm = waktu.getMinutes() + "";
        //ambil nilai detik
        var ss = waktu.getSeconds() + "";
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }


</script>

		
	</body>
	<?php
	}else{
		 echo '<script language="javascript">alert("Please select taking result point !"); document.location="index.php";</script>';
	}
	?>
</html>

