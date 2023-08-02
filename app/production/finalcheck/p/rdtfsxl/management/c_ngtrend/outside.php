<?php
require '../../config.php';
?>

<div class="row">
    <h5 style="color: #464646; font-weight: bold;">NG Trend of Outside Check</h5>
    <div class="col-12" id="outsideshow" style="display: none;">
    </div>
    <div id="loadingoutside" class="col-12" style="text-align: center; height: 300px; padding-top: 80px;">
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
    // get data outside
    $.ajax({
        url: "management/c_ngtrend/chart/outside.php",
        type: "POST",
        success: function(data) {
            $('#outsideshow').show();
            $('#loadingoutside').hide();
            $('#outsideshow').html(data);
        },
        error: function() {
            lostconnection()
        }
    });
</script>