<?php include('../../../../../_header.php');
include('../app_name.php');
include('koneksi.php');
?>


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
                <li class="active"><a><i class="fa fa-desktop"></i> Dashboard</a>
                </li>
              </ul>
            </div>

            <div class="menu_section">
              <h3>Employee</h3>
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
          <hr style="margin: 5px;">
        </div>

        <div class="dashboard_graph" style="padding-top: 10px;">
          <div class="row">
            <div class="col-12">
              <h3>Input Slip Number</h3>
              <div class="separator"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4 col-sm-4  form-group has-feedback">
                  <input type="text" class="form-control has-feedback-left" placeholder="Slip Number" autofocus>
                  <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- isi hasil scan slip number -->
        <div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

          <div class="row">
            <div class="col-12">
              <?php
              $sql = mysqli_query($connect_p, "SELECT * from piano limit 1");
              $data = mysqli_fetch_array($sql);
              ?>
              <h3><?= $data['no_slip'] ?> - <?= $data['piano_name'] ?> <?= $data['warna'] ?></h3>
              <div class="separator"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <!-- isi gambar -->

              <!-- gambar 1 -->
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-12">
                      <h2><u>Topboard Outside</u></h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12" style="padding-bottom: 5%;">
                      <!-- gambar -->
                      <center>
                        <div class="containere">
                          <img src="image/topboard_outside.jpg" style="width:100%">
                          <button class="bton" style="top: 14%; left: 10%; background-color: #B92C3A;">NG</button>
                          <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                          <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">OK</button>
                        </div>
                      </center>
                    </div>
                  </div>
                </div>
              </div>

              <div class="separator"></div>

              <!-- gambar 2 -->
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-12">
                      <h2><u>Topboard Inside</u></h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12" style="padding-bottom: 5%;">
                      <!-- gambar -->
                      <center>
                        <div class="containere">
                          <img src="image/topboard_inside.jpg" style="width:100%">
                          <button class="bton" style="top: 14%; left: 10%; background-color: #B92C3A;">NG</button>
                          <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                          <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">OK</button>
                        </div>
                      </center>
                    </div>
                  </div>
                </div>
              </div>

              <div class="separator"></div>

              <!-- gambar 3 -->
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-12">
                      <h2><u>Body</u></h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12" style="padding-bottom: 5%;">
                      <!-- gambar -->
                      <center>
                        <div class="containere">
                          <img src="image/body.jpg" style="width:100%">
                          <button class="bton" style="top: 14%; left: 10%; background-color: #B92C3A;">NG</button>
                          <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                          <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">OK</button>
                        </div>
                      </center>
                    </div>
                  </div>
                </div>
              </div>

              <div class="separator"></div>

              <!-- gambar 4 -->
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-12">
                      <h2><u>Body Back</u></h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12" style="padding-bottom: 5%;">
                      <!-- gambar -->
                      <center>
                        <div class="containere">
                          <img src="image/body_back.jpg" style="width:100%">
                          <button class="bton" style="top: 14%; left: 10%; background-color: #B92C3A;">NG</button>
                          <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                          <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">OK</button>
                        </div>
                      </center>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-md-6">
              <!-- table -->
              <div class="row">
                <div class="col-md-12">
                  <!-- tabel dengan judul -->
                  <div class="row">
                    <div class="col-md-12">
                      <!-- judul -->
                      <h2>
                        <u>Summary</u>
                      </h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Component</th>
                            <th>Part</th>
                            <th>Note</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql2 = mysqli_query($connect_p, "SELECT * from on_progress");
                          while ($data2 = mysqli_fetch_array($sql2)) {
                          ?>
                            <tr>
                              <td><?= $data2['komponen'] ?></td>
                              <td><?= $data2['bagian'] ?></td>
                              <td><?= $data2['note'] ?></td>
                              <td><?= $data2['status'] ?></td>
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- isi hasil scan slip number -->

      </div>
      <!-- /page content -->

      <?php include('../../../../_footer.php'); ?>