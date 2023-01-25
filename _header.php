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

  <!-- untuk mematikan tombol back -->
  <script type="text/javascript">
    // function preventBack() {
    //   window.history.forward();
    // }
    // setTimeout("preventBack()", 0);
    // window.onunload = function() {
    //   null
    // };
  </script>
  <!-- untuk mematikan tombol back -->

  <!-- <title>Yamaha Indonesia</title> -->

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

  <!-- untuk datatables -->
  <link href="<?= base_url('_assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('_assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') ?>" rel="stylesheet">

  <!-- <link rel="stylesheet" type="text/css" href="_assets/src/add/datatables_bootstrap5/datatables.css">
  <script type="text/javascript" charset="utf8" src="_assets/src/add/datatables_bootstrap5/datatables.js"></script> -->

  <!-- Custom Theme Style -->
  <link href="<?= base_url('_assets/build/css/custom.min.css') ?>" rel="stylesheet">

  <!-- TAMBAHAN lib -->

  <!-- untuk field berdasarkan dropdown -->
  <script src="<?= base_url('_assets/src/add/field_by_radio/jquery.min.js') ?>"></script>
  <script src="<?= base_url('_assets/src/add/qrcode/qrcode.js') ?>"></script>

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
  </style>
  <!-- style untuk koordinat -->

  <!-- style untuk bar step (progress bar) -->
  <style>
    .bar-step {
      position: absolute;
      margin-top: -10px;
      z-index: 1;
      font-size: 12px;
      margin-left: -3%;
      padding-left: 20px;
    }

    .label-txt {
      float: left;

    }

    .label-line {
      float: left;
      background: #000;
      height: 26px;
      width: 2px;
      margin-left: 0px;
    }

    .label-percent {
      float: right;
      margin-left: 2px;
      margin-top: -3px;
    }
  </style>
  <!-- style untuk bar step (progress bar) -->

  <!-- untuk teks blink -->
  <style>
    blink {
      -webkit-animation: 0.5s linear infinite kedip;
      /* for Safari 4.0 - 8.0 */
      animation: 0.5s linear infinite kedip;
    }

    /* for Safari 4.0 - 8.0 */
    @-webkit-keyframes kedip {
      0% {
        visibility: hidden;
      }

      50% {
        visibility: hidden;
      }

      100% {
        visibility: visible;
      }
    }

    @keyframes kedip {
      0% {
        visibility: hidden;
      }

      50% {
        visibility: hidden;
      }

      100% {
        visibility: visible;
      }
    }
  </style>
  <!-- untuk teks blink -->

  <!-- untuk z-index select2 (monanges nyari ni masalah) -->
  <style>
    .select2-dropdown {
      z-index: 9099;
    }

    .select2-drop-active {
      margin-top: -25px;
    }
  </style>
  <!-- untuk z-index select2 (monanges nyari ni masalah) -->

  <!-- untuk loader halaman -->
  <style>
    .loading {
      position: fixed;
      display: block;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      text-align: center;
      opacity: 0.7;
      background-color: #fff;
      z-index: 99;
    }

    .loading-image {
      position: absolute;
      top: 50%;
      left: 50%;
      z-index: 100;
    }

    .lds-hourglass {
      display: inline-block;
      position: relative;
      width: 10px;
      height: 10px;
    }

    .lds-hourglass:after {
      content: " ";
      display: block;
      border-radius: 50%;
      width: 0;
      height: 0;
      margin: 8px;
      box-sizing: border-box;
      border: 32px solid #dfc;
      border-color: #dfc transparent #dfc transparent;
      animation: lds-hourglass 2.2s infinite;
    }

    @keyframes lds-hourglass {
      0% {
        transform: rotate(0);
        animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
      }

      50% {
        transform: rotate(900deg);
        animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
      }

      100% {
        transform: rotate(1800deg);
      }
    }
  </style>
  <!-- untuk loader halaman -->

  <!-- untuk font rebel -->
  <style>
    @font-face {
      font-family: "retro";
      src: url("<?= base_url('_assets/src/add/font_tambahan/retro.ttf') ?>");
    }

    .retro {
      font-family: "retro";
    }
  </style>
  <!-- untuk font rebel -->


  <!-- Tambahan -->



</head>