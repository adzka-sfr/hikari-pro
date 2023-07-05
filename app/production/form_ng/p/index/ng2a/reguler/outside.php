<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                        <th style="width:5%"></th>
                        <th>Detail NG</th>
                    </thead>
                    <tbody>
                        <?php
                        // data cabinet
                        $jumlah_ng = 0;
                        // $cab_list = array();
                        // $nolist = 0;
                        // $cb_sql = mysqli_query($connect_pro, "SELECT * FROM formng_listcabinet WHERE c_status = 'enable'");
                        // while ($cb_data = mysqli_fetch_array($cb_sql)) {
                        //     $cab_list[$nolist] = $cb_data['c_name'];
                        //     $nolist++;
                        // }
                        // $count_cablist = count($cab_list);

                        $sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number'");
                        $data = mysqli_fetch_array($sql);
                        if (empty($data)) {
                            // kosong
                        ?>
                            <tr>
                                <td colspan="2" style="text-align: center;">No Data</td>
                            </tr>
                            <?php
                        } else {
                            // tidak kosong
                            $id = 0;
                            $sql = mysqli_query($connect_pro, "SELECT DISTINCT  c_cabinet FROM formng_resultong WHERE c_serialnumber = '$serial_number' ORDER BY c_cabinet ASC");
                            while ($data = mysqli_fetch_array($sql)) {
                                $id++;
                                $idbutton = $serial_number . $id;
                                // list ng aktif
                                $ng_active = array();
                                $nolist = 0;
                                $active_sql = mysqli_query($connect_pro, "SELECT c_ng, c_repaired, c_numberng, c_process FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_cabinet = '$data[c_cabinet]'");
                                while ($active_data = mysqli_fetch_array($active_sql)) {
                                    $ng_active[] = array($active_data['c_ng'], $active_data['c_repaired'], $active_data['c_numberng'], $active_data['c_process']);
                                    $nolist++;
                                }
                                $count_cabactive = count($ng_active);

                                // warna pena untuk nama ng
                                $merah_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_cabinet = '$data[c_cabinet]' AND c_process = 'oc1'");
                                $merah_data = mysqli_fetch_array($merah_sql);
                                if (!empty($merah_data)) {
                                    $warna_pen = '#DC4646';
                                } else {
                                    $hijau_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_cabinet = '$data[c_cabinet]' AND c_process = 'oc2'");
                                    $hijau_data = mysqli_fetch_array($hijau_sql);
                                    if (!empty($hijau_data)) {
                                        $warna_pen = '#5AA65A';
                                    } else {
                                        $biru_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_cabinet = '$data[c_cabinet]' AND c_process = 'oc3'");
                                        $biru_data = mysqli_fetch_array($biru_sql);
                                        if (!empty($biru_data)) {
                                            $warna_pen = '#1340FF';
                                        } else {
                                            $warna_pen = '#000000';
                                        }
                                    }
                                }
                                // $warna_pen = '#000000';
                            ?>
                                <!-- isi -->
                                <tr>
                                    <td rowspan="2" style="text-align: center;">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <i class="fa fa-circle"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="font-weight: bold; color: <?= $warna_pen ?>;">
                                        <div class="row">
                                            <div class="col-10"><?= $data['c_cabinet'] ?></div>
                                            <div class="col-2" style="text-align: right;">
                                                <form id="myform<?= $idbutton ?>">
                                                    <input type="hidden" name="serialnumber" value="<?= $serial_number ?>">
                                                    <input type="hidden" name="cabinet" value="<?= $data['c_cabinet'] ?>">
                                                    <input type="hidden" name="process" value="<?= $process ?>">
                                                </form>
                                                <?php
                                                // hitung sisa jumlah ng
                                                $disbutrep_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_cabinet = '$data[c_cabinet]' AND c_process = '$process'");
                                                $disbutrep_data = mysqli_fetch_array($disbutrep_sql);
                                                if (empty($disbutrep_data)) {
                                                    $disbutrep = 'disabled';
                                                } else {
                                                    $disbutrep_sql = mysqli_query($connect_pro, "SELECT c_repaired FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_cabinet = '$data[c_cabinet]' AND c_process = '$process'");
                                                    $disbutrep_data = mysqli_fetch_array($disbutrep_sql);
                                                    if ($disbutrep_data['c_repaired'] != '') {
                                                        $disbutrep = 'disabled';
                                                    } else {
                                                        $disbutrep = '';
                                                    }
                                                }
                                                ?>
                                                <button <?= $disbutrep ?> id="repair<?= $idbutton ?>" class="btn btn-sm btn-primary" style="margin:0px; padding-top: 5px;"><i class="fa fa-wrench"></i></button>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#repair<?= $idbutton ?>').click(function() {
                                                            Swal.fire({
                                                                title: 'Apakah anda yakin?',
                                                                html: "Kabinet <b><?= $data['c_cabinet'] ?></b> telah selesai direpair",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Iya!',
                                                                cancelButtonText: 'Batal'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    var isi = $('#myform<?= $idbutton ?>').serializeArray();
                                                                    $.ajax({
                                                                        type: 'POST',
                                                                        url: 'repair.php',
                                                                        data: isi,
                                                                        success: function(dataResult) {
                                                                            var dataResult = JSON.parse(dataResult);
                                                                            if (dataResult.statusCode == 200) {
                                                                                Swal.fire({
                                                                                    title: 'Berhasil!',
                                                                                    text: 'Data repair berhasil disimpan!',
                                                                                    icon: 'success',
                                                                                    timer: 2000,
                                                                                    showCancelButton: false,
                                                                                    showConfirmButton: false
                                                                                }).then(function() {
                                                                                    window.location = 'main.php?p=dash';
                                                                                });
                                                                            } else if (dataResult.statusCode == 201) {
                                                                                Swal.fire({
                                                                                    position: 'center',
                                                                                    icon: 'error',
                                                                                    title: 'Server bermasalah!',
                                                                                    showConfirmButton: false,
                                                                                    timer: 2000
                                                                                })
                                                                            }
                                                                        }
                                                                    });
                                                                }
                                                            })
                                                        })
                                                    })
                                                </script>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- <ul> -->

                                        <?php
                                        for ($a = 0; $a < $count_cabactive; $a++) {
                                            // warna pena untuk nama cabinet
                                            $c_ng = $ng_active[$a][0];
                                            $c_process = $ng_active[$a][3];
                                            if ($c_process == 'oc1') {
                                                $warna_pen = '#DC4646';
                                            } elseif ($c_process == 'oc2') {
                                                $warna_pen = '#5AA65A';
                                            } elseif ($c_process == 'oc3') {
                                                $warna_pen = '#1340FF';
                                            } else {
                                                $warna_pen = '#000000';
                                            }
                                        ?>

                                            <?php
                                            // cek sudah repair atau belum
                                            if ($ng_active[$a][1] != '') {
                                            ?>
                                                <div class="containere">
                                                    <button class="bton retro" style="width:100px; border-radius: 0px; font-size: 10px; opacity: 70%; top: 9px; left: 70%; background-color: <?= $warna_pen ?>; "><?= $ng_active[$a][1] ?></button>
                                                </div>
                                                <span style="color: <?= $warna_pen ?>;">
                                                    <strike>[<?= $ng_active[$a][2] ?>] <?= $ng_active[$a][0] ?></strike>
                                                </span><br>
                                            <?php
                                            } else {
                                                $jumlah_ng++;
                                            ?>
                                                <!-- <li style="color: <?= $warna_pen ?>;">
                                                            <?= $ng_active[$a][0] ?>
                                                        </li> -->
                                                <span style="color: <?= $warna_pen ?>;">
                                                    [<?= $ng_active[$a][2] ?>] <?= $ng_active[$a][0] ?>
                                                </span><br>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <!-- </ul> -->
                                    </td>
                                </tr>
                                <!-- isi -->
                        <?php
                            }
                        }

                        ?>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <form id="myformall">
                                    <input type="hidden" name="serialnumber" value="<?= $serial_number ?>">
                                    <input type="hidden" name="process" value="<?= $process ?>">
                                </form>
                                <?php
                                $disbutall_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_process = '$process' AND c_repairdate IS NULL");
                                $disbutall_data = mysqli_fetch_row($disbutall_sql);
                                if ($disbutall_data > 0) {
                                    $disbutall = '';
                                } else {
                                    $disbutall = 'disabled';
                                }
                                ?>
                                <button <?= $disbutall ?> id="repairall" class="btn btn-sm btn-primary" style="margin:0px; padding-top: 5px;">Repair Semuanya <i class="fa fa-wrench"></i></button>
                                <script>
                                    $(document).ready(function() {
                                        $('#repairall').click(function() {
                                            Swal.fire({
                                                title: 'Apakah anda yakin?',
                                                html: "<b>Semua kabinet</b> yang bermasalah telah selesai direpair",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Iya, repair semuanya!',
                                                cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    var isi = $('#myformall').serializeArray();
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'repair_all.php',
                                                        data: isi,
                                                        success: function(dataResult) {
                                                            var dataResult = JSON.parse(dataResult);
                                                            if (dataResult.statusCode == 200) {
                                                                Swal.fire({
                                                                    title: 'Berhasil!',
                                                                    text: 'Semua data repair berhasil disimpan!',
                                                                    icon: 'success',
                                                                    timer: 2000,
                                                                    showCancelButton: false,
                                                                    showConfirmButton: false
                                                                }).then(function() {
                                                                    window.location = 'main.php?p=dash';
                                                                });
                                                            } else if (dataResult.statusCode == 201) {
                                                                Swal.fire({
                                                                    position: 'center',
                                                                    icon: 'error',
                                                                    title: 'Server bermasalah!',
                                                                    showConfirmButton: false,
                                                                    timer: 2000
                                                                })
                                                            }
                                                        }
                                                    });
                                                }
                                            })
                                        })
                                    })
                                </script>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <br>
        <!-- gambar 1 info -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../image/reguler/tbo.jpg" style="width:100%; opacity: 60%;">
                    <?php
                    $c_section = 'ptbo';
                    $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial_number';");
                    while ($data = mysqli_fetch_array($sql)) {
                        $isi = array();
                        $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$data[c_code]'");
                        while ($data1 = mysqli_fetch_array($sql1)) {
                            $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                        }
                        $countisi = count($isi);
                    ?>
                        <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
                            <?php
                            for ($f = 0; $f < $countisi; $f++) {
                                if ($isi[$f][1] == 'oc1') {
                                    $pen = '#DC4646';
                                } elseif ($isi[$f][1] == 'oc2') {
                                    $pen = '#5AA65A';
                                } elseif ($isi[$f][1] == 'oc3') {
                                    $pen = '#1340FF';
                                }
                                if ($f == 0) {
                            ?>
                                    <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                <?php
                                } elseif (($f % 2) == 0) {
                                ?>
                                    <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                <?php
                                } else {
                                ?>
                                    , <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span><br>
                            <?php
                                }
                            }
                            ?>
                        </button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- gambar 1 info -->
        <br>
        <hr>
        <br>
        <!-- gambar 2 info -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../image/reguler/tbi.jpg" style="width:100%; opacity: 60%;">
                    <?php
                    $c_section = 'ptbi';
                    $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial_number';");
                    while ($data = mysqli_fetch_array($sql)) {
                        $isi = array();
                        $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$data[c_code]'");
                        while ($data1 = mysqli_fetch_array($sql1)) {
                            $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                        }
                        $countisi = count($isi);
                    ?>
                        <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
                            <?php
                            for ($f = 0; $f < $countisi; $f++) {
                                if ($isi[$f][1] == 'oc1') {
                                    $pen = '#DC4646';
                                } elseif ($isi[$f][1] == 'oc2') {
                                    $pen = '#5AA65A';
                                } elseif ($isi[$f][1] == 'oc3') {
                                    $pen = '#1340FF';
                                }
                                if ($f == 0) {
                            ?>
                                    <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                <?php
                                } elseif (($f % 2) == 0) {
                                ?>
                                    <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                <?php
                                } else {
                                ?>
                                    , <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span><br>
                            <?php
                                }
                            }
                            ?>
                        </button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- gambar 2 info -->
        <br>
        <hr>
        <br>
        <!-- gambar 3 info -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../image/reguler/uk.jpg" style="width:100%; opacity: 60%;">
                    <?php
                    $c_section = 'puk';
                    $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial_number';");
                    while ($data = mysqli_fetch_array($sql)) {
                        $isi = array();
                        $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$data[c_code]'");
                        while ($data1 = mysqli_fetch_array($sql1)) {
                            $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                        }
                        $countisi = count($isi);
                    ?>
                        <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
                            <?php
                            for ($f = 0; $f < $countisi; $f++) {
                                if ($isi[$f][1] == 'oc1') {
                                    $pen = '#DC4646';
                                } elseif ($isi[$f][1] == 'oc2') {
                                    $pen = '#5AA65A';
                                } elseif ($isi[$f][1] == 'oc3') {
                                    $pen = '#1340FF';
                                }
                                if ($f == 0) {
                            ?>
                                    <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                <?php
                                } elseif (($f % 2) == 0) {
                                ?>
                                    <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                <?php
                                } else {
                                ?>
                                    , <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span><br>
                            <?php
                                }
                            }
                            ?>
                        </button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- gambar 3 info -->
        <br>
        <hr>
        <br>
        <!-- gambar 4 info -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../image/reguler/b.jpg" style="width:100%; opacity: 60%;">
                    <?php
                    $c_section = 'pb';
                    $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial_number';");
                    while ($data = mysqli_fetch_array($sql)) {
                        $isi = array();
                        $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$data[c_code]'");
                        while ($data1 = mysqli_fetch_array($sql1)) {
                            $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                        }
                        $countisi = count($isi);
                    ?>
                        <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
                            <?php
                            for ($f = 0; $f < $countisi; $f++) {
                                if ($isi[$f][1] == 'oc1') {
                                    $pen = '#DC4646';
                                } elseif ($isi[$f][1] == 'oc2') {
                                    $pen = '#5AA65A';
                                } elseif ($isi[$f][1] == 'oc3') {
                                    $pen = '#1340FF';
                                }
                                if ($f == 0) {
                            ?>
                                    <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                <?php
                                } elseif (($f % 2) == 0) {
                                ?>
                                    <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                <?php
                                } else {
                                ?>
                                    , <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span><br>
                            <?php
                                }
                            }
                            ?>
                        </button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- gambar 4 info -->
        <br>
        <hr>
        <br>
        <!-- gambar 5 info -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../image/reguler/bb.jpg" style="width:100%; opacity: 60%;">
                    <?php
                    $c_section = 'pbb';
                    $sql = mysqli_query($connect_pro, "SELECT fb.c_section, fr.c_code, fb.c_top, fb.c_left FROM formng_resultoloc fr JOIN formng_basecoordinate fb ON fr.c_code = fb.c_code WHERE fb.c_section = '$c_section' AND fr.c_serialnumber = '$serial_number';");
                    while ($data = mysqli_fetch_array($sql)) {
                        $isi = array();
                        $sql1 = mysqli_query($connect_pro, "SELECT c_numberng, c_process FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$data[c_code]'");
                        while ($data1 = mysqli_fetch_array($sql1)) {
                            $isi[] = array("$data1[c_numberng]", "$data1[c_process]");
                        }
                        $countisi = count($isi);
                    ?>
                        <button class="btn ingpo" style="width: 25px; height: 25px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%;">
                            <?php
                            for ($f = 0; $f < $countisi; $f++) {
                                if ($isi[$f][1] == 'oc1') {
                                    $pen = '#DC4646';
                                } elseif ($isi[$f][1] == 'oc2') {
                                    $pen = '#5AA65A';
                                } elseif ($isi[$f][1] == 'oc3') {
                                    $pen = '#1340FF';
                                }
                                if ($f == 0) {
                            ?>
                                    <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                <?php
                                } elseif (($f % 2) == 0) {
                                ?>
                                    <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span>
                                <?php
                                } else {
                                ?>
                                    , <span style="color: <?= $pen ?>; padding: 0px;"><?= $isi[$f][0] ?></span><br>
                            <?php
                                }
                            }
                            ?>
                        </button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- gambar 5 info -->
        <br>
    </div>
</div>