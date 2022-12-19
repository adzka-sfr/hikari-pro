<?php
// untuk mendapatakan jumlah hari pada satu bulan

$monthumpama = date('Y-m', strtotime($now));
$kalenderMasehi = CAL_GREGORIAN;
$bulanSutena = date('m', strtotime($now));
$tahunGajah = date('Y', strtotime($now));
$sumOfDay = cal_days_in_month($kalenderMasehi, $bulanSutena, $tahunGajah);
$monthShow = date('F', strtotime($now));
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");

$wc1 = 'W130';
$wc2 = 'W170';
$wc3 = 'W300';
$wc4 = 'W400';

$dw1 = array();
$dw2 = array();
$dw3 = array();
$dw4 = array();

// get data workcenter 1
for ($cok = 1; $cok <= $sumOfDay; $cok++) {
    $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
    if ($cok < 10) {
        $tgl = "0" . $tgl;
    }

    $tgl2 = strtotime($tgl);
    // $now2 = strtotime($now);

    // get data workcenter 1
    $sec1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc1'");
    if (empty(mysqli_fetch_array($sec1))) {
        $dw1[$cok] = '';
    } else {
        $s1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc1'");
        $d1 = mysqli_fetch_array($s1);
        if ($d1['c_plan'] == 0) {
            $persentase = 0;
        } else {
            $s1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc1'");
            $d1 = mysqli_fetch_array($s1);

            $bagian = $d1['c_otr_qty'];
            $semua = $d1['c_plan'];
            $persentase = ($bagian / $semua) * 100;
            $persentase = round($persentase);
        }
        $dw1[$cok] = $persentase;
    }

    // get data workcenter 2
    $sec1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc2'");
    if (empty(mysqli_fetch_array($sec1))) {
        $dw2[$cok] = '';
    } else {
        $s1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc2'");
        $d1 = mysqli_fetch_array($s1);
        if ($d1['c_plan'] == 0) {
            $persentase = 0;
        } else {
            $s1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc2'");
            $d1 = mysqli_fetch_array($s1);

            $bagian = $d1['c_otr_qty'];
            $semua = $d1['c_plan'];
            $persentase = ($bagian / $semua) * 100;
            $persentase = round($persentase);
        }
        $dw2[$cok] = $persentase;
    }

    // get data workcenter 3
    $sec1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc3'");
    if (empty(mysqli_fetch_array($sec1))) {
        $dw3[$cok] = '';
    } else {
        $s1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc3'");
        $d1 = mysqli_fetch_array($s1);
        if ($d1['c_plan'] == 0) {
            $persentase = 0;
        } else {
            $s1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc3'");
            $d1 = mysqli_fetch_array($s1);

            $bagian = $d1['c_otr_qty'];
            $semua = $d1['c_plan'];
            $persentase = ($bagian / $semua) * 100;
            $persentase = round($persentase);
        }
        $dw3[$cok] = $persentase;
    }

    // get data workcenter 4
    $sec1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc4'");
    if (empty(mysqli_fetch_array($sec1))) {
        $dw4[$cok] = '';
    } else {
        $s1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc4'");
        $d1 = mysqli_fetch_array($s1);
        if ($d1['c_plan'] == 0) {
            $persentase = 0;
        } else {
            $s1 = mysqli_query($connect_pro, "SELECT * FROM otr_history WHERE c_date = '$tgl' and c_work_center = '$wc4'");
            $d1 = mysqli_fetch_array($s1);

            $bagian = $d1['c_otr_qty'];
            $semua = $d1['c_plan'];
            $persentase = ($bagian / $semua) * 100;
            $persentase = round($persentase);
        }
        $dw4[$cok] = $persentase;
    }
}


$batas1 = count($dw1);
$batas2 = count($dw2);
$batas3 = count($dw3);
$batas4 = count($dw4);
?>

