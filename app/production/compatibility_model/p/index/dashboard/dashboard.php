<?php
$togel = date('Y-m');
$togel2 = date('Y-m-d');
$togel3 = date('D, d M Y H:i:s');

// mencari total plan pada bulan ini
$sql8 = mysqli_query($con_pro, "SELECT count(pln_no) as semua from plan where tanggal like '$togel%'");
$data8 = mysqli_fetch_array($sql8);
$semua = $data8['semua'];

$sql11 = mysqli_query($con_pro, "SELECT sum(u200) as u200 from hasil where tanggal like '$togel%'");
$data11 = mysqli_fetch_array($sql11);
if (empty($data11)) {
    $bagian_semua = 0;
} else {
    $bagian_semua = $data11['u200'];
}

// mencari plan hingga hari ini
$sql16 = mysqli_query($con_pro, "SELECT count(pln_no) as daily_acc from plan where tanggal <= '$togel2'");
$data16 = mysqli_fetch_array($sql16);
if (empty($data16)) {
    $semuadc = 0;
} else {
    $semuadc = $data16['daily_acc'];
}

// mecari plan pada hari ini
$sql10 = mysqli_query($con_pro, "SELECT count(pln_no) as daily from plan where tanggal = '$togel2'");
$data10 = mysqli_fetch_array($sql10);
if (empty($data10)) {
    $semuad = 0;
} else {
    $semuad = $data10['daily'];
}

// mencari data daily
$sql9 = mysqli_query($con_pro, "SELECT u200 from hasil where tanggal = '$togel2'");
$data9 = mysqli_fetch_array($sql9);
if (empty($data9)) {
    $bagian = 0;
} else {
    $bagian = $data9['u200'];
}

// persentase daily
$daily_per = ($bagian / $semuad) * 100;

// persentase monthly
$monthly_per = ($bagian_semua / $semua) * 100;

// persentase daily acc
$daily_acc_per = ($bagian_semua / $semuadc) * 100;

// MODEL SUITABLE
$sql12 = mysqli_query($con_pro, "SELECT COUNT(plan_number) as all_daily from daily_result");
$data12 = mysqli_fetch_array($sql12);
if (empty($data12)) {
    $all_daily = 0;
} else {
    $all_daily = $data12['all_daily'];
}

// PAST
$sql13 = mysqli_query($con_pro, "SELECT COUNT(plan_number) as PAST from daily_result where plan_date < '$togel2'");
$data13 = mysqli_fetch_array($sql13);
if (empty($data13)) {
    $past = 0;
} else {
    $past = $data13['PAST'];
}
$per_past = ($past / $all_daily) * 100;

// TODAY
$sql14 = mysqli_query($con_pro, "SELECT COUNT(plan_number) as TODAY from daily_result where plan_date = '$togel2'");
$data14 = mysqli_fetch_array($sql14);
if (empty($data14)) {
    $today = 0;
} else {
    $today = $data14['TODAY'];
}
$per_today = ($today / $all_daily) * 100;

// TOGO
$sql15 = mysqli_query($con_pro, "SELECT COUNT(plan_number) as TOGO from daily_result where plan_date > '$togel2'");
$data15 = mysqli_fetch_array($sql15);
if (empty($data15)) {
    $togo = 0;
} else {
    $togo = $data15['TOGO'];
}
$per_togo = ($togo / $all_daily) * 100;

