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
$q100 = mysqli_query($connect_pro, "SELECT c_register FROM finalcheck_timestamp WHERE c_serialnumber = '$pianoserial'");
$d100 = mysqli_fetch_array($q100);
$register_date = date('l, d M Y h:i A', strtotime($d100['c_register']));

// [SELECT : finalcheck_fetch_inside] get tanggal NG -> maks (c_result_date) and c_result=ng || finalcheck_fetch_inside
$sql1 = mysqli_query($connect_pro, "SELECT max(c_result_date) AS ng_date FROM finalcheck_fetch_inside WHERE c_serialnumber = '$pianoserial' AND c_result = 'NG'");
$data1 = mysqli_fetch_array($sql1);
$ng_date = '-';
if ($data1['ng_date'] != '') {
    // $ng_date = date('d-m-Y', strtotime($data1['ng_date']));
    $ng_date = date('d-m-Y h:i A', strtotime($data1['ng_date']));
}

// [SELECT : finalcheck_repairtime, finalcheck_pic JOIN by c_serialnumber  ]
// get tanggal OK -> c_repair_inside_o || finalcheck_repairtime
// get pic inside check -> c_inside || finalcheck_pic
// select a.c_repair_inside_o , b.c_inside  from finalcheck_repairtime a inner join finalcheck_pic b on a.c_serialnumber = b.c_serialnumber where b.c_serialnumber = 'J40505958'
$sql2 = mysqli_query($connect_pro, "SELECT a.c_repair_inside_o , b.c_inside, a.c_inside_pic  FROM finalcheck_repairtime a INNER JOIN finalcheck_pic b ON a.c_serialnumber = b.c_serialnumber WHERE b.c_serialnumber = '$pianoserial'");
$data2 = mysqli_fetch_array($sql2);
$ok_date = '-';
$pic = $data2['c_inside'];
$repair = '';
$validation_func = 'disabled'; // jika belum di print tidak bisa di validasi
$finish_inside_func = ''; // jika sudah dikirm maka akan disabled untuk checkbox nya
if ($data2['c_repair_inside_o'] != '') {
    $ok_date = date('d-m-Y', strtotime($data1['ng_date']));
    $finish_inside_func = 'disabled';
}
if ($data2['c_inside_pic'] != '') {
    $repair = $data2['c_inside_pic'];
    $validation_func = '';
}
?>

<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- judul pagedata -->
<hr>
<h4><i class="fa fa-file-archive-o"></i> <u>Result Card</u></h4>
<!-- judul pagedata -->

<!-- judul -->
<table class="table table-bordered" style="font-size: large; margin-bottom: 0px;">
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
        <td style="padding-top: 15px; padding-bottom: 15px; width: 50%;">
            <h5 style="position: absolute; opacity: 30%;">QC REJECT</h5>
            <?php
            if ($ng_date != '-') {
            ?>
                <span class="stamp is-reject"><?= $pic ?></span>
            <?php
            }
            ?>
        </td>
        <td style="padding-top: 15px; padding-bottom: 15px; width: 50%;">
            <h5 style="position: absolute; opacity: 30%;">QC PASS</h5>
            <?php
            if ($ok_date != '-') {
            ?>
                <span class="stamp is-pass"><?= $pic ?></span>
            <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>Date: <?= $ng_date ?></td>
        <td>Date: <?= $ok_date ?></td>
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

<!-- formulir validasi inside -->
<table class="table table-bordered" style="font-size: larger;">
    <thead style="text-align: center;">
        <th>No</th>
        <th>Item</th>
        <th>Hasil Cek</th>
        <th>Repair</th>
    </thead>
    <tbody>
        <?php
        $arr_ng = [];
        $no = 0;
        $sql = mysqli_query($connect_pro, "SELECT a.c_code_incheck, a.c_code_ng, a.c_repair, a.c_result, b.c_detail FROM finalcheck_fetch_inside a INNER JOIN finalcheck_list_incheck b ON a.c_code_incheck = b.c_code_incheck WHERE a.c_serialnumber = '$pianoserial'");
        while ($data = mysqli_fetch_array($sql)) {
            $no++;
            if ($data['c_result'] == 'OK') {
        ?>
                <tr>
                    <td style="text-align: center;"><?= $no ?></td>
                    <td><?= $data['c_detail'] ?></td>
                    <td style="text-align: center; font-size: 15px;">OK</td>
                    <td style="text-align: center;">-</td>
                </tr>
            <?php
            } elseif ($data['c_result'] == 'NG') {
                $code_ng = explode("/", $data['c_code_ng']);
                if (!empty($data['c_repair'])) {
                    $code_repair = explode("/", $data['c_repair']);
                }

                $rowspan = count($code_ng);
                $rowspan++;
            ?>
                <tr style="background-color: #ED9DA5;">
                    <td rowspan="<?= $rowspan ?>" style="text-align: center;"><?= $no ?></td>
                    <td>
                        <?= $data['c_detail'] ?>
                    </td>
                    <td style="text-align: center; font-size: 15px;">NG</td>
                    <td><?= $repair ?></td>
                </tr>
                <?php
                // die();
                $urutan = 0;
                foreach ($code_ng as $value) {

                    array_push($arr_ng, $value);
                    $sql3 = mysqli_query($connect_pro, "SELECT c_name FROM finalcheck_list_ng WHERE c_code_ng = '$value'");
                    $data3 = mysqli_fetch_array($sql3);


                    $checklist = '';
                    if (!empty($data['c_repair'])) {
                        if ($code_repair[$urutan] == 'OK') {
                            $checklist = 'checked';
                        }
                    }
                ?>
                    <tr>
                        <td style="font-size: 15px;">- <?= $data3['c_name'] ?></td>
                        <td style="text-align: center;"><input type="checkbox" id="cekbok<?= $value ?>" <?= $checklist . " " . $validation_func . " " . $finish_inside_func ?> onchange="cekbok(this.id, '<?= $data['c_code_incheck'] ?>')" value="<?= $value ?>" style="transform: scale(2);">

                        </td>
                        <td style="text-align: center;"></td>
                    </tr>

                <?php
                    $urutan++;
                }
            } else {
                ?>
                <tr>
                    <td style=" text-align: center;"><?= $no ?></td>
                    <td style="font-size: 15px;"><?= $data['c_detail'] ?></td>
                    <td style="text-align: center; font-size: 15px;"></td>
                </tr>
        <?php
            }
        }
        ?>

    </tbody>
</table>
<!-- formulir validasi inside -->

<!-- note inside -->
<div class="row">
    <div class="col-12">
        <h5>Note</h5>
        <textarea disabled name="note" id="note" rows="5" style="width: 100%;"></textarea>
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
                },
                error: function() {
                    lostconnection()
                }
            });
        })
    </script>
