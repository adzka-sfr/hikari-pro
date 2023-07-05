<style>
    .table-condensed {
        font-size: 12px;
    }
</style>
<?php
// connection database kite_inventory
//$con_kite = mysqli_connect("103.44.27.247","root","YamahaMusic2014","db_inventory_yi");


$arr_day = array();
// $arr_p = array();
// $arr_a = array();
// $arr_b = array();
// $arr_acc_p = array();
// $arr_acc_a = array();
// $arr_acc_b = array();
//$first_day=new DateTime('first day of this month');
$first_date = new DateTime('first day of this month');
$f_date = date_format($first_date, 'Y-m-d');
//$day = date_format($first_date,'d');
$curr_date = date('Y-m-d');
$cur_m = date('Y-m');
$last_month = date('Y-m', strtotime('-1 month', strtotime($cur_m)));

//Query last month up
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

//Query last month GP
// $qry_lastmonth_plan_gp = mysqli_query($con_prodinfo, "SELECT sum(total_qty) as t_lastqty 
//           FROM tb_planstuffing 
//           where class='GP' && plan_period like '$last_month%'");

// $qry_lastmonth_act_gp = mysqli_query($con_prodinfo, "SELECT count(buyer_cd) AS t_lastact 
//             from tb_stuffing 
//             where vanning_date like '$last_month%' && acard_no like 'G%' && buyer_cd <> '8061'");

// $dt_p_last_mgp = mysqli_fetch_array($qry_lastmonth_plan_gp);
// $dt_a_last_mgp = mysqli_fetch_array($qry_lastmonth_act_gp);
// $progress_last_gp = $dt_a_last_mgp['t_lastact'] - $dt_p_last_mgp['t_lastqty'];
// if ($progress_last_gp < 0) {
//     $cls_col_last_gp = "red";
// } else {
//     $cls_col_last_gp = "green";
// }

// $total_lastmont = $progress_last_gp + $progress_last;


// $temp_p = 0;
// $temp_a = 0;

//array piano UP
$arr_p_up = array();
$arr_a_up = array();
$arr_b_up = array();
$arr_acc_p_up = array();
$arr_acc_a_up = array();
$arr_acc_b_up = array();
$arr_acc_prog_up = array();
$temp_p_up = 0;
$temp_a_up = 0;

//$arr_psi_up = array(); //PSI
//$arr_psi_prog_up =array(); //PSI

//array piano GP
// $arr_p_gp = array();
// $arr_a_gp = array();
// $arr_b_gp = array();
// $arr_acc_p_gp = array();
// $arr_acc_a_gp = array();
// $arr_acc_b_gp = array();
// $temp_p_gp = 0;
// $temp_a_gp = 0;

//PSI-------------------
// $qry_day_stuffing_up = mysqli_query($con_prodinfo,"select distinct plan from tb_planstuffing2 where class= 'UP' && plan like '$cur_m%'");
// $dt_day_stuffing_up = mysqli_num_rows($qry_day_stuffing_up);

// $qry_total_psi_up = mysqli_query($con_prodinfo,"select sum(sales) as qty_psi from tb_psi where class= 'UP' && plan like '$cur_m%' group by plan");
// $dt_total_psi_up = mysqli_fetch_array($qry_total_psi_up);

// $countdown_psi_up = $dt_total_psi_up['qty_psi'];

// $leveling_up = round($dt_total_psi_up['qty_psi']/$dt_day_stuffing_up);
//-------------

