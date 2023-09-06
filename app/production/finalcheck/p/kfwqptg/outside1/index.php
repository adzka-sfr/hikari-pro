<script src="barcode/html5-qrcode.min.js"></script>
<div class="row">
    <div class="col-12">
        <h5>Outside Check 1</h5>
        <hr>
    </div>
</div>

<!-- pengaturan ukuran kotak untuk lokasi titik pada gambar -->
<script>
    var deviceitem = deviceinfo();
    let style = document.createElement('style');
    if (deviceitem == "Windows") {
        style.innerHTML += `
      .ingpo {
        width: 27px;
        height: 27px;
      }
    `;
        document.head.appendChild(style);
    } else if (deviceitem == "Macintosh") {
        style.innerHTML = `
      .ingpo {
        width: 25px;
        height: 25px;
      }
    `;
        document.head.appendChild(style);
    } else if (deviceitem == "Android") {
        style.innerHTML = `
      .ingpo {
        width: 19px;
        height: 19px;
      }
    `;
        document.head.appendChild(style);
    } else {
        style.innerHTML = `
      .ingpo {
        width: 25px;
        height: 25px;
      }
    `;
        document.head.appendChild(style);
    }
</script>
<!-- pengaturan ukuran kotak untuk lokasi titik pada gambar -->

<!-- modal untuk cek koneksi -->
<div class="modal fade" id="lostmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="col-12 modal-title fs-5 text-center" style="color: red;" id="staticBackdropLabel"><img src="<?= base_url('_assets/production/gif/heart.gif') ?>" width="100px"> Koneksi Terputus! <img src="<?= base_url('_assets/production/gif/heart.gif') ?>" width="100px"></h1>
            </div>
            <div class="modal-body" style="font-size: 15px; ">
                Yang harus dilakukan:
                <ol>
                    <li>Pastikan Wifi pada Tab menyala (berwana biru)</li>
                    <li>Pastikan Wifi terhubung dengan jaringan Yijak-Prolt3a</li>
                    <li>Tunggu hingga jaringan kembali stabil</li>
                    <li>Jika sudah terhubung kembali, ulangi kegiatan terakhir anda pada sistem</li>
                </ol>
                Silahkan menghubungi ICTM jika poin 1-3 sudah dilakukan namun tidak kunjung tersambung
            </div>
            <div class="modal-footer">
                <!-- <button type="button" style="display: none;" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <span class="col-12 text-center">
                    <button type="button" disabled class="btn btn-primary">Mencoba terubung kembali...</button>
                </span>
            </div>
        </div>
    </div>
</div>
<script>
    function calltry() {
        var check_con = "connect";
        $.ajax({
            url: '../source/connection_check.php',
            type: 'POST',
            data: {
                "check_con": check_con
            },
            success: function(response) {
                successconnection();
            },
        });
    }

    function lostconnection() {
        $('#lostmodal').modal('toggle');
        setInterval(calltry, 1000);
    }

    function successconnection() {
        clearInterval();
        $('#lostmodal').modal('hide');
    }
</script>
<!-- modal untuk cek koneksi -->

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-6 col-sm-6  form-group has-feedback">
                <input style="border-radius: 5px;" oninput="this.value=this.value.toUpperCase()" type="text" name="acard" id="acard" class="form-control form-control-lg has-feedback-right" placeholder="Serial Number">
                <button id="scanner" class="btn btn-lg btn-secondary form-control-feedback right" style="display: none; padding: 4px; height: max-content;"><i class="fa fa-camera-retro" style="height: 100%;"></i></button>
                <button id="scannerhide" class="btn btn-lg btn-danger form-control-feedback right" style="display: none; padding: 4px; height: max-content;"><i class="fa fa-camera-retro" style="height: 100%;"></i></button>
                <button id="clearacard" class="btn btn-lg btn-danger form-control-feedback right" style="display: none; padding: 4px; height: max-content;"><i class="fa fa-times" style="height: 100%;"></i></button>
                <button id="go" style="display: none;" class="btn btn-success">Go!</button>
                <div class="row">
                    <div class="col-12">
                        <span id="acarderror" style="color: red; display: none;">Silahkan memasukkan no seri terlebih dahulu</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3"></div>
        </div>
    </div>
