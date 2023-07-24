<?php
// get connection
require '../config.php';

$serialnumber = $_POST['serialnumber'];

$sql4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber'");
$data4 = mysqli_fetch_array($sql4);

// get name
// [SELECT : finalcheck_repairtime, finalcheck_pic JOIN by c_serialnumber  ] 
// get tanggal OK -> c_repair_inside_o || finalcheck_repairtime
// get pic inside check -> c_inside || finalcheck_pic
// select a.c_repair_inside_o , b.c_inside  from finalcheck_repairtime a inner join finalcheck_pic b on a.c_serialnumber = b.c_serialnumber where b.c_serialnumber = 'J40505958'
$sql2 = mysqli_query($connect_pro, "SELECT a.c_repair_outsidesatu_o , b.c_outsidesatu, a.c_outsidesatu_pic  FROM finalcheck_repairtime a INNER JOIN finalcheck_pic b ON a.c_serialnumber = b.c_serialnumber WHERE b.c_serialnumber = '$serialnumber'");
$data2 = mysqli_fetch_array($sql2);
$ok_date = '-';
$pic = $data2['c_outsidesatu'];
$repair = '-';
$validation_func = 'disabled';
$finish_outside_func = ''; // jika sudah dikirm maka akan disabled untuk checkbox nya
if ($data2['c_repair_outsidesatu_o'] != '') {
    $ok_date = date('d-m-Y', strtotime($data4['total']));
    $finish_outside_func = 'disabled';
}
if ($data2['c_outsidesatu_pic'] != '') {
    $repair = $data2['c_outsidesatu_pic'];
    $validation_func = '';
}

if ($data4['total'] == 0) {
?>
    <tr>
        <td colspan="2" style="text-align: center;">Data not found</td>
    </tr>
    <?php
} else {
    // get process pic
    $process = $publicprocess;

    $sql2 = mysqli_query($connect_pro, "SELECT DISTINCT a.c_number_ng, a.c_code_ng, a.c_repair, b.c_name as ng_name FROM finalcheck_fetch_outside a  INNER JOIN finalcheck_list_ng b ON a.c_code_ng = b.c_code_ng WHERE a.c_serialnumber = '$serialnumber' ORDER BY a.c_number_ng ASC");
    while ($data2 = mysqli_fetch_array($sql2)) {
        $validasio = '';
        if ($data2['c_repair'] == 'Y') {
            $validasio = 'checked';
        }
        $cabinet = array();
        $processcab = array();
        $sql3 = mysqli_query($connect_pro, "SELECT a.c_code_cabinet, a.c_process, b.c_name as cab_name FROM finalcheck_fetch_outside a INNER JOIN finalcheck_list_cabinet b ON a.c_code_cabinet = b.c_code_cabinet WHERE a.c_serialnumber = '$serialnumber' AND c_code_ng = '$data2[c_code_ng]'");
        while ($data3 = mysqli_fetch_array($sql3)) {
            array_push($cabinet, $data3['cab_name']);
            array_push($processcab, $data3['c_process']);
        }
        $row = count($cabinet);
    ?>
        <tr>
            <td rowspan="<?= $row + 1 ?>" style="text-align: center;">
                <?= $data2['c_number_ng'] ?><br>
            </td>
            <td>
                <div class="row">
                    <div class="col-10">
                        <b><?= $data2['ng_name'] ?></b>
                    </div>
                    <div class="col-2">
                        <input <?= $finish_outside_func . " " . $validation_func . " " . $validasio ?> id="cekbokvalo<?= $data2['c_code_ng'] ?>" onchange="cekbokvalo(this.id,'<?= $serialnumber ?>','<?= $data2['c_code_ng'] ?>','<?= $publicprocess ?>')" value="Y" type="checkbox" style="transform: scale(2);">
                    </div>
                </div>
            </td>
        </tr>
        <?php
        for ($eh = 0; $eh < $row; $eh++) {
            if ($processcab[$eh] == 'oc1') {
                $color_cab = '#DC4646';
            } elseif ($processcab[$eh] == 'oc2') {
                $color_cab  = '#5AA65A';
            } elseif ($processcab[$eh] == 'oc3') {
                $color_cab = '#1340FF';
            } else {
                $color_cab = '#000';
            }
        ?>
            <tr>
                <td style="color: <?= $color_cab ?>;"><?= $cabinet[$eh] ?></td>
            </tr>
        <?php
        }
        ?>
<?php
    }
}
?>