<?php include('../../../_header.php');
include('app_name.php') ;
$id_user = $_SESSION['id'];
?>

<title>Sales & Stuffing Info</title>

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

                <div class="row" style="padding: 0px;">
                    <div class="col-4" style="padding: 0px; text-align: left; padding-left: 50px;">

                        <a href="main.php?page=monthly_arcv"><button class="btn btn-secondary" style="background-color: #AD8467; border-color: #AD8467; width: 140px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Stuffing Archive</button></a>

                    </div>
                    <div class="col-8" style="padding: 0px; text-align: right; padding-right: 50px;">
                        <a href="main.php?page=daily_up"><button class="btn btn-secondary" style="background-color: #7D7CE0; border-color: #7D7CE0; width: 100px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Daily UP</button></a>
                        <a href="main.php?page=daily_gp"><button class="btn btn-secondary" style="background-color: #BC5672; border-color: #BC5672; width: 100px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Daily GP</button></a>
                        <a href="main.php?page=monthly"><button class="btn btn-secondary" style="background-color: #AD8467; border-color: #AD8467; width: 100px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Monthly Report</button></a>
                        <a href="main.php?page=bydestin"><button class="btn btn-secondary" style="background-color: darkgreen; border-color: darkgreen; width: 100px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Destination</button></a>
						 <a href="main.php?page=prog_sales"><button class="btn btn-secondary" style="background-color: darkorange; border-color: darkorange; width: 130px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Sales Progres</button></a>
                    </div>
                </div>

        </div>

        <div class="right_col" role="main">
        <div class="">
          <div id="page-content">
            <?php include "content.php"; ?>
          </div>
        </div>
      </div>

    </div>
    <!-- /page content -->

      <?php include('../../../_footer.php'); ?>