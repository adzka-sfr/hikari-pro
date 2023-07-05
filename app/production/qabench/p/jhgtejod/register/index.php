<!-- <form method="post" class="form-horizontal form-label-left"> -->
<script src="barcode/html5-qrcode.min.js"></script>
<div class="row">
    <div class="col-12">
        <!-- BLOCK CONTENT -->
        <div class="block-content" style="background-color:#263238 ; display: none;">
            <div class="blink" style="padding-top: 10%; padding-left: 1%; color: #FF3C41;  ">
                <h2 style="font-size: 30px;">Akses dimatikan</h2>
                <h2 style="font-size: 60px;"><i class="fa fa-exclamation-triangle"></i></h2>
                <h2 id="statusblock" style="font-size: 40px;">Checking...</h2>
            </div>
        </div>
        <script>
            // cek kondisi untuk block konten
            $(document).ready(function() {
                showBlock();
            });

            setInterval(ajaxCall, 2000);

            function ajaxCall() {
                $.ajax({
                    url: 'register/block_check.php',
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 'stock-ng') {
                            $('#statusblock').html(response.message);
                            showBlock();
                            document.onkeydown = function(e) {
                                return false;
                            };
                        } else if (response.status == 'register-disable') {
                            $('#statusblock').html(response.message);
                            showBlock();
                            document.onkeydown = function(e) {
                                return false;
                            };
                        } else if (response.status == 'oke') {
                            hideBlock();
                            document.onkeydown = function(e) {
                                return true;
                            };
                        }
                    }
                });
            }
        </script>
        <!-- BLOCK CONTENT -->
        <div class="row">

            <div class="col-12">

                <h5>Register Bench / User Package -
                    <?php
                    if ($_SESSION['role'] == 'packing up') {
                        echo "Packing UP";
                    } elseif ($_SESSION['role'] == 'packing gp') {
                        echo "Packing GP";
                    }
                    ?>
                    <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-12" style="margin-right: 0px; padding-right: 0px;">
                        <label class="control-label col-md-3 mt-2" for="first-name">GMC</span>
                        </label>
                        <div class="col-md-9">
                            <div id="gmc-lock"></div>
                            <script>
                                $('#gmc-lock').load('register/getgmc.php').fadeIn("slow");
                                var auto_refresh = setInterval(function() {
                                    $('#gmc-lock').load('register/getgmc.php').fadeIn("slow");
                                }, 500);
                            </script>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="margin-right: 0px; padding-right: 0px;">
                        <label class="control-label col-md-3 mt-4" for="first-name">Serial Number</span>
                        </label>
                        <div class="col-md-7 mt-3" style="padding-left: 0px;">
                            <input autofocus required id="serialbench" name="serialbench" style="text-align: left; border-radius: 5px;" type="text" class="form-control" placeholder="Serial Number">
                            <div class="row">
                                <div class="col-12 mt-2" id="serialerror" style="display: none;">
                                    <span style="color: red;">Silahkan memasukkan no seri bench / user package</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 mt-3" style="padding-left: 0px; margin-left: 0px;">
                            <h2><i id="spinner-serial" class="fa fa-spin fa-spinner" style="display: none;"></i></h2>
                        </div>
                        <div class="col-md-1 mt-3" style="padding-left: 0px; margin-left: 0px;">
                            <button id="scanner" class="btn btn-secondary" style="display: none;"><i class="fa fa-camera-retro"></i></button>
                            <button id="scannerhide" class="btn btn-danger" style="display: none;"><i class="fa fa-camera-retro"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-6">
                        <div id="hitung"></div>
                        <script>
                            $('#hitung').load('register/hitung.php').fadeIn("slow");
                            var auto_refresh = setInterval(function() {
                                $('#hitung').load('register/hitung.php').fadeIn("slow");
                            }, 500);
                        </script>
                    </div>
                    <div class="col-6">
                        <button style="width: 100%; " class="btn btn-success" type="button" id="preRegister" name="register">Pre-register <i id="spinner-preRegister" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
                        <button style="width: 100%; display: none;" class="btn btn-success" type="button" id="count" name="count">Count</button>
                        <button style="width: 100%; " class="btn btn-danger" type="button" id="preReset" name="reset">Reset <i id="spinner-preReset" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#preRegister').click(function() {
                Swal.fire({
                    title: 'Record data?',
                    html: "Data akan masuk ke dalam pre-register<br>(tabel di bawah)",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Record'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#spinner-preRegister').show();
                        $("#preRegister").attr("disabled", true);
                        $.ajax({
                            url: 'register/record_go.php',
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 'record-berhasil') {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: "Data berhasil masuk pre-register",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    })
                                    $("#preRegister").attr("disabled", false);
                                    $('#spinner-preRegister').hide();
                                } else if (response.status == 'kosong-blok') {
                                    Swal.fire({
                                        title: 'Tidak ada data!',
                                        text: "Silahkan scan sebelum melakukan pre-register",
                                        icon: 'info',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    })
                                    $("#preRegister").attr("disabled", false);
                                    $('#spinner-preRegister').hide();
                                    $('#serialbench').focus();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Server busy',
                                        'error'
                                    )
                                    $("#preRegister").attr("disabled", false);
                                    $('#spinner-preRegister').hide();
                                }
                            }
                        });
                    }
                })
            })

            $('#preReset').click(function() {
                Swal.fire({
                    title: 'Reset data?',
                    html: "No seri yang sudah di scan akan di reset",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Reset'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#spinner-preReset').show();
                        $("#preReset").attr("disabled", true);
                        $.ajax({
                            url: 'register/clear.php',
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 'clear-berhasil') {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: "Data berhasil direset",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    })
                                    $("#preReset").attr("disabled", false);
                                    $('#spinner-preReset').hide();
                                } else if (response.status == 'kosong-blok') {
                                    Swal.fire({
                                        title: 'Tidak ada data!',
                                        text: "Tidak ada yang di reset",
                                        icon: 'info',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    })
                                    $("#preReset").attr("disabled", false);
                                    $('#spinner-preReset').hide();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Server busy',
                                        'error'
                                    )
                                    $("#preReset").attr("disabled", false);
                                    $('#spinner-preReset').hide();
                                }
                            }
                        });
                    }
                })
            })
        </script>
        <div class="row">
            <div id="pembaca" class="col-12" style="text-align: center; display: none;">
                <center>
                    <div id="reader" style=" width: 400px; text-align: center;"></div>
                </center>
            </div>
        </div>
        <!-- </form> -->
        <script>
            var deviceitem = deviceinfo();
        </script>
        <script>
            $('#scanner').show();
            $('#scanner').click(function() {
                $('#scanner').hide();
                $('#scannerhide').show();
                $('#pembaca').show();

                // Square QR box with edge size = 90% of the smaller edge of the viewfinder.
                let qrboxFunction = function(viewfinderWidth, viewfinderHeight) {
                    let minEdgePercentage = 0.9; // 90%
                    let minEdgeSize = Math.min(viewfinderWidth, viewfinderHeight);
                    let qrboxSize = Math.floor(minEdgeSize * minEdgePercentage);
                    return {
                        width: 350,
                        height: qrboxSize
                    };
                }

                // get device info for aspectratio
                if (deviceitem == "Windows") {
                    var aspekrasio = 2.9;
                } else if (deviceitem == "Macintosh") {
                    var aspekrasio = 0.3;
                } else if (deviceitem == "Android") {
                    var aspekrasio = 0.3;
                }

                let config = {
                    qrbox: qrboxFunction,
                    aspectRatio: aspekrasio,
                    rememberLastUsedCamera: true,
                    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                };
                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", config);

                var hasil = 0;

                function onScanSuccess(decodedText, decodedResult) {
                    // Handle on success condition with the decoded text or result.
                    hasil = decodedText;
                    $('#pembaca').show();
                    $('#serialbench').val(decodedText);
                    $('#count').trigger("click");

                    // $('#scannerhide').hide();
                    // $('#scanner').show();
                    // html5QrcodeScanner.clear();
                    // ^ this will stop the scanner (video feed) and clear the scan area.
                }

                html5QrcodeScanner.render(onScanSuccess);
            });
            $('#scannerhide').click(function() {
                $('#scanner').show();
                $('#scannerhide').hide();
                $('#pembaca').hide();
            })
        </script>
        <script>
            $(document).ready(function() {
                // $('#serialbench').focus();
                $('#serialbench').keypress(function(e) {
                    if (e.which == 13) {
                        $('#count').click();
                    }
                });
                $('#count').click(function() {
                    $('#serialbench').prop("readonly", true);
                    $('#spinner-serial').show();
                    var serial = $('#serialbench').val();

                    // cek jika belum tulis serial tapi dah enter
                    if (serial == '') {
                        $('#serialerror').show();
                        setTimeout(function() {
                            $('#serialerror').hide()
                        }, 3000);
                        $('#serialbench').prop("readonly", false);
                        $('#spinner-serial').hide();
                    }
                    // jika sudah isi semua
                    if (serial != '') {
                        $.ajax({
                            url: 'register/record.php',
                            type: 'POST',
                            data: {
                                "serial": serial
                            },
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 'sudah-input') {
                                    $('#serialbench').val('');
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
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
                                        title: 'Data berhasil masuk<br>pada pre-register'
                                    });
                                } else if (response.status == 'sudah-register') {
                                    $('#serialbench').val("");
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
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
                                        title: 'Data sudah berada <br>pada pre-register'
                                    })
                                } else if (response.status == 'tidak-terdaftar') {
                                    $('#serialbench').val("");
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
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
                                } else if (response.status == 'sudah-terdaftar') {
                                    $('#serialbench').val("");
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
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
                                        icon: 'info',
                                        title: 'No seri sudah terdaftar'
                                    })
                                } else if (response.status == 'sudah-dipacking') {
                                    $('#serialbench').val("");
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
                                    Swal.fire({
                                        title: 'Ditolak!',
                                        html: response.jenis + ' <b>' + response.info + '</b> seharusnya sudah dipacking!<br><div style="text-align: left; padding-top: 5px;"><span> Info packing: </span><table class = "table"><tr><td>No Seri Piano</td><td>:</td><td>' + response.serialpiano + '</td></tr><tr><td>Nama Piano</td><td>:</td><td>' + response.namepiano + '</td></tr><tr><td>Bench</td><td>:</td><td>' + response.serialbench + '</td></tr><tr><td>User Package</td><td>:</td><td>' + response.serialuserp + '</td></tr><tr><td>Waktu Packing</td><td>:</td><td>' + response.packingdate + '</td></tr></table></div>',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                } else if (response.status == 'gmc-not-match') {
                                    $('#serialbench').val("");
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
                                    Swal.fire({
                                        title: 'Ditolak!',
                                        html: 'Anda sedang melakukan pre-register<br><b>(' + response.gmc + ') ' + response.nama + '</b><br>selesaikan terlebih dahulu!',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    $('#serialbench').val("");
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
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
        <br>
        <div class="row">
            <div class="col-8">
                <!-- tabel -->
                <div id="tabele"></div>
                <!-- tabel -->

                <script type="text/javascript">
                    $(document).ready(function() {

                        $('#tabele').load('register/table_preregister.php').fadeIn("slow");

                        var auto_refresh = setInterval(function() {
                            $('#tabele').load('register/table_preregister.php').fadeIn("slow");
                        }, 1000);

                    });
                </script>
            </div>
            <div class="col-4">
                <div class="row-12 text-center mb-3">
                    <button class="btn btn-primary btn-lg" style="width: 100%;" id="register">Register</button>
                </div>
                <div class="row-12 text-center">
                    <button class="btn btn-danger btn-sm" style="width: 100%;" id="cancelRegister">Cancel Pre-register</button>
                </div>
                <script>
                    $(document).ready(function() {
                        // button register
                        $('#register').click(function() {
                            Swal.fire({
                                title: 'Apakah anda yakin?',
                                text: "Data pada pre-register akan disimpan ke stock bench",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, save it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#register").attr("disabled", true);
                                    $('#spinner').show();
                                    $.ajax({
                                        url: 'register/register.php',
                                        success: function(response) {
                                            if (response == 'register-berhasil') {
                                                Swal.fire(
                                                    'Success!',
                                                    'Data berhasil disimpan',
                                                    'success'
                                                )
                                                $("#register").attr("disabled", false);
                                                $('#spinner').hide();
                                            } else if (response == 'tidak-ada-data') {
                                                Swal.fire(
                                                    'Info!',
                                                    'Tidak ada data pada pre-register',
                                                    'info'
                                                )
                                                $("#register").attr("disabled", false);
                                                $('#spinner').hide();
                                            } else {
                                                Swal.fire(
                                                    'Error!',
                                                    'Data gagal disimpan',
                                                    'error'
                                                )
                                                $("#register").attr("disabled", false);
                                                $('#spinner').hide();
                                            }
                                        }
                                    });
                                }
                            })
                        })

                        // button cancel
                        $('#cancelRegister').click(function() {
                            Swal.fire({
                                title: 'Hapus semua data<br>pre-register?',
                                text: "Proses scan harus diulang dari awal",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: 'register/delete_preg.php',
                                        success: function(response) {
                                            if (response == 'hapus-berhasil') {
                                                Swal.fire(
                                                    'Success!',
                                                    'Data berhasil dihapus',
                                                    'success'
                                                )
                                            } else if (response == 'tidak-ada-data') {
                                                Swal.fire(
                                                    'Info!',
                                                    'Tidak ada data pada pre-register',
                                                    'info'
                                                )
                                            } else {
                                                Swal.fire(
                                                    'Error!',
                                                    'Data gagal disimpan',
                                                    'error'
                                                )
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
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
</div>