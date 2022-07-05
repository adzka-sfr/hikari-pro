<?php
require_once "_config/koneksi.php";
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('_assets/production/images/logo_icon.png') ?>">
    <title>
        YI | Rasio Set Assy GP
    </title>
    <style>
        body {
            background-image: url("<?= base_url('_assets/production/images/yamaha_purple.png') ?>");
            background-repeat: no-repeat;
            background-position: center top;
        }

        .buttonchooice {
            display: block;
            text-align: center;
            transform: translateY(1000%);
        }
    </style>
    <!-- Bootstrap -->
    <link href="<?= base_url('_assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="buttonchooice">
        <a href="auth" type="button" style="min-width: 100px" class="btn btn-primary">Login</a>
        <a href="prioritas" type="button" style="min-width: 100px" class="btn btn-success">Prioritas</a>
    </div>
</body>

</html>