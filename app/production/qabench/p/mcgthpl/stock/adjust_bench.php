<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-8">
                <h5><a href="main.php?page=st-bench">Bench Stock</a> <i class="fa fa-chevron-right"></i> Adjust Stock</h5>
            </div>
            <div class="col-4" style="text-align: right;">
                <a href="main.php?page=adjustlog-bench"><button class="btn btn-sm btn-info">Log</button></a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="col-12" style="text-align: right; padding-right: 30px;">
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-success">Add data <i class="fa fa-plus"></i></button>
        <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Bench</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                Name*
                            </div>
                            <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                            <div class="col-8" style="text-align: left;">
                                <select class="cari_basic" style="width: 100%" name="gmc" id="gmc">
                                    <option value=""></option>
                                    <?php
                                    $username = "B_ACTY";
                                    $password = "SYSTEM";
                                    $db = "(DESCRIPTION =(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521)))(CONNECT_DATA = (SERVICE_NAME = YIKSTAFF)))";
                                    $connection = oci_connect($username, $password, $db);

                                    $sql1 = "SELECT DISTINCT M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM FROM M_ACTY.M0031 JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD WHERE M_ACTY.M0010.HMSNM LIKE 'BENCH NO%' OR M_ACTY.M0010.HMSNM LIKE 'BENCH ASSY%' AND M_ACTY.M0010.HMSNM NOT LIKE '%CQ%' AND M_ACTY.M0010.HMSTATUS != 'CI'";
                                    $statment1 = oci_parse($connection, $sql1);
                                    oci_execute($statment1);
                                    while ($ora_result_case = oci_fetch_array($statment1)) {
                                    ?>
                                        <option value="(<?= $ora_result_case['KOHMCD'] ?>) <?= $ora_result_case['HMSNM'] ?>">(<?= $ora_result_case['KOHMCD'] ?>) <?= $ora_result_case['HMSNM'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="row">
                                    <div class="col-12 mb-1" id="errgmc" style="display: none;">
                                        <span style="color: red;">Silahkan memilih jenis bench</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                Seq*
                            </div>
                            <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                            <div class="col-8" style="text-align: left;">
                                <input id="seq" type="text" class="form-control">
                                <div class="row">
                                    <div class="col-12 mb-1" id="errseq" style="display: none;">
                                        <span style="color: red;">Silahkan memasukkan nomor sequence</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                Print Time*
                            </div>
                            <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                            <div class="col-8" style="text-align: left;">
                                <input id="printtime" type="datetime-local" class="form-control">
                                <div class="row">
                                    <div class="col-12 mb-1" id="errprinttitme" style="display: none;">
                                        <span style="color: red;">Silahkan memasukkan tanggal print</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <button id="reset" class="btn btn-sm btn-warning">Reset</button>
                                <button id="check-ketersediaan" class="btn btn-sm btn-info">Check</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="background-color: #31AD61 ; color: #fff; text-align: center; padding-top: 5px; padding-bottom: 5px; display: none;" id="status-belumada">
                                <span>Data aman untuk ditambahkan</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="background-color: #E8585B ; color: #fff; text-align: center; padding-top: 5px; padding-bottom: 5px; display: none;" id="status-sudahada">
                                <span>Data sudah ada</span>
                            </div>
                        </div>
                        <script>
                            $('#reset').click(function() {
                                $('select[name="gmc"]').val('').trigger('change');
                                $('#seq').val('');
                                $('#printtime').val('');
                                $('#status-belumada').hide();
                                $('#status-sudahada').hide();

                                // lepas readonly
                                $('#seq').prop('readonly', false);
                                $('#printtime').prop('readonly', false);
                                $('#gmc').attr('readonly', false);
                            });
                            $('#check-ketersediaan').click(function() {
                                var gmc = $('#gmc').val();
                                var seq = $('#seq').val();
                                var printtime = $('#printtime').val();

                                if (gmc == '' && seq == '' && printtime == '') {
                                    $('#errgmc').show();
                                    setTimeout(function() {
                                        $('#errgmc').hide()
                                    }, 3000);

                                    $('#errseq').show();
                                    setTimeout(function() {
                                        $('#errseq').hide()
                                    }, 3000);

                                    $('#errprinttitme').show();
                                    setTimeout(function() {
                                        $('#errprinttitme').hide()
                                    }, 3000);
                                } else if (gmc == '') {
                                    $('#errgmc').show();
                                    setTimeout(function() {
                                        $('#errgmc').hide()
                                    }, 3000);
                                } else if (seq == '') {
                                    $('#errseq').show();
                                    setTimeout(function() {
                                        $('#errseq').hide()
                                    }, 3000);
                                } else if (printtime == '') {
                                    $('#errprinttitme').show();
                                    setTimeout(function() {
                                        $('#errprinttitme').hide()
                                    }, 3000);
                                } else {
                                    $.ajax({
                                        url: 'stock/check_bench.php',
                                        type: 'POST',
                                        data: {
                                            "gmc": gmc,
                                            "seq": seq,
                                            "printtime": printtime
                                        },
                                        success: function(response) {
                                            if (response == 'belum-ada') {
                                                $('#status-belumada').show();
                                                $('#status-sudahada').hide();
                                                $('#seq').prop('readonly', true);
                                                $('#printtime').prop('readonly', true);
                                                $('#gmc').attr('readonly', true);

                                                // function check() {
                                                //     return "belum-ada";
                                                // }
                                            } else if (response == 'sudah-ada') {
                                                $('#status-belumada').hide();
                                                $('#status-sudahada').show();

                                                // function check() {
                                                //     return "sudah-ada";
                                                // }
                                            } else {
                                                Swal.fire(
                                                    'Error!',
                                                    'Server busy',
                                                    'error'
                                                );
                                            }
                                        }
                                    });
                                }
                            })
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="save-dataadd" type="button" class="btn btn-primary">Save</button>
                        <script>
                            $('#save-dataadd').click(function() {
                                var gmc = $('#gmc').val();
                                var seq = $('#seq').val();
                                var printtime = $('#printtime').val();

                                if (gmc == '' && seq == '' && printtime == '') {
                                    $('#errgmc').show();
                                    setTimeout(function() {
                                        $('#errgmc').hide()
                                    }, 3000);

                                    $('#errseq').show();
                                    setTimeout(function() {
                                        $('#errseq').hide()
                                    }, 3000);

                                    $('#errprinttitme').show();
                                    setTimeout(function() {
                                        $('#errprinttitme').hide()
                                    }, 3000);
                                } else if (gmc == '') {
                                    $('#errgmc').show();
                                    setTimeout(function() {
                                        $('#errgmc').hide()
                                    }, 3000);
                                } else if (seq == '') {
                                    $('#errseq').show();
                                    setTimeout(function() {
                                        $('#errseq').hide()
                                    }, 3000);
                                } else if (printtime == '') {
                                    $('#errprinttitme').show();
                                    setTimeout(function() {
                                        $('#errprinttitme').hide()
                                    }, 3000);
                                } else {
                                    $.ajax({
                                        url: 'stock/add_bench.php',
                                        type: 'POST',
                                        data: {
                                            "gmc": gmc,
                                            "seq": seq,
                                            "printtime": printtime,
                                        },
                                        success: function(response) {
                                            if (response == 'belum-ada') {
                                                $('#status-belumada').show();
                                                $('#status-sudahada').hide();
                                                $('#seq').prop('readonly', true);
                                                $('#printtime').prop('readonly', true);
                                                $('#gmc').attr('readonly', true);

                                            } else if (response == 'data-masuk') {
                                                Swal.fire({
                                                    title: 'Success!',
                                                    text: 'Data bench berhasi ditambahkan',
                                                    icon: 'success',
                                                    timer: 2000,
                                                    showCancelButton: false,
                                                    showConfirmButton: false
                                                }).then(function() {
                                                    window.location = 'main.php?page=adjust-bench';
                                                });
                                            } else {
                                                Swal.fire(
                                                    'Error!',
                                                    'Server busy',
                                                    'error'
                                                );
                                            }
                                        }
                                    });
                                }
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="row">
    <div class="col-12">
        <div class="block-content" style="background-color:#263238 ; display: none;">
            <div style="padding-top: 12%; padding-left: 1%; color: #26B99A;  ">
                <h2 style="font-size: 30px;">Stock tidak ada masalah</h2>
                <h2 style="font-size: 60px;"><i class="fa fa-thumbs-o-up"></i></h2>
                <!-- <h2 id="statusblock" style="font-size: 40px;">Stock tidak ada masalah</h2> -->
            </div>
        </div>
        <script>
            // cek kondisi untuk block konten
            $(document).ready(function() {
                showBlock();
            });

            setInterval(ajaxCall, 500);

            function ajaxCall() {
                $.ajax({
                    url: 'stock/block_check.php',
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 'stock-ng') {
                            showBlock();
                            document.onkeydown = function(e) {
                                return false;
                            };
                            $('#table-default').hide();
                            $('#table-special').show();
                        } else if (response.status == 'oke') {
                            hideBlock();
                            document.onkeydown = function(e) {
                                return true;
                            };
                            $('#table-default').show();
                            $('#table-special').hide();
                        }
                    }
                });
            }
        </script>

        <div class="row">
            <div class="col-12">
                <script>
                    $(document).ready(function() {
                        $('#infostock').DataTable({
                            paging: false,
                            "dom": '<"wrapper"flipt>'
                        });
                    });
                </script>
                <table class="table table-bordered" id="infostock">
                    <thead style="text-align: center;">
                        <th>Serial Number</th>
                        <th>Name</th>
                        <th>Printed</th>
                        <th>Registered</th>
                        <th>Packed</th>
                        <th>Loc</th>
                        <th>Action</th>
                    </thead>
                    <!-- body default -->
                    <tbody id="table-default" style="display: none;">
                        <?php
                        $harini = date('Y-m', strtotime($now));
                        $sql = mysqli_query($connect_pro, "SELECT * FROM qa_bench WHERE c_packed IS NULL OR c_packed LIKE '$harini%' ORDER BY c_used DESC");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <?= $data['c_serialbench'] ?>
                                    <input id="tohapus-<?= $data['c_serialbench'] ?>" type="hidden" value="<?= $data['c_serialbench'] ?>">
                                </td>
                                <td style="text-align: center;"><?= $data['c_name'] ?></td>
                                <td style="text-align: center;"><?= $data['c_created'] ?></td>
                                <td style="text-align: center;"><?= $data['c_used'] ?></td>
                                <td style="text-align: center;"><?= $data['c_packed'] ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($data['c_location'] == 'packing up') {
                                        echo "UP";
                                    } elseif ($data['c_location'] == 'packing gp') {
                                        echo "GP";
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#<?= $data['c_serialbench'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>
                                    <button id="hapus-<?= $data['c_serialbench'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="<?= $data['c_serialbench'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Bench</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                            Serial Number
                                                        </div>
                                                        <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                        <div class="col-8" style="text-align: left;">
                                                            <input readonly id="serialbench-edit-<?= $data['c_serialbench'] ?>" type="text" value="<?= $data['c_serialbench'] ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                            Name
                                                        </div>
                                                        <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                        <div class="col-8" style="text-align: left;">
                                                            <input readonly id="benchname-edit-<?= $data['c_serialbench'] ?>" type="text" value="<?= $data['c_name'] ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                            GMC
                                                        </div>
                                                        <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                        <div class="col-8" style="text-align: left;">
                                                            <input readonly id="gmc-edit-<?= $data['c_serialbench'] ?>" type="text" value="<?= $data['c_gmc'] ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                            Print Date
                                                        </div>
                                                        <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                        <div class="col-8" style="text-align: left;">
                                                            <input readonly id="printdate-edit-<?= $data['c_serialbench'] ?>" type="datetime-local" value="<?= $data['c_created'] ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                            Register Date
                                                        </div>
                                                        <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                        <div class="col-8" style="text-align: left;">
                                                            <input id="regisdate-edit-<?= $data['c_serialbench'] ?>" type="datetime-local" value="<?= $data['c_used'] ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                            Pack Date
                                                        </div>
                                                        <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                        <div class="col-8" style="text-align: left;">
                                                            <input id="packdate-edit-<?= $data['c_serialbench'] ?>" type="datetime-local" value="<?= $data['c_packed'] ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                            Location
                                                        </div>
                                                        <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                        <div class="col-8" style="text-align: left;">
                                                            <select class="cari_basic" style="width: 100%" name="location-edit-<?= $data['c_serialbench'] ?>" id="location-edit-<?= $data['c_serialbench'] ?>">
                                                                <?php
                                                                $pilihup = "";
                                                                $pilihgp = "";
                                                                if ($data['c_location'] == 'packing up') {
                                                                    $pilihup = "selected";
                                                                    $pilihgp = "";
                                                                } elseif ($data['c_location'] == 'packing gp') {
                                                                    $pilihup = "";
                                                                    $pilihgp = "selected";
                                                                } elseif ($data['c_location'] == '') {
                                                                    $pilihup = "";
                                                                    $pilihgp = "";
                                                                }
                                                                ?>
                                                                <option value=""></option>
                                                                <option <?= $pilihup ?> value="packing up">UP</option>
                                                                <option <?= $pilihgp ?> value="packing gp">GP</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                            Note
                                                        </div>
                                                        <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                        <div class="col-8" style="text-align: left;">
                                                            <textarea name="note-edit-<?= $data['c_serialbench'] ?>" id="note-edit-<?= $data['c_serialbench'] ?>" cols="30" rows="2" class="form-control"><?= $data['c_note'] ?></textarea>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 mb-1" id="note-err-<?= $data['c_serialbench'] ?>" style="display: none;">
                                                                <span style="color: red;">Catat perubahannya!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button id="save-edit-<?= $data['c_serialbench'] ?>" type="button" class="btn btn-primary">Save</button>
                                                    <script>
                                                        $('#save-edit-<?= $data['c_serialbench'] ?>').click(function() {
                                                            var note = $('#note-edit-<?= $data['c_serialbench'] ?>').val();
                                                            var serial = $('#serialbench-edit-<?= $data['c_serialbench'] ?>').val();
                                                            var registdate = $('#regisdate-edit-<?= $data['c_serialbench'] ?>').val();
                                                            var packdate = $('#packdate-edit-<?= $data['c_serialbench'] ?>').val();
                                                            var location = $('#location-edit-<?= $data['c_serialbench'] ?>').val();

                                                            if (note == '') {
                                                                $('#note-err-<?= $data['c_serialbench'] ?>').show();
                                                                setTimeout(function() {
                                                                    $('#note-err-<?= $data['c_serialbench'] ?>').hide()
                                                                }, 3000);
                                                            } else {
                                                                $.ajax({
                                                                    url: 'stock/edit_bench.php',
                                                                    type: 'POST',
                                                                    data: {
                                                                        "serial": serial,
                                                                        "registdate": registdate,
                                                                        "packdate": packdate,
                                                                        "location": location,
                                                                        "note": note
                                                                    },
                                                                    success: function(response) {
                                                                        if (response == 'data-telah-diedit') {
                                                                            Swal.fire({
                                                                                title: 'Success!',
                                                                                text: 'Data bench berhasi diubah',
                                                                                icon: 'success',
                                                                                timer: 2000,
                                                                                showCancelButton: false,
                                                                                showConfirmButton: false
                                                                            }).then(function() {
                                                                                window.location = 'main.php?page=adjust-bench';
                                                                            });
                                                                        } else {
                                                                            Swal.fire(
                                                                                'Error!',
                                                                                'Data bench gagal diubah',
                                                                                'error'
                                                                            );
                                                                        }
                                                                    }
                                                                });
                                                            }


                                                        })
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Edit -->

                                    <!-- Fungsi Hapus -->
                                    <script>
                                        $('#hapus-<?= $data['c_serialbench'] ?>').click(function() {
                                            var serial = $('#tohapus-<?= $data['c_serialbench'] ?>').val();
                                            var name = $('#benchname-edit-<?= $data['c_serialbench'] ?>').val();
                                            var gmc = $('#gmc-edit-<?= $data['c_serialbench'] ?>').val();

                                            (async () => {
                                                const {
                                                    value: alasane
                                                } = await Swal.fire({
                                                    title: 'Apakah anda yakin?',
                                                    html: "Bench yang akan dihapus adalah: <br><table style='font-size:smaller;' class='table mb-0'><tr><td style='text-align:left; width:40%;'>Serial Number </td><td>:</td><td style='text-align:left'>" + serial + "</td></tr><tr><td style='text-align:left'>Name </td><td>:</td><td style='text-align:left'>" + name + "</td></tr><tr><td style='text-align:left'>GMC </td><td>:</td><td style='text-align:left'>" + gmc + "</td></tr></table>",
                                                    icon: 'warning',
                                                    input: 'text',
                                                    inputLabel: 'Alasan melakukan hapus',
                                                    inputPlaceholder: 'Tulis alasan disini...',
                                                    inputAttributes: {
                                                        'aria-label': 'Tulis alasan disini'
                                                    },
                                                    preConfirm: (alasan) => {
                                                        const alasane = alasan;
                                                        if (alasan == '') {
                                                            Swal.showValidationMessage(
                                                                `Silahkan tulis alasan melakukan hapus`
                                                            )
                                                        } else {
                                                            return {
                                                                alasane: alasane,
                                                            }
                                                        }

                                                    },
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Yes, delete it!',
                                                    allowOutsideClick: false
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // const serialnumber = Swal.getPopup().querySelector('#serialnumber').value;
                                                        var reason = result.value.alasane;
                                                        $.ajax({
                                                            url: 'stock/delete_bench.php',
                                                            type: 'POST',
                                                            data: {
                                                                "serial": serial,
                                                                "note": reason
                                                            },
                                                            success: function(response) {
                                                                if (response == 'data-telah-dihapus') {
                                                                    Swal.fire({
                                                                        title: 'Success!',
                                                                        text: 'Data bench berhasi dihapus',
                                                                        icon: 'success',
                                                                        timer: 2000,
                                                                        showCancelButton: false,
                                                                        showConfirmButton: false
                                                                    }).then(function() {
                                                                        window.location = 'main.php?page=adjust-bench';
                                                                    });
                                                                } else {
                                                                    Swal.fire(
                                                                        'Error!',
                                                                        'Data bench gagal dihapus',
                                                                        'error'
                                                                    );
                                                                }
                                                            }
                                                        });
                                                    }
                                                });
                                            })()

                                            // Swal.fire({
                                            //     title: 'Apakah anda yakin hapus data?',
                                            //     text: "Data yang sudah dihapus tidak dapat dipulihkan",
                                            //     icon: 'warning',
                                            //     showCancelButton: true,
                                            //     confirmButtonColor: '#3085d6',
                                            //     cancelButtonColor: '#d33',
                                            //     confirmButtonText: 'Yes, delete it!'
                                            // }).then((result) => {
                                            //     if (result.isConfirmed) {
                                            //         $.ajax({
                                            //             url: 'stock/delete_bench.php',
                                            //             type: 'POST',
                                            //             data: {
                                            //                 "serial": serial,
                                            //             },
                                            //             success: function(response) {
                                            //                 if (response == 'data-telah-dihapus') {
                                            //                     Swal.fire({
                                            //                         title: 'Success!',
                                            //                         text: 'Data bench berhasi dihapus',
                                            //                         icon: 'success',
                                            //                         timer: 2000,
                                            //                         showCancelButton: false,
                                            //                         showConfirmButton: false
                                            //                     }).then(function() {
                                            //                         window.location = 'main.php?page=adjust-bench';
                                            //                     });
                                            //                 } else {
                                            //                     Swal.fire(
                                            //                         'Error!',
                                            //                         'Data bench gagal dihapus',
                                            //                         'error'
                                            //                     );
                                            //                 }
                                            //             }
                                            //         });
                                            //     }
                                            // })

                                        })
                                    </script>
                                    <!-- Fungsi Hapus -->
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <!-- body default -->
                    <!-- body special -->
                    <tbody id="table-special" style="display: none;">
                        <?php
                        $harini = date('Y-m', strtotime($now));
                        $sql = mysqli_query($connect_pro, "SELECT * FROM qa_bench WHERE c_packed IS NULL OR c_packed LIKE '$harini%' ORDER BY c_used DESC limit 5");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <?= $data['c_serialbench'] ?>
                                    <input id="tohapus-<?= $data['c_serialbench'] ?>" type="hidden" value="<?= $data['c_serialbench'] ?>">
                                </td>
                                <td style="text-align: center;"><?= $data['c_name'] ?></td>
                                <td style="text-align: center;"><?= $data['c_created'] ?></td>
                                <td style="text-align: center;"><?= $data['c_used'] ?></td>
                                <td style="text-align: center;"><?= $data['c_packed'] ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($data['c_location'] == 'packing up') {
                                        echo "UP";
                                    } elseif ($data['c_location'] == 'packing gp') {
                                        echo "GP";
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#<?= $data['c_serialbench'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>
                                    <button id="hapus-<?= $data['c_serialbench'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <!-- body special -->
                </table>
            </div>
        </div>
    </div>
</div>