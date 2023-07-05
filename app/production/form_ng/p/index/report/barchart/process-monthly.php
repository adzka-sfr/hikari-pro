<div id="bar1b" style="height:300px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; "></div>

<?php
// =============================================== CONNECTION
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');

// setting default timezone
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$now = date('Y-m-d', strtotime($now));

$servername = "localhost";
$username = "root";
$password = "";

// database
$db1 = "hikari";
$db2 = "hikari_project";
$db3 = "hikari_log";

// Create connection for main database (hikari)
$connect = new mysqli($servername, $username, $password, $db1);
// Create connection for project database (hikari_project)
$connect_pro = new mysqli($servername, $username, $password, $db2);
// Create connection for log database (hikari_log)
$connect_log = new mysqli($servername, $username, $password, $db3);

// $now = date('Y-m-d');
// $now = '2023-03-13';
$month_umpama = date('Y-m', strtotime($now));
$month_judul = date('F', strtotime($now));

// untuk mendapatakan jumlah hari pada satu bulan
$kalenderMasehi = CAL_GREGORIAN;
$bulanSutena = date('m', strtotime($now));
$tahunGajah = date('Y', strtotime($now));
$sumOfDay = cal_days_in_month($kalenderMasehi, $bulanSutena, $tahunGajah);

// hitung outside 1
$sql = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as piano1 FROM formng_repairdata WHERE c_startprocess LIKE '$month_umpama%' AND c_process = 'oc1'");
$data = mysqli_fetch_array($sql);
$p1 = $data['piano1'];

$sql = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as ng1 FROM formng_resultong WHERE c_inspectiondate LIKE '$month_umpama%' AND c_process = 'oc1'");
$data = mysqli_fetch_array($sql);
$ng1 = $data['ng1'];

if ($p1 == 0) {
    $r1 = 0;
} else {
    $r1 = $ng1 / $p1;
    // $r1 = round($r1);
    $r1 = number_format($r1, 2, '.', ',');
}

// hitung outside 2
$sql = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as piano2 FROM formng_repairdata WHERE c_startprocess LIKE '$month_umpama%' AND c_process = 'oc2'");
$data = mysqli_fetch_array($sql);
$p2 = $data['piano2'];

$sql = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as ng2 FROM formng_resultong WHERE c_inspectiondate LIKE '$month_umpama%' AND c_process = 'oc2'");
$data = mysqli_fetch_array($sql);
$ng2 = $data['ng2'];

if ($p2 == 0) {
    $r2 = 0;
} else {
    $r2 = $ng2 / $p2;
    // $r2 = round($r2);
    $r2 = number_format(
        $r2,
        2,
        '.',
        ','
    );
}

// hitung outside 3
$sql = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as piano3 FROM formng_repairdata WHERE c_startprocess LIKE '$month_umpama%' AND c_process = 'oc3'");
$data = mysqli_fetch_array($sql);
$p3 = $data['piano3'];

$sql = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as ng3 FROM formng_resultong WHERE c_inspectiondate LIKE '$month_umpama%' AND c_process = 'oc3'");
$data = mysqli_fetch_array($sql);
$ng3 = $data['ng3'];


if ($p3 == 0) {
    $r3 = 0;
} else {
    $r3 = $ng3 / $p3;
    // $r3 = round($r3);
    $r3 = number_format(
        $r3,
        2,
        '.',
        ','
    );
}

// =========================================================== LOGIC
?>
<script>
    var chartDom = document.getElementById('bar1b');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#4A94CD', '#E95555', '#FF7400'],
        title: {
            text: 'Data NG Found by Process (<?= $month_judul ?>)',
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
                // saveAsImage: {
                //     show: true
                // }
            }
        },
        legend: {
            data: ['Jumlah Piano', 'Jumlah Temuan', 'Rata-Rata NG'],
            top: 30
        },
        xAxis: [{
            type: 'category',
            data: ['Outside 1', 'Outside 2', 'Outside 3'],
            axisPointer: {
                type: 'shadow'
            },
            // name: 'Month',
            // nameLocation: 'center',
            // nameGap: 30, // posisi
            // nameTextStyle: {
            //     fontWeight: 'bold'
            // }
        }],
        yAxis: [{
            type: 'value',
            min: 0,
            max: 150,
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
                label: {
                    show: true,
                    position: 'top',
                    fontWeight: 'bold'
                },
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' ';
                    }
                },

                data: [<?= $p1 ?>, <?= $p2 ?>, <?= $p3 ?>],
            },
            {
                name: 'Jumlah Temuan',
                type: 'bar',
                label: {
                    show: true,
                    position: 'top',
                    fontWeight: 'bold'
                },
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' ';
                    }
                },
                data: [<?= $ng1 ?>, <?= $ng2 ?>, <?= $ng3 ?>]
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
                data: [<?= $r1 ?>, <?= $r2 ?>, <?= $r3 ?>]
            }
        ]
    };

    option && myChart.setOption(option);
</script>