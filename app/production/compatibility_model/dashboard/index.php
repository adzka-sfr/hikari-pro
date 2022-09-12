<?php include('../../../../_header.php'); ?>
<?php include('koneksi.php') ?>

<body class="nav-md footer_fixed" style="background-color: #263238;">
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
                            <!-- <a class="dropdown-item" href="index2.php" style="background-color: #DEEDFF;"> Fixing Frame</a> -->
                            <a class="dropdown-item" href="<?= base_url('dashboard/') ?>"> Dashboard</a>
                            <a class="dropdown-item" href="result/"> Result</a>
                            <a class="dropdown-item" href="<?= base_url('panel/profile') ?>"> Profile</a>
                            <a class="dropdown-item" href="<?= base_url('panel/settings') ?>">Settings</a>
                            <a class="dropdown-item" href="<?= base_url('panel/help') ?>">Help</a>
                            <a class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- page content -->
    <div class="right_col" role="main" style="background-color: #263238;">
        <div class="dashboard_graph" style="padding-bottom: 0px;">
            <div class="row">
                <div class="col-md-9">
                    <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 23px; color: #212529;">COMPATIBILITY MODEL <a href="index_light.php" style="margin-left: 10px;"><i class="fa fa-sun-o" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"></i></a></h2>
                </div>
                <div class="col-md-3">
                    <span style="text-align: right ; margin-top: 0px;">

                        <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                            <h2 style="color: #2A3F54; padding-right: 10px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun . " " ?><span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                    </span>
                </div>
            </div>
        </div>

        <div class="dashboard_graph" style="padding-top: 0px; background-color: #263238;">
            <div class="row">
                <div class="col-6">
                    <div class="card w-100" style="background-color: #263238;">
                        <h1 style="font-weight: bold; padding-left: 20px; margin-top: 10px; margin-bottom: 0px; font-size: 30px; color: #FFFFFF;">FIXING FRAME RESULT |<u><span style="color: #FFFFFF;" id="hmbfixing"></span><span style="color: #FFFFFF;"></span></u>|</h1>
                        <div class="d-md-flex testimony-29101">
                            <div class="card-body">
                                <table class="table" style="font-size: 35px; background-color: #263238; color: #FFFF;">
                                    <thead style="font-size: 35px; padding-top: 5px; padding-bottom: 5px; background-color: #3169A6;">
                                        <th style="text-align: left;">Model </th>
                                        <!-- <th style="text-align: center;">WIP </th> -->
                                        <th style="text-align: center;">Act/Plan </th>
                                    </thead>
                                    <tbody id="fxall_d">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card w-100" style="background-color: #263238;">
                        <h1 style="font-weight: bold; padding-left: 20px; margin-top: 10px; margin-bottom: 0px; font-size: 30px; color: #FFFFFF;">STRINGING RESULT |<u><span style="color: #FFFFFF;" id="hmbstring"></span><span style="color: #FFFFFF;"></span></u>|</h1>
                        <div class="d-md-flex testimony-29101">
                            <div class="card-body">
                                <table class="table " style="font-size: 35px; background-color: #263238; color: #FFFF;">
                                    <thead style="font-size: 35px; padding-top: 5px; padding-bottom: 5px; background-color: #AA4541;">
                                        <th style="text-align: left;">Model </th>
                                        <th style="text-align: center;">WIP</th>
                                        <th style="text-align: center;">Act/Plan </th>
                                        <th style="text-align: center;">Stock </th>
                                    </thead>
                                    <tbody id="stall_d">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /page content -->

    <?php
    include('_footer_local.php');
    include('../../../../_footer.php'); ?>