<table class="table table-bordered">

    <tr style="background-color: #AD8467; color: #FFFFFF;">
        <th><?= $monthShow ?></td>
        <th style="text-align: center;" colspan="<?= $sumOfDay ?>">History of OTR Woodworking (%)</th>
    </tr>
    <tr>
        <td style="background-color: #5470C6; font-weight: bold; color: #FFFFFF;"><?= $wc1 ?></td>
        <?php
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $nilai = $dw1[$cok];

            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                $bg = 'background-color:#8FC6FF;';
                $blink_o = '<blink>';
                $blink_c = '</blink>';
            } else {
                $bg = 'background-color:#fff;';
                $blink_o = '';
                $blink_c = '';
            }

            $cekmax = array();
            $cekmax[0] = $dw1[$cok];
            $cekmax[1] = $dw2[$cok];
            $cekmax[2] = $dw3[$cok];
            $cekmax[3] = $dw4[$cok];

            $tertinggi = max($cekmax);
            if ($nilai != 0) {
                if ($nilai == $tertinggi) {
                    $juara = '<img src="images/sample.png" alt="trophy" height="20px" style="z-index: 3; position: absolute; transform: rotate(10deg)">';
                    $padding = 'padding-right: 10px;';
                } else {
                    $juara = '';
                    $padding = 'padding-right: 0px;';
                }
            } else {
                $juara = '';
                $padding = 'padding-right: 0px;';
            }
        ?>
            <td style="text-align: center ; width: 3%; padding-left: 0px; font-weight: bold; left: 50px; <?= $padding . $bg ?> "><?= $nilai . $blink_o . $juara . $blink_c ?></td>
        <?php
        }
        ?>
    </tr>
    <tr>
        <td style="background-color: #91CC75; font-weight: bold; color: #FFFFFF;"><?= $wc2 ?></td>
        <?php
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $nilai = $dw2[$cok];

            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                $bg = 'background-color:#8FC6FF;';
                $blink_o = '<blink>';
                $blink_c = '</blink>';
            } else {
                $bg = 'background-color:#fff;';
                $blink_o = '';
                $blink_c = '';
            }

            $cekmax = array();
            $cekmax[0] = $dw1[$cok];
            $cekmax[1] = $dw2[$cok];
            $cekmax[2] = $dw3[$cok];
            $cekmax[3] = $dw4[$cok];

            $tertinggi = max($cekmax);
            if ($nilai != 0) {
                if ($nilai == $tertinggi) {
                    $juara = '<img src="images/sample.png" alt="trophy" height="20px" style="z-index: 3; position: absolute; transform: rotate(10deg)">';
                    $padding = 'padding-right: 10px;';
                } else {
                    $juara = '';
                    $padding = 'padding-right: 0px;';
                }
            } else {
                $juara = '';
                $padding = 'padding-right: 0px;';
            }
        ?>
            <td style="text-align: center ; width: 3%; padding-left: 0px; font-weight: bold; left: 50px; <?= $padding . $bg ?> "><?= $nilai . $blink_o . $juara . $blink_c ?></td>
        <?php
        }
        ?>
    </tr>
    <tr>
        <td style="background-color: #FAC858; font-weight: bold; color: #FFFFFF;"><?= $wc3 ?></td>
        <?php
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $nilai = $dw3[$cok];

            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                $bg = 'background-color:#8FC6FF;';
                $blink_o = '<blink>';
                $blink_c = '</blink>';
            } else {
                $bg = 'background-color:#fff;';
                $blink_o = '';
                $blink_c = '';
            }

            $cekmax = array();
            $cekmax[0] = $dw1[$cok];
            $cekmax[1] = $dw2[$cok];
            $cekmax[2] = $dw3[$cok];
            $cekmax[3] = $dw4[$cok];

            $tertinggi = max($cekmax);
            if ($nilai != 0) {
                if ($nilai == $tertinggi) {
                    $juara = '<img src="images/sample.png" alt="trophy" height="20px" style="z-index: 3; position: absolute; transform: rotate(10deg)">';
                    $padding = 'padding-right: 10px;';
                } else {
                    $juara = '';
                    $padding = 'padding-right: 0px;';
                }
            } else {
                $juara = '';
                $padding = 'padding-right: 0px;';
            }
        ?>
            <td style="text-align: center ; width: 3%; padding-left: 0px; font-weight: bold; left: 50px; <?= $padding . $bg ?> "><?= $nilai . $blink_o . $juara . $blink_c ?></td>
        <?php
        }
        ?>
    </tr>
    <tr>
        <td style="background-color: #EE6666; font-weight: bold; color: #FFFFFF;"><?= $wc4 ?></td>
        <?php
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $nilai = $dw4[$cok];

            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                $bg = 'background-color:#8FC6FF;';
                $blink_o = '<blink>';
                $blink_c = '</blink>';
            } else {
                $bg = 'background-color:#fff;';
                $blink_o = '';
                $blink_c = '';
            }

            $cekmax = array();
            $cekmax[0] = $dw1[$cok];
            $cekmax[1] = $dw2[$cok];
            $cekmax[2] = $dw3[$cok];
            $cekmax[3] = $dw4[$cok];

            $tertinggi = max($cekmax);
            if ($nilai != 0) {
                if ($nilai == $tertinggi) {
                    $juara = '<img src="images/sample.png" alt="trophy" height="20px" style="z-index: 3; position: absolute; transform: rotate(10deg)">';
                    $padding = 'padding-right: 10px;';
                } else {
                    $juara = '';
                    $padding = 'padding-right: 0px;';
                }
            } else {
                $juara = '';
                $padding = 'padding-right: 0px;';
            }
        ?>
            <td style="text-align: center ; width: 3%; padding-left: 0px; font-weight: bold; left: 50px; <?= $padding . $bg ?> "><?= $nilai . $blink_o . $juara . $blink_c ?></td>
        <?php
        }
        ?>
    </tr>
    <tr>
        <th style="background-color: #AD8467 ; color: #FFFFFF;">Date</th>
        <?php
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                // $bg = '#98B4FF';
                $bg = '#8FC6FF';
                $color = '#000000';
            } else {
                $bg = '#AD8467';
                $color = '#FFFFFF';
            }
        ?>
            <th style="text-align: center ; width: 3%; background-color: <?= $bg ?>; color: <?= $color ?>;"><?= $cok ?></th>
        <?php
        }
        ?>
    </tr>
</table>