while ($f_date <= $curr_date) {

    $arr_day[] = "'" . date("d", strtotime($f_date)) . "'";

    //task up
    $query_plan_up = mysqli_query($con_prodinfo, "SELECT sum(total_qty) as t_qty FROM tb_planstuffing2 where plan = '$f_date' and class = 'UP'");
    $qty_p_up = mysqli_fetch_array($query_plan_up);
    $dtqty_plnup = isset($qty_p_up['t_qty'])?$qty_p_up['t_qty']:0;
    $arr_p_up[] = isset($qty_p_up['t_qty'])?$qty_p_up['t_qty']:0;
    $temp_p_up = $temp_p_up + $qty_p_up['t_qty'];
    $arr_acc_p_up[] = $temp_p_up;

    //PSI------------------
    // if($dtqty_plnup!=0){
    //     if ($countdown_psi_up <= $leveling_up){
            
    //         $psi_up = $countdown_psi_up;
            
    //     }else{
    //         $countdown_psi_up = $countdown_psi_up - $leveling_up;
    //         $psi_up = $leveling_up;
    //     }
    // }else{
    //     $psi_up = 0;
    // }

    // $arr_psi_up[] = $psi_up;
    //------------------------

    $query_act_up = mysqli_query($con_prodinfo, "SELECT count(buyer_cd) AS t_act FROM tb_stuffing where vanning_date like '$f_date%' and acard_no like 'U%' ");
    $qty_a_up = mysqli_fetch_array($query_act_up);
    if ($qty_a_up['t_act'] == 0) {
        $arr_a_up[] = 0;
        $temp_a_up = $temp_a_up + 0;
        $arr_acc_a_up[] = $temp_a_up;
    } else {
        $arr_a_up[] = $qty_a_up['t_act'];
        $temp_a_up = $temp_a_up + $qty_a_up['t_act'];
        $arr_acc_a_up[] = $temp_a_up;
    }

    $arr_b_up[] = $qty_a_up['t_act'] - $qty_p_up['t_qty'];
    $arr_acc_b_up[] = $temp_a_up - $temp_p_up + $progress_last;


    //------end task UP

    //task gp
    // $query_plan_gp = mysqli_query($con_prodinfo, "SELECT sum(total_qty) as t_qty FROM tb_planstuffing2 where plan = '$f_date' and class = 'GP'");
    // $qty_p_gp = mysqli_fetch_array($query_plan_gp);
    // $arr_p_gp[] = isset($qty_p_gp['t_qty'])?$qty_p_gp['t_qty']:0;
    // $temp_p_gp = $temp_p_gp + $qty_p_gp['t_qty'];
    // $arr_acc_p_gp[] = $temp_p_gp;

    // $query_act_gp = mysqli_query($con_prodinfo, "SELECT count(buyer_cd) AS t_act FROM tb_stuffing where vanning_date like '$f_date%' and acard_no like 'G%' ");
    // $qty_a_gp = mysqli_fetch_array($query_act_gp);
    // if ($qty_a_gp['t_act'] == 0) {
    //     $arr_a_gp[] = 0;
    //     $temp_a_gp = $temp_a_gp + 0;
    //     $arr_acc_a_gp[] = $temp_a_gp;
    // } else {
    //     $arr_a_gp[] = $qty_a_gp['t_act'];
    //     $temp_a_gp = $temp_a_gp + $qty_a_gp['t_act'];
    //     $arr_acc_a_gp[] = $temp_a_gp;
    // }

    // $arr_b_gp[] = $qty_a_gp['t_act'] - $qty_p_gp['t_qty'];
    // $arr_acc_b_gp[] = $temp_a_gp - $temp_p_gp + $progress_last_gp;

    //------end task GP


    // $query_plan = mysqli_query($con_prodinfo, "SELECT sum(total_qty) as t_qty FROM tb_planstuffing2 where plan = '$f_date'");
    // $qty_p = mysqli_fetch_array($query_plan);
    // $arr_p[] = $qty_p['t_qty'];
    // $temp_p = $temp_p + $qty_p['t_qty'];
    // $arr_acc_p[] = $temp_p;

    // $query_act = mysqli_query($con_prodinfo, "SELECT count(buyer_cd) AS t_act FROM tb_stuffing where vanning_date like '$f_date%'");
    // $qty_a = mysqli_fetch_array($query_act);
    // if ($qty_a['t_act'] == 0) {
    //     $arr_a[] = NULL;
    //     $temp_a = $temp_a + 0;
    //     $arr_acc_a[] = $temp_a;
    // } else {
    //     $arr_a[] = $qty_a['t_act'];
    //     $temp_a = $temp_a + $qty_a['t_act'];
    //     $arr_acc_a[] = $temp_a;
    // }

    // $arr_b[] = $qty_a['t_act'] - $qty_p['t_qty'];
    // $arr_acc_b[] = $temp_a - $temp_p + $total_lastmont;

    $f_date = date("Y-m-d", strtotime("+1 day", strtotime($f_date)));
}

$end_val_arr_pln_up = round(($temp_a_up / $temp_p_up) * 100, 1);
// $end_val_arr_pln_gp = round(($temp_a_gp / $temp_p_gp) * 100, 1);
// $end_val_arr_pln_total = round(($temp_a / $temp_p) * 100, 1);


?>


