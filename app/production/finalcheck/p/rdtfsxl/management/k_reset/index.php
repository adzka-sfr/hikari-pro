<div class="row">
    <div class="col-12">
        <h5 id="teksnyagan">
            Halaman Reset Pengecekan Piano
        </h5>
        <hr>
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
    <div class="col-4">
        <!-- ha kosong ?? -->
    </div>
    <div class="col-4">
        <label for="serialnumber">Serial Number :</label>
        <input id="serialnumber" type="text" oninput="this.value=this.value.toUpperCase()" style="text-align: center;" class="form-control" />
        <div id="errorserialnumber" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Serial number harus diisi!</div>
        <div id="errorserialnumber2" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Serial number tidak ditemukan!</div>
    </div>
    <div class="col-4">
        <!-- ha kosong ?? -->
    </div>
</div>
<div class="row">
    <div class="col-12 text-center mt-3">
        <button id="reset" type="button" class="btn btn-danger">Reset <i id="icon-spinner-res" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
        <!-- Modal add ng start -->
        <div class="modal fade" style="text-align: left;" id="tambahng" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- kalau mau scrollable : modal-dialog-scrollable -->
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Piano</h1>
                    </div>
                    <div class="modal-body">
                        <form id="myform">
                            <div class="row">
                                <div class="col-4 mb-1">
                                    <input readonly type="text" class="form-control" id="serialnumberform">
                                </div>
                                <div class="col-8 mb-1">
                                    <input readonly type="text" class="form-control" id="nameform">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <label>Alasan :</label>
                                    <textarea id="reasonform" class="form-control"></textarea>
                                    <div id="errorreason" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Alasan tidak boleh kosong!</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <label for="validationtext">Tulis kembali teks validasi berikut:</label>
                                    <input id="validationtext" class="form-control" onmousedown='return false;' onselectstart='return false;' type="text" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <input id="validationtextform" class="form-control" type="text" placeholder="Tulis teks validasi disini">
                                    <div id="errorrvalidationnull" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Teks validasi tidak boleh kosong!</div>
                                    <div id="errorrvalidationnotmatch" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Teks validasi tidak sama!</div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="canceltambahngbtn" class="btn btn-secondary close-mdl-ng" onclick="cancelbtnmdl()" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="tambahngbtn" onclick="tambahdatang()" class="btn btn-danger">Reset <i id="icon-spinner-add" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal add ng end -->
    </div>
</div>

