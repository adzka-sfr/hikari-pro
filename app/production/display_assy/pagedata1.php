

<?php
	include "koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
	session_start();
	$itemcode_post = $_SESSION['point'];
	$nmpoint = $_SESSION['nmpoint'];
	$inisial = $_SESSION['inisial'];
	
	if ( $itemcode_post !=="") 
	{
	$sql0 = "SELECT B_ACTY.D0600.HMCD,B_ACTY.M0010.HMNM,to_char(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')
                            FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
                            B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";
	
	$sql1 = "SELECT * FROM B_ACTY.D0600 WHERE TO_CHAR(B_ACTY.D0600.PLNDT,'YYYY/MM/DD')=TO_CHAR(sysdate,'YYYY/MM/DD') AND
            B_ACTY.D0600.TKPOINT='$itemcode_post'";
	
	$sql2 = "SELECT * FROM B_ACTY.D0600 WHERE TO_CHAR(B_ACTY.D0600.PLNDT,'YYYY/MM/DD')>=concat(TO_CHAR(sysdate,'YYYY'), '/04/01') AND
            TO_CHAR(B_ACTY.D0600.PLNDT,'YYYY/MM/DD')<=TO_CHAR(sysdate,'YYYY/MM/DD') AND B_ACTY.D0600.TKPOINT='$itemcode_post'";
	
	$sql3 = "SELECT * FROM B_ACTY.D0600 WHERE TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=concat(TO_CHAR(sysdate,'YYYY'), '/04/01') AND
            TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')<=TO_CHAR(sysdate,'YYYY/MM/DD') AND B_ACTY.D0600.TKPOINT='$itemcode_post'";
			
	$sql4 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_8 
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('08:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";
	
	$sql5 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_9 
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('08:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('09:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";
	
	$sql6 = "SELECT  COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_10 
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('09:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('10:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";	

	$sql7 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_11  
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('10:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('11:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";

	$sql8 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_12  
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('11:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('12:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";		 
			 
	$sql9 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_13  
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('12:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('13:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";
	
	$sql10 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_14  
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('13:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('14:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";

	$sql11 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_15  
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('14:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('15:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";		 
			 
	$sql12 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_16  
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('15:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('16:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";

	$sql13 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_17  
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('16:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('17:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";

	$sql14 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_18  
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('17:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('18:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";		 
			 
	$sql15 = "SELECT COUNT(TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD HH24:MI:SS')) as JAM_19  
			 FROM B_ACTY.D0600, B_ACTY.M0010 WHERE B_ACTY.D0600.HMCD=B_ACTY.M0010.HMCD AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'YYYY/MM/DD')>=TO_CHAR(sysdate,'YYYY/MM/DD') AND
             TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')> TO_CHAR('18:00:00') AND TO_CHAR(B_ACTY.D0600.ACTUALDT,'HH24:MI:SS')<=TO_CHAR('19:00:00') AND B_ACTY.D0600.TKPOINT='$itemcode_post' order by B_ACTY.D0600.ACTUALDT";


	$statment0 = oci_parse($connection,$sql0);
	oci_execute($statment0);
	oci_fetch_all($statment0,$results0);
	$d_result = oci_num_rows($statment0);
	
	$statment1 = oci_parse($connection,$sql1);
	oci_execute($statment1);
	oci_fetch_all($statment1,$results1);
	$d_plan = oci_num_rows($statment1);
	
	$statment2 = oci_parse($connection,$sql2);
	oci_execute($statment2);
	oci_fetch_all($statment2,$results2);
	$r_plan = oci_num_rows($statment2);
	
	$statment3 = oci_parse($connection,$sql3);
	oci_execute($statment3);
	oci_fetch_all($statment3,$results3);
	$r_act = oci_num_rows($statment3);
	
	$statment4 = oci_parse($connection,$sql4);
	oci_execute($statment4);
	$r8 = oci_fetch_array($statment4);
	
	$statment5 = oci_parse($connection,$sql5);
	oci_execute($statment5);
	$r9 = oci_fetch_array($statment5);	
	
	$statment6 = oci_parse($connection,$sql6);
	oci_execute($statment6);
	$r10 = oci_fetch_array($statment6);

	$statment7 = oci_parse($connection,$sql7);
	oci_execute($statment7);
	$r11 = oci_fetch_array($statment7);

	$statment8 = oci_parse($connection,$sql8);
	oci_execute($statment8);
	$r12 = oci_fetch_array($statment8);	
	
	$statment9 = oci_parse($connection,$sql9);
	oci_execute($statment9);
	$r13 = oci_fetch_array($statment9);	

	$statment10 = oci_parse($connection,$sql10);
	oci_execute($statment10);
	$r14 = oci_fetch_array($statment10);	

	$statment11 = oci_parse($connection,$sql11);
	oci_execute($statment11);
	$r15 = oci_fetch_array($statment11);

	$statment12 = oci_parse($connection,$sql12);
	oci_execute($statment12);
	$r16 = oci_fetch_array($statment12);

	$statment13 = oci_parse($connection,$sql13);
	oci_execute($statment13);
	$r17 = oci_fetch_array($statment13);

	$statment14 = oci_parse($connection,$sql14);
	oci_execute($statment14);
	$r18 = oci_fetch_array($statment14);

	$statment15 = oci_parse($connection,$sql15);
	oci_execute($statment15);
	$r19 = oci_fetch_array($statment15);		
	
	$r_balance = $r_act - $r_plan;
	$balance = $d_result - $d_plan;
	
		if ($balance<0){
			$warna = "red";
		}else{
			$warna = "green";
		}
			if ($r_balance<0){
			$warna1 = "red";
		}else{
			$warna1 = "green";
		}
	
	
	}	

$cekdate = date('l');

if($cekdate!="Friday"){
	
		$mulai = strtotime('07:10:00');
		$break1 = strtotime('09:20:00');
		$mulai1 = strtotime('09:30:00');
		$break2 = strtotime('11:30:00');
		$mulai2 = strtotime('12:20:00');
		$break3 = strtotime('15:50:00');
		$mulai3 = strtotime('16:30:00');

				$sekarang= strtotime('now');

				if($inisial!="G"){
					$tktime = 4.79;
				}else{
					$tktime = 24;
				}

				if($sekarang < $break1){

					$selisih= floor(($sekarang-$mulai)/60);
					$realtarget = floor($selisih/$tktime);
					$tk_balance =  $d_result - $realtarget;	
					
				}elseif($sekarang > $mulai1 and $sekarang < $break2){

					$selisih= floor((($sekarang-$mulai)-600)/60);
					$realtarget = floor($selisih/$tktime);
					$tk_balance =  $d_result - $realtarget;	
					
				}elseif($sekarang > $mulai2 and $sekarang < $break3){

					$selisih= floor((($sekarang-$mulai)-(60*60))/60);
					$realtarget = floor($selisih/$tktime);
					$tk_balance =  $d_result - $realtarget;	
					
				}elseif($sekarang > $mulai3){
					$selisih= floor((($sekarang-$mulai)-(100*60))/60);
					$realtarget = floor($selisih/$tktime);
					$tk_balance =  $d_result - $realtarget;	
				}else{
					$realtarget = 0;
					$tk_balance = 0;
				}
		
		}else{
		$mulai = strtotime('07:10:00');
		$break1 = strtotime('09:20:00');
		$mulai1 = strtotime('09:30:00');
		$break2 = strtotime('11:30:00');
		$mulai2 = strtotime('12:50:00');
		$break3 = strtotime('16:20:00');
		$mulai3 = strtotime('17:00:00');

				$sekarang= strtotime('now');

				if($inisial!="G"){
					$tktime = 4.79;
				}else{
					$tktime = 24;
				}

				if($sekarang < $break1){

					$selisih= floor(($sekarang-$mulai)/60);
					$realtarget = floor($selisih/$tktime);
					$tk_balance =  $d_result - $realtarget;	
					
				}elseif($sekarang > $mulai1 and $sekarang < $break2){

					$selisih= floor((($sekarang-$mulai)-600)/60);
					$realtarget = floor($selisih/$tktime);
					$tk_balance =  $d_result - $realtarget;	
					
				}elseif($sekarang > $mulai2 and $sekarang < $break3){

					$selisih= floor((($sekarang-$mulai)-(90*60))/60);
					$realtarget = floor($selisih/$tktime);
					$tk_balance =  $d_result - $realtarget;	
					
				}elseif($sekarang > $mulai3){
					$selisih= floor((($sekarang-$mulai)-(130*60))/60);
					$realtarget = floor($selisih/$tktime);
					$tk_balance =  $d_result - $realtarget;	
				}else{
					$realtarget = 0;
					$tk_balance = 0;
				}		
		
		
}
	

		if ($tk_balance<0){
			$warna2 = "red";
		}else{
			$warna2 = "green";
		}

?>


<div class="row">
												

						<div class="page-header">
							<h1>
								<b style="font-size: 45px"><?php echo $nmpoint; ?></b>
							</h1>
						</div><!-- /.page-header -->
						
<div class="col-xs-12"></div>

<div class="col-xs-6">

				<table class="table table-bordered table-striped">
					<tr>
						<th class="center" width="33%"><b>Plan</b></th>
						<th class="center" width="33%"><b>Actual</b></th>
						<th class="center" width="33%"><b>Balance</b></th>
					</tr>
																

					<tr>
						<th class="center"><b style="font-size: 65px"><?php echo $d_plan;?></b></th>
						<th class="center"><b style="font-size: 65px"><?php echo $d_result;?></b></th>
						<th class="center"><b style="font-size: 65px" class="<?php echo $warna; ?>"><?php echo $balance;?></b></th>
					</tr>

				</table>


</div>

<div class="col-xs-1"></div>

<div class="col-xs-5">

													<table class="table table-bordered table-striped">

														<tr>
															<th class="center" width="50%"><b>Realtime Target</b></th>
															<th class="center" width="50%"><b>Balance</b></th>
														</tr>

														<tr>
															<td class="center" height="60px"><b class="blue" style="font-size: 65px"><?php echo $realtarget;?></b></td>
															<td class="center" height="60px"><b class="<?php echo $warna2; ?>" style="font-size: 65px"><?php echo $tk_balance;?></b></td>
														</tr>												
													</table>


</div>

<div class="col-xs-12">
	<table class="table table-bordered table-striped ">
		<tr>
			<td class="center" colspan="12"><b>HOURLY OUTPUT</b></td>
		</tr>
		<tr>
			<td class="center"><b>08:00</b></td>
			<td class="center"><b>09:00</b></td>
			<td class="center"><b>10:00</b></td>
			<td class="center"><b>11:00</b></td>
			<td class="center"><b>12:00</b></td>
			<td class="center"><b>13:00</b></td>
			<td class="center"><b>14:00</b></td>
			<td class="center"><b>15:00</b></td>
			<td class="center"><b>16:00</b></td>
			<td class="center"><b>17:00</b></td>
			<td class="center"><b>18:00</b></td>
			<td class="center"><b>19:00</b></td>
		</tr>
		<tr>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r8['JAM_8']; ?> </b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r9['JAM_9']; ?></b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r10['JAM_10']; ?></b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r11['JAM_11']; ?></b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r12['JAM_12']; ?></b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r13['JAM_13']; ?></b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r14['JAM_14']; ?></b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r15['JAM_15']; ?></b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r16['JAM_16']; ?></b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r17['JAM_17']; ?></b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r18['JAM_18']; ?></b></td>
			<td class="center"><b style="font-size: 30px"><?PHP echo $r19['JAM_19']; ?></b></td>
		</tr>
		
		
	</table>	
		
		
		
</div>
<div class = "col-xs-12">

	<table class="table table-bordered table-striped ">
		<tr>
			<td class="center" colspan="3"><b>RUIKE</b></td>
		</tr>
		<tr>
			<td class="center" height="35px">Acc. Plan:  <b class="blue"> <?php echo $r_plan;?></b></td>
			<td class="center" height="35px">Progress:  <b class="blue"> <?php echo $r_act;?></b></td>
			<td class="center" height="35px">Balance:  <b class="<?php echo $warna1; ?>"> <?php echo $r_balance;?></b></td>
		</tr>		
	</table>
</div>

</div>
											