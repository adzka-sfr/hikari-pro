<div id="bar2a" style="height:300px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; "></div>

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


$total_piano = array();
$total_temuan = array();
$ratio_ng = array();
$z = 0;

for ($tgl = 1; $tgl <= $sumOfDay; $tgl++) {
    $total_pianoe = 0;
    $total_temuane = 0;

    if ($tgl < 10) {
        $tgl = "0" . $tgl;
    }
    $tanggal = date('Y-m', strtotime($month_umpama));
    $tanggal = $tanggal . "-" . $tgl;

    //get jumlah piano
    $sup1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total from formng_register where c_finishcomplete1  LIKE '$tanggal%'");
    $data1 = mysqli_fetch_array($sup1);
    $total_pianoe1 = $data1['total'];

    $sup1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total from formng_register where c_finishcomplete2  LIKE '$tanggal%'");
    $data1 = mysqli_fetch_array($sup1);
    $total_pianoe2 = $data1['total'];

    $sup1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total from formng_register where c_finishcomplete3  LIKE '$tanggal%'");
    $data1 = mysqli_fetch_array($sup1);
    $total_pianoe3 = $data1['total'];

    $total_pianoe = $total_pianoe1 + $total_pianoe2 + $total_pianoe3;

    //get jumlah temuan cek 1
    $sup2a = mysqli_query($connect_pro, "SELECT COUNT(id) as total FROM formng_resultc WHERE c_inspectiondate1 LIKE '$tanggal%' AND c_result1 = 'NO'");
    $data2a = mysqli_fetch_array($sup2a);
    $total_temuane1 = $data2a['total'];

    //get jumlah temuan cek 2
    $sup2b = mysqli_query($connect_pro, "SELECT COUNT(id) as total FROM formng_resultc WHERE c_inspectiondate2 LIKE '$tanggal%' AND c_result2 = 'NO'");
    $data2b = mysqli_fetch_array($sup2b);
    $total_temuane2 = $data2b['total'];

    //get jumlah temuan cek 3
    $sup2c = mysqli_query($connect_pro, "SELECT COUNT(id) as total FROM formng_resultc WHERE c_inspectiondate3 LIKE '$tanggal%' AND c_result3 = 'NO'");
    $data2c = mysqli_fetch_array($sup2c);
    $total_temuane3 = $data2c['total'];

    $total_temuane = $total_temuane1 + $total_temuane2 + $total_temuane3;

    //get ratio ng
    if ($total_pianoe == 0) {
        $ratio_nge = 0;
    } else {
        $ratio_nge = $total_temuane / $total_pianoe;
        $ratio_nge = round($ratio_nge);
    }

    $total_piano[$z] = $total_pianoe;
    $total_temuan[$z] = $total_temuane;
    $ratio_ng[$z] = $ratio_nge;

    $z++;
}

$count_piano = count($total_piano);
$count_temuan = count($total_temuan);
$count_ng = count($ratio_ng);
// =========================================================== LOGIC
?>
<script>
    var chartDom = document.getElementById('bar2a');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#4A94CD', '#E95555', '#FF7400'],
        title: {
            text: 'Status Temuan Completeness (Daily)',
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
            data: ['Jumlah Piano', 'Jumlah Temuan', 'Ratio NG'],
            top: 30
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
                name: 'Jumlah Piano',
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
                        for ($b = 0; $b < $count_piano; $b++) {
                            echo $total_piano[$b] . ",";
                        }
                        ?>],
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
                        return value + ' ';
                    }
                },
                data: [<?php
                        for ($b = 0; $b < $count_temuan; $b++) {
                            echo $total_temuan[$b] . ",";
                        }
                        ?>]
            },
            {
                name: 'Ratio NG',
                type: 'line',
                // label: {
                //     show: true,
                //     position: 'top'
                // },
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [<?php
                        for ($b = 0; $b < $count_ng; $b++) {
                            echo $ratio_ng[$b] . ",";
                        }
                        ?>]
            }
        ]
    };

    option && myChart.setOption(option);
</script>