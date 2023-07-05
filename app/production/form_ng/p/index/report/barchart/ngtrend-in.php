<div id="ngtrend" style="height:5000px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; ">a</div>

<?php
// =============================================== CONNECTION
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');

// setting default timezone
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
// $now = "2023-01-29 00:00:00";
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

$a = 0;

$intrend =  array();

//bulan lalu
$month_lalu = date('Y-m', strtotime('-1month', strtotime($month_umpama)));

$sql = mysqli_query($connect_pro, "SELECT c_ng FROM formng_itemnginside order by c_ng desc");
while ($data = mysqli_fetch_array($sql)) {
    //cek pada hasil pengecekan outside bulan ini
    $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_detail) as total FROM formng_resulti WHERE c_detail = '$data[c_ng]' AND c_inspectiondate LIKE '$month_umpama%'");
    $data1 = mysqli_fetch_array($sql1);
    $total_ng1 = $data1['total'];
    $total_ng11 = $total_ng1;

    //cek pada hasil pengecekan outside bulan lalu
    $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_detail) as total FROM formng_resulti WHERE c_detail = '$data[c_ng]' AND c_inspectiondate LIKE '$month_lalu%'");
    $data1 = mysqli_fetch_array($sql1);
    $total_ng1 = $data1['total'];
    $total_ng22 = $total_ng1;

    $intrend[$a] = array('nama' => $data['c_ng'], 'bulan-ini' => $total_ng11, 'bulan-lalu' => $total_ng22);

    $a++;
}

# get a list of sort columns and their data to pass to array_multisort
$sort = array();
foreach ($intrend as $k => $v) {
    $sort['bulan-lalu'][$k] = $v['bulan-lalu'];
}
# sort by event_type desc and then title asc
array_multisort($sort['bulan-lalu'], SORT_ASC, $intrend);

$colcount = count($intrend);
// =========================================================== LOGIC
?>
<script>
    var chartDom = document.getElementById('ngtrend');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#E95555', '#4A94CD', '#FF7400'],
        title: {
            text: 'NG Trend of Inside Check'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            data: ['Last Month', 'This Month']
        },
        grid: {
            left: '2%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [{
            type: 'value'
        }],
        yAxis: [{
            type: 'category',
            axisTick: {
                show: false
            },
            data: [
                <?php
                for ($i = 0; $i < $colcount; $i++) {
                    echo "'" . $intrend[$i]['nama'] . "',";
                }
                ?>
            ]
        }],
        series: [{
                name: 'Last Month',
                type: 'bar',
                barGap: '-100%',
                label: {
                    show: true,
                    // color: '#fff',
                    // position: 'inside',
                    fontWeight: 'bold',
                    position: 'right'
                },
                emphasis: {
                    focus: 'series'
                },
                data: [<?php
                        for ($i = 0; $i < $colcount; $i++) {
                            echo $intrend[$i]['bulan-lalu'] . ",";
                        }
                        ?>]
            },
            {
                name: 'This Month',
                type: 'bar',
                stack: 'Total',
                label: {
                    show: true,
                    // color: '#fff',
                    // position: 'inside',
                    fontWeight: 'bold',
                    position: 'right',
                },
                emphasis: {
                    focus: 'series'
                },
                data: [
                    <?php
                    for ($i = 0; $i < $colcount; $i++) {
                        echo $intrend[$i]['bulan-ini'] . ",";
                    }
                    ?>
                ]
            },
        ]
    };

    option && myChart.setOption(option);
</script>