<?php
// $now = '2022-11-04';
// $month_umpama = date('Y-m', strtotime($now));
// $connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$work_center = 'G130';
$otras = array();
$accas = array();
$z = 0;
$barqas = mysqli_query($connect_pro, "SELECT * from otr_history where c_date like '$month_umpama%' and c_work_center = '$work_center' order by c_date asc");

while ($bardas = mysqli_fetch_array($barqas)) {
    $barqas1 = mysqli_query($connect_pro, "SELECT * from resume_plan_mainbody where c_date = '$bardas[c_date]' and c_work_center = '$work_center'");
    // $bardas1 = mysqli_fetch_array($barqas1);

    if (empty(mysqli_fetch_array($barqas1))) {
        // echo "koosong";
    } else {
        $sup1 = mysqli_query($connect_pro, "SELECT * from resume_plan_mainbody where c_date = '$bardas[c_date]' and c_work_center = '$work_center'");
        $bardas1 = mysqli_fetch_array($sup1);
    }

    $barqas2 = mysqli_query($connect_pro, "SELECT SUM(c_qty) as totplan from resume_plan_mainbody WHERE c_date LIKE '$month_umpama%' and c_date <= '$bardas1[c_date]' and c_work_center = '$work_center'");
    $bardas2 = mysqli_fetch_array($barqas2);

    $pot = ($bardas['c_otr_qty'] / $bardas1['c_qty']) * 100;
    $pot = round($pot);
    $poc = ($bardas['c_otr_acc'] / $bardas2['totplan']) * 100;
    $poc = round($poc);

    $otras[$z] = $pot;
    $accas[$z] = $poc;
    $z++;
}

$count_otras = count($otras);
$count_accas = count($accas);
?>
<script>
    var chartDom = document.getElementById('bar2');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#946DC1', '#FF7400'],
        title: {
            text: 'OTR History of Assy GP (G130)-<?= $month_judul ?>',
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
            max: 80,
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
                name: 'OTR',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                // label: {
                //     show: true,
                //     rotate: 90
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
                        type: 'average',
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