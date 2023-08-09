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
        <button id="add" class="btn btn-success btn-sm" style="width: 100px; display: none;">Add <i class="fa fa-plus-square"></i></button>
        <!-- Modal add ng start -->
        <div class="modal fade" id="tambahng" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah NG Inside</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <form id="myform">
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <label>Nama Process :</label>
                                    <select class="halodecktot-tambah" id="selectprocess" name="ng" style="width:100%; height: max-content;">
                                        <option value="" selected disabled>Select Process</option>
                                        <?php
                                        $sql1 = mysqli_query($connect_pro, "SELECT c_detail, c_code_incheck FROM finalcheck_list_incheck ORDER BY c_seq ASC");
                                        while ($data1 = mysqli_fetch_array($sql1)) {
                                        ?>
                                            <option value="<?= $data1['c_code_incheck'] ?>"><?= $data1['c_detail'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div id="errorng" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Nama Proses tidak boleh kosong!</div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <label>Nama NG :</label>
                                    <textarea id="ngname" class="form-control"></textarea>
                                    <div id="errornama" class="col-12" style="text-align: center; color: red; padding-top: 5px; display: none;">Nama NG tidak boleh kosong!</div>
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
        <!-- Modal add ng end -->
    </div>
    <div class="col-6 text-right">
        <button id="lock" class="btn btn-danger btn-sm" style="width: 100px; display: none;">Edit <i class="fa fa-lock"></i></button>
        <button id="unlock" class="btn btn-primary btn-sm" style="width: 100px; display: none;">Edit <i class="fa fa-unlock"></i></button>
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

    // tombol cancel
    function cancelbtnmdl() {
        $('#selectprocess').val('').trigger('change');
        $('#ngname').val('');
    }

    // tombol tambah
    function tambahdatang() {
        var processcode = $('#selectprocess').val();
        var ngname = $('#ngname').val();
        // if(prosessname == null)
        console.log(processcode);
        console.log(ngname);
        if (processcode == null) {
            // error process
            // scoll dengan gaya
            document.getElementById('selectprocess').scrollIntoView({
                behavior: 'smooth'
            });
            $('#errorng').show();
            setTimeout(function() {
                $('#errorng').hide()
            }, 3000);
        } else {
            if (ngname == '') {
                // error nama
                // scoll dengan gaya
                document.getElementById('ngname').scrollIntoView({
                    behavior: 'smooth'
                });
                $('#errornama').show();
                setTimeout(function() {
                    $('#errornama').hide()
                }, 3000);
            } else {
                $.ajax({
                    url: "management/f_datang/inside/dataadd.php",
                    type: "POST",
                    data: {
                        "processcode": processcode,
                        "ngname": ngname
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if (data.status == 'berhasil') {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data NG berhasil ditambah',
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
                        lostconnection()
                    }
                });
            }
        }
    }

    // function load halaman
    function loaddata() {
        // get data inside
        $.ajax({
            url: "management/f_datang/inside/index.php",
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
        placeholder: " Pilih Proses",
        language: "id",
        allowClear: true,
        dropdownParent: $('#tambahng'),

    });
</script>