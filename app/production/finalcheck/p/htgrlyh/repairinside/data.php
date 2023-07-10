<?php
// get connection
require '../config.php';
?>

<table class="table table-bordered" style="font-size: large;">
    <thead style="text-align: center;">
        <th style="width: 20%;">Serial Number</th>
        <th style="width: 15%;">Checker</th>
        <th style="width: 40%;">Status</th>
        <th style="width: 25%;">PIC Repair</th>
    </thead>
    <tbody>
        <?php
        $sql = mysqli_query($connect_pro, "SELECT DISTINCT a.c_serialnumber, b.c_inside, c.c_inside_pic FROM finalcheck_fetch_inside a INNER JOIN finalcheck_pic b ON a.c_serialnumber = b.c_serialnumber INNER JOIN finalcheck_repairtime c ON a.c_serialnumber = c.c_serialnumber ORDER BY c.c_inside_pic ASC");
        while ($data = mysqli_fetch_array($sql)) {
            $pic_repair = '-';
            $btn_style = 'btn-primary';
            $btn_dis = '';
            $btn_info = 'Print';
            $btn_act = 'btnPrint';
            if ($data['c_inside_pic'] != '') {
                $pic_repair = $data['c_inside_pic'];
                $btn_style = 'btn-warning';
                $btn_dis = '';
                $btn_info = 'On Repair';
                $btn_act = 'btnPrint1';
            }
        ?>
            <tr>
                <td><?= $data['c_serialnumber'] ?></td>
                <td style="text-align: center;"><?= $data['c_inside'] ?></td>
                <td><button <?= $btn_dis ?> class="btn <?= $btn_style ?>" style="width: 100%; font-weight: bold;" id="pr-<?= $data['c_serialnumber'] ?>" onclick="<?= $btn_act ?>(this.id, '<?= $data['c_serialnumber'] ?>')"><?= $btn_info ?></button></td>
                <td style="text-align: center;"><?= $pic_repair ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>