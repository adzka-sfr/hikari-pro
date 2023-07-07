<!-- isi hasil scan slip number -->
<script src="<?= base_url('_assets/src/add/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>


<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <div class="row">
        <div class="separator" style="margin: 0px; padding: 0px;"></div>
        <div class="col-10">
            <!-- <h3 style="font-size: 20px;"><?= $_SESSION['serialnumber_outside1'] ?> - <?= $_SESSION['pianoname_outside1'] ?></h3> -->
        </div>

        <div class="col-2" style="text-align: right;">
            <i>Polyester</i>
            <?php
            $serial_number = $_SESSION['serialnumber_outside1'];
            $process = 'oc1';
            $pianoname = $_SESSION['pianoname_outside1'];
            $sql = mysqli_query($connect_pro, "SELECT MAX(c_numberng) as maksimal FROM formng_resultong WHERE c_serialnumber = '$serial_number'");
            $data = mysqli_fetch_array($sql);
            if ($data['maksimal'] == '') {
                $numberng = 1;
            } else {
                $numberng = $data['maksimal'] + 1;
            }

            ?>
        </div>


    </div>
    <div class="row" style="padding-top: 0px;">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 40%;">
                            <div class="row">
                                <div class="col-4">
                                    No.Seri :
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" style="text-align: center; font-size: 15px;"><u><?= $serial_number ?></u></div>
                            </div>
                        </th>
                        <th>
                            <div class="row">
                                <div class="col-4">
                                    Model :
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" style="text-align: center; font-size: 15px;"><u><?= $pianoname ?></u></div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Proses : <?php
                                        if ($process == 'oc1') {
                                            echo 'Outside Check 1';
                                        } elseif ($process == 'oc2') {
                                            echo 'Outside Check 2';
                                        } elseif ($process == 'oc3') {
                                            echo 'Outside Check 3';
                                        }
                                        ?></th>
                        <th>
                            PIC : <?= $_SESSION['nama'] ?>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <tr style="text-align: center;">
                    <td><i class="fa fa-pencil" style="color: #DC4646 ;"></i> Outside Check 1</td>
                    <td><i class="fa fa-pencil" style="color: #5AA65A ;"></i> Outside Check 2</td>
                    <td><i class="fa fa-pencil" style="color: #1340FF ;"></i> Outside Check 3</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addng">
                        Tambah NG +
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addng" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah NG - <?php
                                                                                                    if ($process == 'oc1') {
                                                                                                        echo 'Outside Check 1';
                                                                                                    } elseif ($process == 'oc2') {
                                                                                                        echo 'Outside Check 2';
                                                                                                    } elseif ($process == 'oc3') {
                                                                                                        echo 'Outside Check 3';
                                                                                                    }
                                                                                                    ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="myform">
                                        <input type="hidden" name="serialnumber" value="<?= $serial_number ?>">
                                        <input type="hidden" name="numberng" value="<?= $numberng ?>">
                                        <input type="hidden" name="process" value="<?= $process ?>">
                                        <div class="row">
                                            <div class="col-12 mb-1">
                                                <label>Nama NG :</label>
                                                <select class="halodeck" id="ng" name="ng" style="width:100%; height: max-content;">
                                                    <option value="" selected disabled>Select Cabinet</option>
                                                    <?php
                                                    $cb_sql = mysqli_query($connect_pro, "SELECT * FROM formng_listng WHERE c_status = 'enable' AND c_area = 'outside'");
                                                    while ($cb_data = mysqli_fetch_array($cb_sql)) {
                                                    ?>
                                                        <option value="<?= $cb_data['c_ng'] ?>"><?= $cb_data['c_ng'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div id="ngerror" class="col-12 text-center" style="background-color:#F8D7DA; color: #B02A37; padding: 10px; display: none;">
                                                <i class="fa fa-info-circle"></i> Silahkan pilih nama NG
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-3 mb-1">
                                                <label>Nama Kabinet :</label>
                                                <select class="halocab" id="cabin" name="cab[]" multiple="multiple" style="width:100%; height: max-content;">
                                                    <?php
                                                    $cb_sql = mysqli_query($connect_pro, "SELECT * FROM formng_listcabinet WHERE c_status = 'enable'");
                                                    while ($cb_data = mysqli_fetch_array($cb_sql)) {
                                                    ?>
                                                        <option value="<?= $cb_data['c_name'] ?>"><?= $cb_data['c_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div id="caberror" class="col-12 text-center" style="background-color:#F8D7DA; color: #B02A37; padding: 10px; display: none;">
                                                <i class="fa fa-info-circle"></i> Silahkan pilih nama kabinet minimal 1
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12" style="text-align: center;">
                                                <center>
                                                    <div class="containere">
                                                        <img src="../image/reguler/tbo.jpg" style="width:100%">
                                                        <?php
                                                        $c_section = 'ptbo';
                                                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoordinate WHERE c_section = '$c_section'");
                                                        while ($data = mysqli_fetch_array($sql)) {
                                                        ?>
                                                            <input type="checkbox" class="chck" name="<?= $c_section ?>[]" value="<?= $data['c_code'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12" style="text-align: center;">
                                                <center>
                                                    <div class="containere">
                                                        <img src="../image/reguler/tbi.jpg" style="width:100%">
                                                        <?php
                                                        $c_section = 'ptbi';
                                                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoordinate WHERE c_section = '$c_section'");
                                                        while ($data = mysqli_fetch_array($sql)) {
                                                        ?>
                                                            <input type="checkbox" class="chck" name="<?= $c_section ?>[]" value="<?= $data['c_code'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12" style="text-align: center;">
                                                <center>
                                                    <div class="containere">
                                                        <img src="../image/reguler/uk.jpg" style="width:100%">
                                                        <?php
                                                        $c_section = 'puk';
                                                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoordinate WHERE c_section = '$c_section'");
                                                        while ($data = mysqli_fetch_array($sql)) {
                                                        ?>
                                                            <input type="checkbox" class="chck" name="<?= $c_section ?>[]" value="<?= $data['c_code'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12" style="text-align: center;">
                                                <center>
                                                    <div class="containere">
                                                        <img src="../image/reguler/b.jpg" style="width:100%">
                                                        <?php
                                                        $c_section = 'pb';
                                                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoordinate WHERE c_section = '$c_section'");
                                                        while ($data = mysqli_fetch_array($sql)) {
                                                        ?>
                                                            <input type="checkbox" class="chck" name="<?= $c_section ?>[]" value="<?= $data['c_code'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12" style="text-align: center;">
                                                <center>
                                                    <div class="containere">
                                                        <img src="../image/reguler/bb.jpg" style="width:100%">
                                                        <?php
                                                        $c_section = 'pbb';
                                                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_basecoordinate WHERE c_section = '$c_section'");
                                                        while ($data = mysqli_fetch_array($sql)) {
                                                        ?>
                                                            <input type="checkbox" class="chck" name="<?= $c_section ?>[]" value="<?= $data['c_code'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <!-- data-bs-dismiss="modal" -->
                                    <button type="button" class="btn btn-secondary" id="cancel" data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary" id="save">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('#save').click(function() {
                                var ng = $('#ng').val();
                                var cab = $('#cabin').val();

                                if (ng == null && cab == null) {
                                    $('#ngerror').show();
                                    setTimeout(function() {
                                        $('#ngerror').hide()
                                    }, 3000);

                                    $('#caberror').show();
                                    setTimeout(function() {
                                        $('#caberror').hide()
                                    }, 3000);
                                } else if (ng == null) {
                                    $('#ngerror').show();
                                    setTimeout(function() {
                                        $('#ngerror').hide()
                                    }, 3000);
                                } else if (cab == null) {
                                    $('#caberror').show();
                                    setTimeout(function() {
                                        $('#caberror').hide()
                                    }, 3000);
                                } else {
                                    var isi = $('#myform').serializeArray();

                                    $.ajax({
                                        type: 'POST',
                                        url: 'insertform1.php',
                                        data: isi,
                                        success: function(dataResult) {
                                            var dataResult = JSON.parse(dataResult);
                                            if (dataResult.statusCode == 200) {
                                                Swal.fire({
                                                    title: 'Berhasil!',
                                                    text: 'NG berhasil ditambahkan',
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
                                            } else if (dataResult.statusCode == 203) {
                                                Swal.fire({
                                                    position: 'center',
                                                    icon: 'warning',
                                                    title: 'Nama NG sudah terdaftar!',
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                })
                                            }
                                        }
                                    });
                                }

                            });
                            $('#cancel').click(function() {
                                document.getElementById("myform").reset();
                            })
                        });
                    </script>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead style="text-align: center;">
                            <th style="width:5%">No</th>
                            <th>Detail NG</th>
                        </thead>
                        <tbody>
                            <?php
                            // data cabinet
                            $cab_list = array();
                            $nolist = 0;
                            $cb_sql = mysqli_query($connect_pro, "SELECT * FROM formng_listcabinet WHERE c_status = 'enable'");
                            while ($cb_data = mysqli_fetch_array($cb_sql)) {
                                $cab_list[$nolist] = $cb_data['c_name'];
                                $nolist++;
                            }
                            $count_cablist = count($cab_list);

                            $sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number'");
                            $data = mysqli_fetch_array($sql);
                            if (empty($data)) {
                                // kosong
                            ?>
                                <tr>
                                    <td colspan="2" style="text-align: center;">Tidak ada data</td>
                                </tr>
                                <?php
                            } else {
                                // tidak kosong
                                $sql = mysqli_query($connect_pro, "SELECT DISTINCT  c_numberng, c_ng FROM formng_resultong WHERE c_serialnumber = '$serial_number' ORDER BY c_numberng ASC");
                                while ($data = mysqli_fetch_array($sql)) {
                                    $idbutton = $serial_number . $data['c_numberng'];
                                    // list cabinet aktif
                                    $cab_active = array();
                                    $nolist = 0;
                                    $active_sql = mysqli_query($connect_pro, "SELECT c_cabinet FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = $data[c_numberng]");
                                    while ($active_data = mysqli_fetch_array($active_sql)) {
                                        $cab_active[$nolist] = $active_data['c_cabinet'];
                                        $nolist++;
                                    }
                                    $count_cabactive = count($cab_active);

                                    // warna pena untuk nama ng
                                    $merah_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_process = 'oc1'");
                                    $merah_data = mysqli_fetch_array($merah_sql);
                                    if (!empty($merah_data)) {
                                        $warna_pen = '#DC4646';
                                    } else {
                                        $hijau_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_process = 'oc2'");
                                        $hijau_data = mysqli_fetch_array($hijau_sql);
                                        if (!empty($hijau_data)) {
                                            $warna_pen = '#5AA65A';
                                        } else {
                                            $biru_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_process = 'oc3'");
                                            $biru_data = mysqli_fetch_array($biru_sql);
                                            if (!empty($biru_data)) {
                                                $warna_pen = '#1340FF';
                                            } else {
                                                $warna_pen = '#000000';
                                            }
                                        }
                                    }
                                ?>
                                    <!-- isi -->
                                    <tr>
                                        <td rowspan="2" style="text-align: center;">
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <?= $data['c_numberng'] ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <form id="myformdel<?= $idbutton ?>">
                                                        <input type="hidden" name="serialnumber" value="<?= $serial_number ?>">
                                                        <input type="hidden" name="numberng" value="<?= $data['c_numberng'] ?>">
                                                        <input type="hidden" name="process" value="<?= $process ?>">
                                                    </form>
                                                    <button type="button" id="delete<?= $idbutton ?>" class="btn btn-danger btn-sm" style="margin:0px; padding-top: 5px;"><i class="fa fa-trash"></i></button>
                                                </div>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#delete<?= $idbutton ?>').click(function() {
                                                            Swal.fire({
                                                                title: 'Apakah anda yakin?',
                                                                text: "NG <?= $data['c_ng'] ?> akan di hapus",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Iya, hapus!',
                                                                cancelButtonText: 'Batal'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    var isi = $('#myformdel<?= $idbutton ?>').serializeArray();
                                                                    $.ajax({
                                                                        type: 'POST',
                                                                        url: 'insertform1_delete.php',
                                                                        data: isi,
                                                                        success: function(dataResult) {
                                                                            var dataResult = JSON.parse(dataResult);
                                                                            if (dataResult.statusCode == 200) {
                                                                                Swal.fire({
                                                                                    title: 'Berhasil!',
                                                                                    text: 'Data NG berhasil dihapus!',
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
                                        </td>
                                        <td style="font-weight: bold;">
                                            <div class="row">
                                                <div class="col-10" style="color: <?= $warna_pen ?>;"><?= $data['c_ng'] ?></div>
                                                <div class=" col-2" style="text-align: right;">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" style="margin:0px; padding-top: 5px;" data-bs-target="#<?= $idbutton ?>">
                                                        <i class="fa fa-pencil"></i></button>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" style="text-align: left; font-weight: normal;" id="<?= $idbutton ?>" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $serial_number ?> - <?= $data['c_ng'] ?></h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="myform<?= $idbutton ?>">
                                                                        <input type="hidden" name="serialnumber" value="<?= $serial_number ?>">
                                                                        <input type="hidden" name="numberng" value="<?= $data['c_numberng'] ?>">
                                                                        <input type="hidden" name="process" value="<?= $process ?>">
                                                                        <input type="hidden" name="ng" value="<?= $data['c_ng'] ?>">
                                                                        <div class="row">
                                                                            <div class="col-12 mt-3 mb-1">
                                                                                <label>Nama Kabinet :</label>
                                                                                <select class="halocab" id="cabin<?= $idbutton ?>" name="cab[]" multiple="multiple" style="width:100%; height: max-content;">
                                                                                    <?php
                                                                                    // mengambil semua array
                                                                                    for ($a = 0; $a < $count_cablist; $a++) {
                                                                                        // mencocokan pada array terpilih
                                                                                        for ($b = 0; $b < $count_cabactive; $b++) {
                                                                                            // jika ada kasih selected
                                                                                            if ($cab_list[$a] == $cab_active[$b]) {
                                                                                                $selcab = 'selected';
                                                                                            } else {
                                                                                                // jika sudah terselect maka value dipertahankan
                                                                                                if ($selcab != '') {
                                                                                                    $selcab = $selcab;
                                                                                                } else {
                                                                                                    // jika memang kosong kasih value kosong
                                                                                                    $selcab = '';
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                        <option <?= $selcab ?> value="<?= $cab_list[$a] ?>"><?= $cab_list[$a] ?></option>
                                                                                    <?php
                                                                                        // reset kembali untuk tabel select
                                                                                        $selcab = '';
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div id="caberror<?= $idbutton ?>" class="col-12 text-center" style="background-color:#F8D7DA; color: #B02A37; padding: 10px; display: none;">
                                                                                <i class="fa fa-info-circle"></i> Silahkan pilih nama kabinet minimal 1
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12" style="text-align: center;">
                                                                                <center>
                                                                                    <div class="containere">
                                                                                        <img src="../image/reguler/tbo.jpg" style="width:100%">
                                                                                        <?php
                                                                                        $c_section = 'ptbo';
                                                                                        $gambar = mysqli_query($connect_pro, "SELECT * FROM formng_basecoordinate WHERE c_section = '$c_section'");
                                                                                        while ($datag = mysqli_fetch_array($gambar)) {
                                                                                            $checkgambar = mysqli_query($connect_pro, "SELECT * FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$datag[c_code]' AND c_numberng = $data[c_numberng]");
                                                                                            $d_checkgambar = mysqli_fetch_array($checkgambar);
                                                                                            if (empty($d_checkgambar)) {
                                                                                                $checked = '';
                                                                                            } else {
                                                                                                $checked = 'checked';
                                                                                            }
                                                                                        ?>
                                                                                            <input <?= $checked ?> type="checkbox" class="chck" name="<?= $c_section ?>[]" value="<?= $datag['c_code'] ?>" style="width: 30px; height: 30px; top: <?= $datag['c_top'] ?>%; left: <?= $datag['c_left'] ?>%; accent-color: #FF0000;">
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-12" style="text-align: center;">
                                                                                <center>
                                                                                    <div class="containere">
                                                                                        <img src="../image/reguler/tbi.jpg" style="width:100%">
                                                                                        <?php
                                                                                        $c_section = 'ptbi';
                                                                                        $gambar = mysqli_query($connect_pro, "SELECT * FROM formng_basecoordinate WHERE c_section = '$c_section'");
                                                                                        while ($datag = mysqli_fetch_array($gambar)) {
                                                                                            $checkgambar = mysqli_query($connect_pro, "SELECT * FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$datag[c_code]' AND c_numberng = $data[c_numberng]");
                                                                                            $d_checkgambar = mysqli_fetch_array($checkgambar);
                                                                                            if (empty($d_checkgambar)) {
                                                                                                $checked = '';
                                                                                            } else {
                                                                                                $checked = 'checked';
                                                                                            }
                                                                                        ?>
                                                                                            <input <?= $checked ?> type="checkbox" class="chck" name="<?= $c_section ?>[]" value="<?= $datag['c_code'] ?>" style="width: 30px; height: 30px; top: <?= $datag['c_top'] ?>%; left: <?= $datag['c_left'] ?>%; accent-color: #FF0000;">
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-12" style="text-align: center;">
                                                                                <center>
                                                                                    <div class="containere">
                                                                                        <img src="../image/reguler/uk.jpg" style="width:100%">
                                                                                        <?php
                                                                                        $c_section = 'puk';
                                                                                        $gambar = mysqli_query($connect_pro, "SELECT * FROM formng_basecoordinate WHERE c_section = '$c_section'");
                                                                                        while ($datag = mysqli_fetch_array($gambar)) {
                                                                                            $checkgambar = mysqli_query($connect_pro, "SELECT * FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$datag[c_code]' AND c_numberng = $data[c_numberng]");
                                                                                            $d_checkgambar = mysqli_fetch_array($checkgambar);
                                                                                            if (empty($d_checkgambar)) {
                                                                                                $checked = '';
                                                                                            } else {
                                                                                                $checked = 'checked';
                                                                                            }
                                                                                        ?>
                                                                                            <input <?= $checked ?> type="checkbox" class="chck" name="<?= $c_section ?>[]" value="<?= $datag['c_code'] ?>" style="width: 30px; height: 30px; top: <?= $datag['c_top'] ?>%; left: <?= $datag['c_left'] ?>%; accent-color: #FF0000;">
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-12" style="text-align: center;">
                                                                                <center>
                                                                                    <div class="containere">
                                                                                        <img src="../image/reguler/b.jpg" style="width:100%">
                                                                                        <?php
                                                                                        $c_section = 'pb';
                                                                                        $gambar = mysqli_query($connect_pro, "SELECT * FROM formng_basecoordinate WHERE c_section = '$c_section'");
                                                                                        while ($datag = mysqli_fetch_array($gambar)) {
                                                                                            $checkgambar = mysqli_query($connect_pro, "SELECT * FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$datag[c_code]' AND c_numberng = $data[c_numberng]");
                                                                                            $d_checkgambar = mysqli_fetch_array($checkgambar);
                                                                                            if (empty($d_checkgambar)) {
                                                                                                $checked = '';
                                                                                            } else {
                                                                                                $checked = 'checked';
                                                                                            }
                                                                                        ?>
                                                                                            <input <?= $checked ?> type="checkbox" class="chck" name="<?= $c_section ?>[]" value="<?= $datag['c_code'] ?>" style="width: 30px; height: 30px; top: <?= $datag['c_top'] ?>%; left: <?= $datag['c_left'] ?>%; accent-color: #FF0000;">
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-12" style="text-align: center;">
                                                                                <center>
                                                                                    <div class="containere">
                                                                                        <img src="../image/reguler/bb.jpg" style="width:100%">
                                                                                        <?php
                                                                                        $c_section = 'pbb';
                                                                                        $gambar = mysqli_query($connect_pro, "SELECT * FROM formng_basecoordinate WHERE c_section = '$c_section'");
                                                                                        while ($datag = mysqli_fetch_array($gambar)) {
                                                                                            $checkgambar = mysqli_query($connect_pro, "SELECT * FROM formng_resultoloc WHERE c_serialnumber = '$serial_number' AND c_code = '$datag[c_code]' AND c_numberng = $data[c_numberng]");
                                                                                            $d_checkgambar = mysqli_fetch_array($checkgambar);
                                                                                            if (empty($d_checkgambar)) {
                                                                                                $checked = '';
                                                                                            } else {
                                                                                                $checked = 'checked';
                                                                                            }
                                                                                        ?>
                                                                                            <input <?= $checked ?> type="checkbox" class="chck" name="<?= $c_section ?>[]" value="<?= $datag['c_code'] ?>" style="width: 30px; height: 30px; top: <?= $datag['c_top'] ?>%; left: <?= $datag['c_left'] ?>%; accent-color: #FF0000;">
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </center>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <hr>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <!-- data-bs-dismiss="modal" -->
                                                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                                                    <button type="button" class="btn btn-primary" id="save<?= $idbutton ?>">Simpan perubahan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#save<?= $idbutton ?>').click(function() {
                                                                var cab = $('#cabin<?= $idbutton ?>').val();

                                                                if (cab == null) {
                                                                    $('#caberror<?= $idbutton ?>').show();
                                                                    setTimeout(function() {
                                                                        $('#caberror<?= $idbutton ?>').hide()
                                                                    }, 3000);
                                                                } else {
                                                                    var isi = $('#myform<?= $idbutton ?>').serializeArray();
                                                                    $.ajax({
                                                                        type: 'POST',
                                                                        url: 'insertform1_update.php',
                                                                        data: isi,
                                                                        success: function(dataResult) {
                                                                            var dataResult = JSON.parse(dataResult);
                                                                            if (dataResult.statusCode == 200) {
                                                                                Swal.fire({
                                                                                    title: 'Berhasil!',
                                                                                    text: 'Data berhasil diubah!',
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

                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <ul>
                                                <?php
                                                for ($a = 0; $a < $count_cabactive; $a++) {
                                                    // warna pena untuk nama cabinet
                                                    $c_cabinet = $cab_active[$a];
                                                    $merah_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_cabinet = '$c_cabinet' AND c_process = 'oc1'");
                                                    $merah_data = mysqli_fetch_array($merah_sql);
                                                    if (!empty($merah_data)) {
                                                        $warna_pen = '#DC4646';
                                                    } else {
                                                        $hijau_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_cabinet = '$c_cabinet' AND c_process = 'oc2'");
                                                        $hijau_data = mysqli_fetch_array($hijau_sql);
                                                        if (!empty($hijau_data)) {
                                                            $warna_pen = '#5AA65A';
                                                        } else {
                                                            $biru_sql = mysqli_query($connect_pro, "SELECT id FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_numberng = '$data[c_numberng]' AND c_cabinet = '$c_cabinet' AND c_process = 'oc3'");
                                                            $biru_data = mysqli_fetch_array($biru_sql);
                                                            if (!empty($biru_data)) {
                                                                $warna_pen = '#1340FF';
                                                            } else {
                                                                $warna_pen = '#000000';
                                                            }
                                                        }
                                                    }
                                                ?>
                                                    <li style="color: <?= $warna_pen ?>;"><?= $cab_active[$a] ?></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </td>
                                    </tr>
                                    <!-- isi -->
                            <?php
                                }
                            }

                            ?>

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
    <hr>
    <div class="row">
        <div class="col-12 mb-3 text-center">
            <form id="sendrepairdata">
                <input type="hidden" name="serialnumber" value="<?= $serial_number ?>">
                <input type="hidden" name="process" value="<?= $process ?>">
            </form>
            <button type="button" id="sendrepair" class="btn btn-success">Kirim ke Repair</button>
            <script>
                $(document).ready(function() {
                    $('#sendrepair').click(function() {
                        Swal.fire({
                            title: 'Apakah anda yakin?',
                            text: "Data akan diteruskan ke bagian repair dan anda tidak akan diperbolehkan untuk mengubah data",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Iya, kirim!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var isi = $('#sendrepairdata').serializeArray();
                                $.ajax({
                                    type: 'POST',
                                    url: 'insertform1_send.php',
                                    data: isi,
                                    success: function(dataResult) {
                                        var dataResult = JSON.parse(dataResult);
                                        if (dataResult.statusCode == 200) {
                                            Swal.fire({
                                                title: 'Berhasil!',
                                                text: 'Data NG berhasil dikirim ke Repair!',
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
</div>
<!-- isi hasil scan slip number -->