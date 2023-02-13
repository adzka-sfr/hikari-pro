<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <?php
    $repair_in = date('l, d M Y', strtotime($now));
    $ngin = array();
    $i = 0;
    $sql1 = mysqli_query($connect_pro, "SELECT c_ng FROM formng_listng WHERE c_area = 'inside' ORDER BY c_ng asc");
    while ($data1 = mysqli_fetch_array($sql1)) {
        $ngin[$i] = $data1['c_ng'];
        $i++;
    }
    ?>
    <div class="row">
        <div class="col-12">
            <h3>Repair Form</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="vertical-align:top;padding-top:0px; width: 10%;">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 5px;">
                                    No Seri :
                                </div>
                            </div>
                            <di class="row">
                                <div class="col-md-12" style="text-align: center;">
                                    <?= $_SESSION['serialnumber_repair'] ?>
                                </div>
                            </di>
                        </th>
                        <th style="vertical-align:top;padding-top:0px">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 5px;">
                                    Model :
                                </div>
                            </div>
                            <di class="row">
                                <div class="col-md-12" style="text-align: center;">
                                    <?= $_SESSION['pianoname_repair'] ?>
                                </div>
                            </di>
                        </th>
                        <th style="vertical-align:top;padding-top:0px; width: 25%;">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 5px;">
                                    Repair Date :
                                </div>
                            </div>
                            <di class="row">
                                <div class="col-md-12" style="text-align: center;">
                                    <?= date('l, d M Y', strtotime($now)) ?>
                                </div>
                            </di>
                        </th>
                        <th style="vertical-align:top;padding-top:0px; width: 15%;">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 5px;">
                                    Process :
                                </div>
                            </div>
                            <di class="row">
                                <div class="col-md-12" style="text-align: center;">
                                    Repair Inside
                                </div>
                            </di>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <form method="post">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                        <th style="width: 5%;">No</th>
                        <th>Item</th>
                        <th style="width: 20%;">Hasil Cek</th>
                        <th style="width: 20%;">Hasil Repair</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $ng = 0;
                        $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resulti WHERE c_serialnumber = '$_SESSION[serialnumber_repair]' ORDER BY id asc");
                        while ($data2 = mysqli_fetch_array($sql2)) {

                            // pemberian warna background tr
                            $i++;
                            if ($i % 2 == 0) {
                                $br = '';
                            } else {
                                $br = '';
                            }

                            // nama item
                            $sql3 = mysqli_query($connect_pro, "SELECT c_item FROM formng_checkinside WHERE c_code = '$data2[c_item]'");
                            $data3 = mysqli_fetch_array($sql3);

                            if ($data2['c_status'] == 'NG') {
                                $ng++;

                                if ($data2['c_repair'] == '') {
                                    $fixed = '#B50303';
                                } else {
                                    $fixed = '#4A9422';
                                }
                        ?>

                                <!-- baris n -->
                                <tr <?= $br ?>>
                                    <td style="text-align: center; font-size: 15px;" rowspan="2"><?= $i ?></td>
                                    <td rowspan="2" style="font-size: 15px;"><?= $data3['c_item'] ?></td>
                                    <td colspan="2" style="text-align: center; font-weight: bold; color: #fff; background-color: <?= $fixed ?>;"><?= $data2['c_detail'] ?></td>
                                </tr>
                                <tr <?= $br ?>>

                                    <td style="padding: 2px;">
                                        <table class="table table-bordered" style="border-color: #B50303;">
                                            <tr>
                                                <td style="padding: 0px; background-color: #B50303;">
                                                    <h3 class="retro" style=" text-align: center; color: #fff; rotate: -5deg;">QC REJECTED</h3>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 0px; text-align: center;">
                                                    <?= $data2['c_checker'] ?>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td style="padding: 0px; text-align: center;">
                                                    <?= date('d-m-Y', strtotime($data2['c_inspectiondate'])) ?>
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                    <?php
                                    if ($data2['c_repair'] == '') {
                                    ?>
                                        <td style="padding: 2px; text-align: center;">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="hidden" name="c_item<?= $i ?>" value="<?= $data2['c_item'] ?>">
                                                    <input name="ck<?= $i ?>" value="checked" type="checkbox" style="transform: scale(2); margin: 10px; vertical-align:top;padding-top:70px;">
                                                </label>
                                            </div>
                                        </td>
                                    <?php
                                    } else {
                                    ?>
                                        <td style="padding: 2px;">
                                            <table class="table table-bordered" style="border-color: #CF9502;">
                                                <tr>
                                                    <td style="padding: 0px; background-color: #CF9502;">
                                                        <h3 class="retro" style=" text-align: center; color: #fff; rotate: -5deg;">REPAIRED</h3>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="padding: 0px; text-align: center;">
                                                        <?= $data2['c_repair'] ?>
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td style="padding: 0px; text-align: center;">
                                                        <?= date('d-m-Y', strtotime($data2['c_repairdate'])) ?>
                                                    </td>
                                                </tr>

                                            </table>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <!-- baris n -->
                        <?php
                            }
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="col-12" style="text-align: center;">
                <button type="submit" name="verif" class="btn btn-success">Repair</button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['verif'])) {
        for ($in = 1; $in <= $i; $in++) {
            $c_serialnumber = $_SESSION['serialnumber_repair'];
            $c_pianoname = $_SESSION['pianoname_repair'];
            if (!empty($_POST['ck' . $in])) {
                $c_repairdate = date('Y-m-d H:i:s', strtotime($now));
                $c_repair = $_SESSION['repair_name'];
                $c_item = $_POST['c_item' . $in];

                $sql1 = mysqli_query($connect_pro, "UPDATE formng_resulti SET c_repair = '$c_repair', c_repairdate = '$c_repairdate' WHERE c_serialnumber = '$c_serialnumber' AND c_item = '$c_item'");
            }
        }
        if ($sql1) {
    ?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Success',
                        html: 'Input data repair for <br><b><?= $_SESSION['pianoname_repair'] ?></b><br> has been recorded !',
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
    ?>

</div>
<!-- isi hasil scan slip number -->