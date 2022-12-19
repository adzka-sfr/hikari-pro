    <div class="row x_title">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex">
                        <div class="flex-fill" style="width: 17%;">
                            <div class="card" style="margin-left: 5px; margin-right: 5px;">
                                <h6 class="card-header" style="background-color: #5470C6; padding-left: 5px; padding-right: 5px; font-weight: bold; text-align: center; color: #FFFFFF;">UP Spray Satin</h6>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="upspray" style="height:200px; padding-top: 0px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 17%;">
                            <div class="card" style="margin-left: 5px; margin-right: 5px;">
                                <h6 class="card-header" style="background-color: #91CC75; padding-left: 5px; padding-right: 5px; font-weight: bold; text-align: center; color: #FFFFFF;">UP Finish Buff Panel</h6>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="upfinish" style="height:200px; padding-top: 0px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 17%;">
                            <div class="card" style="margin-left: 5px; margin-right: 5px;">
                                <h6 class="card-header" style="background-color: #FAC858; padding-left: 5px; padding-right: 5px; font-weight: bold; text-align: center; color: #FFFFFF;">UP Painting Check</h6>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="uppainting" style="height:200px; padding-top: 0px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 17%;">
                            <div class="card" style="margin-left: 5px; margin-right: 5px;">
                                <h6 class="card-header" style="background-color: #EE6666; padding-left: 5px; padding-right: 5px; font-weight: bold; text-align: center; color: #FFFFFF;">UP Furniture Check</h6>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="upfurniture" style="height:200px; padding-top: 0px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 17%;">
                            <div class="card" style="margin-left: 5px; margin-right: 5px;">
                                <h6 class="card-header" style="background-color: #73C0DE; padding-left: 5px; padding-right: 5px; font-weight: bold; text-align: center; color: #FFFFFF;">GP Buff Panel&Small</h6>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="gpbuff" style="height:200px; padding-top: 0px; "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 17%;">
                            <div class="card" style="margin-left: 5px; margin-right: 5px;">
                                <h6 class="card-header" style="background-color: #3BA272; padding-left: 5px; padding-right: 5px; font-weight: bold; text-align: center; color: #FFFFFF;">GP Painting Check</h6>
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <div id="gppainting" style="height:200px; padding-top: 0px; "></div>
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
                    <!-- <div id="painting" style="height:300px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; "></div> -->

                    <?php
                    include 'tabel_painting.php';
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'planacc_v3/up_spray.php';
    include 'planacc_v3/up_finish.php';
    include 'planacc_v3/up_painting.php';
    include 'planacc_v3/up_furniture.php';
    include 'planacc_v3/gp_buff.php';
    include 'planacc_v3/gp_painting.php';

    include 'bar_chart/painting.php';
    ?>

    <?php
    //================== ACTIVITY LOG START ==================//
 

    //================== ACTIVITY LOG FINISH ==================//
    ?>