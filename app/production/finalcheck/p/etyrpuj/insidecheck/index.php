<script src="barcode/html5-qrcode.min.js"></script>
<div class="row">
    <div class="col-12">
        <h5>Inside Check</h5>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-6 col-sm-6  form-group has-feedback">
                <input style="border-radius: 5px;" oninput="this.value=this.value.toUpperCase()" type="text" name="acard" id="acard" class="form-control form-control-lg has-feedback-right" placeholder="A-Card No">
                <button id="scanner" class="btn btn-lg btn-secondary form-control-feedback right" style="display: none; padding: 4px; height: max-content;"><i class="fa fa-camera-retro" style="height: 100%;"></i></button>
                <button id="scannerhide" class="btn btn-lg btn-danger form-control-feedback right" style="display: none; padding: 4px; height: max-content;"><i class="fa fa-camera-retro" style="height: 100%;"></i></button>
                <button id="clearacard" class="btn btn-lg btn-danger form-control-feedback right" style="display: none; padding: 4px; height: max-content;"><i class="fa fa-times" style="height: 100%;"></i></button>
                <button id="go" style="display: none;" class="btn btn-success">Go!</button>
                <div class="row">
                    <div class="col-12">
                        <span id="acarderror" style="color: red; display: none;">Silahkan memasukkan no A-Card terlebih dahulu</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3"></div>
        </div>
    </div>
</div>
<div class="row">
    <div id="pembaca" class="col-12" style="text-align: center; display: none;">
        <center>
            <div id="reader" style=" width: 400px; text-align: center;"></div>
        </center>
    </div>
</div>
<div class="row">
    <div id="loadingacard" class="col-12" style="text-align: center; display: none; ">
        <div class="row">
            <div class="col-12">
                <img src="<?= base_url('_assets/production/images/loading_greys.png') ?>" style="animation: rotation 2s infinite linear;  height:50px" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                Loading
                <!-- <span class="prog-load">0%</span> -->
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="parent-load">
                    <div class="child-load"></div>
                </div>
                <button class="clk-load" id="clk-load-id" style="display: none;">click</button>
            </div>
            <div class="col-4"></div>
        </div> -->
    </div>
</div>


<!-- untuk mengambil ratio device -->
<script>
    var deviceitem = deviceinfo();
</script>
<!-- untuk mengambil ratio device -->

<!-- untuk menampilkan scanner kamera -->
<script>
    $('#scanner').show();
    $('#scanner').click(function() {
        $('#scanner').hide();
        $('#scannerhide').show();
        $('#pembaca').show();
        $('#acard').attr("readonly", true);

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
            var aspekrasio = 0.4;
        } else if (deviceitem == "Android") {
            var aspekrasio = 0.4;
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
            $('#acard').val(decodedText); // DISINI HASIL SCAN BRO
            $('#go').trigger("click");
            $('#scannerhide').hide();
            $('#scanner').show();
            html5QrcodeScanner.clear();
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }

        html5QrcodeScanner.render(onScanSuccess);
    });
    $('#scannerhide').click(function() {
        $('#acard').attr("readonly", false);
        $('#acard').focus();
        $('#scanner').show();
        $('#scannerhide').hide();
        $('#pembaca').hide();
    })
</script>
<!-- untuk menampilkan scanner kamera -->

