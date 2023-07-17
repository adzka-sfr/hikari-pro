<script type="text/javascript">
    var chartDom = document.getElementById('smalllong16');
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
            name: 'Small Long',
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
                    value: <?= $less16pcssl ?>,
                    name: '< 16 hours'
                },
                {
                    value: <?= $mid16pcssl ?>,
                    name: '> 16 hours & < 3 days'
                },
                {
                    value: <?= $more16pcssl ?>,
                    name: '> 3 days'
                }
            ]
        }]
    };

    option && myChart.setOption(option);

    myChart.on('click', function(params) {

        var model = params.name;
        var seri = params.seriesName;
        var ser = model + "+" + seri;

        window.open(
            'data.php?model=' + encodeURIComponent(ser)
        );
    });
</script>