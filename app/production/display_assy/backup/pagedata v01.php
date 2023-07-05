
<?php
	include "koneksi.php";
	
	$itemcode_post = isset($_POST['itemcode']) ? $_POST['itemcode']:'';

	if ( $itemcode_post !=="") 
	{
	$sql0 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS') as DT_RESULT 
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";
	
	$sql1 = "SELECT * FROM B_ACTY.D0600 WHERE TO_CHAR(B_ACTY.D0600.PLNDT,'YYYY/MM/DD')=TO_CHAR(sysdate,'YYYY/MM/DD') AND
            B_ACTY.D0600.TKPOINT='$itemcode_post'";
	
	$statment0 = oci_parse($connection,$sql0);
	oci_execute($statment0);
	
	$statment1 = oci_parse($connection,$sql1);
	oci_execute($statment1);
	oci_fetch_all($statment1,$results);
	$plan = oci_num_rows($statment1);
	$no = 1;
	
	}	
?>


<div class="widget-box" style="page-break-before:auto">
												
								<div class="widget-body">
								<div class="row">
									<div class="col-xs-12">
									
										<div class="widget-box transparent">
											<div class="widget-body">
												<div class="widget-main padding-24">
													
														<table class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th class="center">#</th>
																	<th>GMC</th>
																	<th>Name</th>
																	<th>Result date</th>

																</tr>
															</thead>

															<tbody>
															<?php 
																$no = 1;
																while($baris=oci_fetch_array($statment4))
															{ ?>
																<tr>
																	<td class="center"><?php echo $no ?></td>
																	<td><?php echo $baris['HMCD']; ?></td>
																	<td><?php echo $baris['HMNM']; ?></td>
																	<td><?php echo $baris['DT_RESULT']; ?></td>
							
																</tr>
																
															<?php
															$no++;
															}
															?>
															</tbody>
														</table>

													</div>
																									
												</div>

											</div>
											
										</div>				


								</div>

								</div>
</div>