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
            <i>T2</i>
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
                                <div class="containere">
                                    <img src="../image/topboard_outside.jpg" style="width:100%">
                                    <?php
                                    $s1b1_sql = mysqli_query($connect_p, "SELECT c_status from on_progress where c_no_slip = '$_SESSION[no_slip]' and c_bagian = 'sec1'");
                                    $s1b1 = mysqli_fetch_array($s1b1_sql);

                                    ?>
                                    <button class="bton" style="top: 14%; left: 10%; background-color: <?php
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
                                    <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">PASS</button>
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
                                    $sql2 = mysqli_query($connect_p, "SELECT * from on_progress");
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