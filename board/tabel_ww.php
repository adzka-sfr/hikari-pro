<?php
// untuk mendapatakan jumlah hari pada satu bulan
$now = '2022-11-07';
$kalenderMasehi = CAL_GREGORIAN;
$bulanSutena = date('m', strtotime($now));
$tahunGajah = date('Y', strtotime($now));
$sumOfDay = cal_days_in_month($kalenderMasehi, $bulanSutena, $tahunGajah);
$monthShow = date('F', strtotime($now));

$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
?>

<table class="table table-bordered">
    <tr style="background-color: #AD8467; color: #FFFFFF;">
        <th><?= $monthShow ?></td>
        <th style="text-align: center;" colspan="<?= $sumOfDay ?>">History of OTR Percentage (%)</th>
    </tr>
    <tr>
        <td style="background-color: #5470C6; font-weight: bold; color: #FFFFFF;">W130</td>
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
        <td style="background-color: #91CC75; font-weight: bold; color: #FFFFFF;">W170</td>
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
        <td style="background-color: #FAC858; font-weight: bold; color: #FFFFFF;">W300</td>
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
        <td style="background-color: #EE6666; font-weight: bold; color: #FFFFFF;">W400</td>
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