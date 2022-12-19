<?php
include('../../../../../../../_header.php');
include('../../../app_name.php');
include('../../_config/pro_koneksi.php');
$_SESSION['jenis'] = 'side';
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
                                    <li class="dashboard"><a href="../dashboard/dashboard.php"><i class="fa fa-desktop"></i> Ratio Set</a></li>
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
                            <h3 style="font-weight: bold;  margin-top: 0px; font-size: 18px; "><?= strtoupper($app_name) ?> - Customize Plan Side</h3>
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
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 style="font-weight: bold;">Today's plan</h2>
                                            <hr style="margin: 0px ;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 tableFixHead-2">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="text-align: center;">Model</th>
                                                        <th scope="col" style="text-align: center;">Plan</th>
                                                        <th scope="col" style="text-align: center;">Achvd</th>
                                                        <th scope="col" style="text-align: center;">Type</th>
                                                        <th colspan="2" scope="col" style="text-align: center;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $today = date("Y-m-d");

                                                    $avail_sql = mysqli_query($conn, "SELECT * FROM plan where tanggal = '$today' and jenis = '$_SESSION[jenis]'");
                                                    $avail_row = mysqli_num_rows($avail_sql);

                                                    if ($avail_row > 0) {

                                                        $td_sql = mysqli_query($conn, "SELECT p.tanggal as tanggal, p.nama_piano, p.qty as plan, a.qty as achvd, p.jenis FROM plan p JOIN achieved a ON p.keytag = a.keytag where p.jenis = '$_SESSION[jenis]' and p.tanggal = '$today' order by p.nama_piano asc");
                                                        $id = 0;
                                                        while ($td_data = mysqli_fetch_array($td_sql)) {
                                                            $id++;
                                                    ?>
                                                            <tr>
                                                                <!-- untuk verifikasi delete -->
                                                                <input type="hidden" id="model<?= $id ?>" value="<?= $td_data['nama_piano'] ?>">
                                                                <input type="hidden" id="tanggal<?= $id ?>" value="<?= $td_data['tanggal'] ?>">
                                                                <input type="hidden" id="plan<?= $id ?>" value="<?= $td_data['plan'] ?>">
                                                                <input type="hidden" id="achvd<?= $id ?>" value="<?= $td_data['achvd'] ?>">
                                                                <input type="hidden" id="keytag<?= $id ?>" value="<?= $td_data['tanggal'] . "|" . $td_data['nama_piano'] . "|" . $_SESSION['jenis'] ?>">
                                                                <!-- untuk verifikasi delete -->

                                                                <td style="text-align: left;"><?= $td_data['nama_piano'] ?></td>
                                                                <td style="text-align: center;"><?= $td_data['plan'] ?></td>
                                                                <td style="text-align: center;"><?= $td_data['achvd'] ?></td>
                                                                <td style="text-align: center;"><?= $td_data['jenis'] ?></td>
                                                                <td style="text-align: center;">
                                                                    <i style="cursor: pointer;" class="fa fa-edit" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $id ?>"></i>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <i style="cursor: pointer;" class="fa fa-trash" id="td_delete<?= $id ?>"></i>
                                                                </td>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="staticBackdrop<?= $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <form method="POST">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="staticBackdropLabel">Customize Plan - Today's</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-11">
                                                                                            <span style="font-size: 15px ;">Description Plan</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Model</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input style="border-radius: 3px;" type="text" name="model" class="form-control" value="<?= $td_data['nama_piano'] ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Date</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input style="border-radius: 3px;" type="text" name="tanggal" class="form-control" value="<?= date('d-m-Y') ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Plan now</label>
                                                                                                <div class="col-sm-2">
                                                                                                    <input style="text-align: center; border-radius: 3px;" type="text" name="plan_now" class="form-control" value="<?= $td_data['plan'] ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Adjust</label>
                                                                                                <div class="col-sm-2">
                                                                                                    <input style="text-align: center; border-radius: 3px;" type="text" name="plan" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <?php
                                                                        if (isset($_POST['save'])) {
                                                                            $plan = $_POST['plan'];
                                                                            $model = $_POST['model'];
                                                                            $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
                                                                            $sql = mysqli_query($conn, "UPDATE plan SET qty = $plan WHERE nama_piano = '$model' and tanggal = '$tanggal' and jenis = '$_SESSION[jenis]'");
                                                                            if ($sql) {
                                                                        ?>

                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        Swal.fire({
                                                                                            title: 'Success',
                                                                                            text: 'Plan has been changed!',
                                                                                            type: 'success',
                                                                                            confirmButtonText: 'OK'
                                                                                        }).then(function() {
                                                                                            window.location = 'cust_sd.php';
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        Swal.fire({
                                                                                            title: 'Error',
                                                                                            text: 'Plan not changed!',
                                                                                            type: 'error',
                                                                                            confirmButtonText: 'OK'
                                                                                        }).then(function() {
                                                                                            window.location = 'cust_sd.php';
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                        <?php
                                                                            }
                                                                        } else if (isset($_POST['delete'])) {
                                                                            $plan = $_POST['plan'];
                                                                            $model = $_POST['model'];
                                                                            $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
                                                                            $sql = mysqli_query($conn, "DELETE FROM plan WHERE nama_piano = '$model' and tanggal = '$tanggal' and jenis = '$_SESSION[jenis]'");
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <script type='text/javascript'>
                                                                    $(document).ready(function() {
                                                                        $("#td_delete<?= $id ?>").click(function() {
                                                                            var model = $('#model<?= $id ?>').val();
                                                                            var tanggal = $('#tanggal<?= $id ?>').val();
                                                                            var plan = $('#plan<?= $id ?>').val();
                                                                            var achvd = $('#achvd<?= $id ?>').val();
                                                                            var type = "<?= $_SESSION['jenis'] ?>";
                                                                            var keytag = $('#keytag<?= $id ?>').val();

                                                                            if (achvd > 0) {
                                                                                Swal.fire({
                                                                                    title: 'Error',
                                                                                    text: 'You can not delete this data!',
                                                                                    type: 'error',
                                                                                    confirmButtonText: 'OK'
                                                                                });
                                                                            } else {
                                                                                Swal.fire({
                                                                                    type: 'question',
                                                                                    title: 'Are you sure to delete this plan?',
                                                                                    html: '<table class="table table-bordered">' +
                                                                                        '<tr> <th style=" width:400px">Model </th> <th style=" width:400px">Date </th> <th style=" width:50px">Qty </th> </tr> ' +
                                                                                        '<tr> <td>' + model + ' </td> <td>' + tanggal + ' <td>' + plan + ' </td> </td> </tr>' +
                                                                                        '</table>',
                                                                                    showCloseButton: true,
                                                                                    showCancelButton: true,
                                                                                    cancelButtonText: 'Cancel',
                                                                                    confirmButtonColor: '#BD2231',
                                                                                    confirmButtonText: 'Delete',
                                                                                }).then((result) => {
                                                                                    if (result.value) {
                                                                                        $.ajax({
                                                                                            url: "delete.php",
                                                                                            type: "POST",
                                                                                            data: {
                                                                                                model: model,
                                                                                                tanggal: tanggal,
                                                                                                plan: plan,
                                                                                                type: type,
                                                                                                keytag: keytag
                                                                                            },
                                                                                            success: function(data) {
                                                                                                var data = JSON.parse(data);
                                                                                                if (data.statusCode == 111) {
                                                                                                    Swal.fire({
                                                                                                        title: 'Success',
                                                                                                        text: 'Plan has been deleted!',
                                                                                                        type: 'success',
                                                                                                        confirmButtonText: 'OK'
                                                                                                    }).then(function() {
                                                                                                        window.location = 'cust_sd.php';
                                                                                                    });
                                                                                                } else if (data.statusCode == 222) {
                                                                                                    Swal.fire({
                                                                                                        title: 'Error',
                                                                                                        text: 'Plan not deleted!',
                                                                                                        type: 'error',
                                                                                                        confirmButtonText: 'OK'
                                                                                                    }).then(function() {
                                                                                                        window.location = 'cust_sd.php';
                                                                                                    });
                                                                                                }
                                                                                            }
                                                                                        })
                                                                                    }
                                                                                });
                                                                            }
                                                                        });
                                                                    });
                                                                </script>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='6' align='center'>No data found</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2 style="font-weight: bold;">Remaining</h2>
                                                    <hr style="margin: 0px ;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 tableFixHead-2">
                                                    <table class="table table-bordered table-danger">
                                                        <thead>
                                                            <tr>
                                                                <th>Model</th>
                                                                <th>Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="rem">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2 style="font-weight: bold;">Stock</h2>
                                                    <hr style="margin: 0px ;">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 tableFixHead-2">
                                                    <table class="table table-bordered table-success">
                                                        <thead>
                                                            <tr>
                                                                <th>Model</th>
                                                                <th>Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="stck">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr style="margin-bottom: 5px ;">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 style="font-weight: bold;">Tomorrow plan</h2>
                                            <hr style="margin: 0px ;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 tableFixHead-2">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="text-align: center;">Model</th>
                                                        <th scope="col" style="text-align: center;">Plan</th>
                                                        <th scope="col" style="text-align: center;">Achvd</th>
                                                        <th scope="col" style="text-align: center;">Type</th>
                                                        <th colspan="2" scope="col" style="text-align: center;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $tomorrow = date("Y-m-d", strtotime("+1 day"));

                                                    $tomorrow_sql = mysqli_query($conn, "SELECT * FROM plan where tanggal = '$tomorrow' and jenis = '$_SESSION[jenis]'");
                                                    $tomorrow_row = mysqli_num_rows($tomorrow_sql);

                                                    if ($tomorrow_row > 0) {

                                                        $tr_sql = mysqli_query($conn, "SELECT p.tanggal as tanggal, p.nama_piano, p.qty as plan, a.qty as achvd, p.jenis FROM plan p JOIN achieved a ON p.keytag = a.keytag where p.jenis = '$_SESSION[jenis]' and p.tanggal = '$tomorrow' order by p.nama_piano asc");
                                                        $id_tr = 0;
                                                        while ($tr_data = mysqli_fetch_array($tr_sql)) {
                                                            $id_tr++;
                                                    ?>
                                                            <tr>
                                                                <!-- untuk verifikasi delete -->
                                                                <input type="hidden" id="tr_model<?= $id_tr ?>" value="<?= $tr_data['nama_piano'] ?>">
                                                                <input type="hidden" id="tr_tanggal<?= $id_tr ?>" value="<?= $tr_data['tanggal'] ?>">
                                                                <input type="hidden" id="tr_plan<?= $id_tr ?>" value="<?= $tr_data['plan'] ?>">
                                                                <input type="hidden" id="tr_achvd<?= $id_tr ?>" value="<?= $tr_data['achvd'] ?>">
                                                                <input type="hidden" id="tr_keytag<?= $id_tr ?>" value="<?= $tr_data['tanggal'] . "|" . $tr_data['nama_piano'] . "|" . $_SESSION['jenis'] ?>">
                                                                <!-- untuk verifikasi delete -->

                                                                <td style="text-align: left;"><?= $tr_data['nama_piano'] ?></td>
                                                                <td style="text-align: center;"><?= $tr_data['plan'] ?></td>
                                                                <td style="text-align: center;"><?= $tr_data['achvd'] ?></td>
                                                                <td style="text-align: center;"><?= $tr_data['jenis'] ?></td>
                                                                <td style="text-align: center;">
                                                                    <i style="cursor: pointer;" class="fa fa-edit" data-bs-toggle="modal" data-bs-target="#trstaticBackdrop<?= $id_tr ?>"></i>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <i style="cursor: pointer;" class="fa fa-trash" id="tr_delete<?= $id_tr ?>"></i>
                                                                </td>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="trstaticBackdrop<?= $id_tr ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="trstaticBackdropLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <form method="POST">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="trstaticBackdropLabel">Customize Plan - <?= $tomorrow ?></h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-11">
                                                                                            <span style="font-size: 15px ;">Description Plan</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Model</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input style="border-radius: 3px;" type="text" name="model" class="form-control" value="<?= $tr_data['nama_piano'] ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Date</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input style="border-radius: 3px;" type="text" name="tanggal" class="form-control" value="<?= date('d-m-Y', strtotime($tr_data['tanggal'])) ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Plan now</label>
                                                                                                <div class="col-sm-2">
                                                                                                    <input style="text-align: center; border-radius: 3px;" type="text" name="plan_now" class="form-control" value="<?= $tr_data['plan'] ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Adjust</label>
                                                                                                <div class="col-sm-2">
                                                                                                    <input style="text-align: center; border-radius: 3px;" type="text" name="plan" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <?php
                                                                        if (isset($_POST['save'])) {
                                                                            $plan = $_POST['plan'];
                                                                            $model = $_POST['model'];
                                                                            $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
                                                                            $sql = mysqli_query($conn, "UPDATE plan SET qty = $plan WHERE nama_piano = '$model' and tanggal = '$tanggal' and jenis = '$_SESSION[jenis]'");
                                                                            if ($sql) {
                                                                        ?>

                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        Swal.fire({
                                                                                            title: 'Success',
                                                                                            text: 'Plan has been changed!',
                                                                                            type: 'success',
                                                                                            confirmButtonText: 'OK'
                                                                                        }).then(function() {
                                                                                            window.location = 'cust_sd.php';
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        Swal.fire({
                                                                                            title: 'Error',
                                                                                            text: 'Plan not changed!',
                                                                                            type: 'error',
                                                                                            confirmButtonText: 'OK'
                                                                                        }).then(function() {
                                                                                            window.location = 'cust_sd.php';
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                        <?php
                                                                            }
                                                                        } else if (isset($_POST['delete'])) {
                                                                            $plan = $_POST['plan'];
                                                                            $model = $_POST['model'];
                                                                            $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
                                                                            $sql = mysqli_query($conn, "DELETE FROM plan WHERE nama_piano = '$model' and tanggal = '$tanggal' and jenis = '$_SESSION[jenis]'");
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <script type='text/javascript'>
                                                                    $(document).ready(function() {
                                                                        $("#tr_delete<?= $id_tr ?>").click(function() {
                                                                            var model = $('#tr_model<?= $id_tr ?>').val();
                                                                            var tanggal = $('#tr_tanggal<?= $id_tr ?>').val();
                                                                            var plan = $('#tr_plan<?= $id_tr ?>').val();
                                                                            var achvd = $('#tr_achvd<?= $id_tr ?>').val();
                                                                            var type = "<?= $_SESSION['jenis'] ?>";
                                                                            var keytag = $('#tr_keytag<?= $id_tr ?>').val();

                                                                            if (achvd > 0) {
                                                                                Swal.fire({
                                                                                    title: 'Error',
                                                                                    text: 'You can not delete this data!',
                                                                                    type: 'error',
                                                                                    confirmButtonText: 'OK'
                                                                                });
                                                                            } else {
                                                                                Swal.fire({
                                                                                    type: 'question',
                                                                                    title: 'Are you sure to delete this plan?',
                                                                                    html: '<table class="table table-bordered">' +
                                                                                        '<tr> <th style=" width:400px">Model </th> <th style=" width:400px">Date </th> <th style=" width:50px">Qty </th> </tr> ' +
                                                                                        '<tr> <td>' + model + ' </td> <td>' + tanggal + ' <td>' + plan + ' </td> </td> </tr>' +
                                                                                        '</table>',
                                                                                    showCloseButton: true,
                                                                                    showCancelButton: true,
                                                                                    cancelButtonText: 'Cancel',
                                                                                    confirmButtonColor: '#BD2231',
                                                                                    confirmButtonText: 'Delete',
                                                                                }).then((result) => {
                                                                                    if (result.value) {
                                                                                        $.ajax({
                                                                                            url: "delete.php",
                                                                                            type: "POST",
                                                                                            data: {
                                                                                                model: model,
                                                                                                tanggal: tanggal,
                                                                                                plan: plan,
                                                                                                type: type,
                                                                                                keytag: keytag
                                                                                            },
                                                                                            success: function(data) {
                                                                                                var data = JSON.parse(data);
                                                                                                if (data.statusCode == 111) {
                                                                                                    Swal.fire({
                                                                                                        title: 'Success',
                                                                                                        text: 'Plan has been deleted!',
                                                                                                        type: 'success',
                                                                                                        confirmButtonText: 'OK'
                                                                                                    }).then(function() {
                                                                                                        window.location = 'cust_sd.php';
                                                                                                    });
                                                                                                } else if (data.statusCode == 222) {
                                                                                                    Swal.fire({
                                                                                                        title: 'Error',
                                                                                                        text: 'Plan not deleted!',
                                                                                                        type: 'error',
                                                                                                        confirmButtonText: 'OK'
                                                                                                    }).then(function() {
                                                                                                        window.location = 'cust_sd.php';
                                                                                                    });
                                                                                                }
                                                                                            }
                                                                                        })
                                                                                    }
                                                                                });
                                                                            }
                                                                        });
                                                                    });
                                                                </script>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='6' align='center'>No data found</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 style="font-weight: bold;">2 Days to come plan</h2>
                                            <hr style="margin: 0px ;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 tableFixHead-2">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="text-align: center;">Model</th>
                                                        <th scope="col" style="text-align: center;">Plan</th>
                                                        <th scope="col" style="text-align: center;">Achvd</th>
                                                        <th scope="col" style="text-align: center;">Type</th>
                                                        <th colspan="2" scope="col" style="text-align: center;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $tomorrow2 = date("Y-m-d", strtotime("+2 day"));
                                                    $tomorrow2_sql = mysqli_query($conn, "SELECT * FROM plan where tanggal = '$tomorrow2' and jenis = '$_SESSION[jenis]'");
                                                    $tomorrow2_row = mysqli_num_rows($tomorrow2_sql);
                                                    if ($tomorrow2_row > 0) {
                                                        $tr2_sql = mysqli_query($conn, "SELECT p.tanggal as tanggal, p.nama_piano, p.qty as plan, a.qty as achvd, p.jenis FROM plan p JOIN achieved a ON p.keytag = a.keytag where p.jenis = '$_SESSION[jenis]' and p.tanggal = '$tomorrow2' order by p.nama_piano asc");
                                                        $id_tr2 = 0;
                                                        while ($tr2_data = mysqli_fetch_array($tr2_sql)) {
                                                            $id_tr2++;
                                                    ?>
                                                            <tr>
                                                                <!-- untuk verifikasi delete -->
                                                                <input type="hidden" id="tr2_model<?= $id_tr2 ?>" value="<?= $tr2_data['nama_piano'] ?>">
                                                                <input type="hidden" id="tr2_tanggal<?= $id_tr2 ?>" value="<?= $tr2_data['tanggal'] ?>">
                                                                <input type="hidden" id="tr2_plan<?= $id_tr2 ?>" value="<?= $tr2_data['plan'] ?>">
                                                                <input type="hidden" id="tr2_achvd<?= $id_tr2 ?>" value="<?= $tr2_data['achvd'] ?>">
                                                                <input type="hidden" id="tr2_keytag<?= $id_tr2 ?>" value="<?= $tr2_data['tanggal'] . "|" . $tr2_data['nama_piano'] . "|" . $_SESSION['jenis'] ?>">
                                                                <!-- untuk verifikasi delete -->

                                                                <td style="text-align: left;"><?= $tr2_data['nama_piano'] ?></td>
                                                                <td style="text-align: center;"><?= $tr2_data['plan'] ?></td>
                                                                <td style="text-align: center;"><?= $tr2_data['achvd'] ?></td>
                                                                <td style="text-align: center;"><?= $tr2_data['jenis'] ?></td>
                                                                <td style="text-align: center;">
                                                                    <i style="cursor: pointer;" class="fa fa-edit" data-bs-toggle="modal" data-bs-target="#tr2staticBackdrop<?= $id_tr2 ?>"></i>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <i style="cursor: pointer;" class="fa fa-trash" id="tr2_delete<?= $id_tr2 ?>"></i>
                                                                </td>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="tr2staticBackdrop<?= $id_tr2 ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="trstaticBackdropLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <form method="POST">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="tr2staticBackdropLabel">Customize Plan - <?= $tomorrow2 ?></h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-11">
                                                                                            <span style="font-size: 15px ;">Description Plan</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Model</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input style="border-radius: 3px;" type="text" name="model" class="form-control" value="<?= $tr2_data['nama_piano'] ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Date</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input style="border-radius: 3px;" type="text" name="tanggal" class="form-control" value="<?= date('d-m-Y', strtotime($tr2_data['tanggal'])) ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Plan now</label>
                                                                                                <div class="col-sm-2">
                                                                                                    <input style="text-align: center; border-radius: 3px;" type="text" name="plan_now" class="form-control" value="<?= $tr2_data['plan'] ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="mb-3 row">
                                                                                                <label class="col-sm-2 col-form-label">Adjust</label>
                                                                                                <div class="col-sm-2">
                                                                                                    <input style="text-align: center; border-radius: 3px;" type="text" name="plan" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <?php
                                                                        if (isset($_POST['save'])) {
                                                                            $plan = $_POST['plan'];
                                                                            $model = $_POST['model'];
                                                                            $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
                                                                            $sql = mysqli_query($conn, "UPDATE plan SET qty = $plan WHERE nama_piano = '$model' and tanggal = '$tanggal' and jenis = '$_SESSION[jenis]'");
                                                                            if ($sql) {
                                                                        ?>
                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        Swal.fire({
                                                                                            title: 'Success',
                                                                                            text: 'Plan has been changed!',
                                                                                            type: 'success',
                                                                                            confirmButtonText: 'OK'
                                                                                        }).then(function() {
                                                                                            window.location = 'cust_sd.php';
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        Swal.fire({
                                                                                            title: 'Error',
                                                                                            text: 'Plan not changed!',
                                                                                            type: 'error',
                                                                                            confirmButtonText: 'OK'
                                                                                        }).then(function() {
                                                                                            window.location = 'cust_sd.php';
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                        <?php
                                                                            }
                                                                        } else if (isset($_POST['delete'])) {
                                                                            $plan = $_POST['plan'];
                                                                            $model = $_POST['model'];
                                                                            $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
                                                                            $sql = mysqli_query($conn, "DELETE FROM plan WHERE nama_piano = '$model' and tanggal = '$tanggal' and jenis = '$_SESSION[jenis]'");
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <script type='text/javascript'>
                                                                    $(document).ready(function() {
                                                                        $("#tr2_delete<?= $id_tr2 ?>").click(function() {
                                                                            var model = $('#tr2_model<?= $id_tr2 ?>').val();
                                                                            var tanggal = $('#tr2_tanggal<?= $id_tr2 ?>').val();
                                                                            var plan = $('#tr2_plan<?= $id_tr2 ?>').val();
                                                                            var achvd = $('#tr2_achvd<?= $id_tr2 ?>').val();
                                                                            var type = "<?= $_SESSION['jenis'] ?>";
                                                                            var keytag = $('#tr2_keytag<?= $id_tr2 ?>').val();

                                                                            if (achvd > 0) {
                                                                                Swal.fire({
                                                                                    title: 'Error',
                                                                                    text: 'You can not delete this data!',
                                                                                    type: 'error',
                                                                                    confirmButtonText: 'OK'
                                                                                });
                                                                            } else {
                                                                                Swal.fire({
                                                                                    type: 'question',
                                                                                    title: 'Are you sure to delete this plan?',
                                                                                    html: '<table class="table table-bordered">' +
                                                                                        '<tr> <th style=" width:400px">Model </th> <th style=" width:400px">Date </th> <th style=" width:50px">Qty </th> </tr> ' +
                                                                                        '<tr> <td>' + model + ' </td> <td>' + tanggal + ' <td>' + plan + ' </td> </td> </tr>' +
                                                                                        '</table>',
                                                                                    showCloseButton: true,
                                                                                    showCancelButton: true,
                                                                                    cancelButtonText: 'Cancel',
                                                                                    confirmButtonColor: '#BD2231',
                                                                                    confirmButtonText: 'Delete',
                                                                                }).then((result) => {
                                                                                    if (result.value) {
                                                                                        $.ajax({
                                                                                            url: "delete.php",
                                                                                            type: "POST",
                                                                                            data: {
                                                                                                model: model,
                                                                                                tanggal: tanggal,
                                                                                                plan: plan,
                                                                                                type: type,
                                                                                                keytag: keytag
                                                                                            },
                                                                                            success: function(data) {
                                                                                                var data = JSON.parse(data);
                                                                                                if (data.statusCode == 111) {
                                                                                                    Swal.fire({
                                                                                                        title: 'Success',
                                                                                                        text: 'Plan has been deleted!',
                                                                                                        type: 'success',
                                                                                                        confirmButtonText: 'OK'
                                                                                                    }).then(function() {
                                                                                                        window.location = 'cust_sd.php';
                                                                                                    });
                                                                                                } else if (data.statusCode == 222) {
                                                                                                    Swal.fire({
                                                                                                        title: 'Error',
                                                                                                        text: 'Plan not deleted!',
                                                                                                        type: 'error',
                                                                                                        confirmButtonText: 'OK'
                                                                                                    }).then(function() {
                                                                                                        window.location = 'cust_sd.php';
                                                                                                    });
                                                                                                }
                                                                                            }
                                                                                        })
                                                                                    }
                                                                                });
                                                                            }
                                                                        });
                                                                    });
                                                                </script>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='6' align='center'>No data found</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <hr style="margin-top: 0px;">



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
                $.getJSON("rem_sd.php", function(data) {
                    $("#rem").empty();
                    var no = 1;
                    $.each(data.result_rem, function() {
                        $("#rem").append("<tr><td>" + this['nama_piano'] + "</td><td style='text-align: right;'>" + this['rem_cs'] + "</td></tr>");
                    });
                });
            }

            function update_stck() {
                $.getJSON("stock_sd.php", function(data) {
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