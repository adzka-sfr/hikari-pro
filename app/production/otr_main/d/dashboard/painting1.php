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
                <div class="col-6">
                    <script src="jquery.min.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#refres1").on('change', function() {
                                var isia = $('#refres1').val();
                                $.ajax({
                                    url: "bar_chart/painting1a.php",
                                    method: "POST",
                                    data: {
                                        isia: isia
                                    },
                                    success: function(data) {
                                        $('#Container1').html(data);
                                    }
                                });
                            });
                        });

                        $(document).ready(function() {
                            $("#refres2").on('change', function() {
                                var isib = $('#refres2').val();
                                $.ajax({
                                    url: "bar_chart/painting1b.php",
                                    method: "POST",
                                    data: {
                                        isib: isib
                                    },
                                    success: function(data) {
                                        $('#Container2').html(data);
                                    }
                                });
                            });
                        });
                    </script>
                    <style>
                        .xixi {
                            font-size: larger;
                            width: 100%;
                            height: 30px;
                            text-align: left;
                            border-color: #888888;
                            color: #888888;
                            border-radius: 4px;
                        }
                    </style>
                    <select class="xixi" id="refres1" name="wc1">
                        <option value="" selected disabled>Select Work Center</option>
                        <option value="P220">P220 - UP Spray Satin</option>
                        <option value="P520">P520 - UP Finish Buff Panel</option>
                        <option value="P530">P530 - UP Painting Check</option>
                        <option value="P550">P550 - UP Furniture Check</option>
                        <option value="P700">P700 - GP Buff Panel & Small</option>
                        <option value="P820">P820 - GP Painting Check</option>
                    </select>
                </div>
                <div class="col-6">
                    <select class="xixi" id="refres2" name="wc2">
                        <option value="" selected disabled>Select Work Center</option>
                        <option value="P220">P220 - UP Spray Satin</option>
                        <option value="P520">P520 - UP Finish Buff Panel</option>
                        <option value="P530">P530 - UP Painting Check</option>
                        <option value="P550">P550 - UP Furniture Check</option>
                        <option value="P700">P700 - GP Buff Panel & Small</option>
                        <option value="P820">P820 - GP Painting Check</option>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="col-6">
                    <div id="Container1">
                        <?php include "bar_chart/painting1a.php" ?>
                    </div>
                </div>
                <div class="col-6">
                    <div id="Container2">
                        <?php include "bar_chart/painting1b.php" ?>
                    </div>
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
    ?>

    <?php
    //================== ACTIVITY LOG START ==================//
    // log activity record  
    // $now = date('Y-m-d H:i:s');
    // $token = $_SESSION['token'];

    // $l_t = $now;
    // $sy_n = "Mezzanine"; // Nama Sistem
    // $p_n = "dashboard"; // Nama Proses
    // $q = "read"; // Query
    // $e_n = $_SESSION['nama']; // Nama Karyawan
    // $e_i = $_SESSION['id']; // ID Karyawan
    // $c_i = $_SERVER['REMOTE_ADDR'];
    // $c_n = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    // $s_n = $_SERVER['SCRIPT_NAME'];
    // $h = $_SERVER['HTTP_HOST'];
    // mysqli_query($connect_log, "INSERT INTO activity_log set
    //                                 token = '$token',
    //                                 log_time = '$l_t',
    //                                 system_name = '$sy_n',
    //                                 process_name = '$p_n',
    //                                 query = '$q',
    //                                 employee_name = '$e_n',
    //                                 employee_id = '$e_i',
    //                                 computer_ip = '$c_i',
    //                                 computer_name = '$c_n',
    //                                 script_name = '$s_n',
    //                                 host = '$h'");

    //================== ACTIVITY LOG FINISH ==================//
    ?>