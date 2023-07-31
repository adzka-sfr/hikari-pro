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

// get date ng1
$sql1 = mysqli_query($connect_pro, "SELECT MAX(c_resultsatu_date) as maks FROM finalcheck_completeness WHERE c_serialnumber = '$serialnumber' AND c_resultsatu = 'N'");
$data1 = mysqli_fetch_array($sql1);
$ng_date1 = '-';
if ($data1['maks'] != '') {
    $ng_date1 = date('d-m-Y h:i A', strtotime($data1['maks']));
}

// get date ng2
$sql2 = mysqli_query($connect_pro, "SELECT MAX(c_resultdua_date) as maks FROM finalcheck_completeness WHERE c_serialnumber = '$serialnumber' AND c_resultdua = 'N'");
$data2 = mysqli_fetch_array($sql2);
$ng_date2 = '-';
if ($data2['maks'] != '') {
    $ng_date2 = date('d-m-Y h:i A', strtotime($data2['maks']));
}

// get date ng3
$sql3 = mysqli_query($connect_pro, "SELECT MAX(c_resulttiga_date) as maks FROM finalcheck_completeness WHERE c_serialnumber = '$serialnumber' AND c_resulttiga = 'N'");
$data3 = mysqli_fetch_array($sql3);
$ng_date3 = '-';
if ($data3['maks'] != '') {
    $ng_date3 = date('d-m-Y h:i A', strtotime($data3['maks']));
}

// [SELECT : finalcheck_repairtime, finalcheck_pic JOIN by c_serialnumber  ]
// get tanggal OK -> c_repair_inside_o || finalcheck_repairtime
// get pic inside check -> c_inside || finalcheck_pic
// select a.c_repair_inside_o , b.c_inside  from finalcheck_repairtime a inner join finalcheck_pic b on a.c_serialnumber = b.c_serialnumber where b.c_serialnumber = 'J40505958'
$sql2 = mysqli_query($connect_pro, "SELECT a.c_repair_outsidesatu_o,a.c_repair_outsidedua_o,a.c_repair_outsidetiga_o , b.c_outsidesatu,b.c_outsidedua,b.c_outsidetiga, a.c_outsidesatu_pic,a.c_outsidedua_pic,a.c_outsidetiga_pic  FROM finalcheck_repairtime a INNER JOIN finalcheck_pic b ON a.c_serialnumber = b.c_serialnumber WHERE b.c_serialnumber = '$serialnumber'");
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
$finish_outsidesatu_func = ''; // jika sudah dikirm maka akan disabled untuk checkbox nya
$finish_outsidedua_func = ''; // jika sudah dikirm maka akan disabled untuk checkbox nya
$finish_outsidetiga_func = ''; // jika sudah dikirm maka akan disabled untuk checkbox nya
if ($data2['c_repair_outsidesatu_o'] != '') {
    $ok_date1 = date('d-m-Y h:i A', strtotime($data2['c_repair_outsidesatu_o']));
    $finish_outsidesatu_func = 'disabled';
}

if ($data2['c_repair_outsidedua_o'] != '') {
    $ok_date2 = date('d-m-Y h:i A', strtotime($data2['c_repair_outsidedua_o']));
    $finish_outsidedua_func = 'disabled';
}

if ($data2['c_repair_outsidetiga_o'] != '') {
    $ok_date3 = date('d-m-Y h:i A', strtotime($data2['c_repair_outsidetiga_o']));
    $finish_outsidetiga_func = 'disabled';
}


// untuk validation func tergantung mana yang aktif
if ($data2['c_outsidesatu_pic'] != '') {
    $repair1 = $data2['c_outsidesatu_pic'];
}

if ($data2['c_outsidedua_pic'] != '') {
    $repair2 = $data2['c_outsidedua_pic'];
}