<script type="text/javascript">
    // function untuk disco text
    let x = document.getElementById("teksnyagan");
    x.style.color = "red";

    function changeColor() {
        x.style.color = x.style.color == "red" ? "black" : "red";
    }
    window.setInterval(changeColor, 200);

    $('#serialnumber').keypress(function(e) {
        if (e.which == 13) {
            $('#reset').click();
        }
    });

    // cek serialnumber (sudah pernah di cek atau belum> sudah selesai cek 3 atau belum, )
    $('#reset').click(function() {
        $('#reset').prop('disabled', true);
        $('#icon-spinner-res').show();
        var serialnumber = $('#serialnumber').val();
        if (serialnumber == '') {
            $('#reset').prop('disabled', false);
            $('#icon-spinner-res').hide();
            // error serialnumber
            // scoll dengan gaya
            document.getElementById('serialnumber').scrollIntoView({
                behavior: 'smooth'
            });
            $('#errorserialnumber').show();
            setTimeout(function() {
                $('#errorserialnumber').hide()
            }, 3000);
        } else {
            $.ajax({
                url: "management/k_reset/reset/check.php",
                type: "POST",
                data: {
                    "serialnumber": serialnumber
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.status == 'berhasil') {
                        $('#tambahng').modal('toggle');
                        $('#serialnumberform').val(data.serialnumberform);
                        $('#nameform').val(data.nameform);
                        $('#validationtext').val(data.validationtext);
                    } else if (data.status == 'not-found') {
                        // error serialnumber
                        // scoll dengan gaya
                        document.getElementById('serialnumber').scrollIntoView({
                            behavior: 'smooth'
                        });
                        $('#errorserialnumber2').show();
                        setTimeout(function() {
                            $('#errorserialnumber2').hide()
                        }, 3000);
                    } else if (data.status == 'closed') {
                        Swal.fire({
                            title: 'Piano sudah closed!',
                            html: 'Status piano <b>Check Card Closed</b>, proses reset tidak bisa dilanjutkan',
                            icon: 'error',
                            // timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonText: 'Oke'
                        })
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data gagal ditambah',
                            icon: 'error',
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonText: 'Oke'
                        })
                    }
                    $('#reset').prop('disabled', false);
                    $('#icon-spinner-res').hide();
                },
                error: function() {
                    $('#reset').prop('disabled', false);
                    $('#icon-spinner-res').hide();
                    lostconnection()
                }
            });
        }
    })

    // reset button
    function tambahdatang() {
        $('#tambahngbtn').prop('disabled', true);
        $('#canceltambahngbtn').prop('disabled', true);
        $('#icon-spinner-add').show();
        var serialnumber = $('#serialnumberform').val();
        var name = $('#nameform').val();
        var reason = $('#reasonform').val();
        var validationtext = $('#validationtext').val();
        var validation = $('#validationtextform').val();
        if (reason == '') {
            $('#tambahngbtn').prop('disabled', false);
            $('#canceltambahngbtn').prop('disabled', false);
            $('#icon-spinner-add').hide();
            // error nama
            // scoll dengan gaya
            document.getElementById('reasonform').scrollIntoView({
                behavior: 'smooth'
            });
            $('#errorreason').show();
            setTimeout(function() {
                $('#errorreason').hide()
            }, 3000);
        } else {
            if (validation == '') {
                $('#tambahngbtn').prop('disabled', false);
                $('#canceltambahngbtn').prop('disabled', false);
                $('#icon-spinner-add').hide();
                // error completeness
                // scoll dengan gaya
                document.getElementById('validationtextform').scrollIntoView({
                    behavior: 'smooth'
                });
                $('#errorrvalidationnull').show();
                setTimeout(function() {
                    $('#errorrvalidationnull').hide()
                }, 3000);
            } else {
                if (validationtext != validation) {
                    $('#tambahngbtn').prop('disabled', false);
                    $('#canceltambahngbtn').prop('disabled', false);
                    $('#icon-spinner-add').hide();
                    // error outside
                    // scoll dengan gaya
                    document.getElementById('validationtextform').scrollIntoView({
                        behavior: 'smooth'
                    });
                    $('#errorrvalidationnotmatch').show();
                    setTimeout(function() {
                        $('#errorrvalidationnotmatch').hide()
                    }, 3000);
                } else {
                    $.ajax({
                        url: "management/k_reset/reset/reset.php",
                        type: "POST",
                        data: {
                            "serialnumber": serialnumber,
                            "name": name,
                            "reason": reason,
                            "validation": validation
                        },
                        success: function(data) {
                            $('#tambahngbtn').prop('disabled', false);
                            $('#canceltambahngbtn').prop('disabled', false);
                            $('#icon-spinner-add').hide();
                            var data = JSON.parse(data);
                            if (data.status == 'berhasil') {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Piano berhasil direset',
                                    icon: 'success',
                                    // timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: true,
                                    confirmButtonText: 'Oke'
                                }).then(function() {
                                    $('.close-mdl-ng').trigger('click');
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Piano gagal direset',
                                    icon: 'error',
                                    showCancelButton: false,
                                    showConfirmButton: true,
                                    confirmButtonText: 'Oke'
                                })
                            }
                        },
                        error: function() {
                            $('#tambahngbtn').prop('disabled', false);
                            $('#canceltambahngbtn').prop('disabled', false);
                            $('#icon-spinner-add').hide();
                            lostconnection()
                        }
                    });
                }
            }
        }
    }

    // cancel button
    function cancelbtnmdl() {
        $('#serialnumberform').val('');
        $('#nameform').val('');
        $('#reasonform').val('');
        $('#validationtextform').val('');
        $('#serialnumber').val('');
    }
</script>