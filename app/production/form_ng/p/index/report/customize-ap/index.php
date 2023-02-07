<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <h5>Add Piano</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-3">
                    <input name="gmc" style="text-align: center; border-radius: 5px;" type="text" class="form-control" placeholder="GMC">
                </div>
                <div class="col-9">
                    <input name="pianoname" style="border-radius: 5px;" type="text" class="form-control" placeholder="Piano Name">
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="padding-top: 20px;">
                    <label for="completeness form"><u>Completeness Form</u></label>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <input style="padding-right: 10px ;" type="radio" class="flat" name="complete" value="f" required />Furniture
                </div>
                <div class="col-4">
                    <input style="padding-right: 10px ;" type="radio" class="flat" name="complete" value="s" />Silent
                </div>
                <div class="col-4">
                    <input style="padding-right: 10px ;" type="radio" class="flat" name="complete" value="p" />Polyester
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="padding-top: 20px;">
                    <label for="completeness form"><u>Outside Form</u></label>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <input style="padding-right: 10px ;" type="radio" class="flat" name="outside" value="f" required />Furniture
                </div>
                <div class="col-4">
                    <input style="padding-right: 10px ;" type="radio" class="flat" name="outside" value="p" />Polyester
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="margin-top: 20px;">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" required name="in"> Saya yakin untuk menambah data piano
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <button name="addpin" class="btn btn-success" style="width: 100px;">Add</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['addpin'])) {
            $c_gmc = $_POST['gmc'];
            $c_pianoname = $_POST['pianoname'];
            $c_category = $_POST['outside'];
            $c_category2 = $_POST['complete'];
            $dli = mysqli_query($connect_pro, "INSERT INTO formng_category SET c_gmc = '$c_gmc', c_pianoname = '$c_pianoname', c_category = '$c_category', c_category2 = '$c_category2'");

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
                            window.location = 'main.php?p=ap';
                        });
                    });
                </script>
        <?php
            }
        }
        ?>
    </div>
    <div class="col-6">


        <!-- <div class="row">
            <div class="col-12">
                <h5>Delete Piano</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <select class="cari_basic" style="width: 100% " required name="idng">
                        <option></option>
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_category order by c_pianoname asc");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['id'] ?>">(<?= $data['c_gmc'] ?>) <?= $data['c_pianoname'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="margin-top: 20px;">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" required name="in"> Saya yakin melakukan hapus untuk data terpilih
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <button name="deletepin" class="btn btn-danger" style="width: 100px;">Delete</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['deletepin'])) {
            $id = $_POST['idng'];
            $dli = mysqli_query($connect_pro, "DELETE FROM formng_category WHERE id = '$id'");

            if ($dli) {
        ?>
                <script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'Success',
                            html: 'Data deleted!',
                            type: 'success',
                            confirmButtonText: 'Ok',
                            allowOutsideClick: true
                        }).then(function() {
                            window.location = 'main.php?p=ap';
                        });
                    });
                </script>
        <?php
            }
        }
        ?> -->
    </div>
</div>
<div class="row">
    <div class="col-12 tableFixHead-4">
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width:5%;">No</th>
                <th style="width: 13%;">GMC</th>
                <th>Piano Name (same as K-staff)</th>
                <th style="width: 17%;">Form Completeness</th>
                <th style="width: 17%;">Form Outside</th>
            </thead>
            <tbody>
                <?php
                $no  = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_category order by c_pianoname");
                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $no ?></td>
                        <td style="text-align: center;"><?= $data['c_gmc'] ?></td>
                        <td><?= $data['c_pianoname'] ?></td>
                        <td style="text-align: center;">
                            <?php
                            if ($data['c_category2'] == 'p') {
                                echo 'Polyester';
                            } elseif ($data['c_category2'] == 's') {
                                echo 'Silent';
                            } elseif ($data['c_category2'] == 'f') {
                                echo 'Furniture';
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <?php
                            if ($data['c_category'] == 'p') {
                                echo 'Polyester';
                            } elseif ($data['c_category'] == 'f') {
                                echo 'Furniture';
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