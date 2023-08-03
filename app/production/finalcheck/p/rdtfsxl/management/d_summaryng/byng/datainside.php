<?php
include '../../../config.php';
?>

<?php
$bulan1 = date('Y-m', strtotime("-1month", strtotime($now)));
$bulan2 = date('Y-m', strtotime($now));
$q1 = mysqli_query($connect_pro, "SELECT c_code_ng, c_group, c_name FROM finalcheck_list_ng WHERE c_area = 'inside' AND c_name != 'Tidak pakai' ORDER BY c_name ASC");
while ($d1 = mysqli_fetch_array($q1)) {
    // get data last month
    $q2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_inside WHERE c_code_incheck = '$d1[c_group]' AND c_code_ng LIKE '%$d1[c_code_ng]%' AND c_result_date LIKE '$bulan1%'");
    $d2 = mysqli_fetch_array($q2);

    // get data this month
    $q3 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_inside WHERE c_code_incheck = '$d1[c_group]' AND c_code_ng LIKE '%$d1[c_code_ng]%' AND c_result_date LIKE '$bulan2%'");
    $d3 = mysqli_fetch_array($q3);

    // count percentage
    $bulan_ini = $d3['total'];
    $bulan_lalu = $d2['total'];

    if ($bulan_lalu == 0) {
        $persen = ($bulan_ini / 1) * 100;
    } else {
        $persen = (($bulan_ini - $bulan_lalu) / $bulan_lalu) * 100;
        $persen = number_format($persen, 2, '.', '');
    }
?>
    <tr>
        <td><?= $d1['c_name'] ?></td>
        <td style="text-align: center;"><?= $d2['total'] ?></td>
        <td style="text-align: center;"><?= $d3['total'] ?></td>
        <td style="text-align: right;">
            <?= $persen ?>%
            <sup>
                <?php
                if ($persen < 0) {
                ?>
                    <img style="height: 10px;" src="<?= base_url('_assets/production/icons/parts/down-green.png') ?>" alt="UP">
                <?php
                } elseif ($persen > 0) {
                ?>
                    <img style="height: 10px;" src="<?= base_url('_assets/production/icons/parts/up-red.png') ?>" alt="UP">
                <?php
                } else {
                ?>
                    <img style="height: 10px;" src="<?= base_url('_assets/production/icons/parts/minus.png') ?>" alt="UP">
                <?php
                }
                ?>
            </sup>
        </td>
    </tr>
<?php
}
?>