<?php include('../../../../../_header.php');
include('../../app_name.php') ?>

<body class="nav-md footer_fixed">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url('dashboard') ?>" class="site_title" style="padding-left: 15px;"><img src="<?= base_url('_assets/production/images/emblem.png') ?>" alt="logo" style="width: 40px;"> <span><img src="<?= base_url('_assets/production/images/original-text.png') ?>" alt="piano" style="width: 110px;"></span></a>
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
                <li><a href="../"><i class="fa fa-desktop"></i> Dashboard</a>
                </li>
              </ul>
            </div>

            <div class="menu_section">
              <h3>Another Sub Menu</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-gears"></i> Settings <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="#">Setting 1</a></li>
                    <li><a href="#l">Setting 2</a></li>
                  </ul>
                </li>
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a style="color: inherit;" href="<?= base_url('dashboard') ?>" data-toggle="tooltip" data-placement="top" title="Dashboard">
              <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
            </a>
            <a style="color: inherit;" href="../_profile/" data-toggle="tooltip" data-placement="top" title="Profile">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </a>
            <a style="color: inherit;" href="" data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url('auth/act_logout.php') ?>">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
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
                  <a class="dropdown-item" href="../_profile/"> Profile</a>
                  <a class="dropdown-item" href="">Settings</a>
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
          <hr style="margin: 0px;">
        </div>

        <div class="dashboard_graph" style="background-color: #F7F7F7; padding-bottom: 40px;">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h3 style="text-align: center;">Settings</h3>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content" style="text-align: center;">

                  <img style="border-radius: 50%; margin-bottom: 10px;" src="<?= base_url('_assets/production/images/profile.png') ?>" alt="">
                  <br />

                  <?php
                  $sql1 = mysqli_query($connect, "SELECT * from auth where id = '$_SESSION[id]'");
                  $data1 = mysqli_fetch_array($sql1);
                  ?>

                  <div class="item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">ID</label>
                    <div class="col-md-4 col-sm-4 ">
                      <input type="text" class="form-control" value="<?= $data1['id'] ?>" readonly>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Name</label>
                    <div class="col-md-4 col-sm-4 ">
                      <input type="text" class="form-control" value="<?= $data1['nama'] ?>" readonly>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Password</label>
                    <div class="col-md-4 col-sm-4 ">
                      <?php
                      $length_pass = strlen($data1['pass']);

                      function generatestar($len)
                      {
                        $shw = "";
                        for ($j = 0; $j < $len; $j++) {
                          $shw = "*" . $shw;
                        }
                        return $shw;
                      }
                      $show_star = generatestar($length_pass);


                      ?>
                      <input id="middle-name" type="password" class="form-control" value="<?= $show_star ?>" readonly>
                    </div>
                  </div>

                  <div class="ln_solid"></div>
                  <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                      <!-- Button trigger modal -->
                      <a href="change_pass">
                        <button type="button" class="btn btn-primary">
                          Change password
                        </button>
                      </a>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->
      <?php include('../../../../../_footer.php'); ?>