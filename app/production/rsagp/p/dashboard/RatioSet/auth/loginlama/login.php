<?php
require_once "../_config/koneksi.php";
if (isset($_SESSION['status'])) {
  echo "<script>window.location='" . base_url() . "';</script>";
} else {
?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('_assets/production/images/logo_icon.png') ?>">
    <!-- <link rel="icon" href="../_assets/production/images/logo_icon.png"> -->

    <title>
      Yamaha Indonesia
    </title>

    <!-- Bootstrap -->
    <link href="<?= base_url('_assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('_assets/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('_assets/vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('_assets/vendors/animate.css/animate.min.css') ?>" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="<?= base_url('_assets/build/css/custom.min.css') ?>" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>


      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form>
              <h1>Login Form</h1>
              <div>
                <input type="text" id="id" name="name" class="form-control" placeholder="Employee id" />
              </div>
              <div>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" />
              </div>
              <div>
                <button class="btn btn-default" type="button" id="login" name="login">Log in</button>
              </div>
              <div class="clearfix"></div>
              <div class="separator">
                <div>
                  <h1>
                    <!-- <object data="images/yamaha_purple.svg" width="400" height="400" style="padding-top: 0px;"></object> -->
                    <img src="<?= base_url('_assets/production/images/yamaha_purple_left.png') ?>" alt="logo-yamaha" style="width: 130px;">
                  </h1>
                  <p>©2022 All Rights Reserved. Yamaha Indonesia . Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>


    <!-- login and sweetalert -->
    <script src="<?= base_url('_assets/src/add/jquery.min.js') ?>"></script>
    <script src="<?= base_url('_assets/src/add/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('_assets/src/add/sweetalert2.all.min.js') ?>"></script>

    <?php
    if (!empty($_SESSION['gagal'])) {
    ?>
      <script type='text/javascript'>
        $(document).ready(function() {
          Swal.fire({
            type: 'error',
            title: 'WARNING',
            text: 'Login required',
            footer: '',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.value) {
              <?php session_destroy(); ?>
              window.location = 'login.php'
            }
          });

        });
      </script>
    <?php
    }
    ?>

    <!-- login action -->
    <script>
      $(document).ready(function() {

        $("#login").click(function() {

          var id = $("#id").val();
          var pass = $("#pass").val();

          if (id.length == "") {

            Swal.fire({
              type: 'warning',
              title: 'Oops...',
              text: 'Please enter your employee id!'
            });

          } else if (pass.length == "") {

            Swal.fire({
              type: 'warning',
              title: 'Oops...',
              text: 'Please enter your password!'
            });

          } else {

            $.ajax({

              url: "act_login.php",
              type: "POST",
              data: {
                "id": id,
                "pass": pass
              },

              success: function(response) {

                if (response == "success") {

                  Swal.fire({
                      type: 'success',
                      title: 'Login Succsess!',
                      text: 'Wait a second',
                      timer: 1500,
                      showCancelButton: false,
                      showConfirmButton: false
                    })
                    .then(function() {
                      window.location.href = "<?= base_url('dashboard') ?>";
                    });

                } else {

                  Swal.fire({
                    type: 'error',
                    title: 'Login Failed!',
                    text: 'Wrong id or password'
                  });

                }

                console.log(response);

              },

              error: function(response) {

                Swal.fire({
                  type: 'error',
                  title: 'Opps!',
                  text: 'server error!'
                });

                console.log(response);

              }

            });

          }

        });

      });
    </script>

  </body>

  </html>

<?php
}
?>