<?php

//array piano UP
$arr_p_up = array();
$arr_a_up = array();
$arr_b_up = array();
$arr_acc_p_up = array();
$arr_acc_a_up = array();
$arr_acc_b_up = array();
$temp_p_up = 0;
$temp_a_up = 0;

while($f_date <= $curr_date){

    $arr_day[] = "'".date("d",strtotime($f_date))."'";
    
    $query_plan_up = mysqli_query($con_prodinfo, "SELECT sum(total_qty) as t_qty FROM tb_planstuffing2 where plan = '$f_date' and class = 'UP'");
    $qty_p_up = mysqli_fetch_array($query_plan_up);
    $arr_p_up[] = $qty_p_up['t_qty'];
    $temp_p_up = $temp_p_up+$qty_p_up['t_qty'];
    $arr_acc_p_up[] = $temp_p_up;

    $query_act_up = mysqli_query($con_prodinfo, "SELECT count(buyer_cd) AS t_act FROM tb_stuffing where vanning_date like '$f_date%' and acard_no like 'U%' ");
    $qty_a_up = mysqli_fetch_array($query_act_up);
    if ($qty_a_up['t_act']==0){
        $arr_a_up[] = NULL; 
        $temp_a_up = $temp_a_up+0;
        $arr_acc_a_up[]=$temp_a_up;
    }else{
        $arr_a_up[] = $qty_a_up['t_act'];
        $temp_a_up = $temp_a_up+$qty_a_up['t_act'];
        $arr_acc_a_up[]=$temp_a_up;
    }
     
    $arr_b_up[] = $qty_a_up['t_act']-$qty_p_up['t_qty'];
    $arr_acc_b_up[]=$temp_a_up-$temp_p_up;
    $f_date = date("Y-m-d", strtotime("+1 day",strtotime($f_date)));
}

?>

<div class="row">

<div class="col-md-6 col-sm-6 col-xs-12">
<div id="up_grafik" style="height:250px;"></div>    
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
<div id="up_accumulation" style="height:250px;"></div>
</div>

</div>

<script type="text/javascript">

var myChart_up = echarts.init(document.getElementById('up_grafik'));
var myChart2_up = echarts.init(document.getElementById('up_accumulation'));

var option3 = {
    title: {
    text: 'STUFFING PIANO UP',
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
            data: [<?php echo implode(",", $arr_p_up); ?>],
            
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
            data: [<?php echo implode(",", $arr_a_up); ?>],
            
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

var option4 = {
    title: {
    text: 'ACCUMULATION PROGRESS UP',
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
            data: [<?php echo implode(",", $arr_acc_p_up); ?>],
            
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
            data: [<?php echo implode(",", $arr_acc_a_up); ?>],
            
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
            data: [<?php echo implode(",", $arr_acc_b_up); ?>],
            
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


myChart_up.setOption(option3);
myChart2_up.setOption(option4);
</script>