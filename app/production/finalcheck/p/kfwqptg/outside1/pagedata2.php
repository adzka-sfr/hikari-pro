<?php
// get connection
require '../config.php';

// aktif ketika data ditemukan dari file check.php
// get data lemparan
$serialnumber = isset($_POST['serialnumber']) ? $_POST['serialnumber'] : '';

// get informasi piano
$sql = mysqli_query($connect_pro, "SELECT b.c_name FROM finalcheck_register a INNER JOIN finalcheck_list_piano b ON a.c_gmc = b.c_gmc WHERE a.c_serialnumber = '$serialnumber' ");
$data = mysqli_fetch_array($sql);
?>

<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- judul pagedata -->
<hr>
<h4><i class="fa fa-pencil-square-o"></i> <u>Check Card - Outside</u></h4>
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
                    <?= date('l, d M Y', strtotime($now)) ?>
                </div>
            </div>
        </th>
    </thead>
</table>
<!-- judul -->


<!-- isi konten -->
<div class="row">
    <div class="col-12 mb-0">
        <table class="table">
            <tr style="text-align: center;">
                <td><i class="fa fa-pencil" style="color: #DC4646 ;"></i> Outside Check 1</td>
                <td><i class="fa fa-pencil" style="color: #5AA65A ;"></i> Outside Check 2</td>
                <td><i class="fa fa-pencil" style="color: #1340FF ;"></i> Outside Check 3</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahng">
            <b>Tambah NG</b> <i class="fa fa-plus"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="tambahng" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah NG</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Add NG</button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width: 5%;">No</th>
                <th>Detail NG</th>
            </thead>
        </table>
    </div>
    <div class="col-6">
        <!-- tbo image -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../art/f/tbo.png" style="width:100%; opacity: 60%;">
                    <button class="btn ingpo" style="width: 25px; height: 25px; top: 10%; left: 5%;">
                        <span style="color: red; padding: 0px;">1</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- tbo image -->
        <br>
        <hr>
        <br>
        <!-- tbi image -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../art/f/tbi.png" style="width:100%; opacity: 60%;">
                    <button class="btn ingpo" style="width: 25px; height: 25px; top: 10%; left: 5%;">
                        <span style="color: red; padding: 0px;">1</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- tbi image -->
        <br>
        <hr>
        <br>
        <!-- uk image -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../art/f/uk.png" style="width:100%; opacity: 60%;">
                    <button class="btn ingpo" style="width: 25px; height: 25px; top: 10%; left: 5%;">
                        <span style="color: red; padding: 0px;">1</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- uk image -->
        <br>
        <hr>
        <br>
        <!-- b image -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../art/f/b.png" style="width:100%; opacity: 60%;">
                    <button class="btn ingpo" style="width: 25px; height: 25px; top: 10%; left: 5%;">
                        <span style="color: red; padding: 0px;">1</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- b image -->
        <br>
        <hr>
        <br>
        <!-- bb image -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../art/f/bb.png" style="width:100%; opacity: 60%;">
                    <button class="btn ingpo" style="width: 25px; height: 25px; top: 10%; left: 5%;">
                        <span style="color: red; padding: 0px;">1</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- bb image -->
        <br>
        <hr>
        <br>
    </div>
</div>
<!-- isi konten -->

<!-- note completeness -->
<div class="row">
    <div class="col-4">
        <h5>Note 1</h5>
        <textarea name="note1" id="note1" rows="5" style="width: 100%;"></textarea>
    </div>
    <div class="col-4">
        <h5>Note 2</h5>
        <textarea disabled name="note2" id="note2" rows="5" style="width: 100%;"></textarea>
    </div>
    <div class="col-4">
        <h5>Note 3</h5>
        <textarea disabled name="note3" id="note3" rows="5" style="width: 100%;"></textarea>
    </div>

    <script>
        $(document).ready(function() {
            var serialnumber = $('#serialnumber').val();
            var note = $('#note1').val();
            var stat = 'select';
            $.ajax({
                url: 'outside1/data2.php',
                type: 'POST',
                data: {
                    "serialnumber": serialnumber,
                    "note": note,
                    "stat": stat
                },
                success: function(response) {
                    $('#note1').html(response);
                }
            });
        })

        $('#note').blur(function() {
            var serialnumber = $('#serialnumber').val();
            var note = $('#note1').val();
            var stat = 'update';
            $.ajax({
                url: 'outside1/data2.php',
                type: 'POST',
                data: {
                    "serialnumber": serialnumber,
                    "note": note,
                    "stat": stat
                },
                success: function(response) {
                    $('#note1').html(response);
                }
            });
        })
    </script>
</div>
<!-- note completeness -->

<!-- stamp -->
<table class="table table-bordered" style="margin-top: 10px;">
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

<hr>

<div class="row">
    <div class="col-12 mb-5" style="text-align: left;">
        <button class="btn btn-success" id="check"><i class="fa fa-hand-o-left"></i> Kembali, Cek Completeness</button>
        <button class="btn btn-success" id="send" style="display: none;">Send to Repair official</button>
        <script>
            $('#check').click(function() {
                function loadData() {

                    var dataString = {
                        serialnumber: $('#serialnumber').val(),
                    };
                    $.ajax({
                        url: "outside1/pagedata.php",
                        type: "POST",
                        data: dataString,
                        success: function(data) {
                            $('#pagedata').show();
                            $('#pagedata').html(data);
                            window.scrollTo(0, 100);
                            return false;
                        }
                    });
                };
                loadData();
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