<?php
include('../../_header.php');
unset($_SESSION["piano_name"]);
unset($_SESSION['search_tanggal']);
if ((!isset($_SESSION['id'])) || ($_SESSION['role'] !== "staff")) {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
} else {
?>

    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <ul class="nav side-menu">
                <li class="dashboard"><a href="<?= base_url('staff/dashboard') ?>"><i class="fa fa-desktop"></i> Ratio Set</a></li>
                <li><a><i class="fa fa-edit"></i> Entry Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li class=""><a> <i class="fa fa-cubes"></i> Inventory<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li class=""><a href="<?= base_url('staff/input_data/data.php') ?>">Daily</a></li>
                                <li class=""><a href="<?= base_url('staff/input_data/dataacc.php') ?>">Accumulation</a></li>
                            </ul>
                        </li>
                        <!-- <li class=""><a href="<?= base_url('ng/data.php') ?>"><i class="fa fa-recycle"></i> No Good Cabinet</a></li> -->
                        <!-- <li class=""><a href="<?= base_url('plan/plan.php') ?>"><i class="fa fa-calendar-plus-o"></i> Plan</a></li> -->
                        <li class="active"><a href="<?= base_url('staff/checkout/checkout.php') ?>"><i class="fa fa-shopping-cart"></i> Checkout</a></li>
                    </ul>
                </li>
                <!-- <li class=""><a href="<?= base_url('priority/priority.php') ?>"><i class='fa fa-signal'></i> Priority</a></li> -->
            </ul>
        </div>
    </div>
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
                            <a class="dropdown-item" href="<?= base_url('auth/view_profile.php') ?>"><i class="fa fa-user pull-right"></i> Profile</a>
                            <a class="dropdown-item" href="<?= base_url('prioritas') ?>"><i class="fa fa-pie-chart pull-right"></i> Priority Assy GP</a>
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
        <div class="row">
            <div class="col-8">
                <h2>Checkout</h2>
            </div>
            <div class="col-4 mt-3">
                <div class="pull-right">

                    <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                        <span id="clock"></span>
                        <?php
                        $hari = date('l');
                        /*$new = date('l, F d, Y', strtotime($Today));*/
                        if ($hari == "Sunday") {
                            echo "Minggu";
                        } elseif ($hari == "Monday") {
                            echo "Senin";
                        } elseif ($hari == "Tuesday") {
                            echo "Selasa";
                        } elseif ($hari == "Wednesday") {
                            echo "Rabu";
                        } elseif ($hari == "Thursday") {
                            echo ("Kamis");
                        } elseif ($hari == "Friday") {
                            echo "Jum'at";
                        } elseif ($hari == "Saturday") {
                            echo "Sabtu";
                        }
                        ?>,

                        <?php
                        $tgl = date('d');
                        echo $tgl;
                        $bulan = date('F');
                        if ($bulan == "January") {
                            echo " Januari ";
                        } elseif ($bulan == "February") {
                            echo " Februari ";
                        } elseif ($bulan == "March") {
                            echo " Maret ";
                        } elseif ($bulan == "April") {
                            echo " April ";
                        } elseif ($bulan == "May") {
                            echo " Mei ";
                        } elseif ($bulan == "June") {
                            echo " Juni ";
                        } elseif ($bulan == "July") {
                            echo " Juli ";
                        } elseif ($bulan == "August") {
                            echo " Agustus ";
                        } elseif ($bulan == "September") {
                            echo " September ";
                        } elseif ($bulan == "October") {
                            echo " Oktober ";
                        } elseif ($bulan == "November") {
                            echo " November ";
                        } elseif ($bulan == "December") {
                            echo " Desember ";
                        }
                        $tahun = date('Y');
                        echo $tahun;
                        ?>
                </div>
            </div>
        </div>
        <!-- <div class="clearfix"></div> -->
        <div class="separator"></div>

        <!-- ============================ START FORM ============================ -->
        <div class="row ">
            <center>
                <div class="col-12 p-4" style="text-align: left;  border-radius: 0.25rem; background-color: white; box-shadow:0px 1px 5px rgba(0,0,0,0.8);">
                    <div class="row" style="font-size: 16px">
                        <!-- Hasil -->
                        <!-- Akhir Hasil -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
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
                td = tr[i].getElementsByTagName("td")[3];
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
<?php include('../../_footer.php');
} ?>