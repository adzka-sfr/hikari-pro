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

// [SELECT : finalcheck_fetch_incheck] get tanggal NG -> maks (c_result_date) and c_result=ng || finalcheck_fetch_incheck
$sql1 = mysqli_query($connect_pro, "SELECT max(c_result_date) AS ng_date FROM finalcheck_fetch_incheck WHERE c_serialnumber = '$pianoserial' AND c_result = 'NG'");
$data1 = mysqli_fetch_array($sql1);
$ng_date = '-';
if ($data1['ng_date'] != '') {
    $ng_date = date('d-m-Y', strtotime($data1['ng_date']));
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
if ($data2['c_repair_inside_o'] != '') {
    $ok_date = date('d-m-Y', strtotime($data2['ng_date']));
}
if ($data2['c_inside_pic'] != '') {
    $repair = $data2['c_inside_pic'];
}
?>

<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>

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
                    <?= date('l, d M Y', strtotime($now)) ?>
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

<!-- formulir cek inside -->
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
        $sql = mysqli_query($connect_pro, "SELECT a.c_code_incheck, a.c_code_ng, a.c_result, b.c_detail FROM finalcheck_fetch_incheck a INNER JOIN finalcheck_list_incheck b ON a.c_code_incheck = b.c_code_incheck WHERE a.c_serialnumber = '$pianoserial'");
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
                $rowspan = count($code_ng);
                $rowspan++;
            ?>
                <tr style="background-color: #ED9DA5;">
                    <td rowspan="<?= $rowspan ?>" style="text-align: center;"><?= $no ?></td>
                    <td>
                        <?= $data['c_detail'] ?>
                        <b><u> <?= $data['c_code_incheck'] ?></u></b> <i><?= $rowspan ?></i>
                    </td>
                    <td style="text-align: center; font-size: 15px;">NG</td>
                    <td><?= $repair ?></td>
                </tr>
                <?php
                foreach ($code_ng as $value) {
                    array_push($arr_ng, $value);
                    $sql3 = mysqli_query($connect_pro, "SELECT c_name FROM finalcheck_list_ng WHERE c_code_ng = '$value'");
                    $data3 = mysqli_fetch_array($sql3);
                ?>
                    <tr>
                        <td style="font-size: 15px;">- <?= $data3['c_name'] ?></td>
                        <td style="text-align: center;"><input id="cekbok<?= $value ?>" onchange="cekbok(this.id, '<?= $data['c_code_incheck'] ?>')" value="<?= $value ?>" type="checkbox" style="transform: scale(2);">

                        </td>
                        <td style="text-align: center;"></td>
                    </tr>

                <?php
                }
                ?>

            <?php
            } else {
            ?>
                <tr>
                    <td style=" text-align: center;"><?= $no ?></td>
                    <td style="font-size: 15px;"><?= $data['c_detail'] ?></td>
                    <td style="text-align: center; font-size: 15px;"></td>
                </tr>
            <?php
            }
            ?>

            <script>
                var awal = $('#awalstatus<?= $no ?>').val();
                $('.radioku<?= $no ?>').change(function() {
                    $('#ngcode<?= $no ?>').prop('disabled', !$(this).is('.ng<?= $no ?>'));

                    // get data
                    selected_value = $("input[name='pil<?= $no ?>']:checked").val();
                    var code = $('#item<?= $no ?>').val();
                    var serialnumber = $('#serialnumber').val();
                    console.log(selected_value);
                    console.log(code);
                    console.log(serialnumber);

                    // jika radio button OK, maka set value kosong untuk select
                    if (selected_value == 'OK') {
                        console.log('berhasil get OK');
                        $('#ngcode<?= $no ?>').val('').trigger('change');
                    }

                    // ajax untuk melakukan update
                    $.ajax({
                        url: 'insidecheck/data.php',
                        type: 'POST',
                        data: {
                            "serialnumber": serialnumber,
                            "code": code,
                            "res": selected_value
                        },
                        success: function(response) {
                            console.log(response);

                        }
                    });
                });

                if (awal == 'NG') {
                    $('#ngcode<?= $no ?>').prop('disabled', false);
                }

                $('#ngcode<?= $no ?>').change(function() {
                    var code = $('#item<?= $no ?>').val();
                    var serialnumber = $('#serialnumber').val();
                    var ngcode = $('#ngcode<?= $no ?>').val();
                    console.log(ngcode);
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
                })
            </script>
            <script>
                // $('#radio_box<?= $no ?>').change(function() {
                //     selected_value = $("input[name='pil<?= $no ?>']:checked").val();
                //     var code = $('#item<?= $no ?>').val();
                //     var serialnumber = $('#serialnumber').val();
                //     console.log(selected_value);
                //     console.log(code);
                //     console.log(serialnumber);
                //     // ajax untuk melakukan update
                //     $.ajax({
                //         url: 'insidecheck/data.php',
                //         type: 'POST',
                //         data: {
                //             "serialnumber": serialnumber,
                //             "code": code,
                //             "res": selected_value
                //         },
                //         success: function(response) {
                //             console.log(response);
                //         }
                //     });

                //     if (selected_value == 'NG') {
                //         $('#pilihan<?= $no ?>').prop('disabled', false);
                //         $('#pilihan<?= $no ?>').change(function() {
                //             var jenis = $('#pilihan<?= $no ?>').val();
                //             // $.ajax({
                //             //     url: 'data2.php',
                //             //     type: 'POST',
                //             //     data: {
                //             //         "jenis": jenis,
                //             //         "item": item
                //             //     },
                //             //     success: function(response) {
                //             //         console.log(response);
                //             //     }
                //             // });
                //         })

                //     } else if (selected_value == 'OK') {
                //         $('#pilihan<?= $no ?>').val('').trigger('change');
                //         $('#pilihan<?= $no ?>').prop('disabled', true);
                //     }

                // });
            </script>
        <?php
        }
        ?>
        <script>
            var checkbox = <?= json_encode($arr_ng) ?>;

            function cekbok(id, item) {
                var data_ng = [];
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

                    data_ng.push(ngcode);
                }

                $.ajax({
                    url: 'insidecheck/data6.php',
                    type: 'POST',
                    data: {
                        "serialnumber": serialnumber,
                        "ngcode": data_ng,
                        "code": item
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        </script>
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