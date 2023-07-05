<div class="row">
    <div class="col-6" style="max-height: 500px;">
        <script>
            $(document).ready(function() {
                $('#cus_cab').DataTable({
                    paging: false,
                    scrollY: '350px',
                    scrollCollapse: true,
                    "dom": '<"wrapper"flipt>'
                });
            });
        </script>
        <table id="cus_cab" style="width: 100%;" class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width:10%;">No</th>
                <th>Cabinet</th>
            </thead>
            <tbody>
                <?php
                $no  = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_listcabinet order by c_name");
                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                    if ($data['c_status'] == 'disabled') {
                ?>
                        <tr style="background-color: #E2E3E5;">
                            <td style="text-align: center; "><s><?= $no ?></s></td>
                            <td><s><?= $data['c_name'] ?></s></td>
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr>
                            <td style="text-align: center; "><?= $no ?></td>
                            <td><?= $data['c_name'] ?></td>
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
                <h5>Add Cabinet</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" name="cabin" placeholder="Type NG here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Type cabinet name here</label>
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
                    <button name="addcab" class="btn btn-success" style="width: 100px;">Add</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['addcab'])) {
            $c_name = $_POST['cabin'];
            $c_status = 'enable';
            $dli = mysqli_query($connect_pro, "INSERT INTO formng_listcabinet SET c_name = '$c_name', c_status = '$c_status'");

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
                            window.location = 'main.php?p=cab';
                        });
                    });
                </script>
        <?php
            }
        }
        ?>

        <div class="row">
            <div class="col-12">
                <h5>Enable/Disabled Cabinet</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <select class="cari_basic" style="width: 100% " required name="idcab">
                        <option></option>
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_listcabinet order by c_name asc");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['id'] ?>"><?= $data['c_name'] ?></option>
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
                    <button name="deletecab" class="btn btn-primary" style="width: 100px;">Update</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['deletecab'])) {
            $id = $_POST['idcab'];
            $c_status = $_POST['c_status'];
            $dli = mysqli_query($connect_pro, "UPDATE formng_listcabinet SET c_status = '$c_status' WHERE id = '$id'");

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
                            window.location = 'main.php?p=cab';
                        });
                    });
                </script>
        <?php
            }
        }
        ?>
    </div>
</div>