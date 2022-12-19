<?php
$wc = 'P220';
$up_spray1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$now' and c_work_center = '$wc'");
$up_sprayd1 = mysqli_fetch_array($up_spray1);
if (empty($up_sprayd1)) {
    $a_upspray = 0;
} elseif ($up_sprayd1['c_otr_qty'] == 0) {
    $a_upspray = 0;
} else {
    $a_upspray = ($up_sprayd1['c_otr_qty'] / $up_sprayd1['c_plan']) * 100;
    $a_upspray = round($a_upspray);
}

// target
$up_spray2 = mysqli_query($connect_pro, "SELECT c_target FROM otr_target where c_work_center = '$wc'");
$up_sprayd2 = mysqli_fetch_array($up_spray2);
$t_upspray = $up_sprayd2['c_target'];


$y_upspray = 0;

?>
<script>
    var chartDom = document.getElementById('upspray');
    var myChart = echarts.init(chartDom);
    var option;

    const gaudeData_upspray = [{
            value: <?= $a_upspray ?>,
            name: 'Today',
            title: {
                offsetCenter: ['-90%', '88%']
            },
            detail: {
                offsetCenter: ['-90%', '125%']
            }
        },

        // {
        //     value: <?= $y_upspray ?>,
        //     name: 'Yesterday',
        //     title: {
        //         offsetCenter: ['0%', '105%']
        //     },
        //     detail: {
        //         offsetCenter: ['0%', '145%']
        //     }
        // },

        {
            value: <?= $t_upspray ?>,
            name: 'Target',
            title: {
                offsetCenter: ['90%', '88%']
            },
            detail: {
                offsetCenter: ['90%', '125%']
            }
        },
    ];
    option = {
        // '#FA4F55',
        color: ['#91CC75', '#5470C6'],
        series: [{
            center: ['50%', '35%'],
            min: 0,
            max: 100,
            splitNumber: 4,
            type: 'gauge',
            anchor: {
                show: true,
                showAbove: true,
                size: 10,
                itemStyle: {
                    color: '#999'
                }
            },
            pointer: {
                icon: 'path://M2.9,0.7L2.9,0.7c1.4,0,2.6,1.2,2.6,2.6v115c0,1.4-1.2,2.6-2.6,2.6l0,0c-1.4,0-2.6-1.2-2.6-2.6V3.3C0.3,1.9,1.4,0.7,2.9,0.7z',
                width: 5,
                length: '80%',
                offsetCenter: [0, '8%']
            },
            progress: {
                show: true,
                overlap: false,
                roundCap: true
            },
            axisLine: {
                roundCap: true,
                lineStyle: {
                    width: 13
                }
            },
            axisTick: {
                splitNumber: 4,
                lineStyle: {
                    width: 1,
                    color: '#999'
                }
            },
            data: gaudeData_upspray,
            title: {
                fontSize: 13
            },
            detail: {
                width: 35,
                height: 20,
                fontSize: 20,
                color: '#fff',
                backgroundColor: 'auto',
                lineHeight: 50,
                borderRadius: 5,
                offsetCenter: [0, '60%'],
                valueAnimation: true,
                formatter: '{value}%'
            }
        }]
    };

    option && myChart.setOption(option);
</script>