<div class="row">
    <div class="col-12">
        <h3>Update Plan</h3>
        <div class="separator"></div>
    </div>
</div>
<script src="<?= base_url('_assets/src/add/sweetalert2.all.min.js') ?>"></script>

<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6" style="margin-bottom: 0px; padding-bottom: 0px;">
                    <?php
                    $sql3 = mysqli_query($con_pro, "SELECT * from updated_plan order by tanggal asc limit 1");
                    $data3 = mysqli_fetch_array($sql3);
                    if (empty($data3)) {
                        $tgl_show = date('l, d-m-Y H:i:s');
                        $nama = "no one";
                    ?>
                        <label for="formFileSm" class="form-label"><i>Last update in : Not yet!</i></label>
                    <?php
                    } else {
                        $tgl_show = date('l, d-m-Y H:i:s', strtotime($data3['tanggal']));
                        $nama = $data3['nama'];
                    ?>
                        <label for="formFileSm" class="form-label"><i>Last update in : <?= $tgl_show ?> by <?= $nama ?></i></label>
                    <?php
                    }

                    ?>
                </div>
                <div class="col-6" style="margin-bottom: 0px; text-align: right;">
                    <label for="info" style="font-size: 11px; color: blue;  margin: 0px; margin-left: 5px;"><u><i><b><a href="#" onclick="all2o()">File format download here</a></b></i></u></label>
                    <!-- <button type="button" class="btn btn-outline-success btn-sm" onclick="all2o()">Export to Excel<i class="fa fa-file-excel-o" style="font-size: 25px; margin-left: 5px;"></i></button> -->

                </div>
            </div>
            <script>
                var myWindow;

                function all2o() {
                    myWindow = window.open("format.php", "_blank");
                    setTimeout(all2c, 2000)
                }

                function all2c() {
                    myWindow.close();
                }
            </script>
            <input style="border-radius: 5px;" name="filemhsw" class="form-control form-control-sm" id="formFileSm" type="file">
            <label for="info" style="font-size: 11px; color: red;"><i><b>Warning, last month's plan will be deleted!</b></i></label>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" name="submit" class="btn btn-success btn-sm">Upload</button>
        </div>
    </div>
</form>
<?php
if (isset($_POST['submit'])) {
    mysqli_query($con_pro, "DELETE from plan");
    // require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
    require('../../../../../_assets/src/add/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
    // require('spreadsheet-reader-master/SpreadsheetReader.php');
    require('../../../../../_assets/src/add/spreadsheet-reader-master/SpreadsheetReader.php');

    //upload data excel kedalam folder uploads
    $target_dir = "update_plan/uploads/" . basename($_FILES['filemhsw']['name']);

    move_uploaded_file($_FILES['filemhsw']['tmp_name'], $target_dir);

    $Reader = new SpreadsheetReader($target_dir);

    foreach ($Reader as $Key => $Row) {
        // import data excel mulai baris ke-2 (karena ada header pada baris 1)
        if ($Key < 1) continue;
        // isi common
        $sql4 = mysqli_query($con_pro, "SELECT phb from antar_wc where u700 = '" . $Row[2] . "'");
        $data4 = mysqli_fetch_array($sql4);
        $query = mysqli_query($con_pro, "INSERT INTO plan VALUES ('" . $Row[0] . "', '" . $Row[1] . "','" . $Row[2] . "','" . $Row[3] . "','" . $Row[4] . "','" . $Row[5] . "','$data4[phb]')");
    }
    if ($query) {
        // input pengupdate
        $sql2 = mysqli_query($con_pro, "SELECT * from updated_plan");
        $data2 = mysqli_fetch_array($sql2);

        if (empty($data2)) {
            mysqli_query($con_pro, "INSERT INTO updated_plan set id = '$_SESSION[id]', nama = '$_SESSION[nama]', tanggal = '$now'");
        } else {
            mysqli_query($con_pro, "UPDATE updated_plan set tanggal = '$now' where id = '$_SESSION[id]'");
        }


?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Success',
                    text: 'Berhasil slurd!',
                    type: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'main.php?p=help';
                });
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Gagal slurd!',
                    type: 'danger',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'main.php?p=help';
                });
            });
        </script>
    <?php
    }
    ?>
    <!-- <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Data Not Found',
                text: 'Slip number unregistered!',
                type: 'warning',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = 'main.php?p=help';
            });
        });
    </script> -->
<?php
}
?>
<div class="separator"></div>
<!-- <div class="row">
    <div class="col-12 tableFixHead-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>plan Number</th>
                    <th>FG Code</th>
                    <th>Model</th>
                    <th>Color</th>
                    <th>Destination</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = mysqli_query($con_pro, "SELECT * from plan order by tanggal asc");
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <td><?= $data['pln_no'] ?></td>
                        <td><?= $data['fg_code'] ?></td>
                        <td><?= $data['model'] ?></td>
                        <td><?= $data['color'] ?></td>
                        <td><?= $data['destin'] ?></td>
                        <td><?= $data['tanggal'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div> -->

<div class="row">
    <div class="col-12">
        <div class="x_content">
            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Summary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Detail</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active tableFixHead-3" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center ;">
                                <th style="width: 30%; ;">Date</th>
                                <th style="width: 30%;">Plan</th>
                                <th style="width: 30%;">Countdown Plan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // menghitung all plan
                            $sql7 = mysqli_query($con_pro, "SELECT count(tanggal) as semuaplan from plan");
                            $data7 = mysqli_fetch_array($sql7);
                            $semua = $data7['semuaplan'];

                            $sql5 = mysqli_query($con_pro, " SELECT distinct tanggal from plan order by tanggal asc");
                            while ($data5 = mysqli_fetch_array($sql5)) {
                                $sql6 = mysqli_query($con_pro, "SELECT count(tanggal) as toplan from plan where tanggal = '$data5[tanggal]'");
                                $data6 = mysqli_fetch_array($sql6);
                            ?>
                                <tr>
                                    <td><?= $data5['tanggal'] ?></td>
                                    <td style="text-align: center ;"><?= $data6['toplan'] ?></td>
                                    <td style="text-align: center;"><?= $semua ?></td>
                                </tr>
                            <?php
                                $semua = $semua - $data6['toplan'];
                            }
                            ?>
                        </tbody>
                    </table>

                </div>

                <div class="tab-pane fade tableFixHead-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>plan Number</th>
                                <th>FG Code</th>
                                <th>Model</th>
                                <th>Color</th>
                                <th>Destination</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = mysqli_query($con_pro, "SELECT * from plan order by tanggal asc");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <tr>
                                    <td><?= $data['pln_no'] ?></td>
                                    <td><?= $data['fg_code'] ?></td>
                                    <td><?= $data['model'] ?></td>
                                    <td><?= $data['color'] ?></td>
                                    <td><?= $data['destin'] ?></td>
                                    <td><?= $data['tanggal'] ?></td>
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