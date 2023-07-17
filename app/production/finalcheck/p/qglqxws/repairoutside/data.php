<?php
// get connection
require '../config.php';
?>

<table class="table table-bordered" style="font-size: large;">
    <thead style="text-align: center;">
        <th style="width: 20%;">Serial Number</th>
        <th style="width: 15%;">Checker</th>
        <th style="width: 5%;">From</th>
        <th style="width: 35%;">Status</th>
        <th style="width: 25%;">PIC Repair</th>
    </thead>
    <tbody>
        <?php
        // where menggunakan c_repair_outsidetiga_o karena itu merupakan ujung dari finalcheck
        $sql = mysqli_query($connect_pro, "SELECT a.*, b.c_outsidesatu_pic,b.c_outsidedua_pic,b.c_outsidetiga_pic, b.c_repair_outsidesatu_o, b.c_repair_outsidedua_o, b.c_repair_outsidetiga_o  FROM finalcheck_pic a INNER JOIN finalcheck_repairtime b ON a.c_serialnumber = b.c_serialnumber WHERE b.c_repair_outsidetiga_o IS NULL");
        while ($data = mysqli_fetch_array($sql)) {
            $btn_dis = '';
            $btn_style = 'btn-primary';
            $btn_act = 'btnPrint';
            $btn_info = 'Print';
            $pic_repair = '-';

            if (!empty($data['c_outsidetiga'])) {
                $status = 'Cek3';
                $checker = $data['c_outsidetiga'];
                if ($data['c_outsidetiga_pic'] != '') {
                    $pic_repair = $data['c_outsidesatu_pic'];
                    $btn_act = 'btnPrint1';
                    if ($data['c_repair_outsidetiga_o'] != '') {
                        $btn_style = 'btn-success';
                        $btn_dis = '';
                        $btn_info = 'Waiting to Next Process';
                    } else {
                        $btn_style = 'btn-warning';
                        $btn_dis = '';
                        $btn_info = 'On Repair';
                    }
                }
            } else {
                if (!empty($data['c_outsidedua'])) {
                    $status = 'Cek2';
                    $checker = $data['c_outsidedua'];
                    if ($data['c_outsidedua_pic'] != '') {
                        $pic_repair = $data['c_outsidedua_pic'];
                        $btn_act = 'btnPrint1';
                        if ($data['c_repair_outsidetiga_o'] != '') {
                            $btn_style = 'btn-success';
                            $btn_dis = '';
                            $btn_info = 'Waiting to Next Process';
                        } else {
                            $btn_style = 'btn-warning';
                            $btn_dis = '';
                            $btn_info = 'On Repair';
                        }
                    }
                } else {
                    if (!empty($data['c_outsidesatu'])) {
                        $status = 'Cek1';
                        $checker = $data['c_outsidesatu'];
                        if ($data['c_outsidesatu_pic'] != '') {
                            $pic_repair = $data['c_outsidesatu_pic'];
                            $btn_act = 'btnPrint1';
                            if ($data['c_repair_outsidesatu_o'] != '') {
                                $btn_style = 'btn-success';
                                $btn_dis = '';
                                $btn_info = 'Waiting to Next Process';
                            } else {
                                $btn_style = 'btn-warning';
                                $btn_dis = '';
                                $btn_info = 'On Repair';
                            }
                        }
                    } else {
                        $status = '-';
                        $checker = '-';
                    }
                }
            }

            if ($status != '-') {
        ?>
                <tr>
                    <td><?= $data['c_serialnumber'] ?></td>
                    <td style="text-align: center;"><?= $checker ?></td>
                    <td style="text-align: center;"><?= $status ?></td>
                    <td><button <?= $btn_dis ?> class="btn <?= $btn_style ?>" style="width: 100%; font-weight: bold;" id="pr-<?= $data['c_serialnumber'] ?>" onclick="<?= $btn_act ?>(this.id, '<?= $data['c_serialnumber'] ?>')"><?= $btn_info ?></button></td>
                    <td style="text-align: center;"><?= $pic_repair ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>