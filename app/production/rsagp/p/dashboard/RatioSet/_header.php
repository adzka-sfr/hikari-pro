<?php
require '_config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yamaha Indonesia</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Search in option -->
  <link href="<?= base_url('source/select2.min.css') ?>" rel="stylesheet" />
  <script src="<?= base_url('source/jquery-3.4.1.js') ?>"></script>
  <script src="<?= base_url('source/select2.min.js') ?>"></script>

  <link rel="icon" href="<?= base_url('_assets/production/images/logo_icon.png') ?>">
  <link href="<?= base_url('_bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_assets/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_assets/vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_assets/vendors/iCheck/skins/flat/green.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_assets/vendors/jqvmap/dist/jqvmap.min.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('_assets/vendors/bootstrap-daterangepicker/daterangepicker.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_assets/build/css/custom.min.css') ?>" rel="stylesheet">
  <!--  -->
  <script type="text/javascript">
    function tampilkanwaktu() { //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
      var waktu = new Date(); //membuat object date berdasarkan waktu saat
      var sh = waktu.getHours() + ""; //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
      var sm = waktu.getMinutes() + ""; //memunculkan nilai detik
      var ss = waktu.getSeconds() + ""; //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
      document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
    }
  </script>

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title" style="padding-left: 15px;"><img src="<?= base_url('_assets/production/images/emblem.png') ?>" alt="logo" style="width: 40px;"> <span><img src="<?= base_url('_assets/production/images/original-text.png') ?>" alt="piano" style="width: 110px;"></span></a>
          </div>
          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?= base_url('_assets/production/images/profile2.png') ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php echo $_SESSION["jabatan"] . " " . $_SESSION['dept']  ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />