<?php
include('../../../../../../_header.php');
include('../../app_name.php');
?>
<script src="<?= base_url('_assets/src/add/sweetalert2.all.min.js') ?>"></script>

<body class="nav-md footer_fixed" style="background-color: #ffffff;">
    <div class="loading" style="background-color:#263238 ;">
        <div style="margin-top: 200px; margin-right: 70px; color: #dfc; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; " class="lds-hourglass"><span style="padding-left: 19px;">Loading</span></div>
    </div>
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
                            <a style="font-weight: bold;" class="dropdown-item" href="<?= base_url('dashboard/') ?>">Hikari</a>
                            <a style="font-weight: bold;" class="dropdown-item" href="main.php?p=help">Help</a>
                            <a style="font-weight: bold;" class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- page content -->
    <div class="right_col" role="main" style="background-color: #2B3035;">

        <div class="dashboard_graph" style="padding-bottom: 0px;">
            <div class="row">
                <div class="col-md-9">
                    <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 20px; color: #212529;">Final Check Progress Board</h2>
                </div>
                <div class="col-md-3">
                    <span style="text-align: right ; margin-top: 0px;">

                        <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                            <h2 style="color: #2A3F54; padding-right: 10px; margin-top: 0px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun . " " ?><span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                    </span>
                </div>
            </div>
            <hr style="margin: 0px;">
        </div>

        <div class="dashboard_graph" style="background-color: #2B3035;">

            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $sql = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as jumlah FROM formng_register");
                    $data = mysqli_fetch_array($sql);

                    $a = $data['jumlah']; // count data
                    $b = 7; // adjust
                    $interval = 10000; // 10 detik an
                    $awal = 0; // fix
                    $akhir = 0; // fix
                    $part = 0; // fix

                    // untuk perhitungan part
                    $total_part = 0;
                    $awal_part = 0;
                    $total_interval = 0;
                    while ($awal_part != $a and $awal_part < $a) {
                        $total_interval = $total_interval + $interval;
                        $total_part++;
                        $awal_part = $awal_part + $b;
                    }
                    while ($awal != $a and $awal < $a) {
                        $part++;
                        $akhir = $akhir + $b;
                    ?>
                        <div class="carousel-item <?php if ($part == 1) {
                                                        echo 'active';
                                                    } ?>" data-bs-interval="<?= $interval ?>">
                            <div class="row">
                                <div class="col-12" style="text-align: right;">
                                    <h5>Part <?= $part ?>/<?= $total_part ?></h5>
                                </div>
                            </div>

                            <table class="table" style="font-size: 28px; color: #ffffff;">
                                <thead style="text-align: center;">
                                    <th style="width: 13%;">No Seri</th>
                                    <th style="text-align: left; width: 40%;">Piano Name</th>
                                    <th style="width: 20%;">Progress</th>
                                    <!-- <th>PIC</th> -->
                                    <th style="width: 20%;">Time Spent</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = mysqli_query($connect_pro, "SELECT * FROM formng_register order by id limit $awal,$b");

                                    while ($data = mysqli_fetch_array($sql)) {
                                        $no = $data['c_serialnumber'];
                                    ?>
                                        <tr>
                                            <td style="text-align: center;">
                                                <div style="background-color: #9747FF; color: #ffffff; font-weight: bold;"><?= $data['c_serialnumber'] ?></div>
                                            </td>
                                            <td>
                                                <div style="background-color: #CA833D; color: #ffffff; font-weight: bold;"><?= $data['c_pianoname'] ?></div>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php
                                                if (!empty($data['c_outcheck3by'])) {
                                                    $status_process = 'Finish';
                                                } else {
                                                    if (!empty($data['c_complete3by'])) {
                                                        $status_process = 'Outside Check 3';
                                                    } else {
                                                        if (!empty($data['c_outcheck2by'])) {
                                                            $status_process = 'Completeness 3';
                                                        } else {
                                                            if (!empty($data['c_complete2by'])) {
                                                                $status_process = 'Outside Check 2';
                                                            } else {
                                                                if (!empty($data['c_outcheck1by'])) {
                                                                    $status_process = 'Completeness 2';
                                                                } else {
                                                                    if (!empty($data['c_complete1by'])) {
                                                                        $status_process = 'Outside Check 1';
                                                                    } else {
                                                                        if (!empty($data['c_incheckby'])) {
                                                                            $status_process = 'Completeness 1';
                                                                        } else {
                                                                            $status_process = 'Inside Check';
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                                <div style="background-color: #14AE5C; color: #ffffff; font-weight: bold;"><?= $status_process ?></div>
                                            </td>
                                            <!-- <td></td> -->
                                            <td style="text-align: center; ">
                                                <div style="background-color: #9747FF; color: #ffffff; font-weight: bold;" id="waktu<?= $no ?>"></div>
                                                <script>
                                                    // Set the date we're counting down to

                                                    var countDownDate<?= $no ?> = new Date("<?= $data['c_register'] ?>").getTime();

                                                    // Update the count down every 1 second
                                                    var x<?= $no ?> = setInterval(function() {

                                                        // Get today's date and time
                                                        var now = new Date().getTime();

                                                        // Find the distance between now and the count down date
                                                        var distance<?= $no ?> = now - countDownDate<?= $no ?>;

                                                        // Time calculations for days, hours, minutes and seconds
                                                        var days<?= $no ?> = Math.floor(distance<?= $no ?> / (1000 * 60 * 60 * 24));
                                                        var hours<?= $no ?> = Math.floor((distance<?= $no ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var minutes<?= $no ?> = Math.floor((distance<?= $no ?> % (1000 * 60 * 60)) / (1000 * 60));
                                                        var seconds<?= $no ?> = Math.floor((distance<?= $no ?> % (1000 * 60)) / 1000);

                                                        if (days<?= $no ?> < 10) {
                                                            days<?= $no ?> = "0" + days<?= $no ?>;
                                                        }

                                                        if (hours<?= $no ?> < 10) {
                                                            hours<?= $no ?> = "0" + hours<?= $no ?>;
                                                        }

                                                        if (minutes<?= $no ?> < 10) {
                                                            minutes<?= $no ?> = "0" + minutes<?= $no ?>;
                                                        }

                                                        if (seconds<?= $no ?> < 10) {
                                                            seconds<?= $no ?> = "0" + seconds<?= $no ?>;
                                                        }

                                                        // Display the result in the element with id="demo"
                                                        document.getElementById("waktu<?= $no ?>").innerHTML = days<?= $no ?> + "d " + hours<?= $no ?> + ":" +
                                                            minutes<?= $no ?> + ":" + seconds<?= $no ?> + "";
                                                    }, 1000);
                                                </script>
                                            </td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                        $awal = $awal + $b;
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span> -->
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span> -->
                </button>
            </div>

        </div>

        <!-- untuk refresh page di akhir slide -->
        <script type="text/javascript">
            setTimeout(function() {
                location = ''
            }, <?= $total_interval ?>)
        </script>

    </div>

    <?php
    include('../../../../../../_footer.php'); ?>