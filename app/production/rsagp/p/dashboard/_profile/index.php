<?php include('../../../../../_header.php');
include('../../app_name.php') ?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
    <!-- <div class="container body"> -->
    <!-- <div class="main_container"> -->
    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <div class="nav toggle">
                    <a href="<?= base_url('dashboard/') ?>" style="padding-top:15px; padding-left: 30px;"><img src="<?= base_url('_assets/production/images/yamaha_purple_no_waves.png') ?>" alt="logo_yamaha" height="30"></a>
                </div>
            </div>
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt="profile"><?php echo $_SESSION['nama'] ?>
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url('dashboard/') ?>">Hikari</a>
                            <a class="dropdown-item" href="../">Dashboard</a>
                            <a class="dropdown-item" href="" style="background-color: #e9ecef;"> Profile</a>
                            <a class="dropdown-item" href="../_settings/">Settings</a>
                            <a class="dropdown-item" href="../_help/">Help</a>
                            <a class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">

        <div class="dashboard_graph" style="padding-bottom: 0px;">
            <div class="row">
                <div class="col-md-9">
                    <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 23px; color: #212529;"><?= strtoupper($app_name) ?></h2>
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

        <div class="dashboard_graph" style="background-color: #F7F7F7;">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3 style="text-align: center;">Profile</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content" style="text-align: center;">

                            <img style="border-radius: 50%; margin-bottom: 10px;" src="<?= base_url('_assets/production/images/profile.png') ?>" alt="">
                            <br />

                            <?php
                            $sql1 = mysqli_query($connect, "SELECT * from auth where id = '$_SESSION[id]'");
                            $data1 = mysqli_fetch_array($sql1);
                            ?>
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">ID</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input type="text" class="form-control" value="<?= $data1['id'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Name</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input type="text" class="form-control" value="<?= $data1['nama'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Position</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input type="text" class="form-control" value="<?= $data1['jabatan'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Department</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input id="middle-name" class="form-control" value="<?= $data1['dept'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Gender</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input id="middle-name" class="form-control" value="<?= $data1['jenkel'] ?>" disabled>
                                    </div>
                                </div>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /page content -->

    <?php include('../../../../../_footer.php'); ?>