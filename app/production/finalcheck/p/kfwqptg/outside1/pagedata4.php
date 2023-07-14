<?php
// get connection
require '../config.php';

// aktif ketika data ditemukan dari file check.php
// get data lemparan
$serialnumber = isset($_POST['serialnumber']) ? $_POST['serialnumber'] : '';

// get informasi piano
$sql = mysqli_query($connect_pro, "SELECT b.c_name, b.c_code_type FROM finalcheck_register a INNER JOIN finalcheck_list_piano b ON a.c_gmc = b.c_gmc WHERE a.c_serialnumber = '$serialnumber' ");
$data = mysqli_fetch_array($sql);
$c_name_piano = $data['c_name'];
$c_code_type = $data['c_code_type'];
if ($c_code_type == 'f') {
    $format = 'png';
} elseif ($c_code_type == 'p') {
    $format = 'jpg';
}

// get stempel 
// [SELECT : finalcheck_inside] get tanggal NG -> maks (c_result_date) and c_result=ng || finalcheck_inside
$sql1 = mysqli_query($connect_pro, "SELECT max(c_result_date) AS ng_date FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_process = 'oc1'");
$data1 = mysqli_fetch_array($sql1);
$ng_date1 = '-';
if ($data1['ng_date'] != '') {
    $ng_date1 = date('d-m-Y', strtotime($data1['ng_date']));
}

// get stempel 
// [SELECT : finalcheck_inside] get tanggal NG -> maks (c_result_date) and c_result=ng || finalcheck_inside
$sql2 = mysqli_query($connect_pro, "SELECT max(c_result_date) AS ng_date FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_process = 'oc2'");
$data2 = mysqli_fetch_array($sql2);
$ng_date2 = '-';
if ($data2['ng_date'] != '') {
    $ng_date2 = date('d-m-Y', strtotime($data2['ng_date']));
}

// get stempel 
// [SELECT : finalcheck_inside] get tanggal NG -> maks (c_result_date) and c_result=ng || finalcheck_inside
$sql3 = mysqli_query($connect_pro, "SELECT max(c_result_date) AS ng_date FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_process = 'oc3'");
$data3 = mysqli_fetch_array($sql3);
$ng_date3 = '-';
if ($data3['ng_date'] != '') {
    $ng_date3 = date('d-m-Y', strtotime($data3['ng_date']));
}

// get name
// [SELECT : finalcheck_repairtime, finalcheck_pic JOIN by c_serialnumber  ] 
// get tanggal OK -> c_repair_inside_o || finalcheck_repairtime
// get pic inside check -> c_inside || finalcheck_pic
// select a.c_repair_inside_o , b.c_inside  from finalcheck_repairtime a inner join finalcheck_pic b on a.c_serialnumber = b.c_serialnumber where b.c_serialnumber = 'J40505958'
$sql2 = mysqli_query($connect_pro, "SELECT a.c_repair_outsidesatu_o,a.c_repair_outsidedua_o,a.c_repair_outsidetiga_o, b.c_outsidesatu,b.c_outsidedua,b.c_outsidetiga, a.c_outsidesatu_pic,a.c_outsidedua_pic,a.c_outsidetiga_pic  FROM finalcheck_repairtime a INNER JOIN finalcheck_pic b ON a.c_serialnumber = b.c_serialnumber WHERE b.c_serialnumber = '$serialnumber'");
$data2 = mysqli_fetch_array($sql2);

$ok_date1 = '-';
$ok_date2 = '-';
$ok_date3 = '-';
$pic1 = $data2['c_outsidesatu'];
$pic2 = $data2['c_outsidedua'];
$pic3 = $data2['c_outsidetiga'];
$repair1 = '-';
$repair2 = '-';
$repair3 = '-';

$validation_func = 'disabled';
$finish_outside_func = ''; // jika sudah dikirm maka akan disabled untuk checkbox nya
if ($data2['c_repair_outsidesatu_o'] != '') {
    $ok_date1 = date('d-m-Y', strtotime($data2['c_repair_outsidesatu_o']));
    $finish_outside_func = 'disabled';
}

if ($data2['c_repair_outsidedua_o'] != '') {
    $ok_date2 = date('d-m-Y', strtotime($data2['c_repair_outsidedua_o']));
}

if ($data2['c_repair_outsidetiga_o'] != '') {
    $ok_date3 = date('d-m-Y', strtotime($data2['c_repair_outsidetiga_o']));
}

