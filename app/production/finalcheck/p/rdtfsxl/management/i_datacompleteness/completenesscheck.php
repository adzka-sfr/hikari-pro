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
    <div class="col-6">
        <button id="add" class="btn btn-success btn-sm" style="width: 150px; display: none;">Add completeness <i class="fa fa-plus-square"></i></button>
        <button id="addmodel" class="btn btn-success btn-sm" style="width: 150px; display: none;">Add model <i class="fa fa-plus-square"></i></button>
        <!-- Modal add ng start -->
        <div class="modal fade" id="tambahng" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- kalau mau scrollable : modal-dialog-scrollable -->
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Proses Cek Completeness</h1>
                    </div>
                    <div class="modal-body">
                        <form id="myform">
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <label>Nama proses :</label>
                                    <textarea id="processname" class="form-control"></textarea>
                                    <div id="errornama" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Nama proses tidak boleh kosong!</div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <span style="font-size: 0.7rem; ">Note: Penambahan proses akan berdampak pada seluruh model dengan status '<u style="color:red;"><i>disable</i></u>', jika ingin mengaktifkan silahkan melakukan ceklis pada kolom model yang di inginkan</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="canceltambahngbtn" class="btn btn-secondary close-mdl-ng" onclick="cancelbtnmdl()" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="tambahngbtn" onclick="tambahdatang()" class="btn btn-primary">Add Process <i id="icon-spinner-add" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal add ng end -->
        <!-- Modal add model start -->
        <div class="modal fade" id="tambahng2" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- kalau mau scrollable : modal-dialog-scrollable -->
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Model</h1>
                    </div>
                    <div class="modal-body">
                        <form id="myform">
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <label>Tipe :</label>
                                    <select class="halodecktot-model" id="selecttype" style="width:100%; height: max-content;">
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="s">Silent</option>
                                        <option value="f">Furniture</option>
                                        <option value="p">Polyester</option>
                                    </select>
                                    <div id="errortipe" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Tipe tidak boleh kosong!</div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <label>Nama model :</label>
                                    <textarea id="modelname" class="form-control"></textarea>
                                    <div id="errormodel" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Nama model tidak boleh kosong!</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <span style="font-size: 0.7rem; ">Note: Setelah model baru berhasil ditambah, silahkan melakukan ceklis untuk menyesuaikan completeness terkait model baru tersebut</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="canceltambahngbtn2" class="btn btn-secondary close-mdl-ng" onclick="cancelbtnmdl()" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="tambahngbtn2" onclick="tambahdatang2()" class="btn btn-primary">Add Model <i id="icon-spinner-add2" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal add model end -->
    </div>
    <div class="col-6 text-right">
        <button id="lock" class="btn btn-danger btn-sm" style="width: 100px; display: none;">Edit <i class="fa fa-lock"></i></button>
        <button id="unlock" class="btn btn-primary btn-sm" style="width: 100px; display: none;">Edit <i class="fa fa-unlock"></i></button>
    </div>
