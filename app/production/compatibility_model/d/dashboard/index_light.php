<?php include('../../../../../_header.php'); ?>
<?php include('koneksi.php') ?>
<?php
$title = "Compatibility Model";
?>
<title><?= $title ?></title>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a href="<?= base_url('dashboard/') ?>" style="padding-top:15px; padding-left: 30px;"><img src="<?= base_url('_assets/production/images/hikari_purple.png') ?>" alt="logo_yamaha" height="30"></a>
            </div>
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt=""><?php echo $_SESSION['nama'] ?>
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <!-- <a class="dropdown-item" href="index2.php" style="background-color: #DEEDFF;"> Fixing Frame</a> -->
                            <a class="dropdown-item" href="<?= base_url('dashboard/') ?>"> Dashboard</a>
                            <a class="dropdown-item" href="<?= base_url('panel/profile') ?>"> Profile</a>
                            <a class="dropdown-item" href="<?= base_url('panel/settings') ?>">Settings</a>
                            <a class="dropdown-item" href="<?= base_url('panel/help') ?>">Help</a>
                            <a class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- page content -->
    <div class="right_col" role="main">

        <div class="dashboard_graph" style="padding-bottom: 0px;">
            <div class="row">
                <div class="col-md-9">
                    <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 23px; color: #212529;">COMPATIBILITY MODEL <a href="index.php" style="margin-left: 10px;"><i class="fa fa-moon-o"></i></a></h2>
                </div>
                <div class="col-md-3">
                    <span style="text-align: right ; margin-top: 0px;">

                        <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                            <h2 style="color: #2A3F54; padding-right: 10px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun . " " ?><span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                    </span>
                </div>
            </div>
        </div>

        <div class="dashboard_graph" style="padding-top: 0px;">
            <div class="row">
                <div class="col-6">
                    <div class="card w-100">
                        <h2 style="font-weight: bold; padding-left: 20px; margin-top: 10px; margin-bottom: 0px; font-size: 30px; color: #212529;">FIXING FRAME RESULT |<u><span style="color: #0DA90D;" id="hmbfixing"></span><span style="color: #0DA90D;"></span></u>|</h2>
                        <div class="d-md-flex testimony-29101">
                            <div class="card-body">
                                <table class="table" style="font-size: 35px;">
                                    <thead style="font-size: 35px; padding-top: 5px; padding-bottom: 5px; background-color: #DEEDFF; ">
                                        <th style="text-align: left;">Model </th>
                                        <!-- <th style="text-align: center;">Qty </th> -->
                                        <th style="text-align: center;">Act/Plan</th>
                                    </thead>
                                    <tbody id="fxall">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card w-100">
                        <h2 style="font-weight: bold; padding-left: 20px; margin-top: 10px; margin-bottom: 0px; font-size: 30px; color: #212529;">STRINGING RESULT |<u><span style="color: #0DA90D;" id="hmbstring"></span><span style="color: #0DA90D;"></span></u>|</h2>
                        <div class="d-md-flex testimony-29101">
                            <div class="card-body">
                                <table class="table " style="font-size: 35px;">
                                    <thead style="font-size: 35px; padding-top: 5px; padding-bottom: 5px; background-color: #FFA696; ">
                                        <th style="text-align: left;">Model </th>
                                        <th style="text-align: center;">WIP </th>
                                        <th style="text-align: center;">Act/Plan</th>
                                        <th style="text-align: center;">Stock </th>
                                    </thead>
                                    <tbody id="stall">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /page content -->
    <?php
    //================== ACTIVITY LOG START ==================//

    // log activity record  
    $now = date('Y-m-d H:i:s');
    $token = $_SESSION['token'];

    $l_t = $now;
    $sy_n = "Compatibility Model"; // Nama Sistem
    $p_n = "halaman utama (light)"; // Nama Proses
    $q = "read"; // Query
    $e_n = $_SESSION['nama']; // Nama Karyawan
    $e_i = $_SESSION['id']; // ID Karyawan
    $c_i = $_SERVER['REMOTE_ADDR'];
    $c_n = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $s_n = $_SERVER['SCRIPT_NAME'];
    $h = $_SERVER['HTTP_HOST'];
    mysqli_query($connect_log, "INSERT INTO activity_log set
                                    token = '$token',
                                    log_time = '$l_t',
                                    system_name = '$sy_n',
                                    process_name = '$p_n',
                                    query = '$q',
                                    employee_name = '$e_n',
                                    employee_id = '$e_i',
                                    computer_ip = '$c_i',
                                    computer_name = '$c_n',
                                    script_name = '$s_n',
                                    host = '$h'");

    //================== ACTIVITY LOG FINISH ==================//
    ?>
    <?php
    include('_footer_local.php');
    include('../../../../../_footer.php'); ?>