<?php
include('../../../../../../_header.php');
include('../../app_name.php');
?>


<body class="nav-md footer_fixed" style="background-color: #ffffff;">
    <div class="loading" style="background-color:#263238 ;">
        <div style="margin-top: 200px; margin-right: 70px; color: #dfc; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; " class="lds-hourglass"><span style="padding-left: 19px;">Loading</span></div>
    </div>
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
                    <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 20px; color: #212529;"><?= strtoupper($app_name . " inside") ?></h2>
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

        <div class="dashboard_graph">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-md-4 col-sm-4  form-group has-feedback" style="text-align: center;">
                    <form method="POST">
                        <input type="text" name="acard" class="form-control has-feedback-left" placeholder="A-Card No / Serial No" autofocus>
                        <span class="fa fa-barcode form-control-feedback left"></span>
                    </form>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
        <div class="separator" style="margin-top: 0px;"></div>
        <div class="dashboard_graph">
            <div class="row">
                <?php
                if (isset($_POST['acard'])) {
                    $_SESSION['acard'] = $_POST['acard'];
                }

                if (empty($_SESSION['acard'])) {
                    include 'nothing.php';
                } else {
                    $ptng = substr($_SESSION['cardnumber'], 0, 1);
                    if ($ptng == 'U' or $ptng == 'u') {
                        // cntrol number
                        $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_ctrlnumber = '$_SESSION[acard]'");
                        $data1 = mysqli_fetch_array($sql1);


                        include 'data.php';
                    } elseif ($ptng == 'J' or $ptng == 'j') {
                        // serial number
                    } else {
                ?>
                        <!-- bikin popup disini jika asal scan -->
                <?php
                    }
                }
                ?>
            </div>
        </div>

    </div>
    <!-- /page content -->

    <?php
    include('../../../../../../_footer.php'); ?>