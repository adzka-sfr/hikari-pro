<script src="<?= base_url('_assets/src/add/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>
<div class="row">
    <div class="col-12" style="margin-top: 0px; padding-top: 0px;">
        <h4 id="teksnyagan">Halaman Reset Pengecekan Piano</h4>
        <hr>
        <script type="text/javascript">
            let x = document.getElementById("teksnyagan");
            x.style.color = "red";

            function changeColor() {
                x.style.color = x.style.color == "red" ? "black" : "red";
            }
            window.setInterval(changeColor, 200);
        </script>
        <p>Pastikan kembali <b>Serial Number</b> yang akan direset sudah sesuai, proses ini akan menghapus hasil pengecekan dimulai dari :

            </br>
        <ol>
            <li>Inside Check</li>
            <li>Outside Check 1</li>
            <li>Outside Check 2</li>
            <li>Outside Check 3/Final Check</li>
        </ol>
        Piano yang telah direset harus diulang untuk proses pengecekan dari awal/Inside Check.</br>Piano dengan status <b>Check Card Closed</b> tidak bisa direset.
        </p>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <form method="POST">
            <div class="row">
                <div class="col-4">
                    <!-- ha kosong ?? -->
                </div>
                <div class="col-4">
                    <label for="serialnumber">Serial Number :</label>
                    <input type="text" style="text-align: center;" id="serialnumber" class="form-control" name="serialnumber" required />
                </div>
                <div class="col-4">
                    <!-- ha kosong ?? -->
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12 text-center">
                    <button name="reset" id="reset" type="submit" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['reset'])) {
            // cek no seri pada register
            $sql = mysqli_query($connect_pro, "SELECT c_serialnumber FROM formng_register WHERE c_serialnumber = '$_POST[serialnumber]'");
            $data = mysqli_fetch_array($sql);
            if (empty($data)) {
        ?>
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Serial number salah atau tidak terdaftar!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                </script>
                <?php
            } else {
                $sql = mysqli_query($connect_pro, "SELECT c_outcheck3by FROM formng_register WHERE c_serialnumber = '$_POST[serialnumber]'");
                $data = mysqli_fetch_array($sql);

                if ($data['c_outcheck3by'] != '') {
                ?>
                    <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: 'Serial number sudah closed!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    </script>
                <?php
                } else {
                    $sql = mysqli_query($connect_pro, "SELECT c_serialnumber, c_ctrlnumber, c_gmc, c_pianoname FROM formng_register WHERE c_serialnumber = '$_POST[serialnumber]'");
                    $data = mysqli_fetch_array($sql);
                ?>
                    <script>
                        var isi;
                        (async () => {
                            const {
                                value: alasane
                            } = await Swal.fire({
                                title: 'Apakah anda yakin?',
                                html: "Piano yang akan direset adalah: <br><table style='font-size:smaller' class='table mb-0'><tr><td style='text-align:left'>Serial Number </td><td>:</td><td style='text-align:left'><input type='hidden' class='swal2-input' id='serialnumber' value='<?= $data['c_serialnumber'] ?>'><?= $data['c_serialnumber'] ?></td></tr><tr><td style='text-align:left'>No A Card </td><td>:</td><td style='text-align:left'><?= $data['c_ctrlnumber'] ?></td></tr><tr><td style='text-align:left'>Nama Piano </td><td>:</td><td style='text-align:left'><?= $data['c_pianoname'] ?></td></tr></table>",
                                icon: 'warning',
                                input: 'text',
                                inputLabel: 'Alasan melakukan reset',
                                inputPlaceholder: 'Tulis alasan disini...',
                                inputAttributes: {
                                    'aria-label': 'Tulis alasan disini'
                                },
                                preConfirm: (alasan) => {
                                    const alasane = alasan;
                                    if (alasan == '') {
                                        Swal.showValidationMessage(
                                            `Silahkan tulis alasan melakukan reset`
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
                                confirmButtonText: 'Yes, reset it!',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    const serialnumber = Swal.getPopup().querySelector('#serialnumber').value;
                                    var reason = result.value.alasane;
                                    (async () => {
                                        const {
                                            value: text
                                        } = await Swal.fire({
                                            input: 'text',
                                            title: 'Tulis kembali teks berikut',
                                            inputLabel: 'saya yakin reset serial number ' + serialnumber,
                                            inputPlaceholder: 'Tulis validasi teks disini...',
                                            inputAttributes: {
                                                'aria-label': 'Tulis validasi teks disini'
                                            },
                                            showCancelButton: true,
                                            confirmButtonText: 'Reset',
                                            showLoaderOnConfirm: true,
                                            preConfirm: (text) => {
                                                const isi = text;
                                                const serinum = serialnumber;
                                                const reson = reason;
                                                if (isi != 'saya yakin reset serial number ' + serialnumber) {
                                                    Swal.showValidationMessage(
                                                        `Teks validasi tidak sama`
                                                    )
                                                } else {
                                                    return {
                                                        isi: isi,
                                                        serinum: serinum,
                                                        reson: reson
                                                    }
                                                }

                                            },
                                            allowOutsideClick: false
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                var seripiano = result.value.serinum;
                                                var resson = result.value.reson;

                                                $.ajax({
                                                    url: "reset-serial/reset.php",
                                                    type: "POST",
                                                    data: {
                                                        seripiano: seripiano,
                                                        resson: resson
                                                    },
                                                    success: function(dataResult) {
                                                        var dataResult = JSON.parse(dataResult);
                                                        if (dataResult.statusCode == 200) {
                                                            Swal.fire({
                                                                position: 'center',
                                                                icon: 'success',
                                                                title: 'Piano berhasil direset',
                                                                html: "<table style='font-size:smaller' class='table'><tr><td style='text-align:left; width: 28%'>Serial Number </td><td>:</td><td style='text-align:left'>" + dataResult.serialnumber + "</td></tr><tr><td style='text-align:left'>No A Card </td><td>:</td><td style='text-align:left'>" + dataResult.ctrlnumber + "</td></tr></tr><tr><td style='text-align:left'>Nama Piano </td><td>:</td><td style='text-align:left'>" + dataResult.pianoname + "</td></tr><tr><td style='text-align:left'>Proses Terakhir </td><td>:</td><td style='text-align:left'>" + dataResult.lastprocess + "</td></tr><tr><td style='text-align:left'>Alasan Reset </td><td>:</td><td style='text-align:left'>" + dataResult.reason + "</td></tr></table>",
                                                                showConfirmButton: true,
                                                                allowOutsideClick: false
                                                                // timer: 2000
                                                            });
                                                        } else if (dataResult.statusCode == 201) {
                                                            Swal.fire({
                                                                position: 'center',
                                                                icon: 'error',
                                                                title: 'Reset gagal!',
                                                                showConfirmButton: false,
                                                                timer: 2000
                                                            })
                                                        }
                                                    }
                                                });
                                            }
                                        })
                                    })()
                                }
                            });
                        })()
                    </script>
        <?php
                }
            }
        }
        ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12" style="max-height: 500px;">
        <script>
            $(document).ready(function() {
                $('#reset_serial').DataTable({
                    paging: false,
                    scrollY: '350px',
                    scrollCollapse: true,
                    "dom": '<"wrapper"flipt>'
                });
            });
        </script>
        <table id="reset_serial" class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width: 20%;">Serial Number</th>
                <th style="width: 20%;">A Card</th>
                <th>Piano Name</th>
                <th style="width: 20%;">Reset Date</th>
                <th style="width: 5%;">View</th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql_show = mysqli_query($connect_pro, "SELECT * FROM formng_resethistory");
                while ($data_show = mysqli_fetch_array($sql_show)) {
                    $awal = substr($data_show['c_serialnumber'], 0, 1);
                    $akhir = substr($data_show['c_serialnumber'], 6);
                    $serialnumber = $awal . "*****" . $akhir;
                ?>
                    <tr>
                        <td><?= $serialnumber ?></td>
                        <td><?= $data_show['c_ctrlnumber'] ?></td>
                        <td style="text-align: left;"><?= $data_show['c_pianoname'] ?></td>
                        <td><?= $data_show['c_datetime'] ?></td>
                        <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#sb<?= $data_show['c_serialnumber'] ?>"><i class="fa fa-eye"></i></button></td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="sb<?= $data_show['c_serialnumber'] ?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Reset Finalcheck Information</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-2">
                                        <div class="col-3">Reset Date</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8"><?= $data_show['c_datetime'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">Serial Number</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8"><?= $serialnumber ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">A Card</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8"><?= $data_show['c_ctrlnumber'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">Piano Name</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8"><?= $data_show['c_pianoname'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">Reason</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8"><?= $data_show['c_reason'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">Reset By</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8"><?= $data_show['c_resetby'] ?></div>
                                    </div>
                                    <hr>
                                    <div class="row mb-2">
                                        <div class="col-3">Inside Check</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8"><?= $data_show['c_insideby'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">Outside Check 1</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8"><?= $data_show['c_outside1by'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">Outside Check 2</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8"><?= $data_show['c_outside2by'] ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">Outside Check 3</div>
                                        <div class="col-1">:</div>
                                        <div class="col-8"><?= $data_show['c_outside3by'] ?></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>