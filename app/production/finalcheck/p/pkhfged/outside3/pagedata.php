<?php
// get connection
require '../config.php';

// aktif ketika data ditemukan dari file check.php
// get data lemparan
$serialnumber = isset($_POST['serialnumber']) ? $_POST['serialnumber'] : '';

// get tanggal register
$q100 = mysqli_query($connect_pro, "SELECT c_completenesstiga_i FROM finalcheck_timestamp WHERE c_serialnumber = '$serialnumber'");
$d100 = mysqli_fetch_array($q100);
$inspection_date = date('l, d M Y h:i A', strtotime($d100['c_completenesstiga_i']));

// get informasi piano
$sql = mysqli_query($connect_pro, "SELECT b.c_name FROM finalcheck_register a INNER JOIN finalcheck_list_piano b ON a.c_gmc = b.c_gmc WHERE a.c_serialnumber = '$serialnumber' ");
$data = mysqli_fetch_array($sql);
?>

<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

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

<!-- judul pagedata -->
<hr>
<h4><i class="fa fa-pencil-square-o"></i> <u>Check Card - Completeness</u></h4>
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
                    <?= $serialnumber ?>
                    <input type="hidden" id="serialnumber" value="<?= $serialnumber ?>">
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
                    <?= $data['c_name'] ?>
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
                    <?= $inspection_date ?>
                </div>
            </div>
        </th>
    </thead>
</table>
<!-- judul -->


