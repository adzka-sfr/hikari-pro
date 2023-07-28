<?php
// get connection
require '../config.php';

// aktif ketika data ditemukan dari file check.php
// get data lemparan
$acard = isset($_POST['acard']) ? $_POST['acard'] : '';
$plannumber = isset($_POST['plannumber']) ? $_POST['plannumber'] : '';
$pianoserial = isset($_POST['pianoserial']) ? $_POST['pianoserial'] : '';
$pianogmc = isset($_POST['pianogmc']) ? $_POST['pianogmc'] : '';
$pianoname = isset($_POST['pianoname']) ? $_POST['pianoname'] : '';

// get tanggal register
$q1 = mysqli_query($connect_pro, "SELECT c_register FROM finalcheck_timestamp WHERE c_serialnumber = '$pianoserial'");
$d1 = mysqli_fetch_array($q1);
$register_date = date('l, d M Y  c', strtotime($d1['c_register']));
?>

<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- judul pagedata -->
<hr>
<h4><i class="fa fa-pencil-square-o"></i> <u>Check Card</u></h4>
<!-- judul pagedata -->

<!-- judul -->
<table class="table table-bordered" style="font-size: large;">
    <thead>
        <th>
            <div class="row">
                <div class="col-12">
                    No Seri:
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <?= $pianoserial ?>
                    <input type="hidden" id="serialnumber" value="<?= $pianoserial ?>">
                </div>
            </div>
        </th>
        <th>
            <div class="row">
                <div class="col-12">
                    Model:
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <?= $pianoname ?>
                </div>
            </div>
        </th>
        <th>
            <div class="row">
                <div class="col-12">
                    Inspection Date:
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <?= $register_date ?>
                </div>
            </div>
        </th>
    </thead>
</table>
<!-- judul -->

<!-- stamp -->
<table class="table table-bordered" style="margin-top: 0px;">
    <tr style="text-align: center;">
        <td style="padding-top: 15px; padding-bottom: 15px; width: 50%; height: 80px;">
            <h5 style="position: absolute; opacity: 30%;">QC REJECT</h5>

        </td>
        <td style="padding-top: 15px; padding-bottom: 15px; width: 50%; height: 80px;">
            <h5 style="position: absolute; opacity: 30%;">QC PASS</h5>

        </td>
    </tr>
    <tr>
        <td>Date: -</td>
        <td>Date: -</td>
    </tr>
</table>
<!-- stamp -->

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
            url: 'insidecheck/connection_check.php',
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