<!-- ECharts -->
<script src="dist/echarts.min.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">

                <div class="row">

                    <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="up_grafik" style="height:250px;"></div>  
                                </div> -->

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div id="up_accumulation" style="height:280px;"></div>
                    </div>
                    
                    <!-- 
                    rasio progress    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div id="up_perform" style="height:300px;"></div>
                    </div> -->

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">


                        <div class="table-responsive">
                            <div class="pull-left">
                                <b>Progress Stuffing Piano UP </b>
                            </div>
                            <div class="pull-left">
                                &nbsp;<b>[ Last Month : <?php echo $progress_last; ?> ]</b>
                            </div>

                            <table width="100%" class="table table-bordered table-condensed">
                                <thead>
                                    <tr class="alert-success">
                                        <th>Date</th>
                                        <?php
                                        foreach ($arr_day as $tgl) {
                                        ?>
                                            <th><?php echo substr($tgl, 1, 2); ?></th>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>

                                     <!-- <tr>
                                        <td class="alert-success" style="background-color:cornflowerblue;"><b>PSI</b></td>
                                        <?php
                                        //PSI
                                        //foreach ($arr_psi_up as $val_psi_up) {
                                        ?>
                                            <td align="center"><?php // echo $val_psi_up; ?></td>
                                        <?php
                                        //}
                                        ?>
                                    </tr> -->

                                    <tr>
                                        <td class="alert-success" style="background-color:cornflowerblue;"><b>Plan</b></td>
                                        <?php
                                        foreach ($arr_p_up as $p_up) {
                                        ?>
                                            <td align="center"><?php echo $p_up; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="alert-success" style="background-color:cornflowerblue;"><b>Actual</b></td>
                                        <?php
                                        foreach ($arr_a_up as $a_up) {
                                        ?>
                                            <td align="center"><?php echo $a_up; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="alert-success" style="background-color:cornflowerblue;"><b>+/-</b></td>
                                        <?php
                                        foreach ($arr_b_up as $b_up) {
                                            if ($b_up < 0) {
                                                $cls_color_b_up = "red";
                                            } else {
                                                $cls_color_b_up = "green";
                                            }
                                        ?>
                                            <td align="center" style="background-color:WhiteSmoke;"><b class="<?php echo $cls_color_b_up; ?>"><?php echo $b_up; ?></b></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>

                                    <tr>
                                        <td class="alert-warning" style="background-color:Coral;"><b>Acc. Plan</b></td>
                                        <?php
                                        foreach ($arr_acc_p_up as $acc_p_up) {
                                        ?>
                                            <td align="center"><?php echo $acc_p_up; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="alert-warning" style="background-color:Coral;"><b>Acc. Act</b></td>
                                        <?php
                                        foreach ($arr_acc_a_up as $acc_a_up) {
                                        ?>
                                            <td align="center"><?php echo $acc_a_up; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="alert-success" style="background-color:Coral;"><b>Acc. +/-</b></td>
                                        <?php
                                        foreach ($arr_acc_b_up as $acc_b_up) {
                                            if ($acc_b_up < 0) {
                                                $cls_color_acc_b_up = "red";
                                            } else {
                                                $cls_color_acc_b_up = "green";
                                            }
                                        ?>
                                            <td align="center" style="background-color:WhiteSmoke;"><b class="<?php echo $cls_color_acc_b_up; ?>"><?php echo $acc_b_up; ?></b></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>

                <!-- <div class="ln_solid"></div>
                <div class="clearfix"></br></div> -->

                <!-- <div class="row"> -->

                    <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="gp_grafik" style="height:250px;"></div>    
                            </div> -->

                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                        <div id="gp_accumulation" style="height:300px;"></div>
                    </div> -->

                    <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                        <div id="gp_perform" style="height:300px;"></div>
                    </div> -->

                <!-- </div> -->
                
                <!-- <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">


                        <div class="table-responsive">
                            <div class="pull-left">
                                <b>Progress Stuffing Piano GP </b>
                            </div>
                            <div class="pull-left">
                               &nbsp;<b>[ Last Month : <?php echo $progress_last_gp; ?> ]</b>
                            </div>


                            <table width="100%" class="table table-bordered table-condensed">
                                <thead>
                                    <tr class="alert-success">
                                        <th>Date</th>
                                        <?php
                                        foreach ($arr_day as $tgl) {
                                        ?>
                                            <th><?php echo substr($tgl, 1, 2); ?></th>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="alert-success" style="background-color:cornflowerblue;"><b>Plan</b></td>
                                        <?php
                                        foreach ($arr_p_gp as $p_gp) {
                                        ?>
                                            <td align="center"><?php echo $p_gp; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="alert-success" style="background-color:cornflowerblue;"><b>Actual</b></td>
                                        <?php
                                        foreach ($arr_a_gp as $a_gp) {
                                        ?>
                                            <td align="center"><?php echo $a_gp; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="alert-success" style="background-color:cornflowerblue;"><b>+/-</b></td>
                                        <?php
                                        foreach ($arr_b_gp as $b_gp) {
                                            if ($b_gp < 0) {
                                                $cls_color_b_gp = "red";
                                            } else {
                                                $cls_color_b_gp = "green";
                                            }
                                        ?>
                                            <td align="center" style="background-color:WhiteSmoke;"><b class="<?php echo $cls_color_b_gp; ?>"><?php echo $b_gp; ?></b></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>

                                    <tr>
                                        <td class="alert-warning" style="background-color:Coral;"><b>Acc. Plan</b></td>
                                        <?php
                                        foreach ($arr_acc_p_gp as $acc_p_gp) {
                                        ?>
                                            <td align="center"><?php echo $acc_p_gp; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="alert-warning" style="background-color:Coral;"><b>Acc. Act</b></td>
                                        <?php
                                        foreach ($arr_acc_a_gp as $acc_a_gp) {
                                        ?>
                                            <td align="center"><?php echo $acc_a_gp; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="alert-success" style="background-color:Coral;"><b>Acc. +/-</b></td>
                                        <?php
                                        foreach ($arr_acc_b_gp as $acc_b_gp) {
                                            if ($acc_b_gp < 0) {
                                                $cls_color_acc_b_gp = "red";
                                            } else {
                                                $cls_color_acc_b_gp = "green";
                                            }
                                        ?>
                                            <td align="center" style="background-color:WhiteSmoke;"><b class="<?php echo $cls_color_acc_b_gp; ?>"><?php echo $acc_b_gp; ?></b></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>


                </div> -->

                <!-- <div class="ln_solid"></div>
                <div class="clearfix"></br></div>

                <div class="row"> -->
                    <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="main_grafik" style="height:250px;"></div>
                            </div> -->

                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                        <div id="grafik_acc" style="height:300px;"></div>
                    </div> -->

                    <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                        <div id="total_perform" style="height:300px;"></div>
                    </div> -->

                <!-- </div> -->




<!-- <div class="clearfix"></br></div> -->

          </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // var myChart2 = echarts.init(document.getElementById('grafik_acc'));
    var myChart2_up = echarts.init(document.getElementById('up_accumulation'));
    // var myChart2_gp = echarts.init(document.getElementById('gp_accumulation'));

    // Specify the configuration items and data for the chart
option = {
title: {
    left: 'center',
    text: 'Daily Stuffing Piano UP',
    },
grid: {
    bottom: 50
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
  toolbox: {
        orient: 'vertical',
        left: 'right',
        top: 'center',
    feature: {
      //dataView: { show: true, readOnly: false },
      //magicType: { show: true, type: ['line', 'bar'] },
      restore: { show: true },
      saveAsImage: { show: true }
    }
  },
  legend: {
    data: ['Plan', 'Actual', 'Acc. Plan', 'Acc. Actual', 'Acc.+/-'],
    top: 'bottom'
  },
  xAxis: [
    {
      type: 'category',
      data: [<?php echo implode(",", $arr_day); ?>]
    //   axisPointer: {
    //     type: 'shadow'
    //   }
    }
  ],
  yAxis: [
    {
      type: 'value',
      name: 'Daily Qty',
      min: -60,
      max: 270,
      interval: 30,
      axisLabel: {
        formatter: '{value}'
      }
    },
    {
      type: 'value',
      name: 'Accumulation',
      min: -600,
      max: 2700,
      interval: 300,
      axisLabel: {
        formatter: '{value}'
      }
    }
  ],
  series: [
    {
      name: 'Plan',
      type: 'bar',
      label: {
        show: true,
        position: 'top',
        color:'blue'
      },
      tooltip: {
        valueFormatter: function (value) {
          return value + ' Unit';
        }
      },
      data: [
        <?php echo implode(",", $arr_p_up); ?>
      ]
    },
    {
      name: 'Actual',
      type: 'bar',
      label: {
        show: true,
        position: 'top',
        color: 'green'
      },
      tooltip: {
        valueFormatter: function (value) {
          return value + ' Unit';
        }
      },
      data: [
        <?php echo implode(",", $arr_a_up); ?>
      ]
    },
   
    {
      name: 'Acc. Plan',
      type: 'line',
      smooth: true,
      yAxisIndex: 1,
      tooltip: {
        valueFormatter: function (value) {
          return value + ' Unit';
        }
      },
      data: [
        <?php echo implode(",", $arr_acc_p_up); ?>
    ],
    markPoint: {
        data: [
          { type: 'max', name: 'Max' }
        ]
      },
    },
    {
      name: 'Acc. Actual',
      type: 'line',
      smooth: true,
      yAxisIndex: 1,
      tooltip: {
        valueFormatter: function (value) {
          return value + ' Unit';
        }
      },
      data: [
        <?php echo implode(",", $arr_acc_a_up); ?>
    ],
    markPoint: {
        data: [
          { type: 'max', name: 'Max' }
        ]
      },
    },
    {
      name: 'Acc.+/-',
      type: 'line',
      smooth: true,
      yAxisIndex: 1,
      tooltip: {
        valueFormatter: function (value) {
          return value + ' Unit';
        }
      },
      data: [
        <?php echo implode(",", $arr_acc_b_up); ?>
    ],
    markPoint: {
        data: [
          { type: 'max', name: 'Max' },
          { type: 'min', name: 'Min' }
        ]
      },
    },
    
  ]
};



    // myChart2.setOption(option2);
    myChart2_up.setOption(option);
    // myChart2_gp.setOption(option2);
</script>