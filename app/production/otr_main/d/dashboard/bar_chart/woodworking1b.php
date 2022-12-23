<div id="bar1b" style="height:300px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; "></div>

<?php
// $now = '2022-12-23';
// $month_umpama = date('Y-m', strtotime($now));
// $connect_pro = new mysqli("localhost", "root", "", "hikari_project");
// $work_center = 'P550';
if (empty($_POST['isib'])) {
    $list = 'W300';
} else {
    $list = $_POST['isib'];
}
// =============================================== CONNECTION
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
// session_start();

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
// =============================================== CONNECTION
// =========================================================== LOGIC
$work_center = $list;
$otras = array();
$accas = array();
$z = 0;

// get nama
$namaup_sql = mysqli_query($connect_pro, "SELECT * FROM master_workcenter WHERE work_center = '$work_center'");
$namaup = mysqli_fetch_array($namaup_sql);

$barqas = mysqli_query($connect_pro, "SELECT * from otr_history where c_date like '$month_umpama%' and c_work_center = '$work_center' order by c_date asc");
while ($bardas = mysqli_fetch_array($barqas)) {

    $sup1 = mysqli_query($connect_pro, "SELECT c_qty from resume_plan_mainbody where c_date = '$bardas[c_date]' and c_work_center = '$work_center'");
    if (empty(mysqli_fetch_array($sup1))) {
        $tot_plandaily = 0;
    } else {
        $sup1 = mysqli_query($connect_pro, "SELECT c_qty from resume_plan_mainbody where c_date = '$bardas[c_date]' and c_work_center = '$work_center'");
        $bardas1 = mysqli_fetch_array($sup1);
        $tot_plandaily = $bardas1['c_qty'];
    }

    // }

    // ambil akumulasi
    $barqas2 = mysqli_query($connect_pro, "SELECT SUM(c_qty) as totplan from resume_plan_mainbody WHERE c_date LIKE '$month_umpama%' and c_date <= '$bardas[c_date]' and c_work_center = '$work_center'");
    $bardas2 = mysqli_fetch_array($barqas2);
    $tot_acc = $bardas2['totplan'];

    if ($tot_plandaily == 0) {
        $pot = 0;
    } else {
        $pot = ($bardas['c_otr_qty'] / $tot_plandaily) * 100;
        $pot = round($pot);
    }

    if ($tot_acc == 0) {
        $poc = 0;
    } else {
        $poc = ($bardas['c_otr_acc'] / $tot_acc) * 100;
        $poc = round($poc);
    }

    // echo
    // echo 'tanggal: ' . $bardas['c_date'];
    // echo "</br>";
    // echo 'on time rate qty: ' . $bardas['c_otr_qty'];
    // echo "</br>";
    // echo 'total plan daily: ' . $tot_plandaily;
    // echo "</br>";
    // echo 'on time rate akumulasi: ' . $bardas['c_otr_acc'];
    // echo "</br>";
    // echo 'total plan akumulasi: ' . $tot_acc;
    // echo "</br>";
    // echo 'persentase otr: ' . $pot;
    // echo "</br>";
    // echo 'persentase acc: ' . $poc;
    // echo "</br>";
    // echo "============================";
    // echo "</br>";
    // echo

    $otras[$z] = $pot;
    $accas[$z] = $poc;
    $z++;
}

$count_otras = count($otras);
$count_accas = count($accas);

// target
$barqas3 = mysqli_query($connect_pro, "SELECT c_target FROM otr_target where c_work_center = '$work_center'");
$bardas2 = mysqli_fetch_array($barqas3);
$baruptarget = $bardas2['c_target'];

$namagraf = $namaup['work_center_name'];
// =========================================================== LOGIC
?>
<script>
    var chartDom = document.getElementById('bar1b');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#7D7CE0', '#FF7400'],
        title: {
            text: 'OTR History of <?= $namagraf  ?> (<?= $work_center ?>)-<?= $month_judul ?>',
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
                saveAsImage: {
                    show: true
                }
            }
        },
        legend: {
            data: ['OTR', 'OTR Acc'],
            top: 30
        },
        xAxis: [{
            type: 'category',
            data: [
                <?php
                for ($b = 1; $b <= $sumOfDay; $b++) {
                    echo "'" . $b . "',";
                }
                // for ($b = 0; $b < $count_dayas; $b++) {
                //     echo "'" . $dayas[$b] . "',";
                // }
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
            interval: 20,
            axisLabel: {
                formatter: '{value} %'
            },
            name: 'Percentage',
            nameLocation: 'center',
            nameGap: 50,

            nameTextStyle: {
                padding: [0, 0, -5, 0],
                fontWeight: 'bold'
            }
        }],
        series: [{
                name: 'OTR',
                type: 'bar',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                // label: {
                //     show: true,
                //      rotate: 90
                // },
                data: [<?php
                        for ($b = 0; $b < $count_otras; $b++) {
                            echo $otras[$b] . ",";
                        }
                        ?>],
                markPoint: {
                    symbol: 'pin',
                    label: {
                        color: '#FFFFFF'
                    },
                    data: [{
                        name: 'Max',
                        type: 'max'
                    }, ]
                },
                markLine: {
                    data: [{
                        name: 'Avg',
                        // type: 'average',
                        yAxis: <?= $baruptarget ?>
                    }]
                }
            },
            {
                name: 'OTR Acc',
                type: 'line',
                tooltip: {
                    valueFormatter: function(value) {
                        return value + ' %';
                    }
                },
                data: [<?php
                        for ($b = 0; $b < $count_accas; $b++) {
                            echo $accas[$b] . ",";
                        }
                        ?>]
            }
        ]
    };

    option && myChart.setOption(option);
</script>