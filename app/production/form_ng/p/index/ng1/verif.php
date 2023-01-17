<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <?php
    $inspec_in = date('l, d M Y', strtotime($now));
    $ngin = array();
    $i = 0;
    $sql1 = mysqli_query($connect_pro, "SELECT c_ng FROM formng_listng WHERE c_area = 'inside' ORDER BY c_ng asc");
    while ($data1 = mysqli_fetch_array($sql1)) {
        $ngin[$i] = $data1['c_ng'];
        $i++;
    }
    ?>

    <?php
    $dver_sql = mysqli_query($connect_pro, "SELECT c_inspectiondate  FROM formng_resulti WHERE c_serialnumber = '$_SESSION[serialnumber_inside]' ORDER BY id asc limit 1 ");
    $dver = mysqli_fetch_array($dver_sql);
    if (empty($dver['c_inspectiondate'])) {
        $tanggal = date('l, d M Y', strtotime($now));
    } else {
        $tanggal = $dver['c_inspectiondate'];
        $tanggal = date('l, d M Y', strtotime($tanggal));
    }
    ?>
    <div class="row">
        <div class="col-12">
            <h3>Inside Check Data</h3>
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
                                <div class="col-md-12" style="text-align: center;">
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
                                <div class="col-md-12" style="text-align: center;">
                                    <?= $tanggal ?>
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
                                    Inside Check
                                </div>
                            </di>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="5" colspan="2"></td>
                        <td colspan="2" style="height: 60px;">
                            <?php
                            $sql5 = mysqli_query($connect_pro, "SELECT COUNT(c_status) as jumng, c_inspectiondate FROM formng_resulti WHERE c_serialnumber = '$_SESSION[serialnumber_inside]' AND c_status = 'NG'");
                            $data5 = mysqli_fetch_array($sql5);

                            if ($data5['jumng'] > 0) {
                                $inngdate = $data5['c_inspectiondate'];
                                $inngdate = date('d-m-Y', strtotime($inngdate));
                            ?>
                                <div class="containere">
                                    <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #B92C3A; ">QC REJECTED</button>
                                </div>
                            <?php
                            } else {
                                $inngdate = '';
                            }
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 0px; height: 20px;">
                            <div class="row">
                                <div class="col-3">
                                    Date :
                                </div>
                                <div class="col-8">
                                    <?= $inngdate ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 60px;">
                            <?php
                            $sql4 = mysqli_query($connect_pro, "SELECT c_finishincheck FROM formng_register WHERE c_serialnumber = '$_SESSION[serialnumber_inside]'");
                            $data4 = mysqli_fetch_array($sql4);

                            if (!empty($data4['c_finishincheck'])) {
                                $inokdate = $data4['c_finishincheck'];
                                $inokdate = date('d-m-Y', strtotime($inokdate));
                            ?>
                                <div class="containere">
                                    <button class="bton retro" style="width: 200px; border-radius: 0px; rotate: -3deg; font-size: 25px; opacity: 90%; top: 14px; left: 50%; background-color: #358809; ">QC PASSED</button>
                                </div>
                            <?php
                            } else {
                                $inokdate = '';
                            }
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 0px; height: 20px;">
                            <div class="row">
                                <div class="col-3">
                                    Date :
                                </div>
                                <div class="col-8">
                                    <?= $inokdate ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; font-weight: bold;">
                            <?php
                            $sql6 = mysqli_query($connect_pro, "SELECT c_checker FROM formng_resulti WHERE c_serialnumber = '$_SESSION[serialnumber_inside]' limit 1");
                            $data6 = mysqli_fetch_array($sql6);

                            echo $data6['c_checker'];
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead style="text-align: center;">
                    <th style="width: 5%;">No</th>
                    <th>Item</th>
                    <th style="width: 20%;">Hasil Cek</th>
                    <th style="width: 20%;">Hasil Repair</th>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $ng = 0;
                    $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resulti WHERE c_serialnumber = '$_SESSION[serialnumber_inside]' ORDER BY id asc");
                    while ($data2 = mysqli_fetch_array($sql2)) {

                        // pemberian warna background tr
                        $i++;
                        if ($i % 2 == 0) {
                            $br = 'style = "background-color: #F2F2F2;"';
                        } else {
                            $br = '';
                        }

                        $sql3 = mysqli_query($connect_pro, "SELECT c_item FROM formng_checkinside WHERE c_code = '$data2[c_item]'");
                        $data3 = mysqli_fetch_array($sql3);

                        if ($data2['c_status'] == 'NG') {
                            $ng++;
                    ?>

                            <!-- baris n -->
                            <tr <?= $br ?>>
                                <td style="text-align: center;" rowspan="2"><?= $i ?></td>
                                <td rowspan="2"><?= $data3['c_item'] ?></td>
                                <td colspan="2" style="text-align: center;"><?= $data2['c_detail'] ?></td>
                            </tr>
                            <tr <?= $br ?>>

                                <td style="padding: 2px;">
                                    <table class="table table-bordered" style="border-color: #B50303;">
                                        <tr>
                                            <td style="padding: 0px; background-color: #B50303;">
                                                <h3 class="retro" style=" text-align: center; color: #fff; rotate: -5deg;">QC REJECTED</h3>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 0px; text-align: center;">
                                                <?= $data2['c_checker'] ?>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td style="padding: 0px; text-align: center;">
                                                <?= date('d-m-Y', strtotime($data2['c_inspectiondate'])) ?>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                                <?php
                                if ($data2['c_repair'] == '') {
                                ?>
                                    <td style="padding: 2px;">
                                    </td>
                                <?php
                                } else {
                                    $ng--;
                                ?>
                                    <td style="padding: 2px;">
                                        <table class="table table-bordered" style="border-color: #CF9502;">
                                            <tr>
                                                <td style="padding: 0px; background-color: #CF9502;">
                                                    <h3 class="retro" style=" text-align: center; color: #fff; rotate: -5deg;">REPAIRED</h3>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 0px; text-align: center;">
                                                    <?= $data2['c_repair'] ?>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td style="padding: 0px; text-align: center;">
                                                    <?= date('d-m-Y', strtotime($data2['c_repairdate'])) ?>
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                            <!-- baris n -->
                        <?php
                        } else {
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $i ?></td>
                                <td><?= $data3['c_item'] ?></td>
                                <td colspan="2" style="padding: 2px;">
                                    <table class="table table-bordered" style="border-color: #358809;">
                                        <tr>
                                            <td style="padding: 0px; background-color: #358809;">
                                                <h3 class="retro" style=" text-align: center; color: #fff; rotate: -5deg;">QC PASSED</h3>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 0px; text-align: center;">
                                                <?= $data2['c_checker'] ?>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td style="padding: 0px; text-align: center;">
                                                <?= date('d-m-Y', strtotime($data2['c_inspectiondate'])) ?>
                                            </td>
                                        </tr>

                                    </table>
                                </td>

                            </tr>
                    <?php
                        }
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>

    <form method="post">

        <?php

        $s1 = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_serialnumber = '$_SESSION[serialnumber_inside]'");
        $d1 = mysqli_fetch_array($s1);

        if (empty($d1['c_finishincheck'])) {
            if ($ng > 0) {
                $send_dis = "disabled";
            } else {
                $send_dis = "";
            }
        ?>
            <div class="row">
                <div class="col-12">
                    <input required name="agree" value="agree" type="checkbox"> Saya yakin piano <b><?= $_SESSION['pianoname_inside'] ?></b> sudah dilakukan repair dengan semestinya
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <button <?= $send_dis ?> type="submit" name="verif" class="btn btn-success">Send to Outside Check</button>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <button disabled type="submit" name="verif" class="btn btn-success">Data has been sent</button>
                </div>
            </div>
        <?php
        }


        ?>
    </form>

    <?php
    if (isset($_POST['verif'])) {
        $stempeldate = date('Y-m-d H:i:s', strtotime($now));
        $sql1 = mysqli_query($connect_pro, "UPDATE formng_register SET c_finishincheck = '$stempeldate', c_incheckby = '$_SESSION[nama]' WHERE c_serialnumber = '$_SESSION[serialnumber_inside]'");
        if ($sql1) {
    ?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Success',
                        html: 'Piano <br><b><?= $_SESSION['pianoname_inside'] ?></b><br> has been sent to Outside Check 1 !',
                        type: 'success',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                        // timer: 2000,
                        // showCancelButton: false,
                        // showConfirmButton: false
                    }).then(function() {
                        // disini diarahkan ke halaman print dulu baru unset session dan balik ke halaman index
                        <?php
                        // unset($_SESSION['cardnumber']);
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