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
            <div class="col-6" style="padding-bottom: 5%;">
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
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
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
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
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
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
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
                        ?>
                            <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: <?= $top ?>%; left: <?= $left ?>%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><?= $label ?></button>
                        <?php
                        }
                        ?>
                        <!-- Line 4 -->
                    </div>
                </center>
            </div>
            <!-- Modal -->
            <?php
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
                                    <h5 class="modal-title" id="staticBackdropLabel">Top Board Outside - <?= $label ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <span style="font-size: 15px ;">Section Description</span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3 row">
                                                <label class="col-sm-2 col-form-label">Serial</label>
                                                <div class="col-sm-5">
                                                    <input style="border-radius: 3px;" type="text" name="slip_p" class="form-control" value="<?= $slip ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-2 col-form-label">Model</label>
                                                <div class="col-sm-5">
                                                    <input style="border-radius: 3px;" type="text" name="model_p" class="form-control" value="<?= $model ?>" readonly>
                                                </div>
                                            </div>
                                            <!-- <div class="mb-3 row">
                                                                    <label class="col-sm-2 col-form-label">Date</label>
                                                                    <div class="col-sm-5">
                                                                        <input style="border-radius: 3px;" type="text" name="tanggal" class="form-control" value="<?= date('d-m-Y') ?>" readonly>
                                                                    </div>
                                                                </div> -->
                                            <div class="mb-3 row">
                                                <label class="col-sm-2 col-form-label">Status</label>
                                                <div class="col-sm-6">
                                                    <?php
                                                    $cek = 'NG'; // harusnya get data status piano
                                                    ?>
                                                    <input type="radio" name="status_p" value="NG" <?php if ($cek == "NG") {
                                                                                                        echo "checked";
                                                                                                    }  ?>> NG

                                                    <input style="margin-left: 25px;" type="radio" name="status_p" value="PASS" <?php if ($cek == "PASS") {
                                                                                                                                    echo "checked";
                                                                                                                                }  ?>> PASS
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-2 col-form-label">Note</label>
                                                <div class="col-sm-5">
                                                    <?php
                                                    $note = 'Muke'; // harusnya get data ng terakhir, jika belum ada ng maka statusnya default
                                                    ?>
                                                    <select name="note_p" class="form-select">
                                                        <option value="" selected disabled><?= $note ?></option>
                                                        <option value="Muke">Muke</option>
                                                        <option value="Dekok">Dekok</option>
                                                        <option value="Lecet">Lecet</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label class="col-sm-6 col-form-label">Desc (optional)</label>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <?php
                                                    $desc = 'penjelasan'; // harusnya berisi deskripsi
                                                    ?>
                                                    <input style="border-radius: 3px;" type="text" name="desc_p" value="<?= $desc ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            if ($_POST['note_p'] == "") {
                                $note_p = $d1['c_note'];
                            } else {
                                $note_p = $_POST['note_p'];
                            }
                            $pp1 = mysqli_query($connect_p, "UPDATE on_progress set c_status = '$_POST[status_p]', c_note = '$note_p', c_desc = '$_POST[desc_p]' where c_no_slip = '$_SESSION[no_slip]' and c_komponen = '$d1[c_komponen]' and c_bagian = '$d1[c_bagian]'");
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