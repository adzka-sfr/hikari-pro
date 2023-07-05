<div class="row">
    <div class="col-12" style="margin-top: 10px;">
        <h5>Inside</h5>
    </div>
</div>

<div class="row">
    <div class="col-6" style="max-height: 500px;">
        <script>
            $(document).ready(function() {
                $('#cus_ng_in').DataTable({
                    paging: false,
                    scrollY: '350px',
                    scrollCollapse: true,
                    "dom": '<"wrapper"flipt>'
                });
            });
        </script>
        <table id="cus_ng_in" class="table table-bordered">
            <thead style="text-align: center;">
                <th>Process Inside</th>
                <th>NG</th>
            </thead>
            <tbody>
                <?php
                $no  = 0;
                $sql = mysqli_query($connect_pro, "SELECT fii.c_ng, fii.c_status, fci.c_item FROM formng_itemnginside fii JOIN formng_checkinside fci ON fii.c_code = fci.c_code");
                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                    if ($data['c_status'] == 'disabled') {
                ?>
                        <tr style="background-color: #E2E3E5;">
                            <td><s><?= $data['c_item'] ?></s></td>
                            <td><s><?= $data['c_ng'] ?></s></td>
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr>
                            <td><?= $data['c_item'] ?></td>
                            <td><?= $data['c_ng'] ?></td>
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
                <h5>Add NG Inside</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <select class="cari_basic" style="width: 100% " required name="adpro">
                        <option></option>
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT c_code, c_item FROM formng_checkinside");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['c_code'] ?>"><?= $data['c_item'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="form-floating">
                        <textarea class="form-control" name="ngin" placeholder="Type NG here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Type NG here</label>
                    </div>
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
                    <button name="addin" class="btn btn-success" style="width: 100px;">Add</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['addin'])) {
            $c_code = $_POST['adpro'];
            $c_ng = $_POST['ngin'];
            $c_status = 'enable';
            $dli = mysqli_query($connect_pro, "INSERT INTO formng_itemnginside SET c_code = '$c_code', c_ng = '$c_ng', c_status = '$c_status'");

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
                <div class="col-12 mb-2">
                    <script type="text/javascript">
                        function searchmodel2() {
                            var isiap = $("select[name='proc']").val();
                            $.ajax({
                                url: "customize-ng/dropdown.php",
                                method: "POST",
                                data: {
                                    isiap: isiap
                                },
                                success: function(data) {
                                    $('#dropproses').prop('disabled', false);
                                    $('#dropproses').html(data);
                                }
                            });
                        }
                    </script>
                    <select class="cari_proses" id="proc" name="proc" style="width: 100% " required onchange="searchmodel2()">
                        <option disabled selected value="">Select model from below</option>
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT c_item, c_code FROM formng_checkinside order by c_code asc");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['c_code'] ?>"><?= $data['c_item'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-2">
                    <select disabled class="cari_proses" id="dropproses" style="width: 100% " required name="dropproses">
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
                    <button name="updatein" class="btn btn-primary" style="width: 100px;">Update</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['updatein'])) {
            $id = $_POST['dropproses'];
            $c_status = $_POST['c_status'];
            $dli = mysqli_query($connect_pro, "UPDATE formng_itemnginside SET c_status = '$c_status' WHERE id = '$id'");

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