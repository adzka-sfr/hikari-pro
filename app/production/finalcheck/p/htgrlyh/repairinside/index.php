<div class="row">
    <div class="col-12">
        <h5>Repair Inside</h5>
        <hr>
    </div>
</div>
<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- modal untuk cek koneksi -->
<div class="modal fade" id="lostmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="col-12 modal-title fs-5 text-center" style="color: red;" id="staticBackdropLabel"><img src="<?= base_url('_assets/production/gif/heart.gif') ?>" width="100px"> Koneksi Terputus! <img src="<?= base_url('_assets/production/gif/heart.gif') ?>" width="100px"></h1>
            </div>
            <div class="modal-body">
                Yang harus dilakukan:
                <ol>
                    <li>Pastikan Wifi pada Tab menyala (berwana biru)</li>
                    <li>Pastikan Wifi terhubung dengan jaringan Yijak-Prolt3a</li>
                    <li>Tunggu hingga jaringan kembali stabil</li>
                    <li>Jika sudah terhubung kembali, ulangi kegiatan terakhir anda pada sistem</li>
                </ol>
                Silahkan menghubungi ICTM jika poin 1-3 sudah dilakukan namun tidak kunjung tersambung
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
            url: 'repairinside/connection_check.php',
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
        <div id="tabele"></div>
    </div>
</div>

<script>
    $('#tabele').load('repairinside/data.php').fadeIn("slow");

    function load_data() {
        $('#tabele').load('repairinside/data.php').fadeIn("slow");
    }

    auto_refresh = setInterval(load_data, 5000);

    function btnPrint(id, serialnumber) {
        clearInterval(auto_refresh);
        console.log(id);

        $.ajax({
            url: 'repairinside/data1.php',
            type: 'POST',
            data: {
                "serialnumber": serialnumber
            },
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 'OK') {
                    window.open("repairinside/print.php", "_self");
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        icon: 'error',
                        html: 'Silahkan coba lagi nanti',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oke',
                        cancelButtonText: 'Tidak'
                    })
                }

            },
            error: function() {
                lostconnection()
            }
        });
    }

    function btnPrint1(id, serialnumber) {
        clearInterval(auto_refresh);
        console.log(id);

        $.ajax({
            url: 'repairinside/data1.php',
            type: 'POST',
            data: {
                "serialnumber": serialnumber
            },
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 'OK') {
                    window.open("repairinside/print1.php", "_self");
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        icon: 'error',
                        html: 'Silahkan coba lagi nanti',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oke',
                        cancelButtonText: 'Tidak'
                    })
                }

            },
            error: function() {
                lostconnection()
            }
        });
    }
</script>