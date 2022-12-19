<?php
$wc_gp = 'G130';
$month_ago = date('Y-m', strtotime($now));
$awal_bulan = date('d', strtotime($now));

$acgp1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$now' AND c_work_center = '$wc_gp'");
$acdgp1 = mysqli_fetch_array($acgp1);

$bagian_acgp = $acdgp1['c_otr_acc'];
$semua_acgp = $acdgp1['c_plan_acc'];

$persen_acgp = ($bagian_acgp / $semua_acgp) * 100;
$persen_acgp = round($persen_acgp);

// target
$acgp2 = mysqli_query($connect_pro, "SELECT c_target FROM otr_target where c_work_center = '$wc_gp'");
$acdgp2 = mysqli_fetch_array($acgp2);
$target_acgp = $acdgp2['c_target'];
?>
<script>
    var chartDom = document.getElementById('accumulation_assygp');
    var myChart = echarts.init(chartDom);
    var option;

    const gaudeDataAcc_assygp = [{
            value: <?= $persen_acgp ?>,
            name: 'Acc',
            title: {
                offsetCenter: ['-80%', '93%']
            },
            detail: {
                offsetCenter: ['-80%', '130%']
            }
        },

        {
            value: <?= $target_acgp ?>,
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
        color: ['#FF7400', '#5470C6'],
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
            data: gaudeDataAcc_assygp,
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