<script type="text/javascript">
    var chartDom = document.getElementById('hour2');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#ee6666', '#91cc75', '#fac858'],
        tooltip: {
            show: true,
            formatter: function(params) {
                let res = "";

                res += "Value : " + params.value.toLocaleString() + ' Rak</br>';
                res += "Percent : " + params.percent + ' %</br>';

                return res;
            }
        },
        legend: {
            orient: 'horizontal',
            left: 'center',
            show: false
        },
        series: [{
            center: ['50%', '50%'],
            name: 'Qty of',
            type: 'pie',
            radius: ['25%', '60%'],
            avoidLabelOverlap: false,
            label: {
                formatter: '{b}= {c} Rak',
                // position: 'inside'
            },
            labelLine: {
                show: true
            },
            data: [{
                    value: <?= $belum2 ?>,
                    name: '< 2H'
                },
                {
                    value: <?= $sudah2 ?>,
                    name: '> 2H'
                }
            ]
        }]
    };

    option && myChart.setOption(option);
</script>