<!-- formulir cek inside -->
<table class="table table-bordered">
    <thead style="text-align: center;">
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Item</th>
            <th colspan="3">Hasil Cek</th>
        </tr>
        <tr>
            <td>C1</td>
            <td>C2</td>
            <td>C3</td>
        </tr>

    </thead>
    <tbody>
        <?php
        $no = 0;
        $sql = mysqli_query($connect_pro, "SELECT a.c_code_completeness,a.c_resultsatu, a.c_resultdua, a.c_resulttiga, b.c_detail FROM finalcheck_fetch_completeness a INNER JOIN finalcheck_list_completeness b ON a.c_code_completeness = b.c_code_completeness WHERE c_serialnumber = '$serialnumber'");
        while ($data = mysqli_fetch_array($sql)) {
            $checkcom1 = '';
            if ($data['c_resultsatu'] == 'Y') {
                $checkcom1 = 'checked';
            }

            $checkcom2 = '';
            if ($data['c_resultdua'] == 'Y') {
                $checkcom2 = 'checked';
            }

            $checkcom3 = '';
            if ($data['c_resulttiga'] == 'Y') {
                $checkcom3 = 'checked';
            }
            $no++;
        ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td style="font-size: 15px;"><?= $data['c_detail'] ?></td>
                <td style="font-size: 15px; text-align: center;"><input class="comcheck1" disabled id="cekbok1<?= $data['c_code_completeness'] ?>" onchange="cekbok1(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" <?= $checkcom1 ?> style="transform: scale(2);"></td>
                <td style="font-size: 15px; text-align: center;"><input class="comcheck2" disabled id="cekbok2<?= $data['c_code_completeness'] ?>" onchange="cekbok2(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" <?= $checkcom2 ?> style="transform: scale(2);"></td>
                <td style="font-size: 15px; text-align: center;"><input class="comcheck3" id="cekbok3<?= $data['c_code_completeness'] ?>" onchange="cekbok3(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" <?= $checkcom3 ?> style="transform: scale(2);"></td>
            </tr>
        <?php
        }
        ?>
        <script>
            var serialnumber = $('#serialnumber').val();

            function cekbok3(id) {
                console.log($('#' + id).val())
                var code = $('#' + id).val();
                var result = 'N';
                if ($('#' + id).is(':checked')) {
                    console.log('centang');
                    result = 'Y';
                } else {
                    console.log('tidak centang');
                    result = 'N';
                }
                $.ajax({
                    url: 'outside3/data.php',
                    type: 'POST',
                    data: {
                        "serialnumber": serialnumber,
                        "code": code,
                        "result": result
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



<!-- note completeness -->
<div class="row">
    <div class="col-4">
        <h5>Note 1</h5>
        <textarea class="comnote1" disabled name="note1" id="note1" rows="5" style="width: 100%;"></textarea>
    </div>
    <div class="col-4">
        <h5>Note 2</h5>
        <textarea class="comnote2" disabled name="note2" id="note2" rows="5" style="width: 100%;"></textarea>
    </div>
    <div class="col-4">
        <h5>Note 3</h5>
        <textarea class="comnote3" name="note3" id="note3" rows="5" style="width: 100%;"></textarea>
    </div>

    <script>
        $(document).ready(function() {
            var serialnumber = $('#serialnumber').val();
            var note = $('#note3').val();
            var stat = 'select';
            $.ajax({
                url: 'outside3/data1.php',
                type: 'POST',
                data: {
                    "serialnumber": serialnumber,
                    "note": note,
                    "stat": stat
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    $('#note1').html(response.note1);
                    $('#note2').html(response.note2);
                    $('#note3').html(response.note3);
                },
                error: function() {
                    lostconnection()
                }
            });
        })

        $('#note3').blur(function() {
            var serialnumber = $('#serialnumber').val();
            var note = $('#note3').val();
            var stat = 'update';
            $.ajax({
                url: 'outside3/data1.php',
                type: 'POST',
                data: {
                    "serialnumber": serialnumber,
                    "note": note,
                    "stat": stat
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    $('#note3').html(response.note3);
                },
                error: function() {
                    lostconnection()
                }
            });
        })
    </script>
</div>
<!-- note completeness -->

<!-- stamp -->
<!-- <table class="table table-bordered" style="margin-top: 10px;">
    <thead style="text-align:center;">
        <th>Cek1</th>
        <th>Cek2</th>
        <th>Cek3</th>
    </thead>
    <tbody>
        <tr style="text-align: center;">
            <td style="padding-top: 15px; padding-bottom: 15px; width: 33%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC REJECT</h5>
            </td>
            <td style="padding-top: 15px; padding-bottom: 15px; width: 34%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC REJECT</h5>
            </td>
            <td style="padding-top: 15px; padding-bottom: 15px; width: 33%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC REJECT</h5>
            </td>
        </tr>
        <tr>
            <td>Date: -</td>
            <td>Date: -</td>
            <td>Date: -</td>
        </tr>
        <tr style="text-align: center;">
            <td style="padding-top: 15px; padding-bottom: 15px; width: 33%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC PASS</h5>
            </td>
            <td style="padding-top: 15px; padding-bottom: 15px; width: 34%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC PASS</h5>
            </td>
            <td style="padding-top: 15px; padding-bottom: 15px; width: 33%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC PASS</h5>
            </td>
        </tr>
        <tr>
            <td>Date: -</td>
            <td>Date: -</td>
            <td>Date: -</td>
        </tr>
    </tbody>
</table> -->
<!-- stamp -->


<hr>

<div class="row">
    <div class="col-6"></div>
    <div class="col-6 mb-5" style="text-align: right;">
        <button class="btn btn-success" id="check" style="width: 80%;">Lanjut, Cek Outside <i id="icon-spinner-main" class="fa fa-arrow-circle-right"></i><i id="icon-spinner" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
        <script>
            $('#check').click(function() {
                $('.comcheck3').prop('disabled', true);
                $('.comnote3').prop('disabled', true);
                $('#check').attr('disabled', true);
                $('#icon-spinner').show();
                $('#icon-spinner-main').hide();
                var dataString = {
                    serialnumber: $('#serialnumber').val(),
                };
                $.ajax({
                    url: "outside3/data9.php",
                    type: "POST",
                    data: {
                        "serialnumber": serialnumber
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 'DONE') {
                            $.ajax({
                                url: "outside3/pagedata2.php",
                                type: "POST",
                                data: dataString,
                                success: function(data) {
                                    $('#pagedata').show();
                                    $('#pagedata').html(data);
                                    window.scrollTo(0, 100);
                                    return false;
                                },
                                error: function() {
                                    lostconnection()
                                }
                            });
                        } else if (response.status == 'NOT-YET') {
                            $('.comcheck3').prop('disabled', false);
                            $('.comnote3').prop('disabled', false);
                            $('#check').attr('disabled', false);
                            $('#icon-spinner').hide();
                            $('#icon-spinner-main').show();
                            Swal.fire({
                                title: 'Apakah anda yakin ?',
                                icon: 'warning',
                                html: 'Terdapat data tidak diceklis',
                                showCancelButton: true,
                                showConfirmButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Iya',
                                cancelButtonText: 'Tidak'
                            }).then((result) => {
                                $('.comcheck3').prop('disabled', false);
                                $('.comnote3').prop('disabled', false);
                                $('#check').attr('disabled', true);
                                $('#icon-spinner').show();
                                $('#icon-spinner-main').hide();
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: "outside3/pagedata2.php",
                                        type: "POST",
                                        data: dataString,
                                        success: function(data) {
                                            $('#pagedata').show();
                                            $('#pagedata').html(data);
                                            window.scrollTo(0, 100);
                                            return false;
                                        },
                                        error: function() {
                                            lostconnection()
                                        }
                                    });
                                } else {
                                    $('.comcheck3').prop('disabled', false);
                                    $('.comnote3').prop('disabled', false);
                                    $('#check').attr('disabled', false);
                                    $('#icon-spinner').hide();
                                    $('#icon-spinner-main').show();
                                }
                            });
                        } else {
                            $('.comcheck3').prop('disabled', false);
                            $('.comnote3').prop('disabled', false);
                            $('#check').attr('disabled', false);
                            $('#icon-spinner').hide();
                            $('#icon-spinner-main').show();
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'error!',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    },
                    error: function() {
                        lostconnection()
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