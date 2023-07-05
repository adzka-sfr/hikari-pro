<?php
require_once "config/koneksi.php";
require_once "config/koneksi_mysql.php";

$query_takerest = mysqli_query($con, "select rslt_point, name, link from display_rsltpoint");

$vals = array();
$name_rest = array();
$link = array();
while($takerest = mysqli_fetch_array($query_takerest)){
	$vals[]=$takerest['rslt_point'];
	$name_rest[]=$takerest['name'];
	$link[] = $takerest['link'];
}


$queryArr = array();

foreach ($vals as $arr)
{
$queryArr[] = "SELECT count(B_ACTY.D0600.HMCD) AS TOTAL_ACT FROM B_ACTY.D0600 WHERE B_ACTY.D0600.TKPOINT='$arr' AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD')";
}
$query_select = implode(' UNION ALL ',$queryArr);

	$exc_ora = oci_parse($connection,$query_select);
	oci_execute($exc_ora);
	
?>


					<div class="widget-box noPrint">
						<div class="widget-header">
							<h4 class="widget-title lighter">
								<?php echo date('l, d-m-Y'); ?>
							</h4>
						</div>

						<div class="widget-body">

							<div class="widget-main">
								<table class="table table-bordered table-striped">
								<tr>
									<th class="center">
									ALL RESULT POINT [ASSY UP]
									</th>
														
									<th class="center">
									TOTAL RESULT
									</th>													
								</tr>

								

								<?php 
									$i = 0;
									while($dt_count = oci_fetch_array($exc_ora)){
								?>
								<tr>
									<td>
										<a CLASS = "RED" href= <?php echo $link[$i]; ?> ><?php echo $name_rest[$i]; ?></a>
									</td>
									<td class="center">
										<b style="font-size:20px"><?php echo $dt_count ['TOTAL_ACT']; ?></b>
									</td>
								</tr>
								<?php

										$i++;
									}
								?>

								

								</table>	
								
								
										
							</div>
						</div>	
					</div>