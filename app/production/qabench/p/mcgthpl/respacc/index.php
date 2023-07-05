<div class="row">
    <div class="col-12" style="margin-top: 0px; padding-top: 0px;">
        <h4 id="teksnyagan">Halaman Reset Proses Packing <i class="fa fa-exclamation-triangle"></i></h4>
        <hr>
        <script type="text/javascript">
            let x = document.getElementById("teksnyagan");
            x.style.color = "red";

            function changeColor() {
                x.style.color = x.style.color == "red" ? "#73879C" : "red";
            }
            window.setInterval(changeColor, 500);
        </script>
        <p>Pastikan kembali <b>Serial Number</b> yang akan direset sudah sesuai, proses ini akan menjadikan piano seolah-olah belum terpacking dan item-item yang mengikuti juga akan ikut ter-reset. Data yang akan ter-reset yaitu :

            </br>
        <ol>
            <li>Piano</li>
            <li>Bench*</li>
            <li>User Package*</li>
        </ol><i>* jika ada</i> <br>
        Piano yang telah direset harus diulang untuk proses packing dimulai dari scan A-card piano.
        </p>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-12">
        <h5>Reset per unit</h5>
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
                <button style="width: 100px;" name="reset" id="reset" type="button" class="btn btn-danger">Reset <i id="spinner" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#reset').click(function() {
        var serial = $('#serialnumber').val();
        $.ajax({
            url: "respacc/check.php",
            type: "POST",
            data: {
                serial: serial
            },
            success: function(data) {
                var data = JSON.parse(data);
                if (data.status == "ada") {
                    Swal.fire({
                        title: 'Piano yang akan direset',
                        html: '<table style= "text-align: left;">' +
                            '<tr><td style="padding-top: 5px; padding-bottom: 5px;">Piano Serial</td><td style="padding-left:10px;padding-right:10px;"> : </td><td>' + data.serial + '</td></tr>' +
                            '<tr><td style="padding-top: 5px; padding-bottom: 5px;">Piano Name</td><td style="padding-left:10px;padding-right:10px;"> : </td><td>' + data.name + '</td></tr>' +
                            '<tr><td style="padding-top: 5px; padding-bottom: 5px;">Bench</td><td style="padding-left:10px;padding-right:10px;"> : </td><td>' + data.bench + '</td></tr>' +
                            '<tr><td style="padding-top: 5px; padding-bottom: 5px;">User Package</td><td style="padding-left:10px;padding-right:10px;"> : </td><td>' + data.userp + '</td></tr>' +
                            '<tr><td style="padding-top: 5px; padding-bottom: 5px;">Packing Loc</td><td style="padding-left:10px;padding-right:10px;"> : </td><td>' + data.loc + '</td></tr>' +
                            '<tr><td style="padding-top: 5px; padding-bottom: 5px;">Packing Time</td><td style="padding-left:10px;padding-right:10px;"> : </td><td>' + data.time + '</td></tr>' +
                            '</table><br><hr>' +
                            '<input type="text" id="reason" class="swal2-input"  placeholder="Reason">' +
                            '<input type="hidden" id="serial" class="swal2-input" value="' + data.serial + '">',
                        showCancelButton: true,
                        confirmButtonText: 'Next',
                        showLoaderOnConfirm: true,
                        preConfirm: function() {
                            const reason = $('#reason').val();
                            var remason = $('#reason').val();
                            var serial = $('#serial').val();
                            if (reason == '') {
                                Swal.showValidationMessage(
                                    `Alasan tidak boleh kosong`,
                                );
                            } else {

                                Swal.fire({
                                    title: 'Validasi tindakan',
                                    html: 'Tulis kembali teks berikut<br><b>saya yakin untuk reset piano ' + serial + '</b>' +
                                        '<input type="text" id="valida" class="swal2-input"  placeholder="Validation">',
                                    showCancelButton: true,
                                    confirmButtonText: 'Reset',
                                    showLoaderOnConfirm: true,
                                    preConfirm: function() {
                                        const valida = $('#valida').val();

                                        if (valida != 'saya yakin untuk reset piano ' + serial) {
                                            Swal.showValidationMessage(
                                                `Teks validasi tidak sesuai`,
                                            );
                                        } else {
                                            $("#reset").attr("disabled", true);
                                            $('#spinner').show();
                                            $.ajax({
                                                url: "respacc/resetduar.php",
                                                type: "POST",
                                                data: {
                                                    serialpiano: serial,
                                                    remason: remason
                                                },
                                                success: function(data2) {
                                                    var data2 = JSON.parse(data2);
                                                    if (data2.status == "oke") {
                                                        window.open("respacc/hasilResetpdf.php", "_blank")
                                                        Swal.fire({
                                                            position: 'center',
                                                            icon: 'success',
                                                            title: 'Data berhasil direset',
                                                            showConfirmButton: true,
                                                            allowOutsideClick: true
                                                        });
                                                        $("#reset").attr("disabled", false);
                                                        $('#spinner').hide();
                                                        $('#serialnumber').val('');
                                                    } else {
                                                        Swal.fire({
                                                            position: 'center',
                                                            icon: 'error',
                                                            title: 'Reset gagal!',
                                                            showConfirmButton: true,
                                                            allowOutsideClick: true
                                                        });
                                                        $("#reset").attr("disabled", true);
                                                        $('#spinner').show();
                                                    }
                                                }
                                            });
                                        }
                                    }
                                })
                            }
                        },
                    })

                } else if (data.status == "tidak-ada-data") {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Ditolak!',
                        html: 'No seri tidak dikenali',
                        showConfirmButton: true,
                        allowOutsideClick: true
                        // timer: 2000
                    })
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Server busy!',
                        showConfirmButton: true,
                        allowOutsideClick: true
                        // timer: 2000
                    })
                }
            }
        });
    })
