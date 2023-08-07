<div class="row">
    <div class="col-12">
        <h5>Export Check Card</h5>
        <hr>
    </div>
</div>
<script src="<?= base_url('_assets/src/add/jquery/jquery-3.4.1.js') ?>"></script>
<script src="<?= base_url('_assets/src/add/datatables_bootstrap5/datatables.js') ?>"></script>
<!-- <script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script> -->
<script src="<?= base_url('_assets/src/add/dropdown_search/select2.min.js') ?>"></script>
<!-- <script src="../source/dropdown_search/select2.min.js"></script> -->
<script src="<?= base_url('_assets/src/add/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>
<!-- <script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script> -->
<script src="<?= base_url('_assets/src/add/EChart/echarts.js') ?>"></script>
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
                    <li>Pastikan komputer terhubung dengan jaringan Yamaha</li>
                    <li>Tunggu hingga jaringan kembali stabil</li>
                    <li>Jika sudah terhubung kembali, ulangi kegiatan terakhir anda pada sistem</li>
                </ol>
                Note: Pop Up akan tertutup otomatis jika jaringan sudah terhubung <br>
                <p>Silahkan menghubungi ICTM jika poin 1-2 sudah dilakukan namun tidak kunjung tersambung</p>
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


<div class="row">
    <div class="col-10"></div>
    <div class="col-2 text-right">
        <div class="row">
            <div class="col-12 text-left">
                <select class="halodecktot-tambah" id="serialnumber" style="width:100%; height: max-content;">
                    <option value="" selected disabled>Select NG</option>
                    <?php
                    $sql1 = mysqli_query($connect_pro, "SELECT DISTINCT c_serialnumber FROM finalcheck_outside");
                    while ($data1 = mysqli_fetch_array($sql1)) {
                    ?>
                        <option value="<?= $data1['c_serialnumber'] ?>"><?= $data1['c_serialnumber'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mt-4">
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <th>No</th>
                <th>Serial Number</th>
                <th>Piano Name</th>
                <th>Passed Inspection</th>
                <th>Action</th>
            </thead>
            <tbody id="showdata" style="text-align: center;">
                <tr>
                    <td colspan="5" style="text-align: center;">
                        <span id="nodata">No Data</span>
                    </td>
                </tr>
            </tbody>
            <tbody id="showdata1" style="display: none;">
                <tr>
                    <td colspan="5">
                        <div id="loadingdata" style="text-align: center;">
                            <div class="row">
                                <div class="col-12">
                                    <img src="<?= base_url('_assets/production/images/loading_greys.png') ?>" style="animation: rotation 2s infinite linear;  height:35px" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    Loading
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div id="checkcard"></div>
    </div>
</div>

<hr class="mt-5">

<script>
    $('#serialnumber').change(function() {
        $('#showdata').hide();
        $('#nodata').hide();
        $('#showdata1').show();
        var serialnumber = $('#serialnumber').val();

        // judul table
        $.ajax({
            url: 'management/l_export/data.php',
            type: 'POST',
            data: {
                "serialnumber": serialnumber
            },
            success: function(data) {
                $('#showdata').show();
                $('#showdata1').hide();
                $('#showdata').html(data);
            },
        });

        // check card
        $.ajax({
            url: "management/l_export/export-content/show.php",
            type: "POST",
            data: {
                "serialnumber": serialnumber,
            },
            success: function(data) {
                $('#checkcard').html(data);
            },
            error: function() {
                lostconnection()
            }
        });
    })

    $('.halodecktot-tambah').select2({
        placeholder: "Serialnumber",
        language: "id",
        allowClear: false,

    });
</script>