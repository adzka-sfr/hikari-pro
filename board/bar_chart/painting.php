<?php
$date =  array();
for ($a = 0; $a <= 30; $a++) {
    $date[$a] = $a;
}
?>
<script>
    var chartDom = document.getElementById('painting');
    var myChart = echarts.init(chartDom);
    var option;

    option = {

        // color: ['#494DBB', '#D9534F'],
        title: {
            text: 'OTR History of Painting',
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
        // toolbox: {
        //     feature: {
        //         dataView: {
        //             show: true,
        //             readOnly: false
        //         },
        //         magicType: {
        //             show: true,
        //             type: ['line', 'bar']
        //         },
        //         restore: {
        //             show: true
        //         },
        //         saveAsImage: {
        //             show: true
        //         }
        //     }
        // },
        legend: {
            data: ['P220', 'P520', 'P530', 'P550', 'P700', 'P820'],
            top: 30
        },
        xAxis: [{
            type: 'category',
            data: [
                <?php
                for ($b = 1; $b <= 31; $b++) {
                    echo "'" . $b . "',";
                }
                ?>
            ],
            axisPointer: {
                type: 'shadow'
            },
            name: 'Date',
            nameLocation: 'center',
            nameGap: 30, // posisi
            nameTextStyle: {
                fontWeight: 'bold'
            }
        }],
        yAxis: [{
            type: 'value',
            min: 0,
            max: 70,
            interval: 10,
            axisLabel: {
                formatter: '{value} %'
            },
            name: 'Percentage',
            nameLocation: 'center',
            nameGap: 50,

            nameTextStyle: {
                padding: [0, 0, -5, 0],
                fontWeight: 'bold'
            }
        }],
        series: [{
                name: 'P220',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [<?php
                        for ($b = 1; $b <= 25; $b++) {
                            echo (rand(20, 50)) . ",";
                        }
                        ?>],
            },
            {
                name: 'P520',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [<?php
                        for ($b = 1; $b <= 25; $b++) {
                            echo (rand(20, 50)) . ",";
                        }
                        ?>],
            },
            {
                name: 'P530',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [<?php
                        for ($b = 1; $b <= 25; $b++) {
                            echo (rand(20, 50)) . ",";
                        }
                        ?>],
            },
            {
                name: 'P550',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [<?php
                        for ($b = 1; $b <= 25; $b++) {
                            echo (rand(20, 50)) . ",";
                        }
                        ?>],
            },
            {
                name: 'P700',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [<?php
                        for ($b = 1; $b <= 25; $b++) {
                            echo (rand(20, 50)) . ",";
                        }
                        ?>],
            },
            {
                name: 'P820',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [<?php
                        for ($b = 1; $b <= 25; $b++) {
                            echo (rand(20, 50)) . ",";
                        }
                        ?>],
            },
        ]
    };

    option && myChart.setOption(option);
</script>