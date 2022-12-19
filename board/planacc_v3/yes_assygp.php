<?php
$wc_gp = 'G130';
$ago = date('Y-m-d', strtotime('-1day', strtotime($now)));
$month_ago = date('Y-m', strtotime($now));
$awal_bulan = date('d', strtotime($now));

// MELAKUKAN PENGECEKAN OTR PADA BULAN KEMAREN JIKA SEKARANG TANGGAL 1
if ($awal_bulan == '01') {
    $month_ago = date('Y-m', strtotime('-1month', strtotime($now)));
    $yag1 = mysqli_query($connect_pro, "SELECT MAX(c_date) as date_max FROM otr_history WHERE c_date LIKE  '$month_ago%' and  c_otr_qty > 0");
    $yagA = mysqli_fetch_array($yag1);

    // ambil data plan kemarin
    $q_yag1 = mysqli_query($connect_pro, "SELECT * from resume_plan_mainbody where c_date = '$yagA[date_max]' and c_work_center = '$wc_gp'");
    $d_yag1 = mysqli_fetch_array($q_yag1);

    // ambil data otr kemarin
    $q_yag = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$yagA[date_max]' and c_work_center = '$wc_gp'");
    $d_yag = mysqli_fetch_array($q_yag);

    // hitung persentase on time rate berdasarkan plan recovery
    $ay_assygp = ($d_yag['c_otr_qty'] / $d_yag1['c_qty']) * 100;
    $ay_assygp = round($ay_assygp);

    // target bulan ini
    $ty_assygp = $d_yag1['c_target_otr'];
} else {
    // CEK DATA KEMARIN APAKAH ADA ATAU TIDAK -> JIKA KEMARIN MINGGU OTOMATIS DATA TIDAK ADA
    $yag1 = mysqli_query($connect_pro, "SELECT MAX(c_date) as date_max FROM otr_history WHERE c_date LIKE  '$month_ago%' and  c_otr_qty > 0 and c_date < '$now'");
    $yagA = mysqli_fetch_array($yag1);

    // ambil data plan kemarin
    $q_yag1 = mysqli_query($connect_pro, "SELECT * from resume_plan_mainbody where c_date = '$yagA[date_max]' and c_work_center = '$wc_gp'");
    $d_yag1 = mysqli_fetch_array($q_yag1);

    // ambil data otr kemarin
    $q_yag = mysqli_query($connect_pro, "SELECT * from otr_history where c_date = '$yagA[date_max]' and c_work_center = '$wc_gp'");
    $d_yag = mysqli_fetch_array($q_yag);

    // hitung persentase on time rate berdasarkan plan recovery
    $ay_assygp = ($d_yag['c_otr_qty'] / $d_yag1['c_qty']) * 100;
    $ay_assygp = round($ay_assygp);

    // target bulan ini
    $ty_assygp = $d_yag1['c_target_otr'];
}

?>
<script>
    var chartDom = document.getElementById('yesterday_assygp');
    var myChart = echarts.init(chartDom);
    var option;

    const gaudeDataYes_assygp = [{
            value: <?= $ay_assygp ?>,
            name: 'Yesterday',
            title: {
                offsetCenter: ['-80%', '93%']
            },
            detail: {
                offsetCenter: ['-80%', '130%']
            }
        },

        {
            value: <?= $ty_assygp ?>,
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
        color: ['#FA4F55', '#5470C6'],
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
            data: gaudeDataYes_assygp,
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