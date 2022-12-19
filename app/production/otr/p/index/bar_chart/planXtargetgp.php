<?php
$wc = 'G130';
$label = array();
$plan = array();
$target = array();
$actual = array();

for ($su = 1; $su <= $hari; $su++) {
    $label[$su] = $su;
    $tgl = $tahun . "-" . $bulan . "-" . $su;
    $sql = mysqli_query($connect_pro, "SELECT * FROM resume_plan_mainbody where c_date = '$tgl' and c_work_center = '$wc'");
    if (empty(mysqli_fetch_array($sql))) {
        $plan[$su] = 0;
        $target[$su] = 0;
        $actual[$su] = 0;
    } else {
        $sql2 = mysqli_query($connect_pro, "SELECT * FROM resume_plan_mainbody where c_date = '$tgl' and c_work_center = '$wc'");
        $data2 = mysqli_fetch_array($sql2);
        $plan[$su] = $data2['c_qty'];

        $targetcok = ($data2['c_target_otr'] / 100) * $data2['c_qty'];
        $targetcok = round($targetcok);
        $target[$su] = $targetcok;

        //get actual OTR
        $sql3 = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$tgl' and c_work_center = '$wc'");
        $data3 = mysqli_fetch_array($sql3);
        $actual[$su] = $data3['c_otr_qty'];
    }
}
?>
<script>
    var chartDom = document.getElementById('bar2');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#7D7CE0', '#FF7400', '#91cc75'],
        title: {
            text: 'Target OTR GP - <?= $bulan_sutena ?> (<?= $data2['c_target_otr'] ?>%)',
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
        toolbox: {
            feature: {
                // dataView: {
                //     show: true,
                //     readOnly: false
                // },
                // magicType: {
                //     show: true,
                //     type: ['line', 'bar']
                // },
                // restore: {
                //     show: true
                // },
                saveAsImage: {
                    show: true
                }
            }
        },
        legend: {
            data: ['Plan', 'Target OTR', 'Actual OTR'],
            top: 30
        },
        xAxis: [{
            type: 'category',
            data: [
                <?php
                for ($j = 1; $j <= $hari; $j++) {
                    echo "'" . $label[$j] . "',";
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
            // min: 0,
            // max: 120,
            // interval: 20,
            axisLabel: {
                formatter: '{value}'
            },
            name: 'Unit',
            nameLocation: 'center',
            nameGap: 50,

            nameTextStyle: {
                padding: [0, 0, -5, 0],
                fontWeight: 'bold'
            }
        }],
        series: [{
                name: 'Plan',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' unit';
                    }
                },
                // label: {
                //     show: true,
                //      rotate: 90
                // },
                data: [<?php
                        for ($j = 1; $j <= $hari; $j++) {
                            echo "" . $plan[$j] . ",";
                        }
                        ?>],
                // markPoint: {
                //     symbol: 'pin',
                //     label: {
                //         color: '#FFFFFF'
                //     },
                //     data: [{
                //         name: 'Max',
                //         type: 'max'
                //     }, ]
                // },
                // markLine: {
                //     data: [{
                //         name: 'Avg',
                //         type: 'average',
                //     }]
                // }
            },
            {
                name: 'Target OTR',
                type: 'line',
                step: 'middle',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' unit';
                    }
                },
                data: [<?php
                        for ($j = 1; $j <= $hari; $j++) {
                            echo "" . $target[$j] . ",";
                        }
                        ?>],
                // markLine: {
                //     data: [{
                //         name: 'Avg',
                //         type: 'average',
                //     }]
                // }
            },
            {
                name: 'Actual OTR',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' unit';
                    }
                },
                // label: {
                //     show: true,
                //      rotate: 90
                // },
                data: [<?php
                        for ($j = 1; $j <= $hari; $j++) {
                            echo "" . $actual[$j] . ",";
                        }
                        ?>],
                // markPoint: {
                //     symbol: 'pin',
                //     label: {
                //         color: '#FFFFFF'
                //     },
                //     data: [{
                //         name: 'Max',
                //         type: 'max'
                //     }, ]
                // },
                markLine: {
                    data: [{
                        name: 'Avg',
                        type: 'average',
                    }]
                }
            }
        ]
    };

    option && myChart.setOption(option);
</script>