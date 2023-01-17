<?php
$dept = 'painting';
$otras = array();
$accas = array();
$z = 0;

$barqas = mysqli_query($connect_pro, "SELECT distinct c_date from otr_history where c_date like '$month_umpama%' order by c_date asc");
while ($bardas = mysqli_fetch_array($barqas)) {
    $barqas1 = mysqli_query($connect_pro, "SELECT SUM(c_plan) as plandaily, SUM(c_plan_acc) as planacc, SUM(c_otr_qty) as otrdaily, SUM(c_otr_acc) as otracc  FROM otr_history oh JOIN master_workcenter mw ON oh.c_work_center = mw.work_center WHERE dept = '$dept' AND c_date = '$bardas[c_date]'");
    $bardas1 = mysqli_fetch_array($barqas1);

    if ($bardas1['plandaily'] != 0) {
        $d = ($bardas1['otrdaily'] / $bardas1['plandaily']) * 100;
        $d = round($d);
        $otras[$z] = $d;
    } else {
        $otras[$z] = 0;
    }

    if ($bardas1['planacc'] != 0) {
        $a = ($bardas1['otracc'] / $bardas1['planacc']) * 100;
        $a = round($a);
        $accas[$z] = $a;
    } else {
        $accas[$z] = 0;
    }

    $z++;
}
$count_otras = count($otras);
$count_accas = count($accas);

$baruptarget = 0;
$count_target = 0;
$barqas2 = mysqli_query($connect_pro, "SELECT work_center FROM master_workcenter where dept = '$dept'");
while ($bardas2 = mysqli_fetch_array($barqas2)) {
    $barqas3 = mysqli_query($connect_pro, "SELECT c_target FROM otr_target WHERE c_work_center = '$bardas2[work_center]'");
    $bardas3 = mysqli_fetch_array($barqas3);
    $baruptarget = $baruptarget + $bardas3['c_target'];
    $count_target++;
}
$baruptarget = $baruptarget / $count_target;
?>
<script>
    var chartDom = document.getElementById('bar');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#BC5672', '#FF7400'],
        title: {
            text: 'OTR History of Painting (All) -<?= $month_judul ?>',
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
            data: ['OTR', 'OTR Acc'],
            top: 30
        },
        xAxis: [{
            type: 'category',
            data: [
                <?php
                for ($b = 1; $b <= $sumOfDay; $b++) {
                    echo "'" . $b . "',";
                }
                // for ($b = 0; $b < $count_dayas; $b++) {
                //     echo "'" . $dayas[$b] . "',";
                // }
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
            max: 100,
            interval: 20,
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
                name: 'OTR',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                // label: {
                //     show: true,
                //      rotate: 90
                // },
                data: [<?php
                        for ($b = 0; $b < $count_otras; $b++) {
                            echo $otras[$b] . ",";
                        }
                        ?>],
                markPoint: {
                    symbol: 'pin',
                    label: {
                        color: '#FFFFFF'
                    },
                    data: [{
                        name: 'Max',
                        type: 'max'
                    }, ]
                },
                markLine: {
                    data: [{
                        name: 'Avg',
                        // type: 'average',
                        yAxis: <?= $baruptarget ?>
                    }]
                }
            },
            {
                name: 'OTR Acc',
                type: 'line',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [<?php
                        for ($b = 0; $b < $count_accas; $b++) {
                            echo $accas[$b] . ",";
                        }
                        ?>]
            }
        ]
    };

    option && myChart.setOption(option);
</script>