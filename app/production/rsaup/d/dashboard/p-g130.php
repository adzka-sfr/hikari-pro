<?php include('../../../../../_header.php');
include('../app_name.php'); ?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <!-- <a style="padding-top: 5px;"> -->
                <!-- <h3 style="letter-spacing: 2px; padding-left: 50px;"><u><b>HIKARI</b></u></h3> -->
                <a href="<?= base_url('dashboard/') ?>" style="padding-top:15px; padding-left: 30px;"><img src="<?= base_url('_assets/production/images/yamaha_purple_no_waves.png') ?>" alt="logo_yamaha" height="30"></a>
                <!-- </a> -->
            </div>
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt=""><?php echo $_SESSION['nama'] ?>
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url('dashboard/') ?>">Hikari</a>
                            <a class="dropdown-item" href="index.php">Dashboard</a>
                            <span style="padding-left: 20px; font-weight: bold;">Priority by Destination</span>
                            <a style="padding-left: 30px;" class="dropdown-item" href="p-g130.php">G130</a>
                            <a style="padding-left: 30px;" class="dropdown-item" href="p-g150.php">G150</a>
                            <a style="padding-left: 30px;" class="dropdown-item" href="p-g200.php">G200</a>
                            <a class="dropdown-item" href="_help/">Help</a>
                            <a class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- page content -->
    <div class="right_col" role="main">

        <div class="dashboard_graph" style="padding-bottom: 0px;">
            <div class="row">
                <div class="col-md-9">
                    <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 23px; color: #212529;"><?= strtoupper($app_name) ?> - PRIORITY OF G130</h2>
                </div>
                <div class="col-md-3">
                    <span style="text-align: right ; margin-top: 0px;">

                        <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                            <h2 style="color: #2A3F54; padding-right: 10px; margin-top: 0px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun . " " ?><span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                    </span>
                </div>
            </div>
            <hr style="margin: 0px;">
        </div>

        <div class="dashboard_graph" style="padding-top: 0px; margin-top: 10px;">
            <div class="row">
                <div class="col-12">
                    <table class="table " style="font-size: 35px;">
                        <thead style="font-size: 35px; padding-top: 5px; padding-bottom: 5px; background-color: #DBEBFF; ">
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Cabinet</th>
                                <th style="text-align: center;">Model</th>
                                <th style="text-align: center;">Qty</th>
                            </tr>
                        </thead>
                        <tbody id="g130">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /page content -->

    <!-- .item -->
    <script src="js/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function() {
            selesai();
        });

        function selesai() {
            setTimeout(function() {
                update();
                selesai();
            }, 200);
        }

        function update() {
            $.getJSON("G0.php", function(data) {
                $("#g130").empty();
                var no = 1;
                $.each(data.result, function() {
                    $("#g130").append("<tr><td style='text-align: center;'>" + (no++) + "</td><td>" + this['name_ori_cabinet'] + "</td><td style='text-align:center'>" + this['name_piano'] + "</td><td style='text-align: center'><h1 style='border-radius: 0.25rem; background-color: #DBEBFF; text-align: center;'>" + this['pcs_prioritas'] + "</h1></td></tr>");
                });
            });
        }
    </script>

    <?php
    include('../../../../../_footer.php'); ?>