<br>
<div class="row">
    <div class="col-7 tableFixHead-4">
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width:10%;">No</th>
                <th>Completeness Process (Polyester)</th>
            </thead>
            <tbody>
                <?php
                $no  = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_checkcomplete WHERE c_type = 'p' order by id");
                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                    if ($data['c_status'] == 'disabled') {
                ?>
                        <tr style="background-color: #E2E3E5;">
                            <td style="text-align: center; "><s><?= $no ?></s></td>
                            <td><s><?= $data['c_partname'] ?></s></td>
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr>
                            <td style="text-align: center; "><?= $no ?></td>
                            <td><?= $data['c_partname'] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-5">
        <div class="row">
            <div class="col-12">
                <h5>Add Completeness Process (Polyester)</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" name="propol" placeholder="Type process here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Type process name here</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="margin-top: 20px;">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" required name="in"> Saya yakin untuk menambah cabinet ke dalam list
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12" style="text-align: right;">
                    <button name="addpropol" class="btn btn-success" style="width: 100px;">Add</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['addpropol'])) {
            $c_partname = $_POST['propol'];
            $c_type = 'p';
            $c_code_lama = 'pol';
            $c_status = 'enable';

            $dli = mysqli_query($connect_pro, "INSERT INTO formng_checkcomplete SET c_partname = '$c_partname', c_type = '$c_type', c_code = '$c_code_lama', c_status = '$c_status'");

            $sql1 = mysqli_query($connect_pro, "SELECT MAX(id) as maks FROM formng_checkcomplete");
            $data1 = mysqli_fetch_array($sql1);
            $c_code = 'p' . $data1['maks'];

            $dli = mysqli_query($connect_pro, "UPDATE formng_checkcomplete SET c_code = '$c_code' WHERE c_code = '$c_code_lama'");

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
                            window.location = 'main.php?p=cp';
                        });
                    });
                </script>
        <?php
            }
        }
        ?>

        <div class="row">
            <div class="col-12 mt-3">
                <h5>Enable/Disabled Completeness Process (Polyester)</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <select class="cari_basic" style="width: 100% " required name="idpropol">
                        <option></option>
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_checkcomplete WHERE c_type = 'p' order by id asc");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['id'] ?>"><?= $data['c_partname'] ?></option>
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
                    <button name="updatepropol" class="btn btn-primary" style="width: 100px;">Update</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['updatepropol'])) {
            $id = $_POST['idpropol'];
            $c_status = $_POST['c_status'];
            $dli = mysqli_query($connect_pro, "UPDATE formng_checkcomplete SET c_status = '$c_status' WHERE id = '$id'");

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
                            window.location = 'main.php?p=cp';
                        });
                    });
                </script>
        <?php
            }
        }
        ?>
    </div>
</div>