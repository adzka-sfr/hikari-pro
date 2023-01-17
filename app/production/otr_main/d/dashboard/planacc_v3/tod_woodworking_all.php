<?php
$dept = 'woodworking';
$pn_otr = 0;
$pn_plan = 0;
$pn_target = 0;
$pn_count = 0;
$acpn1a = mysqli_query($connect_pro, "SELECT work_center FROM master_workcenter WHERE dept = '$dept'");
while ($acpn1b = mysqli_fetch_array($acpn1a)) {
    $acpn4a = mysqli_query($connect_pro, "SELECT c_target FROM otr_target WHERE c_work_center = '$acpn1b[work_center]'");
    $acpn4b = mysqli_fetch_array($acpn4a);
    $pn_target = $pn_target +  $acpn4b['c_target'];
    $pn_count++;

    $acpn2a = mysqli_query($connect_pro, "SELECT id FROM otr_history WHERE c_date = '$now' AND c_work_center = '$acpn1b[work_center]'");
    if (!empty(mysqli_fetch_array($acpn2a))) {
        $acpn3a = mysqli_query($connect_pro, "SELECT c_plan, c_otr_qty FROM otr_history WHERE c_date = '$now' AND c_work_center ='$acpn1b[work_center]'");
        $acpn3b = mysqli_fetch_array($acpn3a);
        $pn_otr = $pn_otr  + $acpn3b['c_otr_qty'];
        $pn_plan = $pn_plan + $acpn3b['c_plan'];
    } else {
        // nilai untuk workcenter ini pada bulan ini kosong
        $pn_otr = $pn_otr  + 0;
        $pn_plan = $pn_plan + 0;
    }
}

$tt_woodworking = ($pn_otr / $pn_plan) * 100;
$tt_woodworking = round($tt_woodworking);

$at_woodworking = $pn_target / $pn_count;
$at_woodworking = round($at_woodworking);

?>
<script>
    var chartDom = document.getElementById('today_woodworking');
    var myChart = echarts.init(chartDom);
    var option;

    const gaugeDataTod_woodworking = [{
            value: <?= $tt_woodworking ?>,
            name: 'Today',
            title: {
                offsetCenter: ['-80%', '93%']
            },
            detail: {
                offsetCenter: ['-80%', '130%']
            }
        },

        {
            value: <?= $at_woodworking ?>,
            name: 'Target',
            title: {
                offsetCenter: ['80%', '93%']
            },
            detail: {
                offsetCenter: ['80%', '130%']
            }
        }
    ];
    option = {
        color: ['#91CC75', '#5470C6'],
        series: [{
            center: ['50%', '40%'],
            min: 0,
            max: 100,
            splitNumber: 4,
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
                overlap: false,
                roundCap: true
            },
            axisLine: {
                roundCap: true,
                lineStyle: {
                    width: 13
                }
            },
            axisTick: {
                splitNumber: 4,
                lineStyle: {
                    width: 1,
                    color: '#999'
                }
            },
            data: gaugeDataTod_woodworking,
            title: {
                fontSize: 18
            },
            detail: {
                width: 70,
                height: 20,
                fontSize: 25,
                color: '#fff',
                backgroundColor: 'auto',
                lineHeight: 50,
                borderRadius: 5,
                offsetCenter: [0, '60%'],
                valueAnimation: true,
                formatter: '{value}%'
            }
        }]
    };

    option && myChart.setOption(option);
</script>