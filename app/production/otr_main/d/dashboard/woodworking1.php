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
                <script src="<?= base_url('_assets/src/add/dropdown_search/jquery-3.4.1.js') ?>" crossorigin="anonymous"></script>
                <script src="<?= base_url('_assets/src/add/dropdown_search/select2.min.js') ?>"></script>

                <?php
                // create session ww
                if (isset($_POST['ww1'])) {
                    $_SESSION['ww_otr1'] = $_POST['ww1'];
                }

                if (isset($_POST['ww2'])) {
                    $_SESSION['ww_otr2'] = $_POST['ww2'];
                }

                // cek ww 1
                if (empty($_SESSION['ww_otr1'])) {
                    $_SESSION['ww_otr1'] = 'W130';
                }

                // cek ww 2
                if (empty($_SESSION['ww_otr2'])) {
                    $_SESSION['ww_otr2'] = 'W300';
                }

                // cek untuk mengaktifkan label dropdown
                $wwp2201 = '';
                $wwp5201 = '';
                $wwp5301 = '';
                $wwp5501 = '';
                $wwp2202 = '';
                $wwp5202 = '';
                $wwp5302 = '';
                $wwp5502 = '';
                if ($_SESSION['ww_otr1'] == 'W130') {
                    $wwp2201 = 'selected disabled';
                } elseif ($_SESSION['ww_otr1'] == 'W170') {
                    $wwp5201 = 'selected disabled';
                } elseif ($_SESSION['ww_otr1'] == 'W300') {
                    $wwp5301 = 'selected disabled';
                } elseif ($_SESSION['ww_otr1'] == 'W400') {
                    $wwp5501 = 'selected disabled';
                }

                if ($_SESSION['ww_otr2'] == 'W130') {
                    $wwp2202 = 'selected disabled';
                } elseif ($_SESSION['ww_otr2'] == 'W170') {
                    $wwp5202 = 'selected disabled';
                } elseif ($_SESSION['ww_otr2'] == 'W300') {
                    $wwp5302 = 'selected disabled';
                } elseif ($_SESSION['ww_otr2'] == 'W400') {
                    $wwp5502 = 'selected disabled';
                }
                ?>
                <div class="col-6">
                    <form method="POST">
                        <select class="cari_nosearch" style="width: 100%; text-align: left;" name="ww1" onchange="this.form.submit();">
                            <!-- <option value="" selected disabled>Select Slip Number</option> -->
                            <option <?= $wwp2201 ?> value="W130">Setting Veneer</option>
                            <option <?= $wwp5201 ?> value="W170">Hot Press Panel</option>
                            <option <?= $wwp5301 ?> value="W300">Machine Leg UP</option>
                            <option <?= $wwp5501 ?> value="W400">Out WW & Check UP</option>
                        </select>
                    </form>
                </div>
                <div class="col-6">
                    <form method="POST">
                        <select class="cari_nosearch" style="width: 100%; text-align: left;" name="ww2" onchange="this.form.submit();">
                            <!-- <option value="" selected disabled>Select Slip Number</option> -->
                            <option <?= $wwp2202 ?> value="W130">Setting Veneer</option>
                            <option <?= $wwp5202 ?> value="W170">Hot Press Panel</option>
                            <option <?= $wwp5302 ?> value="W300">Machine Leg UP</option>
                            <option <?= $wwp5502 ?> value="W400">Out WW & Check UP</option>
                        </select>
                    </form>
                </div>

                <?php



                ?>
            </div>
            <div class="row">
                <div class="col-6">
                    <div id="bar1a" style="height:300px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; "></div>

                    <?php
                    // include 'tabel_painting.php';
                    ?>
                </div>
                <div class="col-6">
                    <div id="bar1b" style="height:300px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; "></div>

                    <?php
                    // include 'tabel_painting.php';
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

include 'bar_chart/woodworking1a.php';
include 'bar_chart/woodworking1b.php';
?>