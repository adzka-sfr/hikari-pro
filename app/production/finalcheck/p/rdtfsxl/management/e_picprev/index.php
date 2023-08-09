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
    <div class="col-6">
        <h5>PIC Previlege</h5>
    </div>
    <div class="col-6" style="text-align: right;">
        <button id="lock" class="btn btn-danger btn-sm" style="width: 100px;">Edit <i class="fa fa-lock"></i></button>
        <button id="unlock" class="btn btn-primary btn-sm" style="width: 100px; display: none;">Edit <i class="fa fa-unlock"></i></button>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <table class="table table-bordered dothemagictotable">
            <thead style="text-align: center;">
                <th style="width: 10%;">ID</th>
                <th>Name</th>
                <th style="width: 15%;">Inside</th>
                <th style="width: 15%;">Outside 1</th>
                <th style="width: 15%;">Outside 2</th>
                <th style="width: 15%;">Outside 3</th>
            </thead>
            <tbody>
                <?php
                $q1 = mysqli_query($connect, "SELECT id, nama FROM auth WHERE dept = 'quality control' AND  role = 'pic check'");
                while ($d1 = mysqli_fetch_array($q1)) {
                    // get base info inside
                    $q1a = mysqli_query($connect, "SELECT COUNT(c_id) as total FROM t_previlege WHERE c_id = '$d1[id]' AND c_dir = 'production/finalcheck/p/etyrpuj'");
                    $d1a = mysqli_fetch_array($q1a);
                    $inside = '';
                    if ($d1a['total'] != 0) {
                        $inside = 'checked';
                    }

                    // get base info outside1
                    $q1b = mysqli_query($connect, "SELECT COUNT(c_id) as total FROM t_previlege WHERE c_id = '$d1[id]' AND c_dir = 'production/finalcheck/p/kfwqptg'");
                    $d1b = mysqli_fetch_array($q1b);
                    $outside1 = '';
                    if ($d1b['total'] != 0) {
                        $outside1 = 'checked';
                    }

                    // get base info outside2
                    $q1c = mysqli_query($connect, "SELECT COUNT(c_id) as total FROM t_previlege WHERE c_id = '$d1[id]' AND c_dir = 'production/finalcheck/p/obkjlrf'");
                    $d1c = mysqli_fetch_array($q1c);
                    $outside2 = '';
                    if ($d1c['total'] != 0) {
                        $outside2 = 'checked';
                    }

                    // get base info outside3
                    $q1d = mysqli_query($connect, "SELECT COUNT(c_id) as total FROM t_previlege WHERE c_id = '$d1[id]' AND c_dir = 'production/finalcheck/p/pkhfged'");
                    $d1d = mysqli_fetch_array($q1d);
                    $outside3 = '';
                    if ($d1d['total'] != 0) {
                        $outside3 = 'checked';
                    }
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $d1['id'] ?></td>
                        <td><?= $d1['nama'] ?></td>
                        <td style="text-align: center;"><input <?= $inside ?> disabled id="inside<?= $d1['id'] ?>" onchange="cekbok1(this.id)" value="<?= $d1['id'] ?>" type="checkbox" style="transform: scale(2);"></td>
                        <td style="text-align: center;"><input <?= $outside1 ?> disabled id="outside1<?= $d1['id'] ?>" onchange="cekbok2(this.id)" value="<?= $d1['id'] ?>" type="checkbox" style="transform: scale(2);"></td>
                        <td style="text-align: center;"><input <?= $outside2 ?> disabled id="outside2<?= $d1['id'] ?>" onchange="cekbok3(this.id)" value="<?= $d1['id'] ?>" type="checkbox" style="transform: scale(2);"></td>
                        <td style="text-align: center;"><input <?= $outside3 ?> disabled id="outside3<?= $d1['id'] ?>" onchange="cekbok4(this.id)" value="<?= $d1['id'] ?>" type="checkbox" style="transform: scale(2);"></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <hr class="mt-3">
        <script>
            $('#lock').click(function() {
                $('#lock').hide();
                $('#unlock').show();
                $('input[type=checkbox]').attr('disabled', false);
            })

            $('#unlock').click(function() {
                $('#unlock').hide();
                $('#lock').show();
                $('input[type=checkbox]').attr('disabled', true);
            })

            function cekbok1(id) {
                if ($('#' + id).is(':checked')) {
                    console.log($('#' + id).val() + ': inside - centang');
                    result = 'Y';
                } else {
                    console.log($('#' + id).val() + ': inside - tidak centang');
                    result = 'N';
                }
                var idkar = $('#' + id).val();
                var process = 'inside';

                $.ajax({
                    url: "management/e_picprev/datachange.php",
                    type: "POST",
                    data: {
                        "idkar": idkar,
                        "process": process,
                        "result": result
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        console.log(data.status);
                        console.log(data.idkar);
                        console.log(data.process);
                        console.log(data.result);
                    },
                    error: function() {
                        lostconnection()
                    }
                });
            }

            function cekbok2(id) {
                if ($('#' + id).is(':checked')) {
                    console.log($('#' + id).val() + ': check1 - centang');
                    result = 'Y';
                } else {
                    console.log($('#' + id).val() + ': check1 - tidak centang');
                    result = 'N';
                }
                var idkar = $('#' + id).val();
                var process = 'outside1';

                $.ajax({
                    url: "management/e_picprev/datachange.php",
                    type: "POST",
                    data: {
                        "idkar": idkar,
                        "process": process,
                        "result": result
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        console.log(data.status);
                        console.log(data.idkar);
                        console.log(data.process);
                        console.log(data.result);
                        console.log('berhasil');
                    },
                    error: function() {
                        lostconnection()
                    }
                });
            }

            function cekbok3(id) {
                if ($('#' + id).is(':checked')) {
                    console.log($('#' + id).val() + ': check2 - centang');
                    result = 'Y';
                } else {
                    console.log($('#' + id).val() + ': check2 - tidak centang');
                    result = 'N';
                }
                var idkar = $('#' + id).val();
                var process = 'outside2';

                $.ajax({
                    url: "management/e_picprev/datachange.php",
                    type: "POST",
                    data: {
                        "idkar": idkar,
                        "process": process,
                        "result": result
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        console.log(data.status);
                        console.log(data.idkar);
                        console.log(data.process);
                        console.log(data.result);
                        console.log('berhasil');
                    },
                    error: function() {
                        lostconnection()
                    }
                });
            }

            function cekbok4(id) {
                if ($('#' + id).is(':checked')) {
                    console.log($('#' + id).val() + ': check3 - centang');
                    result = 'Y';
                } else {
                    console.log($('#' + id).val() + ': check3 - tidak centang');
                    result = 'N';
                }
                var idkar = $('#' + id).val();
                var process = 'outside3';

                $.ajax({
                    url: "management/e_picprev/datachange.php",
                    type: "POST",
                    data: {
                        "idkar": idkar,
                        "process": process,
                        "result": result
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        console.log(data.status);
                        console.log(data.idkar);
                        console.log(data.process);
                        console.log(data.result);
                        console.log('berhasil');
                    },
                    error: function() {
                        lostconnection()
                    }
                });
            }
        </script>
        <script>
            $('.dothemagictotable').DataTable({
                // scrollY: '700px',
                // scrollCollapse: true,
                paging: false,
            });
        </script>
    </div>
</div>