<!-- <form method="post" class="form-horizontal form-label-left"> -->
<div class="row">
    <div class="col-12">
        <?php
        // menampilkan judul halaman
        if ($_SESSION['role'] == 'packing up') {
            $title_loc = "UP";
        } elseif ($_SESSION['role'] == 'packing gp') {
            $title_loc = "GP";
        }
        ?>
        <h5>Stock Taking <?= $title_loc ?>
            <hr>
    </div>
</div>
<div class="row">
    <div class="col-7" style="margin-right: 0px; padding-right: 0px;">
        <label class="control-label col-md-4 mt-3" for="first-name">Serial Number</span>
        </label>
        <div class="col-md-8 mt-3">
            <input disabled id="serialbench" autofocus name="serialbench" style="text-align: left; border-radius: 5px;" type="text" class="form-control" placeholder="Serial Number">
            <div class="row">
                <div class="col-12 mt-2" id="serialerror" style="display: none;">
                    <span style="color: red;">Silahkan memasukkan no seri</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1 mt-3" style="padding-left: 0px; margin-left: 0px;">
        <!-- <button id="scanner" class="btn btn-secondary"><i class="fa fa-barcode"></i></button> -->
        <button disabled id="scanner" class="btn btn-secondary"><i class="fa fa-camera-retro"></i></button>
        <button id="scannerhide" class="btn btn-danger" style="display: none;"><i class="fa fa-camera-retro"></i></button>
    </div>
    <div class="col-4 mt-3">
        <button disabled style="width: 90%; " class="btn btn-success" type="button" id="count" name="count">Count</button>
    </div>
</div>
<!-- </form> -->
<script>
    $(document).ready(function() {
        $('#serialbench').focus();
        $('#serialbench').keypress(function(e) {
            if (e.which == 13) {
                $('#count').click();
            }
        });
        $('#count').click(function() {
            var serial = $('#serialbench').val();

            // cek jika belum tulis serial tapi dah enter
            if (serial == '') {
                $('#serialerror').show();
                setTimeout(function() {
                    $('#serialerror').hide()
                }, 3000);
            }
            // jika sudah isi semua
            if (serial != '') {
                $.ajax({
                    url: 'staking/record.php',
                    type: 'POST',
                    data: {
                        "serial": serial
                    },
                    success: function(response) {
                        if (response == 'masuk') {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Data berhasil dihitung'
                            });
                            $('#serialbench').val('');
                        } else if (response == 'data-dah-masuk') {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'warning',
                                title: 'Data sudah pernah discan'
                            })
                        } else if (response == 'tidak') {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: 'No seri tidak terdaftar'
                            })
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Server busy!',
                                type: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            }
        });
    });
</script>
<hr>
<div class="row">
    <div class="col-6 mb-2">
        <button disabled class="btn btn-danger btn-lg" style="width: 100%;">Clear tabel stock taking</button>
    </div>
    <div class="col-6 mb-2">
        <button id="recount" class="btn btn-primary btn-lg" style="width: 100%;">Hitung ulang stock taking</button>
    </div>
    <script>
        $(document).ready(function() {
            // button recount
            $('#recount').click(function() {
                window.location = "main.php?page=staking";
            })
        });
    </script>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <button id="sendemaile" class="btn btn-info btn-lg" style="width: 100%;"><i class="fa fa-envelope-o"></i> Laporkan data NG ke management <i id="spinner-sendemail" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <script>
            $(document).ready(function() {
                // button send email
                $('#sendemaile').click(function() {
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        html: "Setelah pelaporan, semua fitur akan <b>dinonaktifkan</b> sementara hingga proses analisa oleh bagian management selesai",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, report it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#sendemaile").attr("disabled", true);
                            $('#spinner-sendemail').show();
                            $.ajax({
                                url: 'staking/sendemail.php',
                                success: function(response) {
                                    if (response == 'email-berhasil') {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: "Data NG berhasil dikirim ke management",
                                            icon: 'success',
                                            showCancelButton: false,
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location = "main.php?page=staking";
                                            }
                                        });
                                        $("#sendemaile").attr("disabled", false);
                                        $('#spinner-sendemail').hide();
                                    } else if (response == 'sudah-dilaporkan') {
                                        Swal.fire(
                                            'Info!',
                                            'Data stock taking sudah dilaporkan',
                                            'info'
                                        );
                                        $("#sendemaile").attr("disabled", false);
                                        $('#spinner-sendemail').hide();
                                    } else if (response == 'data-kosong') {
                                        Swal.fire(
                                            'Info!',
                                            'Tidak ada data NG yang perlu untuk dilaporkan',
                                            'warning'
                                        );
                                        $("#sendemaile").attr("disabled", false);
                                        $('#spinner-sendemail').hide();
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            'Server busy',
                                            'error'
                                        );
                                        $("#sendemaile").attr("disabled", false);
                                        $('#spinner-sendemail').hide();
                                    }
                                }
                            });
                        }
                    })


                })
            });
        </script>
        <table class="table table-bordered" id="infostaking">
            <thead style="text-align: center;">
                <th>GMC</th>
                <th>Nama Item</th>
                <th>Hasil Stock Taking</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php
                // get data maksimal dulu pada 
                $sql = mysqli_query($connect_pro, "SELECT MAX(c_date) as maks_date FROM qa_staking WHERE c_location = '$_SESSION[role]'");
                $data = mysqli_fetch_array($sql);
                if (!empty($data['maks_date'])) {
                    $tgl = $data['maks_date'];
                } else {
                    // merdeka!
                    $tgl = '1945-08-17 00:00:00';
                }

                // ambil semua data 
                $sql1 = mysqli_query($connect_pro, "SELECT * FROM qa_staking WHERE c_location = '$_SESSION[role]' AND c_date = '$tgl'");
                while ($data1 = mysqli_fetch_array($sql1)) {
                    // memberi atribut berdasarkan status
                    if ($data1['c_status'] == 'OK') {
                        $button = 'success';
                    } elseif ($data1['c_status'] == 'NG') {
                        $button = 'danger';
                    }
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $data1['c_gmc'] ?></td>
                        <td><?= $data1['c_name'] ?></td>
                        <td style="text-align: center; font-size: 18px; font-weight: bold;"><?= $data1['c_qtyactual'] ?></td>
                        <td style="text-align: center;"><button type="button" class="btn btn-outline-<?= $button ?>" style="padding-top: 0px;padding-bottom: 0px; width:100px"><?= $data1['c_status'] ?></button></td>
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
        <hr>
    </div>
</div>

<script>
    // const Toast = Swal.mixin({
    //     toast: true,
    //     position: 'top-end',
    //     showConfirmButton: false,
    //     timer: 2000,
    //     timerProgressBar: true,
    //     didOpen: (toast) => {
    //         toast.addEventListener('mouseenter', Swal.stopTimer)
    //         toast.addEventListener('mouseleave', Swal.resumeTimer)
    //     }
    // })

    // Toast.fire({
    //     icon: 'error',
    //     title: 'Data sudah pernah discan'
    // })
</script>