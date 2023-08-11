<?php
require '../../config.php';
?>
<script src="<?= base_url('_assets/src/add/jquery/jquery-3.4.1.js') ?>"></script>
<script src="<?= base_url('_assets/src/add/datatables_bootstrap5/datatables.js') ?>"></script>
<!-- <script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script> -->
<script src="<?= base_url('_assets/src/add/dropdown_search/select2.min.js') ?>"></script>
<!-- <script src="../source/dropdown_search/select2.min.js"></script> -->
<script src="<?= base_url('_assets/src/add/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>
<!-- <script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script> -->
<script src="<?= base_url('_assets/src/add/EChart/echarts.js') ?>"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<div class="row">
    <div class="col-12">
        <button id="add" class="btn btn-success btn-sm" style="width: 100px; display: none;">Add <i class="fa fa-plus-square"></i></button>
        <!-- Modal add ng start -->
        <div class="modal fade" id="tambahng" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Piano</h1>
                    </div>
                    <div class="modal-body">
                        <form id="myform">
                            <div class="row">
                                <div class="col-4 mb-1">
                                    <input id="gmcpiano" style="text-align: center;" oninput="this.value=this.value.toUpperCase()" type="text" class="form-control" placeholder="GMC">
                                </div>
                                <div class="col-8 mb-1">
                                    <input readonly id="namepiano" style="text-align: center;" type="text" class="form-control" placeholder="Piano Name">
                                    <div id="errornama" class="col-12" style="text-align: center; color: red; padding-top: 5px;display: none;">Piano tidak ditemukan!</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label>Completeness Model Form :</label>
                                    <select class="halodecktot-tambah" id="completeness" name="ng" style="width:100%; height: max-content;">
                                        <option value="" selected disabled>Select Model</option>
                                        <optgroup label="Model Furniture">
                                            <?php
                                            $sql1 = mysqli_query($connect_pro, "SELECT c_code_model FROM finalcheck_list_specific_model WHERE c_code_model LIKE 'f-%' ORDER BY c_code_model ASC");
                                            while ($data1 = mysqli_fetch_array($sql1)) {
                                            ?>
                                                <option value="<?= $data1['c_code_model'] ?>"><?= $data1['c_code_model'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </optgroup>
                                        <optgroup label="Model Polyester">
                                            <?php
                                            $sql1 = mysqli_query($connect_pro, "SELECT c_code_model FROM finalcheck_list_specific_model WHERE c_code_model LIKE 'p-%' ORDER BY c_code_model ASC");
                                            while ($data1 = mysqli_fetch_array($sql1)) {
                                            ?>
                                                <option value="<?= $data1['c_code_model'] ?>"><?= $data1['c_code_model'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </optgroup>
                                        <optgroup label="Model Silent">
                                            <?php
                                            $sql1 = mysqli_query($connect_pro, "SELECT c_code_model FROM finalcheck_list_specific_model WHERE c_code_model LIKE 's-%' ORDER BY c_code_model ASC");
                                            while ($data1 = mysqli_fetch_array($sql1)) {
                                            ?>
                                                <option value="<?= $data1['c_code_model'] ?>"><?= $data1['c_code_model'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </optgroup>
                                    </select>
                                    <div id="errorcompleteness" class="col-12" style="text-align: center; color: red; padding-top: 5px;display: none;">Model Completeness tidak boleh kosong!</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Outside Check Form :</label>
                                    <select class="halodecktot-tambah2" id="outside" name="ng" style="width:100%; height: max-content;">
                                        <option value="" selected disabled>Select Model</option>
                                        <option value="p">Polyester</option>
                                        <option value="f">Furniture</option>
                                    </select>
                                    <div id="erroroutside" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Tipe Outside tidak boleh kosong!</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="canceltambahngbtn" class="btn btn-secondary close-mdl-ng" onclick="cancelbtnmdl()" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="tambahngbtn" onclick="tambahdatang()" class="btn btn-primary">Add Piano <i id="icon-spinner-add" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal add ng end -->
    </div>
</div>
<div class="row">
    <!-- <h5 style="color: #464646; font-weight: bold;">NG Trend of Inside Check</h5> -->
    <div class="col-12" id="insideshow" style="display: none;">
    </div>
    <div id="loadinginside" class="col-12" style="text-align: center; height: 300px; padding-top: 80px;">
        <div class="row">
            <div class="col-12">
                <img src="<?= base_url('_assets/production/images/loading_greys.png') ?>" style="animation: rotation 2s infinite linear;  height:50px" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                Loading
            </div>
        </div>
    </div>
</div>
<hr class="mt-3">

<script>
    // load function halaman untuk pertama kali
    loaddata();

    // tombol open modal
    $('#add').click(function() {
        $('#tambahng').modal('toggle');
    })

    // function search gmc
    $("#gmcpiano").keyup(function() {
        var gmc = $("#gmcpiano").val();
        $.ajax({
            url: "management/j_datapiano/addpiano/cekgmc.php",
            method: "POST",
            data: {
                "gmc": gmc
            },
            success: function(data) {
                var data = JSON.parse(data);
                if (data.value == 'x') {
                    $('#namepiano').val('');
                } else {
                    $('#namepiano').val(data.value);
                }
            },
            error: function() {
                lostconnection()
            }
        });
    });

    // tombol cancel
    function cancelbtnmdl() {
        $('#gmcpiano').val('');
        $('#namepiano').val('');
        $('#completeness').val('').trigger('change');
        $('#outside').val('').trigger('change');
    }

    // tombol tambah
    function tambahdatang() {
        $('#icon-spinner-add').show();
        $('#tambahngbtn').prop('disabled', true);
        $('#canceltambahngbtn').prop('disabled', true);
        var gmc = $('#gmcpiano').val();
        var name = $('#namepiano').val();
        var completeness = $('#completeness').val();
        var outside = $('#outside').val();
        if (name == '-' || name == '') {
            $('#icon-spinner-add').hide();
            $('#tambahngbtn').prop('disabled', false);
            $('#canceltambahngbtn').prop('disabled', false);
            // error nama
            // scoll dengan gaya
            document.getElementById('namepiano').scrollIntoView({
                behavior: 'smooth'
            });
            $('#errornama').show();
            setTimeout(function() {
                $('#errornama').hide()
            }, 3000);
        } else {
            if (completeness == null) {
                $('#icon-spinner-add').hide();
                $('#tambahngbtn').prop('disabled', false);
                $('#canceltambahngbtn').prop('disabled', false);
                // error completeness
                // scoll dengan gaya
                document.getElementById('completeness').scrollIntoView({
                    behavior: 'smooth'
                });
                $('#errorcompleteness').show();
                setTimeout(function() {
                    $('#errorcompleteness').hide()
                }, 3000);
            } else {
                if (outside == null) {
                    $('#icon-spinner-add').hide();
                    $('#tambahngbtn').prop('disabled', false);
                    $('#canceltambahngbtn').prop('disabled', false);
                    // error outside
                    // scoll dengan gaya
                    document.getElementById('outside').scrollIntoView({
                        behavior: 'smooth'
                    });
                    $('#erroroutside').show();
                    setTimeout(function() {
                        $('#erroroutside').hide()
                    }, 3000);
                } else {
                    Swal.fire({
                        title: 'Apakah anda yakin ?',
                        icon: 'question',
                        html: 'Anda akan menambah piano <b>' + name + '</b>',
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Iya',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "management/j_datapiano/addpiano/dataadd.php",
                                type: "POST",
                                data: {
                                    "gmc": gmc,
                                    "name": name,
                                    "completeness": completeness,
                                    "outside": outside
                                },
                                success: function(data) {
                                    var data = JSON.parse(data);
                                    if (data.status == 'berhasil') {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Piano baru berhasil ditambah',
                                            icon: 'success',
                                            // timer: 2000,
                                            showCancelButton: false,
                                            showConfirmButton: true,
                                            confirmButtonText: 'Oke'
                                        }).then(function() {
                                            $('.close-mdl-ng').trigger('click');
                                            loaddata();
                                        });
                                    } else if (data.status == 'exist') {
                                        Swal.fire({
                                            title: 'Piano sudah ada!',
                                            text: 'Piano sudah pernah ditambahkan, silahkan cek kembali pada tabel',
                                            icon: 'error',
                                            // timer: 2000,
                                            showCancelButton: false,
                                            showConfirmButton: true,
                                            confirmButtonText: 'Oke'
                                        })
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: 'Data gagal ditambah',
                                            icon: 'error',
                                            showCancelButton: false,
                                            showConfirmButton: true,
                                            confirmButtonText: 'Oke'
                                        })
                                    };
                                    $('#icon-spinner-add').hide();
                                    $('#tambahngbtn').prop('disabled', false);
                                    $('#canceltambahngbtn').prop('disabled', false);
                                },
                                error: function() {
                                    $('#icon-spinner-add').hide();
                                    $('#tambahngbtn').prop('disabled', false);
                                    $('#canceltambahngbtn').prop('disabled', false);
                                    lostconnection();
                                }
                            });
                        } else {
                            $('#tambahngbtn').prop('disabled', false);
                            $('#canceltambahngbtn').prop('disabled', false);
                            $('#icon-spinner-add').hide();
                        }
                    });
                }
            }
        }
    }

    // function load halaman
    function loaddata() {
        // get data inside
        $.ajax({
            url: "management/j_datapiano/addpiano/index.php",
            type: "POST",
            success: function(data) {
                $('#insideshow').show();
                $('#add').show();
                $('#lock').show();
                $('#unlock').hide();
                $('#loadinginside').hide();
                $('#insideshow').html(data);
            },
            error: function() {
                lostconnection()
            }
        });
    }

    // select 2
    $('.halodecktot-tambah').select2({
        placeholder: " Pilih Model",
        language: "id",
        allowClear: true,
        dropdownParent: $('#tambahng'),

    });

    // select 2
    $('.halodecktot-tambah2').select2({
        placeholder: " Pilih Tipe",
        language: "id",
        allowClear: true,
        dropdownParent: $('#tambahng'),

    });
</script>