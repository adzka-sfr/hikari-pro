<?php
$a_wwout = 85;
$y_wwout = 55;
$t_wwout = 100;

?>
<script>
    var chartDom = document.getElementById('wwout');
    var myChart = echarts.init(chartDom);
    var option;

    const gaudeData_wwout = [{
            value: <?= $a_wwout ?>,
            name: 'Today',
            title: {
                offsetCenter: ['-90%', '88%']
            },
            detail: {
                offsetCenter: ['-90%', '125%']
            }
        },

        {
            value: <?= $y_wwout ?>,
            name: 'Yesterday',
            title: {
                offsetCenter: ['0%', '105%']
            },
            detail: {
                offsetCenter: ['0%', '140%']
            }
        },

        {
            value: <?= $t_wwout ?>,
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
        color: ['#91CC75', '#FA4F55', '#5470C6'],
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
            data: gaudeData_wwout,
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