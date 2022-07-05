<?php
include('../_header.php');
error_reporting(0);
?>

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li class=""><a href="<?= base_url('dashboard') ?>"><i class="fa fa-desktop"></i> Dashboard</a></li>
            <li><a><i class="fa fa-edit"></i> Data Input <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li class="active"><a href="<?= base_url('input_data/data.php') ?>"><i class="fa fa-cubes"></i> Inventory</a></li>
                    <li class=""><a href="<?= base_url('plan/plan.php') ?>"><i class="fa fa-calendar-plus-o"></i> Plan</a></li>
                </ul>
            </li>
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
                        <a class="dropdown-item" href="<?= base_url('landing_page.php') ?>"><i class="fa fa-pie-chart pull-right"></i> Rasio Set Assy GP</a>
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
            <h2>Data Input | Inventory</h2>
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
        <div class="card">
            <div class="card-body">
                <center>
                    <div class="col-12 p-4" style="text-align: left;  border-radius: 0.25rem; background-color: white; box-shadow:0px 1px 5px rgba(0,0,0,0.8);">
                        <div class="row" style="font-size: 16px">
                            <div class="card mb-1">
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        $qry = mysqli_query($conn, "SELECT count(id_plan) as antrian FROM planing");
                                        $result = mysqli_fetch_array($qry);
                                        $antrian = $result['antrian'] + 1;
                                        ?>
                                        <div class="col-6">
                                            <form action="add.php" method="POST">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row" style="text-align: left;">
                                                            <label for="tanggal" class="col-sm-5 col-form-label">Date</label>
                                                            <div class="col-sm-7">
                                                                <?php
                                                                $date = new DateTime(); // Date object using current date and time
                                                                $dt = $date->format('Y-m-d\TH:i:s');
                                                                ?>
                                                                <input type="datetime-local" value="<?php echo $dt ?>" style="border-radius: 0.25rem;  text-align: left" step=1 class="form-control" id="tanggal" name="tanggal" readonly required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="name_kabinet" class="col-sm-5 col-form-label">Kabinet Piano</label>
                                                            <div class="col-sm-7">
                                                                <select id="provinsi" style="text-align: left;" name="name_kabinet" class="wia-filter-value selectpicker show-tick form-control" data-live-search="true" aria-label="Default select example" required>
                                                                    <option type="hidden" selected></option>
                                                                    <?php
                                                                    $query = mysqli_query($conn, "SELECT distinct(name_kabinet) as name_kabinet FROM inventory ORDER BY name_kabinet asc");
                                                                    while ($row = mysqli_fetch_array($query)) {
                                                                    ?>
                                                                        <option value="<?php echo $row['name_kabinet']; ?>"><?php echo $row['name_kabinet']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" style="text-align: left;">
                                                            <label for="qty" class="col-sm-5 col-form-label">Quantity</label>
                                                            <div class="col-sm-7">
                                                                <input type="number" style="border-radius: 0.25rem;  text-align: center" class="form-control" id="qty" name="qty" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="tambah" data-bs-target="#exampleModalToggle" class="btn btn-success">Add</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#provinsi').select2();
                                                });
                                            </script>
                                        </div>
                                        <div class="col-3"></div>
                                        <div class="col-3">
                                            <?php
                                            $today = date('Y-m-d');
                                            // Ada tanggal
                                            if (!empty($_SESSION['search_tanggal'])) {
                                            ?>
                                                <input type="date" style="border-radius: 0.25rem;" name="multi_search_filter" id="multi_search_filter" value="<?php echo  $_SESSION['search_tanggal']  ?>" multiple class="form-control selectpicker">
                                                <input type="hidden" name="hidden_date" id="hidden_date" />
                                            <?php
                                            } else {
                                                $_SESSION['search_tanggal'] = $today;
                                            ?>
                                                <input type="date" style="border-radius: 0.25rem;" name="multi_search_filter" value="<?php echo  $_SESSION['search_tanggal']  ?>" id="multi_search_filter" multiple class="form-control selectpicker">
                                                <input type="hidden" name="hidden_date" id="hidden_date" />
                                            <?php
                                            }
                                            ?>
                                            <div style="clear:both"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hasil -->
                            <!-- Akhir Hasil -->
                            <div class="card">
                                <div class="card-body">
                                    <div id="body">
                                    </div>
                                </div>
                            </div>
                        </div>
                </center>
            </div>
        </div>
    </div>
</div>
<!-- ============================ END FORM ============================ -->
</div>
<?php include('../_footerr.php'); ?>