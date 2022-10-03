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
                                    <div class="row">
                                        <div class="col-12">

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

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="container" style="padding-left: 10px; padding-right: 10px;">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th style="width: 40%;">KATEGORI</th>
                                                            <th style="width: 20%;">TARGET</th>
                                                            <th style="width: 20%;">ACTUAL</th>
                                                            <th style="width: 20%;">+/-</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- ijo : #3B996D -->
                                                        <!-- merah : #E15361 -->
                                                        <tr>
                                                            <td style="font-weight: bold;">PANEL</td>
                                                            <td style="text-align: right;"><?= $op_p_bb ?> pcs</td>
                                                            <td style="text-align: right;"><?= $op_p_act ?> pcs</td>
                                                            <td style="text-align: right; color: <?php
                                                                                                    if ($op_p_act < $op_p_bb) {
                                                                                                        echo "#E15361";
                                                                                                    } else {
                                                                                                        echo "#3B996D";
                                                                                                    }
                                                                                                    ?>"><?= $op_p_act - $op_p_bb ?> pcs</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-weight: bold;">SMALL LONG</td>
                                                            <td style="text-align: right;"><?= $op_sl_bb ?> pcs</td>
                                                            <td style="text-align: right;"><?= $op_sl_act ?> pcs</td>
                                                            <td style="text-align: right; right; color: <?php
                                                                                                        if ($op_sl_act < $op_sl_bb) {
                                                                                                            echo "#E15361";
                                                                                                        } else {
                                                                                                            echo "#3B996D";
                                                                                                        }
                                                                                                        ?>"><?= $op_sl_act - $op_sl_bb ?> pcs</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-weight: bold;">SMALL SHORT</td>
                                                            <td style="text-align: right;"><?= $op_ss_bb ?> pcs</td>
                                                            <td style="text-align: right;"><?= $op_ss_act ?> pcs</td>
                                                            <td style="text-align: right; color: <?php
                                                                                                    if ($op_ss_act < $op_ss_bb) {
                                                                                                        echo "#E15361";
                                                                                                    } else {
                                                                                                        echo "#3B996D";
                                                                                                    }
                                                                                                    ?>"><?= $op_ss_act - $op_ss_bb ?> pcs</td>
                                                        </tr>
                                                        <tr style="font-weight: bold;">
                                                            <td style="font-weight: bold; text-align: right;">TOTAL</td>
                                                            <td style="text-align: right;"><?= $op_p_bb + $op_sl_bb + $op_ss_bb ?> pcs</td>
                                                            <td style="text-align: right;"><?= $op_ss_act ?> pcs</td>
                                                            <td style="text-align: right;"><?= $op_ss_act - $op_ss_bb ?> pcs</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="container" style="padding-left: 10px; padding-right: 10px;">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th style="width: 40%;">KATEGORI</th>
                                                            <th style="width: 20%;">TARGET</th>
                                                            <th style="width: 20%;">ACTUAL</th>
                                                            <th style="width: 20%;">+/-</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- ijo : #3B996D -->
                                                        <!-- merah : #E15361 -->
                                                        <tr>
                                                            <td style="font-weight: bold;">PANEL</td>
                                                            <td style="text-align: right;"><?= $fn_p_bb ?> pcs</td>
                                                            <td style="text-align: right;"><?= $fn_p_act ?> pcs</td>
                                                            <td style="text-align: right; color: <?php
                                                                                                    if ($fn_p_act < $fn_p_bb) {
                                                                                                        echo "#E15361";
                                                                                                    } else {
                                                                                                        echo "#3B996D";
                                                                                                    }
                                                                                                    ?>"><?= $fn_p_act - $fn_p_bb ?> pcs</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-weight: bold;">SMALL LONG</td>
                                                            <td style="text-align: right;"><?= $fn_sl_bb ?> pcs</td>
                                                            <td style="text-align: right;"><?= $fn_sl_act ?> pcs</td>
                                                            <td style="text-align: right; right; color: <?php
                                                                                                        if ($fn_sl_act < $fn_sl_bb) {
                                                                                                            echo "#E15361";
                                                                                                        } else {
                                                                                                            echo "#3B996D";
                                                                                                        }
                                                                                                        ?>"><?= $fn_sl_act - $fn_sl_bb ?> pcs</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-weight: bold;">SMALL SHORT</td>
                                                            <td style="text-align: right;"><?= $fn_ss_bb ?> pcs</td>
                                                            <td style="text-align: right;"><?= $fn_ss_act ?> pcs</td>
                                                            <td style="text-align: right; color: <?php
                                                                                                    if ($fn_ss_act < $fn_ss_bb) {
                                                                                                        echo "#E15361";
                                                                                                    } else {
                                                                                                        echo "#3B996D";
                                                                                                    }
                                                                                                    ?>"><?= $fn_ss_act - $fn_ss_bb ?> pcs</td>
                                                        </tr>
                                                        <tr style="font-weight: bold;">
                                                            <td style="font-weight: bold; text-align: right;">TOTAL</td>
                                                            <td style="text-align: right;"><?= $fn_p_bb + $fn_sl_bb + $fn_ss_bb ?> pcs</td>
                                                            <td style="text-align: right;"><?= $fn_ss_act ?> pcs</td>
                                                            <td style="text-align: right;"><?= $fn_ss_act - $op_ss_bb ?> pcs</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" style="margin-top: 10px;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="card-title"><b>Control Stock 2 Hours - <?= $semua2jam ?> Rak</b></h5>
                                </div>
                            </div>
                            <div class="separator" style="margin-top: 0px;"></div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6><b>Panel - <?= $all_rak_p ?> Rak</b></h6>
                                                </div>
                                            </div>
                                            <div class="separator" style="margin-top: 0px;"></div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="panel2" style="height:200px; padding-top: 0px;"></div>
                                                    <?php include 'chart/panel2.php' ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr style="text-align: center;">
                                                                <th style="width: 50%;">Timer</th>
                                                                <th style="width: 25%;">Qty</th>
                                                                <th style="width: 25%;">Rak</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    < 2 Hours</td>

                                                                <td style="text-align: right;"><?= $less_pcs_p ?> pcs</td>
                                                                <td style="text-align: right;"><?= $less_rak_p ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    > 2 Hours</td>
                                                                <td style="text-align: right;"><?= $more_pcs_p ?> pcs</td>
                                                                <td style="text-align: right;"><?= $more_rak_p ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;">
                                                                    Total</td>
                                                                <td style="text-align: right;"><?= $all_pcs_p ?> pcs</td>
                                                                <td style="text-align: right;"><?= $all_rak_p ?> rak</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6><b>Small Short - <?= $all_rak_ss ?> Rak</b></h6>
                                                </div>
                                            </div>
                                            <div class="separator" style="margin-top: 0px;"></div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="smallshort2" style="height:200px; padding-top: 0px;"></div>
                                                    <?php include 'chart/smallshort2.php' ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr style="text-align: center;">
                                                                <th style="width: 50%;">Timer</th>
                                                                <th style="width: 25%;">Qty</th>
                                                                <th style="width: 25%;">Rak</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    < 2 Hours</td>

                                                                <td style="text-align: right;"><?= $less_pcs_ss ?> pcs</td>
                                                                <td style="text-align: right;"><?= $less_rak_ss ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    > 2 Hours</td>
                                                                <td style="text-align: right;"><?= $more_pcs_ss ?> pcs</td>
                                                                <td style="text-align: right;"><?= $more_rak_ss ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;">
                                                                    Total</td>
                                                                <td style="text-align: right;"><?= $all_pcs_ss ?> pcs</td>
                                                                <td style="text-align: right;"><?= $all_rak_ss ?> rak</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6><b>Small Long - <?= $all_rak_sl ?> Rak</b></h6>
                                                </div>
                                            </div>
                                            <div class="separator" style="margin-top: 0px;"></div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="smalllong2" style="height:200px; padding-top: 0px;"></div>
                                                    <?php include 'chart/smalllong2.php' ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr style="text-align: center;">
                                                                <th style="width: 50%;">Timer</th>
                                                                <th style="width: 25%;">Qty</th>
                                                                <th style="width: 25%;">Rak</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    < 2 Hours</td>

                                                                <td style="text-align: right;"><?= $less_pcs_sl ?> pcs</td>
                                                                <td style="text-align: right;"><?= $less_rak_sl ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    > 2 Hours</td>
                                                                <td style="text-align: right;"><?= $more_pcs_sl ?> pcs</td>
                                                                <td style="text-align: right;"><?= $more_rak_sl ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;">
                                                                    Total</td>
                                                                <td style="text-align: right;"><?= $all_pcs_sl ?> pcs</td>
                                                                <td style="text-align: right;"><?= $all_rak_sl ?> rak</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 10px;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="card-title"><b>Control Stock 16 Hours - <?= $semua16jam ?> Rak</b></h5>
                                </div>
                            </div>
                            <div class="separator" style="margin-top: 0px;"></div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6><b>Panel - <?= $all_rak_p16 ?> Rak</b></h6>
                                                </div>
                                            </div>
                                            <div class="separator" style="margin-top: 0px;"></div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="panel16" style="height:200px; padding-top: 0px;"></div>
                                                    <?php include 'chart/panel16.php' ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr style="text-align: center;">
                                                                <th style="width: 50%;">Timer</th>
                                                                <th style="width: 25%;">Qty</th>
                                                                <th style="width: 25%;">Rak</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    < 16 Hours</td>

                                                                <td style="text-align: right;"><?= $less16pcsp ?> pcs</td>
                                                                <td style="text-align: right;"><?= $less16rakp ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    > 16 Hours & < 3 Days</td>
                                                                <td style="text-align: right;"><?= $mid16pcsp ?> pcs</td>
                                                                <td style="text-align: right;"><?= $mid16rakp ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    > 3 Days</td>
                                                                <td style="text-align: right;"><?= $more16pcsp ?> pcs</td>
                                                                <td style="text-align: right;"><?= $more16rakp ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;">
                                                                    Total</td>
                                                                <td style="text-align: right;"><?= $all_pcs_p16 ?> pcs</td>
                                                                <td style="text-align: right;"><?= $all_rak_p16 ?> rak</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6><b>Small Short - <?= $all_rak_ss16 ?> Rak</b></h6>
                                                </div>
                                            </div>
                                            <div class="separator" style="margin-top: 0px;"></div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="smallshort16" style="height:200px; padding-top: 0px;"></div>
                                                    <?php include 'chart/smallshort16.php' ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr style="text-align: center;">
                                                                <th style="width: 50%;">Timer</th>
                                                                <th style="width: 25%;">Qty</th>
                                                                <th style="width: 25%;">Rak</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    < 16 Hours</td>

                                                                <td style="text-align: right;"><?= $less16pcsss ?> pcs</td>
                                                                <td style="text-align: right;"><?= $less16rakss ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    > 16 Hours & < 3 Days</td>
                                                                <td style="text-align: right;"><?= $mid16pcsss ?> pcs</td>
                                                                <td style="text-align: right;"><?= $mid16rakss ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    > 3 Days</td>
                                                                <td style="text-align: right;"><?= $more16pcsss ?> pcs</td>
                                                                <td style="text-align: right;"><?= $more16rakss ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;">
                                                                    Total</td>
                                                                <td style="text-align: right;"><?= $all_pcs_ss16 ?> pcs</td>
                                                                <td style="text-align: right;"><?= $all_rak_ss16 ?> rak</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6><b>Small Long - <?= $all_rak_sl16 ?> Rak</b></h6>
                                                </div>
                                            </div>
                                            <div class="separator" style="margin-top: 0px;"></div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="smalllong16" style="height:200px; padding-top: 0px;"></div>
                                                    <?php include 'chart/smalllong16.php' ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr style="text-align: center;">
                                                                <th style="width: 50%;">Timer</th>
                                                                <th style="width: 25%;">Qty</th>
                                                                <th style="width: 25%;">Rak</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                            <tr>
                                                                <td>
                                                                    < 16 Hours</td>

                                                                <td style="text-align: right;"><?= $less16pcssl ?> pcs</td>
                                                                <td style="text-align: right;"><?= $less16raksl ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    > 16 Hours & < 3 Days</td>
                                                                <td style="text-align: right;"><?= $mid16pcssl ?> pcs</td>
                                                                <td style="text-align: right;"><?= $mid16raksl ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    > 3 Days</td>
                                                                <td style="text-align: right;"><?= $more16pcssl ?> pcs</td>
                                                                <td style="text-align: right;"><?= $more16raksl ?> rak</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;">
                                                                    Total</td>
                                                                <td style="text-align: right;"><?= $all_pcs_sl16 ?> pcs</td>
                                                                <td style="text-align: right;"><?= $all_rak_sl16 ?> rak</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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