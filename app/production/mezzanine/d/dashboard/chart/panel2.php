<script type="text/javascript">
    var chartDom = document.getElementById('panel2');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#ee6666', '#91cc75', '#fac858'],
        tooltip: {
            show: true,
            formatter: function(params) {
                let res = "";

                res += "Value : " + params.value.toLocaleString() + ' pcs</br>';
                res += "Percent : " + params.percent + ' %</br>';

                return res;
            }
        },
        legend: {
            orient: 'vertical',
            left: 'left',
        },
        series: [{
            center: ['50%', '65%'],
            name: 'Qty of',
            type: 'pie',
            radius: ['25%', '60%'],
            avoidLabelOverlap: false,
            label: {
                show: false,
                position: 'center'
            },
            labelLine: {
                show: false
            },
            data: [{
                    value: <?= $less_pcs_p ?>,
                    name: '< 2 hours'
                },
                {
                    value: <?= $more_pcs_p ?>,
                    name: '> 2 hours'
                }
            ]
        }]
    };

    option && myChart.setOption(option);
</script>