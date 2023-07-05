<?php

//$month = $_POST['month'];
//$year = $_POST['year'];
$month = date('m');
$year = date('Y');
$cur_m = date('Y-m');
//$first_date_lastmont = date("Y-n-j", strtotime("first day of previous month"));
$first_date = new DateTime('first day of this month');
$last_date = new DateTime('last day of this month');

$f_day = date_format($first_date, 'Y-m-d');
$f_day_gp =date_format($first_date, 'Y-m-d');
$l_day = date_format($last_date, 'Y-m-d');

$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$last_month = date('Y-m', strtotime('-1 month', strtotime($cur_m)));
$qry_lastmonth_planup = mysqli_query($con_prodinfo, "SELECT sum(total_qty) as t_lastqty 
                                FROM tb_planstuffing 
                                where class='UP' && plan_period like '$last_month%'");

$qry_lastmonth_actup = mysqli_query($con_prodinfo, "SELECT count(buyer_cd) AS t_lastact 
        from tb_stuffing 
        where vanning_date like '$last_month%' && acard_no like 'U%' && buyer_cd <> '8061'");

$dt_p_last_m = mysqli_fetch_array($qry_lastmonth_planup);
$dt_a_last_m = mysqli_fetch_array($qry_lastmonth_actup);
$progress_last = $dt_a_last_m['t_lastact'] - $dt_p_last_m['t_lastqty'];
if ($progress_last < 0) {
    $cls_col_last = "red";
} else {
    $cls_col_last = "red";
}

//Query GP
$qry_lastmonth_plan_gp = mysqli_query($con_prodinfo, "SELECT sum(total_qty) as t_lastqty 
                                FROM tb_planstuffing 
                                where class='GP' && plan_period like '$last_month%'");

$qry_lastmonth_act_gp = mysqli_query($con_prodinfo, "SELECT count(buyer_cd) AS t_lastact 
        from tb_stuffing 
        where vanning_date like '$last_month%' && acard_no like 'G%' && buyer_cd <> '8061'");

$dt_p_last_mgp = mysqli_fetch_array($qry_lastmonth_plan_gp);
$dt_a_last_mgp = mysqli_fetch_array($qry_lastmonth_act_gp);
$progress_last_gp = $dt_a_last_mgp['t_lastact'] - $dt_p_last_mgp['t_lastqty'];
if ($progress_last_gp < 0) {
    $cls_col_last_gp = "red";
} else {
    $cls_col_last_gp = "green";
}

?>

<style>
    .table-condensed {
        font-size: 15px;
    }
</style>
<!--PROGRESS PIANO UP-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">

<div class="col-md-6 col-sm-6 col-xs-12">
    <div id="grafik_up" style="height:250px;"></div>

    <table class="table">
        <tr>
            <td colspan=4><b class="green">Last Month</b></td>
            <td align="right"><b class="<?php echo $cls_col_last; ?>"><?php echo $progress_last; ?></b></td>
        </tr>
    </table>
    <table class="table table-bordered table-condensed">
        <thead class="alert-success">
            <tr>
                <th width="25%">Plan Date</th>
                <th width="15%">PSI</th>
                <th width="15%">Plan</th>
                <th width="15%">Act.</th>
                <th width="15%">+/-</th>
                <th width="15%">PSI Progress</th>

            </tr>
        </thead>
        <tbody style="background-color:#fff;">
            <?php
            $destin_up = array();
            $t_qtyup = array();
            $arr_t_actup = array();
            $blnceup = array();
            $arr_psi_up = array();
            $arr_psi_prog_up =array();
            $progress = 0;
            $ym = date_format($first_date,'Y-m');

            $qry_day_stuffing_up = mysqli_query($con_prodinfo,"select distinct plan from tb_planstuffing2 where class= 'UP' && plan like '$ym%'");
            $dt_day_stuffing_up = mysqli_num_rows($qry_day_stuffing_up);

            $qry_total_psi_up = mysqli_query($con_prodinfo,"select sum(sales) as qty_psi from tb_psi where class= 'UP' && plan like '$ym%' group by plan");
            $dt_total_psi_up = mysqli_fetch_array($qry_total_psi_up);

            $countdown_psi_up = $dt_total_psi_up['qty_psi'];

            $leveling_up = ceil($dt_total_psi_up['qty_psi']/$dt_day_stuffing_up);

            while ($f_day <= $l_day) {
            
                $queryup = mysqli_query($con_prodinfo, "SELECT plan, sum(total_qty) as t_qty 
                        FROM tb_planstuffing2 
                        where class='UP' && plan = '$f_day'  
                        group by plan");

                $fetchup = mysqli_fetch_array($queryup);
                $p_up = $f_day;
                $p_up_tb = date("d/m/Y", strtotime($p_up));
                $p_up_x = date("d", strtotime($f_day));
                $dtqty_plnup = isset($fetchup['t_qty'])?$fetchup['t_qty']:0;

                // Count PSI UP
                // start---------------------------------------------------
                if($dtqty_plnup!=0){
                    if ($countdown_psi_up <= $leveling_up){
                        
                        $psi_up = $countdown_psi_up;
                        
                    }else{
                        $countdown_psi_up = $countdown_psi_up - $leveling_up;
                        $psi_up = $leveling_up;
                    }
                }else{
                    $psi_up = 0;
                }

                $arr_psi_up[] = $psi_up;
                //------------------------------------------------------end

                $select_actup = mysqli_query($con_prodinfo, "SELECT vanning_date, count(buyer_cd) AS t_act 
                                from tb_stuffing 
                                where vanning_date = '$f_day' && acard_no like 'U%' group by vanning_date");
                $fetchupactup = mysqli_fetch_assoc($select_actup);
                $dtqty_actup = isset($fetchupactup['t_act']) ? $fetchupactup['t_act'] : 0;
                //$progress = $progress + $dtqty_actup - $dtqty_plnup;
                $progress = $progress + $dtqty_actup - $psi_up;
                
            ?>  
                <tr>

                    <td><?php echo $p_up_tb . " " . date("l", strtotime($f_day)); ?></td>
                    <td align="center"><?php echo $psi_up; ?></td>
                    <td align="center"><?php echo $dtqty_plnup; ?></td>
                    <td align="center"><?php echo $dtqty_actup; ?></td>
                    <?php if ($dtqty_actup - $dtqty_plnup < 0) {
                        $csl_lnce_up = "red";
                    } else {
                        $csl_lnce_up = "blue";
                    }

                    if (($progress_last + $progress) < 0) {
                        $cls_col_last_tb = "red";
                    } else {
                        $cls_col_last_tb = "red";
                    }

                    ?>
                    <td align="right"><b class="<?php echo $csl_lnce_up; ?>"><?php echo $dtqty_actup - $dtqty_plnup; ?></b></td>
                    <td align="right"><b class="<?php echo $cls_col_last_tb; ?>"><?php echo $progress_last + $progress; ?></b></td>

                </tr>
            <?php
                $t_qtyup[] = $dtqty_plnup;
                $arr_t_actup[] = $dtqty_actup;
                $destin_up[] = $p_up_x;
                $blnceup[] = $dtqty_actup - $dtqty_plnup;
                $f_day = date("Y-m-d", strtotime("+1 day", strtotime($f_day)));
                $arr_psi_prog_up[] = $progress_last + $progress;

            }
            ?>
            <tr class="btn-dark">
                <td align="center"><b>Total</b> </td>
                <td align="center"><b><?php echo $dt_total_psi_up['qty_psi']; ?></b></td>
                <td align="center"><b><?php echo array_sum($t_qtyup); ?></b></td>
                <td align="center"><b><?php echo array_sum($arr_t_actup); ?></b></td>
                <td align="right"><b><?php echo array_sum($arr_t_actup) - array_sum($t_qtyup); ?></b></td>
                <td align="right"><b><?php echo $progress_last + $progress; ?></b></td>
            </tr>
        </tbody>
    </table>
</div>


<!--PROGRESS PIANO GP-->
<div class="col-md-6 col-sm-6 col-xs-12">
    <div id="grafik_gp" style="height:250px;"></div>
   
    <table class="table">
        <tr>
            <td colspan=4><b class="green">Last Month</b></td>
            <td align="right"><b class="<?php echo $cls_col_last_gp; ?>"><?php echo $progress_last_gp; ?></b></td>
        </tr>
    </table>
    <table class="table table-bordered table-condensed">
        <thead class="alert-success">
            <tr>
                <th width="25%">Plan Date</th>
                <th width="15%">PSI</th>
                <th width="15%">Plan</th>
                <th width="15%">Act.</th>
                <th width="15%">+/-</th>
                <th width="15%">PSI Progress</th>

            </tr>
        </thead>
        <tbody style="background-color:#fff;">
            <?php
            

            $destin_gp = array();
            $t_qtygp = array();
            $arr_t_actgp = array();
            $blncegp = array();
            $arr_psi_gp = array();
            $arr_psi_prog_gp = array();
            $progress_gp = 0;

            $qry_day_stuffing_gp = mysqli_query($con_prodinfo,"select distinct plan from tb_planstuffing2 where class= 'GP' && plan like '$ym%'");
            $dt_day_stuffing_gp = mysqli_num_rows($qry_day_stuffing_gp);

            $qry_total_psi_gp = mysqli_query($con_prodinfo,"select sum(sales) as qty_psi from tb_psi where class= 'GP' && plan like '$ym%'");
            $dt_total_psi_gp = mysqli_fetch_array($qry_total_psi_gp);
            $countdown_psi_gp = $dt_total_psi_gp['qty_psi'];

            $leveling_gp = ceil($dt_total_psi_gp['qty_psi']/$dt_day_stuffing_gp);

            while ($f_day_gp <= $l_day) {


                $querygp = mysqli_query($con_prodinfo, "SELECT plan, sum(total_qty) as t_qty 
                    FROM tb_planstuffing2 
                    where class='GP' && plan = '$f_day_gp' 
                    group by plan");
            //while ($fetchgp = mysqli_fetch_array($querygp)) {
                $fetchgp = mysqli_fetch_array($querygp);
                $p_gp = $f_day_gp;
                $p_gp_tb = date("d/m/Y", strtotime($p_gp));
                $p_gp_x = date("d", strtotime($f_day_gp));
                $dtqty_plngp = isset($fetchgp['t_qty'])?$fetchgp['t_qty']:0;

                // Count PSI GP
                // start---------------------------------------------------
                if($dtqty_plngp!=0){
                    
                    if ($countdown_psi_gp <= $leveling_gp){
                        $psi_gp = $countdown_psi_gp;
                        
                    }else{
                        $countdown_psi_gp = $countdown_psi_gp - $leveling_gp;
                        $psi_gp = $leveling_gp;
                    }
                }else{
                    $psi_gp = 0;
                }

                $arr_psi_gp[] = $psi_gp;
                //------------------------------------------------------end

                $select_actgp = mysqli_query($con_prodinfo, "SELECT vanning_date, count(buyer_cd) AS t_act 
                                from tb_stuffing 
                                where vanning_date = '$f_day_gp' && acard_no like 'G%' group by vanning_date");
                $fetchupactgp = mysqli_fetch_assoc($select_actgp);
                $dtqty_actgp = isset($fetchupactgp['t_act']) ? $fetchupactgp['t_act'] : 0;
                //$progress_gp = $progress_gp + $dtqty_actgp - $dtqty_plngp;
                $progress_gp = $progress_gp + $dtqty_actgp - $psi_gp;

            ?>
                <tr>

                    <td><?php echo $p_gp_tb . " " . date("l", strtotime($f_day_gp)); ?></td>
                    <td align="center"><?php echo $psi_gp; ?></td>
                    <td align="center"><?php echo $dtqty_plngp; ?></td>
                    <td align="center"><?php echo $dtqty_actgp; ?></td>
                    <?php if ($dtqty_actgp - $dtqty_plngp < 0) {
                        $csl_lnce_gp = "red";
                    } else {
                        $csl_lnce_gp = "blue";
                    }

                    if (($progress_last_gp + $progress_gp) < 0) {
                        $cls_col_last_tb_gp = "red";
                    } else {
                        $cls_col_last_tb_gp = "red";
                    }

                    ?>
                    <td align="right"><b class="<?php echo $csl_lnce_gp; ?>"><?php echo $dtqty_actgp - $dtqty_plngp; ?></b></td>
                    <td align="right"><b class="<?php echo $cls_col_last_tb_gp; ?>"><?php echo $progress_last_gp + $progress_gp; ?></b></td>

                </tr>
            <?php
                $t_qtygp[] = $dtqty_plngp;
                $arr_t_actgp[] = $dtqty_actgp;
                $destin_gp[] = $p_gp_x;
                $blncegp[] = $dtqty_actgp - $dtqty_plngp;
                $arr_psi_prog_gp[] = $progress_last_gp + $progress_gp;
                $f_day_gp = date("Y-m-d", strtotime("+1 day", strtotime($f_day_gp)));
            }
            ?>
            <tr class="btn-dark">
                <td align="center"><b>Total</b> </td>
                <td align="center"><b><?php echo $dt_total_psi_gp['qty_psi']; ?></b></td>
                <td align="center"><b><?php echo array_sum($t_qtygp); ?></b></td>
                <td align="center"><b><?php echo array_sum($arr_t_actgp); ?></b></td>
                <td align="right"><b><?php echo array_sum($arr_t_actgp) - array_sum($t_qtygp); ?></b></td>
                <td align="right"><b><?php echo $progress_last_gp + $progress_gp; ?></b></td>
            </tr>
        </tbody>
    </table>
</div>
</br>
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
            text: 'Piano UP',
        },
        grid: {
            bottom: 30
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
            data: ['PSI', 'Plan', 'Actual', 'PSI Progress'],
            right: '10%'
        },
        toolbox: {
            show: true,
            orient: 'vertical',
            left: 'right',
            top: 'center',
            feature: {
                mark: {
                    show: true
                },
                magicType: {
                    show: true,
                    type: ['line', 'bar']
                },
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
            axisLabel: {
                fontSize: 9,
                interval: 0,
                rotate: 0
            },
            data: [<?php echo implode(",", $destin_up); ?>]

        }],
        yAxis: [
            {
            type: 'value',
            name: 'Daily Qty',
            min: -270,
            max: 270,
            interval: 90,
            axisLabel: {
                formatter: '{value}'
            }
            },
            {
            type: 'value',
            name: 'Progress',
            min: -2700,
            max: 2700,
            interval: 900,
            axisLabel: {
                formatter: '{value}'
            }
            }
        ],
        series: [

            {
                name: 'PSI',
                type: 'bar',
                barGap: 0,
                data: [<?php echo implode(",", $arr_psi_up); ?>],
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
            name: 'PSI Progress',
            type: 'line',
            smooth: true,
            itemStyle: {
                    normal: {
                        label: {
                            position: 'bottom',
                            show: false,
                            color: 'red',
                            textStyle: {
                                fontWeight: 50
                            }
                        }
                    }
                },
            yAxisIndex: 1,
            tooltip: {
                valueFormatter: function (value) {
                return value + ' Unit';
                }
            },
            data: [
                <?php echo implode(",", $arr_psi_prog_up); ?>
            ],
            markPoint: {
                data: [
                { type: 'max', name: 'Max' },
                { type: 'min', name: 'Min' },
                ]
            },
            }
        ]
    };

    var option2 = {
        title: {
            text: 'Piano GP',
        },
        grid: {
            bottom: 30
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['PSI','Plan', 'Actual', 'PSI Progress'],
            right: '10%'
        },
        toolbox: {
            show: true,
            orient: 'vertical',
            left: 'right',
            top: 'center',
            feature: {
                mark: {
                    show: true
                },
                magicType: {
                    show: true,
                    type: ['line', 'bar']
                },
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
            axisLabel: {
                fontSize: 9,
                interval: 0,
                rotate: 0
            },
            data: [<?php echo implode(",", $destin_gp); ?>]

        }],
        yAxis: [
            {
            type: 'value',
            name: 'Daily Qty',
            min: -60,
            max: 80,
            interval: 20,
            axisLabel: {
                formatter: '{value}'
            }
            },
            {
            type: 'value',
            name: 'Progress',
            min: -600,
            max: 800,
            interval: 200,
            axisLabel: {
                formatter: '{value}'
            }
            }
        ],
        series: [
            {
                name: 'PSI',
                type: 'bar',
                barGap: 0,
                data: [<?php echo implode(",", $arr_psi_gp); ?>],
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
                name: 'Plan',
                type: 'bar',
                barGap: 0,
                data: [<?php echo implode(",", $t_qtygp); ?>],
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
            name: 'PSI Progress',
            type: 'line',
            smooth: true,
            itemStyle: {
                    normal: {
                        label: {
                            position: 'bottom',
                            show: false,
                            color: 'red',
                            textStyle: {
                                fontWeight: 50
                            }
                        }
                    }
                },
            yAxisIndex: 1,
            tooltip: {
                valueFormatter: function (value) {
                return value + ' Unit';
                }
            },
            data: [
                <?php echo implode(",", $arr_psi_prog_gp); ?>
            ],
            markPoint: {
                data: [
                { type: 'max', name: 'Max' },
                { type: 'min', name: 'Min' },
                ]
            },
            }
        ]
    };

    // Display the chart using the configuration items and data just specified.
    myChart.setOption(option);
    myChart2.setOption(option2);
</script>