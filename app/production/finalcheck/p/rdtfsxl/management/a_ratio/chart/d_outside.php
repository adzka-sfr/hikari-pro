<?php require '../../../config.php'; ?>
<div id="chsto" style="width: 100%;height:300px;"></div>

<?php
// array untuk menyimpan data hasil
$total_piano = array();
$total_temuan = array();
$ratio_ng = array();

$tanggal = date('Y-m-d', strtotime($now));
$labelbar = date('d M', strtotime($now));

//get jumlah piano
$q1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_repairtime WHERE c_repair_outsidetiga_o LIKE '$tanggal%'");
$d1 = mysqli_fetch_array($q1);
$piano = $d1['total'];

// get jumlah temuan cek 1
$q3 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_outside WHERE c_result_date LIKE '$tanggal%'");
$d3 = mysqli_fetch_array($q3);

$temuan = $d3['total'];
$total_temuan = $temuan;

//get Rata-Rata NG
if ($piano == 0) {
    $ratio_nge = 0;
} else {
    $ratio_nge = $temuan / $piano;
    $ratio_nge = number_format($ratio_nge, 2, '.', '');
}

$total_piano = $piano;
$ratio_ng = $ratio_nge;
?>
<script type="text/javascript">
    var chartDom = document.getElementById('chsto');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#4A94CD', '#E95555', '#FF7400'],
        // title: {
        //     text: 'Status Temuan Inside ()'
        // },
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
                // saveAsImage: {
                //     show: true
                // }
            }
        },
        legend: {
            data: ['Jumlah Piano', 'Jumlah Temuan', 'Rata-Rata NG'],
            top: 30
        },
        grid: {
            left: '2%',
            right: '4%',
            bottom: '10%',
            containLabel: true
        },
        xAxis: [{
            type: 'category',
            data: ['<?= $labelbar ?>'],
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
            axisLabel: {
                formatter: '{value}'
            },
            // name: 'Qty',
            nameLocation: 'center',
            nameGap: 50,

            nameTextStyle: {
                padding: [0, 0, -5, 0],
                fontWeight: 'bold'
            }
        }],
        series: [{
                name: 'Jumlah Piano',
                type: 'bar',
                // label: {
                //     show: true,
                //     position: 'top'
                // },
                tooltip: {
                    valueFormatter: function(value) {
                        return value + '';
                    }
                },

                data: [<?= $total_piano ?>]
            },
            {
                name: 'Jumlah Temuan',
                type: 'bar',
                // label: {
                //     show: true,
                //     position: 'top'
                // },
                tooltip: {
                    valueFormatter: function(value) {
                        return value + '';
                    }
                },
                data: [<?= $total_temuan ?>]
            },
            {
                name: 'Rata-Rata NG',
                type: 'line',
                // label: {
                //     show: true,
                //     position: 'top'
                // },
                tooltip: {
                    valueFormatter: function(value) {
                        return value + '';
                    }
                },
                data: [<?= $ratio_ng ?>]
            }
        ]
    };

    option && myChart.setOption(option);
</script>