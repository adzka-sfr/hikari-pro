<?php
// get connection
require '../config.php';

// aktif ketika data ditemukan dari file check.php
// get data lemparan
$serialnumber = isset($_POST['serialnumber']) ? $_POST['serialnumber'] : '';

// get tanggal register
$q100 = mysqli_query($connect_pro, "SELECT c_completenesssatu_i FROM finalcheck_timestamp WHERE c_serialnumber = '$serialnumber'");
$d100 = mysqli_fetch_array($q100);
$inspection_date = date('l, d M Y h:i A', strtotime($d100['c_completenesssatu_i']));

// get informasi piano
$sql = mysqli_query($connect_pro, "SELECT b.c_name FROM finalcheck_register a INNER JOIN finalcheck_list_piano b ON a.c_gmc = b.c_gmc WHERE a.c_serialnumber = '$serialnumber' ");
$data = mysqli_fetch_array($sql);
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
        $sql = mysqli_query($connect_pro, "SELECT a.c_code_completeness,a.c_resultsatu, b.c_detail FROM finalcheck_fetch_completeness a INNER JOIN finalcheck_list_completeness b ON a.c_code_completeness = b.c_code_completeness WHERE c_serialnumber = '$serialnumber'");
        while ($data = mysqli_fetch_array($sql)) {
            $checkcom = '';
            if ($data['c_resultsatu'] == 'Y') {
                $checkcom = 'checked';
            }
            $no++;
        ?>
            <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td style="font-size: 15px;"><?= $data['c_detail'] ?></td>
                <td style="font-size: 15px; text-align: center;"><input id="cekbok<?= $data['c_code_completeness'] ?>" onchange="cekbok1(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" <?= $checkcom ?> style="transform: scale(2);"></td>
                <td style="font-size: 15px; text-align: center;"><input disabled id="cekbok<?= $data['c_code_completeness'] ?>" onchange="cekbok2(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" style="transform: scale(2);"></td>
                <td style="font-size: 15px; text-align: center;"><input disabled id="cekbok<?= $data['c_code_completeness'] ?>" onchange="cekbok3(this.id)" value="<?= $data['c_code_completeness'] ?>" type="checkbox" style="transform: scale(2);"></td>
            </tr>
        <?php
        }
        ?>
        <script>
            var serialnumber = $('#serialnumber').val();

            function cekbok1(id) {
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
                    url: 'outside1/data.php',
                    type: 'POST',
                    data: {
                        "serialnumber": serialnumber,
                        "code": code,
                        "result": result
                    },
                    success: function(response) {
                        console.log(response);
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
                url: 'outside1/data1.php',
                type: 'POST',
                data: {
                    "serialnumber": serialnumber,
                    "note": note,
                    "stat": stat
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    $('#note1').html(response.note1);
                }
            });
        })

        $('#note1').blur(function() {
            var serialnumber = $('#serialnumber').val();
            var note = $('#note1').val();
            var stat = 'update';
            $.ajax({
                url: 'outside1/data1.php',
                type: 'POST',
                data: {
                    "serialnumber": serialnumber,
                    "note": note,
                    "stat": stat
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    $('#note1').html(response.note1);
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
    <div class="col-6"></div>
    <div class="col-6 mb-5" style="text-align: right;">
        <button class="btn btn-success" id="check" style="width: 80%;">Lanjut, Cek Outside <i id="icon-spinner-main" class="fa fa-arrow-circle-right"></i><i id="icon-spinner" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
        <script>
            $('#check').click(function() {
                $('#check').attr('disabled', true);
                $('#icon-spinner').show();
                $('#icon-spinner-main').hide();
                var dataString = {
                    serialnumber: $('#serialnumber').val(),
                };
                $.ajax({
                    url: "outside1/data9.php",
                    type: "POST",
                    data: {
                        "serialnumber": serialnumber
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 'DONE') {
                            $.ajax({
                                url: "outside1/pagedata2.php",
                                type: "POST",
                                data: dataString,
                                success: function(data) {
                                    $('#pagedata').show();
                                    $('#pagedata').html(data);
                                    window.scrollTo(0, 100);
                                    return false;
                                }
                            });
                        } else if (response.status == 'NOT-YET') {
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
                                    $.ajax({
                                        url: "outside1/pagedata2.php",
                                        type: "POST",
                                        data: dataString,
                                        success: function(data) {
                                            $('#pagedata').show();
                                            $('#pagedata').html(data);
                                            window.scrollTo(0, 100);
                                            return false;
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