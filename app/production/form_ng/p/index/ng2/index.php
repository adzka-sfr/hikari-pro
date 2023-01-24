<?php include('../../../../../../_header.php');
include('../../app_name.php');
include('../koneksi.php');

if ($_SESSION['role'] != 'pic out check1') {
    echo "<script>window.location='" . base_url('dashboard/') . "';</script>";
}
?>
<script>
    var el = document.getElementById('overlayBtn');
    if (el) {
        el.addEventListener('click', swapper, false);
    }
</script>

<script src="<?= base_url('_assets/src/add/sweetalert2.all.min.js') ?>"></script>
<!-- <title>Form NG</title> -->

<body class="nav-md footer_fixed">
    <div class="loading" style="background-color:#263238 ;">
        <div style="margin-top: 200px; margin-right: 70px; color: #dfc; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; " class="lds-hourglass"><span style="padding-left: 19px;">Loading</span></div>
    </div>
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?= base_url('dashboard') ?>" class="site_title" style="padding-left: 15px;"><img src="<?= base_url('_assets/production/images/emblem_hikari_white.png') ?>" alt="logo" style="width: 40px;"> <span><img src="<?= base_url('_assets/production/images/hikari_text_white.png') ?>" alt="piano" style="width: 110px;"></span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $_SESSION['nama'] ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li class="active"><a><i class="fa fa-desktop"></i> Dashboard</a>
                                </li>
                            </ul>
                        </div>

                        <!-- <div class="menu_section">
                            <h3>Employee</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-gears"></i> Settings <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="#">Setting 1</a></li>
                                        <li><a href="#l">Setting 2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <!-- <div class="sidebar-footer hidden-small">
                        <a style="color: inherit;" href="<?= base_url('dashboard') ?>" data-toggle="tooltip" data-placement="top" title="Dashboard">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                        </a>
                        <a style="color: inherit;" href="_profile/" data-toggle="tooltip" data-placement="top" title="Profile">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        </a>
                        <a style="color: inherit;" href="_settings/" data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url('auth/act_logout.php') ?>">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div> -->
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt=""><?php echo $_SESSION['nama'] ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="_profile/"> Profile</a>
                                    <a class="dropdown-item" href="_settings/">Settings</a>
                                    <a class="dropdown-item" href="_help/">Help</a>
                                    <a class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
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
                    <hr style="margin: 5px;">
                </div>

                <div class="dashboard_graph" style="padding-top: 10px;">
                    <div class="row">
                        <div class="col-12">
                            <h3>Outside Check 1 <span style="font-size: 10px;">(Checker now : <?= $_SESSION['nama'] ?>)</span> </h3>
                            <div class="separator"></div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">

                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <form method="POST">
                                        <input type="text" name="acard" class="form-control has-feedback-left" placeholder="Serial No">
                                        <span class="fa fa-qrcode form-control-feedback left"></span>
                                    </form>
                                </div>

                                <div class="col-md-1 col-sm-1  form-group has-feedback">
                                    <a href="scan.php" style="text-decoration: none;"><button onmouseover="mouseOver()" onmouseout="mouseOut()" class="btn btn-outline-secondary" style="padding: 5px;"><img src="barcode.png" id="barcode" width="25px" height="25px" /></button></a>
                                    <script type="text/javascript">
                                        function mouseOver() {
                                            document.getElementById("barcode").src = "barcode-w.png";
                                        }

                                        function mouseOut() {
                                            document.getElementById("barcode").src = "barcode.png"
                                        }
                                    </script>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2" style="text-align: right;">
                            <div class="row">
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <form method="POST">
                                        <button class="btn btn-danger" type="submit" name="reset">Clear</button>
                                    </form>
                                    <?php
                                    if (isset($_POST['reset'])) {
                                        unset($_SESSION['cardnumber_outside1']);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                // create session
                if (isset($_POST['acard'])) {
                    $_SESSION['cardnumber_outside1'] = $_POST['acard'];
                }
                ?>

                <!-- isi hasil scan slip number -->
                <?php
                // selama session masih kosong include no form
                if (empty($_SESSION['cardnumber_outside1'])) {
                    include('noform.php');
                } else {
                    // cek apakah slip terdaftar atau tidak
                    $sql1 = mysqli_query($connect_pro, "SELECT id FROM formng_register where c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                    $data1 = mysqli_fetch_row($sql1);

                    if ($data1 == 0) {
                        // jika tidak ada data muncul alert dan unset session
                        unset($_SESSION['cardnumber_outside1']);
                ?>
                        <script>
                            $(document).ready(function() {
                                Swal.fire({
                                    title: 'Data tidak ditemukan',
                                    text: 'No serial tidak terdaftar!',
                                    type: 'warning',
                                    confirmButtonText: 'OK'
                                }).then(function() {
                                    window.location = 'index.php';
                                });
                            });
                        </script>
                        <?php
                    } else {

                        $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                        $data1 = mysqli_fetch_array($sql1);

                        if (empty($data1['c_finishincheck'])) {
                            unset($_SESSION['cardnumber_outside1']);
                        ?>
                            <script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        title: 'Data ditemukan',
                                        text: 'No serial belum selesai pada proses sebelumnya!',
                                        type: 'info',
                                        confirmButtonText: 'OK'
                                    }).then(function() {
                                        window.location = 'index.php';
                                    });
                                });
                            </script>
                            <?php
                        } elseif (empty($data1['c_finishcomplete1'])) {
                            $sql1 = mysqli_query($connect_pro, "SELECT r.c_serialnumber, r.c_pianoname, c.c_category2 FROM formng_register r JOIN formng_category c ON r.c_gmc = c.c_gmc WHERE r.c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                            $data1 = mysqli_fetch_array($sql1);

                            $_SESSION['serialnumber_outside1'] = $data1['c_serialnumber'];
                            $_SESSION['pianoname_outside1'] = $data1['c_pianoname'];
                            $_SESSION['complete_outside1'] = $data1['c_category2'];

                            include 'formcomplete.php';
                        } else {

                            $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                            $data1 = mysqli_fetch_array($sql1);

                            $_SESSION['serialnumber_outside1'] = $data1['c_serialnumber'];
                            $_SESSION['pianoname_outside1'] = $data1['c_pianoname'];
                            if (empty($_SESSION['queue'])) {
                                $_SESSION['queue'] = 'tbo';
                            }

                            $sql2 = mysqli_query($connect_pro, "SELECT c_category FROM formng_category WHERE c_gmc = '$data1[c_gmc]' ");
                            $data2 = mysqli_fetch_array($sql2);
                            if (!empty($data2)) {
                                $sql2 = mysqli_query($connect_pro, "SELECT c_category FROM formng_category WHERE c_gmc = '$data1[c_gmc]' ");
                                $data2 = mysqli_fetch_array($sql2);

                                if ($data2['c_category'] == 'p') {
                                    $sql3 = mysqli_query($connect_pro, "SELECT c_checker1 FROM formng_resulto1 WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                    $data3 = mysqli_fetch_array($sql3);
                                    if (!empty($data3)) {
                                        $sql3 = mysqli_query($connect_pro, "SELECT c_checker1 FROM formng_resulto1 WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                        $data3 = mysqli_fetch_array($sql3);

                                        if ($data3['c_checker1'] == $_SESSION['nama']) {
                                            // cek jika sudah ada isi
                                            $sql4 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1 FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                            $data4 = mysqli_fetch_array($sql4);

                                            if (empty($data4['c_finishoutcheck1'])) {
                                                $sql5 = mysqli_query($connect_pro, "SELECT id FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                                $data5 = mysqli_fetch_array($sql5);

                                                if (empty($data5)) {
                                                    include('form1.php');
                                                } else {
                                                    include('form1ver.php');
                                                }
                                            } else {
                                                include('form1ver.php');
                                            }
                                        } else {
                                            unset($_SESSION['cardnumber_outside1']);
                            ?>
                                            <script>
                                                $(document).ready(function() {
                                                    Swal.fire({
                                                        title: 'Piano sudah pernah di cek!',
                                                        html: 'Silahkan menghubungi checker sebelumnya<br><b><?= $data3['c_checker1'] ?></b>',
                                                        type: 'info',
                                                        confirmButtonText: 'OK'
                                                    }).then(function() {
                                                        window.location = 'index.php';
                                                    });
                                                });
                                            </script>
                                        <?php
                                        }
                                    } else {
                                        // cek jika sudah ada isi
                                        $sql4 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1 FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                        $data4 = mysqli_fetch_array($sql4);

                                        if (empty($data4['c_finishoutcheck1'])) {
                                            $sql5 = mysqli_query($connect_pro, "SELECT id FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                            $data5 = mysqli_fetch_array($sql5);

                                            if (empty($data5)) {
                                                include('form1.php');
                                            } else {
                                                include('form1ver.php');
                                            }
                                        } else {
                                            include('form1ver.php');
                                        }
                                    }
                                } elseif ($data2['c_category'] == 'f') {
                                    $sql3 = mysqli_query($connect_pro, "SELECT c_checker1 FROM formng_resulto1 WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                    $data3 = mysqli_fetch_array($sql3);
                                    if (!empty($data3)) {
                                        $sql3 = mysqli_query($connect_pro, "SELECT c_checker1 FROM formng_resulto1 WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                        $data3 = mysqli_fetch_array($sql3);
                                        if ($data3['c_checker1'] == $_SESSION['nama']) {
                                            // cek jika sudah ada isi
                                            $sql4 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1 FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                            $data4 = mysqli_fetch_array($sql4);

                                            if (empty($data4['c_finishoutcheck1'])) {
                                                $sql5 = mysqli_query($connect_pro, "SELECT id FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                                $data5 = mysqli_fetch_array($sql5);

                                                if (empty($data5)) {
                                                    include('form2.php');
                                                } else {
                                                    include('form2ver.php');
                                                }
                                            } else {
                                                include('form2ver.php');
                                            }
                                        } else {
                                            unset($_SESSION['cardnumber_outside1']);
                                        ?>
                                            <script>
                                                $(document).ready(function() {
                                                    Swal.fire({
                                                        title: 'Piano sudah pernah di cek!',
                                                        html: 'Silahkan menghubungi checker sebelumnya<br><b><?= $data3['c_checker1'] ?></b>',
                                                        type: 'info',
                                                        confirmButtonText: 'OK'
                                                    }).then(function() {
                                                        window.location = 'index.php';
                                                    });
                                                });
                                            </script>
                                <?php
                                        }
                                    } else {
                                        // cek jika sudah ada isi
                                        $sql4 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1 FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                        $data4 = mysqli_fetch_array($sql4);

                                        if (empty($data4['c_finishoutcheck1'])) {
                                            $sql5 = mysqli_query($connect_pro, "SELECT id FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                                            $data5 = mysqli_fetch_array($sql5);

                                            if (empty($data5)) {
                                                include('form2.php');
                                            } else {
                                                include('form2ver.php');
                                            }
                                        } else {
                                            include('form2ver.php');
                                        }
                                    }
                                }
                            } else {
                                unset($_SESSION['cardnumber_outside1']);
                                ?>
                                <script>
                                    $(document).ready(function() {
                                        Swal.fire({
                                            title: 'Kode GMC tidak ditemukan',
                                            text: 'Silahkan menghubungi management!',
                                            type: 'info',
                                            confirmButtonText: 'OK'
                                        }).then(function() {
                                            window.location = 'index.php';
                                        });
                                    });
                                </script>
                <?php
                            }
                        }
                    }
                }
                ?>
                <!-- isi hasil scan slip number -->

            </div>
            <!-- /page content -->

            <?php include('../../../../../../_footer.php'); ?>