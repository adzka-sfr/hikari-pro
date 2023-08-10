<?php require '../../../config.php'; ?>

<div class="row" id="buttonshow">
    <div class="col-12">
        <div class="row">
            <div class="col-12 text-center">
                <button id="showtombol" class="btn btn-primary btn-sm" onclick="tampilkan()">Show All Data <i id="loadingshow" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center" style="font-size: 0.6rem;">
                <span>Proses show data akan memakan waktu lama, mohon bersabar</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" id="showtime" style="display: none;">

    </div>
</div>

<script>
    function tampilkan() {
        showdata();
        $('#showtombol').prop('disabled', true);
        $('#add').prop('disabled', true);
        $('#addmodel').prop('disabled', true);
        $('#loadingshow').show();
    }

    // function load halaman
    function showdata() {
        // get data inside
        $.ajax({
            url: "management/i_datacompleteness/completenesscheck/indexsimpanan.php",
            type: "POST",
            success: function(data) {
                $('#showtombol').prop('disabled', false);
                $('#loadingshow').hide();
                $('#showtime').show();
                $('#buttonshow').hide();
                $('#add').prop('disabled', false);
                $('#addmodel').prop('disabled', false);
                $('#showtime').html(data);
            },
            error: function() {
                lostconnection()
            }
        });
    }
</script>