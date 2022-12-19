<?php
$apq1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$now' and c_work_center = 'P220'");
$apd1 = mysqli_fetch_array($apq1);
if (empty($apd1)) {
    $akuP220 = 0;
} else {
    $akuP220 = ($apd1['c_otr_acc'] / $apd1['c_plan_acc']) * 100;
    $akuP220 = round($akuP220);
}

$apq1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$now' and c_work_center = 'P520'");
$apd1 = mysqli_fetch_array($apq1);
if (empty($apd1)) {
    $akuP520 = 0;
} else {
    $akuP520 = ($apd1['c_otr_acc'] / $apd1['c_plan_acc']) * 100;
    $akuP520 = round($akuP520);
}

$apq1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$now' and c_work_center = 'P530'");
$apd1 = mysqli_fetch_array($apq1);
if (empty($apd1)) {
    $akuP530 = 0;
} else {
    $akuP530 = ($apd1['c_otr_acc'] / $apd1['c_plan_acc']) * 100;
    $akuP530 = round($akuP530);
}

$apq1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$now' and c_work_center = 'P550'");
$apd1 = mysqli_fetch_array($apq1);
if (empty($apd1)) {
    $akuP550 = 0;
} else {
    $akuP550 = ($apd1['c_otr_acc'] / $apd1['c_plan_acc']) * 100;
    $akuP550 = round($akuP550);
}

$apq1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$now' and c_work_center = 'P700'");
$apd1 = mysqli_fetch_array($apq1);
if (empty($apd1)) {
    $akuP700 = 0;
} else {
    $akuP700 = ($apd1['c_otr_acc'] / $apd1['c_plan_acc']) * 100;
    $akuP700 = round($akuP700);
}

$apq1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$now' and c_work_center = 'P820'");
$apd1 = mysqli_fetch_array($apq1);
if (empty($apd1)) {
    $akuP820 = 0;
} else {
    $akuP820 = ($apd1['c_otr_acc'] / $apd1['c_plan_acc']) * 100;
    $akuP820 = round($akuP820);
}
?>
<script>
    var chartDom = document.getElementById('bar');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#EE6666', '#91CC75'],
        title: {
            text: 'OTR Accumulation Painting-<?= $month_judul ?>',
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
            data: ['Target Acc', 'Actual Acc'],
            orient: 'vertical',
            right: 'right',
            top: 'center',
        },
        xAxis: [{
            type: 'category',
            data: ['P220', 'P520', 'P530', 'P550', 'P700', 'P820'],
            axisPointer: {
                type: 'shadow'
            }
        }],
        yAxis: [{
            type: 'value',
            min: 0,
            max: 100,
            axisLabel: {
                formatter: '{value} %'
            }
        }],
        series: [{
                name: 'Target Acc',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [50, 50, 50, 50, 50, 50]
            },
            {
                name: 'Actual Acc',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [<?= $akuP220 ?>, <?= $akuP520 ?>, <?= $akuP530 ?>, <?= $akuP550 ?>, <?= $akuP700 ?>, <?= $akuP820 ?>]
            }
        ]
    };

    option && myChart.setOption(option);
</script>