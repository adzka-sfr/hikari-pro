<?php require '../../../config.php'; ?>
<div id="chsto" style="width: 100%;height:300px;"></div>

<?php
// untuk mendapatakan jumlah hari pada satu bulan
$kalenderMasehi = CAL_GREGORIAN;
$bulanSutena = date('m', strtotime($now));
$tahunGajah = date('Y', strtotime($now));
$sumOfDay = cal_days_in_month($kalenderMasehi, $bulanSutena, $tahunGajah);

// array untuk menyimpan data hasil
$c1 = array();
$c2 = array();
$c3 = array();

$z = 0;

for ($tgl = 1; $tgl <= $sumOfDay; $tgl++) {
    if ($tgl < 10) {
        $tgl = "0" . $tgl;
    }
    $tanggal = date('Y-m', strtotime($now));
    $tanggal = $tanggal . "-" . $tgl;

    // get data cek 1
    $process = 'oc1';
    $q1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_outside WHERE c_process = '$process' AND c_result_date LIKE '$tanggal%'");
    $d1 = mysqli_fetch_array($q1);
    array_push($c1, $d1['total']);

    // get data cek 2
    $process = 'oc2';
    $q2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_outside WHERE c_process = '$process' AND c_result_date LIKE '$tanggal%'");
    $d2 = mysqli_fetch_array($q2);
    array_push($c2, $d2['total']);

    // get data cek 3
    $process = 'oc3';
    $q3 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_outside WHERE c_process = '$process' AND c_result_date LIKE '$tanggal%'");
    $d3 = mysqli_fetch_array($q3);
    array_push($c3, $d3['total']);

    $z++;
}

$count_c1 = count($c1);
$count_c2 = count($c2);
$count_c3 = count($c3);
?>
<script type="text/javascript">
    var chartDom = document.getElementById('chsto');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#FF5739', '#69C33B', '#41A5E1'],
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
            data: ['Outside 1', 'Outside 2', 'Outside 3'],
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
            data: [<?php
                    for ($b = 1; $b <= $sumOfDay; $b++) {
                        echo "'" . $b . "',";
                    }
                    ?>],
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
                name: 'Outside 1',
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
                        for ($b = 0; $b < $count_c1; $b++) {
                            echo $c1[$b] . ",";
                        }
                        ?>]
            },
            {
                name: 'Outside 2',
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
                        for ($b = 0; $b < $count_c2; $b++) {
                            echo $c2[$b] . ",";
                        }
                        ?>]
            },
            {
                name: 'Outside 3',
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
                        for ($b = 0; $b < $count_c3; $b++) {
                            echo $c3[$b] . ",";
                        }
                        ?>]
            },
        ]
    };

    option && myChart.setOption(option);
</script>