// untuk validation func tergantung bagian mana yang aktif
if ($data2['c_outsidesatu_pic'] != '') {
    $repair1 = $data2['c_outsidesatu_pic'];
    $validation_func = '';
}

if ($data2['c_outsidedua_pic'] != '') {
    $repair2 = $data2['c_outsidedua_pic'];
}

if ($data2['c_outsidetiga_pic'] != '') {
    $repair2 = $data2['c_outsidetiga_pic'];
}

// get repair all and allow finish
$btnfinishdis = 'disabled';
$sql3 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_repair = 'N' AND c_process = '$publicprocess'");
$data3 = mysqli_fetch_array($sql3);
if ($data3['total'] == 0) {
    $btnfinishdis = '';
}
?>

<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>
<!-- <script src="<?= base_url('_assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script> -->
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- judul pagedata -->
<hr>
<input type="hidden" id="serialnumber" value="<?= $serialnumber ?>">
<input type="hidden" id="processaddng" name="process" value="oc1">
<input type="hidden" id="codetypeaddng" name="codetype" value="<?= $c_code_type ?>">
<div class="row">
    <div class="col-8" style="text-align: left;">
        <h4><i class="fa fa-pencil-square-o"></i> <u>Check Card - Outside Validation</u></h4>

    </div>
    <div class="col-4" style="text-align: right;">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-success" id="check" style="width: 100%;"><i class="fa fa-arrow-circle-left"></i> Validasi, Completeness</button>
                <script>
                    var serialnumber = $('#serialnumberaddng').val();
                    var codetype = $('#codetypeaddng').val();
                    $(document).ready(function() {
                        load_data_ngval(serialnumber);
                        load_image_ng(serialnumber, codetype);
                    })
                    $('#check').click(function() {
                        var dataString = {
                            serialnumber: $('#serialnumber').val(),
                        };
                        $.ajax({
                            url: "outside1/pagedata3.php",
                            type: "POST",
                            data: dataString,
                            success: function(data) {
                                $('#pagedata').show();
                                $('#pagedata').html(data);
                                window.scrollTo(0, 100);
                                return false;
                            }
                        });
                    })
                </script>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button <?= $btnfinishdis . " " . $finish_outside_func ?> class="btn btn-primary" id="sendfinisho" style="width: 100%;">Finish Outside Check <i class="fa fa-flag-checkered"></i></button>
                <script>
                    var serialnumber = $('#serialnumber').val();
                    $('#send').click(function() {
                        Swal.fire({
                            title: 'Apakah anda yakin ?',
                            icon: 'question',
                            html: 'Data akan diteruskan ke bagian Repair jika terdapat NG',
                            showCancelButton: true,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Iya',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // console.log('oke dikirm ke repair');
                                $.ajax({
                                    url: "outside1/data10.php",
                                    type: "POST",
                                    data: {
                                        "serialnumber": serialnumber
                                    },
                                    success: function(response) {
                                        var response = JSON.parse(response);
                                        if (response.status == 'OK') {
                                            Swal.fire({
                                                title: 'Berhasil!',
                                                text: 'Data berhasil dikirim',
                                                icon: 'success',
                                                // timer: 2000,
                                                showCancelButton: false,
                                                showConfirmButton: true,
                                                confirmButtonText: 'Oke'
                                            }).then(function() {
                                                $('#clearacard').trigger('click');

                                            });
                                        }
                                    }
                                });
                            }
                        });
                    })
                </script>
            </div>
        </div>
    </div>
</div>

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
                    <?= $c_name_piano ?>
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
                <td style="width: 33%;"><i class="fa fa-gavel" style="color: #DC4646 ;"></i> R1 : <?= $repair1 ?></td>
                <td style="width: 34%;"><i class="fa fa-gavel" style="color: #5AA65A ;"></i> R2 : <?= $repair2 ?></td>
                <td style="width: 33%;"><i class="fa fa-gavel" style="color: #1340FF ;"></i> R3 : <?= $repair3 ?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width: 10%;">No</th>
                <th>Detail NG</th>
            </thead>
            <tbody id="detail_ng">
            </tbody>
        </table>
    </div>
    <div class="col-6" id="image_ng" style="text-align: center;">
    </div>
</div>
<!-- isi konten -->

