<?php
include 'data/backend.php';
?>
<div class="x_content">
    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Summary</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <div class="row">

                <!-- Card On Process -->
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="card-title"><b>On Process</b></h5>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <!-- <i style="font-size: 12px;">Target Updated : </i> -->
                                            <p id="op_p"></p>
                                            <p> <?= "<script>document.getElementById('op_p').innerHTML</script>" ?></p>
                                        </div>
                                    </div>
                                    <div class="separator" style="margin-top: 0px;"></div>

                                    <h2 class="card-text">Panel</h2>

                                    <!-- batas bawah -->
                                    <div class="bar-step" style="padding-left: 56%; margin-left: -20px">
                                        <div class="label-percent"><?= $op_p_bb ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- batas atas -->
                                    <div class="bar-step" style="padding-left: 83%; margin-left: -27px">
                                        <div class="label-percent"><?= $op_p_ba ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- progressbar -->
                                    <div class="progress" style="border-radius: 4px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated <?php
                                                                                                            if ($op_p_persen < 55.57) {
                                                                                                                echo "bg-danger";
                                                                                                            } else {
                                                                                                                echo "bg-success";
                                                                                                            }
                                                                                                            ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?= $op_p_persen ?>%"><?= $op_p_act ?></div>
                                    </div>

                                    <h2 class="card-text">Small Long</h2>

                                    <!-- batas bawah -->
                                    <div class="bar-step" style="padding-left: 56%; margin-left: -20px">
                                        <div class="label-percent"><?= $op_sl_bb ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- batas atas -->
                                    <div class="bar-step" style="padding-left: 83%; margin-left: -27px">
                                        <div class="label-percent"><?= $op_sl_ba ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- progressbar -->
                                    <div class="progress" style="border-radius: 4px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated <?php
                                                                                                            if ($op_sl_persen < 55.57) {
                                                                                                                echo "bg-danger";
                                                                                                            } else {
                                                                                                                echo "bg-success";
                                                                                                            }
                                                                                                            ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?= $op_sl_persen ?>%"><?= $op_sl_act ?></div>
                                    </div>

                                    <h2 class="card-text">Small Short</h2>

                                    <!-- batas bawah -->
                                    <div class="bar-step" style="padding-left: 56%; margin-left: -20px">
                                        <div class="label-percent"><?= $op_ss_bb ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- batas atas -->
                                    <div class="bar-step" style="padding-left: 83%; margin-left: -27px">
                                        <div class="label-percent"><?= $op_ss_ba ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- progressbar -->
                                    <div class="progress" style="border-radius: 4px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated <?php
                                                                                                            if ($op_ss_persen < 55.57) {
                                                                                                                echo "bg-danger";
                                                                                                            } else {
                                                                                                                echo "bg-success";
                                                                                                            }
                                                                                                            ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?= $op_ss_persen ?>%"><?= $op_ss_act ?></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Card Finish -->
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="card-title"><b>Finish</b></h5>
                                        </div>
                                        <div class="col-6" style="text-align: right;">
                                            <!-- <i style="font-size: 12px;">Target Updated : </i> -->
                                        </div>
                                    </div>
                                    <div class="separator" style="margin-top: 0px;"></div>

                                    <h2 class="card-text">Panel</h2>

                                    <!-- batas bawah -->
                                    <div class="bar-step" style="padding-left: 56%; margin-left: -20px">
                                        <div class="label-percent"><?= $fn_p_bb ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- batas atas -->
                                    <div class="bar-step" style="padding-left: 83%; margin-left: -27px">
                                        <div class="label-percent"><?= $fn_p_ba ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- progressbar -->
                                    <div class="progress" style="border-radius: 4px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated <?php
                                                                                                            if ($fn_p_persen < 55.57) {
                                                                                                                echo "bg-danger";
                                                                                                            } else {
                                                                                                                echo "bg-success";
                                                                                                            }
                                                                                                            ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?= $fn_p_persen ?>%"><?= $fn_p_act ?></div>
                                    </div>

                                    <h2 class="card-text">Small Long</h2>

                                    <!-- batas bawah -->
                                    <div class="bar-step" style="padding-left: 56%; margin-left: -20px">
                                        <div class="label-percent"><?= $fn_sl_bb ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- batas atas -->
                                    <div class="bar-step" style="padding-left: 83%; margin-left: -27px">
                                        <div class="label-percent"><?= $fn_sl_ba ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- progressbar -->
                                    <div class="progress" style="border-radius: 4px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated <?php
                                                                                                            if ($fn_sl_persen < 55.57) {
                                                                                                                echo "bg-danger";
                                                                                                            } else {
                                                                                                                echo "bg-success";
                                                                                                            }
                                                                                                            ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?= $fn_sl_persen ?>%"><?= $fn_sl_act ?></div>
                                    </div>

                                    <h2 class="card-text">Small Short</h2>

                                    <!-- batas bawah -->
                                    <div class="bar-step" style="padding-left: 56%; margin-left: -20px">
                                        <div class="label-percent"><?= $fn_ss_bb ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- batas atas -->
                                    <div class="bar-step" style="padding-left: 83%; margin-left: -27px">
                                        <div class="label-percent"><?= $fn_ss_ba ?></div>
                                        <div class="label-line"></div>
                                    </div>

                                    <!-- progressbar -->
                                    <div class="progress" style="border-radius: 4px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated <?php
                                                                                                            if ($fn_ss_persen < 55.57) {
                                                                                                                echo "bg-danger";
                                                                                                            } else {
                                                                                                                echo "bg-success";
                                                                                                            }
                                                                                                            ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?= $fn_ss_persen ?>%"><?= $fn_ss_act ?></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
            booth letterpress, commodo enim craft beer mlkshk aliquip
        </div>
    </div>
</div>