</div>
<!-- note inside -->
<hr>

<div class="row">
    <div class="col-12 mb-5" style="text-align: center;">
        <button class="btn btn-success" id="check">Send to Outside Check 1 <i id="icon-spinner" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
        <button class="btn btn-success" id="send" style="display: none;">Send to Outside Check 1</button>
        <script>
            var checkbox = <?= json_encode($arr_ng) ?>;
            var data_ng_global;
            var serialnumber = $('#serialnumber').val();

            // function untuk melakukan update berdasarkan checkbox
            function cekbok(id, item) {
                var data_ng = [];
                for (let i = 0; i < checkbox.length; i++) {

                    var id_checkbox = 'cekbok' + checkbox[i];
                    if ($('#' + id_checkbox).is(':checked')) {
                        var ngcode = $('#' + id_checkbox).val();
                    } else {
                        var ngcode = 'kosong';
                    }
                    data_ng.push(ngcode);
                }

                $.ajax({
                    url: 'insidecheck/data6.php',
                    type: 'POST',
                    data: {
                        "serialnumber": serialnumber,
                        "ngcode": data_ng,
                        "item": item
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function() {
                        lostconnection()
                    }
                });
            }

            $('#check').click(function() {
                $('input[type=checkbox]').prop('disabled', true);
                $('#check').attr('disabled', true);
                $('#icon-spinner').show();
                var status = 'all-repaired';
                var data_ng_all = [];
                for (let i = 0; i < checkbox.length; i++) {

                    var id_checkbox = 'cekbok' + checkbox[i];

                    var serialnumber = $('#serialnumber').val();
                    if ($('#' + id_checkbox).is(':checked')) {
                        // console.log($('#' + id).val());
                        // console.log('anda klik ' + id);
                        var ngcode = $('#' + id_checkbox).val();
                    } else {
                        var ngcode = 'kosong';
                    }
                    data_ng_all.push(ngcode);
                }

                for (let j = 0; j < data_ng_all.length; j++) {
                    if (data_ng_all[j] == 'kosong') {
                        status = 'not-repaired';
                    }
                }

                if (status == 'not-repaired') {
                    Swal.fire({
                        title: 'Masih ada data yang belum diceklis!',
                        icon: 'error',
                        html: 'Pastikan proses validasi sudah selesai dengan ceklis semua temuan NG',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonColor: '#5D646B',
                        cancelButtonText: 'Oke',
                    })
                    $('input[type=checkbox]').prop('disabled', false);
                    $('#check').attr('disabled', false);
                    $('#icon-spinner').hide();
                } else {
                    console.log('sudah repair semuanya');
                    $('#send').trigger('click');
                }
            })

            $('#send').click(function() {
                Swal.fire({
                    title: 'Apakah anda yakin ?',
                    icon: 'question',
                    html: 'Data akan diteruskan ke <b>Outside Check 1</b>',
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('sudah oke gan sampai outside 1');

                        // pindah data dari finalcheck_fetch_inside ke tabel finalcheck_inside
                        // isi c_repair_o

                        // var serialnumber = $('#serialnumber').val();
                        $.ajax({
                            url: 'insidecheck/data7.php',
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
                                        html: 'Data berhasil dikirim ke Outside Check 1',
                                        showCancelButton: false,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Oke',
                                        cancelButtonText: 'Tidak'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('#clearacard').trigger('click');
                                            $('#check').attr('disabled', false);
                                            $('#icon-spinner').hide();
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
                                    $('input[type=checkbox]').prop('disabled', false);
                                    $('#icon-spinner').hide();
                                }

                            },
                            error: function() {
                                lostconnection()
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