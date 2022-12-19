<?php
$wc_gp = 'G130';
$tod_dino = date('D', strtotime($now));

if (($tod_dino == 'Sat') or ($tod_dino == 'Sun')) {
    $at_assygp = 0;
    $tt_assygp = 0;
} else {

    // CEK APAKAH SUDAH ADA TRANSAKSI ATAU BELUM PADA HARI INI
    $q_tag2 = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$now' and c_work_center = '$wc_gp'");
    if (empty(mysqli_fetch_array($q_tag2))) {
        // ambil data plan hari ini
        $q_tag1 = mysqli_query($connect_pro, "SELECT * from resume_plan_mainbody where c_date = '$now' and c_work_center = '$wc_gp'");
        $d_tag1 = mysqli_fetch_array($q_tag1);

        $at_assygp = 0;
        // target bulan ini
        $tt_assygp =  $d_tag1['c_target_otr'];
    } else {
        // ambil data plan hari ini
        $q_tag1 = mysqli_query($connect_pro, "SELECT * from resume_plan_mainbody where c_date = '$now' and c_work_center = '$wc_gp'");
        $d_tag1 = mysqli_fetch_array($q_tag1);

        // ambil data otr hari ini
        $q_tag = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$now' and c_work_center = '$wc_gp'");
        $d_tag = mysqli_fetch_array($q_tag);

        // hitung persentase on time rate berdasarkan plan recovery
        $at_assygp = ($d_tag['c_otr_qty'] / $d_tag1['c_qty']) * 100;
        $at_assygp = round($at_assygp);
        // target bulan ini
        $tt_assygp =  $d_tag1['c_target_otr'];
    }

    // target
    $q_tag3 = mysqli_query($connect_pro, "SELECT c_target FROM otr_target where c_work_center = '$wc_gp'");
    $d_tag3 = mysqli_fetch_array($q_tag3);
    $tt_assygp = $d_tag3['c_target'];
}
?>
<script>
    var chartDom = document.getElementById('today_assygp');
    var myChart = echarts.init(chartDom);
    var option;

    const gaudeDataTod_assygp = [{
            value: <?= $at_assygp ?>,
            name: 'Today',
            title: {
                offsetCenter: ['-80%', '93%']
            },
            detail: {
                offsetCenter: ['-80%', '130%']
            }
        },

        {
            value: <?= $tt_assygp ?>,
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
            data: gaudeDataTod_assygp,
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