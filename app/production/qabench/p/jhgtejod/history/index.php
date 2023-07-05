<div class="row">
    <div class="col-12">
        <?php
        if ($_SESSION['role'] == 'packing up') {
            $area = "UP";
        } else if ($_SESSION['role'] == 'packing gp') {
            $area = "GP";
        } else {
            $area = "";
        }
        ?>
        <h5>Data Packing <?= $area ?>
            <hr>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-5">
                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input id="startdate" type="date" class="form-control">
                    <div class="row">
                        <div class="col-12 mt-2" id="errstart" style="display: none;">
                            <span style="color: red;">Silahkan memasukkan start date</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input id="enddate" type="date" class="form-control">
                    <div class="row">
                        <div class="col-12 mt-2" id="errend" style="display: none;">
                            <span style="color: red;">Silahkan memasukkan end date</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <button id="searchboy" class="btn btn-primary" style="height: 100%; width: 100%;">Search</button>
            </div>
        </div>
        <hr>
    </div>

    <script>
        $('#searchboy').click(function() {
            // cek apakah sudah keisi semua
            var startdate = $('#startdate').val();
            var enddate = $('#enddate').val();
            if (startdate == '' && enddate == '') {
                $('#errstart').show();
                setTimeout(function() {
                    $('#errstart').hide()
                }, 2000);

                $('#errend').show();
                setTimeout(function() {
                    $('#errend').hide()
                }, 2000);
            } else if (startdate == '') {
                $('#errstart').show();
                setTimeout(function() {
                    $('#errstart').hide()
                }, 2000);
            } else if (enddate == '') {
                $('#errend').show();
                setTimeout(function() {
                    $('#errend').hide()
                }, 2000);
            } else {
                // sudah keisi lanjut tampil loading + ajax
                $('#loadingacard').show();
                $.ajax({
                    url: 'history/searchdata.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        "startdate": startdate,
                        "enddate": enddate
                    },
                    success: function(response) {
                        $("#table-container").html(response);
                        $('#loadingacard').hide();
                    }
                });
            }

        })
    </script>
</div>
<div class="row">
    <div id="loadingacard" class="col-12" style="text-align: center; display: none;">
        <div class="row">
            <div class="col-12">
                <h1>
                    <svg class="spinner" width="40px" height="40px" viewBox="0 0 66 66">
                        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                Loading
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-5">
        <div id="table-container"></div>
    </div>
</div>