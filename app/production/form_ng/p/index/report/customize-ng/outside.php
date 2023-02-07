<div class="row">
    <div class="col-12" style="margin-top: 10px;">
        <h5>Outsddide</h5>
    </div>
</div>
<div class="row">
    <div class="col-6 tableFixHead-4">
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width:10%;">No</th>
                <th>NG</th>
                <th>Dept</th>
            </thead>
            <tbody>
                <?php
                $no  = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_listng WHERE c_area = 'outside'");
                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                    if ($data['c_status'] == 'disabled') {
                ?>
                        <tr style="background-color: #E2E3E5;">
                            <td style="text-align: center; "><s><?= $no ?></s></td>
                            <td><s><?= $data['c_ng'] ?></s></td>
                            <td style="text-align: center;"><s><?= $data['c_dept'] ?></s></td>
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr>
                            <td style="text-align: center; "><?= $no ?></td>
                            <td><?= $data['c_ng'] ?></td>
                            <td style="text-align: center;"><?= $data['c_dept'] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <h5>Add NG Outside</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" name="ngout" placeholder="Type NG here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Type NG here</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="margin-top: 20px;">
                    <input style="padding-right: 10px ;" type="radio" class="flat" name="dept" value="PAINTING" required />Painting
                </div>
                <div class="col-6" style="margin-top: 20px;">
                    <input style="padding-right: 10px ;" type="radio" class="flat" name="dept" value="ASSEMBLY" />Assembly
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="margin-top: 20px;">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" required name="in"> Saya yakin untuk menambah data NG
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12" style="text-align: right;">
                    <button name="addout" class="btn btn-success" style="width: 100px;">Add</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['addout'])) {
            $c_area = 'outside';
            $c_ng = $_POST['ngout'];
            $c_dept = $_POST['dept'];
            $c_status = 'enable';
            $dli = mysqli_query($connect_pro, "INSERT INTO formng_listng SET c_area = '$c_area', c_ng = '$c_ng', c_dept = '$c_dept', c_status = '$c_status'");

            if ($dli) {
        ?>
                <script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'Success',
                            html: 'Data added!',
                            type: 'success',
                            confirmButtonText: 'Ok',
                            allowOutsideClick: true
                        }).then(function() {
                            window.location = 'main.php?p=ng';
                        });
                    });
                </script>
        <?php
            }
        }
        ?>

        <div class="row">
            <div class="col-12">
                <h5>Enable/Disabled NG</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <select class="cari_basic" style="width: 100% " required name="idng">
                        <option></option>
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_listng WHERE c_area = 'outside'");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['id'] ?>"><?= $data['c_ng'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="margin-top: 20px;">
                    <input style="padding-right: 10px ;" type="radio" class="flat" name="c_status" value="enable" required />Enable
                </div>
                <div class="col-6" style="margin-top: 20px;">
                    <input style="padding-right: 10px ;" type="radio" class="flat" name="c_status" value="disabled" />Disabled
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="margin-top: 20px;">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" required name="in"> Saya yakin melakukan update untuk data terpilih
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12" style="text-align: right;">
                    <button name="updateout" class="btn btn-primary" style="width: 100px;">Update</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['updateout'])) {
            $id = $_POST['idng'];
            $c_status = $_POST['c_status'];
            $dli = mysqli_query($connect_pro, "UPDATE formng_listng SET c_status = '$c_status' WHERE id = '$id'");

            if ($dli) {
        ?>
                <script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'Success',
                            html: 'Data updated!',
                            type: 'success',
                            confirmButtonText: 'Ok',
                            allowOutsideClick: true
                        }).then(function() {
                            window.location = 'main.php?p=ng';
                        });
                    });
                </script>
        <?php
            }
        }
        ?>
    </div>
</div>