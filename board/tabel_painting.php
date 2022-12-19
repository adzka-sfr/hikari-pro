<?php
// untuk mendapatakan jumlah hari pada satu bulan
$now = '2022-11-09';
$kalenderMasehi = CAL_GREGORIAN;
$bulanSutena = date('m', strtotime($now));
$tahunGajah = date('Y', strtotime($now));
$sumOfDay = cal_days_in_month($kalenderMasehi, $bulanSutena, $tahunGajah);
$monthShow = date('F', strtotime($now));

$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
?>

<table class="table table-bordered">
    <tr style="background-color: #BC5672; color: #FFFFFF;">
        <th><?= $monthShow ?></td>
        <th style="text-align: center;" colspan="<?= $sumOfDay ?>">History of OTR Percentage (%)</th>
    </tr>
    <tr>
        <td style="background-color: #5470C6; font-weight: bold; color: #FFFFFF;">P220</td>
        <?php
        $wc = 'U200';
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                $bg = '#8FC6FF';
            } else {
                $bg = '#fff';
            }

            // query untuk isi tabel
            $sql1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_work_center = '$wc' and c_date = '$tgl'");
            if (empty(mysqli_fetch_array($sql1))) {
                $nilai = "";
            } else {
                $sql = mysqli_query($connect_pro, "SELECT * from otr_history where c_work_center = '$wc' and c_date = '$tgl'");
                $data = mysqli_fetch_array($sql);
                $nilai = $data['c_otr_qty'];
            }

        ?>
            <td style="text-align: center ; width: 3%; padding-left: 0px; padding-right:0px; font-weight: bold; background-color: <?= $bg ?>;"><?= $nilai ?></td>
        <?php
        }
        ?>
    </tr>
    <tr>
        <td style="background-color: #91CC75; font-weight: bold; color: #FFFFFF;">P520</td>
        <?php
        $wc = 'U200';
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            // pengecekan apakah tanggal 1-9 ? -> jika iya ditambah 0 di belakangnya
            if ($cok < 10) {
                $cok = "0" . $cok;
            }
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                $bg = 'background-color:#8FC6FF;';
            } else {
                $bg = 'background-color:#fff;';
            }

            // query untuk isi tabel
            $tp = 0;
            $tr = 0;
            $otr = 0;

            // $s1 = mysqli_query($connect_pro, "SELECT plandt, hmcd, makeprocecd, SUM(planqty) as total_plan from production_plan where plandt like '$tgl%' and makeprocecd = '$wc' group by hmcd");
            // if (empty(mysqli_fetch_array($s1))) {
            //     $persen_otr = 0;
            // } else {
            //     $s1 = mysqli_query($connect_pro, "SELECT plandt, hmcd, makeprocecd, SUM(planqty) as total_plan from production_plan where plandt like '$tgl%' and makeprocecd = '$wc' group by hmcd");
            //     while ($d1 = mysqli_fetch_array($s1)) {
            //         $s2 = mysqli_query($connect_pro, "SELECT instdt, hmcd, makektcd, SUM(actualqty) as total_result from production_result where hmcd = '$d1[hmcd]' and instdt like '$tgl%' and makektcd = '$wc' group by hmcd");
            //         $d2 = mysqli_fetch_array($s2);

            //         // cek apakah ada result
            //         if (empty($d2['instdt'])) {
            //             $instdt = 'tidak ada result';
            //             $ar = 0;
            //         } else {
            //             $instdt =  $d2['instdt'];
            //             $ar = $d2['total_result'];
            //         }

            //         // persentase plan vs actual
            //         $capaian = ($ar / $d1['total_plan']) * 100;
            //         $capaian = number_format($capaian, 2, '.', '');

            //         // summary
            //         $tp = $tp + $d1['total_plan'];
            //         $tr = $tr + $ar;

            //         if ($ar <= $d1['total_plan']) {
            //             $otr = $otr + $ar;
            //         } elseif ($ar > $d1['total_plan']) {
            //             $otr = $otr + $d1['total_plan'];
            //         }
            //     }
            //     // persentase summary
            //     // berdasarkan actual saja
            //     $persen_tr = ($tr / $tp) * 100;
            //     $persen_tr = number_format($persen_tr, 2, '.', '');

            //     // berdasarkan otr saja
            //     $persen_otr = ($otr / $tp) * 100;
            //     $persen_otr = round($persen_otr);
            //     // $persen_otr = number_format($persen_otr, 2, '.', '');
            // }



            $persen_otr = rand(10, 100);
            // jika ada yang menang mendapat trophy yay!
            if ($persen_otr > 80) {
                $juara = '<img src="images/sample.png" alt="trophy" height="20px" style="z-index: 3; position: absolute; transform: rotate(10deg)">';
                $padding = 'padding-right: 10px;';
            } else {
                $juara = '';
                $padding = 'padding-right: 0px;';
            }
        ?>
            <td style="text-align: center ; width: 3%; padding-left: 0px; font-weight: bold; left: 50px; <?= $padding . $bg ?>;"><?= $persen_otr ?> <?= $juara ?></td>
        <?php
        }
        ?>
    </tr>
    <tr>
        <td style="background-color: #FAC858; font-weight: bold; color: #FFFFFF;">P530</td>
        <?php
        $wc = 'U200';
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                $bg = '#8FC6FF';
            } else {
                $bg = '#fff';
            }

            // query untuk isi tabel
            $sql1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_work_center = '$wc' and c_date = '$tgl'");
            if (empty(mysqli_fetch_array($sql1))) {
                $nilai = "";
            } else {
                $sql = mysqli_query($connect_pro, "SELECT * from otr_history where c_work_center = '$wc' and c_date = '$tgl'");
                $data = mysqli_fetch_array($sql);
                $nilai = $data['c_otr_qty'];
            }
        ?>
            <td style="text-align: center ; width: 3%; padding-left: 0px; padding-right:0px; font-weight: bold; background-color: <?= $bg ?>;"><?= $nilai ?></td>
        <?php
        }
        ?>
    </tr>
    <tr>
        <td style="background-color: #EE6666; font-weight: bold; color: #FFFFFF;">P550</td>
        <?php
        $wc = 'G130';
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                $bg = '#8FC6FF';
            } else {
                $bg = '#fff';
            }

            // query untuk isi tabel
            $sql1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_work_center = '$wc' and c_date = '$tgl'");
            if (empty(mysqli_fetch_array($sql1))) {
                $nilai = "";
            } else {
                $sql = mysqli_query($connect_pro, "SELECT * from otr_history where c_work_center = '$wc' and c_date = '$tgl'");
                $data = mysqli_fetch_array($sql);
                $nilai = $data['c_otr_qty'];
            }
        ?>
            <td style="text-align: center ; width: 3%; padding-left: 0px; padding-right:0px; font-weight: bold; background-color: <?= $bg ?>;"><?= $nilai ?></td>
        <?php
        }
        ?>
    </tr>
    <tr>
        <td style="background-color: #73C0DE; font-weight: bold; color: #FFFFFF;">P700</td>
        <?php
        $wc = 'G130';
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                $bg = '#8FC6FF';
            } else {
                $bg = '#fff';
            }

            // query untuk isi tabel
            $sql1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_work_center = '$wc' and c_date = '$tgl'");
            if (empty(mysqli_fetch_array($sql1))) {
                $nilai = "";
            } else {
                $sql = mysqli_query($connect_pro, "SELECT * from otr_history where c_work_center = '$wc' and c_date = '$tgl'");
                $data = mysqli_fetch_array($sql);
                $nilai = $data['c_otr_qty'];
            }
        ?>
            <td style="text-align: center ; width: 3%; padding-left: 0px; padding-right:0px; font-weight: bold; background-color: <?= $bg ?>;"><?= $nilai ?></td>
        <?php
        }
        ?>
    </tr>
    <tr>
        <td style="background-color: #3BA272; font-weight: bold; color: #FFFFFF;">P820</td>
        <?php
        $wc = 'G130';
        for ($cok = 1; $cok <= $sumOfDay; $cok++) {
            $tgl = $tahunGajah . "-" . $bulanSutena . "-" . $cok;
            $tgl2 = strtotime($tgl);
            $now2 = strtotime($now);

            if ($tgl2 == $now2) {
                $bg = '#8FC6FF';
            } else {
                $bg = '#fff';
            }

            // query untuk isi tabel
            $sql1 = mysqli_query($connect_pro, "SELECT * from otr_history where c_work_center = '$wc' and c_date = '$tgl'");
            if (empty(mysqli_fetch_array($sql1))) {
                $nilai = "";
            } else {
                $sql = mysqli_query($connect_pro, "SELECT * from otr_history where c_work_center = '$wc' and c_date = '$tgl'");
                $data = mysqli_fetch_array($sql);
                $nilai = $data['c_otr_qty'];
            }
        ?>
            <td style="text-align: center ; width: 3%; padding-left: 0px; padding-right:0px; font-weight: bold; background-color: <?= $bg ?>;"><?= $nilai ?></td>
        <?php
        }
        ?>
    </tr>
    <tr>
        <th style="background-color: #BC5672 ; color: #FFFFFF;">Date</th>
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
                $bg = '#BC5672';
                $color = '#FFFFFF';
            }
        ?>
            <th style="text-align: center ; width: 3%; background-color: <?= $bg ?>; color: <?= $color ?>;"><?= $cok ?></th>
        <?php
        }
        ?>
    </tr>
</table>