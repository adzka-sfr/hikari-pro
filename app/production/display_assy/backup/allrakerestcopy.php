<?php
require_once "koneksi.php";

	$sqltk0 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='B5' order by B_ACTY.D0600.ACTUALDT";
	
	$sqltk1 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='B4' order by B_ACTY.D0600.ACTUALDT";
							
	$sqltk2 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='U2' order by B_ACTY.D0600.ACTUALDT";

	$sqltk3 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='U3' order by B_ACTY.D0600.ACTUALDT";		

	$sqltk4 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='U4' order by B_ACTY.D0600.ACTUALDT";	

	$sqltk5 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='U5' order by B_ACTY.D0600.ACTUALDT";		

	$sqltk6 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='U7' order by B_ACTY.D0600.ACTUALDT";

	$sqltk7 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='G0' order by B_ACTY.D0600.ACTUALDT";

	$sqltk8 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='G1' order by B_ACTY.D0600.ACTUALDT";

	$sqltk9 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='G2' order by B_ACTY.D0600.ACTUALDT";	

	$sqltk10 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='G3' order by B_ACTY.D0600.ACTUALDT";

								
	$stmttk0 = oci_parse($connection,$sqltk0);
	oci_execute($stmttk0);
	oci_fetch_all($stmttk0,$result);
	$b5 = oci_num_rows($stmttk0);
	
	$stmttk1 = oci_parse($connection,$sqltk1);
	oci_execute($stmttk1);
	oci_fetch_all($stmttk1,$result);
	$b4 = oci_num_rows($stmttk1);	
	
	$stmttk2 = oci_parse($connection,$sqltk2);
	oci_execute($stmttk2);
	oci_fetch_all($stmttk2,$result);
	$u2 = oci_num_rows($stmttk2);
	
	$stmttk3 = oci_parse($connection,$sqltk3);
	oci_execute($stmttk3);
	oci_fetch_all($stmttk3,$result);
	$u3 = oci_num_rows($stmttk3);
	
	$stmttk4 = oci_parse($connection,$sqltk4);
	oci_execute($stmttk4);
	oci_fetch_all($stmttk4,$result);
	$u4 = oci_num_rows($stmttk4);

	$stmttk5 = oci_parse($connection,$sqltk5);
	oci_execute($stmttk5);
	oci_fetch_all($stmttk5,$result);
	$u5 = oci_num_rows($stmttk5);	
	
	$stmttk6 = oci_parse($connection,$sqltk6);
	oci_execute($stmttk6);
	oci_fetch_all($stmttk6,$result);
	$u7 = oci_num_rows($stmttk6);
	
	$stmttk7 = oci_parse($connection,$sqltk7);
	oci_execute($stmttk7);
	oci_fetch_all($stmttk7,$result);
	$g0 = oci_num_rows($stmttk7);
	
	$stmttk8 = oci_parse($connection,$sqltk8);
	oci_execute($stmttk8);
	oci_fetch_all($stmttk8,$result);
	$g1 = oci_num_rows($stmttk8);
	
	$stmttk9 = oci_parse($connection,$sqltk9);
	oci_execute($stmttk9);
	oci_fetch_all($stmttk9,$result);
	$g2 = oci_num_rows($stmttk9);
	
	$stmttk10 = oci_parse($connection,$sqltk10);
	oci_execute($stmttk10);
	oci_fetch_all($stmttk10,$result);
	$g3 = oci_num_rows($stmttk10);
	

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
														<th>
															All Result Point
														</th>
														
														<th class="center">
															Actual
														</th>													
														</tr>
														
														<tr>
														<td>
															
															<a id="b5"><b>[B5] UP Fixing Frame </b></a>
														</td>
														<td class="center">
															<?php echo $b5; ?>
														</td>
														</tr>
														
														<tr>
														<td>
															<a id="b4"><b>[B4] UP Stringing </b></a>
														</td>
														<td class="center">
															<?php echo $b4; ?>
														</td>
														</tr>
														
														<tr>
														<td>
															<a id="u2"><b>[U2] UP Side Glue </b></a>
														</td>
														<td class="center">
															<?php echo $u2; ?>
														</td>
														</tr>

														<tr>
														<td>
															<a id="u3"><b>[U3] UP 1st Regulation </b></a>
														</td>
														<td class="center">
															<?php echo $u3; ?>
														</td>
														</tr>

														<tr>
														<td>
															<a id="u4"><b>[U4] UP Out Seasoning </b></a>
														</td>
														<td class="center">
															<?php echo $u4; ?>
														</td>
														</tr>

														<tr>
														<td>
															<a id="u5"><b>[U5] UP Case Assy </b></a>
														</td>
														<td class="center">
															<?php echo $u5; ?>
														</td>
														</tr>

														<tr>
														<td>
															<a id="u7"><b>[U7] UP Packing </b></a>
														</td>
														<td class="center">
															<?php echo $u7; ?>
														</td>
														</tr>

														<tr>
														<td>
															<a id="g0"><b>[G0] GP Mounting </b></a>
														</td>
														<td class="center">
															<?php echo $g0; ?>
														</td>
														</tr>

														<tr>
														<td>
															<a id="g1"><b>[G1] GP Tunning II </b></a>
														</td>
														<td class="center">
															<?php echo $g1; ?>
														</td>
														</tr>

														<tr>
														<td>
															<a id="g2"><b>[G2] GP Tunning III </b></a>
														</td>
														<td class="center">
															<?php echo $g2; ?>
														</td>
														</tr>	

														<tr>
														<td>
															<a id="g3"><b>[G3] GP Packing </b></a>
														</td>
														<td class="center">
															<?php echo $g3; ?>
														</td>
														</tr>														
														
													</table>
												</div>
											</div>	
										</div>