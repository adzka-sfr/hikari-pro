<div class="dashboard_graph" style="padding-bottom: 0px;">
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 20px; color: #212529;">ON TIME RATE WOODWORKING</h2>
        </div>
    </div>
    <hr style="margin: 0px;">
</div>

<div class="dashboard_graph">
    <div class="row x_title">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex">
                        <div class="flex-fill" style="width: 17%;">
                            <div class="card" style="margin-left: 5px; margin-right: 5px;">
                                <h6 class="card-header" style="background-color: #5470C6; font-weight: bold; text-align: center; color: #FFFFFF;">Setting Veneer</h6>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="wwsetting" style="height:200px; padding-top: 0px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 17%;">
                            <div class="card" style="margin-left: 5px; margin-right: 5px;">
                                <h6 class="card-header" style="background-color: #91CC75; font-weight: bold; text-align: center; color: #FFFFFF;">Hot Press Panel</h6>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="wwhot" style="height:200px; padding-top: 0px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 17%;">
                            <div class="card" style="margin-left: 5px; margin-right: 5px;">
                                <h6 class="card-header" style="background-color: #FAC858; font-weight: bold; text-align: center; color: #FFFFFF;">Machine Leg UP</h6>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="wwmachine" style="height:200px; padding-top: 0px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 17%;">
                            <div class="card" style="margin-left: 5px; margin-right: 5px;">
                                <h6 class="card-header" style="background-color: #EE6666; font-weight: bold; text-align: center; color: #FFFFFF;">Out WW & Check UP</h6>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="wwout" style="height:200px; padding-top: 0px; "></div>
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
                <div class="col-12">
                    <!-- <div id="woodworking" style="height:300px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; "></div> -->

                    <?php
                    include 'tabel_ww.php';
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'planacc_v3/ww_setting.php';
include 'planacc_v3/ww_hot.php';
include 'planacc_v3/ww_machine.php';
include 'planacc_v3/ww_out.php';

include 'bar_chart/woodworking.php';
?>