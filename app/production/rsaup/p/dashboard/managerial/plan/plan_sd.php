<?php
include('../../../../../../../_header.php');
include('../../../app_name.php');
include('../../_config/pro_koneksi.php');

unset($_SESSION["piano_name"]);
unset($_SESSION['search_tanggal']);
if ((!isset($_SESSION['id'])) && ($_SESSION['role'] !== "managerial")) {
    echo "<script>window.location.href='../../../../../../../dashboard';</script>";
} else {
?>

    <body class="nav-md footer_fixed">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?= base_url('dashboard/') ?>" class="site_title" style="padding-left: 15px;"><img src="<?= base_url('_assets/production/images/emblem.png') ?>" alt="logo" style="width: 40px;"> <span><img src="<?= base_url('_assets/production/images/original-text.png') ?>" alt="piano" style="width: 110px;"></span></a>
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
                                    <li><a><i class="fa fa-edit"></i> Entry Plan <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li class="active"><a href="<?= base_url('app/production/rsaup/p/dashboard/managerial/plan/plan_cs.php') ?>"><i class=" fa fa-calendar-plus-o"></i> Case</a></li>
                                            <li class="active"><a href="<?= base_url('app/production/rsaup/p/dashboard/managerial/plan/plan_sd.php') ?>"><i class=" fa fa-calendar-plus-o"></i> Side</a></li>
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
                <div class="row ">
                    <center>
                        <div class="col-12 p-4" style="text-align: left;  border-radius: 0.25rem; background-color: white; box-shadow:0px 1px 5px rgba(0,0,0,0.8);">
                            <div class="row" style="font-size: 16px">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <!-- add plan -->
                                                <?php
                                                $qry = mysqli_query($conn, "SELECT count(id_plan) as antrian FROM planing");
                                                $result = mysqli_fetch_array($qry);
                                                $antrian = $result['antrian'] + 1;
                                                ?>
                                                <a href=" #" type="button" style="width: 150px" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $antrian; ?>"><i class="glyphicon glyphicon-plus"></i> Add Plan</a>
                                                <div class="modal fade" id="myModal<?php echo $antrian ?>" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Add Plan Piano</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="add_plan.php" method="POST">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group row" style="text-align: left;">
                                                                                <label for="tanggal" class="col-sm-5 col-form-label">Date</label>
                                                                                <div class="col-sm-7">
                                                                                    <?php
                                                                                    $date = new DateTime(); // Date object using current date and time
                                                                                    $dt = $date->format('Y-m-d');
                                                                                    ?>
                                                                                    <input type="date" value="<?php echo $dt ?>" style="border-radius: 0.25rem;  text-align: left" class="form-control" id="tanggal" name="tanggal" required>
                                                                                    <script type="text/javascript">
                                                                                        var date = new Date();
                                                                                        var day = date.getDate()
                                                                                        var month = date.getMonth() + 1
                                                                                        var year = date.getFullYear()
                                                                                        if (day < 10) {
                                                                                            day = '0' + day
                                                                                        }
                                                                                        if (month < 10) {
                                                                                            month = '0' + month
                                                                                        }
                                                                                        var minDate = year + '-' + month + '-' + day
                                                                                        document.getElementById('tanggal').setAttribute("min", minDate);
                                                                                    </script>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">

                                                                                <label for="name_piano" class="col-sm-5 col-form-label">Model Piano</label>
                                                                                <div class="col-sm-7">
                                                                                    <select id="name_piano" style="text-align: left;" name="name_piano" class="form-select" required>
                                                                                        <?php
                                                                                        $query = mysqli_query($conn, "SELECT distinct(name_piano) as name_piano FROM bd_piano_fix ORDER BY name_piano asc");
                                                                                        while ($row = mysqli_fetch_array($query)) {
                                                                                        ?>
                                                                                            <option value="<?php echo $row['name_piano']; ?>">
                                                                                                <?php echo $row['name_piano']; ?>
                                                                                            </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row" style="text-align: left;">
                                                                                <label for="qty" class="col-sm-5 col-form-label">Quantity(u)</label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="number" style="border-radius: 0.25rem;  text-align: center" class="form-control" min="1" id="qty" name="qty" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" name="add" data-bs-target="#exampleModalToggle" class="btn btn-success">Add Plan</button>
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="col-12">
                                                    <div class="search" style="position: relative">
                                                        <i class="fa fa-search" style="position: absolute; top: 10px; left: 14px;"></i>
                                                        <input type="text" class="form-control mb-3" style="border-radius: 0.25rem; text-indent: 25px; border: 2px solid skyblue;" id="myInput" onkeyup="myFunction()" placeholder="Search for Piano.." title="Type in a name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <?php
                                                $today = 'mm/dd/yyyy';
                                                // Ada tanggal
                                                if (!empty($_SESSION['search_tanggal'])) {
                                                ?>
                                                    <input type="date" style="border-radius: 0.25rem; border: 2px solid skyblue;" name="multi_search_filter" id="multi_search_filter" value="<?php echo  $_SESSION['search_tanggal']  ?>" multiple class="form-control selectpicker">
                                                    <input type="hidden" name="hidden_date" id="hidden_date" />
                                                <?php
                                                } else {
                                                    $_SESSION['search_tanggal'] = $today;
                                                ?>
                                                    <input type="date" style="border-radius: 0.25rem; border: 2px solid skyblue;" name="multi_search_filter" value="<?php echo  $_SESSION['search_tanggal']  ?>" id="multi_search_filter" multiple class="form-control selectpicker">
                                                    <input type="hidden" name="hidden_date" id="hidden_date" />
                                                <?php
                                                }
                                                ?>
                                                <div style="clear:both"></div>
                                            </div>
                                            <div id="body">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </center>
                </div>
            </div>
            <!-- ============================ END FORM ============================ -->
        </div>
        <script>
            function myFunction() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[2];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>

    <?php
    include('../../../../../../../_footer.php');

    // berisi script tambahan untuk search
    include('../../_footer.php');
} ?>