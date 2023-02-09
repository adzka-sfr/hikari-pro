<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <?php
    $repair_in = date('l, d M Y', strtotime($now));
    $ngin = array();
    $i = 0;
    $sql1 = mysqli_query($connect_pro, "SELECT c_ng FROM formng_listng WHERE c_area = 'inside' ORDER BY c_ng asc");
    while ($data1 = mysqli_fetch_array($sql1)) {
        $ngin[$i] = $data1['c_ng'];
        $i++;
    }
    ?>
    <?php
    if (empty($_SESSION['note2'])) {
    ?>
        <script>
            (async () => {
                const {
                    value: text
                } = await Swal.fire({
                    input: 'textarea',
                    title: 'Apakah ada catatan dari repair?',
                    inputPlaceholder: 'Contoh : Fall Board ganti, Fall Center ganti, dll',
                    inputAttributes: {
                        'aria-label': 'Type your message here'
                    },
                    showCancelButton: true,
                    allowOutsideClick: false,
                    cancelButtonText: 'Close',
                    confirmButtonText: 'Save'
                })

                if (text) {
                    $.ajax({
                        url: "note.php",
                        type: "POST",
                        data: {
                            note: text
                        },
                        cache: false,
                        success: function(dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                Swal.fire({
                                    title: 'Success',
                                    html: 'Catatan sudah di rekam !',
                                    type: 'success',
                                    confirmButtonText: 'Ok',
                                    allowOutsideClick: false
                                });
                            }

                        }
                    });
                }
            })()
        </script>
    <?php
        $_SESSION['note2'] = 'isi';
    }
    ?>

    <div class="row">
        <div class="col-12">
            <h3>Completeness Check 2</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="vertical-align:top;padding-top:0px; width: 10%;">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 5px;">
                                    No Seri :
                                </div>
                            </div>
                            <di class="row">
                                <div class="col-md-12" style="text-align: center;">
                                    <?= $_SESSION['serialnumber_outside2'] ?>
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
                                <div class="col-md-12" style="text-align: center;">
                                    <?= $_SESSION['pianoname_outside2'] ?>
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
                                <div class="col-md-12" style="text-align: center;">
                                    <?= date('l, d M Y', strtotime($now)) ?>
                                </div>
                            </di>
                        </th>
                        <th style="vertical-align:top;padding-top:0px; width: 15%;">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 5px;">
                                    Process :
                                </div>
                            </div>
                            <di class="row">
                                <div class="col-md-12" style="text-align: center;">
                                    Completeness 2
                                </div>
                            </di>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <form method="post">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                        <th style="width: 5%;">No</th>
                        <th>Part Name</th>
                        <th style="width: 10%;">Check 1</th>
                        <th style="width: 10%;">Check 2</th>
                        <th style="width: 10%;">Check 3</th>
                    </thead>
                    <tbody style="font-size: 18px;">
                        <?php
                        $i = 0;
                        $ng = 0;
                        $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resultc WHERE c_serialnumber = '$_SESSION[serialnumber_outside2]' ORDER BY id asc");
                        while ($data2 = mysqli_fetch_array($sql2)) {

                            if ($data2['c_result1'] == 'NO') {
                                $check = '';
                            } else {
                                $check = 'checked';
                            }

                            // pemberian warna background tr
                            $i++;
                            if ($i % 2 == 0) {
                                $br = 'style = "background-color: #F2F2F2;"';
                            } else {
                                $br = '';
                            }
                        ?>

                            <!-- baris n -->
                            <tr <?= $br ?>>
                                <td style="text-align: center;"><?= $i ?></td>
                                <td><?= $data2['c_partname'] ?></td>
                                <td style="text-align: center;">
                                    <div class="checkbox">
                                        <label>
                                            <input <?= $check ?> disabled type="checkbox" style="transform: scale(2); margin: 10px; vertical-align:top;padding-top:70px;">
                                        </label>
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" name="prt<?= $i ?>" value="<?= $data2['c_partname'] ?>">
                                            <input type="hidden" name="ccd<?= $i ?>" value="<?= $data2['c_code'] ?>">
                                            <input name="ck<?= $i ?>" value="checked" type="checkbox" style="transform: scale(2); margin: 10px; vertical-align:top;padding-top:70px;">
                                        </label>
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <div class="checkbox">
                                        <label>
                                            <input disabled type="checkbox" style="transform: scale(2); margin: 10px; vertical-align:top;padding-top:70px;">
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <input required name="agree" value="agree" type="checkbox"> Saya yakin data <b>Completeness Part</b> sudah sesuai dengan kondisi aktual
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <button type="submit" name="verif" class="btn btn-success">Submit, and go to Outside Check</button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['verif'])) {
        $c_serialnumber = $_SESSION['serialnumber_outside2'];
        $c_pianoname = $_SESSION['pianoname_outside2'];
        for ($in = 1; $in <= $i; $in++) {
            $c_partname = $_POST['prt' . $in];
            $c_code = $_POST['ccd' . $in];

            if (!empty($_POST['ck' . $in])) {
                $c_result1 = 'OK';
            } else {
                $c_result1 = 'NO';
            }

            $c_inspectiondate1 = date('Y-m-d H:i:s', strtotime($now));
            $c_checker1 = $_SESSION['nama'];

            $sql1 = mysqli_query($connect_pro, "UPDATE formng_resultc SET c_result2 = '$c_result1', c_inspectiondate2 = '$c_inspectiondate1', c_checker2 = '$c_checker1' WHERE c_serialnumber = '$c_serialnumber' AND c_code = '$c_code'");
        }
        if ($sql1) {
            $c_finishcomplete1 = date('Y-m-d H:s:i', strtotime($now));
            $c_complete1by = $_SESSION['nama'];
            mysqli_query($connect_pro, "UPDATE formng_register SET c_finishcomplete2 = '$c_finishcomplete1' , c_complete2by = '$c_complete1by' WHERE c_serialnumber = '$c_serialnumber'");
    ?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Success',
                        html: 'Input data completeness for <br><b><?= $_SESSION['pianoname_outside2'] ?></b><br> has been recorded !',
                        type: 'success',
                        confirmButtonText: 'Ok',
                        allowOutsideClick: true
                        // timer: 2000,
                        // showCancelButton: false,
                        // showConfirmButton: false
                    }).then(function() {
                        <?php $_SESSION['queue'] = 'tbo'; ?>
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