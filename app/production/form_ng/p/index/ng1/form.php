<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">
    <form method="post">
        <?php
        $inspec_in = date('l, d M Y', strtotime($now));
        $ngin = array();
        $i = 0;
        ?>

        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="vertical-align:top;padding-top:0px; width: 25%;">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 5px;">
                                        No Seri :
                                    </div>
                                </div>
                                <di class="row">
                                    <div class="col-md-12" style="text-align: center; font-size: 15px;">
                                        <?= $_SESSION['serialnumber_inside'] ?>
                                    </div>
                                </di>
                            </th>
                            <th style="vertical-align:top;padding-top:0px">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 5px;">
                                        Model :
                                    </div>
                                </div>
                                <di class="row">
                                    <div class="col-md-12" style="text-align: center; font-size: 15px;">
                                        <?= $_SESSION['pianoname_inside'] ?>
                                    </div>
                                </di>
                            </th>
                            <th style="vertical-align:top;padding-top:0px; width: 25%;">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 5px;">
                                        Inspection Date :
                                    </div>
                                </div>
                                <di class="row">
                                    <div class="col-md-12" style="text-align: center; font-size: 15px;">
                                        <?= date('l, d M Y', strtotime($now)) ?>
                                    </div>
                                </di>
                            </th>
                            <!-- <th style="vertical-align:top;padding-top:0px; width: 15%;">
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 5px;">
                                        Process :
                                    </div>
                                </div>
                                <di class="row">
                                    <div class="col-md-12" style="text-align: center;">
                                        Inside Check
                                    </div>
                                </di>
                            </th> -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                        <th style="width: 5%;">No</th>
                        <th style="width: 40%;">Item</th>
                        <th style="width: 55%;" colspan="3">Hasil Cek</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_checkinside WHERE c_status = 'enable' ORDER BY id asc");
                        while ($data2 = mysqli_fetch_array($sql2)) {

                            // pemberian warna background tr
                            $i++;
                            if ($i % 2 == 0) {
                                $br = 'style = "background-color: #DEDEDE;"';
                            } else {
                                $br = '';
                            }
                        ?>
                            <!-- baris n -->
                            <tr <?= $br ?>>
                                <td rowspan="2" style="text-align: center; font-size: 15px;"><?= $i ?></td>
                                <td rowspan="2" style="font-size: 15px;"><?= $data2['c_item'] ?></td>
                                <input type="hidden" name="process_inside<?= $i ?>" value="<?= $data2['c_code'] ?>">
                                <td style=" vertical-align:top;padding-top:15px; text-align: center; background-color: #82DE82 ;">
                                    OK
                                </td>
                                <td colspan="2">
                                    <input type="radio" class="radioku<?= $i ?>" style="transform: scale(2); margin: 10px;" name="inside<?= $i ?>" value="OK" />
                                </td>
                            </tr>
                            <tr <?= $br ?>>
                                <td style=" vertical-align:top;padding-top:15px; text-align: center; background-color: #DE8282 ;">
                                    NG
                                </td>
                                <td>
                                    <input type="radio" class="radioku<?= $i ?> ng<?= $i ?>" style="transform: scale(2); margin: 10px;" name="inside<?= $i ?>" value="NG" />
                                </td>
                                <td>
                                    <select class="halodecktot" style="width: 95%;" id="duar<?= $i ?>" multiple="multiple" disabled required name="jenis<?= $i ?>[]">
                                        <option></option>
                                        <?php
                                        $sql3 = mysqli_query($connect_pro, "SELECT c_ng FROM formng_itemnginside WHERE c_code = '$data2[c_code]'");
                                        while ($data3 = mysqli_fetch_array($sql3)) {
                                        ?>
                                            <option value="<?= $data3['c_ng'] ?>"><?= $data3['c_ng'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <script>
                                        $('.radioku<?= $i ?>').change(function() {
                                            $('#duar<?= $i ?>').prop('disabled', !$(this).is('.ng<?= $i ?>'));
                                        });
                                    </script>
                                </td>
                            </tr>
                            <!-- baris n -->
                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <blink>
                    <h6 style=" color:red;">Pastikan kembali untuk point 23, 35, dan 36!</h6>
                </blink>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3">
                <label for="catatan">
                    <h5>Note :</h5>
                </label>
                <textarea class="form-control" name="catatan" rows="3"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <input required name="agree" value="agree" type="checkbox"> Saya yakin piano <b><?= $_SESSION['pianoname_inside'] ?> ( <u style="color: red;"><?= $_SESSION['serialnumber_inside'] ?></u> )</b> sudah sesuai dengan kondisi aktual
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <button type="submit" name="verif" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['verif'])) {
        for ($in = 1; $in <= $i; $in++) {
            $c_serialnumber = $_SESSION['serialnumber_inside'];
            $c_pianoname = $_SESSION['pianoname_inside'];
            $c_item = $_POST['process_inside' . $in];
            $c_inspectiondate = date('Y-m-d H:i:s', strtotime($now));
            $c_checker = $_SESSION['nama'];

            if (!empty($_POST['inside' . $in])) {
                $c_status = $_POST['inside' . $in];
                if ($_POST['inside' . $in] == 'OK') {
                    $c_detail = 'ok';

                    $sql1 = mysqli_query($connect_pro, "INSERT INTO formng_resulti SET c_serialnumber = '$c_serialnumber', c_pianoname = '$c_pianoname', c_item = '$c_item', c_status = '$c_status', c_detail = '$c_detail', c_inspectiondate = '$c_inspectiondate', c_checker = '$c_checker'");
                } else {
                    foreach ($_POST['jenis' . $in] as $value) {
                        $sql1 = mysqli_query($connect_pro, "INSERT INTO formng_resulti SET c_serialnumber = '$c_serialnumber', c_pianoname = '$c_pianoname', c_item = '$c_item', c_status = '$c_status', c_detail = '$value', c_inspectiondate = '$c_inspectiondate', c_checker = '$c_checker'");
                    }
                }
            } else {
                $c_status = 'OK';
                $c_detail = 'ok';

                $sql1 = mysqli_query($connect_pro, "INSERT INTO formng_resulti SET c_serialnumber = '$c_serialnumber', c_pianoname = '$c_pianoname', c_item = '$c_item', c_status = '$c_status', c_detail = '$c_detail', c_inspectiondate = '$c_inspectiondate', c_checker = '$c_checker'");
            }
        }
        // hapus item yang tidak pakai
        $ppp = mysqli_query($connect_pro, "DELETE FROM formng_resulti WHERE c_serialnumber = '$c_serialnumber' AND c_detail = 'Tidak pakai'");
        if ($sql1) {
            // update register untuk mengisi note incheck
            if (!empty($_POST['catatan'])) {
                mysqli_query($connect_pro, "UPDATE formng_register SET c_noteincheck = '$_POST[catatan]' WHERE c_serialnumber = '$_SESSION[serialnumber_inside]'");
            }
    ?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Good Job',
                        html: 'Inside check for <br><b><?= $_SESSION['pianoname_inside'] ?></b><br> has been recorded !',
                        type: 'success',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                        // timer: 2000,
                        // showCancelButton: false,
                        // showConfirmButton: false
                    }).then(function() {
                        // disini diarahkan ke halaman print dulu baru unset session dan balik ke halaman index
                        <?php
                        unset($_SESSION['cardnumber']);
                        ?>
                        window.location = 'index.php';
                    });
                });
            </script>
    <?php
        }
    }
    ?>
</div>
<!-- isi hasil scan slip number -->