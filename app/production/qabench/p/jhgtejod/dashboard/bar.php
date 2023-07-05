<div id="main" style="height:350px; padding-top: 10px; padding-bottom: 20px; "></div>
<script>
    var chartDom = document.getElementById('main');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        title: {
            text: 'Label Usage Data',
            subtext: '2023'
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
            data: ['Free', 'Used'],
            right: 'right'
        },
        color: ['#d9534f', '#5cb85c'],
        grid: {
            left: '3%',
            right: '3%',
            bottom: '6%',
            top: '25%',
            containLabel: true
        },
        xAxis: [{
            type: 'category',
            data: [
                'Jan',
                'Feb',
                'Mar',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            axisPointer: {
                type: 'shadow'
            },
            name: 'Month',
            nameLocation: 'center',
            nameGap: 30, // posisi
            nameTextStyle: {
                fontWeight: 'bold'
            }
        }],
        yAxis: [{
            type: 'value'
        }],
        series: [{
                name: 'Used',
                type: 'bar',
                stack: 'Ad',
                label: {
                    show: true
                },
                emphasis: {
                    focus: 'series'
                },
                data: [120, 132, 101, 134, 90, 230, 210]
            },
            {
                name: 'Free',
                type: 'bar',
                stack: 'Ad',
                label: {
                    show: true
                },
                emphasis: {
                    focus: 'series'
                },
                data: [220, 182, 191, 234, 290, 330, 310]
            }
        ]
    };

    option && myChart.setOption(option);
</script>