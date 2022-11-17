<?php
include('header.php');
// $now = date('Y-m-d');
$now = '2022-11-09';
?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
    <!-- <div class="container body"> -->
    <!-- <div class="main_container"> -->
    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <!-- <a style="padding-top: 5px;"> -->
                <a href="../auth/login.php">
                    <h3 style="letter-spacing: 2px; padding-left: 50px; "><u><b>HIKARI</b></u></h3>
                </a>
                <!-- </a> -->
            </div>
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <span style="text-align: right ; margin-top: 10px;">

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

        <div class="dashboard_graph">
            <div class="row x_title">
                <div class="col-md-12">

                    <div class="d-flex">
                        <div class="flex-fill" style="width: 20%;">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card">
                                        <h5 class="card-header">Wood Working</h5>
                                        <div class="card-body" style="padding: 5px;">

                                            <div class="row">
                                                <div class="col-12" style="margin-bottom: 10px;">
                                                    <div id="ap_woodworking" style="height:200px; padding-top: 0px; "></div>
                                                </div>
                                            </div>

                                            <?php
                                            $qp = mysqli_query($connect_pro, "SELECT * from master_workcenter where dept = 'woodworking'");
                                            while ($dp = mysqli_fetch_array($qp)) {
                                                $wc = $dp['work_center'];
                                                $nm = $dp['work_center_name'];

                                                $qp2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dp[work_center]' ");
                                                $dp2 = mysqli_fetch_array($qp2);

                                                $qp3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dp[work_center]' ");
                                                $dp3 = mysqli_fetch_array($qp3);

                                                if(empty($dp2['plan'])){
                                                    $prog = ($dp3['hasil'] / 1) * 100;
                                                }else{
                                                    $prog = ($dp3['hasil'] / $dp2['plan']) * 100;
                                                }
                                                $prog = number_format($prog, '2', '.', '');

                                                // warna progress bar
                                                if ($prog <= 50) {
                                                    $bg = 'bg-danger';
                                                    $setup = 'font-weight: 1000;';
                                                } elseif ($prog > 50 && $prog <= 110) {
                                                    $bg = 'bg-success';
                                                    $setup = 'font-weight: 1000;';
                                                } elseif ($prog > 110) {
                                                    $bg = 'bg-warning';
                                                    $setup = 'font-weight: 1000; text-align: left;  padding-left: 40%;';
                                                }
                                            ?>
                                                <div class="row">
                                                    <div class="col-12" style="padding-bottom: 0px;">

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span style="font-weight: 1000; margin-bottom: 0px; color: #5C7186;">(<?= $wc ?>) <?= strtoupper($nm) ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="progress" style="border-radius: 4px; margin-bottom: 10px;">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="<?= $setup ?>  width: <?= $prog ?>%;"><?= $prog ?>%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 20%;">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card">
                                        <h5 class="card-header">Painting</h5>
                                        <div class="card-body" style="padding: 5px;">

                                            <div class="row">
                                                <div class="col-12" style="margin-bottom: 10px;">
                                                    <div id="ap_painting" style="height:200px; padding-top: 0px; "></div>
                                                </div>
                                            </div>

                                            <?php
                                            $qp = mysqli_query($connect_pro, "SELECT * from master_workcenter where dept = 'painting'");
                                            while ($dp = mysqli_fetch_array($qp)) {
                                                $wc = $dp['work_center'];
                                                $nm = $dp['work_center_name'];

                                                $qp2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dp[work_center]' ");
                                                $dp2 = mysqli_fetch_array($qp2);

                                                $qp3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dp[work_center]' ");
                                                $dp3 = mysqli_fetch_array($qp3);

                                                if(empty($dp2['plan'])){
                                                    $prog = ($dp3['hasil'] / 1) * 100;
                                                }else{
                                                    $prog = ($dp3['hasil'] / $dp2['plan']) * 100;
                                                }
                                                $prog = number_format($prog, '2', '.', '');

                                                // warna progress bar
                                                if ($prog <= 50) {
                                                    $bg = 'bg-danger';
                                                    $setup = 'font-weight: 1000;';
                                                } elseif ($prog > 50 && $prog <= 110) {
                                                    $bg = 'bg-success';
                                                    $setup = 'font-weight: 1000;';
                                                } elseif ($prog > 110) {
                                                    $bg = 'bg-warning';
                                                    $setup = 'font-weight: 1000; text-align: left;  padding-left: 40%;';
                                                }
                                            ?>
                                                <div class="row">
                                                    <div class="col-12" style="padding-bottom: 0px;">

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span style="font-weight: 1000; margin-bottom: 0px; color: #5C7186;">(<?= $wc ?>) <?= strtoupper($nm) ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="progress" style="border-radius: 4px; margin-bottom: 10px;">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="<?= $setup ?>width: <?= $prog ?>%"><?= $prog ?>%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 20%;">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card">
                                        <h5 class="card-header">UP Assy</h5>
                                        <div class="card-body" style="padding: 5px;">

                                            <div class="row">
                                                <div class="col-12" style="margin-bottom: 10px;">
                                                    <div id="ap_upassy" style="height:200px; padding-top: 0px; "></div>
                                                </div>
                                            </div>

                                            <?php
                                            $qp = mysqli_query($connect_pro, "SELECT * from master_workcenter where dept = 'up assy'");
                                            while ($dp = mysqli_fetch_array($qp)) {
                                                $wc = $dp['work_center'];
                                                $nm = $dp['work_center_name'];

                                                $qp2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dp[work_center]' ");
                                                $dp2 = mysqli_fetch_array($qp2);

                                                $qp3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dp[work_center]' ");
                                                $dp3 = mysqli_fetch_array($qp3);

                                                if(empty($dp2['plan'])){
                                                    $prog = ($dp3['hasil'] / 1) * 100;
                                                }else{
                                                    $prog = ($dp3['hasil'] / $dp2['plan']) * 100;
                                                }
                                                $prog = number_format($prog, '2', '.', '');

                                                // warna progress bar
                                                if ($prog <= 50) {
                                                    $bg = 'bg-danger';
                                                    $setup = 'font-weight: 1000;';
                                                } elseif ($prog > 50 && $prog <= 110) {
                                                    $bg = 'bg-success';
                                                    $setup = 'font-weight: 1000;';
                                                } elseif ($prog > 110) {
                                                    $bg = 'bg-warning';
                                                    $setup = 'font-weight: 1000; text-align: left;  padding-left: 40%;';
                                                }
                                            ?>
                                                <div class="row">
                                                    <div class="col-12" style="padding-bottom: 0px;">

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span style="font-weight: 1000; margin-bottom: 0px; color: #5C7186;">(<?= $wc ?>) <?= strtoupper($nm) ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="progress" style="border-radius: 4px; margin-bottom: 10px;">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="<?= $setup ?>width: <?= $prog ?>%"><?= $prog ?>%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 20%;">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card">
                                        <h5 class="card-header">GP Assy</h5>
                                        <div class="card-body" style="padding: 5px;">

                                            <div class="row">
                                                <div class="col-12" style="margin-bottom: 10px;">
                                                    <div id="ap_gpassy" style="height:200px; padding-top: 0px; "></div>
                                                </div>
                                            </div>

                                            <?php
                                            $qp = mysqli_query($connect_pro, "SELECT * from master_workcenter where dept = 'gp assy'");
                                            while ($dp = mysqli_fetch_array($qp)) {
                                                $wc = $dp['work_center'];
                                                $nm = $dp['work_center_name'];

                                                $qp2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dp[work_center]' ");
                                                $dp2 = mysqli_fetch_array($qp2);

                                                $qp3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dp[work_center]' ");
                                                $dp3 = mysqli_fetch_array($qp3);

                                                if(empty($dp2['plan'])){
                                                    $prog = ($dp3['hasil'] / 1) * 100;
                                                }else{
                                                    $prog = ($dp3['hasil'] / $dp2['plan']) * 100;
                                                }
                                                $prog = number_format($prog, '2', '.', '');

                                                // warna progress bar
                                                if ($prog <= 50) {
                                                    $bg = 'bg-danger';
                                                    $setup = 'font-weight: 1000;';
                                                } elseif ($prog > 50 && $prog <= 110) {
                                                    $bg = 'bg-success';
                                                    $setup = 'font-weight: 1000;';
                                                } elseif ($prog > 110) {
                                                    $bg = 'bg-warning';
                                                    $setup = 'font-weight: 1000; text-align: left;  padding-left: 40%;';
                                                }
                                            ?>
                                                <div class="row">
                                                    <div class="col-12" style="padding-bottom: 0px;">

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span style="font-weight: 1000; margin-bottom: 0px; color: #5C7186;">(<?= $wc ?>) <?= strtoupper($nm) ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="progress" style="border-radius: 4px; margin-bottom: 10px;">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="<?= $setup ?>width: <?= $prog ?>%"><?= $prog ?>%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="flex-fill" style="width: 20%;">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card">
                                        <h5 class="card-header">KD Part</h5>
                                        <div class="card-body" style="padding: 5px;">

                                            <div class="row">
                                                <div class="col-12" style="margin-bottom: 10px;">
                                                    <div id="ap_kdpart" style="height:200px; padding-top: 0px; "></div>
                                                </div>
                                            </div>

                                            <?php
                                            $qp = mysqli_query($connect_pro, "SELECT * from master_workcenter where dept = 'kd part'");
                                            while ($dp = mysqli_fetch_array($qp)) {
                                                $wc = $dp['work_center'];
                                                $nm = $dp['work_center_name'];

                                                $qp2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dp[work_center]' ");
                                                $dp2 = mysqli_fetch_array($qp2);

                                                $qp3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dp[work_center]' ");
                                                $dp3 = mysqli_fetch_array($qp3);

                                                if(empty($dp2['plan'])){
                                                    $prog = ($dp3['hasil'] / 1) * 100;
                                                }else{
                                                    $prog = ($dp3['hasil'] / $dp2['plan']) * 100;
                                                }
                                                $prog = number_format($prog, '2', '.', '');

                                                // warna progress bar
                                                if ($prog <= 50) {
                                                    $bg = 'bg-danger';
                                                    $setup = 'font-weight: 1000;';
                                                } elseif ($prog > 50 && $prog <= 110) {
                                                    $bg = 'bg-success';
                                                    $setup = 'font-weight: 1000;';
                                                } elseif ($prog > 110) {
                                                    $bg = 'bg-warning';
                                                    $setup = 'font-weight: 1000; text-align: left;  padding-left: 40%;';
                                                }
                                            ?>
                                                <div class="row">
                                                    <div class="col-12" style="padding-bottom: 0px;">

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span style="font-weight: 1000; margin-bottom: 0px; color: #5C7186;">(<?= $wc ?>) <?= strtoupper($nm) ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="progress" style="border-radius: 4px; margin-bottom: 10px;">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="<?= $setup ?>width: <?= $prog ?>%"><?= $prog ?>%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
        include 'planacc/woodworking.php';
        include 'planacc/painting.php';
        include 'planacc/upassy.php';
        include 'planacc/gpassy.php';
        include 'planacc/kdpart.php';
        ?>
    </div>
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
    <!-- /page content -->

    <?php include('../_footer.php'); ?>