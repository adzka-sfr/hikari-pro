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
              <h3>Input Slip Number</h3>
              <div class="separator"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-10">
              <div class="row">
                <div class="col-md-4 col-sm-4  form-group has-feedback">
                  <form method="POST">
                    <input type="text" name="slip_number" class="form-control has-feedback-left" placeholder="Input Slip" autofocus>
                  </form>
                  <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>
            </div>
            <div class="col-md-2" style="text-align: right;">
              <div class="row">
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                  <form method="POST">
                    <button class="btn btn-danger" type="submit" name="reset">Clear</button>
                  </form>
                  <?php
                  if (isset($_POST['reset'])) {
                    unset($_SESSION['no_slip']);
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
        // create session
        if (isset($_POST['slip_number'])) {
          $_SESSION['no_slip'] = $_POST['slip_number'];
        }
        ?>


        <!-- isi hasil scan slip number -->
        <?php
        // selama session masih kosong include no form
        if (empty($_SESSION['no_slip'])) {
          include('noform.php');
        } else {
          // cek apakah slip terdaftar atau tidak
          $sql1 = mysqli_query($connect_p, "SELECT c_no_slip from on_progress where c_no_slip = '$_SESSION[no_slip]'");
          $data1 = mysqli_fetch_row($sql1);

          if ($data1 == 0) {
            // jika tidak ada data muncul alert dan unset session
            unset($_SESSION['no_slip']);
        ?>
            <script>
              $(document).ready(function() {
                Swal.fire({
                  title: 'Data Not Found',
                  text: 'Slip number unregistered!',
                  type: 'warning',
                  confirmButtonText: 'OK'
                }).then(function() {
                  window.location = 'index.php';
                });
              });
            </script>
        <?php
          } else {
            $sql2 = mysqli_query($connect_p, "SELECT distinct op.c_piano as c_piano, gp.c_jenis as c_jenis from on_progress op join group_piano gp on op.c_piano = gp.c_piano where op.c_no_slip = '$_SESSION[no_slip]'");
            $data2 = mysqli_fetch_array($sql2);
            if ($data2['c_jenis'] == "J1") {
              include('form1.php');
            } elseif ($data2['c_jenis'] == "J2") {
              include('form2.php');
            }
          }
        }


        ?>
        <!-- isi hasil scan slip number -->

        <!-- PERCOBAAN -->

        <!-- TAKE A PICTURE -->
        <div class="dashboard_graph" style="padding-top: 10px; margin-top: 10px;">
          <div class="row">
            <div class="col-12">

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Take Picture
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <center>
                        <!-- CAMERA AND PICTURE -->

                        <div id="results" style="margin-bottom: 10px;">Your captured image will appear here...</div>
                        <div id="my_camera" style="margin-bottom: 10px;"></div>

                        <!-- CAMERA AND PICTURE -->

                        <!-- BUTTON ACTION -->
                        <form>

                          <!-- BEFORE CAPTURE -->
                          <div id="pre_take_buttons">
                            <input type="button" class="btn btn-success" value="Access Camera" onClick="setup(); $(this).hide().next().show();">
                            <input type=button class="btn btn-primary" value="Take Snapshot" onClick="preview_snapshot()" style="display:none">
                          </div>
                          <!-- BEFORE CAPTURE -->

                          <!-- RETAKE -->
                          <div id="take_again" style="display:none">
                            <input type="button" class="btn btn-primary" value="Retake" onClick="take_again()">
                          </div>
                          <!-- RETAKE -->

                          <!-- SAVE PHOTO -->
                          <div id="post_take_buttons" style="display:none">
                            <input type=button class="btn btn-primary" style="width: 100px; text-align: center; margin-right: 30px;" value="Retake" onClick="cancel_preview()">
                            <input type=button class="btn btn-success" style="width: 100px; text-align: center; margin-left: 30px;" value="Save" onClick="save_photo()">
                          </div>
                          <!-- SAVE PHOTO -->

                        </form>
                        <!-- BUTTON FUNCTION -->
                      </center>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- First, include the Webcam.js JavaScript Library -->
              <script type="text/javascript" src="<?= base_url('_assets/src/add/camera_photo/webcam.js') ?>"></script>

              <!-- Configure a few settings and attach camera -->
              <script language="JavaScript">
                Webcam.set({

                  /* 
                  kalau di hp (tested in ip 11 pro) :
                  width: 1280
                  height: 1024

                  kalau di laptop :
                  width: 1280
                  height: 720

                  dest_width: 1280
                  dest_height: 720

                  percobaan:
                  width: 600
                  height: 400
                  dest_width: 600
                  dest_height: 400

                  constraints: {
                    width: {
                      exact: 1024
                    },
                    height: {
                      exact: 720
                    }
                  }

                  */

                  width: 600,
                  height: 400,
                  image_format: 'jpeg',
                  jpeg_quality: 100,
                  dest_width: 600,
                  dest_height: 400,
                });
              </script>

              <!-- Code to handle taking the snapshot and displaying it locally -->
              <script language="JavaScript">
                // first setup
                function setup() {
                  Webcam.reset();
                  Webcam.attach('#my_camera');
                }

                function preview_snapshot() {
                  // freeze camera so user can preview pic
                  Webcam.freeze();

                  // swap button sets
                  document.getElementById('pre_take_buttons').style.display = 'none';
                  document.getElementById('post_take_buttons').style.display = '';
                }

                function cancel_preview() {
                  // cancel preview freeze and return to live camera feed
                  Webcam.unfreeze();

                  // swap buttons back
                  document.getElementById('pre_take_buttons').style.display = '';
                  document.getElementById('post_take_buttons').style.display = 'none';
                }

                function save_photo() {
                  // actually snap photo (from preview freeze) and display it
                  Webcam.snap(function(data_uri) {

                    // display results in page
                    Webcam.upload(data_uri, 'saveimage.php', function(code, text) {
                      document.getElementById('results').innerHTML =
                        '<h2>Here is your image:</h2>' +
                        '<img src="' + text + '"/>';
                    });

                    // swap buttons back
                    Webcam.reset();
                    document.getElementById('pre_take_buttons').style.display = 'none';
                    document.getElementById('post_take_buttons').style.display = 'none';
                    document.getElementById('take_again').style.display = '';
                    document.getElementById('my_camera').style.display = 'none';
                    document.getElementById('results').style.display = '';
                  });
                }

                function take_again() {
                  // swap button back
                  document.getElementById('pre_take_buttons').style.display = '';
                  document.getElementById('post_take_buttons').style.display = 'none';
                  document.getElementById('take_again').style.display = 'none';
                  document.getElementById('results').style.display = 'none';
                  document.getElementById('my_camera').style.display = '';

                  // shutdown camera after capture
                  Webcam.attach('#my_camera');
                }
              </script>

            </div>
          </div>
        </div>

        <!-- FIELD ACTIVE BY RADIO BUTTON -->
        <div class="dashboard_graph" style="padding-top: 10px; margin-top: 10px;">
          <div class="row">
            <div class="col-12">

              <form action="hasil_field.php" method="post">
                <div class="form-check form-check-inline">
                  <input class="form-check-input radionya" type="radio" name="status" id="inlineRadio1" value="OK" required>
                  <label class="form-check-label" for="inlineRadio1">OK</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input radionya other" type="radio" name="status" id="inlineRadio2" value="NG">
                  <label class="form-check-label" for="inlineRadio2">NG</label>
                </div>
                <br>
                <select class="duar" disabled required name="jenis_ng" style="width: 250px; padding-left: 100px;">
                  <option value="" selected disabled>Kind of NG</option>
                  <!-- <option></option> -->
                  <option value="Dekok">Dekok</option>
                  <option value="Muke">Muke</option>
                  <option value="Baret">Baret</option>
                  <option value="Semut">Semut</option>
                  <option value="Nyamuk">Nyamuk</option>
                  <option value="Patah">Patah</option>
                  <option value="Kate">Kate</option>
                </select>
                <button class="btn btn-success" type="submit">Save</button>
              </form>

            </div>
          </div>
        </div>

        <!-- QRCODE  -->
        <div class="dashboard_graph" style="padding-top: 10px; margin-top: 10px;">
          <div class="row">
            <div class="col-12">

              <table class="table table-bordered">
                <thead>
                  <tr style="text-align: center;">
                    <th>Serial Number</th>
                    <th>Piano</th>
                    <th>Komponen NG</th>
                    <th>Note</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  $sql = mysqli_query($connect_p, "SELECT distinct c_no_slip FROM on_progress");
                  while ($data = mysqli_fetch_array($sql)) {
                    $i++;
                    $pass = array();
                    $p = 0;
                    $sql1 = mysqli_query($connect_p, "SELECT * FROM on_progress where c_no_slip = '$data[c_no_slip]'");
                    while ($data1 = mysqli_fetch_array($sql1)) {

                      // untuk mendapatkan komponen dengan status PASS 
                      if ($data1['c_status'] == 'NG') {
                        $pass[$p] = $data1['c_komponen'] . " (" . $data1['c_bagian'] . ")";
                        $piano = $data1['c_piano'];
                        $p++;
                      }
                    }
                  ?>
                    <tr>

                      <td style="text-align: center; width: 16%; transform: translate(0,30%);">
                        <center>
                          <!-- untuk menampilkan qrcode -->
                          <div id="qrcode<?= $i ?>"></div>
                        </center>
                        <b><?= $data['c_no_slip'] ?></b>
                      </td>

                      <td style="text-align:center ; transform: translate(0,40%); width: 28%;"><?= $piano ?></td>
                      <td style="width: 28%;">
                        <?php
                        for ($l = 0; $l < count($pass); $l++) {
                          echo $pass[$l] . "</br>";
                        }
                        ?>
                      </td>
                      <td style="width: 28%;"></td>
                    </tr>

                    <!-- untuk mengenerate qrcode -->
                    <script type="text/javascript">
                      var qrcode = new QRCode(document.getElementById("qrcode<?= $i ?>"), {
                        width: 70,
                        height: 70,
                        // colorDark: "#000000",
                        // colorLight: "#ffffff",
                        // correctLevel: QRCode.CorrectLevel.H
                      });

                      qrcode.makeCode("<?= $data['c_no_slip'] ?>");
                    </script>

                  <?php
                  }
                  ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
        <!-- PERCOBAAN -->

      </div>
      <!-- /page content -->

      <?php include('../../../../../../_footer.php'); ?>