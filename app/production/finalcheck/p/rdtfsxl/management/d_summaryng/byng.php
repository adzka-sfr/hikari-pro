<?php
include '../../config.php';
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
            url: '../../source/connection_check.php',
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



<!-- tombol untuk berpindah halaman + halaman-->
<div class="row">
    <div class="col-12">
        <button class="btn btn-sm btn-secondary" id="insidebyng" style="width: 120px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            Inside <div id="loadin" style="display: none;" class="spinner-border spinner-border-sm" role="status"></div>
        </button>
        <button class="btn btn-sm btn-secondary" id="outsidebyng" style="width: 120px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
        Outside <div id="loadou" style="display: none;" class="spinner-border spinner-border-sm" role="status"></div>
        </button>
    </div>
</div>
<hr style="margin-top: 0px; padding-top: 0px;">
<div class="row">
    <div class="col-12 mb-3">
        <div id="showpagebyng">
            <div id="loadingdatang" style="text-align: center; height: 300px; padding-top: 80px;">
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
    </div>

</div>
<hr>
<!-- tombol untuk berpindah halaman + halaman -->

<script>
    $(document).ready(function() {
        // $('#loadingdatang').show();
        // show inside for first
        $.ajax({
            url: "management/d_summaryng/byng/inside.php",
            type: "POST",
            success: function(data) {
                $('#showpagebyng').html(data);
                $('#insidebyng').attr('disabled', true);
                $('#outsidebyng').attr('disabled', false);
            },
            error: function() {
                lostconnection()
            }
        });

        // get data for inside by button
        $('#insidebyng').click(function() {
            $('#insidebyng').attr('disabled', true);
            $('#outsidebyng').attr('disabled', false);
            $('#loadin').show();
            $.ajax({
                url: "management/d_summaryng/byng/inside.php",
                type: "POST",
                success: function(data) {
                    $('#showpagebyng').html(data);
                    $('#loadin').hide();
                },
                error: function() {
                    lostconnection()
                }
            });
        })

        // get data for outside by button
        $('#outsidebyng').click(function() {
            $('#insidebyng').attr('disabled', false);
            $('#outsidebyng').attr('disabled', true);
            $('#loadou').show();
            $.ajax({
                url: "management/d_summaryng/byng/outside.php",
                type: "POST",
                success: function(data) {
                    $('#showpagebyng').html(data);
                    $('#loadou').hide();
                },
                error: function() {
                    lostconnection()
                }
            });
        })
    })
</script>