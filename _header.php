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

    .containere .chck {
      position: absolute;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      opacity: 15%;
      font-size: 12px;
      border: none;
      cursor: pointer;
      text-align: center;
    }

    .containere .ingpo {
      position: absolute;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      background-color: none;
      opacity: 100%;
      padding: 0px;
      font-size: 8px;
      font-weight: bold;
      border: solid 1px;
      border-color: #DC3545;
      cursor: pointer;
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

    .blink {
      animation: blink 1s linear infinite;
    }

    @keyframes blink {
      0% {
        opacity: 0;
      }

      50% {
        opacity: .5;
      }

      100% {
        opacity: 1;
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

    .block-content {
      position: absolute;
      display: block;
      width: 100%;
      height: 100%;
      text-align: center;
      opacity: 0.7;
      background-color: #fff;
      z-index: 4;
    }

    .loading-image {
      position: absolute;
      top: 50%;
      left: 50%;
      z-index: 100;
    }

    .loading1-image {
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

  <!-- spinner object -->
  <style>
    @keyframes rotation {
      100% {
        transform: rotate(0);
      }

      50% {
        transform: rotate(900deg);
        animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
      }

      0% {
        transform: rotate(1800deg);
        animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
      }
    }
  </style>
  <!-- spinner object -->

  <!-- untuk font rebel -->
  <style>
    @font-face {
      font-family: "retro";
      src: url("<?= base_url('_assets/src/add/font_tambahan/retro.ttf') ?>");
    }

    @font-face {
      font-family: "ahihijam";
      src: url("<?= base_url('_assets/src/add/font_tambahan/digit2.ttf') ?>");
    }

    .retro {
      font-family: "retro";
    }

    .jamdigit {
      font-family: "ahihijam";
    }
  </style>
  <!-- untuk font rebel -->


  <!-- Tambahan -->

  <!-- data tables -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url('_assets/src/add/datatables/jquery.dataTables.css') ?>"> -->

  <!-- <script type="text/javascript" charset="utf8" src="<?= base_url('_assets/src/add/datatables/jquery.dataTables.js') ?>"></script> -->


  <!-- data tables -->

  <!-- device info  -->
  <script>
    var os = [{
        name: 'Windows Phone',
        value: 'Windows Phone',
        version: 'OS'
      },
      {
        name: 'Windows',
        value: 'Win',
        version: 'NT'
      },
      {
        name: 'iPhone',
        value: 'iPhone',
        version: 'OS'
      },
      {
        name: 'iPad',
        value: 'iPad',
        version: 'OS'
      },
      {
        name: 'Kindle',
        value: 'Silk',
        version: 'Silk'
      },
      {
        name: 'Android',
        value: 'Android',
        version: 'Android'
      },
      {
        name: 'PlayBook',
        value: 'PlayBook',
        version: 'OS'
      },
      {
        name: 'BlackBerry',
        value: 'BlackBerry',
        version: '/'
      },
      {
        name: 'Macintosh',
        value: 'Mac',
        version: 'OS X'
      },
      {
        name: 'Linux',
        value: 'Linux',
        version: 'rv'
      },
      {
        name: 'Palm',
        value: 'Palm',
        version: 'PalmOS'
      }
    ];

    var browser = [{
        name: 'Chrome',
        value: 'Chrome',
        version: 'Chrome'
      },
      {
        name: 'Firefox',
        value: 'Firefox',
        version: 'Firefox'
      },
      {
        name: 'Safari',
        value: 'Safari',
        version: 'Version'
      },
      {
        name: 'Internet Explorer',
        value: 'MSIE',
        version: 'MSIE'
      },
      {
        name: 'Opera',
        value: 'Opera',
        version: 'Opera'
      },
      {
        name: 'BlackBerry',
        value: 'CLDC',
        version: 'CLDC'
      },
      {
        name: 'Mozilla',
        value: 'Mozilla',
        version: 'Mozilla'
      }
    ];

    var header = [
      navigator.platform,
      navigator.userAgent,
      navigator.appVersion,
      navigator.vendor,
      window.opera
    ];

    function matchItem(string, data) {
      var i = 0,
        j = 0,
        html = '',
        regex,
        regexv,
        match,
        matches,
        version;

      for (i = 0; i < data.length; i += 1) {
        regex = new RegExp(data[i].value, 'i');
        match = regex.test(string);
        if (match) {
          regexv = new RegExp(data[i].version + '[- /:;]([\d._]+)', 'i');
          matches = string.match(regexv);
          version = '';
          if (matches) {
            if (matches[1]) {
              matches = matches[1];
            }
          }
          if (matches) {
            matches = matches.split(/[._]+/);
            for (j = 0; j < matches.length; j += 1) {
              if (j === 0) {
                version += matches[j] + '.';
              } else {
                version += matches[j];
              }
            }
          } else {
            version = '0';
          }
          return {
            name: data[i].name,
            version: parseFloat(version)
          };
        }
      }
      return {
        name: 'unknown',
        version: 0
      };
    };

    var header = [
      navigator.platform,
      navigator.userAgent,
      navigator.appVersion,
      navigator.vendor,
      window.opera
    ];

    var agent = header.join('');
    var os = this.matchItem(agent, os);
    var browser = this.matchItem(agent, browser);
    // console.log(agent);
    // console.log(os);
    // console.log(browser);

    // create function for device info (Windows, Macintosh, Android)
    function deviceinfo() {
      return os.name;
    }
  </script>
  <!-- device info -->

  <!-- spinner google -->
  <style>
    .spinner {
      -webkit-animation: rotator 1.4s linear infinite;
      animation: rotator 1.4s linear infinite;
    }

    @-webkit-keyframes rotator {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }

      100% {
        -webkit-transform: rotate(270deg);
        transform: rotate(270deg);
      }
    }

    @keyframes rotator {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }

      100% {
        -webkit-transform: rotate(270deg);
        transform: rotate(270deg);
      }
    }

    .path {
      stroke-dasharray: 187;
      stroke-dashoffset: 0;
      -webkit-transform-origin: center;
      -ms-transform-origin: center;
      transform-origin: center;
      -webkit-animation: dash 1.4s ease-in-out infinite, colors 5.6s ease-in-out infinite;
      animation: dash 1.4s ease-in-out infinite, colors 5.6s ease-in-out infinite;
    }

    @-webkit-keyframes colors {
      0% {
        stroke: #73879C;
      }

      25% {
        stroke: #73879C;
      }

      50% {
        stroke: #73879C;
      }

      75% {
        stroke: #73879C;
      }

      100% {
        stroke: #73879C;
      }
    }

    @keyframes colors {
      0% {
        stroke: #73879C;
      }

      25% {
        stroke: #73879C;
      }

      50% {
        stroke: #73879C;
      }

      75% {
        stroke: #73879C;
      }

      100% {
        stroke: #73879C;
      }
    }

    @-webkit-keyframes dash {
      0% {
        stroke-dashoffset: 187;
      }

      50% {
        stroke-dashoffset: 46.75;
        -webkit-transform: rotate(135deg);
        transform: rotate(135deg);
      }

      100% {
        stroke-dashoffset: 187;
        -webkit-transform: rotate(450deg);
        transform: rotate(450deg);
      }
    }

    @keyframes dash {
      0% {
        stroke-dashoffset: 187;
      }

      50% {
        stroke-dashoffset: 46.75;
        -webkit-transform: rotate(135deg);
        transform: rotate(135deg);
      }

      100% {
        stroke-dashoffset: 187;
        -webkit-transform: rotate(450deg);
        transform: rotate(450deg);
      }
    }
  </style>

  <!-- readonly select2 -->
  <style>
    select[readonly].select2-hidden-accessible+.select2-container {
      pointer-events: none;
      touch-action: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection {
      background: #eee;
      box-shadow: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection__arrow,
    select[readonly].select2-hidden-accessible+.select2-container .select2-selection__clear {
      display: none;
    }
  </style>

  <!-- switch model saklar -->
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 10px;
      width: 10px;
      left: 5px;
      bottom: 2px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: #26B99A;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #26B99A;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(10px);
      -ms-transform: translateX(10px);
      transform: translateX(10px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>

  <!-- video -->
  <style>
    #myVideo {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
    }
  </style>

  <!-- stamp -->
  <style>
    .stamp {
      transform: rotate(12deg);
      color: #555;
      font-size: 3rem;
      font-weight: 700;
      border: 0.25rem solid #555;
      display: inline-block;
      padding: 0.25rem 1rem;
      text-transform: uppercase;
      border-radius: 1rem;
      font-family: 'Courier';
      -webkit-mask-image: url('<?= base_url('_assets/production/images/grunge.png') ?>');
      -webkit-mask-size: 944px 604px;
      mix-blend-mode: multiply;
    }

    .is-nope {
      color: #D23;
      border: 0.5rem double #D23;
      transform: rotate(3deg);
      -webkit-mask-position: 2rem 3rem;
      font-size: 2rem;
    }

    .is-approved {
      color: #0A9928;
      border: 0.5rem solid #0A9928;
      -webkit-mask-position: 13rem 6rem;
      transform: rotate(-14deg);
      border-radius: 0;
    }

    .is-draft {
      color: #C4C4C4;
      border: 0.5rem double #C4C4C4;
      transform: rotate(-5deg);
      font-size: 2rem;
      -webkit-mask-position: 2rem 3rem;
      font-family: "Open sans", Helvetica, Arial, sans-serif;
      border-radius: 0;
    }

    .is-reject {
      color: #D23;
      border: 0.5rem double #D23;
      transform: rotate(-5deg);
      font-size: 2rem;
      -webkit-mask-position: 2rem 3rem;
      font-family: "Open sans", Helvetica, Arial, sans-serif;
      border-radius: 0;
    }

    .is-pass {
      color: #0A9928;
      border: 0.5rem double #0A9928;
      transform: rotate(-5deg);
      font-size: 2rem;
      -webkit-mask-position: 2rem 3rem;
      font-family: "Open sans", Helvetica, Arial, sans-serif;
      border-radius: 0;
    }
  </style>
  <!-- stamp -->
</head>