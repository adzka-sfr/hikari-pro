<?php require '../../../config.php'; ?>
<div id="chsti" style="height:5000px; width: 100%; "></div>

<?php
$bulan1 = array();
$bulan2 = array();
$label = array();

$tanggal1 = date('Y-m', strtotime('-1month', strtotime($now)));
$tanggal2 = date('Y-m', strtotime($now));

// get all ng inside
$q1 = mysqli_query($connect_pro, "SELECT c_code_ng, c_group, c_name FROM finalcheck_list_ng WHERE c_area = 'inside' AND c_name != 'Tidak pakai' ORDER BY c_name DESC");
while ($d1 = mysqli_fetch_array($q1)) {
    array_push($label, $d1['c_name']);

    // get sum of ng by code ng last month
    $q2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_inside WHERE c_result = 'NG' AND c_result_date LIKE '$tanggal1%' AND c_code_ng LIKE '%$d1[c_code_ng]%' AND c_code_incheck = '$d1[c_group]'");
    $d2 = mysqli_fetch_array($q2);
    array_push($bulan1, $d2['total']);

    // get sum of ng by code ng this month
    $q3 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_inside WHERE c_result = 'NG' AND c_result_date LIKE '$tanggal2%' AND c_code_ng LIKE '%$d1[c_code_ng]%' AND c_code_incheck = '$d1[c_group]'");
    $d3 = mysqli_fetch_array($q3);
    array_push($bulan2, $d3['total']);
}

// count total array
$count_label = count($label);
$count_bulan1 = count($bulan1);
$count_bulan2 = count($bulan2);
?>
<script type="text/javascript">
    var chartDom = document.getElementById('chsti');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        color: ['#E95555', '#4A94CD', '#FF7400'],
        // title: {
        //     text: 'NG Trend of Inside Check'
        // },
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
            left: '4%',
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
                for ($b = 0; $b < $count_label; $b++) {
                    echo "'" . $label[$b] . "',";
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
                        for ($b = 0; $b < $count_bulan1; $b++) {
                            echo "'" . $bulan1[$b] . "',";
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
                    for ($b = 0; $b < $count_bulan2; $b++) {
                        echo "'" . $bulan2[$b] . "',";
                    }
                    ?>
                ]
            },
        ]
    };

    option && myChart.setOption(option);
</script>