<!-- untuk aksi setelah acard terisi -->
<script>
    $(document).ready(function() {
        $('#acard').focus();
        $('#acard').keypress(function(e) {
            if (e.which == 13) {
                $('#go').click();
            }
        });

        // klik go -> untuk melanjutkan proses setelah A-card terisi
        $('#go').click(function() {
            $('#scanner').attr("disabled", true);
            $('#loadingacard').show();
            var acard = $('#acard').val();

            // cek jika belum tulis acard tapi dah enter
            if (acard == '') {
                $('#acarderror').show();
                setTimeout(function() {
                    $('#acarderror').hide()
                }, 3000);
                $('#loadingacard').hide();
            }
            // jika sudah isi semua
            if (acard != '') {
                $.ajax({
                    url: 'insidecheck/check.php',
                    type: 'POST',
                    data: {
                        "acard": acard
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if (response.status == 'tidak-ada') {
                            // jika tidak ada data
                            Swal.fire({
                                title: 'Error!',
                                text: 'No A-Card tidak dikenali!',
                                icon: 'error',
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            $('#loadingacard').hide();
                            $('#acard').attr("readonly", false);
                            $('#acard').val('');
                            $('#acard').focus();
                            $('#scanner').attr("disabled", false);
                        } else if (response.status == 'ada') {
                            // load data jika ada data
                            function loadData() {

                                var dataString = {
                                    acard: response.acard,
                                    plannumber: response.plannumber,
                                    pianoserial: response.pianoserial,
                                    pianoname: response.pianoname,
                                    pianogmc: response.pianogmc,
                                };
                                $.ajax({
                                    url: "insidecheck/pagedata.php",
                                    type: "POST",
                                    data: dataString,
                                    success: function(data) {
                                        $('#pagedata').show();
                                        $('#pagedata').html(data);
                                    }
                                });
                            };
                            loadData();
                        } else if (response.status == 'ada-sudah-cek') {
                            // load data jika ada data dan sudah dicek
                            function loadData() {

                                var dataString = {
                                    acard: response.acard,
                                    plannumber: response.plannumber,
                                    pianoserial: response.pianoserial,
                                    pianoname: response.pianoname,
                                    pianogmc: response.pianogmc,
                                };
                                $.ajax({
                                    url: "insidecheck/pagedata2.php",
                                    type: "POST",
                                    data: dataString,
                                    success: function(data) {
                                        $('#pagedata').show();
                                        $('#pagedata').html(data);
                                    }
                                });
                            };
                            loadData();
                        } else if (response.status == 'ada-sudah-cek-validasi') {
                            // load data jika ada data dan sudah dicek
                            function loadData() {

                                var dataString = {
                                    acard: response.acard,
                                    plannumber: response.plannumber,
                                    pianoserial: response.pianoserial,
                                    pianoname: response.pianoname,
                                    pianogmc: response.pianogmc,
                                };
                                $.ajax({
                                    url: "insidecheck/pagedata3.php",
                                    type: "POST",
                                    data: dataString,
                                    success: function(data) {
                                        $('#pagedata').show();
                                        $('#pagedata').html(data);
                                    }
                                });
                            };
                            loadData();
                        } else if (response.status == 'ada-belum-tr') {
                            // belum melakukan TR di proses U400
                            Swal.fire({
                                title: 'Belum TR!',
                                text: 'Pastikan sudah dilakukan TR di proses sebelumnya',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            $('#acard').attr("readonly", false);
                            $('#scanner').show();
                            $('#clearacard').hide();
                            $('#loadingacard').hide();
                            $('#scanner').attr("disabled", false);
                        } else {
                            // jaringan error
                            Swal.fire({
                                title: 'Error!',
                                text: 'Server busy!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            $('#loadingacard').hide();
                            $('#scanner').attr("disabled", false);
                        }
                    }
                });
            }
        });

        // klik X -> untuk clear acard yang saat ini sekaligus hide pagedata
        $('#clearacard').click(function() {
            $('#acard').val('');
            $('#acard').focus();
            $('#clearacard').hide();
            $('#scanner').show();
            $('#pagedata').hide();
            $('#acard').attr("readonly", false);
            $('#scanner').attr("disabled", false);
        })
    });
</script>
<!-- untuk aksi setelah acard terisi -->

<div class="row">
    <div class="col-12">
        <div style="display: none;" id="pagedata"></div>
    </div>
</div>

<!-- untuk menampilkan page data -->
<script>

</script>
<!-- untuk menampilkan page data -->