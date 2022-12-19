<?php
include('header.php');
?>

<body class=" nav-md footer_fixed" style="background-color: #F7F7F7;">
    <!-- <div class="container body"> -->
    <!-- <div class="main_container"> -->
    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a href="<?= base_url('dashboard/') ?>" style=" padding-left: 30px;"><img src="<?= base_url('_assets/production/images/hikari_purple.png') ?>" alt="logo_yamaha" height="30"></a>
            </div>
            <nav class="nav navbar-nav" style="padding-top: 0; padding-bottom: 0px;">
                <ul class=" navbar-right">
                    <span style="text-align: right ;">

                        <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                            <h2 style="color: #2A3F54; margin-top: 0px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun ?> <span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                    </span>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main" style="background-color: #fff;">

        <div id="pagedata"></div>
        <?php
        // include 'woodworking.php';
        // include 'painting.php';

        // include 'warning_delete.php';

        // include 'assy.php'; // gabisa
        ?>

    </div>

    <script src="jquery-3.5.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#pagedata').load('main.php').fadeIn("slow");

            var auto_refresh = setInterval(function() {
                $('#pagedata').load('main.php').fadeIn("slow");
            }, 60000);

        });
    </script>

    <?php
    //================== ACTIVITY LOG START ==================//

    // untuk activity setelah login tidak perlu baris di bawah ini (create token),
    // karena session token sudah di create pada saat login
    $tok_date = strtotime(date('YmdHis'));
    $_SESSION['token'] = bin2hex(random_bytes(10) . $tok_date);
    // sampai sini

    // log activity record  
    $now = date('Y-m-d H:i:s');
    $token = $_SESSION['token'];
    $l_t = $now;
    $sy_n = "Hikari"; // Nama Sistem
    $p_n = "Manufacturing Dashboard"; // Nama Proses
    $q = "select"; // Query
    $e_n = 'Guest'; // Nama Karyawan
    $e_i = 'Guest'; // Id Karyawan
    $c_i = $_SERVER['REMOTE_ADDR'];
    $c_n = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $s_n = $_SERVER['SCRIPT_NAME'];
    $h = $_SERVER['HTTP_HOST'];
    // mysqli_query($connect_log, "INSERT INTO activity_log set
    //                                 token = '$token',
    //                                 log_time = '$l_t',
    //                                 system_name = '$sy_n',
    //                                 process_name = '$p_n',
    //                                 query = '$q',
    //                                 employee_name = '$e_n',
    //                                 employee_id = '$e_i',
    //                                 computer_ip = '$c_i',
    //                                 computer_name = '$c_n',
    //                                 script_name = '$s_n',
    //                                 host = '$h'");

    //================== ACTIVITY LOG FINISH ==================//
    ?>
    <!-- /page content -->

    <?php include('_footer.php'); ?>