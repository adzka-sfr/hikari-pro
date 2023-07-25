<?php
// get connection
require '../config.php';

// aktif ketika data ditemukan dari file check.php
// get data lemparan
$serialnumber = isset($_POST['serialnumber']) ? $_POST['serialnumber'] : '';

// get tanggal register
$q100 = mysqli_query($connect_pro, "SELECT c_outsidesatu_i FROM finalcheck_timestamp WHERE c_serialnumber = '$serialnumber'");
$d100 = mysqli_fetch_array($q100);
$inspection_date = date('l, d M Y h:i A', strtotime($d100['c_outsidesatu_i']));

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
?>
<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>
<!-- <script src="<?= base_url('_assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script> -->
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

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
                    <?= $inspection_date ?>
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
        <button type="button" class="btn btn-primary" onclick="addngmodal()">
            <b>Tambah NG</b> <i class="fa fa-plus"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="tambahng" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah NG</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <form id="myform">
                            <!-- setup add ng -->
                            <input type="hidden" id="serialnumberaddng" name="serialnumber" value="<?= $serialnumber ?>">
                            <input type="hidden" id="processaddng" name="process" value="<?= $publicprocess ?>">
                            <input type="hidden" id="codetypeaddng" name="codetype" value="<?= $c_code_type ?>">
                            <!-- setup add ng -->
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <label>Nama NG :</label>
                                    <select class="halodecktot-tambah" id="ngAdd" name="ng" style="width:100%; height: max-content;">
                                        <option value="" selected disabled>Select NG</option>
                                        <?php
                                        $sql1 = mysqli_query($connect_pro, "SELECT c_code_ng, c_name FROM finalcheck_list_ng WHERE c_status = 'enable' AND c_area = 'outside'");
                                        while ($data1 = mysqli_fetch_array($sql1)) {
                                        ?>
                                            <option value="<?= $data1['c_code_ng'] ?>"><?= $data1['c_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div id="errorng" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Nama NG tidak boleh kosong!</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-3 mb-1">
                                    <label>Nama Kabinet :</label>
                                    <select class="halodecktot" id="cabAdd" name="cab[]" multiple="multiple" style="width:100%; height: max-content;">
                                        <?php
                                        $sql1 = mysqli_query($connect_pro, "SELECT c_code_cabinet, c_name FROM finalcheck_list_cabinet WHERE c_status = 'enable'");
                                        while ($data1 = mysqli_fetch_array($sql1)) {
                                        ?>
                                            <option value="<?= $data1['c_code_cabinet'] ?>"><?= $data1['c_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div id="errorcab" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Nama kabinet tidak boleh kosong!</div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <center>
                                        <div class="containere">
                                            <img src="../art/<?= $c_code_type ?>/tbo.<?= $format ?>" style="width:100%">
                                            <?php

                                            $c_image = 'tbo';
                                            $sql = mysqli_query($connect_pro, "SELECT c_code_coordinate, c_top, c_left FROM finalcheck_list_coordinate WHERE c_code_type = '$c_code_type' AND c_image = '$c_image'");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="checkbox" class="chck" name="<?= $c_image ?>[]" value="<?= $data['c_code_coordinate'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <center>
                                        <div class="containere">
                                            <img src="../art/<?= $c_code_type ?>/tbi.<?= $format ?>" style="width:100%">
                                            <?php

                                            $c_image = 'tbi';
                                            $sql = mysqli_query($connect_pro, "SELECT c_code_coordinate, c_top, c_left FROM finalcheck_list_coordinate WHERE c_code_type = '$c_code_type' AND c_image = '$c_image'");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="checkbox" class="chck" name="<?= $c_image ?>[]" value="<?= $data['c_code_coordinate'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <center>
                                        <div class="containere">
                                            <img src="../art/<?= $c_code_type ?>/uk.<?= $format ?>" style="width:100%">
                                            <?php
                                            $c_image = 'uk';
                                            $sql = mysqli_query($connect_pro, "SELECT c_code_coordinate, c_top, c_left FROM finalcheck_list_coordinate WHERE c_code_type = '$c_code_type' AND c_image = '$c_image'");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="checkbox" class="chck" name="<?= $c_image ?>[]" value="<?= $data['c_code_coordinate'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <center>
                                        <div class="containere">
                                            <img src="../art/<?= $c_code_type ?>/b.<?= $format ?>" style="width:100%">
                                            <?php

                                            $c_image = 'b';
                                            $sql = mysqli_query($connect_pro, "SELECT c_code_coordinate, c_top, c_left FROM finalcheck_list_coordinate WHERE c_code_type = '$c_code_type' AND c_image = '$c_image'");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="checkbox" class="chck" name="<?= $c_image ?>[]" value="<?= $data['c_code_coordinate'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <center>
                                        <div class="containere">
                                            <img src="../art/<?= $c_code_type ?>/bb.<?= $format ?>" style="width:100%">
                                            <?php

                                            $c_image = 'bb';
                                            $sql = mysqli_query($connect_pro, "SELECT c_code_coordinate, c_top, c_left FROM finalcheck_list_coordinate WHERE c_code_type = '$c_code_type' AND c_image = '$c_image'");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="checkbox" class="chck" name="<?= $c_image ?>[]" value="<?= $data['c_code_coordinate'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="canceltambahngbtn" class="btn btn-secondary close-mdl-ng" onclick="cancelbtnmdl()" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="tambahngbtn" onclick="tambahdatang()" class="btn btn-primary">Add NG <i id="icon-spinner-add" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

        <table class="table table-bordered">
            <thead style="text-align: center;">
                <th style="width: 10%;">No</th>
                <th>Detail NG</th>
            </thead>
            <tbody style="display: none;" id="detail_ng">
            </tbody>
            <tbody id="detail_ng_loading">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        Loading...
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal Edit -->
        <div class="modal fade" id="editngmodal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><b id="editjudul"></b>
                        </h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <form id="myformedit">
                            <!-- setup add ng -->
                            <input type="hidden" id="serialnumbereditng" name="serialnumber">
                            <input type="hidden" id="processeditng" name="process" value="<?= $publicprocess ?>">
                            <input type="hidden" id="codetypeeditng" name="codetype">
                            <input type="hidden" id="numbereditng" name="numberng">
                            <input type="hidden" id="ngedit" name="ng">
                            <!-- setup add ng -->
                            <div class="row">
                                <div class="col-12 mt-3 mb-1">
                                    <label>Nama Kabinet :</label>
                                    <select class="halodecktot" id="cabedit" name="cabedit[]" multiple="multiple" style="width:100%; height: max-content;">
                                        <?php
                                        $sql1 = mysqli_query($connect_pro, "SELECT c_code_cabinet, c_name FROM finalcheck_list_cabinet WHERE c_status = 'enable'");
                                        while ($data1 = mysqli_fetch_array($sql1)) {
                                        ?>
                                            <option value="<?= $data1['c_code_cabinet'] ?>"><?= $data1['c_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div id="errorcabedit" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Nama kabinet tidak boleh kosong!</div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <center>
                                        <div class="containere">
                                            <img src="../art/<?= $c_code_type ?>/tbo.<?= $format ?>" style="width:100%">
                                            <?php

                                            $c_image = 'tbo';
                                            $sql = mysqli_query($connect_pro, "SELECT c_code_coordinate, c_top, c_left FROM finalcheck_list_coordinate WHERE c_code_type = '$c_code_type' AND c_image = '$c_image'");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="checkbox" class="chck" name="<?= $c_image ?>[]" id="<?= $data['c_code_coordinate'] ?>" value="<?= $data['c_code_coordinate'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <center>
                                        <div class="containere">
                                            <img src="../art/<?= $c_code_type ?>/tbi.<?= $format ?>" style="width:100%">
                                            <?php

                                            $c_image = 'tbi';
                                            $sql = mysqli_query($connect_pro, "SELECT c_code_coordinate, c_top, c_left FROM finalcheck_list_coordinate WHERE c_code_type = '$c_code_type' AND c_image = '$c_image'");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="checkbox" class="chck" name="<?= $c_image ?>[]" id="<?= $data['c_code_coordinate'] ?>" value="<?= $data['c_code_coordinate'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <center>
                                        <div class="containere">
                                            <img src="../art/<?= $c_code_type ?>/uk.<?= $format ?>" style="width:100%">
                                            <?php

                                            $c_image = 'uk';
                                            $sql = mysqli_query($connect_pro, "SELECT c_code_coordinate, c_top, c_left FROM finalcheck_list_coordinate WHERE c_code_type = '$c_code_type' AND c_image = '$c_image'");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="checkbox" class="chck" name="<?= $c_image ?>[]" id="<?= $data['c_code_coordinate'] ?>" value="<?= $data['c_code_coordinate'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <center>
                                        <div class="containere">
                                            <img src="../art/<?= $c_code_type ?>/b.<?= $format ?>" style="width:100%">
                                            <?php

                                            $c_image = 'b';
                                            $sql = mysqli_query($connect_pro, "SELECT c_code_coordinate, c_top, c_left FROM finalcheck_list_coordinate WHERE c_code_type = '$c_code_type' AND c_image = '$c_image'");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="checkbox" class="chck" name="<?= $c_image ?>[]" id="<?= $data['c_code_coordinate'] ?>" value="<?= $data['c_code_coordinate'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-12" style="text-align: center;">
                                    <center>
                                        <div class="containere">
                                            <img src="../art/<?= $c_code_type ?>/bb.<?= $format ?>" style="width:100%">
                                            <?php
                                            $c_image = 'bb';
                                            $sql = mysqli_query($connect_pro, "SELECT c_code_coordinate, c_top, c_left FROM finalcheck_list_coordinate WHERE c_code_type = '$c_code_type' AND c_image = '$c_image'");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="checkbox" class="chck" name="<?= $c_image ?>[]" id="<?= $data['c_code_coordinate'] ?>" value="<?= $data['c_code_coordinate'] ?>" style="width: 30px; height: 30px; top: <?= $data['c_top'] ?>%; left: <?= $data['c_left'] ?>%; accent-color: #FF0000;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <hr>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="canceldatangbtn" class="btn btn-secondary close-mdl-ng" onclick="cancelbtnmdl()" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="editdatangbtn" onclick="editdatang()" class="btn btn-primary">Edit NG <i id="icon-spinner-edit" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function addngmodal() {
                $('#tambahng').modal('toggle');
            }

            function editng(id, codeng, nameng, numberng, serialnumber) {
                // untuk membersihkan checklist
                $('.chck').prop('checked', false);
                // untuk membuka modal
                $('#editngmodal').modal('toggle');
                // untuk menambah judul
                $('#editjudul').html(nameng);
                // untuk mengisi value ngedit
                $('#ngedit').val(codeng);
                // untuk mengisi serialnumber
                $('#serialnumbereditng').val(serialnumber);
                // untuk nomor ng
                $('#numbereditng').val(numberng);
                // untuk mengisi value process dan code_type (SEPERTINYA GADIPAKE)
                $.ajax({
                    url: "outside1/data6.php",
                    type: "POST",
                    data: {
                        "serialnumber": serialnumber
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        // $('#processeditng').val(data.process);
                        $('#codetypeeditng').val(data.codetype);
                    }
                });
                // untuk mengisi value select cabinet
                $.ajax({
                    url: "outside1/data4.php",
                    type: "POST",
                    data: {
                        "codeng": codeng,
                        "serialnumber": serialnumber
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        console.log(data.cabinet);
                        console.log(typeof data.cabinet);
                        $.each($("#cabedit"), function() {
                            $(this).val(data.cabinet).trigger('change');
                            //         $('#supplier').val(null).trigger('change.select2');
                        });
                    }
                });

                // untuk mengisi value checklist image
                $.ajax({
                    url: "outside1/data5.php",
                    type: "POST",
                    data: {
                        "numberng": numberng,
                        "serialnumber": serialnumber
                    },
                    success: function(data) {

                        var data = JSON.parse(data);
                        console.log(data.coordinate);
                        console.log(typeof data.coordinate);
                        data.coordinate.forEach(function(item) {
                            // do something with `item`
                            $('#' + item).prop('checked', true);
                        });
                    }
                });
            }
        </script>
        <!-- Modal Edit -->

    </div>
    <div style="display: none;" class="col-6" id="image_ng">
    </div>
    <div class="col-6" id="image_ng_loading">
        <!-- tbo image -->
        <div class="row">
            <div class="col-12">
                <div class="containere">
                    <img src="../art/<?= $c_code_type ?>/tbo.<?= $format ?>" style="width:100%; opacity: 60%;">
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
                    <img src="../art/<?= $c_code_type ?>/tbi.<?= $format ?>" style="width:100%; opacity: 60%;">
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
                    <img src="../art/<?= $c_code_type ?>/uk.<?= $format ?>" style="width:100%; opacity: 60%;">
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
                    <img src="../art/<?= $c_code_type ?>/b.<?= $format ?>" style="width:100%; opacity: 60%;">
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
                    <img src="../art/<?= $c_code_type ?>/bb.<?= $format ?>" style="width:100%; opacity: 60%;">
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
                    var response = JSON.parse(response);
                    $('#note1').html(response.note1);
                }
            });
        })

        $('#note1').blur(function() {
            var serialnumber = $('#serialnumber').val();
            var note = $('#note1').val();
            console.log(note);
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
                    var response = JSON.parse(response);
                    $('#note1').html(response.note1);
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
    <div class="col-6 mb-5" style="text-align: left;">
        <button class="btn btn-success" id="check" style="width: 80%;"><i id="icon-spinner" style="display: none;" class="fa fa-spinner fa-spin"></i><i id="icon-spinner-main" class="fa fa-arrow-circle-left"></i> Kembali, Cek Completeness</button>
        <script>
            var serialnumber = $('#serialnumberaddng').val();
            var codetype = $('#codetypeaddng').val();
            $(document).ready(function() {
                load_data_ng(serialnumber);
                load_image_ng(serialnumber, codetype);
            })
            $('#check').click(function() {
                $('#check').attr('disabled', true);
                $('#icon-spinner').show();
                $('#icon-spinner-main').hide();
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
            })
        </script>
    </div>
    <div class="col-6 mb-5" style="text-align: right;">
        <button class="btn btn-success" id="send" style="width: 80%;">Kirim, ke Repair Outside <i id="icon-main-cart" class="fa fa-shopping-cart"></i><i id="icon-spinner-cart" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
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
                        $('#icon-main-cart').hide();
                        $('#icon-spinner-cart').show();
                        $('#send').attr('disabled', true);
                        $('#check').attr('disabled', true);
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
<hr>
<!-- script tambahan -->
<script>
    // sudah selesai load baru disable loading
    $('#acard').attr("readonly", true);
    $('#scanner').hide();
    $('#clearacard').show();
    $('#loadingacard').hide();

    $('.halodecktot-tambah').select2({
        placeholder: " Pilih NG",
        language: "id",
        allowClear: true,
        dropdownParent: $('#tambahng'),

    });
    $('.halodecktot').select2({
        placeholder: " Pilih NG",
        language: "id",
        allowClear: true,

    });
</script>
<!-- formulir cek inside -->