</script>


<div class="row">
    <div class="col-5 mt-2">
        <hr>
    </div>
    <div class="col-2 mt-3" style="text-align: center;">
        <h6>Atau</h6>
    </div>
    <div class="col-5 mt-2">
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h5>Reset serentak</h5>
        <div class="row">
            <div class="col-12" style="text-align: right;">
                <button class="btn btn-success btn-sm" type="button" onclick="all2o()"><i class="fa fa-file-excel-o"></i> Download Template</button>
            </div>
            <script>
                var myWindow;

                function all2o() {
                    myWindow = window.open("respacc/templateReset.php", "_blank");
                    // myWindow = window.open("respacc/hasilReset.php", "_blank");
                    // myWindow = window.open("respacc/hasilResetpdf.php", "_blank");

                    // var myWindow = window.open("respacc/hasilResetpdf.php");
                    // myWindow.focus();
                    // myWindow.onblur = function() {
                    // myWindow.close();
                    // };
                }
            </script>
        </div>
        <!-- <form method="post" enctype="multipart/form-data"> -->
        <div class="row">
            <div class="col-12">
                <input type="hidden" id="idkar" value="<?= $_SESSION['nama'] ?>">
                <input style="border-radius: 5px;" name="fileupload" class="form-control form-control-sm" id="fileupload" type="file">
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-3">

                <button name="resetupload" id="resetupload" type="button" class="btn btn-danger">Upload and Reset <i id="spinnerupload" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
                <button id="lanjut" type="button" class="btn btn-danger" style="display: none;">lanjut</button>

            </div>
        </div>
        <!-- </form> -->
        <script>
            // async function uploadFile() {
            $('#resetupload').click(function() {
                var namefileoria = $('#fileupload').val();
                var idkar = $('#idkar').val();
                if (namefileoria == '') {
                    Swal.fire({
                        title: 'Ditolak',
                        text: 'Tidak ada file untuk di upload',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                } else {
                    Swal.fire({
                        title: 'Validasi tindakan',
                        html: 'Tulis kembali teks berikut<br><b>saya ' + idkar + ' yakin untuk reset piano serentak</b><br>' +
                            '<input style="width: 90%" type="text" id="valida" class="swal2-input"  placeholder="Validation"><br>',
                        showCancelButton: true,
                        confirmButtonText: 'Reset',
                        showLoaderOnConfirm: true,
                        width: '70%',
                        preConfirm: function() {
                            const valida = $('#valida').val();

                            if (valida != 'saya ' + idkar + ' yakin untuk reset piano serentak') {
                                Swal.showValidationMessage(
                                    `Teks validasi tidak sesuai, pastikan huruf besar dan kecil sesuai`,
                                );
                            } else {
                                $('#spinnerupload').show();
                                $('#fileupload').attr("readonly", true);
                                $('#resetupload').attr("disabled", true);
                                $('#lanjut').trigger('click');
                            }
                        }
                    })
                }


                // lanjut kesini jika sudah melewati validasi
                $('#lanjut').click(async function() {
                    var namefileori = $('#fileupload').val();
                    try {
                        let formData = new FormData();

                        var namefile = "uploads/" + namefileori.split("\\").pop();

                        formData.append("file", fileupload.files[0]);

                        const response = await fetch('respacc/upload.php', {
                            method: "POST",
                            body: formData,
                        });

                        if (response.status == 200) {
                            // console.log("oaaaaaak");
                            // console.log(namefile);
                            // jalankan ajax untuk spreadsheet reader
                            $.ajax({
                                url: 'respacc/upload_next.php',
                                type: 'POST',
                                dataType: 'html',
                                data: {
                                    "dir": namefile
                                },
                                success: function(response) {
                                    // var response = JSON.parse(response);
                                    if (response == 'selesai') {
                                        window.open("respacc/hasilResetpdf.php", "_blank")
                                        Swal.fire({
                                            title: 'Selesai!',
                                            text: 'Detail reset dapat dilihat pada file PDF',
                                            icon: 'success',
                                            // timer: 2000,
                                            showConfirmButton: true,
                                            focusConfirm: true
                                        });
                                        $('#spinnerupload').hide();
                                        $('#fileupload').attr("readonly", false);
                                        $('#fileupload').val('');
                                        $('#resetupload').attr("disabled", false);
                                    } else if (response == 'error') {
                                        window.open("respacc/hasilResetpdf.php", "_blank")
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'File yang diupload tidak sesuai',
                                            icon: 'error',
                                            // timer: 2000,
                                            showConfirmButton: true,
                                            focusConfirm: true
                                        });
                                        $('#spinnerupload').hide();
                                        $('#fileupload').attr("readonly", false);
                                        $('#fileupload').val('');
                                        $('#resetupload').attr("disabled", false);
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            html: 'File yang diupload tidak sesuai',
                                            icon: 'error',
                                            // timer: 5000,
                                            showConfirmButton: true,
                                            focusConfirm: true
                                        });
                                        $('#spinnerupload').hide();
                                        $('#fileupload').attr("readonly", false);
                                        $('#resetupload').attr("disabled", false);
                                    }
                                }
                            });
                        } else {
                            console.log("error");
                        }
                    } catch (error) {
                        console.log(error);
                    }
                })
                // }
            })
            // }
        </script>
    </div>
</div>

<hr class="mb-5">