<?php
include('../../../../../../../_header.php');
include('../../../app_name.php');
include('../../_config/pro_koneksi.php');
$_SESSION['jenis'] = 'case';
unset($_SESSION["piano_name"]);
unset($_SESSION['search_tanggal']);
if ((!isset($_SESSION['id'])) && ($_SESSION['role'] !== "managerial")) {
    echo "<script>window.location.href='../../../../../../../dashboard';</script>";
} else {
?>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?= base_url('dashboard/') ?>" class="site_title" style="padding-left: 15px;"><img src="<?= base_url('_assets/production/images/emblem_hikari_white.png') ?>" alt="logo" style="width: 40px;"> <span><img src="<?= base_url('_assets/production/images/hikari_text_white.png') ?>" alt="piano" style="width: 110px;"></span></a>
                        </div>
                        <div class="clearfix"></div>
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="<?= base_url('_assets/production/images/profile2.png') ?>" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2><?php echo $_SESSION["nama"] ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->
                        <br />
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li class="dashboard"><a href="../dashboard/dashboard.php"><i class="fa fa-desktop"></i> Dashboard</a></li>
                                    <li><a><i class="fa fa-pencil"></i> Entry Plan <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?= base_url('app/production/rsaup/p/dashboard/managerial/plan/plan_cs.php') ?>"><i class=" fa fa-calendar-plus-o"></i> Case</a></li>
                                            <li><a href="<?= base_url('app/production/rsaup/p/dashboard/managerial/plan/plan_sd.php') ?>"><i class=" fa fa-calendar-plus-o"></i> Side</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-edit"></i> Customize Plan <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?= base_url('app/production/rsaup/p/dashboard/managerial/cust_plan/cust_cs.php') ?>"><i class=" fa fa-calendar-plus-o"></i> Case</a></li>
                                            <li><a href="<?= base_url('app/production/rsaup/p/dashboard/managerial/cust_plan/cust_sd.php') ?>"><i class=" fa fa-calendar-plus-o"></i> Side</a></li>
                                        </ul>
                                    </li>
                                    <li class=""><a href="../priority/priority.php"><i class='fa fa-signal'></i> Priority</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a style="color: inherit;" href="<?= base_url('dashboard') ?>" data-toggle="tooltip" data-placement="top" title="Dashboard">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            </a>
                            <a style="color: inherit;" href="<?= base_url('app/production/rsagp/p/dashboard/managerial/_profile/index.php') ?>" data-toggle="tooltip" data-placement="top" title="Profile">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </a>
                            <a style="color: inherit;" href="<?= base_url('app/production/rsagp/p/dashboard/managerial/_settings/index.php') ?>" data-toggle="tooltip" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url('auth/act_logout.php') ?>">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>
                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars pb-2"></i></a>
                        </div>
                        <nav class="nav navbar-nav">
                            <ul class=" navbar-right">
                                <li class="nav-item dropdown open" style="padding-left: 15px;">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?= base_url('_assets/production/images/profile2.png') ?>"><?php echo $_SESSION['nama'] ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?= base_url('dashboard/') ?>"><i class="fa fa-home pull-right"></i>Hikari</a>
                                        <a class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="dashboard_graph" style="padding-bottom: 0px; padding-left: 0px; padding-right: 0px; margin-left: 0px; background-color: #F7F7F7;">
                    <div class="row">
                        <div class="col-md-7">
                            <h3 style="font-weight: bold;  margin-top: 0px; font-size: 18px; "><?= strtoupper($app_name) ?></h3>
                        </div>
                        <div class="col-md-5">
                            <span style="text-align: right ; margin-top: 0px;">

                                <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                                    <h2 style="color: #2A3F54; margin-top: 0px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun ?> <span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                            </span>
                        </div>
                    </div>
                    <!-- <hr style="margin: 0px;"> -->
                </div>
                <!-- <div class="clearfix"></div> -->
                <div class="separator"></div>

                <!-- ============================ START FORM ============================ -->
                <script src="<?= base_url('_assets/src/add/sweetalert2.all.min.js') ?>"></script>

                <div class="row ">
                    <center>
                        <div class="col-12 p-4" style="text-align: left; margin-bottom: 50px;  border-radius: 0.25rem; background-color: white; box-shadow:0px 1px 5px rgba(0,0,0,0.8);">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12" style="text-align: right; padding-right: 45px;">
                                            <i class="fa fa-refresh fa-lg" data-bs-toggle="tooltip" title="Refresh Chart" style="cursor: pointer;" onclick="location.reload(true)"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <canvas id="dailyprogress" height="90px"></canvas>
                                            <script>
                                                const labels = [<?php
                                                                $yesterday = date('Y-m-d', strtotime('-5 days'));
                                                                $today = date('Y-m-d');
                                                                for ($i = 7; $i >= 0; $i--) {
                                                                    $date = date('D, d-m-y', strtotime('-' . $i . ' days'));
                                                                    $skip = date('Y-m-d', strtotime('-' . $i . ' days'));
                                                                    if (date('l', strtotime($skip)) != "Saturday" && date('l', strtotime($skip)) != "Sunday") {
                                                                        echo "'" . $date . "',";
                                                                    }
                                                                }
                                                                ?>];

                                                const data = {

                                                    labels: labels,
                                                    datasets: [{
                                                            label: 'Plan',
                                                            backgroundColor: '#FF6384',
                                                            borderColor: '#FF6384',
                                                            data: [<?php
                                                                    for ($p = 7; $p >= 0; $p--) {
                                                                        $date = date('Y-m-d', strtotime('-' . $p . ' days'));
                                                                        $sql = mysqli_query($conn, "SELECT SUM(qty) as qty from plan where tanggal = '$date' ");
                                                                        $result = mysqli_fetch_array($sql);
                                                                        if (date('l', strtotime($date)) != "Saturday" && date('l', strtotime($date)) != "Sunday") {
                                                                            echo $result['qty'] . ",";
                                                                        }
                                                                    }
                                                                    ?>],
                                                            yAxisID: 'y',
                                                            tension: 0.2,
                                                        },
                                                        {
                                                            label: 'Actual',
                                                            backgroundColor: '#36A2EB',
                                                            borderColor: '#36A2EB',
                                                            data: [<?php
                                                                    for ($p = 7; $p >= 0; $p--) {
                                                                        $date = date('Y-m-d', strtotime('-' . $p . ' days'));
                                                                        $sql = mysqli_query($conn, "SELECT SUM(qty) as qty from achieved where tanggal = '$date'");
                                                                        $result = mysqli_fetch_array($sql);
                                                                        if (date('l', strtotime($date)) != "Saturday" && date('l', strtotime($date)) != "Sunday") {
                                                                            echo $result['qty'] . ",";
                                                                        }
                                                                    }
                                                                    ?>],
                                                            // yAxisID: 'y1',
                                                            tension: 0.2,
                                                        }
                                                    ]
                                                };

                                                const config = {
                                                    type: 'line',
                                                    data: data,
                                                    options: {
                                                        responsive: true,
                                                        interaction: {
                                                            mode: 'index',
                                                            intersect: false,
                                                        },
                                                        stacked: false,
                                                        plugins: {
                                                            title: {
                                                                display: true,
                                                                text: 'Daily Progress'
                                                            }
                                                        },
                                                        scales: {
                                                            y: {
                                                                type: 'linear',
                                                                display: true,
                                                                position: 'left',
                                                            },
                                                            y1: {
                                                                type: 'linear',
                                                                display: false,
                                                                position: 'right',

                                                                // grid line settings
                                                                grid: {
                                                                    drawOnChartArea: false, // only want the grid lines for one axis to show up
                                                                },
                                                            },
                                                        }
                                                    },
                                                };
                                            </script>
                                            <script>
                                                const myChart = new Chart(
                                                    document.getElementById('dailyprogress'),
                                                    config
                                                );
                                            </script>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2>Side, <?= date('l') ?></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <?php
                                                // total side hari ini
                                                $sqltplansd = mysqli_query($conn, "SELECT SUM(qty) as qty from plan where tanggal = '$today' and jenis = 'side'");
                                                $resulttplansd = mysqli_fetch_array($sqltplansd);
                                                $sqltachvdsd = mysqli_query($conn, "SELECT SUM(qty) as qty from achieved where tanggal = '$today' and jenis = 'side'");
                                                $resulttachvdsd = mysqli_fetch_array($sqltachvdsd);
                                                if ($resulttplansd['qty'] == 0) {
                                                ?>
                                                    <th style="text-align: center; font-size: larger; width: 25%; color: #FF6384;"><?= $resulttplansd['qty'] ?></th>
                                                    <th style="text-align: center; font-size: larger; width: 25%; color: #36A2EB;"><?= $resulttachvdsd['qty'] ?></th>
                                                    <th style="text-align: center; font-size: larger; width: 50%;">0%</th>
                                                <?php
                                                } else {
                                                    $persensd = ($resulttachvdsd['qty'] / $resulttplansd['qty']) * 100;
                                                ?>
                                                    <th style="text-align: center; font-size: larger; width: 25%; color: #FF6384;"><?= $resulttplansd['qty'] ?></th>
                                                    <th style="text-align: center; font-size: larger; width: 25%; color: #36A2EB;"><?= $resulttachvdsd['qty'] ?></th>
                                                    <th style="text-align: center; font-size: larger; width: 50%;"><?= round($persensd, 2) ?>%</th>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2>Case, <?= date('l') ?></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <?php
                                                // total case hari ini
                                                $sqltplancs = mysqli_query($conn, "SELECT SUM(qty) as qty from plan where tanggal = '$today' and jenis = 'case'");
                                                $resulttplancs = mysqli_fetch_array($sqltplancs);
                                                $sqltachvdcs = mysqli_query($conn, "SELECT SUM(qty) as qty from achieved where tanggal = '$today' and jenis = 'case'");
                                                $resulttachvdcs = mysqli_fetch_array($sqltachvdcs);
                                                if ($resulttplancs['qty'] == 0) {
                                                ?>
                                                    <th style="text-align: center; font-size: larger; width: 25%; color: #FF6384;"><?= $resulttplancs['qty'] ?></th>
                                                    <th style="text-align: center; font-size: larger; width: 25%; color: #36A2EB;"><?= $resulttachvdcs['qty'] ?></th>
                                                    <th style="text-align: center; font-size: larger; width: 50%;">0%</th>
                                                <?php
                                                } else {
                                                    $persencs = ($resulttachvdcs['qty'] / $resulttplancs['qty']) * 100;
                                                ?>
                                                    <th style="text-align: center; font-size: larger; width: 25%; color: #FF6384;"><?= $resulttplancs['qty'] ?></th>
                                                    <th style="text-align: center; font-size: larger; width: 25%; color: #36A2EB;"><?= $resulttachvdcs['qty'] ?></th>
                                                    <th style="text-align: center; font-size: larger; width: 50%;"><?= round($persencs, 2) ?>%</th>
                                                <?php
                                                }

                                                ?>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr style="margin-bottom: 5px ;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 style="font-weight: bold;">Weekly of <?= date('F') ?></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered" style="text-align: center;">
                                                <thead>
                                                    <tr style="background-color: #EDEDED;">
                                                        <th scope="col" style="text-align: center;">Week</th>
                                                        <th colspan="2" scope="col" style="text-align: center; width: 16%;">Mon</th>
                                                        <th colspan="2" scope="col" style="text-align: center; width: 16%;">Tue</th>
                                                        <th colspan="2" scope="col" style="text-align: center; width: 16%;">Wed</th>
                                                        <th colspan="2" scope="col" style="text-align: center; width: 16%;">Thu</th>
                                                        <th colspan="2" scope="col" style="text-align: center; width: 16%;">Fri</th>
                                                        <th colspan="2" scope="col" style="text-align: center; ">Achievement</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // declare array
                                                    $p1 = array("", "", "", "", "");
                                                    $p2 = array("", "", "", "", "");
                                                    $p3 = array("", "", "", "", "");
                                                    $p4 = array("", "", "", "", "");
                                                    $p5 = array("", "", "", "", "");

                                                    $a1 = array("", "", "", "", "");
                                                    $a2 = array("", "", "", "", "");
                                                    $a3 = array("", "", "", "", "");
                                                    $a4 = array("", "", "", "", "");
                                                    $a5 = array("", "", "", "", "");

                                                    // get data from database
                                                    $stgl = date('Y-m') . "%";
                                                    $wsql = mysqli_query($conn, "SELECT p.tanggal, sum(p.qty) as plan , sum(a.qty) as achvd from plan p join achieved a on p.keytag = a.keytag where p.tanggal LIKE '$stgl' GROUP BY p.tanggal order by p.tanggal");
                                                    while ($wresult = mysqli_fetch_array($wsql)) {
                                                        // get number of week
                                                        $week = weekOfMonth(strtotime($wresult['tanggal']));
                                                        // switch week
                                                        if ($week == 1) {
                                                            // get name of day
                                                            $day = date('D', strtotime($wresult['tanggal']));
                                                            switch ($day) {
                                                                case 'Mon':
                                                                    $p1[0] = $wresult['plan'];
                                                                    $a1[0] = $wresult['achvd'];
                                                                    break;
                                                                case 'Tue':
                                                                    $p1[1] = $wresult['plan'];
                                                                    $a1[1] = $wresult['achvd'];
                                                                    break;
                                                                case 'Wed':
                                                                    $p1[2] = $wresult['plan'];
                                                                    $a1[2] = $wresult['achvd'];
                                                                    break;
                                                                case 'Thu':
                                                                    $p1[3] = $wresult['plan'];
                                                                    $a1[3] = $wresult['achvd'];
                                                                    break;
                                                                case 'Fri':
                                                                    $p1[4] = $wresult['plan'];
                                                                    $a1[4] = $wresult['achvd'];
                                                                    break;
                                                            }
                                                        } else if ($week == 2) {
                                                            $day = date('D', strtotime($wresult['tanggal']));
                                                            switch ($day) {
                                                                case 'Mon':
                                                                    $p2[0] = $wresult['plan'];
                                                                    $a2[0] = $wresult['achvd'];
                                                                    break;
                                                                case 'Tue':
                                                                    $p2[1] = $wresult['plan'];
                                                                    $a2[1] = $wresult['achvd'];
                                                                    break;
                                                                case 'Wed':
                                                                    $p2[2] = $wresult['plan'];
                                                                    $a2[2] = $wresult['achvd'];
                                                                    break;
                                                                case 'Thu':
                                                                    $p2[3] = $wresult['plan'];
                                                                    $a2[3] = $wresult['achvd'];
                                                                    break;
                                                                case 'Fri':
                                                                    $p2[4] = $wresult['plan'];
                                                                    $a2[4] = $wresult['achvd'];
                                                                    break;
                                                            }
                                                        } else if ($week == 3) {
                                                            $day = date('D', strtotime($wresult['tanggal']));
                                                            switch ($day) {
                                                                case 'Mon':
                                                                    $p3[0] = $wresult['plan'];
                                                                    $a3[0] = $wresult['achvd'];
                                                                    break;
                                                                case 'Tue':
                                                                    $p3[1] = $wresult['plan'];
                                                                    $a3[1] = $wresult['achvd'];
                                                                    break;
                                                                case 'Wed':
                                                                    $p3[2] = $wresult['plan'];
                                                                    $a3[2] = $wresult['achvd'];
                                                                    break;
                                                                case 'Thu':
                                                                    $p3[3] = $wresult['plan'];
                                                                    $a3[3] = $wresult['achvd'];
                                                                    break;
                                                                case 'Fri':
                                                                    $p3[4] = $wresult['plan'];
                                                                    $a3[4] = $wresult['achvd'];
                                                                    break;
                                                            }
                                                        } else if ($week == 4) {
                                                            $day = date('D', strtotime($wresult['tanggal']));
                                                            switch ($day) {
                                                                case 'Mon':
                                                                    $p4[0] = $wresult['plan'];
                                                                    $a4[0] = $wresult['achvd'];
                                                                    break;
                                                                case 'Tue':
                                                                    $p4[1] = $wresult['plan'];
                                                                    $a4[1] = $wresult['achvd'];
                                                                    break;
                                                                case 'Wed':
                                                                    $p4[2] = $wresult['plan'];
                                                                    $a4[2] = $wresult['achvd'];
                                                                    break;
                                                                case 'Thu':
                                                                    $p4[3] = $wresult['plan'];
                                                                    $a4[3] = $wresult['achvd'];
                                                                    break;
                                                                case 'Fri':
                                                                    $p4[4] = $wresult['plan'];
                                                                    $a4[4] = $wresult['achvd'];
                                                                    break;
                                                            }
                                                        } else if ($week == 5) {
                                                            $day = date('D', strtotime($wresult['tanggal']));
                                                            switch ($day) {
                                                                case 'Mon':
                                                                    $p5[0] = $wresult['plan'];
                                                                    $a5[0] = $wresult['achvd'];
                                                                    break;
                                                                case 'Tue':
                                                                    $p5[1] = $wresult['plan'];
                                                                    $a5[1] = $wresult['achvd'];
                                                                    break;
                                                                case 'Wed':
                                                                    $p5[2] = $wresult['plan'];
                                                                    $a5[2] = $wresult['achvd'];
                                                                    break;
                                                                case 'Thu':
                                                                    $p5[3] = $wresult['plan'];
                                                                    $a5[3] = $wresult['achvd'];
                                                                    break;
                                                                case 'Fri':
                                                                    $p5[4] = $wresult['plan'];
                                                                    $a5[4] = $wresult['achvd'];
                                                                    break;
                                                            }
                                                        }
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td>W1</td>
                                                        <?php
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo "<td style='width: 8%; font-weight: bold; color: #FF6384;'>" . $p1[$i] . "</td>";
                                                            echo "<td style='width: 8%; font-weight: bold; color: #36A2EB;'>" . $a1[$i] . "</td>";
                                                        }
                                                        ?>
                                                        <td><?php
                                                            if (array_sum($a1) == 0) {
                                                                echo "0%";
                                                            } else {
                                                                $p = array_sum($p1);
                                                                $a = array_sum($a1);
                                                                if ($p != 0 && $a != 0) {
                                                                    $r = ($a / $p) * 100;
                                                                    echo round($r, 2) . "%";
                                                                } else {
                                                                    echo "0%";
                                                                }
                                                            }

                                                            ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>W2</td>
                                                        <?php
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo "<td style='width: 8%; font-weight: bold; color: #FF6384;'>" . $p2[$i] . "</td>";
                                                            echo "<td style='width: 8%; font-weight: bold; color: #36A2EB;'>" . $a2[$i] . "</td>";
                                                        }
                                                        ?>
                                                        <td><?php
                                                            if (array_sum($a2) == 0) {
                                                                echo "0%";
                                                            } else {
                                                                $p = array_sum($p2);
                                                                $a = array_sum($a2);
                                                                if ($p != 0 && $a != 0) {
                                                                    $r = ($a / $p) * 100;
                                                                    echo round($r, 2) . "%";
                                                                } else {
                                                                    echo "0%";
                                                                }
                                                            }

                                                            ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>W3</td>
                                                        <?php
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo "<td style='width: 8%; font-weight: bold; color: #FF6384;'>" . $p3[$i] . "</td>";
                                                            echo "<td style='width: 8%; font-weight: bold; color: #36A2EB;'>" . $a3[$i] . "</td>";
                                                        }
                                                        ?>
                                                        <td><?php
                                                            if (array_sum($a3) == 0) {
                                                                echo "0%";
                                                            } else {
                                                                $p = array_sum($p3);
                                                                $a = array_sum($a3);
                                                                if ($p != 0 && $a != 0) {
                                                                    $r = ($a / $p) * 100;
                                                                    echo round($r, 2) . "%";
                                                                } else {
                                                                    echo "0%";
                                                                }
                                                            }

                                                            ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>W4</td>
                                                        <?php
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo "<td style='width: 8%; font-weight: bold; color: #FF6384;'>" . $p4[$i] . "</td>";
                                                            echo "<td style='width: 8%; font-weight: bold; color: #36A2EB;'>" . $a4[$i] . "</td>";
                                                        }
                                                        ?>
                                                        <td><?php
                                                            if (array_sum($a4) == 0) {
                                                                echo "0%";
                                                            } else {
                                                                $p = array_sum($p4);
                                                                $a = array_sum($a4);
                                                                if ($p != 0 && $a != 0) {
                                                                    $r = ($a / $p) * 100;
                                                                    echo round($r, 2) . "%";
                                                                } else {
                                                                    echo "0%";
                                                                }
                                                            }

                                                            ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>W5</td>
                                                        <?php
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo "<td style='width: 8%; font-weight: bold; color: #FF6384;'>" . $p5[$i] . "</td>";
                                                            echo "<td style='width: 8%; font-weight: bold; color: #36A2EB;'>" . $a5[$i] . "</td>";
                                                        }
                                                        ?>
                                                        <td><?php
                                                            if (array_sum($a5) == 0) {
                                                                echo "0%";
                                                            } else {
                                                                $p = array_sum($p5);
                                                                $a = array_sum($a5);

                                                                if ($p != 0 && $a != 0) {
                                                                    $h = $a / $p * 100;
                                                                    echo round($h, 2) . "%";
                                                                } else {
                                                                    echo "0%";
                                                                }
                                                            }

                                                            ?></td>
                                                    </tr>
                                                    <tr style="font-weight: bold; background-color: #EDEDED;">
                                                        <td>Total</td>
                                                        <td colspan="2">Plan</td>
                                                        <td colspan="3" style="color: #FF6384;"><?= array_sum($p1) + array_sum($p2) + array_sum($p3) + array_sum($p4) + array_sum($p5) ?></td>
                                                        <td colspan="2">Actual</td>
                                                        <td colspan="3" style="color: #36A2EB;"><?= array_sum($a1) + array_sum($a2) + array_sum($a3) + array_sum($a4) + array_sum($a5) ?></td>
                                                        <td><?php
                                                            $toplan = array_sum($p1) + array_sum($p2) + array_sum($p3) + array_sum($p4) + array_sum($p5);
                                                            $toactual = array_sum($a1) + array_sum($a2) + array_sum($a3) + array_sum($a4) + array_sum($a5);
                                                            if ($toplan != 0 && $toactual != 0) {
                                                                $h = $toactual / $toplan * 100;
                                                                echo round($h, 2) . "%";
                                                            } else {
                                                                echo "0%";
                                                            }
                                                            ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr style="margin-top: 0px;margin-bottom: 0px;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 style="font-weight: bold;">Monthly of <?= date('Y') ?></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr style="text-align: center; background-color: #EDEDED;">
                                                        <th style="width: 30%;">Month</th>
                                                        <th style="width: 20%;">Plan</th>
                                                        <th style="width: 20%;">Actual</th>
                                                        <th style="width: 30%;">Achievement</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $year = date('Y');
                                                    $tahunplan = 0;
                                                    $tahunactual = 0;
                                                    for ($i = 1; $i <= 12; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        $ctgl = $year . '-' . $i;
                                                        $name_month = date('F', strtotime($ctgl));
                                                        $gtl = mysqli_query($conn, "SELECT p.tanggal, SUM(p.qty) as plan, SUM(a.qty) as achvd FROM plan p JOIN achieved a ON p.keytag = a.keytag WHERE p.tanggal LIKE '$ctgl%'");
                                                        $tl = mysqli_fetch_array($gtl);
                                                        $tahunplan = $tahunplan + $tl['plan'];
                                                        $tahunactual = $tahunactual + $tl['achvd'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $name_month ?></td>
                                                            <td style="text-align: center;"><?= $tl['plan'] ?></td>
                                                            <td style="text-align: center;"><?= $tl['achvd'] ?></td>
                                                            <?php
                                                            if ($tl['plan'] == 0) {
                                                                echo "<td style='text-align: center;'>0%</td>";
                                                            } else {
                                                                $h = ($tl['achvd'] / $tl['plan']) * 100;
                                                                echo "<td style='text-align: center;'>" . round($h, 2) . "%</td>";
                                                            }
                                                            ?>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    <tr style="text-align: center; font-weight: bold; background-color: #EDEDED;">
                                                        <td>Total</td>
                                                        <td><?= $tahunplan ?></td>
                                                        <td><?= $tahunactual ?></td>
                                                        <td><?php
                                                            if ($tahunplan != 0 && $tahunactual != 0) {
                                                                $h = $tahunactual / $tahunplan * 100;
                                                                echo round($h, 2) . "%";
                                                            } else {
                                                                echo "0%";
                                                            } ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </center>
                </div>
            </div>
            <!-- ============================ END FORM ============================ -->
        </div>
        <?php
        include('../../_pro_footer.php');
        ?>

        <script>
            $(document).ready(function() {
                selesai();
            });

            function selesai() {
                setTimeout(function() {
                    update_stck();
                    update_rem();
                    selesai();
                }, 200);
            }

            function update_rem() {
                $.getJSON("rem_cs.php", function(data) {
                    $("#rem").empty();
                    var no = 1;
                    $.each(data.result_rem, function() {
                        $("#rem").append("<tr><td>" + this['nama_piano'] + "</td><td style='text-align: right;'>" + this['rem_cs'] + "</td></tr>");
                    });
                });
            }

            function update_stck() {
                $.getJSON("stock_cs.php", function(data) {
                    $("#stck").empty();
                    var no = 1;
                    $.each(data.result_stck, function() {
                        $("#stck").append("<tr><td>" + this['nama_piano'] + "</td><td style='text-align: right;'>" + this['rem_cs'] + "</td></tr>");
                    });
                });
            }
        </script>

        <script>
            $(document).ready(function() {
                $("#success").hide();
                $("#duplicate").hide();
                $("#yesterday").hide();
                $("#empty").hide();
                $('#butsave').on('click', function() {
                    $("#butsave").attr("disabled", "disabled");
                    var p_type = $('#p_type').val();
                    var p_date = $('#tanggal').val();
                    var p_model = $('#p_model').val();
                    var p_qty = $('#p_qty').val();
                    $.ajax({
                        url: "add_cs.php",
                        type: "POST",
                        data: {
                            p_type: p_type,
                            p_date: p_date,
                            p_model: p_model,
                            p_qty: p_qty
                        },
                        cache: false,
                        success: function(dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                $("#butsave").removeAttr("disabled");
                                $('#fupForm').find('input:text').val('');
                                $("#success").show();
                                $('#success').html('Data added successfully !');
                                $("#success").fadeTo(3000, 500).slideUp(500, function() {
                                    $("#success").slideUp(500);
                                });
                            } else if (dataResult.statusCode == 201) {
                                alert("Error occured !");
                            } else if (dataResult.statusCode == 101) {
                                $("#butsave").removeAttr("disabled");
                                $('#fupForm').find('input:text').val('');
                                $("#duplicate").show();
                                $('#duplicate').html('Data already exist !');
                                $("#duplicate").fadeTo(3000, 500).slideUp(500, function() {
                                    $("#duplicate").slideUp(500);
                                });
                            } else if (dataResult.statusCode == 102) {
                                $("#butsave").removeAttr("disabled");
                                $('#fupForm').find('input:text').val('');
                                $("#yesterday").show();
                                $('#yesterday').html('Can' + "'" + 't set plan for the past !');
                                $("#yesterday").fadeTo(3000, 500).slideUp(500, function() {
                                    $("#yesterday").slideUp(500);
                                });
                            } else if (dataResult.statusCode == 103) {
                                $("#butsave").removeAttr("disabled");
                                $("#empty").show();
                                $('#empty').html('Please fill all the field !');
                                $("#empty").fadeTo(3000, 500).slideUp(500, function() {
                                    $("#empty").slideUp(500);
                                });
                            }

                        }
                    });
                });
            });
        </script>





    <?php

    include('../../../../../../../_footer.php');
} ?>