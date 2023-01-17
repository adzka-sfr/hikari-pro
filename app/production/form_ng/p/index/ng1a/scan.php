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
              <h3>Scan Serial No <span style="font-size: 10px;">(PIC now : <?= $_SESSION['nama'] ?>)</span></h3>
              <div class="separator"></div>
            </div>
          </div>

          <script src="barcode/jquery.min.js"></script>
          <script src="barcode/html5-qrcode.min.js"></script>
          <div class="row">
            <div class="col-2">
              <a href="index.php"><button class="btn btn-danger">Cancel</button></a>
            </div>
            <div class="col-8">
              <center>
                <div id="reader" style=" max-width: 500px;"></div>
              </center>

              <script>
                // tempat untuk setup library nya
                // setup bisa dilihat di 
                let config = {
                  qrbox: {
                    width: 300,
                    height: 300
                  },
                  rememberLastUsedCamera: true,
                  supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                };
                var html5QrcodeScanner = new Html5QrcodeScanner(
                  // variabel config(setup library) disisipkan
                  "reader", config, false);

                var hasil = 0;

                function onScanSuccess(decodedText, decodedResult) {
                  // Handle on success condition with the decoded text or result.
                  hasil = decodedText;
                  console.log(`Scan result: ${decodedText}`, decodedResult);
                  $.ajax({
                    url: "caa.php",
                    type: "POST",
                    data: {
                      hasil: hasil
                    },
                    cache: false,
                    success: function(datares) {
                      window.location = 'index.php';
                    }
                  });
                  // alert(hasil);

                  // ...
                  html5QrcodeScanner.clear();
                  // ^ this will stop the scanner (video feed) and clear the scan area.
                }

                html5QrcodeScanner.render(onScanSuccess);
              </script>

            </div>
            <div class="col-2" style="text-align: right;">
              <button onclick="window.location.reload()" class="btn btn-primary">Refresh</button>
            </div>
          </div>
        </div>

        <!-- /page content -->

        <?php include('../../../../../../_footer.php'); ?>