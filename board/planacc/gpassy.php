<?php
// $now = date('Y-m-d');
// $now = "2022-11-09";
$plan_gpa = 0;
$actual_gpa = 0;
$qgpa1 = mysqli_query($connect_pro, "SELECT work_center from master_workcenter where dept = 'gp assy'");
while ($dgpa1 = mysqli_fetch_array($qgpa1)) {
    $qgpa2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dgpa1[work_center]' ");
    $dgpa2 = mysqli_fetch_array($qgpa2);
    $plan_gpa = $plan_gpa + $dgpa2['plan'];

    $qgpa3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dgpa1[work_center]'");
    $dgpa3 = mysqli_fetch_array($qgpa3);
    $actual_gpa = $actual_gpa + $dgpa3['hasil'];
}
$persengpa = ($actual_gpa / $plan_gpa) * 100;
$persengpa = number_format($persengpa, 2, '.', '');
?>
<script>
    var chartDom = document.getElementById('ap_gpassy');
    var myChart = echarts.init(chartDom);
    var option;

    const gaugeDataGpassy = [{
            value: <?= $persengpa ?>,
            name: 'Actual',
            title: {
                offsetCenter: ['-80%', '85%']
            },
            detail: {
                offsetCenter: ['-80%', '110%']
            }
        },

        {
            value: 100,
            name: 'Plan',
            title: {
                offsetCenter: ['80%', '85%']
            },
            detail: {
                offsetCenter: ['80%', '110%']
            }
        }
    ];
    option = {
        color: ['#91CC75', '#5470C6'],
        series: [{
            center: ['50%', '45%'],
            min: 0,
            max: 200,
            splitNumber: 5,
            type: 'gauge',
            anchor: {
                show: true,
                showAbove: true,
                size: 10,
                itemStyle: {
                    color: '#999'
                }
            },
            pointer: {
                icon: 'path://M2.9,0.7L2.9,0.7c1.4,0,2.6,1.2,2.6,2.6v115c0,1.4-1.2,2.6-2.6,2.6l0,0c-1.4,0-2.6-1.2-2.6-2.6V3.3C0.3,1.9,1.4,0.7,2.9,0.7z',
                width: 5,
                length: '80%',
                offsetCenter: [0, '8%']
            },
            progress: {
                show: true,
                overlap: true,
                roundCap: true
            },
            axisLine: {
                roundCap: true,
                lineStyle: {
                    width: 10
                }
            },
            axisTick: {
                splitNumber: 4,
                lineStyle: {
                    width: 1,
                    color: '#999'
                }
            },
            data: gaugeDataGpassy,
            title: {
                fontSize: 14
            },
            detail: {
                width: 80,
                height: 14,
                fontSize: 20,
                color: '#fff',
                backgroundColor: 'auto',
                lineHeight: 50,
                borderRadius: 5,
                offsetCenter: [0, '50%'],
                valueAnimation: true,
                formatter: '{value}%'
            }
        }]
    };

    option && myChart.setOption(option);
</script>