</div>
<div class="row">
    <div id="pembaca" class="col-12" style="text-align: center; display: none;">
        <center>
            <div id="reader" style=" width: 400px; text-align: center;"></div>
        </center>
    </div>
</div>
<div class="row">
    <div id="loadingacard" class="col-12" style="text-align: center; display: none; ">
        <div class="row">
            <div class="col-12">
                <img src="<?= base_url('_assets/production/images/loading_greys.png') ?>" style="animation: rotation 2s infinite linear;  height:50px" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                Loading
                <!-- <span class="prog-load">0%</span> -->
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="parent-load">
                    <div class="child-load"></div>
                </div>
                <button class="clk-load" id="clk-load-id" style="display: none;">click</button>
            </div>
            <div class="col-4"></div>
        </div> -->
    </div>
</div>


<!-- Modal Edit -->


<!-- untuk mengambil ratio device -->
<script>
    var deviceitem = deviceinfo();
</script>
<!-- untuk mengambil ratio device -->

<!-- untuk menampilkan scanner kamera -->
<script>
    $('#scanner').show();
    $('#scanner').click(function() {
        $('#scanner').hide();
        $('#scannerhide').show();
        $('#pembaca').show();
        $('#acard').attr("readonly", true);

        // Square QR box with edge size = 90% of the smaller edge of the viewfinder.
        let qrboxFunction = function(viewfinderWidth, viewfinderHeight) {
            let minEdgePercentage = 0.6; // 60%
            let minEdgeSize = Math.min(viewfinderWidth, viewfinderHeight);
            let qrboxSize = Math.floor(minEdgeSize * minEdgePercentage);
            return {
                width: 250,
                height: qrboxSize
            };
        }

        // get device info for aspectratio
        if (deviceitem == "Windows") {
            var aspekrasio = 1;
        } else if (deviceitem == "Macintosh") {
            var aspekrasio = 1;
        } else if (deviceitem == "Android") {
            var aspekrasio = 1;
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
            $('#acard').val(decodedText); // DISINI HASIL SCAN BRO
            $('#go').trigger("click");
            $('#scannerhide').hide();
            $('#scanner').show();
            html5QrcodeScanner.clear();
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }

        html5QrcodeScanner.render(onScanSuccess);
    });
    $('#scannerhide').click(function() {
        $('#acard').attr("readonly", false);
        $('#acard').focus();
        $('#scanner').show();
        $('#scannerhide').hide();
        $('#pembaca').hide();
    })
</script>
<!-- untuk menampilkan scanner kamera -->

