<?php
// get connection
require '../config.php';

// aktif ketika data ditemukan dari file check.php
// get data lemparan
$serialnumber = isset($_POST['serialnumber']) ? $_POST['serialnumber'] : '';

// get informasi piano
?>

<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>

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
                    <?= "nama piano" ?>
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
                    <?= date('l, d M Y', strtotime($now)) ?>
                </div>
            </div>
        </th>
    </thead>
</table>
<!-- judul -->

<!-- stamp -->
<table class="table table-bordered" style="margin-top: 0px;">
<thead style="text-align:center;">
    <th>Cek1</th>
    <th>Cek2</th>
    <th>Cek3</th>
</thead>
<tbody>
    <tr style="text-align: center;">
        <td style="padding-top: 15px; padding-bottom: 15px; width: 33%; height: 80px;">
            <h5 style="position: absolute; opacity: 30%;">QC REJECT</h5>
            <!-- <span class="stamp is-reject" style="font-size:1.2rem"><?= "Graham Bell" ?></span> -->
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
            <!-- <span class="stamp is-pass" style="font-size:1.2rem"><?= "Graham Bell" ?></span> -->
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
</table>
<!-- stamp -->

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
        $sql = mysqli_query($connect_pro, "SELECT a.c_code_completeness, b.c_detail FROM finalcheck_fetch_completeness a INNER JOIN finalcheck_list_completeness b ON a.c_code_completeness = b.c_code_completeness WHERE c_serialnumber = '$serialnumber'");
        while ($data = mysqli_fetch_array($sql)) {
            $no++;
        ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td style="font-size: 15px;"><?= $data['c_detail'] ?></td>
                <td style="font-size: 15px; text-align: center;"><input id="cekbok<?= $data['c_code_completeness'] ?>" onchange="cekbok1(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" style="transform: scale(2);"></td>
                <td style="font-size: 15px; text-align: center;"><input disabled id="cekbok<?= $data['c_code_completeness'] ?>" onchange="cekbok2(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" style="transform: scale(2);"></td>
                <td style="font-size: 15px; text-align: center;"><input disabled id="cekbok<?= $data['c_code_completeness'] ?>" onchange="cekbok3(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" style="transform: scale(2);"></td>
            </tr>
        <?php
        }
        ?>
        <!-- <script>
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
                    }
                });
            }
        </script> -->
    </tbody>
</table>

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
        <button class="btn btn-success" id="check">Send to Repair</button>
        <button class="btn btn-success" id="send" style="display: none;">Send to Repair official</button>
        <script>
            $('#check').click(function() {
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
                                    })
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