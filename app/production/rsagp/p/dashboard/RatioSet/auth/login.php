<?php
require_once "../_config/koneksi.php";
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
        <!-- <link rel="icon" href="../_assets/production/images/logo_icon.png"> -->

        <title>
            YI | Rasio Set Assy GP
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
                        <form method="POST" class="navbar-form">
                            <h1>Rasio Set Assy GP</h1>
                            <div>
                                <input type="text" id="id" name="id" class="form-control" placeholder="Employee id" required autofocus />
                            </div>
                            <div>
                                <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required />
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit" name="login">Log in</button>
                            </div>
                        </form>

                        <div class="clearfix"></div>
                        <div class="separator"></div>
                        <a href="../prioritas"><button class="btn btn-success">Priority</button></a>
                        <div>
                            <h1>
                                <!-- <object data="images/yamaha_purple.svg" width="400" height="400" style="padding-top: 0px;"></object> -->
                                <img src="<?= base_url('_assets/production/images/yamaha_purple_left.png') ?>" alt="logo-yamaha" style="width: 130px;">
                            </h1>
                            <p>©2022 All Rights Reserved. Yamaha Indonesia . Privacy and Terms</p>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
}
?>