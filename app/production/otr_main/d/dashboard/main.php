<?php
include('../../../../../_header.php');
include('../app_name.php');
include('koneksi.php');
?>


<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a href="<?= base_url('dashboard/') ?>" style="padding-top:15px; padding-left: 30px;"><img src="<?= base_url('_assets/production/images/hikari_purple.png') ?>" alt="logo_yamaha" height="30"></a>
            </div>
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt=""><?php echo $_SESSION['nama'] ?>
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <a style="font-weight: bold;" class="dropdown-item" href="<?= base_url('dashboard/') ?>">Hikari</a>
                            <span style="padding-left: 20px; font-weight: bold;">On Time Rate</span>
                            <a style="padding-left: 30px;" class="dropdown-item" href="main.php?p=assy">Assembly</a>
                            <a style="padding-left: 30px;" class="dropdown-item" href="main.php?p=paint">Painting</a>
                            <a style="padding-left: 30px;" class="dropdown-item" href="main.php?p=ww">Woodworking</a>
                            <a style="font-weight: bold;" class="dropdown-item" href="main.php?p=help">Help</a>
                            <a style="font-weight: bold;" class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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
                    <?php
                    // untuk penamaan berdasarkan halaman apa yang sedang di buka
                    if ($_GET['p'] == 'assy') {
                        $_SESSION['otr_bag'] = 'assy';

                        // link
                        $href_a = '';
                        $href_p = 'href="main.php?p=paint"';
                        $href_w = 'href="main.php?p=ww"';
                        $href_rpw = 'href="main.php?p=rpw"';
                        $href_rug = 'href="main.php?p=rug"';


                        // style
                        $dis_assy = 'disabled';
                        $dis_paint = '';
                        $dis_ww = '';
                        $dis_rpw = '';
                        $dis_rug = '';
                    } elseif ($_GET['p'] == 'paint') {
                        $_SESSION['otr_bag'] = 'painting';

                        // link
                        $href_a = 'href="main.php?p=assy"';
                        $href_p = '';
                        $href_w = 'href="main.php?p=ww"';
                        $href_rpw = 'href="main.php?p=rpw"';
                        $href_rug = 'href="main.php?p=rug"';

                        // style
                        $dis_assy = '';
                        $dis_paint = 'disabled';
                        $dis_ww = '';
                        $dis_rpw = '';
                        $dis_rug = '';
                    } elseif ($_GET['p'] == 'paint1') {
                        $_SESSION['otr_bag'] = 'painting';
                    } elseif ($_GET['p'] == 'ww') {
                        $_SESSION['otr_bag'] = 'woodworking';

                        // link
                        $href_a = 'href="main.php?p=assy"';
                        $href_p = 'href="main.php?p=paint"';
                        $href_w = '';
                        $href_rpw = 'href="main.php?p=rpw"';
                        $href_rug = 'href="main.php?p=rug"';

                        // style
                        $dis_assy = '';
                        $dis_paint = '';
                        $dis_ww = 'disabled';
                        $dis_rpw = '';
                        $dis_rug = '';
                    } elseif ($_GET['p'] == 'rpw') {
                        $_SESSION['otr_bag'] = 'resume painting & woodworking';

                        // link
                        $href_a = 'href="main.php?p=assy"';
                        $href_p = 'href="main.php?p=paint"';
                        $href_w = 'href="main.php?p=ww"';
                        $href_rpw = '';
                        $href_rug = 'href="main.php?p=rug"';

                        // style
                        $dis_assy = '';
                        $dis_paint = '';
                        $dis_ww = '';
                        $dis_rpw = 'disabled';
                        $dis_rug = '';
                    } elseif ($_GET['p'] == 'rug') {
                        $_SESSION['otr_bag'] = 'resume assembly UP & GP';

                        // link
                        $href_a = 'href="main.php?p=assy"';
                        $href_p = 'href="main.php?p=paint"';
                        $href_w = 'href="main.php?p=ww"';
                        $href_rpw = 'href="main.php?p=rpw"';
                        $href_rug = '';

                        // style
                        $dis_assy = '';
                        $dis_paint = '';
                        $dis_ww = '';
                        $dis_rpw = '';
                        $dis_rug = 'disabled';
                    } else {
                        $_SESSION['otr_bag'] = 'help';

                        // link
                        $href_a = 'href="main.php?p=assy"';
                        $href_p = 'href="main.php?p=paint"';
                        $href_w = 'href="main.php?p=ww"';
                        $href_rpw = 'href="main.php?p=rpw"';
                        $href_rug = 'href="main.php?p=rug"';

                        // style
                        $dis_assy = '';
                        $dis_paint = '';
                        $dis_ww = '';
                        $dis_rpw = '';
                        $dis_rug = '';
                    }

                    ?>
                    <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 23px; color: #212529;"><?= strtoupper($app_name . " " . $_SESSION['otr_bag']) ?></h2>
                </div>
                <div class="col-md-3">
                    <span style="text-align: right ; margin-top: 0px;">

                        <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                            <h2 style="color: #2A3F54; padding-right: 10px; margin-top: 0px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun . " " ?><span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                    </span>
                </div>
            </div>
            <hr style="margin: 0px;">
            <?php
            if ($_GET['p'] != 'help') {
            ?>

                <div class="row" style="padding: 0px;">
                    <div class="col-6" style="padding: 0px; text-align: left; padding-left: 50px;">
                        <a <?= $href_a ?>><button class="btn btn-secondary" <?= $dis_assy ?> style="background-color: #7D7CE0; border-color: #7D7CE0; width: 130px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; "> Assembly</button></a>
                        <a <?= $href_p ?>><button class="btn btn-secondary" <?= $dis_paint ?> style="background-color: #BC5672; border-color: #BC5672; width: 130px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Painting</button></a>
                        <a <?= $href_w ?>><button class="btn btn-secondary" <?= $dis_ww ?> style="background-color: #AD8467; border-color: #AD8467; width: 130px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Woodworking</button></a>
                    </div>
                    <div class="col-6" style="padding: 0px; text-align: right; padding-right: 50px;">
                        <a <?= $href_rug ?>><button class="btn btn-secondary" <?= $dis_rug ?> style="background-color: #5470C6; border-color: #5470C6; line-height: 17px; width: 200px; height: 40px; padding-top: 0px; padding-bottom: 2px; padding-left: 0px; padding-right: 0px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Resume (All TR) </br> Assembly UP & GP</button></a>
                        <a <?= $href_rpw ?>><button class="btn btn-secondary" <?= $dis_rpw ?> style="background-color: #5470C6; border-color: #5470C6; line-height: 17px; width: 200px; height: 40px; padding-top: 0px; padding-bottom: 2px; padding-left: 0px; padding-right: 0px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Resume (All TR) </br> Painting & Woodworking</button></a>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>

        <div class="dashboard_graph">
            <script src="js/jquery-3.5.1.js"></script>
            <!-- <div class="row">
                <div class="col-md-12">
                    <form method="POST">
                        <select class="cari_nosearch" style="width: 100%;" name="slip_number" onchange="this.form.submit();">
                            <option value="" selected disabled>Select Slip Number</option>
                            <option value="Up Spray Satin">Up Spray Satin</option>
                            <option value="Up Finish Buff">Up Finish Buff</option>
                        </select>
                    </form>
                </div>
            </div> -->
            <div class="row">
                <div class="col-12">

                    <?php

                    if (empty($_GET['p'])) {
                        $_GET['p'] = "assy";
                    } else {
                        include "content.php";
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
    <!-- /page content -->

    <?php
    include('../../../../../_footer.php'); ?>