if ($data2['c_outsidetiga_pic'] != '') {
    $repair3 = $data2['c_outsidetiga_pic'];
    $validation_func = '';
}
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
<input type="hidden" id="serialnumber" value="<?= $serialnumber ?>">
<div class="row">
    <div class="col-8">
        <h4><i class="fa fa-folder-open"></i> <u>Check Card Completeness - Closed <i id="icon-main-fin" class="fa fa-flag-checkered"></i></u></h4>
    </div>
    <div class="col-4" style="text-align: right;">
        <button class="btn btn-success" id="check" style="width: 100%;">Outside <i id="icon-main" class="fa fa-arrow-circle-right"></i><i id="icon-spinner" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
        <script>
            $('#check').click(function() {
                $('#check').attr('disabled', true);
                $('#icon-main').hide();
                $('#icon-spinner').show();
                var dataString = {
                    serialnumber: $('#serialnumber').val(),
                };
                $.ajax({
                    url: "outside2/data12.php",
                    type: "POST",
                    data: {
                        "serialnumber": serialnumber
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 'DONE') {
                            console.log("gas lur aman");
                            $.ajax({
                                url: "outside2/pagedata6.php",
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
                            $('#check').attr('disabled', false);
                            $('#icon-main').show();
                            $('#icon-spinner').hide();
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
                                if (result.isConfirmed) {
                                    $('#check').attr('disabled', true);
                                    $('#icon-main').hide();
                                    $('#icon-spinner').show();
                                    console.log("gas lur aman");
                                    $.ajax({
                                        url: "outside2/pagedata6.php",
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
                                }
                            });
                        } else {
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
            <th colspan="6">Validasi</th>
        </tr>
        <tr>
            <td colspan="2">R1<br>(<?= $repair1 ?>)</td>
            <td colspan="2">R2<br>(<?= $repair2 ?>)</td>
            <td colspan="2">R3<br>(<?= $repair3 ?>)</td>
        </tr>

    </thead>
    <tbody>
        <?php
        $no = 0;
        $sql = mysqli_query($connect_pro, "SELECT a.c_code_completeness,a.c_resultsatu, a.c_repairsatu,a.c_resultdua, a.c_repairdua,a.c_resulttiga, a.c_repairtiga, b.c_detail FROM finalcheck_completeness a INNER JOIN finalcheck_list_completeness b ON a.c_code_completeness = b.c_code_completeness WHERE c_serialnumber = '$serialnumber'");
        while ($data = mysqli_fetch_array($sql)) {
            $status1 = '';
            $status2 = '';
            $status3 = '';

            if ($data['c_resultsatu'] == 'Y') {
                $status1 = 'OK';
            } else {
                $status1 = 'NG';
                $valcheck1 = '';
                if ($data['c_repairsatu'] == 'Y') {
                    $valcheck1 = 'checked';
                }
            }

            if ($data['c_resultdua'] == 'Y') {
                $status2 = 'OK';
            } else {
                $status2 = 'NG';
                $valcheck2 = '';
                if ($data['c_repairdua'] == 'Y') {
                    $valcheck2 = 'checked';
                }
            }

            if ($data['c_resulttiga'] == 'Y') {
                $status3 = 'OK';
            } else {
                $status3 = 'NG';
                $valcheck3 = '';
                if ($data['c_repairtiga'] == 'Y') {
                    $valcheck3 = 'checked';
                }
            }

            $no++;
        ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td style="font-size: 15px;"><?= $data['c_detail'] ?></td>
                <td style="font-size: 15px; text-align: center;"><?= $status1 ?></td>
                <td style="font-size: 15px; text-align: center;">
                    <?php
                    if ($status1 == 'NG') {
                    ?>
                        <input <?= $valcheck1 ?> <?= $finish_outsidesatu_func ?> id="cekbok1<?= $data['c_code_completeness'] ?>" onchange="cekbokval1(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" style="transform: scale(2);">
                    <?php
                    } else {
                    ?>
                        -
                    <?php
                    }
                    ?>

                </td>
                <td style="font-size: 15px; text-align: center;"><?= $status2 ?></td>
                <td style="font-size: 15px; text-align: center;">
                    <?php
                    if ($status2 == 'NG') {
                    ?>
                        <input <?= $valcheck2 ?> <?= $finish_outsidedua_func ?> id="cekbok2<?= $data['c_code_completeness'] ?>" onchange="cekbokval2(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" style="transform: scale(2);">
                    <?php
                    } else {
                    ?>
                        -
                    <?php
                    }
                    ?>

                </td>
                <td style="font-size: 15px; text-align: center;"><?= $status3 ?></td>
                <td style="font-size: 15px; text-align: center;">
                    <?php
                    if ($status3 == 'NG') {
                    ?>
                        <input <?= $valcheck3 ?> <?= $finish_outsidetiga_func . " " . $validation_func ?> id="cekbok3<?= $data['c_code_completeness'] ?>" onchange="cekbokval3(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" style="transform: scale(2);">
                    <?php
                    } else {
                    ?>
                        -
                    <?php
                    }
                    ?>

                </td>
            </tr>
        <?php
        }
        ?>
        <script>
            var serialnumber = $('#serialnumber').val();

            function cekbokval3(id) {
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
                    url: 'outside2/data11.php',
                    type: 'POST',
                    data: {
                        "serialnumber": serialnumber,
                        "code": code,
                        "result": result,
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
                url: 'outside2/data1.php',
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
                    <span class="stamp is-reject" style="font-size:1.2rem; width: 200px;"><?= $pic2 ?></span>
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