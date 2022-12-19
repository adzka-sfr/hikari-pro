<div class="dashboard_graph" style="padding-bottom: 0px;">
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 20px; color: #212529;">ON TIME RATE ASSY</h2>
        </div>
    </div>
    <hr style="margin: 0px;">
</div>

<div class="dashboard_graph">
    <div class="row x_title">
        <div class="col-md-12">
            <div class="row">
                <div class="col-6">
                    <div class="d-flex">
                        <div class="flex-fill" style="width: 50%;">
                            <div class="card" style="margin-left: 10px; margin-right: 10px;">
                                <h5 class="card-header" style="background-color: #7D7CE0; color: #FFFFFF; font-weight: bold;">UP-Side Glue Yesterday</h5>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="yesterday_assyup" style="height:200px; padding-top: 0px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 50%;">
                            <div class="card">
                                <h5 class="card-header" style="background-color: #7D7CE0; color: #FFFFFF; font-weight: bold;">UP-Side Glue Today</h5>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="today_assyup" style="height:200px; padding-top: 0px; "></div>
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
                                <h5 class="card-header" style="background-color: #946DC1; color: #FFFFFF; font-weight: bold;">GP-Mounting Yesterday</h5>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="yesterday_assygp" style="height:200px; padding-top: 0px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 50%;">
                            <div class="card">
                                <h5 class="card-header" style="background-color:  #946DC1; color: #FFFFFF; font-weight: bold;">GP-Mounting Today</h5>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="today_assygp" style="height:200px; padding-top: 0px; "></div>
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
</div>

<?php
include 'planacc_v3/yes_assyup.php';
include 'planacc_v3/tod_assyup.php';
include 'planacc_v3/yes_assygp.php';
include 'planacc_v3/tod_assygp.php';

include 'bar_chart/assyup.php';
include 'bar_chart/assygp.php';
?>