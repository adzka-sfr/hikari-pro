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
                <h3 style="letter-spacing: 2px; padding-left: 50px; "><u><b>HIKARI</b></u></h3>
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
                                            $qwwp = mysqli_query($connect_pro, "SELECT * from master_workcenter where dept = 'woodworking'");
                                            while ($dwwp = mysqli_fetch_array($qwwp)) {
                                                $wc = $dwwp['work_center'];
                                                $nm = $dwwp['work_center_name'];

                                                $qwwp2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dwwp[work_center]' ");
                                                $dwwp2 = mysqli_fetch_array($qwwp2);

                                                $qwwp3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dwwp[work_center]' ");
                                                $dwwp3 = mysqli_fetch_array($qwwp3);

                                                $progressww = ($dwwp3['hasil'] / $dwwp2['plan']) * 100;
                                                $progressww = number_format($progressww, '2', '.', '');

                                                // warna progress bar
                                                if ($progressww <= 50) {
                                                    $bg = 'bg-danger';
                                                    $setup = 'font-weight: bold;';
                                                } elseif ($progressww > 50 && $progressww <= 110) {
                                                    $bg = 'bg-success';
                                                    $setup = 'font-weight: bold;';
                                                } elseif ($progressww > 110) {
                                                    $bg = 'bg-warning';
                                                    $setup = 'font-weight: bold; text-align: left;  padding-left: 40%;';
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
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="<?= $setup ?> width: <?= $progressww ?>%;"><?= $progressww ?>%</div>
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
                                            $qpnp = mysqli_query($connect_pro, "SELECT * from master_workcenter where dept = 'painting'");
                                            while ($dpnp = mysqli_fetch_array($qpnp)) {
                                                $wc = $dpnp['work_center'];
                                                $nm = $dpnp['work_center_name'];

                                                $qpnp2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dpnp[work_center]' ");
                                                $dpnp2 = mysqli_fetch_array($qpnp2);

                                                $qpnp3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dpnp[work_center]' ");
                                                $dpnp3 = mysqli_fetch_array($qpnp3);

                                                $progresspn = ($dpnp3['hasil'] / $dpnp2['plan']) * 100;
                                                $progresspn = number_format($progresspn, '2', '.', '');

                                                // warna progress bar
                                                if ($progresspn <= 50) {
                                                    $bg = 'bg-danger';
                                                    $setup = 'font-weight: bold;';
                                                } elseif ($progresspn > 50 && $progresspn <= 110) {
                                                    $bg = 'bg-success';
                                                    $setup = 'font-weight: bold;';
                                                } elseif ($progresspn > 110) {
                                                    $bg = 'bg-warning';
                                                    $setup = 'font-weight: bold; text-align: left;  padding-left: 40%;';
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
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="<?= $setup ?>width: <?= $progresspn ?>%"><?= $progresspn ?>%</div>
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
                                            $qupap = mysqli_query($connect_pro, "SELECT * from master_workcenter where dept = 'up assy'");
                                            while ($dupap = mysqli_fetch_array($qupap)) {
                                                $wc = $dupap['work_center'];
                                                $nm = $dupap['work_center_name'];

                                                $qupap2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dupap[work_center]' ");
                                                $dupap2 = mysqli_fetch_array($qupap2);

                                                $qupap3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dupap[work_center]' ");
                                                $dupap3 = mysqli_fetch_array($qupap3);

                                                $progressupa = ($dupap3['hasil'] / $dupap2['plan']) * 100;
                                                $progressupa = number_format($progressupa, '2', '.', '');

                                                // warna progress bar
                                                if ($progressupa <= 50) {
                                                    $bg = 'bg-danger';
                                                    $setup = 'font-weight: bold;';
                                                } elseif ($progressupa > 50 && $progressupa <= 110) {
                                                    $bg = 'bg-success';
                                                    $setup = 'font-weight: bold;';
                                                } elseif ($progressupa > 110) {
                                                    $bg = 'bg-warning';
                                                    $setup = 'font-weight: bold; text-align: left;  padding-left: 40%;';
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
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="<?= $setup ?>width: <?= $progressupa ?>%"><?= $progressupa ?>%</div>
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
                                            $qgpap = mysqli_query($connect_pro, "SELECT * from master_workcenter where dept = 'gp assy'");
                                            while ($dgpap = mysqli_fetch_array($qgpap)) {
                                                $wc = $dgpap['work_center'];
                                                $nm = $dgpap['work_center_name'];

                                                $qgpap2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dgpap[work_center]' ");
                                                $dgpap2 = mysqli_fetch_array($qgpap2);

                                                $qgpap3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dgpap[work_center]' ");
                                                $dgpap3 = mysqli_fetch_array($qgpap3);

                                                $progressgpa = ($dgpap3['hasil'] / $dgpap2['plan']) * 100;
                                                $progressgpa = number_format($progressgpa, '2', '.', '');

                                                // warna progress bar
                                                if ($progressgpa <= 50) {
                                                    $bg = 'bg-danger';
                                                    $setup = 'font-weight: bold;';
                                                } elseif ($progressgpa > 50 && $progressgpa <= 110) {
                                                    $bg = 'bg-success';
                                                    $setup = 'font-weight: bold;';
                                                } elseif ($progressgpa > 110) {
                                                    $bg = 'bg-warning';
                                                    $setup = 'font-weight: bold; text-align: left;  padding-left: 40%;';
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
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="<?= $setup ?>width: <?= $progressgpa ?>%"><?= $progressgpa ?>%</div>
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
                                            $qkdpp = mysqli_query($connect_pro, "SELECT * from master_workcenter where dept = 'kd part'");
                                            while ($dkdpp = mysqli_fetch_array($qkdpp)) {
                                                $wc = $dkdpp['work_center'];
                                                $nm = $dkdpp['work_center_name'];

                                                $qkdpp2 = mysqli_query($connect_pro, "SELECT SUM(planqty) as plan FROM production_plan WHERE plandt = '$now' and makeprocecd = '$dkdpp[work_center]' ");
                                                $dkdpp2 = mysqli_fetch_array($qkdpp2);

                                                $qkdpp3 = mysqli_query($connect_pro, "SELECT SUM(actualqty) as hasil FROM production_result WHERE instdt LIKE '$now%' and makektcd = '$dkdpp[work_center]' ");
                                                $dkdpp3 = mysqli_fetch_array($qkdpp3);

                                                $progresskdp = ($dkdpp3['hasil'] / $dkdpp2['plan']) * 100;
                                                $progresskdp = number_format($progresskdp, '2', '.', '');

                                                // warna progress bar
                                                if ($progresskdp <= 50) {
                                                    $bg = 'bg-danger';
                                                    $setup = 'font-weight: bold;';
                                                } elseif ($progresskdp > 50 && $progresskdp <= 110) {
                                                    $bg = 'bg-success';
                                                    $setup = 'font-weight: bold;';
                                                } elseif ($progresskdp > 110) {
                                                    $bg = 'bg-warning';
                                                    $setup = 'font-weight: bold; text-align: left;  padding-left: 40%;';
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
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $bg ?>" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="<?= $setup ?>width: <?= $progresskdp ?>%"><?= $progresskdp ?>%</div>
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
        <script src="jquery-3.5.1.js"></script>
        <?php
        include '../planacc/woodworking.php';
        include '../planacc/painting.php';
        include '../planacc/upassy.php';
        include '../planacc/gpassy.php';
        include '../planacc/kdpart.php';
        ?>
    </div>
    <!-- /page content -->

    <?php include('../../_footer.php'); ?>