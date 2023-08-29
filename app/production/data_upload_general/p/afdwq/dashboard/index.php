<div class="row">
    <div class="col-12">
        <h5>Data Upload General</h5>
        <hr>
    </div>
</div>
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
                    <li>Pastikan laptop tersambung dengan jaringan Yamaha</li>
                    <li>Tunggu hingga jaringan kembali stabil</li>
                    <li>Jika sudah terhubung kembali, ulangi kegiatan terakhir anda pada sistem</li>
                </ol>
                Silahkan menghubungi ICTM jika poin 1-2 sudah dilakukan namun tidak kunjung tersambung
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
    <div class="col-12">
        <select class="pilihwc" style="width: 100%;" id="workcenter">
            <option value="" selected disabled>Select Work Center</option>
            <option value="no data">No Data</option>
            <option value="no data">No Data</option>
            <option value="no data">No Data</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-3" id="isitable" style="display: none;">

    </div>
    <div class="col-12 mt-3" id="loadingdata" style="display: none;">
        <div style="text-align: center;">
            <div class=" row">
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
    </div>
    <div class="col-12 mt-3" id="nodata">
        <p id="nodata" style="text-align: center;">No data, please select Workcenter from dropdown</p>
    </div>
</div>
<hr class="mt-3">


<script>
    // on change / onchange
    $('#workcenter').change(function() {
        var workcenter = $('#workcenter').val();
        // disable dropdown
        $('#workcenter').prop('disabled', true);
        // sembunyikan isitabel ganti dengan loading
        $('#isitable').hide();
        // sembunyikan nodata
        $('#nodata').hide();
        // tampilkan loadingdata
        $('#loadingdata').show();


        $.ajax({
            url: "dashboard/table.php",
            type: "POST",
            data: {
                "workcenter": workcenter,
            },
            success: function(data) {
                // enable dropdown
                $('#workcenter').prop('disabled', false);
                // tampilkan isitable
                $('#isitable').show();
                // sembunyikan loadingdata
                $('#loadingdata').hide();
                $('#isitable').html(data)
            },
            error: function() {
                lostconnection()
            }
        });
    })
</script>