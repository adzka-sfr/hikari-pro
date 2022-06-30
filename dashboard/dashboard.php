<?php include('../_header.php'); ?>

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

    <div class="dashboard_graph" style="padding-bottom: 0px; padding-left: 0px; padding-right: 0px; margin-left: 0px; background-color: #F7F7F7;">
      <div class="col-md-12">
        <span style="text-align: right ; margin-top: 0px;">

          <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
            <h2 style="color: #2A3F54; margin-top: 0px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun ?> <span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
        </span>
        <hr style="margin: 0px;">
      </div>
    </div>

    <div class="dashboard_graph" style="background-color: #F7F7F7;">
      <div class="row x_title">
        <div class="col-md-12">
          <h3>Previlege <small>App</small></h3>
        </div>
      </div>
      <div class="row">
        <div class="bs-glyphicons ">
          <ul class="bs-glyphicons-list ">
            <!-- isi konten aplikasinya -->
            <?php
            // cek previlege user
            $q_app_pc = mysqli_query($connect, "SELECT * from t_previlege WHERE c_id = '$_SESSION[id]'");
            $r_app_pc = mysqli_fetch_row($q_app_pc);

            if (!empty($r_app_pc)) {
              // ambil semua data previlege
              $q_app_p = mysqli_query($connect, "SELECT * from t_previlege WHERE c_id = '$_SESSION[id]' ORDER BY c_name");
              while ($d_app_p = mysqli_fetch_array($q_app_p)) {
                $d_dir_p = $d_app_p['c_dir'];
                $d_name_p = $d_app_p['c_name'];
                $d_img_p = $d_app_p['c_img'];
            ?>
                <a href="<?= base_url('app/' . $d_dir_p) ?>">
                  <li class="zoom">
                    <span class="glyphicon " aria-hidden="true"><img src="<?= base_url('_assets/production/icons/projects/' . $d_img_p . '.png') ?>" alt="<?= $d_name_p ?>" height="50" width="50"></span>
                    <span class="glyphicon-class"><?= $d_name_p ?></span>
                  </li>
                </a>

              <?php
              }
            } else {
              // jika tidak ada previlege
              ?>
              <div class="row">
                <div class="col-md-12" style="text-align: center;">
                  <span>
                    <strong>Oops!</strong> You don't have any previlege yet.
                  </span>
                </div>
              </div>
            <?php
            }
            ?>
            <!-- isi konten aplikasinya -->
          </ul>
        </div>
      </div>
    </div>

    <div class="dashboard_graph" style="background-color: #F7F7F7;">
      <div class="row x_title">
        <div class="col-md-12">
          <h3>Managerial <small>App</small></h3>
        </div>
      </div>
      <div class="row">
        <div class="bs-glyphicons ">
          <ul class="bs-glyphicons-list ">
            <!-- isi konten aplikasinya -->
            <?php
            $q_app_m = mysqli_query($connect, "SELECT * from t_app WHERE c_group = 'managerial' ORDER BY c_dir");
            while ($d_app_m = mysqli_fetch_array($q_app_m)) {
              $d_dir_m = $d_app_m['c_dir'];
              $d_name_m = $d_app_m['c_name'];
            ?>

              <a href="<?= base_url('app/managerial/' . $d_dir_m) ?>">
                <li class="zoom">
                  <span class="glyphicon " aria-hidden="true"><img src="<?= base_url('_assets/production/icons/projects/' . $d_dir_m . '.png') ?>" alt="<?= $d_name_m ?>" height="50" width="50"></span>
                  <span class="glyphicon-class"><?= $d_name_m ?></span>
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

  <?php include('../_footer.php'); ?>