<!-- formulir cek inside -->
<table class="table table-bordered">
    <thead style="text-align: center;">
        <th>No</th>
        <th>Item</th>
        <th colspan="3">Hasil Cek</th>
    </thead>
    <tbody>
        <?php
        $no = 0;
        $sql = mysqli_query($connect_pro, "SELECT a.c_code_incheck, a.c_result, b.c_detail FROM finalcheck_fetch_inside a INNER JOIN finalcheck_list_incheck b ON a.c_code_incheck = b.c_code_incheck WHERE a.c_serialnumber = '$pianoserial' ORDER BY b.c_seq ASC");
        while ($data = mysqli_fetch_array($sql)) {
            $no++;
            if ($data['c_result'] == 'OK') {
                $ok = 'checked';
                $ng = '';
                $selectdis = 'disabled';
            } elseif ($data['c_result'] == 'NG') {
                $ok = '';
                $ng = 'checked';
                $selectdis = '';
            } else {
                $ok = '';
                $ng = '';
                $selectdis = 'disabled';
            }
        ?>
            <tr>
                <input type="hidden" id="awalstatus<?= $no ?>" value="<?= $data['c_result'] ?>">
                <input type="hidden" id="item<?= $no ?>" value="<?= $data['c_code_incheck'] ?>">
                <td rowspan="2" style="text-align: center;"><?= $no ?></td>
                <td rowspan="2" style="font-size: 15px;"><?= $data['c_detail'] ?></td>

                <td style="text-align: center; font-size: 15px;">OK</td>
                <td colspan="2">
                    <input type="radio" <?= $ok ?> style=" transform: scale(2); margin: 10px;" id="pilok<?= $no ?>" name="pil<?= $no ?>" onchange="radiocek(this.id,'ngcode<?= $no ?>','item<?= $no ?>')" value="OK" />
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-size: 15px;">NG</td>
                <td>
                    <input type="radio" <?= $ng ?> style=" transform: scale(2); margin: 10px;" id="pilng<?= $no ?>" name="pil<?= $no ?>" onchange="radiocek(this.id,'ngcode<?= $no ?>','item<?= $no ?>')" value="NG" />
                </td>

                <td><select class="halodecktot" style="width: 95%;" id="ngcode<?= $no ?>" onchange="selectcek(this.id,'item<?= $no ?>')" multiple="multiple" required <?= $selectdis ?>>
                        <?php
                        $sql1 = mysqli_query($connect_pro, "SELECT a.c_code_ng AS c_code_ng, a.c_name AS c_name, b.c_code_ng AS res FROM finalcheck_list_ng a LEFT JOIN finalcheck_fetch_inside b ON a.c_group = b.c_code_incheck  WHERE a.c_group = '$data[c_code_incheck]' AND b.c_serialnumber = '$pianoserial'");

                        while ($data1 = mysqli_fetch_array($sql1)) {
                            $selecng = '';
                            if ($data1['res'] != '') {
                                $selng = explode('/', $data1['res']);
                                foreach ($selng as $val) {
                                    if ($data1['c_code_ng'] == $val) {
                                        $selecng = 'selected';
                                    }
                                }
                            }
                        ?>
                            <option <?= $selecng ?> value="<?= $data1['c_code_ng'] ?>"><?= $data1['c_name'] ?></option>
                        <?php
                            $selecng = '';
                        }
                        ?>
                    </select></td>
            </tr>
        <?php
        }
        ?>
        <script>
            function radiocek(id, ngcode, item) {
                console.log(id)
                if ($('#' + id).is(':checked')) {
                    if ($('#' + id).val() == 'NG') {
                        $('#' + ngcode).attr('disabled', false);
                    }
                    if ($('#' + id).val() == 'OK') {
                        $('#' + ngcode).attr('disabled', true);
                        $('#' + ngcode).val('').trigger('change');
                    }
                }
                var serialnumber = $('#serialnumber').val();
                var res = $('#' + id).val();
                var code = $('#' + item).val();

                $.ajax({
                    url: 'insidecheck/data.php',
                    type: 'POST',
                    data: {
                        "serialnumber": serialnumber,
                        "code": code,
                        "res": res
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function() {
                        lostconnection()
                    }
                });
            }

            function selectcek(id, item) {
                console.log($('#' + id).val())
                var serialnumber = $('#serialnumber').val();
                var code = $('#' + item).val();
                var ngcode = $('#' + id).val();
                // console.log(ngcode);
                $.ajax({
                    url: 'insidecheck/data2.php',
                    type: 'POST',
                    data: {
                        "serialnumber": serialnumber,
                        "code": code,
                        "ngcode": ngcode
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function() {
                        lostconnection()
                    }
                });
            }
        </script>
    </tbody>
</table>
<div class="row">
    <div class="col-12">
        <blink>
            <h5 style="color: red;">Jangan lupa cek kembali untuk poin No. 23, 35, 36</h5>
        </blink>
    </div>
</div>
<!-- note inside -->
<div class="row">
    <div class="col-12">
        <h5>Note</h5>
        <textarea name="note" id="note" rows="5" style="width: 100%;"></textarea>
    </div>
    <script>
        $(document).ready(function() {
            var serialnumber = $('#serialnumber').val();
            var note = $('#note').val();
            var stat = 'select';
            $.ajax({
                url: 'insidecheck/data3.php',
                type: 'POST',
                data: {
                    "serialnumber": serialnumber,
                    "note": note,
                    "stat": stat
                },
                success: function(response) {
                    $('#note').html(response);
                }
            });
        })

        $('#note').blur(function() {
            var serialnumber = $('#serialnumber').val();
            var note = $('#note').val();
            var stat = 'update';
            $.ajax({
                url: 'insidecheck/data3.php',
                type: 'POST',
                data: {
                    "serialnumber": serialnumber,
                    "note": note,
                    "stat": stat
                },
                success: function(response) {
                    $('#note').html(response);
                }
            });
        })
    </script>
</div>

<hr>

<div class="row">
    <div class="col-12 mb-5" style="text-align: center;">
        <button class="btn btn-success" id="check">Send to Repair <i id="icon-spinner" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
        <button class="btn btn-success" id="send" style="display: none;">Send to Repair official</button>
        <script>
            $('#check').click(function() {
                $('#check').attr('disabled', true);
                $('#icon-spinner').show();
                var serialnumber = $('#serialnumber').val();
                $.ajax({
                    url: 'insidecheck/data4.php',
                    type: 'POST',
                    data: {
                        "serialnumber": serialnumber
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status != 'OK') {
                            Swal.fire({
                                title: 'NG belum dipilih!',
                                icon: 'error',
                                html: '<div style="text-align: left">Item :<br>' + response.info + '</div>',
                                showConfirmButton: false,
                                showCancelButton: true,
                                cancelButtonColor: '#5D646B',
                                cancelButtonText: 'Oke',
                            })
                            $('#check').attr('disabled', false);
                            $('#icon-spinner').hide();
                        } else {
                            $('#send').trigger('click');
                        }

                    }
                });
            })

            $('#send').click(function() {
                Swal.fire({
                    title: 'Apakah anda yakin ?',
                    icon: 'question',
                    html: 'Data akan diteruskan ke bagian repair inside jika terdapat NG',
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var serialnumber = $('#serialnumber').val();
                        $.ajax({
                            url: 'insidecheck/data5.php',
                            type: 'POST',
                            data: {
                                "serialnumber": serialnumber
                            },
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 'OK') {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        icon: 'success',
                                        html: 'Data berhasil dikirim ke repair',
                                        showCancelButton: false,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Oke',
                                        cancelButtonText: 'Tidak'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('#check').attr('disabled', false);
                                            $('#icon-spinner').hide();
                                            $('#clearacard').trigger('click');
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        icon: 'error',
                                        html: 'Data gagal dikirim, silahkan menghubungi ICTM',
                                        showCancelButton: false,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Oke',
                                        cancelButtonText: 'Tidak'
                                    });
                                    $('#check').attr('disabled', false);
                                    $('#icon-spinner').hide();
                                }

                            }
                        });
                    }
                });
            })
        </script>
    </div>
</div>
<hr>
<!-- script tambahan -->
<script>
    // sudah selesai load baru disable loading
    $('#acard').attr("readonly", true);
    $('#scanner').hide();
    $('#clearacard').show();
    $('#loadingacard').hide();

    $('.halodecktot').select2({
        placeholder: " Pilih NG",
        language: "id",
        allowClear: true,

    });
</script>
<!-- formulir cek inside -->