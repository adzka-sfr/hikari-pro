<?php
$wc = 'W170';
$ww_hot1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$now' and c_work_center = '$wc'");
$ww_hotd1 = mysqli_fetch_array($ww_hot1);
if (empty($ww_hotd1)) {
    $a_wwhot = 0;
} elseif ($ww_hotd1['c_otr_qty'] == 0) {
    $a_wwhot = 0;
} else {
    $a_wwhot = ($ww_hotd1['c_otr_qty'] / $ww_hotd1['c_plan']) * 100;
    $a_wwhot = round($a_wwhot);
}

// target
$ww_hot2 = mysqli_query($connect_pro, "SELECT c_target FROM otr_target where c_work_center = '$wc'");
$ww_hotd2 = mysqli_fetch_array($ww_hot2);
$t_wwhot = $ww_hotd2['c_target'];

$y_wwhot = 55;

?>
<script>
    var chartDom = document.getElementById('wwhot');
    var myChart = echarts.init(chartDom);
    var option;

    const gaudeData_wwhot = [{
            value: <?= $a_wwhot ?>,
            name: 'Today',
            title: {
                offsetCenter: ['-90%', '88%']
            },
            detail: {
                offsetCenter: ['-90%', '125%']
            }
        },

        // {
        //     value: <?= $y_wwhot ?>,
        //     name: 'Yesterday',
        //     title: {
        //         offsetCenter: ['0%', '105%']
        //     },
        //     detail: {
        //         offsetCenter: ['0%', '140%']
        //     }
        // },

        {
            value: <?= $t_wwhot ?>,
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
            center: ['50%', '40%'],
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
            data: gaudeData_wwhot,
            title: {
                fontSize: 18
            },
            detail: {
                width: 75,
                height: 20,
                fontSize: 28,
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