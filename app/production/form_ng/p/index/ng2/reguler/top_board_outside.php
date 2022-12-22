<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-12">
                <h2><u>Top Board Outside</u></h2>
                <?php
                $section = 'top board outside';
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="padding-bottom: 5%;">
                <!-- gambar -->
                <center>
                    <!-- mulai dari sini untuk classnya (containere) -->
                    <div class="containere">
                        <img src="../image/reguler/top_board_outside.jpg" style="width:100%">

                        <!-- Line 1 -->
                        <?php
                        $line = 'A';
                        $tbo1_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_piano = '$piano' AND c_section = '$section' AND c_line = '$line'");
                        while ($tbo1 = mysqli_fetch_array($tbo1_sql)) {
                            $top = $tbo1['c_top'];
                            $left = $tbo1['c_left'];
                            $id = $tbo1['c_btn_id'];
                            $label = $tbo1['c_line'] . "-" . $tbo1['c_btn_queue'];

                            // cek apakah ada data ng ?
                            $tbo2_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resulto1 WHERE c_serialnumber = '$slip' AND c_areacode = '$id'");
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
                        $tbo1_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_piano = '$piano' AND c_section = '$section' AND c_line = '$line'");
                        while ($tbo1 = mysqli_fetch_array($tbo1_sql)) {
                            $top = $tbo1['c_top'];
                            $left = $tbo1['c_left'];
                            $id = $tbo1['c_btn_id'];
                            $label = $tbo1['c_line'] . "-" . $tbo1['c_btn_queue'];

                            // cek apakah ada data ng ?
                            $tbo2_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resulto1 WHERE c_serialnumber = '$slip' AND c_areacode = '$id'");
                            if (empty(mysqli_fetch_array($tbo2_sql))) {
                                $bg = 'background-color: #157347;';
                            } else {
                                $bg = 'background-color: #B92C3A;';
                            }
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; <?= $bg ?>" data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
                        <?php
                        }
                        ?>
                        <!-- Line 2 -->

                        <!-- Line 3 -->
                        <?php
                        $line = 'C';
                        $tbo1_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_piano = '$piano' AND c_section = '$section' AND c_line = '$line'");
                        while ($tbo1 = mysqli_fetch_array($tbo1_sql)) {
                            $top = $tbo1['c_top'];
                            $left = $tbo1['c_left'];
                            $id = $tbo1['c_btn_id'];
                            $label = $tbo1['c_line'] . "-" . $tbo1['c_btn_queue'];

                            // cek apakah ada data ng ?
                            $tbo2_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resulto1 WHERE c_serialnumber = '$slip' AND c_areacode = '$id'");
                            if (empty(mysqli_fetch_array($tbo2_sql))) {
                                $bg = 'background-color: #157347;';
                            } else {
                                $bg = 'background-color: #B92C3A;';
                            }
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; <?= $bg ?>" data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
                        <?php
                        }
                        ?>
                        <!-- Line 3 -->

                        <!-- Line 4 -->
                        <?php
                        $line = 'D';
                        $tbo1_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_piano = '$piano' AND c_section = '$section' AND c_line = '$line'");
                        while ($tbo1 = mysqli_fetch_array($tbo1_sql)) {
                            $top = $tbo1['c_top'];
                            $left = $tbo1['c_left'];
                            $id = $tbo1['c_btn_id'];
                            $label = $tbo1['c_line'] . "-" . $tbo1['c_btn_queue'];
                            // cek apakah ada data ng ?
                            $tbo2_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resulto1 WHERE c_serialnumber = '$slip' AND c_areacode = '$id'");
                            if (empty(mysqli_fetch_array($tbo2_sql))) {
                                $bg = 'background-color: #157347;';
                            } else {
                                $bg = 'background-color: #B92C3A;';
                            }
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; <?= $bg ?>" data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
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
            $ng_sql = mysqli_query($connect_pro, "SELECT * FROM formng_listng WHERE c_area = 'outside'");
            while ($ng_data = mysqli_fetch_array($ng_sql)) {
                $data_ng[$a] = $ng_data['c_ng'];
                $a++;
            }

            $modal_sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoor WHERE c_piano = '$piano' AND c_section = '$section'");
            while ($modal_data = mysqli_fetch_array($modal_sql)) {
                $top = $modal_data['c_top'];
                $left = $modal_data['c_left'];
                $id = $modal_data['c_btn_id'];
                $label = $modal_data['c_line'] . "-" . $modal_data['c_btn_queue'];
            ?>
                <div class="modal fade" id="<?= $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="serialnumber">Serial Number :</label>
                                                    <input style="border-radius: 3px;" type="text" name="slip_p" class="form-control" value="<?= $slip ?>" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="model">Model :</label>
                                                    <input style="border-radius: 3px;" type="text" name="model" class="form-control" value="<?= $model ?>" readonly>
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
                                                <!-- <label class="col-sm-2 col-form-label">Note</label> -->
                                                <div class="col-sm-12">
                                                    <label for="NG">Type of NG :</label>
                                                    <?php
                                                    $note = 'Muke'; // harusnya get data ng terakhir, jika belum ada ng maka statusnya default
                                                    ?>
                                                    <select class="halodeck" name="ng[]" multiple="multiple" style="width:100%">
                                                        <?php
                                                        for ($i = 0; $i < count($data_ng); $i++) {
                                                            // cek data ng yang sudah tersimpan
                                                            $modal_sql1 = mysqli_query($connect_pro, "SELECT id FROM formng_resulto1 WHERE c_serialnumber = '$slip' AND c_areacode = '$id' AND c_ng = '$data_ng[$i]'");
                                                            if (empty(mysqli_fetch_array($modal_sql1))) {
                                                                $sel = '';
                                                            } else {
                                                                $sel = 'selected';
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

                            if (empty($_POST['ng'])) {
                                $pp1 = mysqli_query($connect_pro, "DELETE FROM formng_resulto1 where c_serialnumber = '$slip' AND c_areacode = '$id'");
                            } else {
                                // delete untuk kemudian melakukan update di bawahnya
                                mysqli_query($connect_pro, "DELETE FROM formng_resulto1 where c_serialnumber = '$slip' AND c_areacode = '$id'");

                                foreach ($_POST['ng'] as $value) {
                                    $pp1 = mysqli_query($connect_pro, "INSERT INTO formng_resulto1 SET c_serialnumber = '$slip', c_model = '$model', c_section = '$section', c_arealabel = '$label', c_areacode = '$id', c_ng = '$value', c_inspectiondate = '$date_in', c_checker = '$_SESSION[nama]' ");
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
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width: 10%;">No</th>
                <th style=" width: 20%;">Area Code</th>
                <th>Type of NG</th>
                <th style="width: 20%;">Inspection Time</th>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $his_ng = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber = '$slip' AND c_section = '$section' ORDER BY c_arealabel desc");
                if (empty(mysqli_fetch_array($his_ng))) {
                ?>
                    <tr>
                        <td style="text-align: center;" colspan="4">No Data</td>
                    </tr>
                    <?php
                } else {
                    $his_ng = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber = '$slip' AND c_section = '$section' ORDER BY c_arealabel desc");
                    while ($his_ng_data = mysqli_fetch_array($his_ng)) {
                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $no ?></td>
                            <td style="text-align: center;"><?= $his_ng_data['c_arealabel'] ?></td>
                            <td><?= $his_ng_data['c_ng'] ?></td>
                            <td style="text-align: center;"><?= $his_ng_data['c_inspectiondate'] ?></td>
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