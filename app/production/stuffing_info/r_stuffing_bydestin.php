<?php

//$month = $_POST['month'];
//$year = $_POST['year'];
        $month = date('m');
		$year = date('Y');
		$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
?>

<style>
                    .table-condensed{
                    font-size: 15px;
                    }
</style>
<script src="dist/echarts.min.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">

<div class="col-md-6 col-sm-6 col-xs-12">
<div id="grafik_up" style="height:300px;"></div>
			<?php echo "<h4>Data Stuffing UP ".$months[$month - 1]." ".$year."</h4>";?>

	<table class="table table-bordered table-condensed">
			<thead class="alert-success">
				<tr>
                <th width="5%" >No.</th>
                <th width="35%">Destinasi</th>
				<th width="15%">Plan</th>
                <th width="15%">Actual</th>
                <th width="15%">Balance</th>
				<th width="15%">Ratio</th>
				</tr>
			</thead>
			<tbody style="background-color:#fff;">
				<?php
									
					$queryup = mysqli_query($con_prodinfo, "SELECT destin_cd, destin_name, sum(total_qty) as t_qty FROM tb_planstuffing2 where class='UP' && YEAR(plan) = '$year' AND MONTH(plan) = '$month' 
                    group by destin_cd, destin_name ORDER BY t_qty DESC");
                    $n = 1;
                    $destin_up = array();
					$t_qtyup = array();
					$arr_t_actup = array();
                    $blnceup = array();
                    $arr_destin_prog_up = array();
					while($fetchup = mysqli_fetch_array($queryup)){
								$dataqtyup = $fetchup['destin_cd'];
								
								$select_actup = mysqli_query($con_prodinfo, "SELECT buyer_cd, count(buyer_cd) AS t_act from tb_stuffing where YEAR(vanning_date) = '$year' AND MONTH(vanning_date) = '$month' && buyer_cd = '$dataqtyup' && acard_no like 'U%' group by buyer_cd");
								$fetchupactup = mysqli_fetch_assoc($select_actup);
								$dtqty_actup = isset($fetchupactup['t_act']) ? $fetchupactup['t_act'] : 0;
					
				?>
				<tr>
                    <td><?php echo $n;?></td>
					<td><?php echo "[".$fetchup['destin_cd']."]  ".$fetchup['destin_name']; ?></td>
					<td align="center"><?php echo $fetchup['t_qty'];?></td>
					<td align="center"><?php echo $dtqty_actup;?></td>
                    <?php if($dtqty_actup-$fetchup['t_qty'] < 0){
                        $csl_lnce_up = "red";
                    }else{
                        $csl_lnce_up = "blue";
                    } ?>
                    <td align="center"><b class = "<?php echo $csl_lnce_up;?>" ><?php echo $dtqty_actup-$fetchup['t_qty']?> </b></td>
					<td align="right"><b class = "green"><?php echo round(($dtqty_actup/$fetchup['t_qty'])*100,1) . " %";?></b></td>
				</tr>
				<?php
				$t_qtyup[] = $fetchup['t_qty'];
				$arr_t_actup[] = $dtqty_actup;
                $destin_up[]= "'[".$fetchup['destin_cd']."]  ".$fetchup['destin_name']."'";
                $blnceup[]= abs($dtqty_actup-$fetchup['t_qty']);
                $arr_destin_prog_up[] = round(($dtqty_actup/$fetchup['t_qty'])*100,1);
                $n++;
					}
				?>
				<tr class="btn-dark">
					<td align="center" colspan=2><b>Total</b> </td>
					<td align="center"><b><?php echo array_sum($t_qtyup);?></b></td>
					<td align="center"><b><?php echo array_sum($arr_t_actup);?></b></td>
					<td align="center"><b><?php echo array_sum($arr_t_actup)-array_sum($t_qtyup);?></b></td>
					<td align="right"><b><?php echo round((array_sum($arr_t_actup)/array_sum($t_qtyup))*100,1) . " %";?></b></td>
				</tr>
			</tbody>
		</table>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
				<div id="grafik_gp" style="height:300px;"></div>
			<?php echo "<h4>Data Stuffing GP ".$months[$month - 1]." ".$year."</h4>";?>
		<table class="table table-bordered table-condensed">
			<thead class="alert-success">
				<tr>
                <th width="5%" >No.</th>
                <th width="35%">Destinasi</th>
				<th width="15%">Plan</th>
                <th width="15%">Actual</th>
                <th width="15%">Balance</th>
				<th width="15%">Ratio</th>
				</tr>
			</thead>
			<tbody style="background-color:#fff;">
				<?php
									
					$query = mysqli_query($con_prodinfo, "SELECT destin_cd, destin_name, sum(total_qty) as t_qty FROM tb_planstuffing2 where class = 'GP' && YEAR(plan) = '$year' AND MONTH(plan) = '$month' 
                    group by destin_cd, destin_name ORDER BY t_qty DESC");
                    $n = 1;
                    $destin_gp = array();
					$t_qty = array();
					$arr_t_actgp=array();
                    $blncegp = array();
                    $arr_destin_prog_gp = array();
					while($fetch = mysqli_fetch_array($query)){
								$byr_cd1 = $fetch['destin_cd'];
								$select_actgp = mysqli_query($con_prodinfo, "SELECT buyer_cd, count(buyer_cd) AS t_act from tb_stuffing where YEAR(vanning_date) = '$year' AND MONTH(vanning_date) = '$month' && buyer_cd = '$byr_cd1' && acard_no like 'G%' group by buyer_cd");
								$fetchupactgp = mysqli_fetch_assoc($select_actgp);
								$dtqty_actgp = isset($fetchupactgp['t_act']) ? $fetchupactgp['t_act'] : 0;
                    
				?>
				<tr>
                    <td><?php echo $n;?></td>
					<td><?php echo "[".$fetch['destin_cd']."]  ".$fetch['destin_name']; ?></td>
					<td align="center"><?php echo $fetch['t_qty'];?></td>
					<td align="center"><?php echo $dtqty_actgp;?></td>
                    <?php if($dtqty_actgp-$fetch['t_qty'] < 0){
                        $csl_lnce_gp = "red";
                    }else{
                        $csl_lnce_gp = "blue";
                    } ?>
                    <td align="center"><b class="<?php echo $csl_lnce_gp;?>" > <?php echo $dtqty_actgp-$fetch['t_qty'];?></b></td>
					<td align="right"><b class = "green"><?php echo round(($dtqty_actgp/$fetch['t_qty'])*100,1) . " %";?></b></td>
				</tr>
				<?php
				$t_qty[] = $fetch['t_qty'];
				$arr_t_actgp[] = $dtqty_actgp;
                $destin_gp[]= "'[".$fetch['destin_cd']."]  ".$fetch['destin_name']."'";
                $blncegp[]= abs($dtqty_actgp-$fetch['t_qty']);
                $arr_destin_prog_gp[] = round(($dtqty_actgp/$fetch['t_qty'])*100,1);
                $n++;
					}
				?>
				<tr class="btn-dark">
					<td align="center" colspan=2><b>Total</b> </td>
					<td align="center"><b><?php echo array_sum($t_qty);?></b></td>
					<td align="center"><b><?php echo array_sum($arr_t_actgp);?></b></td>
					<td align="right"><b><?php echo array_sum($arr_t_actgp)-array_sum($t_qty);?></b></td>
					<td align="right"><b><?php echo round((array_sum($arr_t_actgp)/array_sum($t_qty))*100,1) . " %";?></b></td>
				</tr>
			</tbody>
		</table>
				</div>

                </div>
        </div>
    </div>
</div>
<script type="text/javascript">
// Initialize the echarts instance based on the prepared dom

var myChart = echarts.init(document.getElementById('grafik_up'));
var myChart2 = echarts.init(document.getElementById('grafik_gp'));

// Specify the configuration items and data for the chart
var option = {
    title: {
    text: 'Piano UP Destination',
    },
    grid: {
      bottom: 100
    },
    tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'cross',
      crossStyle: {
        color: '#999'
      }
    }
  },
    legend: {
    data: ['Plan', 'Actual','Remaining','Rasio'],
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
        axisLabel: {fontSize: 9, interval: 0, rotate: 30 },
        data: [<?php echo implode(",", $destin_up); ?>]
        
    }],
    yAxis: [
    {
      type: 'value',
      name: 'Daily Qty',
      axisLabel: {
        formatter: '{value}'
      }
    },
    {
      type: 'value',
      name: 'Rasio',
      axisLabel: {
        formatter: '{value}%'
      }
    }
  ],
    series: [{
            name: 'Plan',
            type: 'bar',
            barGap: 0,
            data: [<?php echo implode(",", $t_qtyup); ?>],
            itemStyle: {
                normal: {
                    label: {
                        position: 'top',
                        show: false,
                        color: 'blue',
                        textStyle: {
                            fontWeight: 50
                        }
                    }
                }
            },
        },
        {
            name: 'Actual',
            type: 'bar',
            stack: 'Ad',
            data: [<?php echo implode(",", $arr_t_actup); ?>],
            itemStyle: {
                normal: {
                    label: {
                        position: 'top',
                        show: false,
                        color: 'green',
                        textStyle: {
                            fontWeight: 50
                        }
                    }
                }
            },
        },
            {
                name: 'Remaining',
                type: 'bar',
                stack: 'Ad',
                data: [<?php echo implode(",", $blnceup); ?>],
                itemStyle: {
                    normal: {
                        label: {
                            position: 'top',
                            show: false,
                            color: 'orange',
                            textStyle: {
                                fontWeight: 50
                            }
                        }
                    }
                },
            },
        {
        name: 'Rasio',
        type: 'line',
        smooth: true,
        yAxisIndex: 1,
        tooltip: {
            valueFormatter: function (value) {
            return value + ' %';
            }
        },
        data: [
            <?php echo implode(",", $arr_destin_prog_up); ?>
        ],
        markPoint: {
            data: [
            { type: 'max', name: 'Max'},
            { type: 'min', name: 'Min' }
            ],
            
        },
        }
    ]
};

