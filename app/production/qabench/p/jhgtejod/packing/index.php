<!-- <script src="barcode/jquery.min.js"></script> -->
<script src="barcode/html5-qrcode.min.js"></script>
<div class="row">
    <div class="col-12 mb-5">
        <!-- BLOCK CONTENT -->
        <div class="block-content" style="background-color:#263238 ; display: none;">
            <div class="blink" style="padding-top: 10%; padding-left: 1%; color: #FF3C41;  ">
                <h2 style="font-size: 30px;">Akses dimatikan</h2>
                <h2 style="font-size: 60px;"><i class="fa fa-exclamation-triangle"></i></h2>
                <h2 id="statusblock" style="font-size: 40px;">Checking...</h2>
            </div>
        </div>
        <script>
            // cek kondisi untuk block konten
            $(document).ready(function() {
                showBlock();
            });

            setInterval(ajaxCall, 2000);

            function ajaxCall() {
                $.ajax({
                    url: 'packing/block_check.php',
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 'stock-ng') {
                            $('#statusblock').html(response.message);
                            showBlock();
                            document.onkeydown = function(e) {
                                return false;
                            };
                        } else if (response.status == 'packing-disable') {
                            $('#statusblock').html(response.message);
                            showBlock();
                            document.onkeydown = function(e) {
                                return false;
                            };
                        } else if (response.status == 'oke') {
                            hideBlock();
                            document.onkeydown = function(e) {
                                return true;
                            };
                        }
                    }
                });
            }
        </script>
        <!-- BLOCK CONTENT -->
        <div class="row">
            <div class="col-12">
                <?php
                // menampilkan judul halaman
                if ($_SESSION['role'] == 'packing up') {
                    $title_loc = "UP";
                } elseif ($_SESSION['role'] == 'packing gp') {
                    $title_loc = "GP";
                } else {
                    $title_loc = " - Guest";
                }
                ?>
                <h5>Packing <?= $title_loc ?>
                    <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-7" style="margin-right: 0px; padding-right: 0px;">
                <label class="control-label col-md-4 mt-3" for="first-name">A-Card</span>
                </label>
                <div class="col-md-8 mt-3">
                    <input oninput="this.value=this.value.toUpperCase()" id="acard" autofocus name="acard" style="text-align: left; border-radius: 5px;" type="text" class="form-control" placeholder="A-Card">
                    <div class="row">
                        <div class="col-12 mt-2" id="acarderror" style="display: none;">
                            <span style="color: red;">Silahkan memasukkan no A-Card</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1 mt-3" style="padding-left: 0px; margin-left: 0px;">
                <!-- <button id="scanner" class="btn btn-secondary"><i class="fa fa-barcode"></i></button> -->
                <button id="scanner" class="btn btn-secondary" style="display: none;"><i class="fa fa-camera-retro"></i></button>
                <button id="scannerhide" class="btn btn-danger" style="display: none;"><i class="fa fa-camera-retro"></i></button>
            </div>
            <div class="col-4 mt-3">
                <button style="width: 90%; " class="btn btn-success" type="button" id="check" name="check">Check</button>
            </div>
        </div>
        <div class="row">
            <div id="pembaca" class="col-12" style="text-align: center; display: none;">
                <center>
                    <div id="reader" style=" width: 400px; text-align: center;"></div>
                </center>
            </div>
        </div>
        <script>
            var deviceitem = deviceinfo();
        </script>
        <script>
            $('#scanner').show();
            $('#scanner').click(function() {
                $('#scanner').hide();
                $('#scannerhide').show();
                $('#pembaca').show();

                // Square QR box with edge size = 90% of the smaller edge of the viewfinder.
                let qrboxFunction = function(viewfinderWidth, viewfinderHeight) {
                    let minEdgePercentage = 0.9; // 90%
                    let minEdgeSize = Math.min(viewfinderWidth, viewfinderHeight);
                    let qrboxSize = Math.floor(minEdgeSize * minEdgePercentage);
                    return {
                        width: 350,
                        height: qrboxSize
                    };
                }

                // get device info for aspectratio
                if (deviceitem == "Windows") {
                    var aspekrasio = 2.9;
                } else if (deviceitem == "Macintosh") {
                    var aspekrasio = 0.3;
                } else if (deviceitem == "Android") {
                    var aspekrasio = 0.3;
                }

                let config = {
                    qrbox: qrboxFunction,
                    aspectRatio: aspekrasio,
                    rememberLastUsedCamera: true,
                    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                };
                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", config);

                var hasil = 0;

                function onScanSuccess(decodedText, decodedResult) {
                    // Handle on success condition with the decoded text or result.
                    hasil = decodedText;
                    $('#acard').val(decodedText);
                    $('#check').trigger("click");
                    $('#scannerhide').hide();
                    $('#scanner').show();
                    html5QrcodeScanner.clear();
                    // ^ this will stop the scanner (video feed) and clear the scan area.
                }

                html5QrcodeScanner.render(onScanSuccess);
            });
            $('#scannerhide').click(function() {
                $('#scanner').show();
                $('#scannerhide').hide();
                $('#pembaca').hide();
            })
        </script>
        <hr>
        <div class="row">
            <div class="col-12">
                <div id="pagedata"></div>
                <div id="packingtable" class="row" style="display: none;">
                    <div class="col-12">
                        <h6><u>Today Packing</u></h6>
                        <script>
                            $(document).ready(function() {
                                $('#infopacking').DataTable({
                                    paging: false,
                                    "order": [],
                                    "dom": '<"wrapper"flipt>'
                                });
                            });
                        </script>
                        <table class="table table-bordered" id="infopacking">
                            <thead style="text-align: center;">
                                <th>GMC Piano</th>
                                <th>Model</th>
                                <th>Serial</th>
                                <th>More Info</th>
                                <!-- jika butuh dalam satu tampilan -->
                                <!-- <th>ID Bench</th>
                        <th>Nama Bench</th>
                        <th>ID User P</th>
                        <th>Nama User P</th>
                        <th>Waktu Packing</th> -->
                                <!-- jika butuh dalam satu tampilan -->
                            </thead>
                            <tbody>
                                <?php
                                $today = date('Y-m-d', strtotime($now));
                                $tomonth = date('Y-m', strtotime($now));
                                $sql = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_action = 'packing' AND c_location = '$_SESSION[role]' AND c_date LIKE '$today%' ORDER BY c_date desc");
                                while ($data = mysqli_fetch_array($sql)) {
                                    // ambil gambar
                                    $sql1 = mysqli_query($connect_pro, "SELECT * FROM qa_packing_image WHERE imageSerialPiano = '$data[c_serialpiano]'");
                                    $data1 = mysqli_fetch_array($sql1);


                                ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $data['c_gmcpiano'] ?></td>
                                        <td><?= $data['c_namepiano'] ?></td>
                                        <td style="text-align: center;"><?= $data['c_serialpiano'] ?>
                                            <span style="display: none;"><?= $data['c_serialbench'] ?></span>
                                            <span style="display: none;"><?= $data['c_serialuserp'] ?></span>
                                            <span style="display: none;"><?= $data['c_date'] ?></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $data['c_serialpiano'] ?>"><i class="fa fa-search-plus"></i></button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="<?= $data['c_serialpiano'] ?>" tabindex="-1" aria-labelledby="<?= $data['c_serialpiano'] ?>Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="<?= $data['c_serialpiano'] ?>Label"><?= $data['c_serialpiano'] ?></h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table style="text-align: left; border: 0; width: 100%;">
                                                                <tr>
                                                                    <td style="width: 40%;">Piano Name</td>
                                                                    <td style="text-align: center;">:</td>
                                                                    <td><b><?= $data['c_namepiano'] ?></b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Serial-Piano</td>
                                                                    <td style="text-align: center;">:</td>
                                                                    <td><?= $data['c_serialpiano'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bench Name</td>
                                                                    <td style="text-align: center;">:</td>
                                                                    <td><?= $data['c_namebench'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Serial-Bench</td>
                                                                    <td style="text-align: center;">:</td>
                                                                    <td><?= $data['c_serialbench'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>User Package</td>
                                                                    <td style="text-align: center;">:</td>
                                                                    <td><?= $data['c_nameuserp'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Serial-User Package</td>
                                                                    <td style="text-align: center;">:</td>
                                                                    <td><?= $data['c_serialuserp'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Packing Time</td>
                                                                    <td style="text-align: center;">:</td>
                                                                    <td><?= $data['c_date'] ?></td>
                                                                </tr>
                                                            </table>

                                                            <!-- nonaktifkan ini jika mau mengaktifkan ambil gambar -->
                                                            <!-- <div class="card">
                                                                <div class="card-body">
                                                                    <img style="width: 100%;" src="data:<?= $data1['imageType'] ?>;base64,<?= base64_encode($data1['imageData']) ?>">
                                                                </div>
                                                            </div> -->
                                                            <!-- nonaktifkan ini jika mau mengaktifkan ambil gambar -->

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->
                                        </td>


                                        <!-- jika butuh dalam satu tampilan -->
                                        <!-- <td style="text-align: center;"><?= $data['c_serialbench'] ?></td>
                                <td><?= $data['c_namebench'] ?></td>
                                <td style="text-align: center;"><?= $data['c_serialuserp'] ?></td>
                                <td><?= $data['c_nameuserp'] ?></td>
                                <td style="text-align: center;"><?= $data['c_date'] ?></td> -->
                                        <!-- jika butuh dalam satu tampilan -->
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="loadingacard" class="col-12" style="text-align: center; display: none;">
                <div class="row">
                    <div class="col-12">
                        <h1><i class="fa fa-spinner fa-spin"></i></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        Loading
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#packingtable').show();
                $('#acard').focus();
                $('#acard').keypress(function(e) {
                    if (e.which == 13) {
                        $('#check').click();
                    }
                });
                $('#check').click(function() {
                    $('#loadingacard').show();
                    $('#packingtable').hide();
                    var acard = $('#acard').val();

                    // cek jika belum tulis acard tapi dah enter
                    if (acard == '') {
                        $('#acarderror').show();
                        setTimeout(function() {
                            $('#acarderror').hide()
                        }, 3000);
                        $('#packingtable').show();
                        $('#loadingacard').hide();
                    }
                    // jika sudah isi semua
                    if (acard != '') {
                        $.ajax({
                            url: 'packing/check.php',
                            type: 'POST',
                            data: {
                                "acard": acard
                            },
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 'kosong') {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'No A-Card tidak dikenali!',
                                        icon: 'error',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    });
                                    $('#packingtable').show();
                                    $('#pagedata').hide();
                                    $('#loadingacard').hide();

                                } else if (response.status == 'bench-userp-kosong') {
                                    Swal.fire({
                                        title: 'Proses packing tidak bisa dilanjutkan!',
                                        html: 'Item untuk piano ini kosong : <br><table class="table table-bordered"><tr><td>GMC</td><td>Nama</td><td>Stock</td></tr><tr><td>' + response.benchgmc +
                                            '</td><td style="text-align:left;">' + response.benchname + '</td><td>0</td></tr><tr><td>' + response.userpgmc +
                                            '</td><td style="text-align:left;">' + response.userpname + '</td><td>0</td></tr></table>',
                                        icon: 'error',
                                        width: '80%',
                                        // timer: 5000,
                                        showConfirmButton: true,
                                        focusConfirm: true
                                    });
                                    $('#acard').val('');
                                    // $('#acard').focus();
                                    $('#pagedata').hide();
                                    $('#packingtable').show();
                                    $('#loadingacard').hide();
                                } else if (response.status == 'bench-kosong') {
                                    Swal.fire({
                                        title: 'Proses packing tidak bisa dilanjutkan!',
                                        html: 'Bench untuk piano ini kosong : <br><table class="table table-bordered"><tr><td>GMC</td><td>Nama</td><td>Stock</td></tr><tr><td>' + response.benchgmc +
                                            '</td><td style="text-align:left;">' + response.benchname + '</td><td>0</td></tr></table>',
                                        icon: 'error',
                                        width: '80%',
                                        // timer: 5000,
                                        showConfirmButton: true,
                                        focusConfirm: true
                                    });
                                    $('#acard').val('');
                                    // $('#acard').focus();
                                    $('#pagedata').hide();
                                    $('#packingtable').show();
                                    $('#loadingacard').hide();
                                } else if (response.status == 'userp-kosong') {
                                    Swal.fire({
                                        title: 'Proses packing tidak bisa dilanjutkan!',
                                        html: 'User package untuk piano ini kosong : <br><table class="table table-bordered"><tr><td>GMC</td><td>Nama</td><td>Stock</td></tr><tr><td>' + response.userpgmc +
                                            '</td><td style="text-align:left;">' + response.userpname + '</td><td>0</td></tr></table>',
                                        icon: 'error',
                                        width: '80%',
                                        // timer: 5000,
                                        showConfirmButton: true,
                                        focusConfirm: true
                                    });
                                    $('#acard').val('');
                                    // $('#acard').focus();
                                    $('#pagedata').hide();
                                    $('#packingtable').show();
                                    $('#loadingacard').hide();
                                } else if (response.status == 'ada-belum-packing') {
                                    $('#loadingacard').hide();
                                    //fungsi load data
                                    function loadData() {

                                        var dataString = {
                                            AcardNo: $("#acard").val()
                                        };
                                        $.ajax({
                                            url: "packing/pagedata.php",
                                            type: "POST",
                                            data: dataString,
                                            success: function(data) {
                                                $('#pagedata').show();
                                                $('#pagedata').html(data);
                                            }
                                        });
                                    };
                                    loadData();
                                } else if (response.status == 'sudah-packing') {
                                    Swal.fire({
                                        title: 'Proses packing ditolak!',
                                        text: 'Data sudah pernah dipacking!',
                                        icon: 'error',
                                        timer: 5000,
                                        showConfirmButton: false,
                                    });
                                    $('#acard').val('');
                                    $('#acard').focus();
                                    $('#packingtable').show();
                                    $('#loadingacard').hide();
                                } else if (response.status == 'akses-ditolak') {
                                    Swal.fire({
                                        title: 'Akses ditolak!',
                                        text: 'A-card tersebut bukan wewenang anda!',
                                        icon: 'error',
                                        timer: 5000,
                                        showConfirmButton: false,
                                    });
                                    $('#acard').val('');
                                    $('#acard').focus();
                                    $('#packingtable').show();
                                    $('#loadingacard').hide();
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Server busy!',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    $('#packingtable').show();
                                    $('#loadingacard').hide();
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </div>
</div>