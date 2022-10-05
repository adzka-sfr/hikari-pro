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

            <!-- Dashboard 2 Jam -->
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

            <!-- Dashboard 16 Jam -->
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" style="padding: 10px;">
                            <div class="row">
                                <div class="col-12">
                                    <h6><b>Summary All - <?= $sumol ?></b></h6>
                                </div>
                            </div>
                            <div class="separator" style="margin-top: 0px;"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="accord1">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="allcab">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#all_cab2" aria-expanded="false" aria-controls="all_cab2">
                                                    <span style="font-weight: bold;  text-align: right; width: 73px;"><?= $tsb ?> pcs </span> - Seasoning 2 Hours
                                                </button>
                                            </h2>
                                            <div id="all_cab2" class="accordion-collapse collapse" aria-labelledby="allcab" data-bs-parent="#accord1">
                                                <div class="accordion-body">

                                                    <?php
                                                    include 'table/t_hour2.php';
                                                    ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="allcab">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#all_cab16" aria-expanded="false" aria-controls="all_cab16">
                                                    <span style="font-weight: bold;  text-align: right; width: 73px;"><?= $tsa ?> pcs </span> - Seasoning 16 Hours
                                                </button>
                                            </h2>
                                            <div id="all_cab16" class="accordion-collapse collapse" aria-labelledby="allcab" data-bs-parent="#accord1">
                                                <div class="accordion-body">

                                                    <?php
                                                    include 'table/t_hour16.php';
                                                    ?>

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
                        <div class="card-body" style="padding: 10px;">
                            <div class="row">
                                <div class="col-12">
                                    <h6><b>by Category</b></h6>
                                </div>
                            </div>
                            <div class="separator" style="margin-top: 0px;"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="accord2">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="allcab">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cat_1" aria-expanded="false" aria-controls="cat_1">
                                                    <span style="font-weight: bold;  text-align: right; width: 73px;"><?= $tcp ?> pcs </span> - Panel
                                                </button>
                                            </h2>
                                            <div id="cat_1" class="accordion-collapse collapse" aria-labelledby="allcab" data-bs-parent="#accord2">
                                                <div class="accordion-body">

                                                    <?php
                                                    include 'table/t_cpanel.php';
                                                    ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="allcab">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cat_2" aria-expanded="false" aria-controls="cat_2">
                                                    <span style="font-weight: bold;  text-align: right; width: 73px;"><?= $tcss ?> pcs </span> - Small Short
                                                </button>
                                            </h2>
                                            <div id="cat_2" class="accordion-collapse collapse" aria-labelledby="allcab" data-bs-parent="#accord2">
                                                <div class="accordion-body">

                                                    <?php
                                                    include 'table/t_csmallshort.php';
                                                    ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="allcab">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cat_3" aria-expanded="false" aria-controls="cat_3">
                                                    <span style="font-weight: bold;  text-align: right; width: 73px;"><?= $tcsl ?> pcs </span> - Small Long
                                                </button>
                                            </h2>
                                            <div id="cat_3" class="accordion-collapse collapse" aria-labelledby="allcab" data-bs-parent="#accord2">
                                                <div class="accordion-body">

                                                    <?php
                                                    include 'table/t_csmalllong.php';
                                                    ?>

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

            <div class="row" style="margin-top: 10px ;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" style="padding: 10px;">
                            <div class="row">
                                <div class="col-12">
                                    <h6><b>by On Process / Finish</b></h6>
                                </div>
                            </div>
                            <div class="separator" style="margin-top: 0px;"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="accord3">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="of">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#of_1" aria-expanded="false" aria-controls="of_1">
                                                    <span style="font-weight: bold;  text-align: right; width: 73px;"><?= $topp ?> pcs </span> - On Process
                                                </button>
                                            </h2>
                                            <div id="of_1" class="accordion-collapse collapse" aria-labelledby="of" data-bs-parent="#accord3">
                                                <div class="accordion-body">

                                                    <?php
                                                    include 'table/t_opfp.php';
                                                    ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="of">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#of_2" aria-expanded="false" aria-controls="of_2">
                                                    <span style="font-weight: bold;  text-align: right; width: 73px;"><?= $tff ?> pcs </span> - Finish
                                                </button>
                                            </h2>
                                            <div id="of_2" class="accordion-collapse collapse" aria-labelledby="of" data-bs-parent="#accord3">
                                                <div class="accordion-body">

                                                    <?php
                                                    include 'table/t_opff.php';
                                                    ?>

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

            <div class="row" style="margin-top: 10px ;">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body" style="padding: 10px;">
                            <div class="row">
                                <div class="col-12">
                                    <h6><b>by Model</b></h6>
                                </div>
                            </div>
                            <div class="separator" style="margin-top: 0px;"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="accord4">

                                        <?php
                                        include 'table/t_model.php';
                                        ?>

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