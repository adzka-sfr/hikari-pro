<?php require '../../../config.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-4 text-center">
                <button id="showtombol" style="width: 100%;" class="btn btn-primary btn-sm" onclick="tampilkan()">Show Furniture <i id="loadingshow" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
            </div>
            <div class="col-4 text-center">
                <button id="showtombol2" style="width: 100%;" class="btn btn-primary btn-sm" onclick="tampilkan2()">Show Polyester <i id="loadingshow2" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
            </div>
            <div class="col-4 text-center">
                <button id="showtombol3" style="width: 100%;" class="btn btn-primary btn-sm" onclick="tampilkan3()">Show Silent <i id="loadingshow3" style="display: none;" class="fa fa-spinner fa-spin"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center" style="font-size: 0.6rem;">
                <span>Proses show data akan memakan waktu lama, mohon bersabar</span>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12" id="showtime" style="display: none;">

    </div>
</div>

<script>
    function tampilkan() {
        showdata();
        $('input[type=checkbox]').attr('disabled', true);
        $('#showtombol').prop('disabled', true);
        $('#showtombol2').prop('disabled', true);
        $('#showtombol3').prop('disabled', true);
        $('#lock').show();
        $('#unlock').hide();
        $('#lock').prop('disabled', true);
        $('#add').prop('disabled', true);
        $('#addmodel').prop('disabled', true);
        $('#loadingshow').show();
    }

    // function load halaman 1 - furniture
    function showdata() {
        // get data inside
        $.ajax({
            url: "management/i_datacompleteness/completenesscheck/indexsimpanan.php",
            type: "POST",
            success: function(data) {
                $('#lock').prop('disabled', false);
                $('#showtombol2').prop('disabled', false);
                $('#showtombol3').prop('disabled', false);
                $('#loadingshow').hide();
                $('#showtime').show();
                $('#add').prop('disabled', false);
                $('#addmodel').prop('disabled', false);
                $('#showtime').html(data);
            },
            error: function() {
                lostconnection()
            }
        });
    }

    function tampilkan2() {
        showdata2();
        $('input[type=checkbox]').attr('disabled', true);
        $('#showtombol').prop('disabled', true);
        $('#showtombol2').prop('disabled', true);
        $('#showtombol3').prop('disabled', true);
        $('#lock').show();
        $('#unlock').hide();
        $('#lock').prop('disabled', true);
        $('#add').prop('disabled', true);
        $('#addmodel').prop('disabled', true);
        $('#loadingshow2').show();
    }

    // function load halaman 2 - polyester
    function showdata2() {
        // get data inside
        $.ajax({
            url: "management/i_datacompleteness/completenesscheck/indexsimpanan2.php",
            type: "POST",
            success: function(data) {
                $('#lock').prop('disabled', false);
                $('#showtombol').prop('disabled', false);
                $('#showtombol3').prop('disabled', false);
                $('#loadingshow2').hide();
                $('#showtime').show();
                $('#add').prop('disabled', false);
                $('#addmodel').prop('disabled', false);
                $('#showtime').html(data);
            },
            error: function() {
                lostconnection()
            }
        });
    }

    function tampilkan3() {
        showdata3();
        $('input[type=checkbox]').attr('disabled', true);
        $('#showtombol').prop('disabled', true);
        $('#showtombol2').prop('disabled', true);
        $('#showtombol3').prop('disabled', true);
        $('#lock').show();
        $('#unlock').hide();
        $('#lock').prop('disabled', true);
        $('#add').prop('disabled', true);
        $('#addmodel').prop('disabled', true);
        $('#loadingshow3').show();
    }

    // function load halaman 3 - silent
    function showdata3() {
        // get data inside
        $.ajax({
            url: "management/i_datacompleteness/completenesscheck/indexsimpanan3.php",
            type: "POST",
            success: function(data) {
                $('#lock').prop('disabled', false);
                $('#showtombol').prop('disabled', false);
                $('#showtombol2').prop('disabled', false);
                $('#loadingshow3').hide();
                $('#showtime').show();
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