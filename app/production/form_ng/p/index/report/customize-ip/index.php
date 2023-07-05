<div class="row">
    <div class="col-7" style="max-height: 500px;">
        <script>
            $(document).ready(function() {
                $('#cus_ip').DataTable({
                    paging: false,
                    scrollY: '350px',
                    scrollCollapse: true,
                    "dom": '<"wrapper"flipt>'
                });
            });
        </script>
        <table id="cus_ip" class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width:10%;">No</th>
                <th>Inside Process</th>
            </thead>
            <tbody>
                <?php
                $no  = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM formng_checkinside order by id");
                while ($data = mysqli_fetch_array($sql)) {
                    $no++;

                    if ($data['c_status'] == 'disabled') {
                ?>
                        <tr style="background-color: #E2E3E5;">
                            <td style="text-align: center; "><s><?= $no ?></s></td>
                            <td><s><?= $data['c_item'] ?></s></td>
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr>
                            <td style="text-align: center; "><?= $no ?></td>
                            <td><?= $data['c_item'] ?></td>
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
                <h5>Add Inside Process</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" name="procin" placeholder="Type process here" id="floatingTextarea"></textarea>
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
                    <button name="addprocin" class="btn btn-success" style="width: 100px;">Add</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['addprocin'])) {
            $c_item = $_POST['procin'];
            $c_code_lama = 'in';
            $c_status = 'enable';

            $dli = mysqli_query($connect_pro, "INSERT INTO formng_checkinside SET c_item = '$c_item', c_code = '$c_code_lama', c_status = '$c_status'");

            $sql1 = mysqli_query($connect_pro, "SELECT MAX(id) as maks FROM formng_checkinside");
            $data1 = mysqli_fetch_array($sql1);
            $c_code = 'in' . $data1['maks'];

            $dli = mysqli_query($connect_pro, "UPDATE formng_checkinside SET c_code = '$c_code' WHERE c_code = '$c_code_lama'");

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
                            window.location = 'main.php?p=ip';
                        });
                    });
                </script>
        <?php
            }
        }
        ?>

        <div class="row">
            <div class="col-12">
                <h5>Enable/Disabled Inside Process</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <select class="cari_basic" style="width: 100% " required name="idprocin">
                        <option></option>
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_checkinside order by id asc");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['id'] ?>"><?= $data['c_item'] ?></option>
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
                    <button name="deleteprocin" class="btn btn-primary" style="width: 100px;">Update</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['deleteprocin'])) {
            $id = $_POST['idprocin'];
            $c_status = $_POST['c_status'];
            $dli = mysqli_query($connect_pro, "UPDATE formng_checkinside SET c_status = '$c_status' WHERE id = '$id'");

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
                            window.location = 'main.php?p=ip';
                        });
                    });
                </script>
        <?php
            }
        }
        ?>
    </div>
</div>