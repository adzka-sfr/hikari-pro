<?php
//$first_day=new DateTime('first day of this month');
$first_date=new DateTime('first day of this month');
$ym = date_format($first_date,'Y-m');
$last_month = date('Y-m', strtotime('-1 month', strtotime($ym)));
$next_month = date('Y-m', strtotime('+1 month', strtotime($ym)));
//$day = date_format($first_date,'d');
$arr_dtplan_week = array();
$arr_dtbook_week = array();

$arr_dtplan_week_next = array();
$arr_dtbook_week_next = array();

$arr_dtplan_40h = array();
$arr_dtplan_40 = array();
$arr_dtplan_20 = array();
$arr_dtbook_40h = array();
$arr_dtbook_40 = array();
$arr_dtbook_20 = array();
$arr_progress = array();
$weekup = [];
$i = 0;

$query_week = mysqli_query($con_prodinfo, "SELECT WEEK(plan_date) AS week
FROM tb_container_booking
WHERE plan_date like '$ym%'");

while($dt_week = mysqli_fetch_assoc($query_week)){
    $weekup[$i] = $dt_week['week'];
    $i++;
}

$get_week = array_values(array_unique($weekup));
$x=1;
$x_axis = array();
foreach ($get_week as $key => $value) {
    $select_cont_book = mysqli_query($con_prodinfo, "SELECT sum(type_40H) as total_40h, sum(type_40) as total_40, sum(type_20) as total_20, 
    sum(type_40H_update) as total_40h_book, sum(type_40_update) as total_40_book, sum(type_20_update) as total_20_book 
    FROM tb_container_booking
    WHERE plan_date like '$ym%' && week(plan_date) = '$value'");
    $dta_container = mysqli_fetch_array($select_cont_book);
    $for_plan = $dta_container['total_40h'] + $dta_container['total_40'] + $dta_container['total_20'];
    $for_book = $dta_container['total_40h_book'] + $dta_container['total_40_book'] + $dta_container['total_20_book'];
    $arr_dtplan_week[] = $for_plan;
    $arr_dtbook_week[] = $for_book;
    $arr_dtplan_40h[] = $dta_container['total_40h'];
    $arr_dtplan_40[] = $dta_container['total_40'];
    $arr_dtplan_20[] = $dta_container['total_20'];
    $arr_dtbook_40h[] = $dta_container['total_40h_book'];
    $arr_dtbook_40[] = $dta_container['total_40_book'];
    $arr_dtbook_20[] = $dta_container['total_20_book'];

    $arr_progress[] = round(($for_book/$for_plan)*100,1);

    $select_cont_book_next = mysqli_query($con_prodinfo, "SELECT sum(type_40H) as total_40h, sum(type_40) as total_40, sum(type_20) as total_20, 
    sum(type_40H_update) as total_40h_book, sum(type_40_update) as total_40_book, sum(type_20_update) as total_20_book 
    FROM tb_container_booking
    WHERE plan_date like '$next_month%'");

    $dta_container_next = mysqli_fetch_array($select_cont_book_next);
    $for_plan_next = $dta_container_next['total_40h'] + $dta_container_next['total_40'] + $dta_container_next['total_20'];
    $for_book_next = $dta_container_next['total_40h_book'] + $dta_container_next['total_40_book'] + $dta_container_next['total_20_book'];
    $arr_dtplan_week_next[] = $for_plan_next;
    $arr_dtbook_week_next[] = $for_book_next;

     $x_axis[] = "'week ".$x."'";
    $x++;
}

$total_plan = array_sum($arr_dtplan_week);
$total_act = array_sum($arr_dtbook_week);

$total_plan_next = array_sum($arr_dtplan_week_next);
$total_act_next = array_sum($arr_dtbook_week_next);

$plan_40h = array_sum($arr_dtplan_40h);
$plan_40 = array_sum($arr_dtplan_40);
$plan_20 = array_sum($arr_dtplan_20);
$book_40h = array_sum($arr_dtbook_40h);
$book_40 = array_sum($arr_dtbook_40);
$book_20 = array_sum($arr_dtbook_20);

$progres_40h = $book_40h-$plan_40h;
$progres_40 = $book_40-$plan_40;
$progres_20 = $book_20-$plan_20;

if($progres_40h<0){
    $class_40h = "red";
}else{
    $class_40h = "darkcyan";
}

if($progres_40<0){
    $class_40 = "red";
}else{
    $class_40 = "darkcyan";
}

if($progres_20<0){
    $class_20 = "red";
}else{
    $class_20 = "darkcyan";
}

// $select_plan_cont_book = mysqli_query($con_prodinfo, "SELECT sum(type_40H) as total_40h, sum(type_40) as total_40, sum(type_20) as total_20 
// FROM tb_container_booking
// WHERE plan_date like '$ym%'");

// $select_act_cont_book = mysqli_query($con_prodinfo, "SELECT sum(type_40H_update) as total_40h, sum(type_40_update) as total_40, sum(type_20_update) as total_20 
// FROM tb_container_booking
// WHERE plan_date like '$ym%' && status = 'Confirmed'");


// $dta_container_plan = mysqli_fetch_array($select_plan_cont_book);

// $dta_container_act = mysqli_fetch_array($select_act_cont_book);

// $total_plan = $dta_container_plan['total_40h'] + $dta_container_plan['total_40'] + $dta_container_plan['total_20'];
// $total_act = $dta_container_act['total_40h'] + $dta_container_act['total_40'] + $dta_container_act['total_20'];

$total_progress = round(($total_act/$total_plan)*100,1);
?>



<!-- ECharts -->
<script src="dist/echarts.min.js"></script>

                <style>
                    .table-condensed{
                    font-size: 18px;
                    }
                </style>

<div class="row">
    <div class="col-md-9" >
    <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel" style="height:325px;">
            <div class="x_title">
                <h2>Container Booking Condition <?php echo date_format($first_date,'F Y');?> </h2>
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
                          <div class="count"><a style="font-size: 50px; color:royalblue"><?php echo $total_plan;?> Unit </a></div>

                          <h3 style="color:royalblue"> <b>Plan 計画</b> </h3>
                          
                        </div>
                        <div>
                            <table width="100%" class="table table-striped table-bordered table-condensed">
                                <tr>
                                <td style = "background-color:darkorange;"><b style="color:white;">Container Type</b></td>
                                    <td align="center"><b>40H</b></td>
                                    <td align="center"><b>40</b></td>
                                    <td align="center"><b>20</b></td>
                                </tr>
                                <tr>
                                <td style = "background-color:darkorange;"><b style="color:white;">Total Qty</b></td>
                                    <td align="center"><b style="color:darkcyan;"><?php echo $plan_40h; ?></b></td>
                                    <td align="center"><b style="color:darkcyan;"><?php echo $plan_40; ?></b></td>
                                    <td align="center"><b style="color:darkcyan;"><?php echo $plan_20; ?></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-check-square-o"></i>
                          </div>
                          <div class="count"><a style="font-size: 50px; color:darkcyan"><?php echo $total_act;?> Unit</a></div>

                          <h3 style="color:darkcyan"><b>Actual 実績</b></h3>
                          
                        </div>
                        <table width="100%" class="table table-striped table-bordered table-condensed">
                                <tr>
                                <td style = "background-color:darkorange;"><b style="color:white;">Container Type</b></td>
                                    <td align="center"><b>40H</b></td>
                                    <td align="center"><b>40</b></td>
                                    <td align="center"><b>20</b></td>
                                </tr>
                                <tr>
                                <td style = "background-color:darkorange;"><b style="color:white;">Total Qty</b></td>
                                <td align="center"><b style="color:darkcyan;"><?php echo $book_40h; ?></b></td>
                                    <td align="center"><b style="color:darkcyan;"><?php echo $book_40; ?></b></td>
                                    <td align="center"><b style="color:darkcyan;"><?php echo $book_20; ?></b></td>
                                </tr>
                            </table>
                    </div>

                    <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-line-chart"></i>
                          </div>
                          <div class="count"><a style="font-size: 50px; color:chocolate"><?php echo $total_progress ;?> % </a> </div>

                          <h3 style="color:chocolate"><b>Progress 進捗</b></h3>
                          
                        </div>
                        <table width="100%" class="table table-striped table-bordered table-condensed">
                                <tr>
                                    <td style = "background-color:darkorange;"><b style="color:white;">Container Type</b></td>
                                    <td align="center"><b>40H</b></td>
                                    <td align="center"><b>40</b></td>
                                    <td align="center"><b>20</b></td>
                                </tr>
                                <tr>
                                    <td style = "background-color:darkorange;"><b style="color:white;">Total Qty</b></td>
                                    <td align="center"><b style="color: <?php echo $class_40h;?>;" ><?php echo $progres_40h;?></b></td>
                                    <td align="center"><b style="color: <?php echo $class_40;?>;"><?php echo $progres_40;?></b></td>
                                    <td align="center"><b style="color: <?php echo $class_20;?>;"><?php echo $progres_20;?></b></td>
                                </tr>
                            </table>
                    </div>
            </div>
                    
        </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
        <div id="chart_weekly" style="height:180px;"></div>
        </div>
         
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel" style="height:200px;">
        <div class="x_title">
                <h2><?php echo "Next Month (".date('F Y',strtotime($next_month)).")";?></php></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li> -->
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                                <table width="100%" class="table table-striped table-bordered table-condensed">
                                <tr>
                                    <td align="center"><b>Plan 計画</b></td>
                                    <td align="center"><b>Actual 実績</b></td>
                                    <td align="center"><b>Progress 進捗</b></td>
                                </tr>
                                <tr>
                                    <td align="center"><b><?php echo $for_plan_next;?></b></td>
                                    <td align="center"><b><?php echo $for_book_next;?></b></td>
                                    <?php if($for_plan_next == 0){
                                      $pembagi = 1;
                                    }else{
                                      $pembagi = $for_plan_next;
                                    } ?>
                                    <td align="center"><b><?php echo round(($for_book_next/$pembagi)*100,1); ?>%</b></td>
                                </tr>
                                </table>

            </div>
                
        </div>
        </div>
    </div>
    <div class="col-md-3">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Booking Remaining</php></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li> -->
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                                <table width="100%" class="table table-striped table-bordered">
                                <tr>
                                    <td align="center"><b>Destination</b></td>
                                    <td align="center"><b>Plan</b></td>
                                    <td align="center"><b>Act</b></td>  
                                </tr>
                                <?php 
                                    $qry_destin_plan = mysqli_query($con_prodinfo,"SELECT destination_nm, 
                                    sum(type_40H) as total_40h, 
                                    sum(type_40) as total_40, 
                                    sum(type_20) as total_20,
                                    sum(type_40H_update) as total_40h_act, 
                                    sum(type_40_update) as total_40_act, 
                                    sum(type_20_update) as total_20_act
                                    FROM tb_container_booking
                                    WHERE plan_date LIKE '$ym%' GROUP BY destination_nm ORDER BY destination_nm");
                                    while($dt_destin_plan = mysqli_fetch_array($qry_destin_plan)){
                                        $t_destin_plan = $dt_destin_plan['total_40h'] + $dt_destin_plan['total_40'] + $dt_destin_plan['total_20'];
                                        $t_destin_act = $dt_destin_plan['total_40h_act'] + $dt_destin_plan['total_40_act'] + $dt_destin_plan['total_20_act'];

                                        $balance_booking = $t_destin_act - $t_destin_plan;
                                        if($balance_booking < 0){ //hanya yang belum complete yang tampil
                                ?>
                                <tr>
                                    <td><?php echo $dt_destin_plan['destination_nm'];?></td>
                                    <td align="center"><b><?php echo $t_destin_plan;?></b></td>
                                    <td align="center"><b><?php echo $t_destin_act;?></b></td>
                                </tr>
                                <?php        
                                        }
                                    }
                                ?>
                               
                                </table>

            </div>
                
        </div>

        </div>
		
		<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ship Delay (Base on ETD)</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li> -->
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
              
                                <table width="100%" class="table table-striped table-bordered">
                                <tr>
                                    <td align="center"><b>Destin.</b></td>
                                    <td align="center"><b>Qty</b></td>
                                    <td align="center"><b>Ori. Pln</b></td>
									<td align="center"><b>Updt. Pln</b></td>
                                </tr>

                               
                                </table>

            </div>
                
        </div>

        </div>

    </div>

    </div>

<div class = "ln_solid"></div>
<div class="clearfix"></div>



<script type="text/javascript">


var myChart = echarts.init(document.getElementById('chart_weekly'));
var option;

option = {
title: {
    left: 'center',
    text: 'Weekly Progress',
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
    feature: {
      //dataView: { show: true, readOnly: false },
      //magicType: { show: true, type: ['line', 'bar'] },
      restore: { show: true },
      saveAsImage: { show: true }
    }
  },
  legend: {
    data: ['Plan', 'Confirm', 'Progress'],
    top: 'bottom'
  },
  xAxis: [
    {
      type: 'category',
      data: [<?php echo implode(",", $x_axis); ?>],
      axisPointer: {
        type: 'shadow'
      }
    }
  ],
  yAxis: [
    {
      type: 'value',
      name: 'Plan',
      axisLabel: {
        formatter: '{value}'
      }
    },
    {
      type: 'value',
      name: 'Progress',
      axisLabel: {
        formatter: '{value} %'
      }
    }
  ],
  series: [
    {
      name: 'Plan',
      type: 'bar',
      tooltip: {
        valueFormatter: function (value) {
          return value + ' Unit';
        }
      },
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
      data: [
        <?php echo implode(",", $arr_dtplan_week); ?>
      ]
    },
    {
      name: 'Confirm',
      type: 'bar',
      tooltip: {
        valueFormatter: function (value) {
          return value + ' Unit';
        }
      },
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
      data: [
        <?php echo implode(",", $arr_dtbook_week); ?>
      ]
    },
    {
      name: 'Progress',
      type: 'line',
      yAxisIndex: 1,
      tooltip: {
        valueFormatter: function (value) {
          return value + ' %';
        }
      },
      data: [
        <?php echo implode(",", $arr_progress); ?>
    ]
    }
  ]
};

myChart.setOption(option);

</script>