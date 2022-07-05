<?php include('../_header.php');
if (!isset($_SESSION['id'])) {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
}
unset($_SESSION['search_tanggal']);
?>

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li class="active"><a><i class="fa fa-desktop"></i> Rasio Set</a></li>
            <li><a><i class="fa fa-edit"></i> Data Input <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li class=""><a href="<?= base_url('input_data/data.php') ?>"><i class="fa fa-cubes"></i> Inventory</a></li>
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
<!-- /top navigation -->
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-8">
            <h2>Rasio Set</h2>
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
    <div class="separator">
        <div class="row">
            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <form method="post">
                                <div class="row">
                                    <div class="col-10">
                                        <select name="name_piano" style="border-radius: 0.25rem" required id="name_piano" class="form-select" aria-label="Default select example">
                                            <!-- pake switch sesuai value yang di dapat dari dropdown button -->
                                            <?php
                                            $nama_pianoq = mysqli_query($conn, "SELECT distinct name_piano from model_kabinet_fixed GROUP BY gmc");
                                            ?>

                                            <?php
                                            while ($nama_piano = mysqli_fetch_array($nama_pianoq)) {
                                            ?>
                                                <!-- untuk mendapatkan nilai dari variabel pada php untuk ditampilkan di value harus ada echo nya  -->
                                                <option value="<?= $nama_piano['name_piano'] ?>"><?php echo $nama_piano['name_piano']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-success" name="select">Select</button>
                                    </div>
                                </div>
                            </form>
                        </center>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['select'])) {
            $_SESSION['piano_name'] = $_POST['name_piano'];
            $simpan_piano = $_SESSION['piano_name'];
        }
        ?>
        <div class="row">
            <div class="col-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 style="color: black; text-align: center">
                            Destionation G0
                            <?php
                            if (!empty($_SESSION['piano_name'])) {
                                echo ' From <b>' . $_SESSION['piano_name'] . '</b>';
                            } else {
                                echo ' From All Piano';
                            }
                            ?>
                        </h5>
                        <div style="overflow-y: scroll; height: 300px; display: block">
                            <table style="font-size : 16px; border-radius: 0.25rem; border: 1px solid #ddd" id="myTable" class="table table-responsive tableFixHead">
                                <thead style="background-color: #f1f1f1; text-align: center">
                                    <tr>
                                        <th>No</th>
                                        <th>Kabinet</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    $qry = mysqli_query($conn, "SELECT b.name_kabinet as name_kabinet, a.gmc as gmc, a.qty as qty FROM inventory a INNER JOIN model_kabinet_fixed b ON a.gmc = b.gmc where b.name_piano = '$simpan_piano' and a.destination = 'G0' GROUP BY b.gmc ORDER BY qty desc");
                                    while ($row = mysqli_fetch_array($qry)) {
                                        $no++;
                                        echo "
                                    <tr>
                                        <td style= 'text-align: center' >" . $no . "</td>
                                        <td>" . $row['name_kabinet'] . "</td>
                                        <td style= 'text-align: center' >" . $row['qty'] . "</td>
                                    </tr>
                                    ";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 style="color: black; text-align: center">
                            Destionation G2
                            <?php
                            if (!empty($_SESSION['piano_name'])) {
                                echo ' From  <b>' . $_SESSION['piano_name'] . '</b>';
                            } else {
                                echo ' From All Piano';
                            }
                            ?>
                        </h5>
                        <div style="overflow-y: scroll; height: 300px; display: block">
                            <table style="font-size : 16px; border-radius: 0.25rem; border: 1px solid #ddd" id="myTable" class="table table-responsive tableFixHead">
                                <thead style="background-color: #f1f1f1; text-align: center">
                                    <tr>
                                        <th>No</th>
                                        <th>kabinet</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    $qty = mysqli_query($conn, "SELECT b.name_kabinet as name_kabinet, a.gmc as gmc, a.qty as qty FROM inventory a INNER JOIN model_kabinet_fixed b ON a.gmc = b.gmc where b.name_piano = '$simpan_piano' and a.destination = 'G2' GROUP BY b.gmc ORDER BY qty desc");
                                    while ($row = mysqli_fetch_array($qty)) {
                                        $no++;
                                        echo "
                                    <tr>
                                        <td style= 'text-align: center' >" . $no . "</td>
                                        <td>" . $row['name_kabinet'] . "</td>
                                        <td style= 'text-align: center' >" . $row['qty'] . "</td>
                                    </tr>
                                    ";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../_footer.php'); ?>