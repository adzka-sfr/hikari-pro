<?php include('../_header.php'); ?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
  <title>Yamaha Indonesia</title>

  <!-- <div class="container body"> -->
  <!-- <div class="main_container"> -->
  <!-- top navigation -->
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
          <h3>Previlege <small style="font-size: 15px;">Apps</small></h3>
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
              $q_app_pre = mysqli_query($connect, "SELECT * from t_previlege WHERE c_id = '$_SESSION[id]' ORDER BY c_name");
              $prev = 10;
              while ($d_app_pre = mysqli_fetch_array($q_app_pre)) {

                $d_dir_pre = $d_app_pre['c_dir'];
                $d_name_pre = $d_app_pre['c_name'];
                $d_img_pre = $d_app_pre['c_img'];
            ?>
                <a href="<?= base_url('app/' . $d_dir_pre) ?>">
                  <li class="zoom" onmouseover="mouseOver<?= $prev ?>()" onmouseout="mouseOut<?= $prev ?>()">
                    <span class="glyphicon " aria-hidden="true"><img src="<?= base_url('_assets/production/icons/projects/' . $d_img_pre . '.png') ?>" id="prev<?= $prev ?>" alt="<?= $d_name_pre ?>" height="50" width="50"></span>
                    <span class="glyphicon-class"><?= $d_name_pre ?></span>
                  </li>
                  <script type="text/javascript">
                    function mouseOver<?= $prev ?>() {
                      document.getElementById("prev<?= $prev ?>").src = "<?= base_url('_assets/production/icons/projects/' . $d_img_pre . '_w.png') ?>";
                    }

                    function mouseOut<?= $prev ?>() {
                      document.getElementById("prev<?= $prev ?>").src = "<?= base_url('_assets/production/icons/projects/' . $d_img_pre . '.png') ?>"
                    }
                  </script>
                </a>

              <?php
                $prev++;
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



    <div class="dashboard_graph" style="background-color: #F7F7F7; margin-bottom: 50px;">
      <div class="row x_title">
        <div class="col-md-12">
          <h3>Production <small style="font-size: 15px;">Apps</small></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5 style="padding-left: 20px;"><u>Production Progress Info</u></h5>
        </div>
      </div>
      <div class="row">
        <div class="bs-glyphicons ">
          <ul class="bs-glyphicons-list ">
            <!-- isi konten aplikasinya -->
            <?php
            $q_app_p = mysqli_query($connect, "SELECT * from t_app WHERE c_group = 'production' AND c_subgroup = 'sub1' ORDER BY c_name");
            $sub1 = 500;
            while ($d_app_p = mysqli_fetch_array($q_app_p)) {
              $d_dir_p = $d_app_p['c_dir'];
              $d_name_p = $d_app_p['c_name'];
              $d_img_p = $d_app_p['c_img'];
            ?>

              <a target="_blank" rel="noopener noreferrer" href="<?= base_url('app/production/' . $d_dir_p) ?>">
                <li class="zoom" onmouseover="mouseOver<?= $sub1 ?>()" onmouseout="mouseOut<?= $sub1 ?>()">
                  <span class="glyphicon " aria-hidden="true"><img src="<?= base_url('_assets/production/icons/projects/' . $d_img_p . '.png') ?>" id="sub1<?= $sub1 ?>" alt="<?= $d_name_p ?>" height="50" width="50"></span>
                  <span class="glyphicon-class"><?= $d_name_p ?></span>
                </li>
                <script type="text/javascript">
                  function mouseOver<?= $sub1 ?>() {
                    document.getElementById("sub1<?= $sub1 ?>").src = "<?= base_url('_assets/production/icons/projects/' . $d_img_p . '_w.png') ?>";
                  }

                  function mouseOut<?= $sub1 ?>() {
                    document.getElementById("sub1<?= $sub1 ?>").src = "<?= base_url('_assets/production/icons/projects/' . $d_img_p . '.png') ?>"
                  }
                </script>
              </a>

            <?php
              $sub1++;
            }
            ?>

            <!-- isi konten aplikasinya -->
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5 style="padding-left: 20px;"><u>Finish Good Delivery Info</u></h5>
        </div>
      </div>
      <div class="row">
        <div class="bs-glyphicons ">
          <ul class="bs-glyphicons-list ">
            <!-- isi konten aplikasinya -->
            <?php
            $q_app_p = mysqli_query($connect, "SELECT * from t_app WHERE c_group = 'production' AND c_subgroup = 'sub2' ORDER BY c_name");
            $sub2 = 800;
            while ($d_app_p = mysqli_fetch_array($q_app_p)) {
              $d_dir_p = $d_app_p['c_dir'];
              $d_name_p = $d_app_p['c_name'];
              $d_img_p = $d_app_p['c_img'];
            ?>

              <a target="_blank" rel="noopener noreferrer" href="<?= base_url('app/production/' . $d_dir_p) ?>">
                <li class="zoom" onmouseover="mouseOver<?= $sub2 ?>()" onmouseout="mouseOut<?= $sub2 ?>()">
                  <span class="glyphicon " aria-hidden="true"><img src="<?= base_url('_assets/production/icons/projects/' . $d_img_p . '.png') ?>" id="sub2<?= $sub2 ?>" alt="<?= $d_name_p ?>" height="50" width="50"></span>
                  <span class="glyphicon-class"><?= $d_name_p ?></span>
                </li>
                <script type="text/javascript">
                  function mouseOver<?= $sub2 ?>() {
                    document.getElementById("sub2<?= $sub2 ?>").src = "<?= base_url('_assets/production/icons/projects/' . $d_img_p . '_w.png') ?>";
                  }

                  function mouseOut<?= $sub2 ?>() {
                    document.getElementById("sub2<?= $sub2 ?>").src = "<?= base_url('_assets/production/icons/projects/' . $d_img_p . '.png') ?>"
                  }
                </script>
              </a>

            <?php
              $sub2++;
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