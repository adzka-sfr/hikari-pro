<?php
// $now = '2022-11-04';
// $month_umpama = date('Y-m', strtotime($now));
// $connect_pro = new mysqli("localhost", "root", "", "hikari_project");
// $work_center = 'P550';
$work_center = $_SESSION['ww_otr1'];
$otras = array();
$accas = array();
$z = 0;

// get nama
$namaup_sql = mysqli_query($connect_pro, "SELECT * FROM master_workcenter WHERE work_center = '$work_center'");
$namaup = mysqli_fetch_array($namaup_sql);

$barqas = mysqli_query($connect_pro, "SELECT * from otr_history where c_date like '$month_umpama%' and c_work_center = '$work_center' order by c_date asc");
while ($bardas = mysqli_fetch_array($barqas)) {
    // jumlahin dulu untuk plan pada satu hari full
    $barqas1 = mysqli_query($connect_pro, "SELECT * from production_plan where plandt = '$bardas[c_date]' and makeprocecd = '$work_center'");
    // $bardas1 = mysqli_fetch_array($barqas1);

    // if (empty(mysqli_fetch_array($barqas1))) {
    //     // echo "koosong";
    //     $tot_plandaily = 0;
    // } else {
    // ambil daily
    $sup1 = mysqli_query($connect_pro, "SELECT SUM(planqty) as totplan_daily from production_plan where plandt = '$bardas[c_date]' and makeprocecd = '$work_center'");
    $bardas1 = mysqli_fetch_array($sup1);
    $tot_plandaily = $bardas1['totplan_daily'];
    // }

    // ambil akumulasi
    $barqas2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as totplan from production_plan WHERE plandt LIKE '$month_umpama%' and plandt <= '$bardas[c_date]' and makeprocecd = '$work_center'");
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
?>
<script>
    var chartDom = document.getElementById('bar1a');
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
            max: 80,
            interval: 10,
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