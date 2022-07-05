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
                <li class=""><a href="<?= base_url('staff/dashboard') ?>"><i class="fa fa-desktop"></i> Ratio Set</a></li>
                <li><a><i class="fa fa-edit"></i> Entry Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li class="active"><a> <i class="fa fa-cubes"></i> Inventory<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li class=""><a href="<?= base_url('staff/input_data/data.php') ?>">Daily</a></li>
                                <li class="active"><a href="<?= base_url('staff/input_data/dataacc.php') ?>">Accumulation</a></li>
                            </ul>
                        </li>
                        <!-- <li class=""><a href="<?= base_url('ng/data.php') ?>"><i class="fa fa-recycle"></i> No Good Cabinet</a></li> -->
                        <!-- <li class=""><a href="<?= base_url('plan/plan.php') ?>"><i class="fa fa-calendar-plus-o"></i> Plan</a></li> -->
                        <li class=""><a href="<?= base_url('staff/checkout/checkout.php') ?>"><i class="fa fa-shopping-cart"></i> Checkout</a></li>
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
                <h2>Entry Data | Inventory | Accumulation</h2>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                </div>
                                <div class="col-4">
                                    <div class="search" style="position: relative">
                                        <i class="fa fa-search" style="position: absolute; top: 10px; left: 14px;"></i>
                                        <input type="text" class="form-control mb-3" style="border-radius: 0.25rem; text-indent: 25px; border: 2px solid skyblue;" id="myInput" onkeyup="myFunction()" placeholder="search for cabinet.." title="Type in a name">
                                    </div>
                                </div>
                                <div class="disabled">
                                    <?php
                                    $today = 'mm/dd/yyyy';
                                    // Ada tanggal
                                    if (!empty($_SESSION['search_tanggal'])) {
                                    ?>
                                        <input hidden type="date" style="border-radius: 0.25rem; border: 2px solid skyblue;" name="multi_search_filter" id="multi_search_filter" value="<?php echo  $_SESSION['search_tanggal']  ?>" multiple class="form-control selectpicker">
                                        <input hidden type="hidden" name="hidden_date" id="hidden_date" />
                                    <?php
                                    } else {
                                        $_SESSION['search_tanggal'] = $today;
                                    ?>
                                        <input hidden type="date" style="border-radius: 0.25rem; border: 2px solid skyblue;" name="multi_search_filter" value="<?php echo  $_SESSION['search_tanggal']  ?>" id="multi_search_filter" multiple class="form-control selectpicker">
                                        <input hidden type="hidden" name="hidden_date" id="hidden_date" />
                                    <?php
                                    }
                                    ?>
                                    <div style="clear:both"></div>
                                </div>
                                <div id="bodyy">
                                    <div style="overflow-y: scroll; height: 300px;">
                                        <table style="font-size : 16px; border-radius: 0.25rem; border: 1px solid #ddd" id="myTable" class="table table-responsive tableFixHead">
                                            <thead style="background-color: #f1f1f1;">
                                                <tr>
                                                    <th style="width: 40px;text-align: center;">No</th>
                                                    <!-- <th style="width: 25%; text-align: center;">Updated</th> -->
                                                    <th style="width: 40%; text-align: center;">Cabinet</th>
                                                    <th style="width: 10%; text-align: center;">Dest</th>
                                                    <th style="width: 10%; text-align: center;">QTY NG</th>
                                                    <th style="width: 10%; text-align: center;">QTY</th>
                                                    <th style="width: 20%; text-align: center;">Act</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 0;
                                                // $qryy = mysqli_query($conn, "SELECT p.name_cabinet,p.name_piano,p.name_ori_cabinet, p.gmc_c, p.dest, p.qtyperunit as ratio, ng.pcs as ngpcs, i.pcs as ipcs FROM inventory_fix i JOIN bd_piano_fix p ON p.gmc_c = i.gmc_c JOIN inventory_ng ng ON p.name_cabinet = ng.name_cabinet WHERE i.pcs != 0 OR ng.pcs != 0 ORDER BY p.name_cabinet ASC");
                                                $qryy = mysqli_query($conn, "SELECT distinct(p.name_cabinet) as name_cabinet, p.gmc_c, p.dest, ng.pcs as ngpcs, i.pcs as ipcs FROM inventory_fix i JOIN bd_piano_fix p ON p.gmc_c = i.gmc_c JOIN inventory_ng ng ON p.name_cabinet = ng.name_cabinet WHERE i.pcs != 0 OR ng.pcs != 0 ORDER BY p.name_cabinet ASC;");

                                                while ($roww = mysqli_fetch_array($qryy)) {
                                                    $no++;
                                                    // $changeToQtyInven = $roww['iunit'] * $roww['ratio'];
                                                    // $changeToQtyNg = $roww['ngunit'] * $roww['ratio'];
                                                    // belum bisa menampilkan tulisan data not found ketika data kosong
                                                ?>
                                                    <tr>
                                                        <td style="text-align:center"><?= $no ?></td>
                                                        <!-- <td style="text-align: center;"><?= $roww['upd'] ?></td> -->
                                                        <td style="text-align: left;"><?= $roww['name_cabinet'] ?></td>
                                                        <td style="text-align: center;"><?= $roww['dest'] ?></td>
                                                        <td style="text-align: center;"><?= $roww['ngpcs'] ?></td>
                                                        <td style="text-align: center;"><?= $roww['ipcs'] ?></td>
                                                        <td style="text-align:center">
                                                            <a href="#" class="btn btn-warning btn btn-md" data-toggle="modal" data-target="#myModal<?php echo $no ?>"><i class="fa fa-recycle"></i></a>
                                                            <div class="modal fade" id="myModal<?php echo $no ?>" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Update NG Cabinet</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="POST" action="ngubah.php">
                                                                                <input type="hidden" name="gmc" value="<?= $roww['gmc_c'] ?>">
                                                                                <div class="form-group row">
                                                                                    <label for="kabinet" style="text-align: left;" class=" col-sm-5 col-form-label">Cabinet</label>
                                                                                    <div class="col-sm-7">
                                                                                        <input style="border-radius: 0.25rem; text-align: left " type="text" name="name_cabinet" class="form-control" value="<?= $roww['name_cabinet'] ?>" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <label for="ng" style="text-align: left;" class="col-sm-5 col-form-label">Status Update</label>
                                                                                    <div class="col-sm-7">
                                                                                        <div class="row">
                                                                                            <div class="col-auto mt-2">
                                                                                                <div class="form-check form-check-inline">
                                                                                                    <input class="form-check-input" type="radio" name="ng" value="notgood" id="notgoodd<?= $no  ?>" required>
                                                                                                    <label class="form-check-label" for="notgoodd<?= $no  ?>">Not Good</label>
                                                                                                </div>
                                                                                                <div class="form-check form-check-inline">
                                                                                                    <input class="form-check-input" type="radio" name="ng" value="repair" id="repair<?= $no  ?>" required>
                                                                                                    <label class="form-check-label" for="repair<?= $no  ?>">Repair</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="quantity" style="text-align: left;" class=" col-sm-5 col-form-label">Quantity</label>
                                                                                    <div class="col-sm-7">
                                                                                        <input type="number" style="border-radius: 0.25rem; text-align: center;" name="qty" min="1" class="form-control" required autofocus>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" data-target="ngubah.php" name="submit" class="btn btn-success">Update</button>
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
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
    include('../../_footer.php');
}
?>