?>
<div class="row">
    <div class="col-12" style="padding: 0px; margin: 0px; text-align: right; padding-right: 7px;">
        <label for="time" style="padding: 0px; font-size: 12px;"><i>Data show updated : <?= $togel3 ?></i></label>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <h2 style="padding-left:5px ; color: #464646; font-weight: bold; padding-top: 0px;">Target</h2>
        <div class="row">
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-body" style="padding-bottom: 0px; padding-left: 0px; padding-right: 0px;">
                        <h5 class="card-title">Daily</h5>
                        <h1><?= round($daily_per) . "%" ?></h1>
                    </div>
                    <div class="card-footer text-muted" style="padding-left: 0px; padding-right: 0px;">
                        <?= $bagian . " / " . $semuad ?>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-body" style="padding-bottom: 0px; padding-left: 0px; padding-right: 0px;">
                        <h5 class="card-title">Daily Acc</h5>
                        <h1><?= round($daily_acc_per) . "%" ?></h1>
                    </div>
                    <div class="card-footer text-muted" style="padding-left: 0px; padding-right: 0px;">
                        <?= $bagian_semua . " / " . $semuadc ?>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-body" style="padding-bottom: 0px; padding-left: 0px; padding-right: 0px;">
                        <h5 class="card-title">Monthly</h5>
                        <h1><?= round($monthly_per) . "%" ?></h1>
                    </div>
                    <div class="card-footer text-muted" style="padding-left: 0px; padding-right: 0px;">
                        <?= $bagian_semua . " / " . $semua ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <h2 style="padding-left:5px ; color: #464646; font-weight: bold;">Model Suitable</h2>
        <div class="row">
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-body" style=" padding-bottom: 0px;">
                        <h5 class="card-title">Past</h5>
                        <h1><?= $past ?></h1>
                    </div>
                    <div class="card-footer text-muted" style="padding-left: 0px; padding-right: 0px;">
                        <?= number_format($per_past, 2, '.', '') . "%" ?>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-body" style=" padding-bottom: 0px;">
                        <h5 class="card-title">Today</h5>
                        <h1><?= $today ?></h1>
                    </div>
                    <div class="card-footer text-muted" style="padding-left: 0px; padding-right: 0px;">
                        <?= number_format($per_today, 2, '.', '') . "%" ?>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-body" style=" padding-bottom: 0px;">
                        <h5 class="card-title">Togo</h5>
                        <h1><?= $togo ?></h1>
                    </div>
                    <div class="card-footer text-muted" style="padding-left: 0px; padding-right: 0px;">
                        <?= number_format($per_togo, 2, '.', '') . "%" ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-top: 20px ;">
        <div id="panel2" style="height:400px; padding-top: 0px;"></div>
        <?php
        $sql5 = mysqli_query($con_pro, "SELECT distinct tanggal from plan where tanggal like '$togel%' order by tanggal asc");
        $tanggal = array();
        $plan = array();
        $act = array();
        $i = 0;
        while ($data5 = mysqli_fetch_array($sql5)) {
            // mencari plan perhari
            $sql6 = mysqli_query($con_pro, "SELECT COUNT(tanggal) as jumpln from plan where tanggal = '$data5[tanggal]'");
            $data6 = mysqli_fetch_array($sql6);

            // mencari aktual perhari
            $sql7 = mysqli_query($con_pro, "SELECT u200 from hasil where tanggal = '$data5[tanggal]'");
            $data7 = mysqli_fetch_array($sql7);
            if (empty($data7)) {
                $aktual[$i] = 0;
            } else {
                $aktual[$i] = $data7['u200'];
            }

            $s_tgl = date('d', strtotime($data5['tanggal']));
            $bulan = date('F', strtotime($data5['tanggal']));

            $plan[$i] = $data6['jumpln'];

            $tanggal[$i] = $s_tgl;
            $i++;
            $bulan = date('F', strtotime($data5['tanggal']));
        }
        ?>
        <script type="text/javascript">
            var chartDom = document.getElementById('panel2');
            var myChart = echarts.init(chartDom);
            var option;

            option = {
                title: {
                    text: 'Data Progress of Side Glue - <?= $bulan ?>',
                    subtext: 'Data from: Taking result U200'
                },
                grid: {
                    // untuk mengatur posisi chart
                    top: '20%',
                    left: '5%',
                    right: '5%'
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
                        saveAsImage: {
                            show: true
                        },
                        dataView: {
                            readOnly: true
                        },
                    }
                },
                legend: {
                    data: ['Plan', 'Actual']
                },
                xAxis: [{
                    type: 'category',
                    name: 'Date',
                    data: [
                        <?php
                        $tgl_count = count($tanggal);
                        for ($t = 0; $t < $tgl_count; $t++) {
                            echo "'" . $tanggal[$t] . "',";
                        }
                        ?>
                    ],
                    axisPointer: {
                        type: 'shadow'
                    }
                }],
                yAxis: [{
                    type: 'value',
                    name: 'Unit',
                    // min: -50,
                    // max: 200,
                    interval: 20,
                    axisLabel: {
                        formatter: '{value}'
                    }
                }],
                series: [{
                        name: 'Plan',
                        type: 'line',
                        tooltip: {
                            valueFormatter: function(value) {
                                return value + ' unit';
                            }
                        },
                        data: [
                            <?php
                            $plan_count = count($plan);
                            for ($p = 0; $p < $plan_count; $p++) {
                                echo $plan[$p] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        name: 'Actual',
                        type: 'bar',
                        tooltip: {
                            valueFormatter: function(value) {
                                return value + ' unit';
                            }
                        },
                        data: [
                            <?php
                            $aktual_count = count($aktual);
                            for ($a = 0; $a < $aktual_count; $a++) {
                                echo $aktual[$a] . ",";
                            }
                            ?>
                        ]
                    }
                ]
            };

            option && myChart.setOption(option);
        </script>
    </div>
</div>