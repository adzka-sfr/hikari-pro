<div class="row">
    <div class="col-12">
        <h5>Ratio</h5>
        <hr>
    </div>
</div>
<script src="<?= base_url('_assets/src/add/jquery/jquery-3.4.1.js') ?>"></script>
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

<!-- tombol untuk berpindah halaman + halaman-->
<div class="row">
    <div class="col-12">
        <button class="btn btn-secondary" id="daily" style="width: 100px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">Today</button>
        <button class="btn btn-secondary" id="monthly" style="width: 100px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">Month</button>
        <button class="btn btn-secondary" id="yearly" style="width: 100px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">Year</button>
    </div>
</div>
<hr style="margin-top: 0px; padding-top: 0px;">
<div class="row">
    <div class="col-12">
        <div id="showpage"></div>
    </div>
</div>
<!-- tombol untuk berpindah halaman + halaman -->

<script>
    $(document).ready(function() {
        // show daily for first
        $.ajax({
            url: "management/a_ratio/a_daily.php",
            type: "POST",
            success: function(data) {
                // $('#inside').show();
                $('#showpage').html(data);
            },
            error: function() {
                lostconnection()
            }
        });

        // get data for daily by button
        $('#daily').click(function() {
            $.ajax({
                url: "management/a_ratio/a_daily.php",
                type: "POST",
                success: function(data) {
                    // $('#inside').show();
                    $('#showpage').html(data);
                },
                error: function() {
                    lostconnection()
                }
            });
        })

        // get data for monthly by button
        $('#monthly').click(function() {
            $.ajax({
                url: "management/a_ratio/b_monthly.php",
                type: "POST",
                success: function(data) {
                    // $('#inside').show();
                    $('#showpage').html(data);
                },
                error: function() {
                    lostconnection()
                }
            });
        })

        // get data for yearly by button
        $('#yearly').click(function() {
            $.ajax({
                url: "management/a_ratio/c_yearly.php",
                type: "POST",
                success: function(data) {
                    // $('#inside').show();
                    $('#showpage').html(data);
                },
                error: function() {
                    lostconnection()
                }
            });
        })
    })
</script>