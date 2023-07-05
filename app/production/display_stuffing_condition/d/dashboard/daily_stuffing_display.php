<?php
// connection database kite_inventory
//$con_kite = mysqli_connect("103.44.27.247","root","YamahaMusic2014","db_inventory_yi");

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

$arr_day = array();
$arr_p = array();
$arr_a = array();
$arr_b = array();
$arr_acc_p = array();
$arr_acc_a = array();
$arr_acc_b = array();
//$first_day=new DateTime('first day of this month');
$first_date=new DateTime('first day of this month');
$f_date = date_format($first_date,'Y-m-d');
//$day = date_format($first_date,'d');
$curr_date = date('Y-m-d');
$temp_p = 0;
$temp_a = 0;
while($f_date <= $curr_date){

    $arr_day[] = "'".date("d",strtotime($f_date))."'";

    $query_plan = mysqli_query($con_prodinfo, "SELECT sum(total_qty) as t_qty FROM tb_planstuffing2 where plan = '$f_date'");
    $qty_p = mysqli_fetch_array($query_plan);
    $arr_p[] = $qty_p['t_qty'];
    $temp_p = $temp_p+$qty_p['t_qty'];
    $arr_acc_p[] = $temp_p;

    $query_act = mysqli_query($con_prodinfo, "SELECT count(buyer_cd) AS t_act FROM tb_stuffing where vanning_date like '$f_date%'");
    $qty_a = mysqli_fetch_array($query_act);
    if ($qty_a['t_act']==0){
        $arr_a[] = NULL; 
        $temp_a = $temp_a+0;
        $arr_acc_a[]=$temp_a;
    }else{
        $arr_a[] = $qty_a['t_act'];
        $temp_a = $temp_a+$qty_a['t_act'];
        $arr_acc_a[]=$temp_a;
    }
     
    $arr_b[] = $qty_a['t_act']-$qty_p['t_qty'];
    $arr_acc_b[]=$temp_a-$temp_p;

    $f_date = date("Y-m-d", strtotime("+1 day",strtotime($f_date)));
}