</div>
<hr>
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

    // tombol open modal completeness
    $('#add').click(function() {
        $('#tambahng').modal('toggle');
    })

    // tombol open modal model
    $('#addmodel').click(function() {
        $('#tambahng2').modal('toggle');
    })

    // tombol cancel
    function cancelbtnmdl() {
        $('#processname').val('');
        $('#selecttype').val('').trigger('change');
        $('#modelname').val('');
    }

    // tombol tambah completeness
    function tambahdatang() {
        $('#icon-spinner-add').show();
        $('#tambahngbtn').prop('disabled', true);
        $('#canceltambahngbtn').prop('disabled', true);
        var processname = $('#processname').val();
        if (processname == '') {
            $('#icon-spinner-add').hide();
            $('#tambahngbtn').prop('disabled', false);
            $('#canceltambahngbtn').prop('disabled', false);
            // error nama
            // scoll dengan gaya
            document.getElementById('processname').scrollIntoView({
                behavior: 'smooth'
            });
            $('#errornama').show();
            setTimeout(function() {
                $('#errornama').hide()
            }, 3000);
        } else {
            Swal.fire({
                title: 'Apakah anda yakin ?',
                icon: 'question',
                html: 'Anda akan menambah proses completeness <b>' + processname + '</b>',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "management/i_datacompleteness/completenesscheck/dataaddcompleteness.php",
                        type: "POST",
                        data: {
                            "processname": processname
                        },
                        success: function(data) {
                            $('#icon-spinner-add').hide();
                            $('#tambahngbtn').prop('disabled', false);
                            $('#canceltambahngbtn').prop('disabled', false);
                            var data = JSON.parse(data);
                            if (data.status == 'berhasil') {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Pengecekan completeness baru berhasil ditambah',
                                    icon: 'success',
                                    // timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: true,
                                    confirmButtonText: 'Oke'
                                }).then(function() {
                                    $('.close-mdl-ng').trigger('click');
                                    loaddata();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Data gagal ditambah',
                                    icon: 'error',
                                    showCancelButton: false,
                                    showConfirmButton: true,
                                    confirmButtonText: 'Oke'
                                })
                            }
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

    // tombol tambah model
    function tambahdatang2() {
        $('#icon-spinner-add2').show();
        $('#tambahngbtn2').prop('disabled', true);
        $('#canceltambahngbtn2').prop('disabled', true);
        var type = $('#selecttype').val();
        var modelname = $('#modelname').val();
        if (type == null) {
            $('#icon-spinner-add2').hide();
            $('#tambahngbtn2').prop('disabled', false);
            $('#canceltambahngbtn').prop('disabled', false);
            document.getElementById('selecttype').scrollIntoView({
                behavior: 'smooth'
            });
            $('#errortipe').show();
            setTimeout(function() {
                $('#errortipe').hide()
            }, 3000);
        } else {
            if (modelname == '') {
                $('#icon-spinner-add2').hide();
                $('#tambahngbtn2').prop('disabled', false);
                $('#canceltambahngbtn2').prop('disabled', false);
                // error nama
                // scoll dengan gaya
                document.getElementById('modelname').scrollIntoView({
                    behavior: 'smooth'
                });
                $('#errormodel').show();
                setTimeout(function() {
                    $('#errormodel').hide()
                }, 3000);
            } else {
                Swal.fire({
                    title: 'Apakah anda yakin ?',
                    icon: 'question',
                    html: 'Anda akan menambah model <b>' + modelname + '</b>',
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "management/i_datacompleteness/completenesscheck/dataaddmodel.php",
                            type: "POST",
                            data: {
                                "type": type,
                                "modelname": modelname,
                            },
                            success: function(data) {
                                $('#icon-spinner-add2').hide();
                                $('#tambahngbtn2').prop('disabled', false);
                                $('#canceltambahngbtn2').prop('disabled', false);
                                var data = JSON.parse(data);
                                if (data.status == 'berhasil') {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Model baru berhasil ditambah',
                                        icon: 'success',
                                        // timer: 2000,
                                        showCancelButton: false,
                                        showConfirmButton: true,
                                        confirmButtonText: 'Oke'
                                    }).then(function() {
                                        $('.close-mdl-ng').trigger('click');
                                        loaddata();
                                    });
                                } else if (data.status == 'sudah-ada') {
                                    Swal.fire({
                                        title: 'Data sudah ada!',
                                        text: 'Data model sudah ada pada sistem',
                                        icon: 'error',
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
                                }
                            },
                            error: function() {
                                $('#icon-spinner-add2').hide();
                                $('#tambahngbtn2').prop('disabled', false);
                                $('#canceltambahngbtn2').prop('disabled', false);
                                lostconnection();
                            }
                        });
                    } else {
                        $('#tambahngbtn2').prop('disabled', false);
                        $('#canceltambahngbtn2').prop('disabled', false);
                        $('#icon-spinner-add2').hide();
                    }
                });
            }
        }

    }

    // function load halaman
    function loaddata() {
        // get data inside
        $.ajax({
            url: "management/i_datacompleteness/completenesscheck/index.php",
            type: "POST",
            success: function(data) {
                $('#insideshow').show();
                $('#add').show();
                $('#addmodel').show();
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
        placeholder: " Pilih Tipe",
        language: "id",
        allowClear: true,
        dropdownParent: $('#tambahng'),

    });

    // select 2
    $('.halodecktot-model').select2({
        placeholder: " Pilih Tipe",
        language: "id",
        allowClear: true,
        dropdownParent: $('#tambahng2'),

    });
</script>