<!-- note completeness -->
<div class="row">
    <div class="col-4">
        <h5>Note 1</h5>
        <textarea disabled name="note1" id="note1" rows="5" style="width: 100%;"></textarea>
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
            var stat = 'select';
            $.ajax({
                url: 'outside1/data2.php',
                type: 'POST',
                data: {
                    "serialnumber": serialnumber,
                    "stat": stat
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    $('#note1').html(response.note1);
                    $('#note2').html(response.note2);
                    $('#note3').html(response.note3);
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
                <?php
                if ($ng_date1 != '-') {
                ?>
                    <span class="stamp is-reject" style="font-size:1.2rem; width: 200px;"><?= $pic1 ?></span>
                <?php
                }
                ?>
            </td>
            <td style="padding-top: 15px; padding-bottom: 15px; width: 34%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC REJECT</h5>
                <?php
                if ($ng_date2 != '-') {
                ?>
                    <span class="stamp is-reject" style="font-size:1.2rem ; width: 200px;"><?= $pic2 ?></span>
                <?php
                }
                ?>
            </td>
            <td style="padding-top: 15px; padding-bottom: 15px; width: 33%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC REJECT</h5>
                <?php
                if ($ng_date3 != '-') {
                ?>
                    <span class="stamp is-reject" style="font-size:1.2rem; width: 200px;"><?= $pic3 ?></span>
                <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Date: <?= $ng_date1 ?></td>
            <td>Date: <?= $ng_date2 ?></td>
            <td>Date: <?= $ng_date3 ?></td>
        </tr>
        <tr style="text-align: center;">
            <td style="padding-top: 15px; padding-bottom: 15px; width: 33%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC PASS</h5>
                <?php
                if ($ok_date1 != '-') {
                ?>
                    <span class="stamp is-pass" style="font-size:1.2rem; width: 200px;"><?= $pic1 ?></span>
                <?php
                }
                ?>
            </td>
            <td style="padding-top: 15px; padding-bottom: 15px; width: 34%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC PASS</h5>
                <?php
                if ($ok_date2 != '-') {
                ?>
                    <span class="stamp is-pass" style="font-size:1.2rem; width: 200px;"><?= $pic2 ?></span>
                <?php
                }
                ?>
            </td>
            <td style="padding-top: 15px; padding-bottom: 15px; width: 33%; height: 80px;">
                <h5 style="position: absolute; opacity: 30%;">QC PASS</h5>
                <?php
                if ($ok_date3 != '-') {
                ?>
                    <span class="stamp is-pass" style="font-size:1.2rem; width: 200px;"><?= $pic3 ?></span>
                <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Date: <?= $ok_date1 ?></td>
            <td>Date: <?= $ok_date2 ?></td>
            <td>Date: <?= $ok_date3 ?></td>
        </tr>
    </tbody>
</table>
<!-- stamp -->

<hr>
<script>
    $('#sendfinisho').click(function() {
        var serialnumber = $('#serialnumber').val();
        $.ajax({
            type: 'POST',
            url: 'outside1/data14.php',
            data: {
                "serialnumber": serialnumber,
            },
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 'OK') {
                    console.log(response.status);
                    Swal.fire({
                        title: 'Apakah anda yakin hasil repair sesuai ?',
                        icon: 'question',
                        html: 'Data akan diteruskan ke proses berikutnya',
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Iya',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'outside1/data15.php',
                                type: 'POST',
                                data: {
                                    "serialnumber": serialnumber,
                                },
                                success: function(response) {
                                    // load page data 5 -> 6 atau clear aja
                                    // load_data_ng(serialnumber);
                                    // load_image_ng(serialnumber, codetype);
                                    var response = JSON.parse(response);
                                    console.log('dikirim ke proses berikutnya');
                                    if (response.status == 'berhasil') {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            icon: 'success',
                                            html: 'Data berhasil dikirim ke proses berikutnya',
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
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            icon: 'error',
                                            html: 'Data gagal dikirim, silahkan coba lagi',
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
                } else if (response.status == 'BELUM-REPAIR') {
                    console.log(response.status);
                    Swal.fire({
                        title: 'Masih terdapat data yang belum direpair!',
                        text: 'Pastikan proses repair sudah selesai',
                        icon: 'error',
                        // timer: 3000,
                        showConfirmButton: true,
                        confirmButtonText: 'Oke',
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Server sibuk',
                        icon: 'error',
                        // timer: 3000,
                        showConfirmButton: true,
                        confirmButtonText: 'Oke',
                    });
                }
            }
        });
    })
</script>

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