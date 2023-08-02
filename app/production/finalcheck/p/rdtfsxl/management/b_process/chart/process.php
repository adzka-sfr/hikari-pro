<?php require '../../../config.php'; ?>
<div id="chstp" style="width: 100%;height:300px;"></div>

<?php
// array untuk menyimpan data hasil
$total_piano = array();
$total_temuan = array();
$ratio_ng = array();
$tanggal = date('Y-m', strtotime($now));

// get jumlah piano dan jumlah temuan dan jumlah rata-rata
for ($a = 1; $a < 4; $a++) {
    $process = "oc" . $a;

    // get jumlah piano
    $q1 = mysqli_query($connect_pro, "SELECT COUNT(DISTINCT c_serialnumber) as total FROM finalcheck_outside WHERE c_process = '$process' AND c_result_date LIKE '$tanggal%'");
    $d1 = mysqli_fetch_array($q1);
    array_push($total_piano, $d1['total']);

    // get jumlah temuan
    $q2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_outside WHERE c_process = '$process' AND c_result_date LIKE '$tanggal%'");
    $d2 = mysqli_fetch_array($q2);
    array_push($total_temuan, $d2['total']);

    // get jumlah rata-rata
    if ($d1['total'] == 0) {
        $ratio_nge = 0;
    } else {
        $ratio_nge = $d2['total'] / $d1['total'];
        $ratio_nge = number_format($ratio_nge, 2, '.', '');
    }
    array_push($ratio_ng, $ratio_nge);
}
?>
<script type="text/javascript">
    var chartDom = document.getElementById('chstp');
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
            data: ['Outside 1', 'Outside 2', 'Outside 3'],
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

                data: [<?php
                        for ($b = 0; $b < 3; $b++) {
                            echo $total_piano[$b] . ',';
                        }
                        ?>]
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
                data: [<?php
                        for ($b = 0; $b < 3; $b++) {
                            echo $total_temuan[$b] . ',';
                        }
                        ?>]
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
                data: [<?php
                        for ($b = 0; $b < 3; $b++) {
                            echo $ratio_ng[$b] . ',';
                        }
                        ?>]
            }
        ]
    };

    option && myChart.setOption(option);
</script>