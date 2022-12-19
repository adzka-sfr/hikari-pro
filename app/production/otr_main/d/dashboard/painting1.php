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
                    <div id="bar" style="height:300px; width: 100%; padding-top: 10px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px; "></div>

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

    include 'bar_chart/painting1.php';
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