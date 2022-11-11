<script type="text/javascript">
    var chartDom = document.getElementById('main2');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center'
        },
        // untuk tulisan di tengah
        graphic: {
            elements: [{
                type: 'text',
                left: 'center',
                top: 'middle',
                z: 999,
                style: {
                    text: `Total <?= $total ?>`,
                    textAlign: 'center',
                    fontSize: 26
                }
            }]
        },
        // untuk tulisan di tengah
        series: [{
            name: 'Status',
            type: 'pie',
            radius: ['40%', '70%'],
            avoidLabelOverlap: false,
            itemStyle: {
                borderRadius: 10,
                borderColor: '#fff',
                borderWidth: 2
            },
            label: {
                show: false,
                position: 'center'
            },
            labelLine: {
                show: false
            },
            data: [<?php for ($i = 0; $i < count($nama); $i++) {
                        echo "{value:" . $qty[$i] . ", name:'" . $nama[$i] . "'},";
                    } ?>]
        }]
    };

    option && myChart.setOption(option);
</script>