<?php include('header.php'); ?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
    <!-- <div class="container body"> -->
    <!-- <div class="main_container"> -->
    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <!-- <a style="padding-top: 5px;"> -->
                <h3 style="letter-spacing: 2px; padding-left: 50px; "><u><b>HIKARI</b></u></h3>
                <!-- </a> -->
            </div>
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <span style="text-align: right ; margin-top: 10px;">

                        <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                            <h2 style="color: #2A3F54; margin-top: 0px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun ?> <span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                    </span>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main" style="background-color: #fff;">

        <div class="dashboard_graph">
            <div class="row x_title">
                <div class="col-md-12">

                    <div class="d-flex">
                        <div class="flex-fill" style="width: 20%;">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card">
                                        <h5 class="card-header">Wood Working</h5>
                                        <div class="card-body" style="padding: 5px;">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="speed_woodworking" style="height:200px; padding-top: 0px; "></div>
                                                </div>
                                            </div>

                                            <div class="progress" style="border-radius: 4px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 20%;">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card">
                                        <h5 class="card-header">Painting</h5>
                                        <div class="card-body" style="padding: 5px;">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="speed_painting" style="height:200px; padding-top: 0px; "></div>
                                                </div>
                                            </div>

                                            <div class="progress" style="border-radius: 4px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 20%;">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card">
                                        <h5 class="card-header">UP Assy</h5>
                                        <div class="card-body" style="padding: 5px;">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="speed_upassy" style="height:200px; padding-top: 0px; "></div>
                                                </div>
                                            </div>

                                            <div class="progress" style="border-radius: 4px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 20%;">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card">
                                        <h5 class="card-header">GP Assy</h5>
                                        <div class="card-body" style="padding: 5px;">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="speed_gpassy" style="height:200px; padding-top: 0px; "></div>
                                                </div>
                                            </div>

                                            <div class="progress" style="border-radius: 4px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 20%;">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card">
                                        <h5 class="card-header">KD Part</h5>
                                        <div class="card-body" style="padding: 5px;">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="speed_kdpart" style="height:200px; padding-top: 0px; "></div>
                                                </div>
                                            </div>

                                            <div class="progress" style="border-radius: 4px;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
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

        <?php
        include 'speedo/woodworking.php';
        include 'speedo/painting.php';
        include 'speedo/upassy.php';
        include 'speedo/gpassy.php';
        include 'speedo/kdpart.php';
        ?>
    </div>
    <!-- /page content -->

    <?php include('../_footer.php'); ?>