$slct_plan_today = mysqli_query($con_prodinfo,"select tb_fifo.buyer_code, count(tb_fifo.item_code) as total_qty, master_destination.destination_nm
from tb_fifo left join master_destination
on master_destination.destination = tb_fifo.buyer_code
where vanning_date = '$curr_date'
group by tb_fifo.buyer_code, master_destination.destination_nm");
$arry_plan_today = array();
$arry_act_today = array();
$no = 0;
while($dt_stuffing_today = mysqli_fetch_assoc($slct_plan_today)){
    $dt_stuffing_today_cd = $dt_stuffing_today['buyer_code'];
    $slct_act = mysqli_query($con_prodinfo,"select buyer_cd, count(item_cd) as total_act from tb_stuffing 
    where buyer_cd = '$dt_stuffing_today_cd' && vanning_date = '$curr_date'
    group by buyer_cd ");
    $dt_act_stuffing_today = mysqli_fetch_assoc($slct_act);
    $arry_act_today[$no] = array('buyer' => isset($dt_act_stuffing_today['buyer_cd'])?$dt_act_stuffing_today['buyer_cd']:NULL, 't_qty' => isset($dt_act_stuffing_today['total_act'])?$dt_act_stuffing_today['total_act']:0 );
    $arry_plan_today[$no] = array('buyer' => $dt_stuffing_today['buyer_code'], 'name' => $dt_stuffing_today['destination_nm'], 't_qty' => $dt_stuffing_today['total_qty'] );
$no++;
}

?>


<!-- ECharts -->
<script src="dist/echarts.min.js"></script>

                <style>
                    .table-condensed{
                    font-size: 13px;
                    }
                </style>

<div class="row">
    <div class="col-md-8" >
    <div class="x_panel" style="height:280px;">
            <div class="x_title">
                <h2>Today Stuffing Condition</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-calendar"></i>
                          </div>
                          <div class="count"><?php echo array_sum(array_map(fn ($arry_plan_today) => $arry_plan_today['t_qty'], $arry_plan_today));?> Unit</div>

                          <h3 style="color:royalblue"> <b>Plan 計画</b> </h3>
                          
                        </div>
                        <div>
                            <table width="100%" class="table table-striped table-bordered table-condensed">
                                <tr>
                                <td style = "background-color:darkorange;"><b style="color:white;">Container</b></td>
                                    <td align="center">40H</td>
                                    <td align="center">40</td>
                                    <td align="center">20</td>
                                </tr>
                                <tr>
                                <td style = "background-color:darkorange;"><b style="color:white;">Total Qty</b></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-check-square-o"></i>
                          </div>
                          <div class="count"><?php echo array_sum(array_map(fn ($arry_act_today) => $arry_act_today['t_qty'], $arry_act_today));?> Unit</div>

                          <h3 style="color:darkcyan"><b>Actual 実績</b></h3>
                          
                        </div>
                        <table width="100%" class="table table-striped table-bordered table-condensed">
                                <tr>
                                <td style = "background-color:darkorange;"><b style="color:white;">Container</b></td>
                                    <td align="center">40H</td>
                                    <td align="center">40</td>
                                    <td align="center">20</td>
                                </tr>
                                <tr>
                                <td style = "background-color:darkorange;"><b style="color:white;">Total Qty</b></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                </tr>
                            </table>
                    </div>

                    <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-line-chart"></i>
                          </div>
                          <div class="count"><a style = "color:red;"><?php echo array_sum(array_map(fn ($arry_act_today) => $arry_act_today['t_qty'], $arry_act_today)) - array_sum(array_map(fn ($arry_plan_today) => $arry_plan_today['t_qty'], $arry_plan_today)) ;?> </a> Unit</div>

                          <h3 style="color:chocolate"><b>Progress 進捗</b></h3>
                          
                        </div>
                        <table width="100%" class="table table-striped table-bordered table-condensed">
                                <tr>
                                    <td style = "background-color:darkorange;"><b style="color:white;">Container</b></td>
                                    <td align="center">40H</td>
                                    <td align="center">40</td>
                                    <td align="center">20</td>
                                </tr>
                                <tr>
                                    <td style = "background-color:darkorange;"><b style="color:white;">Total Qty</b></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                </tr>
                            </table>
                    </div>
            </div>
                    
        </div>
    </div>

    <div class="col-md-4" >
    <div class="x_panel" style="height:280px;">
            <div class="x_title">
                <h2><b>Destination Info.</b></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">


                            <table width="100%" class="table table-bordered table-condensed">
                                <tr>
                                <th align="center">No.</th>
                                    <td align="center"><b>Destination</b></td>
                                    <td align="center"><b>Plan (Unit)</b></td>
                                    <td align="center"><b>Act. (Unit)</b></td>
                                    <td align="center"><b>Status</b></td>
                                </tr>
                                
                                <?php
                                $i = 1;
                                $i2 = 0;
                                foreach($arry_plan_today as $pln_today => $list_destination){ ?>
                                <tr>
                                <td align="center"><?php echo $i; ?></td>
                                    <td><?php echo $list_destination['name'];?></td>
                                    <td align="center"><?php echo $list_destination['t_qty'];?></td>
                                    <?php $select_arry_act = $arry_act_today[$i2]['t_qty']; ?>
                                    <td align="center"><?php echo $select_arry_act;?></td>
                                    <td align="center"></td>
                                </tr>
                                <?php $i++; $i2++;}?>
                                
                            </table>
            </div>
    
        </div>
    </div>                


<div class="col-md-12">
<div class="x_panel">
    
<div class="x_content">
    <!--
<div class="col-md-6 col-sm-6 col-xs-12">
<div id="main_grafik" style="height:230px;"></div>
</div>
                                -->
<div class="col-md-12 col-sm-12 col-xs-12">
<div id="grafik_acc" style="height:230px;"></div>
</div>
</div>
</div>

</div>
</div>
<div class = "ln_solid"></div>
<div class="clearfix"></div>

<script type="text/javascript">

// Initialize the echarts instance based on the prepared dom

//var myChart = echarts.init(document.getElementById('main_grafik'));
var myChart2 = echarts.init(document.getElementById('grafik_acc'));

// Specify the configuration items and data for the chart
var option = {
    title: {
    text: 'Daily Stuffing Chart',
    },
    grid: {
    bottom: 50
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
    data: ['Plan', 'Actual'],
    top: 'bottom'
    },
    toolbox: {
        show: true,
        orient: 'vertical',
        left: 'right',
        top: 'center',
        feature: {
            mark: { show: true },
            //magicType: { show: true, type: ['line', 'bar'] },
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
        axisLabel: {fontSize: 11, interval: 0, rotate: 0 },
        data: [<?php echo implode(",", $arr_day); ?>]
        
    }],
    yAxis: [{
        type: 'value'
    }],
    series: [{
            name: 'Plan',
            type: 'bar',
            //barGap: 0,
            data: [<?php echo implode(",", $arr_p); ?>],

            itemStyle: {
                normal: {
                    label: {
                        position: 'top',
                        show: true,
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
            data: [<?php echo implode(",", $arr_a); ?>],
         
            itemStyle: {
                normal: {
                    label: {
                        position: 'top',
                        show: true,
                        color: 'green',
                        textStyle: {
                            fontWeight: 50
                           
                        }
                    }
                }
            },
        }
    ]
};

var option2 = {
    title: {
    text: 'Acc. Stuffing Progress November',
    },
    grid: {
    bottom: 50
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
    data: ['Acc. Plan', 'Acc. Actual', 'Acc. Progress'],
    top: 'bottom'
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
        axisLabel: {fontSize: 11, interval: 0, rotate: 0 },
        data: [<?php echo implode(",", $arr_day); ?>]
        
    }],
    yAxis: [{
        type: 'value'
    }],
    series: [{
            name: 'Acc. Plan',
            type: 'line',
            //barGap: 0,
            data: [<?php echo implode(",", $arr_acc_p); ?>],
            
            itemStyle: {
                normal: {
                    label: {
                        position: 'top',
                        show: true,
                        color: 'blue',
                        textStyle: {
                            fontWeight: 50
                        }
                    }
                }
            }, 
        },
        {
            name: 'Acc. Actual',
            type: 'line',
            data: [<?php echo implode(",", $arr_acc_a); ?>],
            
            itemStyle: {
                normal: {
                    label: {
                        position: 'bottom',
                        show: true,
                        color: 'green',
                        textStyle: {
                            fontWeight: 50
                        }
                    }
                }
            },
            
        },
        {
            name: 'Acc. Progress',
            type: 'line',
            data: [<?php echo implode(",", $arr_acc_b); ?>],
            
            itemStyle: {
                normal: {
                    label: {
                        position: 'bottom',
                        show: true,
                        color: 'orange',
                        textStyle: {
                            fontWeight: 50
                        }
                    }
                }
            },
        
        }
    ]
};


// Display the chart using the configuration items and data just specified.
//myChart.setOption(option);
myChart2.setOption(option2);

</script>