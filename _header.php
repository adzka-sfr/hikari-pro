<?php
require '_config/koneksi.php';

// if (!isset($_SESSION['status'])) {
//   $_SESSION['gagal'] = "gagal";
//   header('Location: auth');
// }
if (!isset($_SESSION['id'])) {
  echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
}
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

  <title>Yamaha Indonesia</title>

  <!-- Bootstrap -->
  <link href="<?= base_url('_assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?= base_url('_assets/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?= base_url('_assets/vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
  <!-- jQuery custom content scroller -->
  <link href="<?= base_url('_assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') ?>" rel="stylesheet" />
  <!-- iCheck -->
  <link href="<?= base_url('_assets/vendors/iCheck/skins/flat/green.css') ?>" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="<?= base_url('_assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') ?>" rel="stylesheet">
  <!-- JQVMap -->
  <link href="<?= base_url('_assets/vendors/jqvmap/dist/jqvmap.min.css') ?>" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="<?= base_url('_assets/vendors/bootstrap-daterangepicker/daterangepicker.css') ?>" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?= base_url('_assets/build/css/custom.min.css') ?>" rel="stylesheet">

  <!-- TAMBAHAN lib -->

  <!-- untuk dropdown search -->
  <link href="<?= base_url('_assets/src/add/dropdown_search/select2.min.css') ?>" rel="stylesheet" />
  <script src="<?= base_url('_assets/src/add/dropdown_search/jquery-3.4.1.js') ?>" crossorigin="anonymous"></script>
  <script src="<?= base_url('_assets/src/add/dropdown_search/select2.min.js') ?>"></script>

  <!-- untuk grafik chart JS -->
  <script src="<?= base_url('_assets/src/add/chartJS/chart.js') ?>"></script>

  <!-- untuk grafik E Chart -->
  <script src="<?= base_url('_assets/src/add/EChart/echarts.js') ?>"></script>



  <!-- TAMBAHAN lib-->

  <!-- Tambahan -->

  <!-- untuk mendapatkan nomor minggu dalam sebulan -->
  <?php
  function weekOfMonth($date)
  {
    //Get the first day of the month.
    $firstOfMonth = strtotime(date("Y-m-01", $date));
    //Apply above formula.
    return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
  }

  function weekOfYear($date)
  {
    $weekOfYear = intval(date("W", $date));
    if (date('n', $date) == "1" && $weekOfYear > 51) {
      // It's the last week of the previos year.
      return 0;
    } else if (date('n', $date) == "12" && $weekOfYear == 1) {
      // It's the first week of the next year.
      return 53;
    } else {
      // It's a "normal" week.
      return $weekOfYear;
    }
  }

  // A few test cases.
  // echo weekOfMonth(strtotime("2022-07-2")) . " ";
  ?>
  <!-- untuk mendapatkan nomor minggu dalam sebulan -->

  <!-- untuk pagination display -->
  <style>
    .pagination {
      display: inline-block;
    }

    .pagination a {
      color: black;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
    }

    .pagination a.active {
      background-color: #2A3F54;
      color: white;
      border-radius: 5px;
    }

    .pagination a:hover:not(.active) {
      background-color: #ddd;
      border-radius: 5px;
    }
  </style>
  <!-- untuk pagination display -->

  <!-- style untuk zoom h-over -->
  <style>
    .zoom {
      transition: transform 1s;
    }

    .zoom:hover {
      transform: scale(1.2);
      cursor: pointer;
    }
  </style>
  <!-- style untuk zoom h-over -->

  <!-- script untuk jam  -->
  <script type="text/javascript">
    function tampilkanwaktu() { //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
      var waktu = new Date(); //membuat object date berdasarkan waktu saat
      var sh = waktu.getHours() + ""; //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
      var sm = waktu.getMinutes() + ""; //memunculkan nilai detik
      var ss = waktu.getSeconds() + ""; //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
      document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
    }
  </script>
  <?php
  $hari =  date('D');
  $tanggal = date('d');
  $bulan = date('M');
  $tahun = date('Y');
  ?>
  <!-- script untuk jam  -->

  <!-- untuk garis vertical -->
  <style>
    .vl {
      border-right: 2px solid #E9ECEF;
      height: 100%;
    }
  </style>
  <!-- untuk garis vertical -->

  <!-- untuk table fix header v2 -->
  <style type="text/css">
    .tableFixHead-2 {
      overflow: auto;
      max-height: 200px;
    }

    .tableFixHead-2 thead th {
      position: sticky;
      top: 0;
      z-index: 0;
      background-color: #fff;
    }

    .tableFixHead-2 tfoot th {
      position: sticky;
      bottom: 0;
      z-index: 0;
      background-color: #fff;
    }

    .tableFixHead-3 {
      overflow: auto;
      max-height: 300px;
    }

    .tableFixHead-3 thead th {
      position: sticky;
      top: 0;
      z-index: 0;
      background-color: #fff;
    }

    .tableFixHead-4 {
      overflow: auto;
      max-height: 400px;
    }

    .tableFixHead-4 thead th {
      position: sticky;
      top: 0;
      z-index: 0;
      background-color: #fff;
    }
  </style>
  <!-- untuk table fix header v2 -->

  <!-- style untuk koordinat -->
  <style>
    /* Container diperlukan untuk memosisikan tombol. Sesuaikan lebarnya sesuai dengan kebutuhan*/
    .containere {
      position: relative;
      width: 100%;
      max-width: 400px;
    }

    /* Buat gambar menjadi responsif */
    .containere img {
      width: 100%;
      height: auto;
    }

    /* Style tombol dan letakkan di tengah container / gambar */
    .containere .bton {
      position: absolute;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      background-color: #0000FF;
      color: white;
      font-size: 12px;
      /* padding: 12px 24px; */
      border: none;
      cursor: pointer;
      border-radius: 5px;
      text-align: center;
    }

    .container .btn:hover {
      background-color: black;
    }
  </style>
  <!-- style untuk koordinat -->

  <!-- Tambahan -->
</head>