var option2 = {
    title: {
    text: 'Piano GP Destination',
    },
    grid: {
      bottom: 100
    },
    tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'cross',
      crossStyle: {
        color: '#999'
      }
    }
  },
    legend: {
    data: ['Plan', 'Actual', 'Remaining', 'Rasio'],
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
        axisLabel: {fontSize: 9, interval: 0, rotate: 30 },
        data: [<?php echo implode(",", $destin_gp); ?>]
        
    }],
    yAxis: [
    {
      type: 'value',
      name: 'Daily Qty',
      axisLabel: {
        formatter: '{value}'
      }
    },
    {
      type: 'value',
      name: 'Rasio',
      axisLabel: {
        formatter: '{value}%'
      }
    }
  ],
    series: [{
            name: 'Plan',
            type: 'bar',
            barGap: 0,
            data: [<?php echo implode(",", $t_qty); ?>],
            itemStyle: {
                normal: {
                    label: {
                        position: 'top',
                        show: false,
                        color: 'blue',
                        textStyle: {
                            fontWeight: 50
                        }
                    }
                }
            },
        },
        {
            name: 'Actual',
            type: 'bar',
            stack: 'Ad',
            data: [<?php echo implode(",", $arr_t_actgp); ?>],
            itemStyle: {
                normal: {
                    label: {
                        position: 'top',
                        show: false,
                        color: 'green',
                        textStyle: {
                            fontWeight: 50
                        }
                    }
                }
            },
        },
        {
            name: 'Remaining',
            type: 'bar',
            stack: 'Ad',
            data: [<?php echo implode(",", $blncegp); ?>],
            itemStyle: {
                normal: {
                    label: {
                        position: 'top',
                        show: false,
                        color: 'orange',
                        textStyle: {
                            fontWeight: 50
                        }
                    }
                }
            },
        },

        {
        name: 'Rasio',
        type: 'line',
        smooth: true,
        yAxisIndex: 1,
        tooltip: {
            valueFormatter: function (value) {
            return value + ' %';
            }
        },
        data: [
            <?php echo implode(",", $arr_destin_prog_gp); ?>
        ],
        markPoint: {
            data: [
            { type: 'max', name: 'Max'},
            { type: 'min', name: 'Min' }
            ],
            
        },
        }
        
        
    ]
};

// Display the chart using the configuration items and data just specified.
myChart.setOption(option);
myChart2.setOption(option2);

</script>