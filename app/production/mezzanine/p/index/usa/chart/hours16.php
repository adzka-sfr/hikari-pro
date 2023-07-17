<script type="text/javascript">
    var chartDom = document.getElementById('hour16');
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
            orient: 'vertical',
            left: 'left',
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
                    value: <?= $awal16 ?>,
                    name: '< 16H'
                },
                {
                    value: <?= $tengah16 ?>,
                    name: '> 16H'
                },
                {
                    value: <?= $akhir16 ?>,
                    name: '> 3D'
                }
            ],
        }]
    };

    option && myChart.setOption(option);
</script>