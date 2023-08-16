<div class="row">
    <div class="col-12">
        <h5>Upload ST Master</h5>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-8">
        <div class="row">
            <div class="col-12">
                <input name="filestock" type="file" class="form-control" id="file" required>
            </div>
        </div>
        <div class="row">
            <div class="col-10 mt-2">
                <h6 id="alertinfo" style="color: red; font-size: 0.8rem; display: none;">Harap jangan meninggalkan halaman saat proses upload sedang berlangsung!</h6>
                <h6 id="nullinfo" style="color: red; font-size: 0.8rem; display: none;">Silahkan pilih file (.xls) terlebih dahulu</h6>
            </div>
            <div class="col-2 mt-2 text-right">
                <button id="go" class="btn btn-primary btn-sm">Upload</button>
            </div>
        </div>
    </div>
    <div class="col-4">
        <table class="table">
            <thead style="text-align: center;">
                <th style="width: 50%;">Progress</th>
                <th style="width: 50%;">Total</th>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">
                        <div id="progresstable">0</div>
                    </td>
                    <td style="text-align: center; font-weight: bold;">
                        <div id="totaltable">0</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="loadingplace" style="display: none;" class="progress" role="progressbar" aria-label="Animated striped example">
            <div id="loading" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"><span id="textloading">0%</span></div>
        </div>
    </div>
</div>

<script>
    $('#go').click(function() {
        if ($('#file').val() == '') {
            $('#nullinfo').show();
            setTimeout(function() {
                $('#nullinfo').hide()
            }, 3000);
        } else {
            $('#file').prop('disabled', true);
            $('#alertinfo').show();
            $('#go').prop('disabled', true);
            $('#loadingplace').show();

            // agar data dapat dilempar menggunakan ajax
            var data = new FormData();
            jQuery.each(jQuery('#file')[0].files, function(i, file) {
                data.append('file-' + i, file);
            });

            // ini adalah proses upload data
            $.ajax({
                url: 'uploadst/upload2.php',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST', // For jQuery < 1.9
                success: function(data) {
                    var data = JSON.parse(data);
                    console.log(data.status);
                    console.log(data.banyak);
                    $('#file').val('');
                }
            });

            // ini akan jalan bareng dengan proses upload data
            const loading = setInterval(function() {
                $.ajax({
                    url: 'uploadst/get_num2.php',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'POST',
                    type: 'POST', // For jQuery < 1.9
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#loading").attr('style', 'width:' + data.loading + '%');
                        $("#textloading").html(data.loading + "%")

                        // table
                        $('#progresstable').html(data.progress);
                        $('#totaltable').html(data.total);

                        if (data.total != 0) {
                            if (data.total == data.progress) {
                                myStop();
                            }
                        }

                    }
                });
            }, 500);
        }

        // function ini akan dijalanlan ketika proses upload selesai
        function myStop() {
            $('#file').prop('disabled', false);
            $('#alertinfo').hide();
            $('#go').prop('disabled', false);
            clearInterval(loading);
        }
    })
</script>