<form method="post">
    <div class="row">
        <div class="col-12" style="padding-top: 30px;">
            <table class="table table-bordered">
                <thead style="text-align: center;">
                    <th style="width: 5%;">NO</th>
                    <th>Part Name</th>
                    <th style="width: 20%;">Checker</th>
                    <th style="width: 20%;">Repair</th>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_resultc WHERE c_serialnumber = '$serial_number'");
                    while ($data1 = mysqli_fetch_array($sql1)) {

                        if ($_SESSION['last_process'] == 'oc3') {
                            if ($data1['c_result3'] == 'NO') {
                                $no++;
                                if (!empty($data1['c_repairdate3'])) {
                                    $checked = 'disabled checked';
                                } else {
                                    $checked = '';
                                }
                    ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $data1['c_partname'] ?></td>
                                    <td style="text-align: center;">
                                        <img style="height: 40px;" src="<?= base_url('_assets/production/icons/parts/cross.png') ?>" alt="NO">
                                    </td>
                                    <td style="text-align: center;">
                                        <input <?= $checked ?> name="c<?= $no ?>" value="<?= $data1['c_code'] ?>" type="checkbox" style="transform: scale(2); margin: 10px; vertical-align:top;">
                                    </td>
                                </tr>
                            <?php
                            }
                        } elseif ($_SESSION['last_process'] == 'oc2') {
                            if ($data1['c_result2'] == 'NO') {
                                $no++;
                                if (!empty($data1['c_repairdate2'])) {
                                    $checked = 'disabled checked';
                                } else {
                                    $checked = '';
                                }
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $data1['c_partname'] ?></td>
                                    <td style="text-align: center;">
                                        <img style="height: 40px;" src="<?= base_url('_assets/production/icons/parts/cross.png') ?>" alt="NO">
                                    </td>
                                    <td style="text-align: center;">
                                        <input <?= $checked ?> name="c<?= $no ?>" value="<?= $data1['c_code'] ?>" type="checkbox" style="transform: scale(2); margin: 10px; vertical-align:top;">
                                    </td>
                                </tr>
                            <?php
                            }
                        } elseif ($_SESSION['last_process'] == 'oc1') {
                            if ($data1['c_result1'] == 'NO') {
                                $no++;
                                if (!empty($data1['c_repairdate1'])) {
                                    $checked = 'disabled checked';
                                } else {
                                    $checked = '';
                                }
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $data1['c_partname'] ?></td>
                                    <td style="text-align: center;">
                                        <img style="height: 40px;" src="<?= base_url('_assets/production/icons/parts/cross.png') ?>" alt="NO">
                                    </td>
                                    <td style="text-align: center;">
                                        <input <?= $checked ?> name="c<?= $no ?>" value="<?= $data1['c_code'] ?>" type="checkbox" style="transform: scale(2); margin: 10px; vertical-align:top;">
                                    </td>
                                </tr>
                        <?php
                            }
                        }

                        ?>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12" style="text-align: center;">
            <button name="repairc" type="submit" class="btn btn-success">Repair</button>
        </div>
    </div>
</form>

<?php
if (isset($_POST['repairc'])) {
    for ($in = 1; $in <= $no; $in++) {
        $rcdate = date('Y-m-d H:i:s', strtotime($now));
        $repairname = $_SESSION['repair_name'];
        if (!empty($_POST['c' . $in])) {
            $c_code = $_POST['c' . $in];
            if ($_SESSION['last_process'] == 'oc1') {
                $pp1 = mysqli_query($connect_pro, "UPDATE formng_resultc SET c_repairdate1 = '$rcdate', c_repair1by = '$repairname' WHERE c_serialnumber = '$serial_number' AND c_code = '$c_code'");
            } elseif ($_SESSION['last_process'] == 'oc2') {
                $pp1 = mysqli_query($connect_pro, "UPDATE formng_resultc SET c_repairdate2 = '$rcdate', c_repair2by = '$repairname' WHERE c_serialnumber = '$serial_number' AND c_code = '$c_code'");
            } elseif ($_SESSION['last_process'] == 'oc3') {
                $pp1 = mysqli_query($connect_pro, "UPDATE formng_resultc SET c_repairdate3 = '$rcdate', c_repair3by = '$repairname' WHERE c_serialnumber = '$serial_number' AND c_code = '$c_code'");
            }
            if ($pp1) {
?>
                <script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'Success',
                            html: 'Data repair has been recorded!',
                            type: 'success',
                            confirmButtonText: 'Ok',
                            allowOutsideClick: true
                            // timer: 2000,
                            // showCancelButton: false,
                            // showConfirmButton: false
                        }).then(function() {
                            window.location = 'index.php';
                        });
                    });
                </script>
<?php
            }
        }
    }
}
?>