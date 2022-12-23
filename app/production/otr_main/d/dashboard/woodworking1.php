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
                <div class="col-6">
                    <script src="jquery.min.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#refres1").on('change', function() {
                                var isia = $('#refres1').val();
                                $.ajax({
                                    url: "bar_chart/woodworking1a.php",
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
                                    url: "bar_chart/woodworking1b.php",
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
                        <option value="W130">Setting Veneer</option>
                        <option value="W170">Hot Press Panel</option>
                        <option value="W300">Machine Leg UP</option>
                        <option value="W400">Out & WW Check</option>
                    </select>
                </div>
                <div class="col-6">
                    <select class="xixi" id="refres2" name="wc2">
                        <option value="" selected disabled>Select Work Center</option>
                        <option value="W130">Setting Veneer</option>
                        <option value="W170">Hot Press Panel</option>
                        <option value="W300">Machine Leg UP</option>
                        <option value="W400">Out & WW Check</option>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="col-6">
                    <div id="Container1">
                        <?php include "bar_chart/woodworking1a.php" ?>
                    </div>
                </div>
                <div class="col-6">
                    <div id="Container2">
                        <?php include "bar_chart/woodworking1b.php" ?>
                    </div>
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

// include 'bar_chart/woodworking1a.php';
// include 'bar_chart/woodworking1b.php';
?>