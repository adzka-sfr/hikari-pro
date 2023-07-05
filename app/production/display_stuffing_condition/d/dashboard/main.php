<?php
include('../../../../../_header.php');
include('../app_name.php');
include('db.php');
?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;" onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a href="<?= base_url('dashboard/') ?>" style="padding-top:15px; padding-left: 30px;"><img src="<?= base_url('_assets/production/images/yamaha_purple_no_waves.png') ?>" alt="logo_yamaha" height="30"></a>
                
            </div>
                    <div class="nav navbar-right">
                    <span style="text-align: right ; margin-top: 0px;">
                    <h2 style="color: #2A3F54; padding-right: 10px; margin-top: 0px;">Date Time: <b class="blue"><?php echo date('d-M-Y'); ?>&nbsp;&nbsp;<span id="clock"></b></span>&nbsp;</h2>
                    </span>
                    </div>
            <!--
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt=""><?php echo $_SESSION['nama'] ?>
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url('dashboard/') ?>">Hikari</a>
                            <a class="dropdown-item" href="main.php?page=welcome">Dashboard</a>
                            <a class="dropdown-item" href="main.php?p=help">Help</a>
                            <a class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>
                </ul>
            </nav>
            -->
        </div>
    </div>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="dashboard_graph" style="margin-top: 10px; margin-bottom: 50px;">
        <div class="x_content">
            <div class="row">
                <div class="col-12">

                    <?php
                    include "daily_stuffing_display.php";
                    ?>

                </div>
            </div>
        </div>
        </div>

    </div>
    <!-- /page content -->

    <?php
    include('../../../../../_footer.php'); ?>

<script type="text/javascript">
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function tampilkanwaktu(){
        //buat object date berdasarkan waktu saat ini
        var waktu = new Date();
        //ambil nilai jam, 
        //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length
        var sh = waktu.getHours() + ""; 
        //ambil nilai menit
        var sm = waktu.getMinutes() + "";
        //ambil nilai detik
        var ss = waktu.getSeconds() + "";
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }


</script>

</body>