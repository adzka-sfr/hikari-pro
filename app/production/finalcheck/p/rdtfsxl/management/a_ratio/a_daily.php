<?php
require '../../config.php';
?>

<div class="row">
    <h5 style="color: #464646; font-weight: bold;">Status Temuan Inside (<?= date('l, d M', strtotime($now)) ?>)</h5>
    <div class="col-12" id="inside" style="display: none;">
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
<hr>
<div class="row">
    <h5 style="color: #464646; font-weight: bold;">Status Temuan Completeness (<?= date('l, d M', strtotime($now)) ?>)</h5>
    <div class="col-12" id="completeness" style="display: none;">
    </div>
    <div id="loadingcompleteness" class="col-12" style="text-align: center; height: 300px; padding-top: 80px;">
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
<hr>
<div class="row">
    <h5 style="color: #464646; font-weight: bold;">Status Temuan Outside (<?= date('l, d M', strtotime($now)) ?>)</h5>
    <div class="col-12" id="outside" style="display: none;">
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

<script>
    // get data inside
    $.ajax({
        url: "management/a_ratio/chart/d_inside.php",
        type: "POST",
        success: function(data) {
            $('#inside').show();
            $('#loadinginside').hide();
            $('#inside').html(data);
        },
        error: function() {
            lostconnection()
        }
    });

    // get data completeness
    $.ajax({
        url: "management/a_ratio/chart/d_completeness.php",
        type: "POST",
        success: function(data) {
            $('#completeness').show();
            $('#loadingcompleteness').hide();
            $('#completeness').html(data);
        },
        error: function() {
            lostconnection()
        }
    });

    // get data outsdie
    $.ajax({
        url: "management/a_ratio/chart/d_outside.php",
        type: "POST",
        success: function(data) {
            $('#outside').show();
            $('#loadingoutside').hide();
            $('#outside').html(data);
        },
        error: function() {
            lostconnection()
        }
    });
</script>