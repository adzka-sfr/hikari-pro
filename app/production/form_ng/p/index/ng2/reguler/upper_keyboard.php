<div class="row">
    <div class="col-md-12">
        <?php
        $section = '3 upper keyboard';
        ?>

        <div class="row">
            <div class="col-12" style="padding-top: 20px; padding-bottom: 10px;">
                <!-- gambar -->
                <center>
                    <div class="containere">
                        <img src="../image/reguler/area_depan.jpg" style="width:100%">
                        <!-- Line 1 -->
                        <?php
                        $line = 'A';
                        $tbo1_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_piano = '$type_piano' AND c_section = '$section' AND c_line = '$line'");
                        while ($tbo1 = mysqli_fetch_array($tbo1_sql)) {
                            $top = $tbo1['c_top'];
                            $left = $tbo1['c_left'];
                            $id = $tbo1['c_btn_id'];
                            $label = $tbo1['c_line'] . "-" . $tbo1['c_btn_queue'];

                            // cek apakah ada data ng ?
                            $tbo2_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_areacode = '$id'");
                            if (empty(mysqli_fetch_array($tbo2_sql))) {
                                $bg = 'background-color: #157347;';
                            } else {
                                $bg = 'background-color: #B92C3A;';
                            }
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; <?= $bg ?> " data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
                        <?php
                        }
                        ?>
                        <!-- Line 1 -->

                        <!-- Line 2 -->
                        <?php
                        $line = 'B';
                        $tbo1_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_piano = '$type_piano' AND c_section = '$section' AND c_line = '$line'");
                        while ($tbo1 = mysqli_fetch_array($tbo1_sql)) {
                            $top = $tbo1['c_top'];
                            $left = $tbo1['c_left'];
                            $id = $tbo1['c_btn_id'];
                            $label = $tbo1['c_line'] . "-" . $tbo1['c_btn_queue'];

                            // cek apakah ada data ng ?
                            $tbo2_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_areacode = '$id'");
                            if (empty(mysqli_fetch_array($tbo2_sql))) {
                                $bg = 'background-color: #157347;';
                            } else {
                                $bg = 'background-color: #B92C3A;';
                            }
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; <?= $bg ?> " data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
                        <?php
                        }
                        ?>
                        <!-- Line 2 -->

                        <!-- Line 3 -->
                        <?php
                        $line = 'C';
                        $tbo1_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_piano = '$type_piano' AND c_section = '$section' AND c_line = '$line'");
                        while ($tbo1 = mysqli_fetch_array($tbo1_sql)) {
                            $top = $tbo1['c_top'];
                            $left = $tbo1['c_left'];
                            $id = $tbo1['c_btn_id'];
                            $label = $tbo1['c_line'] . "-" . $tbo1['c_btn_queue'];

                            // cek apakah ada data ng ?
                            $tbo2_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_areacode = '$id'");
                            if (empty(mysqli_fetch_array($tbo2_sql))) {
                                $bg = 'background-color: #157347;';
                            } else {
                                $bg = 'background-color: #B92C3A;';
                            }
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; <?= $bg ?> " data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
                        <?php
                        }
                        ?>
                        <!-- Line 3 -->

                        <!-- Line 4 -->
                        <?php
                        $line = 'D';
                        $tbo1_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_piano = '$type_piano' AND c_section = '$section' AND c_line = '$line'");
                        while ($tbo1 = mysqli_fetch_array($tbo1_sql)) {
                            $top = $tbo1['c_top'];
                            $left = $tbo1['c_left'];
                            $id = $tbo1['c_btn_id'];
                            $label = $tbo1['c_line'] . "-" . $tbo1['c_btn_queue'];

                            // cek apakah ada data ng ?
                            $tbo2_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_areacode = '$id'");
                            if (empty(mysqli_fetch_array($tbo2_sql))) {
                                $bg = 'background-color: #157347;';
                            } else {
                                $bg = 'background-color: #B92C3A;';
                            }
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; <?= $bg ?> " data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
                        <?php
                        }
                        ?>
                        <!-- Line 4 -->
                    </div>
                </center>
            </div>
            <!-- Modal -->
            <?php
            $data_ng = array();
            $a = 0;
            $ng_sql = mysqli_query($connect_pro, "SELECT * FROM formng_listng WHERE c_area = 'outside' AND c_status = 'enable'");
            while ($ng_data = mysqli_fetch_array($ng_sql)) {
                $data_ng[$a] = $ng_data['c_ng'];
                $a++;
            }
            $data_cb = array();
            $b = 0;
            $cb_sql = mysqli_query($connect_pro, "SELECT * FROM formng_listcabinet WHERE c_status = 'enable'");
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
                                            <span style="font-size: 15px ; font-style: italic;">Outside Check 1</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <div class="containere">
                                                    <img src="../image/reguler/area_depan.jpg" style="width:100%">
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
                                                    <input style="border-radius: 3px;" type="text" name="slip_p" class="form-control" value="<?= $serial_number ?>" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="model">Model :</label>
                                                    <input style="border-radius: 3px;" type="text" name="model" class="form-control" value="<?= $piano_name ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="checker">Checker :</label>
                                                    <input style="border-radius: 3px;" type="text" name="checker" class="form-control" value="<?= $_SESSION['nama'] ?>" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="inspectiondate">Inspection Date :</label>
                                                    <input style="border-radius: 3px;" type="text" name="tanggal" class="form-control" value="<?= date('d-m-Y') ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="NG">Cabinet 1 :</label>
                                                    <?php
                                                    $note = 'Muke'; // harusnya get data ng terakhir, jika belum ada ng maka statusnya default
                                                    ?>
                                                    <select class="halocab" name="cab1" style="width:100%; height: max-content;">
                                                        <option value="" selected disabled>Select Cabinet</option>
                                                        <?php
                                                        for ($i = 0; $i < count($data_cb); $i++) {
                                                            // cek data ng yang sudah tersimpan
                                                            if ($data_cb[$i] == $cabng[0]) {
                                                                $sel = 'selected';
                                                            } else {
                                                                $sel = '';
                                                            }

                                                        ?>
                                                            <option <?= $sel ?> value="<?= $data_cb[$i] ?>"><?= $data_cb[$i] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="NG">Type NG of Cab 1 :</label>
                                                    <?php
                                                    $note = 'Muke'; // harusnya get data ng terakhir, jika belum ada ng maka statusnya default
                                                    ?>
                                                    <select class="halodeck" name="ng1[]" multiple="multiple" style="width:100%;">
                                                        <?php
                                                        for ($i = 0; $i < count($data_ng); $i++) {
                                                            // cek data ng yang sudah tersimpan
                                                            if (!empty($cabng[0])) {
                                                                $modal_sql1 = mysqli_query($connect_pro, "SELECT c_ng1 FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_areacode = '$id' AND c_cabinet = '$cabng[0]' AND c_ng1 = '$data_ng[$i]'");
                                                                if (empty(mysqli_fetch_array($modal_sql1))) {
                                                                    $sel = '';
                                                                } else {
                                                                    $sel = 'selected';
                                                                }
                                                            } else {
                                                                $sel = '';
                                                            }


                                                        ?>
                                                            <option <?= $sel ?> value="<?= $data_ng[$i] ?>"><?= $data_ng[$i] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="NG">Cabinet 2 :</label>
                                                    <?php
                                                    $note = 'Muke'; // harusnya get data ng terakhir, jika belum ada ng maka statusnya default
                                                    ?>
                                                    <select class="halocab" name="cab2" style="width:100%; height: max-content;">
                                                        <option value="" selected disabled>Select Cabinet</option>
                                                        <?php
                                                        for ($i = 0; $i < count($data_cb); $i++) {
                                                            // cek data ng yang sudah tersimpan
                                                            if ($data_cb[$i] == $cabng[1]) {
                                                                $sel = 'selected';
                                                            } else {
                                                                $sel = '';
                                                            }

                                                        ?>
                                                            <option <?= $sel ?> value="<?= $data_cb[$i] ?>"><?= $data_cb[$i] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="NG">Type NG of Cab 2 :</label>
                                                    <?php
                                                    $note = 'Muke'; // harusnya get data ng terakhir, jika belum ada ng maka statusnya default
                                                    ?>
                                                    <select class="halodeck" name="ng2[]" multiple="multiple" style="width:100%;">
                                                        <?php
                                                        for ($i = 0; $i < count($data_ng); $i++) {
                                                            // cek data ng yang sudah tersimpan
                                                            if (!empty($cabng[1])) {
                                                                $modal_sql1 = mysqli_query($connect_pro, "SELECT c_ng1 FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_areacode = '$id' AND c_cabinet = '$cabng[1]' AND c_ng1 = '$data_ng[$i]'");
                                                                if (empty(mysqli_fetch_array($modal_sql1))) {
                                                                    $sel = '';
                                                                } else {
                                                                    $sel = 'selected';
                                                                }
                                                            } else {
                                                                $sel = '';
                                                            }


                                                        ?>
                                                            <option <?= $sel ?> value="<?= $data_ng[$i] ?>"><?= $data_ng[$i] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="NG">Cabinet 3 :</label>
                                                    <?php
                                                    $note = 'Muke'; // harusnya get data ng terakhir, jika belum ada ng maka statusnya default
                                                    ?>
                                                    <select class="halocab" name="cab3" style="width:100%; height: max-content;">
                                                        <option value="" selected disabled>Select Cabinet</option>
                                                        <?php
                                                        for ($i = 0; $i < count($data_cb); $i++) {
                                                            // cek data ng yang sudah tersimpan
                                                            if ($data_cb[$i] == $cabng[2]) {
                                                                $sel = 'selected';
                                                            } else {
                                                                $sel = '';
                                                            }

                                                        ?>
                                                            <option <?= $sel ?> value="<?= $data_cb[$i] ?>"><?= $data_cb[$i] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="NG">Type NG of Cab 3 :</label>
                                                    <select class="halodeck" name="ng3[]" multiple="multiple" style="width:100%;">
                                                        <?php
                                                        for ($i = 0; $i < count($data_ng); $i++) {
                                                            // cek data ng yang sudah tersimpan
                                                            if (!empty($cabng[2])) {
                                                                $modal_sql1 = mysqli_query($connect_pro, "SELECT c_ng1 FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_areacode = '$id' AND c_cabinet = '$cabng[2]' AND c_ng1 = '$data_ng[$i]'");
                                                                if (empty(mysqli_fetch_array($modal_sql1))) {
                                                                    $sel = '';
                                                                } else {
                                                                    $sel = 'selected';
                                                                }
                                                            } else {
                                                                $sel = '';
                                                            }


                                                        ?>
                                                            <option <?= $sel ?> value="<?= $data_ng[$i] ?>"><?= $data_ng[$i] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="mb-1 row">
                                                <label class="col-sm-6 col-form-label">Note (optional)</label>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <?php
                                                    $desc = 'penjelasan'; // harusnya berisi deskripsi
                                                    ?>
                                                    <input style="border-radius: 3px;" type="text" name="desc_p" value="<?= $desc ?>" class="form-control">
                                                </div>
                                            </div> -->
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

                            if (empty($_POST['cab1']) and empty($_POST['cab2']) and empty($_POST['cab3'])) {
                                $pp1 = mysqli_query($connect_pro, "DELETE FROM formng_resulto1 where c_serialnumber = '$serial_number' AND c_areacode = '$id'");
                            } else {
                                // delete untuk kemudian melakukan update di bawahnya
                                $pp1 =  mysqli_query($connect_pro, "DELETE FROM formng_resulto1 where c_serialnumber = '$serial_number' AND c_areacode = '$id'");

                                if (!empty($_POST['cab1'])) {
                                    $cab = $_POST['cab1'];
                                    if (!empty($_POST['ng1'])) {
                                        foreach ($_POST['ng1'] as $value) {
                                            $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resulto1 SET c_serialnumber = '$serial_number', c_pianoname = '$piano_name', c_section = '$section', c_arealabel = '$label', c_areacode = '$id',c_cabinet = '$cab', c_ng1 = '$value', c_inspectiondate1 = '$date_in', c_checker1 = '$_SESSION[nama]' ");
                                        }
                                    }
                                }

                                if (!empty($_POST['cab2'])) {
                                    $cab = $_POST['cab2'];
                                    if (!empty($_POST['ng2'])) {
                                        foreach ($_POST['ng2'] as $value) {
                                            $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resulto1 SET c_serialnumber = '$serial_number', c_pianoname = '$piano_name', c_section = '$section', c_arealabel = '$label', c_areacode = '$id',c_cabinet = '$cab', c_ng1 = '$value', c_inspectiondate1 = '$date_in', c_checker1 = '$_SESSION[nama]' ");
                                        }
                                    }
                                }

                                if (!empty($_POST['cab3'])) {
                                    $cab = $_POST['cab3'];
                                    if (!empty($_POST['ng3'])) {
                                        foreach ($_POST['ng3'] as $value) {
                                            $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resulto1 SET c_serialnumber = '$serial_number', c_pianoname = '$piano_name', c_section = '$section', c_arealabel = '$label', c_areacode = '$id',c_cabinet = '$cab', c_ng1 = '$value', c_inspectiondate1 = '$date_in', c_checker1 = '$_SESSION[nama]' ");
                                        }
                                    }
                                }
                            }
                            if ($pp1) {
                        ?>
                                <script>
                                    // $(document).ready(function() {
                                    //     Swal.fire({
                                    //         title: 'Success',
                                    //         text: 'Section Updated!',
                                    //         type: 'success',
                                    //         confirmButtonText: 'OK'
                                    //     }).then(function() {
                                    window.location = 'index.php';
                                    //     });
                                    // });
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
                <h2><u>Upper Keyboard</u></h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 tableFixHead-3">
        <table class="table table-striped">
            <thead style="text-align: center;">
                <th style="width: 10%;">No</th>
                <th style=" width: 15%;">Area Code</th>
                <th style=" width: 20%;">Cabinet</th>
                <th>Type of NG</th>
                <th style="width: 20%;">Inspection Time</th>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $his_ng = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_section = '$section' ORDER BY c_arealabel desc");
                if (empty(mysqli_fetch_array($his_ng))) {
                ?>
                    <tr>
                        <td style="text-align: center;" colspan="5">No Data</td>
                    </tr>
                    <?php
                } else {
                    $his_ng = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber = '$serial_number' AND c_section = '$section' ORDER BY c_arealabel desc");
                    while ($his_ng_data = mysqli_fetch_array($his_ng)) {
                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $no ?></td>
                            <td style="text-align: center;"><?= $his_ng_data['c_arealabel'] ?></td>
                            <td><?= $his_ng_data['c_cabinet'] ?></td>
                            <td><?= $his_ng_data['c_ng1'] ?></td>
                            <td style="text-align: center;"><?= $his_ng_data['c_inspectiondate1'] ?></td>
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