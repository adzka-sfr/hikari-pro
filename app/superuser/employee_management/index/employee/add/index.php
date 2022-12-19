<?php include('../../../../../../_header.php');
include('../../../app_name.php') ?>

<body class="nav-md footer_fixed">
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
                <li><a href="<?= base_url('app/superuser/employee_management/index/index.php') ?>"><i class="fa fa-desktop"></i> Dashboard</a>
                </li>
                <li><a><i class="fa fa-user"></i> Employee <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?= base_url('app/superuser/employee_management/index/employee/add/index.php') ?>">Add Employee</a></li>
                    <li><a href="<?= base_url('app/superuser/employee_management/index/employee/edit/index.php') ?>">Edit Employee</a></li>
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
            <a style="color: inherit;" href="_profile/" data-toggle="tooltip" data-placement="top" title="Profile">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </a>
            <a style="color: inherit;" href="_settings/" data-toggle="tooltip" data-placement="top" title="Settings">
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
          <hr style="margin: 0px;">
        </div>

        <div class="dashboard_graph" style="padding-bottom: 0px; padding-left: 0px; padding-right: 0px; margin-left: 0px; background-color: #F7F7F7;">
          <div class="row">
            <div class="col-md-12" style="margin-bottom: 50px;">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Registration Form</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <!-- start form for validation -->
                  <form id="demo-form" data-parsley-validate>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="fullname">Full Name * :</label>
                        <input type="text" id="name" class="form-control" name="name" required />
                      </div>
                      <div class="col-md-4">
                        <label for="email">ID * :</label>
                        <input type="text" id="id" class="form-control" name="id" required />
                      </div>
                      <div class="col-md-2">
                        <label for="email">Gender * :</label>
                        <br>
                        <span>
                          Male: <input type="radio" class="flat" name="gender" id="genderM" value="Male" />
                          Female: <input type="radio" class="flat" name="gender" id="genderF" value="Female" />
                        </span>
                      </div>
                    </div>

                    <hr>

                    <div class="row">
                      <div class="col-md-6">
                        <label for="fullname">Status * :</label>
                        <select class="form-control">
                          <option>Choose option</option>
                          <option>Option one</option>
                          <option>Option two</option>
                          <option>Option three</option>
                          <option>Option four</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="fullname">Position * :</label>
                        <input type="text" id="name" class="form-control" name="name" required />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="fullname">Division * :</label>
                        <input type="text" id="name" class="form-control" name="name" required />
                      </div>
                      <div class="col-md-6">
                        <label for="fullname">Department * :</label>
                        <input type="text" id="name" class="form-control" name="name" required />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="fullname">Part of * :</label>
                        <input type="text" id="name" class="form-control" name="name" required />
                      </div>
                      <div class="col-md-6">
                        <label for="fullname">Section * :</label>
                        <input type="text" id="name" class="form-control" name="name" required />
                      </div>
                    </div>

                    <hr>

                    <div class="row">
                      <div class="col-md-6">
                        <label for="fullname">Join date * :</label>
                        <input type="date" id="name" class="form-control" name="name" required />
                      </div>
                      <div class="col-md-6">
                        <label for="fullname">Resign date :</label>
                        <input type="date" id="name" class="form-control" name="name" required />
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12" style="text-align: center;">
                        <button class="btn btn-primary">Register</button>
                      </div>
                    </div>


                  </form>
                  <!-- end form for validations -->

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <?php include('../../../../../../_footer.php'); ?>