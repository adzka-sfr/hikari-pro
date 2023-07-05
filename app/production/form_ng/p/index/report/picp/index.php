<div class="row">
    <div class="col-8 tableFixHead-4">
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width:13%;">ID</th>
                <th>Name</th>
                <th style="width:13%;">Inside</th>
                <th style="width:13%;">Outside 1</th>
                <th style="width:13%;">Outside 2</th>
                <th style="width:13%;">Outside 3</th>
            </thead>
            <tbody>
                <?php
                $sql = mysqli_query($connect, "SELECT * FROM auth WHERE role = 'pic check'");
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $data['id'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td style="text-align: center;">
                            <?php
                            $sql1 = mysqli_query($connect, "SELECT num FROM t_previlege WHERE c_id = '$data[id]' AND c_name = 'Inside Check'");
                            $data1 = mysqli_fetch_array($sql1);

                            if (!empty($data1['num'])) {
                            ?>
                                <img style="height: 20px;" src="<?= base_url('_assets/production/icons/parts/check.png') ?>" alt="YES">
                            <?php
                            } else {
                            ?>
                                <img style="height: 20px;" src="<?= base_url('_assets/production/icons/parts/cross.png') ?>" alt="NO">
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <?php
                            $sql1 = mysqli_query($connect, "SELECT num FROM t_previlege WHERE c_id = '$data[id]' AND c_name = 'Outside Check 1'");
                            $data1 = mysqli_fetch_array($sql1);

                            if (!empty($data1['num'])) {
                            ?>
                                <img style="height: 20px;" src="<?= base_url('_assets/production/icons/parts/check.png') ?>" alt="YES">
                            <?php
                            } else {
                            ?>
                                <img style="height: 20px;" src="<?= base_url('_assets/production/icons/parts/cross.png') ?>" alt="NO">
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <?php
                            $sql1 = mysqli_query($connect, "SELECT num FROM t_previlege WHERE c_id = '$data[id]' AND c_name = 'Outside Check 2'");
                            $data1 = mysqli_fetch_array($sql1);

                            if (!empty($data1['num'])) {
                            ?>
                                <img style="height: 20px;" src="<?= base_url('_assets/production/icons/parts/check.png') ?>" alt="YES">
                            <?php
                            } else {
                            ?>
                                <img style="height: 20px;" src="<?= base_url('_assets/production/icons/parts/cross.png') ?>" alt="NO">
                            <?php
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <?php
                            $sql1 = mysqli_query($connect, "SELECT num FROM t_previlege WHERE c_id = '$data[id]' AND c_name = 'Outside Check 3'");
                            $data1 = mysqli_fetch_array($sql1);

                            if (!empty($data1['num'])) {
                            ?>
                                <img style="height: 20px;" src="<?= base_url('_assets/production/icons/parts/check.png') ?>" alt="YES">
                            <?php
                            } else {
                            ?>
                                <img style="height: 20px;" src="<?= base_url('_assets/production/icons/parts/cross.png') ?>" alt="NO">
                            <?php
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
    <div class="col-4">
        <div class="row">
            <div class="col-12">
                <h5>Customize</h5>
                <hr>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-12">
                    <select class="cari_basic" style="width: 100% " required name="nama">
                        <option></option>
                        <?php
                        $sql = mysqli_query($connect, "SELECT * FROM auth WHERE role = 'pic check'");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
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
                            <input type="checkbox" name="in" style="transform: scale(1.5); margin: 10px;"> Inside Check
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="o1" style="transform: scale(1.5); margin: 10px;"> Outside Check 1
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="o2" style="transform: scale(1.5); margin: 10px;"> Outside Check 2
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="o3" style="transform: scale(1.5); margin: 10px;"> Outside Check 3
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <button name="update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['update'])) {
            $nik = $_POST['nama'];

            // inside
            if (!empty($_POST['in'])) {
                $app = 'Inside Check';
                $dir = 'production/form_ng/p/index/ng1';

                $sql = mysqli_query($connect, "SELECT num FROM t_previlege WHERE c_id = '$nik' AND c_name = '$app'");
                $data = mysqli_fetch_array($sql);

                if (empty($data['num'])) {
                    $idl = mysqli_query($connect, "INSERT INTO t_previlege SET c_id = '$nik', c_name = '$app', c_dir = '$dir', c_img = 'display', c_status = 'deploy'");
                }
            } else {
                $app = 'Inside Check';
                $dir = 'production/form_ng/p/index/ng1';
                $idl = mysqli_query($connect, "DELETE FROM t_previlege WHERE c_id = '$nik' AND c_name = '$app'");
            }

            // outside 1
            if (!empty($_POST['o1'])) {
                $app = 'Outside Check 1';
                $dir = 'production/form_ng/p/index/ng2';

                $sql = mysqli_query($connect, "SELECT num FROM t_previlege WHERE c_id = '$nik' AND c_name = '$app'");
                $data = mysqli_fetch_array($sql);

                if (empty($data['num'])) {
                    $idl = mysqli_query($connect, "INSERT INTO t_previlege SET c_id = '$nik', c_name = '$app', c_dir = '$dir', c_img = 'display', c_status = 'deploy'");
                }
            } else {
                $app = 'Outside Check 1';
                $dir = 'production/form_ng/p/index/ng2';
                $idl = mysqli_query($connect, "DELETE FROM t_previlege WHERE c_id = '$nik' AND c_name = '$app'");
            }

            // outside 2
            if (!empty($_POST['o2'])) {
                $app = 'Outside Check 2';
                $dir = 'production/form_ng/p/index/ng3';

                $sql = mysqli_query($connect, "SELECT num FROM t_previlege WHERE c_id = '$nik' AND c_name = '$app'");
                $data = mysqli_fetch_array($sql);

                if (empty($data['num'])) {
                    $idl = mysqli_query($connect, "INSERT INTO t_previlege SET c_id = '$nik', c_name = '$app', c_dir = '$dir', c_img = 'display', c_status = 'deploy'");
                }
            } else {
                $app = 'Outside Check 2';
                $dir = 'production/form_ng/p/index/ng3';
                $idl = mysqli_query($connect, "DELETE FROM t_previlege WHERE c_id = '$nik' AND c_name = '$app'");
            }

            // outside 3
            if (!empty($_POST['o3'])) {
                $app = 'Outside Check 3';
                $dir = 'production/form_ng/p/index/ng4';

                $sql = mysqli_query($connect, "SELECT num FROM t_previlege WHERE c_id = '$nik' AND c_name = '$app'");
                $data = mysqli_fetch_array($sql);

                if (empty($data['num'])) {
                    $idl = mysqli_query($connect, "INSERT INTO t_previlege SET c_id = '$nik', c_name = '$app', c_dir = '$dir', c_img = 'display', c_status = 'deploy'");
                }
            } else {
                $app = 'Outside Check 3';
                $dir = 'production/form_ng/p/index/ng4';
                $idl = mysqli_query($connect, "DELETE FROM t_previlege WHERE c_id = '$nik' AND c_name = '$app'");
            }

        ?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Success',
                        html: 'Data Updated !',
                        type: 'success',
                        confirmButtonText: 'Ok',
                        allowOutsideClick: true
                    }).then(function() {
                        window.location = 'main.php?p=picp';
                    });
                });
            </script>
        <?php
        }

        ?>
    </div>
</div>