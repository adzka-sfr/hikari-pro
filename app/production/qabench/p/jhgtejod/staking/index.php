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

            setInterval(ajaxCall, 500);

            function ajaxCall() {
                $.ajax({
                    url: 'staking/block_check.php',
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 'stock-ng') {
                            $('#statusblock').html(response.message);
                            showBlock();
                            document.onkeydown = function(e) {
                                return false;
                            };
                        } else if (response.status == 'staking-disable') {
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
            <div class="col-8">
                <div class="row">
                    <div class="col-12" style="margin-right: 0px; padding-right: 0px;">
                        <label class="control-label col-md-3 mt-2" for="first-name">GMC</span>
                        </label>
                        <div class="col-md-9">
                            <div id="gmc-lock"></div>
                            <script>
                                $('#gmc-lock').load('staking/getgmc.php').fadeIn("slow");
                                var auto_refresh = setInterval(function() {
                                    $('#gmc-lock').load('staking/getgmc.php').fadeIn("slow");
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
                            <input id="serialbench" autofocus name="serialbench" style="text-align: left; border-radius: 5px;" type="text" class="form-control" placeholder="Serial Number">
                            <div class="row">
                                <div class="col-12 mt-2" id="serialerror" style="display: none;">
                                    <span style="color: red;">Silahkan memasukkan no seri</span>
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
                            $('#hitung').load('staking/hitung.php').fadeIn("slow");
                            var auto_refresh = setInterval(function() {
                                $('#hitung').load('staking/hitung.php').fadeIn("slow");
                            }, 500);
                        </script>
                    </div>
                    <div class="col-6">
                        <button style="width: 90%; height: 55px; " class="btn btn-success" type="button" id="record" name="record">Record <i id="spinner-record" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
                        <button style="width: 90%;" class="btn btn-danger" type="button" id="clear" name="clear">Clear <i id="spinner-clear" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
                        <button style="width: 90%; display: none;" class="btn btn-danger" type="button" id="count" name="count">Count</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#record').click(function() {
                Swal.fire({
                    title: 'Record data?',
                    html: "Data akan masuk ke dalam pre-stock taking<br>(tabel di bawah)",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Record'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#spinner-record').show();
                        $("#record").attr("disabled", true);
                        $.ajax({
                            url: 'staking/record_go.php',
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 'record-berhasil') {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: "Data berhasil direcord",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $("#record").attr("disabled", false);
                                            $('#spinner-record').hide();
                                            // setTimeout(function() {
                                            $('input[name="serialbench"]').focus()
                                            // }, 1000);
                                        }
                                    })
                                } else if (response.status == 'kosong-blok') {
                                    Swal.fire({
                                        title: 'Tidak ada data!',
                                        text: "Silahkan scan sebelum melakukan record",
                                        icon: 'info',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $("#record").attr("disabled", false);
                                            $('#spinner-record').hide();
                                            // setTimeout(function() {
                                            $('input[name="serialbench"]').focus()
                                            // }, 1000);
                                        }
                                    })
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Server busy',
                                        'error'
                                    ).then((result) => {
                                        if (result.isConfirmed) {
                                            $("#record").attr("disabled", false);
                                            $('#spinner-record').hide();
                                            // setTimeout(function() {
                                            $('input[name="serialbench"]').focus()
                                            // }, 1000);
                                        }
                                    })
                                }
                            }
                        });
                    }
                })
            })

            $('#clear').click(function() {
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
                        $('#spinner-clear').show();
                        $("#clear").attr("disabled", true);
                        $.ajax({
                            url: 'staking/clear.php',
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
                                    $("#clear").attr("disabled", false);
                                    $('#spinner-clear').hide();
                                } else if (response.status == 'kosong-blok') {
                                    Swal.fire({
                                        title: 'Tidak ada data!',
                                        text: "Tidak ada yang di reset",
                                        icon: 'info',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    })
                                    $("#clear").attr("disabled", false);
                                    $('#spinner-clear').hide();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Server busy',
                                        'error'
                                    )
                                    $("#clear").attr("disabled", false);
                                    $('#spinner-clear').hide();
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
                            url: 'staking/record.php',
                            type: 'POST',
                            data: {
                                "serial": serial
                            },
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 'masuk') {
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
                                        title: 'Data berhasil dihitung'
                                    });
                                    $('#serialbench').val('');
                                } else if (response.status == 'data-dah-masuk') {
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
                                        title: 'Data sudah pernah discan'
                                    })
                                    $('#serialbench').val('');
                                } else if (response.status == 'bukan-porsi') {
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
                                        title: 'Item tidak terdaftar pada Packing <?= $title_loc ?>'
                                    })
                                    $('#serialbench').val('');
                                } else if (response.status == 'sudah-dipakai') {
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
                                    Swal.fire({
                                        title: 'Ditolak!',
                                        html: response.jenis + ' <b>' + response.info + '</b> seharusnya sudah dipacking!<br><div style="text-align: left; padding-top: 5px;"><span> Info packing: </span><table class = "table"><tr><td>No Seri Piano</td><td>:</td><td>' + response.serialpiano + '</td></tr><tr><td>Nama Piano</td><td>:</td><td>' + response.namepiano + '</td></tr><tr><td>Bench</td><td>:</td><td>' + response.serialbench + '</td></tr><tr><td>User Package</td><td>:</td><td>' + response.serialuserp + '</td></tr><tr><td>Waktu Packing</td><td>:</td><td>' + response.packingdate + '</td></tr></table></div>',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                } else if (response.status == 'tidak') {
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
                                    $('#serialbench').val('');
                                } else if (response.status == 'sudah-st') {
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
                                    Swal.fire(
                                        'Info!',
                                        'Jenis bench sudah dilakukan stock taking pada hari ini',
                                        'info'
                                    )

                                    Toast.fire({
                                        icon: 'error',
                                        title: 'No seri tidak terdaftar'
                                    })
                                } else if (response.status == 'gmc-not-match') {
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
                                    Swal.fire({
                                        title: 'Ditolak!',
                                        html: 'Anda sedang melakukan stock taking<br><b>(' + response.gmc + ') ' + response.nama + '</b><br>selesaikan terlebih dahulu!',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    $('#serialbench').val('');
                                } else {
                                    $('#serialbench').prop("readonly", false);
                                    $('#spinner-serial').hide();
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Server busy!',
                                        icon: 'error',
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


        <div id="table-container"></div>
        <!-- <div class="row">
            <div class="col-12 mb-3">
                <button class="btn btn-info btn-lg" style="width: 100%; cursor: not-allowed;"><i class="fa fa-envelope-o"></i> Laporkan data NG ke management</button>
            </div>
        </div> -->
        <div class="row">
            <div class="col-12">
                <div id="tabele"></div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {

                $('#tabele').load('staking/table_staking.php').fadeIn("slow");

                var auto_refresh = setInterval(function() {
                    $('#tabele').load('staking/table_staking.php').fadeIn("slow");
                }, 1000);

            });
        </script>
        <div class="row">
            <div class="col-6 mb-2">
                <button id="clearst" class="btn btn-danger" style="width: 100%;">Clear tabel stock taking <i id="spinner-clearst" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
            </div>
            <div class="col-6 mb-2">
                <button id="sendst" class="btn btn-primary" style="width: 100%;">Kirim data stock taking <i id="spinner-sendst" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
            </div>
            <script>
                $(document).ready(function() {
                    // button clear
                    $('#clearst').click(function() {
                        Swal.fire({
                            title: 'Hapus semua pehitungan?',
                            text: "Data yang sudah dihitung akan dihapus dan stock taking akan dimulai ulang",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, clear it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#clearst").attr("disabled", true);
                                $('#spinner-clearst').show();
                                $.ajax({
                                    url: 'staking/clearst.php',
                                    success: function(response) {
                                        if (response == 'clear-berhasil') {
                                            Swal.fire(
                                                'Success!',
                                                'Data berhasil dihapus',
                                                'success'
                                            );
                                            $("#clearst").attr("disabled", false);
                                            $('#spinner-clearst').hide();
                                        } else if (response == 'tidak-ada-data') {
                                            Swal.fire(
                                                'Info!',
                                                'Tidak ada data pada tabel stock taking',
                                                'info'
                                            );
                                            $("#clearst").attr("disabled", false);
                                            $('#spinner-clearst').hide();
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                'Server busy',
                                                'error'
                                            );
                                            $("#clearst").attr("disabled", false);
                                            $('#spinner-clearst').hide();
                                        }
                                    }
                                });
                            }
                        })
                    })

                    // button send
                    $('#sendst').click(function() {
                        $.ajax({
                            url: 'staking/check_ng.php',
                            dataType: 'html',
                            success: function(response) {

                                if (response == 'semua-aman') {
                                    // jika sudah oke jalankan alert dibawah ini
                                    Swal.fire({
                                        title: 'Semua data oke!',
                                        text: "Data perhitungan stock taking akan direkam dan akan menjadi riwayat stock taking.",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, send it!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $("#sendst").attr("disabled", true);
                                            $('#spinner-sendst').show();
                                            var statuse = "ok";
                                            $.ajax({
                                                url: 'staking/sendst.php',
                                                type: 'POST',
                                                data: {
                                                    "status": statuse
                                                },
                                                success: function(response) {
                                                    if (response == 'kirim-berhasil') {
                                                        Swal.fire({
                                                            title: 'Success!',
                                                            text: "Data berhasil direkam",
                                                            icon: 'success',
                                                            showCancelButton: false,
                                                            confirmButtonColor: '#3085d6',
                                                            confirmButtonText: 'OK'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = "main.php?page=staking";
                                                            }
                                                        });
                                                    } else if (response == 'tidak-ada-data') {
                                                        Swal.fire(
                                                            'Info!',
                                                            'Tidak ada data pada tabel stock taking',
                                                            'info'
                                                        )
                                                        $("#sendst").attr("disabled", false);
                                                        $('#spinner-sendst').hide();
                                                    } else {
                                                        Swal.fire(
                                                            'Error!',
                                                            'Server busy',
                                                            'error'
                                                        )
                                                        $("#sendst").attr("disabled", false);
                                                        $('#spinner-sendst').hide();
                                                    }
                                                }
                                            });
                                        }
                                    })
                                } else if (response == 'server-error') {
                                    Swal.fire(
                                        'Error!',
                                        'Server busy',
                                        'error'
                                    )
                                    $("#sendst").attr("disabled", false);
                                    $('#spinner-sendst').hide();
                                } else {
                                    // var anjay = html(response);
                                    // jika sudah oke jalankan alert dibawah ini
                                    Swal.fire({
                                        title: 'Terdapat NG!',
                                        html: response,
                                        icon: 'warning',
                                        width: "70%",
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Just send it!',
                                        cancelButtonText: 'Cancel'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $("#sendst").attr("disabled", true);
                                            $('#spinner-sendst').show();
                                            var statuse = "ng";
                                            $.ajax({
                                                url: 'staking/sendst.php',
                                                type: 'POST',
                                                data: {
                                                    "status": statuse
                                                },
                                                success: function(response) {
                                                    if (response == 'kirim-berhasil') {
                                                        Swal.fire({
                                                            title: 'Success!',
                                                            text: "Data berhasil direkam",
                                                            icon: 'success',
                                                            showCancelButton: false,
                                                            confirmButtonColor: '#3085d6',
                                                            confirmButtonText: 'OK'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = "main.php?page=staking";
                                                            }
                                                        });
                                                    } else if (response == 'tidak-ada-data') {
                                                        Swal.fire(
                                                            'Info!',
                                                            'Tidak ada data pada tabel stock taking',
                                                            'info'
                                                        )
                                                        $("#sendst").attr("disabled", false);
                                                        $('#spinner-sendst').hide();
                                                    } else {
                                                        Swal.fire(
                                                            'Error!',
                                                            'Server busy',
                                                            'error'
                                                        )
                                                        $("#sendst").attr("disabled", false);
                                                        $('#spinner-sendst').hide();
                                                    }
                                                }
                                            });
                                        }
                                    })

                                    $("#sendst").attr("disabled", false);
                                    $('#spinner-sendst').hide();
                                }
                            }
                        });


                    })
                });
            </script>
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
    </div>
</div>