<!-- untuk aksi setelah acard terisi -->
<script>
    $(document).ready(function() {
        // untuk mengambil data dashboard
        $.ajax({
            url: "outside1/dashboard.php",
            success: function(data) {
                $('#pagedashboard').show();
                $('#pagedashboard').html(data);
            },
            error: function() {
                lostconnection()
            }
        });

        $('#acard').focus();
        $('#acard').keypress(function(e) {
            if (e.which == 13) {
                $('#go').click();
            }
        });

        // klik go -> untuk melanjutkan proses setelah A-card terisi
        $('#go').click(function() {
            $('#scanner').attr("disabled", true);
            $('#loadingacard').show();
            var acard = $('#acard').val();

            // cek jika belum tulis acard tapi dah enter
            if (acard == '') {
                $('#acarderror').show();
                setTimeout(function() {
                    $('#acarderror').hide()
                }, 3000);
                $('#loadingacard').hide();
            }
            // jika sudah isi semua
            if (acard != '') {
                $.ajax({
                    url: 'outside1/check.php',
                    type: 'POST',
                    data: {
                        "acard": acard
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 'tidak-ada') {
                            // jika tidak ada data
                            Swal.fire({
                                title: 'No Seri tidak dikenali!',
                                text: 'Pastikan anda melakukan scan pada QR-Code yang diterbitkan oleh Inside Check',
                                icon: 'error',
                                // timer: 3000,
                                showConfirmButton: true,
                                confirmButtonText: 'Oke',
                            });
                            $('#loadingacard').hide();
                            $('#acard').attr("readonly", false);
                            $('#acard').val('');
                            $('#acard').focus();
                            $('#scanner').attr("disabled", false);
                        } else if (response.status == 'ada') {
                            // load data jika ada data
                            function loadData() {

                                var dataString = {
                                    serialnumber: response.serialnumber,
                                };
                                $.ajax({
                                    url: "outside1/pagedata.php",
                                    type: "POST",
                                    data: dataString,
                                    success: function(data) {
                                        $('#pagedashboard').hide();
                                        $('#pagedata').show();
                                        $('#pagedata').html(data);
                                    },
                                    error: function() {
                                        lostconnection()
                                    }
                                });
                            };
                            loadData();
                        } else if (response.status == 'ada-belum-selesai') {
                            // load data jika ada data dan sudah dicek
                            Swal.fire({
                                title: 'Ada!',
                                text: 'Belum selesai pada inside check',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else if (response.status == 'ada-validasi') {
                            // load data jika ada data dan sudah dicek
                            var dataString = {
                                serialnumber: response.serialnumber
                            };
                            $.ajax({
                                url: "outside1/pagedata3.php",
                                type: "POST",
                                data: dataString,
                                success: function(data) {
                                    $('#pagedashboard').hide();
                                    $('#pagedata').show();
                                    $('#pagedata').html(data);
                                },
                                error: function() {
                                    lostconnection()
                                }
                            });
                        } else if (response.status == 'closed') {
                            // load data jika ada data dan sudah dicek
                            var dataString = {
                                serialnumber: response.serialnumber
                            };
                            $.ajax({
                                url: "outside1/pagedata5.php",
                                type: "POST",
                                data: dataString,
                                success: function(data) {
                                    $('#pagedashboard').hide();
                                    $('#pagedata').show();
                                    $('#pagedata').html(data);
                                },
                                error: function() {
                                    lostconnection()
                                }
                            });
                        } else {
                            // jaringan error
                            Swal.fire({
                                title: 'Error!',
                                text: 'Server busy!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            $('#loadingacard').hide();
                            $('#scanner').attr("disabled", false);
                        }
                    },
                    error: function() {
                        lostconnection()
                    }
                });
            }
        });

        // klik X -> untuk clear acard yang saat ini sekaligus hide pagedata
        $('#clearacard').click(function() {
            $('#acard').val('');
            $('#acard').focus();
            $('#clearacard').hide();
            $('#scanner').show();
            $('#pagedata').hide();
            $('#acard').attr("readonly", false);
            $('#scanner').attr("disabled", false);
            $.ajax({
                url: "outside1/dashboard.php",
                success: function(data) {
                    $('#pagedashboard').show();
                    $('#pagedashboard').html(data);
                },
                error: function() {
                    lostconnection()
                }
            });
        })
    });
</script>
<!-- untuk aksi setelah acard terisi -->



<div class="row">
    <div class="col-12">
        <div style="display: none;" id="pagedata"></div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div style="display: none;" id="pagedashboard"></div>
    </div>
</div>


<script>
    function load_data_ng(serialnumber) {
        $.ajax({
            type: 'POST',
            url: 'outside1/detail_ng.php',
            data: {
                "serialnumber": serialnumber
            },
            success: function(response) {
                // var response = JSON.parse(response);
                $('#detail_ng_loading').hide();
                $('#detail_ng').show();
                $('#detail_ng').html(response);
            },
            error: function() {
                lostconnection()
            }
        });
    }

    function load_data_ngval(serialnumber) {
        $.ajax({
            type: 'POST',
            url: 'outside1/detail_ngval.php',
            data: {
                "serialnumber": serialnumber
            },
            success: function(response) {
                // var response = JSON.parse(response);
                $('#detail_ng_loading').hide();
                $('#detail_ng').show();
                $('#detail_ng').html(response);
            },
            error: function() {
                lostconnection()
            }
        });
    }

    function load_data_ngclose(serialnumber) {
        $.ajax({
            type: 'POST',
            url: 'outside1/detail_ngclose.php',
            data: {
                "serialnumber": serialnumber
            },
            success: function(response) {
                // var response = JSON.parse(response);
                $('#detail_ng_loading').hide();
                $('#detail_ng').show();
                $('#detail_ng').html(response);
            },
            error: function() {
                lostconnection()
            }
        });
    }

    function load_image_ng(serialnumber, codetype) {
        $.ajax({
            type: 'POST',
            url: 'outside1/image_ng.php',
            data: {
                "serialnumber": serialnumber,
                "codetype": codetype
            },
            success: function(response) {
                // var response = JSON.parse(response);
                $('#image_ng_loading').hide();
                $('#image_ng').show();
                $('#image_ng').html(response);
            },
            error: function() {
                lostconnection()
            }
        });
    }

    function load_image_ngclose(serialnumber, codetype) {
        $.ajax({
            type: 'POST',
            url: 'outside1/image_ngclose.php',
            data: {
                "serialnumber": serialnumber,
                "codetype": codetype
            },
            success: function(response) {
                // var response = JSON.parse(response);
                $('#image_ng_loading').hide();
                $('#image_ng').show();
                $('#image_ng').html(response);
            },
            error: function() {
                lostconnection()
            }
        });
    }

    function tambahdatang() {
        // cek apakah isi sudah ada semua
        var ising = $('#ngAdd').val();
        var isicab = $('#cabAdd').val();
        // console.log(ising);
        // console.log(isicab);
        if (ising == null) {
            // error ng
            console.log(ising);
            document.getElementById('ngAdd').scrollIntoView({
                behavior: 'smooth'
            });
            $('#errorng').show();
            setTimeout(function() {
                $('#errorng').hide()
            }, 3000);
        } else {
            if (isicab == '') {
                // error cabinet
                console.log(isicab);
                document.getElementById('cabAdd').scrollIntoView({
                    behavior: 'smooth'
                });
                $('#errorcab').show();
                setTimeout(function() {
                    $('#errorcab').hide()
                }, 3000);
            } else {
                $('.tambahngsu').attr('readonly', true);
                // $('input[type=checkbox]').attr('readonly', true);
                $('#tambahngbtn').attr('disabled', true);
                $('#canceltambahngbtn').attr('disabled', true);
                $('#icon-spinner-add').show();
                var isi = $('#myform').serializeArray();
                console.log(isi);
                $.ajax({
                    type: 'POST',
                    url: 'outside1/data3.php',
                    data: isi,
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 'berhasil') {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'NG berhasil ditambahkan',
                                icon: 'success',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            }).then(function() {
                                load_data_ng(serialnumber);
                                load_image_ng(serialnumber, codetype);
                                $('.tambahngsu').attr('readonly', false);
                                // $('input[type=checkbox]').attr('readonly', false);
                                $('#tambahngbtn').attr('disabled', false);
                                $('#canceltambahngbtn').attr('disabled', false);
                                $('#icon-spinner-add').hide();
                                $('.close-mdl-ng').trigger('click');

                            });

                        } else if (response.status == 'ng-sudah-ada') {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'NG sudah ada dalam list, silahkan melakukan update pada tabel jika akan menambah kabinet atau menambah lokasi NG',
                                icon: 'error',
                                // timer: 2000,
                                showConfirmButton: false,
                                showCancelButton: true,
                                cancelButtonColor: '#5D646B',
                                cancelButtonText: 'Oke',
                            })
                            $('.tambahngsu').attr('readonly', false);
                            // $('input[type=checkbox]').attr('readonly', false);
                            $('#tambahngbtn').attr('disabled', false);
                            $('#canceltambahngbtn').attr('disabled', false);
                            $('#icon-spinner-add').hide();
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'error!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $('.tambahngsu').attr('readonly', false);
                            // $('input[type=checkbox]').attr('readonly', false);
                            $('#tambahngbtn').attr('disabled', false);
                            $('#canceltambahngbtn').attr('disabled', false);
                            $('#icon-spinner-add').hide();
                        }
                    },
                    error: function() {
                        lostconnection()
                    }
                });
            }
        }
    }

    function editdatang() {
        var isicab = $('#cabedit').val();
        if (isicab == '') {
            console.log(isicab);
            document.getElementById('cabedit').scrollIntoView({
                behavior: 'smooth'
            });
            $('#errorcabedit').show();
            setTimeout(function() {
                $('#errorcabedit').hide()
            }, 3000);
        } else {
            $('.tambahngsu').attr('readonly', true);
            $('#editdatangbtn').attr('disabled', true);
            $('#canceldatangbtn').attr('disabled', true);
            $('#icon-spinner-edit').show();
            var isi = $('#myformedit').serializeArray();
            console.log(isi);
            $.ajax({
                type: 'POST',
                url: 'outside1/data7.php',
                data: isi,
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 'berhasil') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'NG berhasil edit',
                            icon: 'success',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        }).then(function() {
                            load_data_ng(serialnumber);
                            load_image_ng(serialnumber, codetype);
                            $('.tambahngsu').attr('readonly', false);
                            $('#editdatangbtn').attr('disabled', false);
                            $('#canceldatangbtn').attr('disabled', false);
                            $('#icon-spinner-edit').hide();
                            $('.close-mdl-ng').trigger('click');
                        });

                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'error!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $('.tambahngsu').attr('readonly', false);
                        $('#editdatangbtn').attr('disabled', false);
                        $('#canceldatangbtn').attr('disabled', false);
                        $('#icon-spinner-edit').hide();
                    }
                },
                error: function() {
                    lostconnection()
                }
            });
        }
    }

    function deleteng(id, serialnumber, codeng, numberng, process) {
        Swal.fire({
            title: 'Apakah anda yakin ?',
            icon: 'question',
            html: 'Data pengecekan akan dihapus',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'outside1/data8.php',
                    type: 'POST',
                    data: {
                        "serialnumber": serialnumber,
                        "codeng": codeng,
                        "numberng": numberng,
                        "process": process
                    },
                    success: function(response) {
                        load_data_ng(serialnumber);
                        load_image_ng(serialnumber, codetype);
                        var response = JSON.parse(response);
                        if (response.status == 'OK') {
                            Swal.fire({
                                title: 'Berhasil!',
                                icon: 'success',
                                html: 'Data berhasil dihapus',
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Oke',
                                cancelButtonText: 'Tidak'
                            })
                        } else if (response.status == 'GAGAL') {
                            Swal.fire({
                                title: 'Gagal!',
                                icon: 'error',
                                html: 'Tidak ada data yang bisa dihapus',
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Oke',
                                cancelButtonText: 'Tidak'
                            })
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                icon: 'error',
                                html: 'Data gagal dihapus',
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Oke',
                                cancelButtonText: 'Tidak'
                            })
                        }
                    },
                    error: function() {
                        lostconnection()
                    }
                });
            }
        });
    }

    function cancelbtnmdl() {
        $('#ngAdd').val('').trigger('change');
        $('#cabAdd').val('').trigger('change');
        $('#myform input[type="checkbox"]').prop('checked', false);
    }

    function cekbokvalo(id, serialnumber, codeng, process) {
        if ($('#' + id).is(':checked')) {
            console.log('Y');
            result = 'Y';
        } else {
            console.log('N');
            result = 'N';
        }
        console.log(id);
        console.log(serialnumber);
        console.log(codeng);
        console.log(process);
        $.ajax({
            type: 'POST',
            url: 'outside1/data13.php',
            data: {
                "serialnumber": serialnumber,
                "codeng": codeng,
                "process": process,
                "result": result
            },
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 'berhasil') {
                    $('#sendfinisho').attr('disabled', true);
                    console.log(response.status);
                } else if (response.status == 'berhasil-clear') {
                    $('#sendfinisho').attr('disabled', false);
                    console.log(response.status);
                } else {
                    console.log('gagal');
                }
            },
            error: function() {
                lostconnection()
            }
        });
    }
</script>
<!-- untuk menampilkan page data -->
<script>

</script>
<!-- untuk menampilkan page data -->