<?php
require '../../config.php';
?>

<div class="row">
    <h5 style="color: #464646; font-weight: bold;">NG Trend of Inside Check</h5>
    <div class="col-12" id="insideshow" style="display: none;">
    </div>
    <div id="loadinginside" class="col-12" style="text-align: center; height: 300px; padding-top: 80px;">
        <div class="row">
            <div class="col-12">
                <img src="<?= base_url('_assets/production/images/loading_greys.png') ?>" style="animation: rotation 2s infinite linear;  height:50px" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                Loading
            </div>
        </div>
    </div>
</div>
<hr class="mt-3">

<script>
    // get data inside
    $.ajax({
        url: "management/c_ngtrend/chart/inside.php",
        type: "POST",
        success: function(data) {
            $('#insideshow').show();
            $('#loadinginside').hide();
            $('#insideshow').html(data);
        },
        error: function() {
            lostconnection()
        }
    });
</script>