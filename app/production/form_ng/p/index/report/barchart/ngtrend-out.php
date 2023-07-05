<div id="ngtrend" style="height:4000px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; "></div>

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
$nama_ng = array();
$nilai_ng = array();
$nilai_ng_lalu = array();

$outtrend =  array();

//bulan lalu
$month_lalu = date('Y-m', strtotime('-1month', strtotime($month_umpama)));

$sql = mysqli_query($connect_pro, "SELECT * FROM formng_listng where c_area = 'outside' order by c_ng desc");
while ($data = mysqli_fetch_array($sql)) {
    //cek pada hasil pengecekan outside bulan ini
    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM formng_resultong WHERE c_ng = '$data[c_ng]' AND c_inspectiondate LIKE '$month_umpama%'");
    $data2 = mysqli_fetch_array($sql2);
    $total_ng2a = $data2['total'];
    $total_ng11 = $total_ng2a;

    //cek pada hasil pengecekan outside bulan lalu
    $sql2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM formng_resultong WHERE c_ng = '$data[c_ng]' AND c_inspectiondate LIKE '$month_lalu%'");
    $data2 = mysqli_fetch_array($sql2);
    $total_ng2a = $data2['total'];
    $total_ng22 = $total_ng2a;

    $outtrend[$a] = array('nama' => $data['c_ng'], 'bulan-ini' => $total_ng11, 'bulan-lalu' => $total_ng22);

    $a++;
}
# get a list of sort columns and their data to pass to array_multisort
$sort = array();
foreach ($outtrend as $k => $v) {
    $sort['bulan-lalu'][$k] = $v['bulan-lalu'];
}
# sort by event_type desc and then title asc
array_multisort($sort['bulan-lalu'], SORT_ASC, $outtrend);

$colcount = count($outtrend);
// =========================================================== LOGIC
?>
<script>
    var chartDom = document.getElementById('ngtrend');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#E95555', '#4A94CD', '#FF7400'],
        title: {
            text: 'NG Trend of Outside Check'
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
                for ($i = 1; $i < $colcount; $i++) {
                    echo "'" . $outtrend[$i]['nama'] . "',";
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
                            echo $outtrend[$i]['bulan-lalu'] . ",";
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
                        echo $outtrend[$i]['bulan-ini'] . ",";
                    }
                    ?>
                ]
            },
        ]
    };

    option && myChart.setOption(option);
</script>