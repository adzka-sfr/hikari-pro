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
            <div class="separator" style="padding: 0px; padding-bottom: 5px;"></div>
            <div class="row">
                <script src="<?= base_url('_assets/src/add/dropdown_search/jquery-3.4.1.js') ?>" crossorigin="anonymous"></script>
                <script src="<?= base_url('_assets/src/add/dropdown_search/select2.min.js') ?>"></script>

                <?php
                // create session wc
                if (isset($_POST['wc1'])) {
                    $_SESSION['wc_otr1'] = $_POST['wc1'];
                }

                if (isset($_POST['wc2'])) {
                    $_SESSION['wc_otr2'] = $_POST['wc2'];
                }

                // cek wc 1
                if (empty($_SESSION['wc_otr1'])) {
                    $_SESSION['wc_otr1'] = 'P530';
                }

                // cek wc 2
                if (empty($_SESSION['wc_otr2'])) {
                    $_SESSION['wc_otr2'] = 'P820';
                }

                // cek untuk mengaktifkan label dropdown
                $wcp2201 = '';
                $wcp5201 = '';
                $wcp5301 = '';
                $wcp5501 = '';
                $wcp7001 = '';
                $wcp8201 = '';
                $wcp2202 = '';
                $wcp5202 = '';
                $wcp5302 = '';
                $wcp5502 = '';
                $wcp7002 = '';
                $wcp8202 = '';
                if ($_SESSION['wc_otr1'] == 'P220') {
                    $wcp2201 = 'selected disabled';
                } elseif ($_SESSION['wc_otr1'] == 'P520') {
                    $wcp5201 = 'selected disabled';
                } elseif ($_SESSION['wc_otr1'] == 'P530') {
                    $wcp5301 = 'selected disabled';
                } elseif ($_SESSION['wc_otr1'] == 'P550') {
                    $wcp5501 = 'selected disabled';
                } elseif ($_SESSION['wc_otr1'] == 'P700') {
                    $wcp7001 = 'selected disabled';
                } elseif ($_SESSION['wc_otr1'] == 'P820') {
                    $wcp8201 = 'selected disabled';
                }

                if ($_SESSION['wc_otr2'] == 'P220') {
                    $wcp2202 = 'selected disabled';
                } elseif ($_SESSION['wc_otr2'] == 'P520') {
                    $wcp5202 = 'selected disabled';
                } elseif ($_SESSION['wc_otr2'] == 'P530') {
                    $wcp5302 = 'selected disabled';
                } elseif ($_SESSION['wc_otr2'] == 'P550') {
                    $wcp5502 = 'selected disabled';
                } elseif ($_SESSION['wc_otr2'] == 'P700') {
                    $wcp7002 = 'selected disabled';
                } elseif ($_SESSION['wc_otr2'] == 'P820') {
                    $wcp8202 = 'selected disabled';
                }
                ?>
                <div class="col-6">
                    <form method="POST">
                        <select class="cari_nosearch" style="width: 100%; text-align: left;" name="wc1" onchange="this.form.submit();">
                            <!-- <option value="" selected disabled>Select Slip Number</option> -->
                            <option <?= $wcp2201 ?> value="P220">UP Spray Satin</option>
                            <option <?= $wcp5201 ?> value="P520">UP Finish Buff Panel</option>
                            <option <?= $wcp5301 ?> value="P530">UP Painting Check</option>
                            <option <?= $wcp5501 ?> value="P550">UP Furniture Check</option>
                            <option <?= $wcp7001 ?> value="P700">GP Buff Panel & Small</option>
                            <option <?= $wcp8201 ?> value="P820">GP Painting Check</option>
                        </select>
                    </form>
                </div>
                <div class="col-6">
                    <form method="POST">
                        <select class="cari_nosearch" style="width: 100%; text-align: left;" name="wc2" onchange="this.form.submit();">
                            <!-- <option value="" selected disabled>Select Slip Number</option> -->
                            <option <?= $wcp2202 ?> value="P220">UP Spray Satin</option>
                            <option <?= $wcp5202 ?> value="P520">UP Finish Buff Panel</option>
                            <option <?= $wcp5302 ?> value="P530">UP Painting Check</option>
                            <option <?= $wcp5502 ?> value="P550">UP Furniture Check</option>
                            <option <?= $wcp7002 ?> value="P700">GP Buff Panel & Small</option>
                            <option <?= $wcp8202 ?> value="P820">GP Painting Check</option>
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

    <?php
    include 'planacc_v3/up_spray.php';
    include 'planacc_v3/up_finish.php';
    include 'planacc_v3/up_painting.php';
    include 'planacc_v3/up_furniture.php';
    include 'planacc_v3/gp_buff.php';
    include 'planacc_v3/gp_painting.php';

    include 'bar_chart/painting1a.php';
    include 'bar_chart/painting1b.php';
    ?>

    <?php
    //================== ACTIVITY LOG START ==================//
    // log activity record  
    $now = date('Y-m-d H:i:s');
    $token = $_SESSION['token'];

    $l_t = $now;
    $sy_n = "Mezzanine"; // Nama Sistem
    $p_n = "dashboard"; // Nama Proses
    $q = "read"; // Query
    $e_n = $_SESSION['nama']; // Nama Karyawan
    $e_i = $_SESSION['id']; // ID Karyawan
    $c_i = $_SERVER['REMOTE_ADDR'];
    $c_n = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $s_n = $_SERVER['SCRIPT_NAME'];
    $h = $_SERVER['HTTP_HOST'];
    mysqli_query($connect_log, "INSERT INTO activity_log set
                                    token = '$token',
                                    log_time = '$l_t',
                                    system_name = '$sy_n',
                                    process_name = '$p_n',
                                    query = '$q',
                                    employee_name = '$e_n',
                                    employee_id = '$e_i',
                                    computer_ip = '$c_i',
                                    computer_name = '$c_n',
                                    script_name = '$s_n',
                                    host = '$h'");

    //================== ACTIVITY LOG FINISH ==================//
    ?>