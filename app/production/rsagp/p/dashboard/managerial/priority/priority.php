<?php
include('../../../../../../../_header.php');
include('../../../app_name.php');
include('../../pro_koneksi.php');

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
                            <a href="#" class="site_title" style="padding-left: 15px;"><img src="<?= base_url('_assets/production/images/emblem_hikari_white.png') ?>" alt="logo" style="width: 40px;"> <span><img src="<?= base_url('_assets/production/images/hikari_text_white.png') ?>" alt="piano" style="width: 110px;"></span></a>
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
                                    <li><a><i class="fa fa-edit"></i> Entry Data <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <!-- <li class=""><a> <i class="fa fa-cubes"></i> Inventory<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li class=""><a href="<?= base_url('input_data/data.php') ?>">Daily</a></li>
                                <li class=""><a href="<?= base_url('input_data/dataacc.php') ?>">Accumulation</a></li>
                            </ul>
                        </li> -->
                                            <!-- <li class=""><a href="<?= base_url('ng/data.php') ?>"><i class="fa fa-recycle"></i> No Good Cabinet</a></li> -->
                                            <li class="active"><a href="../plan/plan.php"><i class="fa fa-calendar-plus-o"></i> Plan</a></li>
                                            <!-- <li class=""><a href="<?= base_url('checkout/checkout.php') ?>"><i class="fa fa-shopping-cart"></i> Checkout</a></li> -->
                                        </ul>
                                    </li>
                                    <li class="active"><a href="../priority/priority.php"><i class='fa fa-signal'></i> Priority</a></li>
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
                <div class="row ">
                    <center>
                        <div class="col-12 p-4" style="text-align: left;  border-radius: 0.25rem; background-color: white; box-shadow:0px 1px 5px rgba(0,0,0,0.8);">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <form action="add.php" method="POST">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row" style="text-align: left;">
                                                            <label for="qty" class="col-2 col-form-label" style="color: black">Safety Stock</label>
                                                            <div class="col-5">
                                                                <?php
                                                                $sql6 = mysqli_query($conn, "SELECT safety_stock FROM prioritas order by pcs_prioritas");
                                                                $ambil6 = mysqli_fetch_array($sql6)
                                                                ?>
                                                                <input type="number" style="border-radius: 0.25rem; text-align: center;" class="form-control" id="safety_stock" name="safety_stock" placeholder="Safety Stock saat ini <?php echo $ambil6['safety_stock'] ?>" required autofocus>
                                                            </div>
                                                            <div class="col-3">
                                                                <button type="submit" name="submit" class="btn btn-success">Input</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-4">
                                            <div class="search" style="position: relative">
                                                <i class="fa fa-search" style="position: absolute; left: 14px; top: 13px;"></i>
                                                <input type="text" class="form-control mb-3" style="border-radius: 0.25rem; text-indent: 25px; border: 2px solid skyblue;" id="myInput" onkeyup="myFunction()" placeholder="search for cabinet.." title="Type in a name">
                                            </div>
                                        </div>
                                        <div id="bodyy">
                                            <div style="overflow-y: scroll; height: 300px;">
                                                <table style="font-size : 16px; border-radius: 0.25rem; border: 1px solid #ddd" id="myTable" class="table tableFixHead">
                                                    <thead style="background-color: #f1f1f1;">
                                                        <tr>
                                                            <th style="text-align: center;">No</th>
                                                            <th style="width: 65%; text-align: center;">Cabinet</th>
                                                            <th style="width: 20%; text-align: center;">Dest</th>
                                                            <th style="width: 10%; text-align: center;">Qty(pcs)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql1 = mysqli_query($conn, "SELECT safety_stock FROM prioritas order by pcs_prioritas");
                                                        $ambil = mysqli_fetch_array($sql1);
                                                        $no = 0;
                                                        $qryy = mysqli_query($conn, "SELECT name_piano, name_cabinet, dest,SUM(pcs_prioritas) as pcs_prioritas FROM prioritas WHERE pcs_prioritas <= '$ambil[safety_stock]' GROUP BY name_cabinet ORDER BY `pcs_prioritas` ASC");
                                                        while ($roww = mysqli_fetch_array($qryy)) {
                                                            $no++;
                                                            // belum bisa menampilkan tulisan data not found ketika data kosong
                                                        ?>
                                                            <tr>
                                                                <td style="text-align:center"><?= $no ?></td>
                                                                <td style="text-align: left;"><?= $roww['name_cabinet'] ?></td>
                                                                <td style="text-align: center;"><?= $roww['dest'] ?></td>
                                                                <td style="text-align: center;"><?= $roww['pcs_prioritas'] ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
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
                    td = tr[i].getElementsByTagName("td")[1];
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