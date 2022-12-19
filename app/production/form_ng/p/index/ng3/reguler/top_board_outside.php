<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-12">
                <h2><u>Top Board Outside</u></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="padding-bottom: 5%;">
                <!-- gambar -->
                <center>
                    <!-- mulai dari sini untuk classnya (containere) -->
                    <div class="containere">
                        <img src="../image/reguler/top_board_outside.jpg" style="width:100%">
                        <?php
                        $s1b1_sql = mysqli_query($connect_p, "SELECT c_status from on_progress where c_no_slip = '$_SESSION[no_slip]' and c_bagian = 'sec1'");
                        $s1b1 = mysqli_fetch_array($s1b1_sql);

                        ?>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 23%; left: 11%; background-color: <?php
                                                                                                                                    if ($s1b1['c_status'] == "PASS") {
                                                                                                                                        echo "#157347;";
                                                                                                                                    } elseif ($s1b1['c_status'] == "NG") {
                                                                                                                                        echo "#B92C3A;";
                                                                                                                                    } ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <?= $s1b1['c_status']; ?>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST">
                                    <div class="modal-content" style="text-align: left;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Top Board Outside - Section 1</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <span style="font-size: 15px ;">Section Description</span>
                                                    <?php
                                                    $p1 = mysqli_query($connect_p, "SELECT * from on_progress where c_no_slip = '$_SESSION[no_slip]' and c_bagian = 'sec1'");
                                                    $d1 = mysqli_fetch_array($p1);
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3 row">
                                                        <label class="col-sm-2 col-form-label">Slip</label>
                                                        <div class="col-sm-5">
                                                            <input style="border-radius: 3px;" type="text" name="slip_p" class="form-control" value="<?= $d1['c_no_slip'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-sm-2 col-form-label">Model</label>
                                                        <div class="col-sm-5">
                                                            <input style="border-radius: 3px;" type="text" name="model_p" class="form-control" value="<?= $d1['c_piano'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-sm-2 col-form-label">Part</label>
                                                        <div class="col-sm-5">
                                                            <input style="border-radius: 3px;" type="text" name="model_p" class="form-control" value="<?= $d1['c_bagian'] ?>" readonly>
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
                                                            $cek = $d1['c_status'];
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
                                                            <select name="note_p" class="form-select">
                                                                <option value="" selected disabled><?= $d1['c_note'] ?></option>
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
                                                            <input style="border-radius: 3px;" type="text" name="desc_p" value="<?= $d1['c_desc'] ?>" class="form-control">
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
                        <!-- Modal -->
                        <!-- Line 1 -->
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 23%; left: 24%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">2</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 23%; left: 37%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">3</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 23%; left: 50%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">4</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 23%; left: 63%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">5</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 23%; left: 76%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">6</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 23%; left: 89%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">6</button>
                        <!-- Line 1 -->

                        <!-- Line 2 -->
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 44%; left: 11%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">9</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 44%; left: 24%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">2</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 44%; left: 37%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">3</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 44%; left: 50%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">4</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 44%; left: 63%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">5</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 44%; left: 76%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">6</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 44%; left: 89%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">6</button>
                        <!-- Line 2 -->

                        <!-- Line 3 -->
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 65%; left: 11%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">9</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 65%; left: 24%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">2</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 65%; left: 37%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">3</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 65%; left: 50%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">4</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 65%; left: 63%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">5</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 65%; left: 76%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">6</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 65%; left: 89%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">6</button>
                        <!-- Line 3 -->

                        <!-- Line 4 -->
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 86%; left: 11%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">9</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 86%; left: 24%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">2</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 86%; left: 37%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">3</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 86%; left: 50%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">4</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 86%; left: 63%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">5</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 86%; left: 76%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">6</button>
                        <button class="bton" style="width: 51px; height: 32px; opacity: 20%; top: 86%; left: 89%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">6</button>
                        <!-- Line 4 -->

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST">
                                    <div class="modal-content" style="text-align: left;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Top Board Outside - Area 2</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <span style="font-size: 15px ;">Section Description</span>
                                                    <?php
                                                    $p1 = mysqli_query($connect_p, "SELECT * from on_progress where c_no_slip = '$_SESSION[no_slip]' and c_bagian = 'sec1'");
                                                    $d1 = mysqli_fetch_array($p1);
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3 row">
                                                        <label class="col-sm-2 col-form-label">Slip</label>
                                                        <div class="col-sm-5">
                                                            <input style="border-radius: 3px;" type="text" name="slip_p" class="form-control" value="<?= $d1['c_no_slip'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-sm-2 col-form-label">Model</label>
                                                        <div class="col-sm-5">
                                                            <input style="border-radius: 3px;" type="text" name="model_p" class="form-control" value="<?= $d1['c_piano'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-sm-2 col-form-label">Part</label>
                                                        <div class="col-sm-5">
                                                            <input style="border-radius: 3px;" type="text" name="model_p" class="form-control" value="<?= $d1['c_bagian'] ?>" readonly>
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
                                                            $cek = $d1['c_status'];
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
                                                            <select name="note_p" class="form-select">
                                                                <option value="" selected disabled><?= $d1['c_note'] ?></option>
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
                                                            <input style="border-radius: 3px;" type="text" name="desc_p" value="<?= $d1['c_desc'] ?>" class="form-control">
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
                        <!-- Modal -->
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>