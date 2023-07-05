<script src="dist/echarts.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../../../_assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<?php

include "config/koneksi_mysql.php";
	date_default_timezone_set('Asia/Jakarta');
	session_start();
	$itemcode_post = $_SESSION['point'];
	$nmpoint = $_SESSION['nmpoint'];
	$inisial = $_SESSION['inisial'];

	if ($inisial == 'G'){
		$bagian = "Assy GP";
	}else{
		$bagian = "Assy UP";
	}

	$bagian = "Assy UP";
	$curr_time = date('Y-m-d');
	$sel_totalplan = mysqli_query($con,"select qty_plan, working_time from display_plantemp where rslt_point = '$itemcode_post' and plan_date = '$curr_time'");
	$total_plan = mysqli_fetch_array($sel_totalplan);
	$taktime_p = $total_plan['working_time']/$total_plan['qty_plan'];
	$tktime = round($taktime_p,2);

	$qry_tresult = mysqli_query($con,"select sum(act_qty) as t_result from tb_rslt_mbody where tk_point = '$itemcode_post' and act_date like '$curr_time%' ");
	$total_result = mysqli_fetch_array($qry_tresult);

	$balance= $total_result['t_result'] - $total_plan['qty_plan'];
	$prog= round(($total_result['t_result']/ $total_plan['qty_plan'])*100,1);

	if ($balance<0){
		$warna = "red";
	}else{
		$warna = "green";
	}

	
	$jam = array();

	for ($x = 7; $x <= 23 ; $x++) {
		$jam[]=sprintf('%02d',$x);
	}

	$qry_jam_res = array();
	
	foreach($jam as $jam_arr){
		$qry_jam_res[] = "select sum(act_qty) as qtyperjam from tb_rslt_mbody where tk_point = '$itemcode_post' and act_date like '$curr_time%' and time_format(act_date, '%H') = '$jam_arr'";
	}
	
	$qry_slct_res = implode(' UNION ALL ',$qry_jam_res);
	$exc_qry_jam = mysqli_query($con , $qry_slct_res);

	

	$sekarang= strtotime('now');
	$checkday = date('l');
	$arr_workingtime = array();
	$d_result = $total_result['t_result'];
	if($checkday != 'Friday'){

		$query_work_t = mysqli_query($con,"select waktu from tb_work_hours where bagian = '$bagian' and  hari = 'Not Friday'");
		while ($dt_work_t = mysqli_fetch_array($query_work_t)){
			$arr_workingtime[] = $dt_work_t['waktu'];
		}

	}else{
		$query_work_t = mysqli_query($con,"select waktu from tb_work_hours where bagian = '$bagian' and  hari = 'Friday'");
		while ($dt_work_t = mysqli_fetch_array($query_work_t)){
			$arr_workingtime[] = $dt_work_t['waktu'];
		}
	}

		$mulai = strtotime($arr_workingtime[0]);
		$break1 = strtotime($arr_workingtime[1]);
		$mulai1 = strtotime($arr_workingtime[2]);
		$break2 = strtotime($arr_workingtime[3]);
		$mulai2 = strtotime($arr_workingtime[4]);
		$break3 = strtotime($arr_workingtime[5]);
		$mulai3 = strtotime($arr_workingtime[6]);

		$down_time1 = ($mulai1 - $break1);
		$down_time2 = ($mulai2 - $break2) + $down_time1;
		$down_time3 = ($mulai3 - $break3) + $down_time2;

		if($sekarang < $break1){
			$selisih= floor(($sekarang-$mulai)/60);
			$realtarget = floor($selisih/$tktime);
			$tk_balance =  $d_result - $realtarget;	
			$performance = round(($total_result['t_result']/ $realtarget)*100,1);

		}elseif($sekarang > $mulai1 and $sekarang < $break2){
					
			$selisih= floor((($sekarang - $mulai) - $down_time1)/60); //WAKTU SEKARANG DIKURANG coffe break
			$realtarget = floor($selisih/$tktime);
			$tk_balance =  $d_result - $realtarget;	
			$performance = round(($total_result['t_result']/ $realtarget)*100,1);
			
		}elseif($sekarang > $mulai2 and $sekarang < $break3){ 

			$selisih= floor((($sekarang-$mulai)-$down_time2)/60); //WAKTU SEKARANG DIKURANG  60 MENIT (ISTIRAHAT 10 MENIT DAN 50 MENIT) DIJADIKAN SATUAN DETIK (60*60)
			$realtarget = floor($selisih/$tktime);
			$tk_balance =  $d_result - $realtarget;	
			$performance = round(($total_result['t_result']/ $realtarget)*100,1);
			
		}elseif($sekarang > $mulai3){
			$selisih= floor((($sekarang-$mulai)-$down_time3)/60); //WAKTU SEKARANG DIKURANG  90 MENIT (ISTIRAHAT 10 MENIT, 50 MENIT, 30 MENIT) DIJADIKAN SATUAN DETIK (180*60)
			$realtarget = floor($selisih/$tktime);
			$tk_balance =  $d_result - $realtarget;
			$performance = round(($total_result['t_result']/ $realtarget)*100,1);
		}else{
			$realtarget = 0;
			$tk_balance = 0;
			$performance = 0;
		}	

		if ($tk_balance<0){
			$warna2 = "red";
		}else{
			$warna2 = "green";
		}

		$one_hours = 60;

		// warna progress bar
		if ($prog <= 30) {
			$bg = 'bg-danger';
			$setup = 'font-weight: 1000;';
		} elseif ($prog > 30 && $prog <= 70) {
			$bg = 'bg-success';		
			$setup = 'font-weight: 1000;';
		} elseif ($prog > 70) {
			$bg = 'bg-Primary';
			$setup = 'font-weight: 1000; text-align: left;  padding-left: 40%;';
		}
		
		
			$qty_jam = array();
			while($dt_result_jam = mysqli_fetch_array($exc_qry_jam)){
				$qty_jam[]= isset($dt_result_jam['qtyperjam'])?$dt_result_jam['qtyperjam']:0;
			}
	

