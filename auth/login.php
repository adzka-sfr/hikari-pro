<?php
require_once "../_config/koneksi.php";
// create session untuk dashboard
$_SESSION['antrian'] = "1";

if (isset($_SESSION['id'])) {
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
                            <h1><img src="<?= base_url('_assets/production/images/hikari_purple.png') ?>" alt="logo_hikari" height="30"></h1>
                            <div>
                                <input type="text" id="id" name="id" class="form-control" placeholder="Employee id" />
                            </div>
                            <div>
                                <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" />
                            </div>
                            <div>
                                <button class="btn btn-secondary" style="background-color: #F7F7F7; color: #73879C; border-color: #4B1E78;" type="button" id="login" name="login">Log in</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                                <p class="change_link">New to site?
                                    <a href="../board/"> Go to dashboard </a>

                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <h1>
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
    </body>
    <!-- login and sweetalert -->
    <script src="../_assets/src/add/jquery.min.js"></script>
    <script src="../_assets/src/add/bootstrap.min.js"></script>
    <script src="../_assets/src/add/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#id').focus();
            $('#id').keypress(function(e) {
                if (e.which == 13) {
                    $('#pass').focus();
                }
            });
            $('#pass').keypress(function(e) {
                if (e.which == 13) {
                    $('#login').click();
                }
            });
            $('#login').click(function() {
                var id = $('#id').val();
                var pass = $('#pass').val();
                if (id == '') {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Employee id can not be empty!',
                        type: 'error',
                        confirmButtonText: 'OK'
                    });
                    $('#id').focus();
                } else if (pass == '') {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Password can not be empty!',
                        type: 'error',
                        confirmButtonText: 'OK'
                    });
                    $('#pass').focus();
                } else {
                    $.ajax({
                        url: 'authen.php',
                        type: 'POST',
                        data: {
                            "id": id,
                            "pass": pass
                        },
                        success: function(response) {
                            if (response == 'oke') {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Login success!',
                                    type: 'success',
                                    timer: 1000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                }).then(function() {
                                    window.location = '../index.php';
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Login failed!',
                                    type: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>

    </html>
<?php
}
?>