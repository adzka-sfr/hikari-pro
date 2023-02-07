<div id="bar1a" style="height:300px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; "></div>

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
// $now = '2022-12-13';
$month_umpama = date('Y-m', strtotime($now));
$month_judul = date('F', strtotime($now));

// untuk mendapatakan jumlah hari pada satu bulan
$kalenderMasehi = CAL_GREGORIAN;
$bulanSutena = date('m', strtotime($now));
$tahunGajah = date('Y', strtotime($now));
$sumOfDay = cal_days_in_month($kalenderMasehi, $bulanSutena, $tahunGajah);


$o1 = array();
$o2 = array();
$o3 = array();

$z = 0;
for ($tgl = 1; $tgl <= $sumOfDay; $tgl++) {
    if ($tgl < 10) {
        $tgl = "0" . $tgl;
    }
    $tanggal = date('Y-m', strtotime($month_umpama));
    $tanggal = $tanggal . "-" . $tgl;

    // get ng outside 1
    $sql = mysqli_query($connect_pro, "SELECT c_serialnumber FROM formng_resultro WHERE c_inspectiondate LIKE '$tanggal%' AND c_process = 'oc1' AND c_ng != ''");
    $v_count = 0;
    while ($data = mysqli_fetch_array($sql)) {
        $v_count++;
    }
    $p1 = $v_count;
    $o1[$z] = $p1;

    // get ng outside 2
    $sql = mysqli_query($connect_pro, "SELECT c_serialnumber FROM formng_resultro WHERE c_inspectiondate LIKE '$tanggal%' AND c_process = 'oc2' AND c_ng != ''");
    $v_count = 0;
    while ($data = mysqli_fetch_array($sql)) {
        $v_count++;
    }
    $p2 = $v_count;
    $o2[$z] = $p2;

    // get ng outside 3
    $sql = mysqli_query($connect_pro, "SELECT c_serialnumber FROM formng_resultro WHERE c_inspectiondate LIKE '$tanggal%' AND c_process = 'oc3' AND c_ng != ''");
    $v_count = 0;
    while ($data = mysqli_fetch_array($sql)) {
        $v_count++;
    }
    $p3 = $v_count;
    $o3[$z] = $p3;
    $z++;
}

$count_o1 = count($o1);
$count_o2 = count($o2);
$count_o3 = count($o3);
// =========================================================== LOGIC
?>
<script>
    var chartDom = document.getElementById('bar1a');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#FF5739', '#69C33B', '#41A5E1'],
        title: {
            text: 'Daily Data NG Found (<?= $month_judul ?>)',
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
            data: [
                <?php
                for ($b = 1; $b <= $sumOfDay; $b++) {
                    echo "'" . $b . "',";
                }
                ?>
            ],
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
                        return value + ' ';
                    }
                },

                data: [<?php
                        for ($b = 0; $b < $count_o1; $b++) {
                            echo $o1[$b] . ",";
                        }
                        ?>],
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
                        return value + ' ';
                    }
                },
                data: [<?php
                        for ($b = 0; $b < $count_o2; $b++) {
                            echo $o2[$b] . ",";
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
                        return value + ' ';
                    }
                },
                data: [<?php
                        for ($b = 0; $b < $count_o3; $b++) {
                            echo $o3[$b] . ",";
                        }
                        ?>]
            }
        ]
    };

    option && myChart.setOption(option);
</script>