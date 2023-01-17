<div class="row">
    <div class="col-md-12">
        <?php
        $section = '1 top board outside';
        ?>

        <div class="row">
            <div class="col-12" style="padding-top: 25px; padding-bottom: 10px;">
                <!-- gambar -->
                <center>
                    <!-- mulai dari sini untuk classnya (containere) -->
                    <div class="containere">
                        <img src="../image/reguler/top_board_outside.jpg" style="width:100%">

                        <!-- Line 1 -->
                        <?php
                        $tbo1_sql = mysqli_query($connect_pro, "SELECT distinct r.c_areacode, b.c_top, b.c_left, b.c_line, b.c_btn_queue FROM formng_resultro r JOIN formng_basecoor b ON r.c_areacode = b.c_btn_id WHERE r.c_serialnumber = '$serial_number' AND r.c_section = '$section' AND r.c_process='$_SESSION[last_process]'");
                        while ($tbo1 = mysqli_fetch_array($tbo1_sql)) {
                            $top = $tbo1['c_top'];
                            $left = $tbo1['c_left'];
                            $id = $tbo1['c_areacode'];
                            $label = $tbo1['c_line'] . "-" . $tbo1['c_btn_queue'];

                            // cek apakah ada data ng ?
                            $bg = 'background-color: #B92C3A;';
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; <?= $bg ?> " data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
                        <?php
                        }
                        ?>
                        <!-- Line 1 -->
                    </div>
                </center>
            </div>
            <!-- Modal -->
            <?php
            $data_ng = array();
            $a = 0;
            $ng_sql = mysqli_query($connect_pro, "SELECT * FROM formng_listng WHERE c_area = 'outside'");
            while ($ng_data = mysqli_fetch_array($ng_sql)) {
                $data_ng[$a] = $ng_data['c_ng'];
                $a++;
            }
            $data_cb = array();
            $b = 0;
            $cb_sql = mysqli_query($connect_pro, "SELECT * FROM formng_listcabinet");
            while ($cb_data = mysqli_fetch_array($cb_sql)) {
                $data_cb[$b] = $cb_data['c_name'];
                $b++;
            }

            $modal_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_piano = '$type_piano' AND c_section = '$section'");
            while ($modal_data = mysqli_fetch_array($modal_sql)) {
                $top = $modal_data['c_top'];
                $left = $modal_data['c_left'];
                $id = $modal_data['c_btn_id'];
                $label = $modal_data['c_line'] . "-" . $modal_data['c_btn_queue'];

                // ambil data ng yang sudah masuk
                // cabinet
                $cabng = array();
                $a = 0;
                $cabsql = mysqli_query($connect_pro, "SELECT DISTINCT c_cabinet FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_areacode = '$id'");
                while ($cabdata = mysqli_fetch_array($cabsql)) {
                    $cabng[$a] = $cabdata['c_cabinet'];
                    $a++;
                }
            ?>
                <div class="modal fade" id="<?= $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <form method="POST">
                            <div class="modal-content" style="text-align: left;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"><?= ucwords($section) ?> (<?= $label ?>)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span style="font-size: 15px ;">Section Description</span>
                                        </div>
                                        <div class="col-md-6" style="text-align: right;">

                                            <span style="font-size: 15px ; font-style: italic;">Repair Outside</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <div class="containere">
                                                    <img src="../image/reguler/top_board_outside.jpg" style="width:100%">
                                                    <?php
                                                    $idp_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_btn_id = '$id'");
                                                    $idp = mysqli_fetch_array($idp_sql);
                                                    $top = $idp['c_top'];
                                                    $left = $idp['c_left'];
                                                    $label = $modal_data['c_line'] . "-" . $modal_data['c_btn_queue'];
                                                    ?>
                                                    <button disabled class="bton" style="width: 51px; height: 32px; opacity: 60%; top: <?= $top ?>%; left: <?= $left ?>%;"><?= $label ?></button>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="serialnumber">Serial Number :</label>
                                                    <input style="border-radius: 3px;" type="text" name="serial" class="form-control" value="<?= $serial_number ?>" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="model">Model :</label>
                                                    <input style="border-radius: 3px;" type="text" name="model" class="form-control" value="<?= $piano_name ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="checker">Checker:</label>
                                                    <input style="border-radius: 3px;" type="text" name="checker" class="form-control" value="<?= $_SESSION['checker1'] ?>" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="inspectiondate">PIC Repair :</label>
                                                    <input style="border-radius: 3px;" type="text" name="pic" class="form-control" value="<?= $_SESSION['nama'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <table class="table table-bordered table-striped">
                                                        <thead style="text-align: center;">
                                                            <th style="width: 5%;">No</th>
                                                            <th style="width: 33%;">Cabinet</th>
                                                            <th style="width: 34%;">NG</th>
                                                            <th style="width: 13%;">Repaired</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $no = 0;
                                                            $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_resultro WHERE c_serialnumber = '$serial_number' AND c_areacode = '$id' AND c_process='$_SESSION[last_process]'");
                                                            while ($data1 = mysqli_fetch_array($sql1)) {
                                                                $no++;
                                                            ?>
                                                                <tr>
                                                                    <input type="hidden" name="id<?= $no ?>" value="<?= $data1['id'] ?>">
                                                                    <td style="text-align: center;"><?= $no ?></td>
                                                                    <td><?= $data1['c_cabinet'] ?></td>
                                                                    <td><?= $data1['c_ng'] ?></td>
                                                                    <td style="text-align: center;">
                                                                        <?php
                                                                        if (!empty($data1['c_repairdate'])) {
                                                                            // echo "Repaired";
                                                                        ?>
                                                                            <input checked type="checkbox" value="" name="check<?= $no ?>" style="transform: scale(1.5);" disabled>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <input type="checkbox" value="ok" name="check<?= $no ?>" style="transform: scale(1.5);">
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="<?= $id ?>" value="save" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST[$id])) {
                            $date_in = date('Y-m-d H:i:s');
                            for ($c = 1; $c <= $no; $c++) {
                                if (!empty($_POST['check' . $c])) {
                                    $id = $_POST['id' . $c];
                                    $pp1 = mysqli_query($connect_pro, "UPDATE formng_resultro SET c_repairdate = '$date_in', c_picrepair = '$_SESSION[nama]' WHERE id = $id");
                                }
                            }
                            // update pada resulto1 dengan membedakan query berdasarkan proses yang aktif (oc1, oc2, oc3)
                            // oc1
                            if ($_SESSION['last_process'] == 'oc1') {
                                $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resultro WHERE c_serialnumber ='$serial_number' AND c_process = '$_SESSION[last_process]'");
                                while ($data2 = mysqli_fetch_array($sql2)) {
                                    if (!empty($data2['c_repairdate'])) {
                                        $pp1 =  mysqli_query($connect_pro, "UPDATE formng_resulto1 SET c_repairdate1 = '$data2[c_repairdate]', c_repair1 = '$data2[c_picrepair]' WHERE c_serialnumber = '$data2[c_serialnumber]' AND c_areacode = '$data2[c_areacode]' AND c_cabinet = '$data2[c_cabinet]' AND c_ng1 = '$data2[c_ng]'");
                                    }
                                }
                            }

                            // oc2
                            if ($_SESSION['last_process'] == 'oc2') {
                                $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resultro WHERE c_serialnumber ='$serial_number' AND c_process = '$_SESSION[last_process]'");
                                while ($data2 = mysqli_fetch_array($sql2)) {
                                    if (!empty($data2['c_repairdate'])) {
                                        $pp1 =  mysqli_query($connect_pro, "UPDATE formng_resulto1 SET c_repairdate2 = '$data2[c_repairdate]', c_repair2 = '$data2[c_picrepair]' WHERE c_serialnumber = '$data2[c_serialnumber]' AND c_areacode = '$data2[c_areacode]' AND c_cabinet = '$data2[c_cabinet]' AND c_ng2 = '$data2[c_ng]'");
                                    }
                                }
                            }

                            // oc2
                            if ($_SESSION['last_process'] == 'oc3') {
                                $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resultro WHERE c_serialnumber ='$serial_number' AND c_process = '$_SESSION[last_process]'");
                                while ($data2 = mysqli_fetch_array($sql2)) {
                                    if (!empty($data2['c_repairdate'])) {
                                        $pp1 =  mysqli_query($connect_pro, "UPDATE formng_resulto1 SET c_repairdate3 = '$data2[c_repairdate]', c_repair3 = '$data2[c_picrepair]' WHERE c_serialnumber = '$data2[c_serialnumber]' AND c_areacode = '$data2[c_areacode]' AND c_cabinet = '$data2[c_cabinet]' AND c_ng3 = '$data2[c_ng]'");
                                    }
                                }
                            }

                            if ($pp1) {
                        ?>
                                <script>
                                    $(document).ready(function() {
                                        Swal.fire({
                                            title: 'Success',
                                            text: 'Section Updated!',
                                            type: 'success',
                                            confirmButtonText: 'OK'
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
                </div>
            <?php
            }
            ?>

            <!-- Modal -->
        </div>
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <h2><u>Top Board Outside</u></h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 tableFixHead-3">
        <table class="table table-striped table-bordered">
            <thead style="text-align: center;">
                <th style="width: 10%;">No</th>
                <th style=" width: 15%;">Area Code</th>
                <th style=" width: 20%;">Cabinet</th>
                <th>Type of NG</th>
                <th style="width: 20%;">Status <?= $_SESSION['last_process'] ?></th>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $his_ng = mysqli_query($connect_pro, "SELECT * FROM formng_resultro WHERE c_serialnumber = '$serial_number' AND c_section = '$section' AND c_process = '$_SESSION[last_process]' ORDER BY c_areacode asc");
                if (empty(mysqli_fetch_array($his_ng))) {
                ?>
                    <tr>
                        <td style="text-align: center;" colspan="5">No Data</td>
                    </tr>
                    <?php
                } else {
                    $his_ng = mysqli_query($connect_pro, "SELECT r.c_cabinet, r.c_ng, r.c_repairdate, b.c_line, b.c_btn_queue FROM formng_resultro r JOIN formng_basecoor b ON r.c_areacode = b.c_btn_id WHERE r.c_serialnumber = '$serial_number' AND r.c_section = '$section' AND r.c_process='$_SESSION[last_process]' ORDER BY r.c_areacode asc");
                    while ($his_ng_data = mysqli_fetch_array($his_ng)) {
                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $no ?></td>
                            <td style="text-align: center;"><?= $his_ng_data['c_line'] . "-" . $his_ng_data['c_btn_queue'] ?></td>
                            <td><?= $his_ng_data['c_cabinet'] ?></td>
                            <td><?= $his_ng_data['c_ng'] ?></td>
                            <td style="text-align: center;">
                                <?php
                                if (!empty($his_ng_data['c_repairdate'])) {
                                    // echo "Repaired";
                                ?>
                                    <input checked type="checkbox" style="transform: scale(1.5);" disabled>
                                <?php
                                } else {
                                ?>
                                    <input type="checkbox" style="transform: scale(1.5);" disabled>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                <?php
                        $no++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>