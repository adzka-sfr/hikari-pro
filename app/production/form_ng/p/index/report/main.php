<?php include('../../../../../../_header.php');
include('../../app_name.php');
include('../koneksi.php');

?>
<script>
    var el = document.getElementById('overlayBtn');
    if (el) {
        el.addEventListener('click', swapper, false);
    }
</script>

<script src="<?= base_url('_assets/src/add/sweetalert2.all.min.js') ?>"></script>
<!-- <title>Form NG</title> -->

<body class="nav-md footer_fixed">
    <div class="loading" style="background-color:#263238 ;">
        <div style="margin-top: 200px; margin-right: 70px; color: #dfc; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; " class="lds-hourglass"><span style="padding-left: 19px;">Loading</span></div>
    </div>
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?= base_url('dashboard') ?>" class="site_title" style="padding-left: 15px;"><img src="<?= base_url('_assets/production/images/emblem_hikari_white.png') ?>" alt="logo" style="width: 40px;"> <span><img src="<?= base_url('_assets/production/images/hikari_text_white.png') ?>" alt="piano" style="width: 110px;"></span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $_SESSION['nama'] ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li <?php if ($_GET['p'] == "dash") {
                                        echo 'class="active"';
                                    } ?>><a href="main.php?p=dash"><i class="fa fa-desktop"></i> Dashboard</a>
                                </li>
                            </ul>
                        </div>

                        <div class="menu_section">
                            <h3>Data NG</h3>
                            <ul class="nav side-menu">
                                <li <?php if ($_GET['p'] == "data") {
                                        echo 'class="active"';
                                    } ?>><a href="main.php?p=data"><i class="fa fa-file-text-o"></i> Summary of NG</a>
                                </li>
                                <li <?php if ($_GET['p'] == "data2") {
                                        echo 'class="active"';
                                    } ?>><a href="main.php?p=data2"><i class="fa fa-print"></i> Summary by Process</a>
                                </li>
                            </ul>
                        </div>

                        <div class="menu_section">
                            <h3>Print</h3>
                            <ul class="nav side-menu">
                                <li <?php if ($_GET['p'] == "pdf" or $_GET['p'] == "wkejfgheukj" or $_GET['p'] == "leigjwiroeh") {
                                        echo 'class="active"';
                                    } ?>><a href="main.php?p=pdf"><i class="fa fa-file-pdf-o"></i> Export Check Card</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <!-- <div class="sidebar-footer hidden-small">
                        <a style="color: inherit;" href="<?= base_url('dashboard') ?>" data-toggle="tooltip" data-placement="top" title="Dashboard">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                        </a>
                        <a style="color: inherit;" href="_profile/" data-toggle="tooltip" data-placement="top" title="Profile">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        </a>
                        <a style="color: inherit;" href="_settings/" data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url('auth/act_logout.php') ?>">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div> -->
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt=""><?php echo $_SESSION['nama'] ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="_profile/"> Profile</a>
                                    <a class="dropdown-item" href="_settings/">Settings</a>
                                    <a class="dropdown-item" href="_help/">Help</a>
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

                <div class="dashboard_graph" style="padding-bottom: 0px; padding-left: 0px; padding-right: 0px; margin-left: 0px; background-color: #F7F7F7;">
                    <div class="row">
                        <div class="col-md-7">
                            <h3 style="font-weight: bold;  margin-top: 0px; font-size: 18px; "><?= strtoupper($app_name) ?></h3>
                        </div>
                        <div class="col-md-5">
                            <span style="text-align: right ; margin-top: 0px;">

                                <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                                    <h2 style="color: #2A3F54; margin-top: 0px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun ?> <span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                            </span>
                        </div>
                    </div>
                    <hr style="margin: 5px;">
                </div>

                <div class="dashboard_graph" style="padding-top: 10px;">
                    <?php

                    if (empty($_GET['p'])) {
                        $_GET['p'] = "assy";
                    } else {
                        include "content.php";
                    }
                    ?>

                    <div class="separator" style="padding-bottom: 50px;"></div>

                </div>
            </div>
            <!-- /page content -->

            <?php include('../../../../../../_footer.php'); ?>