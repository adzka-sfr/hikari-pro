<?php include('../../../../_header.php'); ?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
  <!-- <div class="container body"> -->
  <!-- <div class="main_container"> -->
  <!-- top navigation -->
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
  <!-- /top navigation -->

  <!-- page content -->
  <div class="right_col" role="main">

    <div class="dashboard_graph" style="background-color: #F7F7F7;">
      <div class="row">
        <div class="col-md-9">
          <h3 style="font-weight: bold; padding-left: 10px;">COMPATIBILITY MODEL - STRINGING UP |<u><span style="color: #0DA90D;">21 Unit</span></u>|</h3>
        </div>
        <div class="col-md-3">
          <span style="text-align: right ;">

            <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
              <h2 style="color: #2A3F54; padding-right: 10px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun . " " ?><span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
          </span>
        </div>
        <hr>
      </div>
    </div>



    <div class="dashboard_graph" style="background-color: #F7F7F7;">
      <div class="row x_title">
        <div class="col-md-12">
          <h3>Production <small>App</small></h3>
        </div>
      </div>
      <div class="row">
        <div class="bs-glyphicons ">
          <ul class="bs-glyphicons-list ">
            <!-- isi konten aplikasinya -->
            <?php
            $q_app_p = mysqli_query($connect, "SELECT * from t_app WHERE c_group = 'production' ORDER BY c_name");
            while ($d_app_p = mysqli_fetch_array($q_app_p)) {
              $d_dir_p = $d_app_p['c_dir'];
              $d_name_p = $d_app_p['c_name'];
            ?>

              <a href="<?= base_url('app/production/' . $d_dir_p) ?>">
                <li class="zoom">
                  <span class="glyphicon " aria-hidden="true"><img src="<?= base_url('_assets/production/icons/projects/' . $d_dir_p . '.png') ?>" alt="<?= $d_name_p ?>" height="50" width="50"></span>
                  <span class="glyphicon-class"><?= $d_name_p ?></span>
                </li>
              </a>

            <?php
            }
            ?>

            <!-- isi konten aplikasinya -->
          </ul>
        </div>
      </div>
    </div>

  </div>
  <!-- /page content -->

  <?php include('../../../../_footer.php'); ?>