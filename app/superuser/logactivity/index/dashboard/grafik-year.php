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

$total_qty = array();

$z = 0;

for ($bln = 1; $bln <= 12; $bln++) {

    if ($bln < 10) {
        $bln = "0" . $bln;
    }
    $tanggal = date('Y', strtotime($month_umpama));
    $tanggal = $tanggal . "-" . $bln;

    $jum = 0;
    $sql = mysqli_query($connect_log, "SELECT distinct employee_name FROM activity_log WHERE process_name = 'login' AND log_time LIKE '$tanggal%'");
    while ($data = mysqli_fetch_array($sql)) {
        $jum++;
    }

    $total_qty[$z] = $jum;
    $z++;
}

$count_qty = count($total_qty);
// =========================================================== LOGIC
?>
<script>
    var chartDom = document.getElementById('main2');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#4A94CD', '#E95555', '#FF7400'],
        title: {
            text: 'Intensity Logged into Hikari (<?= date('Y', strtotime($now)) ?>)',
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
            data: ['Qty'],
            top: 30,
            show: false
        },
        grid: {
            left: '0%',
            right: '0%',
            bottom: '10%',
            containLabel: true
        },
        xAxis: [{
            type: 'category',
            data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            axisPointer: {
                type: 'shadow'
            },
            name: 'Month',
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
        series: [

            {
                name: 'Qty',
                type: 'bar',
                label: {
                    show: true,
                    position: 'top'
                },
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' user';
                    }
                },
                data: [<?php
                        for ($b = 0; $b < $count_qty; $b++) {
                            echo $total_qty[$b] . ",";
                        }
                        ?>]
            }
        ]
    };

    option && myChart.setOption(option);
</script>