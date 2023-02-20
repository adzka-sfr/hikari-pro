<br>
<div class="row">
    <div class="col-7 ">
        <div class="row">
            <div class="col-12 mb-3">
                <script type="text/javascript">
                    function searchmodel() {
                        var isia = $("select[name='idprofur']").val();
                        $.ajax({
                            url: "customize-cp/table.php",
                            method: "POST",
                            data: {
                                isia: isia
                            },
                            success: function(data) {
                                $('#Container1').html(data);
                            }
                        });
                    }
                </script>
                <style>
                    .xixi {
                        font-size: medium;
                        width: 100%;
                        height: 30px;
                        text-align: left;
                        border-color: #888888;
                        color: #888888;
                        border-radius: 4px;

                    }
                </style>
                <select class="cari_basic" id="refres1" style="width: 100% " required name="idprofur" onchange="searchmodel()">
                    <option disabled selected value="">Select model from below</option>
                    <?php
                    $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_type FROM formng_checkcomplete WHERE c_group = 'p' order by c_type asc");
                    while ($data = mysqli_fetch_array($sql)) {
                        $label = substr($data['c_type'], 2);
                    ?>
                        <option value="<?= $data['c_type'] ?>"><?= $label ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 tableFixHead-4">
                <div id="Container1">
                    <?php include "customize-cp/table.php" ?>
                </div>
            </div>
        </div>
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
                <div class="col-12 mb-3">
                    <select class="cari_model" style="width: 100% " required name="modelf">
                        <option disabled selected value="">Select model from below</option>
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_type FROM formng_checkcomplete WHERE c_group = 'p' order by c_type asc");
                        while ($data = mysqli_fetch_array($sql)) {
                            $label = substr($data['c_type'], 2);
                        ?>
                            <option value="<?= $data['c_type'] ?>"><?= $label ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" name="profur" placeholder="Type process here" id="floatingTextarea"></textarea>
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
                    <button name="addprofur" class="btn btn-success" style="width: 100px;">Add</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['addprofur'])) {
            $c_partname = $_POST['profur'];
            $c_group = 'p';
            $c_type = $_POST['modelf'];
            $c_code_lama = 'fur';
            $c_status = 'enable';

            $dli = mysqli_query($connect_pro, "INSERT INTO formng_checkcomplete SET c_partname = '$c_partname', c_group = '$c_group', c_type = '$c_type', c_code = '$c_code_lama', c_status= '$c_status'");

            $sql1 = mysqli_query($connect_pro, "SELECT MAX(id) as maks FROM formng_checkcomplete");
            $data1 = mysqli_fetch_array($sql1);
            $c_code = $c_type . "-" . $data1['maks'];

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
            <div class="col-12  mt-3">
                <h5>Enable/Disabled Completeness Process (Polyester)</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12 mb-2">
                    <script type="text/javascript">
                        function searchmodel2() {
                            var isiap = $("select[name='dropf']").val();
                            $.ajax({
                                url: "customize-cp/dropdown.php",
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
                    <style>
                        .xixi {
                            font-size: medium;
                            width: 100%;
                            height: 30px;
                            text-align: left;
                            border-color: #888888;
                            color: #888888;
                            border-radius: 4px;

                        }
                    </style>
                    <select class="cari_model" id="dropf" style="width: 100% " required name="dropf" onchange="searchmodel2()">
                        <option disabled selected value="">Select model from below</option>
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_type FROM formng_checkcomplete WHERE c_group = 'p' order by c_type asc");
                        while ($data = mysqli_fetch_array($sql)) {
                            $label = substr($data['c_type'], 2);
                        ?>
                            <option value="<?= $data['c_type'] ?>"><?= $label ?></option>
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
                    <button name="updateprofur" class="btn btn-primary" style="width: 100px;">Update</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['updateprofur'])) {
            $id = $_POST['dropproses'];
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