?>

<div class="row">

<div class = "col-md-12">

<div class="page-header ">
							<h1>
								<b style="font-size: 35px"><?php echo $nmpoint; ?></b>
							</h1>
</div><!-- /.page-header -->

</div>


<div class="col-md-6">

				<table class="table table-bordered table-striped">
					<tr>
						<th class="center" width="33%"><b style="font-size: 20px">Total Plan</b></th>
						<th class="center" width="33%"><b style="font-size: 20px">Total Actual</b></th>
						<th class="center" width="33%"><b style="font-size: 20px">Balance</b></th>
					</tr>
																

					<tr>
						<th class="center blue"><b style="font-size: 80px"><?php  echo $total_plan['qty_plan'];?></b></th>
						<th class="center"><b style="font-size: 80px"><?php  echo $total_result['t_result'];?></b></th>
						<th class="center"><b style="font-size: 80px" class="<?php echo $warna; ?>"><?php echo $balance;?></b></th>
					</tr>

				</table>


</div>

<div class="col-md-1"></div>


<div class="col-md-5">

		<table class="table table-bordered table-striped">

			<tr>
				<th class="center" width="50%"><b style="font-size: 20px">Realtime Target</b></th>
				<th class="center" width="50%"><b style="font-size: 20px">Realtime Balance</b></th>
			</tr>

			<tr>
	    		<td class="center" height="60px"><b class="blue" style="font-size: 80px"><?php echo $realtarget;?></b></td>
    			<td class="center" height="60px"><b class="<?php echo $warna2; ?>" style="font-size: 80px"><?php echo $tk_balance;?></b></td>
			</tr>												
        </table>

</div>

<div class="col-md-7">
<!-- <div id="actual_grafik" style="height:190px;"></div>  -->
<span style="font-weight: 1000; margin-bottom: 0px; color: #5C7186;"><h3><b>Actual Progress</b></h3></span>
<div class="progress" style="border-radius: 4px; margin-bottom: 10px; height:30px;">
 <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style=" font-size: 20px; <?= $setup ?>  width: <?= $prog ?>%; "><?= $prog ?>%</div>
</div>
</div>

<div class="col-md-5 center">
<div id="perform_grafik" style="height:310px;"></div>
</div>


</div>

<script type="text/javascript">

// Initialize the echarts instance based on the prepared dom

// var myChart = echarts.init(document.getElementById('actual_grafik'));
var myChart2 = echarts.init(document.getElementById('perform_grafik'));

var option = {
    title: {
    text: 'Actual Hourly Chart',
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
    data: ['Actual'],
    right: '10%'
    },
    toolbox: {
        show: true,
        orient: 'vertical',
        left: 'right',
        top: 'center',
        feature: {
            mark: { show: true },
            magicType: { show: true, type: ['line', 'bar'] },
            dataView: {
                show: true,
                readOnly: false
            },
            restore: {
                show: true
            },
            saveAsImage: {
                show: true
            }
        }
    },
    calculable: true,
    xAxis: [{
        type: 'category',
        // prettier-ignore
        axisLabel: {fontSize: 15, interval: 0, rotate: 0 },
        data: [<?php echo implode(",", $jam); ?>]
        
    }],
    yAxis: [{
        type: 'value',
		axisLabel: {fontSize: 12, interval: 0, rotate: 0 }
    }],
    series: [
        {
            name: 'Actual',
            type: 'line',
            data: [<?php echo implode(",", $qty_jam); ?>],
            itemStyle: {
                normal: {
                    label: {
                        position: 'top',
                        show: true,
                        textStyle: {
							fontSize: 15,
                            fontWeight: 'bold'
                        }
                    }
                }
            },
        }
    ]
};

option_perform = {
	title: {
	left: "center",
    text: 'Realtime Target Performance',
    },
  series: [
    {
      type: 'gauge',
      splitNumber: 10,
      pointer: {
        itemStyle: {
          color: 'auto',
          shadowColor: 'rgba(0,138,255,0.45)',
            shadowBlur: 10,
            shadowOffsetX: 2,
            shadowOffsetY: 2
        }
      },
      axisLine: {
        lineStyle: {
          width: 20,
          color:[  [0.3, '#fd666d'],
                    [0.7, '#67e0e3'],
                    [1, '#37a2da']
                 ]
        }
      },
      axisTick: {
        distance: -20,
        length: 8,
        lineStyle: {
          color: '#fff',
          width: 1
        }
      },
      splitLine: {
        distance: -20,
        length: 20,
        lineStyle: {
          color: '#fff',
          width: 2
        }
      },
      axisLabel: {
        color: 'auto',
        distance: 25,
        fontSize: 13
      },
      detail: {
        valueAnimation: true,
        formatter: '{value} %',
        color: 'auto'
      },
      data: [
        {
          value: <?php echo $performance; ?>
        }
      ]
    }
  ]
};

// myChart.setOption(option);
myChart2.setOption(option_perform);

</script>

