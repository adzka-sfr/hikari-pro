<?php
// get connection
require '../config.php';

$serialnumber = $_POST['serialnumber'];

$sql4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber'");
$data4 = mysqli_fetch_array($sql4);

if ($data4['total'] == 0) {
?>
    <tr>
        <td colspan="2" style="text-align: center;">Data not found</td>
    </tr>
    <?php
} else {
    // get process pic
    $process = $publicprocess;

    $sql2 = mysqli_query($connect_pro, "SELECT DISTINCT a.c_number_ng,  a.c_code_ng, b.c_name as ng_name FROM finalcheck_fetch_outside a  INNER JOIN finalcheck_list_ng b ON a.c_code_ng = b.c_code_ng WHERE a.c_serialnumber = '$serialnumber' ORDER BY a.c_number_ng ASC");
    while ($data2 = mysqli_fetch_array($sql2)) {
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
                <button type="button" id="delete<?= $data2['c_code_ng'] ?>" onclick="deleteng(this.id,'<?= $serialnumber ?>','<?= $data2['c_code_ng'] ?>','<?= $data2['c_number_ng'] ?>','<?= $process ?>' )" class="btn btn-danger btn-sm" style="margin:0px; padding-top: 5px;"><i class="fa fa-trash"></i></button>
            </td>
            <td>
                <div class="row">
                    <div class="col-10">
                        <b><?= $data2['ng_name'] ?></b>
                    </div>
                    <div class="col-2">
                        <button type="button" id="edit<?= $data2['c_code_ng'] ?>" class="btn btn-primary btn-sm" onclick="editng(this.id,'<?= $data2['c_code_ng'] ?>','<?= $data2['ng_name'] ?>','<?= $data2['c_number_ng'] ?>', '<?= $serialnumber ?>')" style="margin:0px; padding-top: 5px;">
                            <i class="fa fa-pencil"></i></button>
                        </button>
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