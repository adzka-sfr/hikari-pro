<div class="row x_title">
    <div class="col-md-12">
        <div class="row">
            <div class="col-6">
                <div class="d-flex">
                    <div class="flex-fill" style="width: 50%;">
                        <div class="card" style="margin-left: 10px; margin-right: 10px;">
                            <h5 class="card-header" style="background-color: #5470C6; color: #FFFFFF; font-weight: bold;">Painting - Acc</h5>
                            <div class="card-body" style="padding: 5px;">
                                <div class="row">
                                    <div class="col-12" style="margin-bottom: 10px;">
                                        <div id="accumulation_painting" style="height:200px; padding-top: 0px; "></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-fill" style="width: 50%;">
                        <div class="card">
                            <h5 class="card-header" style="background-color: #5470C6; color: #FFFFFF; font-weight: bold;">Painting - Today</h5>
                            <div class="card-body" style="padding: 5px;">
                                <div class="row">
                                    <div class="col-12" style="margin-bottom: 10px;">
                                        <div id="today_painting" style="height:200px; padding-top: 0px; "></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex">
                    <div class="flex-fill" style="width: 50%;">
                        <div class="card" style="margin-left: 10px; margin-right: 10px;">
                            <h5 class="card-header" style="background-color: #5470C6; color: #FFFFFF; font-weight: bold;">Woodworking - Acc</h5>
                            <div class="card-body" style="padding: 5px;">
                                <div class="row">
                                    <div class="col-12" style="margin-bottom: 10px;">
                                        <div id="accumulation_woodworking" style="height:200px; padding-top: 0px; "></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-fill" style="width: 50%;">
                        <div class="card">
                            <h5 class="card-header" style="background-color:  #5470C6; color: #FFFFFF; font-weight: bold;">Woodworking - Today</h5>
                            <div class="card-body" style="padding: 5px;">
                                <div class="row">
                                    <div class="col-12" style="margin-bottom: 10px;">
                                        <div id="today_woodworking" style="height:200px; padding-top: 0px; "></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator" style="padding: 0px;"></div>
        <div class="row">
            <div class="col-6">
                <div id="bar" style="height:300px; padding-top: 10px; padding-bottom: 0px; "></div>
            </div>
            <div class="col-6">
                <div id="bar2" style="height:300px; padding-top: 10px; padding-bottom: 0px;"></div>
            </div>
        </div>
    </div>
</div>

<?php
include 'planacc_v3/acc_painting_all.php';
include 'planacc_v3/tod_painting_all.php';
include 'planacc_v3/acc_woodworking_all.php';
include 'planacc_v3/tod_woodworking_all.php';

include 'bar_chart/paintingresume.php';
include 'bar_chart/woodworkingresume.php';


?>

<?php
//================== ACTIVITY LOG START ==================//


//================== ACTIVITY LOG FINISH ==================//
?>