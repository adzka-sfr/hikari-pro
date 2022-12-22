<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <div class="row">
        <div class="col-11">
            <?php
            $sql = mysqli_query($connect_p, "SELECT distinct c_piano from on_progress where c_no_slip = '$_SESSION[no_slip]' ");
            $data = mysqli_fetch_array($sql);
            ?>
            <h3><?= $_SESSION['no_slip'] ?> - <?= $data['c_piano'] ?></h3>

        </div>

        <div class="col-1" style="text-align: right;">
            <i>T1</i>
        </div>
        <div class="separator"></div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- isi gambar -->

            <!-- gambar 1 -->
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
                                    <img src="../image/topboard_outside.jpg" style="width:100%">
                                    <?php
                                    $s1b1_sql = mysqli_query($connect_p, "SELECT c_status from on_progress where c_no_slip = '$_SESSION[no_slip]' and c_bagian = 'sec1'");
                                    $s1b1 = mysqli_fetch_array($s1b1_sql);

                                    ?>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 20%; top: 25%; left: 5%; background-color: <?php
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
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 25%; left: 20%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">2</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 25%; left: 35%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">3</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 25%; left: 50%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">4</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 25%; left: 65%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">5</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 25%; left: 80%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">6</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 25%; left: 95%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">7</button>
                                    <!-- Line 1 -->

                                    <!-- Line 2 -->
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 45%; left: 5%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">9</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 45%; left: 20%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">10</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 45%; left: 35%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">11</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 45%; left: 50%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">12</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 45%; left: 65%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">13</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 45%; left: 80%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">14</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 45%; left: 95%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">15</button>
                                    <!-- Line 2 -->

                                    <!-- Line 3 -->
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 65%; left: 5%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">17</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 65%; left: 20%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">18</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 65%; left: 35%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">19</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 65%; left: 50%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">20</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 65%; left: 65%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">21</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 65%; left: 80%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">22</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 65%; left: 95%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">23</button>
                                    <!-- Line 3 -->

                                    <!-- Line 4 -->
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 85%; left: 5%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">25</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 85%; left: 20%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">26</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 85%; left: 35%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">27</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 85%; left: 50%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">28</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 85%; left: 65%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">29</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 85%; left: 80%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">30</button>
                                    <button class="bton" style="width: 50px; height: 26px; opacity: 30%; top: 85%; left: 95%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">31</button>
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

            <div class="separator"></div>

            <!-- gambar 2 -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <h2><u>Top Board Inside</u></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="padding-bottom: 5%;">
                            <!-- gambar -->
                            <center>
                                <div class="containere">
                                    <img src="../image/topboard_inside.jpg" style="width:100%">
                                    <!-- Line 1 -->
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 25%; left: 5%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">2</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 25%; left: 20%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">2</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 25%; left: 31%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">3</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 25%; left: 44%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">4</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 25%; left: 57%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">5</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 25%; left: 70%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">6</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 25%; left: 83%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">7</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 25%; left: 96%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">8</button>
                                    <!-- Line 1 -->

                                    <!-- Line 2 -->
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 45%; left: 5%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">9</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 45%; left: 18%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">10</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 45%; left: 31%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">11</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 45%; left: 44%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">12</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 45%; left: 57%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">13</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 45%; left: 70%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">14</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 45%; left: 83%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">15</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 45%; left: 96%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">16</button>
                                    <!-- Line 2 -->

                                    <!-- Line 3 -->
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 65%; left: 5%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">17</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 65%; left: 18%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">18</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 65%; left: 31%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">19</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 65%; left: 44%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">20</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 65%; left: 57%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">21</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 65%; left: 70%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">22</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 65%; left: 83%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">23</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 65%; left: 96%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">24</button>
                                    <!-- Line 3 -->

                                    <!-- Line 4 -->
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 85%; left: 5%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">25</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 85%; left: 18%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">26</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 85%; left: 31%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">27</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 85%; left: 44%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">28</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 85%; left: 57%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">29</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 85%; left: 70%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">30</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 85%; left: 83%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">31</button>
                                    <button class="bton" style="width: 50px; height: 30px; opacity: 30%; top: 85%; left: 96%; background-color: #157347;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">32</button>
                                    <!-- Line 4 -->
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator"></div>

            <!-- gambar 3 -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <h2><u>Body</u></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="padding-bottom: 5%;">
                            <!-- gambar -->
                            <center>
                                <div class="containere">
                                    <img src="../image/body.jpg" style="width:100%">
                                    <button class="bton" style="top: 14%; left: 10%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">PASS</button>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator"></div>

            <!-- gambar 4 -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <h2><u>Body Back</u></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="padding-bottom: 5%;">
                            <!-- gambar -->
                            <center>
                                <div class="containere">
                                    <img src="../image/body_back.jpg" style="width:100%">
                                    <button class="bton" style="top: 14%; left: 10%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">PASS</button>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <!-- table -->
            <div class="row">
                <div class="col-md-12">
                    <!-- tabel dengan judul -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- judul -->
                            <h2>
                                <u>Summary</u>
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Component</th>
                                        <th>Part</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql2 = mysqli_query($connect_p, "SELECT * from on_progress where c_no_slip = '$_SESSION[no_slip]'");
                                    while ($data2 = mysqli_fetch_array($sql2)) {
                                    ?>
                                        <tr>
                                            <td><?= $data2['c_komponen'] ?></td>
                                            <td><?= $data2['c_bagian'] ?></td>
                                            <td><?= $data2['c_status'] ?></td>
                                            <td><?= $data2['c_note'] ?></td>
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
    </div>
</div>
<!-- isi hasil scan slip number -->