<?php include('../../_header.php');
unset($_SESSION['search_tanggal']);
if ((!isset($_SESSION['id'])) || ($_SESSION['role'] !== "staff")) {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
} else {
?>

    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <ul class="nav side-menu">
                <li class="active"><a href="#"><i class="fa fa-desktop"></i> Ratio Set</a></li>
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
    <!-- /top navigation -->
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-8">
                <h2>Ratio Set GB Assy</h2>
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
        <div class="separator">
            <!--  -->
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="tile_count">
                                <!-- agar ada garis samping -->
                                <div hidden class="col-0">
                                    <div class="card"></div>
                                </div>
                                <!--  -->
                                <?php
                                $antrian = 0;
                                $sqlloop = mysqli_query($conn, "SELECT distinct(name_piano) as name_piano FROM bd_piano_fix ORDER BY name_piano desc");
                                while ($ambilloop = mysqli_fetch_array($sqlloop)) {
                                    $antrian++;
                                ?>
                                    <div class="col-md-4  tile_stats_count">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <span class="count_top"><i class="fa fa-music"></i> <b> <?= $ambilloop['name_piano'] ?></b> PIANO</span>
                                                        <?php
                                                        // $sql = mysqli_query($conn, "SELECT MIN(a.pcs) as pcs FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c where b.name_piano = '$ambilloop[name_piano]'");
                                                        $sql = mysqli_query($conn, "SELECT bdf.name_piano, MIN(inf.pcs/bdf.qtyperunit) as unit FROM inventory_fix inf JOIN `bd_piano_fix` bdf ON inf.gmc_c = bdf.gmc_c WHERE bdf.name_piano = '$ambilloop[name_piano]' GROUP by bdf.name_piano");

                                                        $row = mysqli_fetch_array($sql);
                                                        ?>
                                                        <div class="count"><?php echo floor($row['unit']) . ' unit'  ?></div>
                                                        <?php
                                                        $qryplan = mysqli_query($conn, "SELECT name_piano, SUM(qty) as qty, SUM(qtyCo) as qtyCo FROM planing WHERE name_piano = '$ambilloop[name_piano]' ");
                                                        $rowplan = mysqli_fetch_array($qryplan);
                                                        // ambil sisa dari plan - checkout dari dest dengan value terkecil
                                                        $aaaaa = $rowplan['qty'] - $rowplan['qtyCo'];
                                                        if ($rowplan['qty'] == NULL) {
                                                            $rowplan['qty'] = 0;
                                                        } else {
                                                            $rowplan['qty'];
                                                        }
                                                        ?>
                                                        <span class="count_bottom">
                                                            <i style="
                                                            <?php
                                                            if (floor($row['unit']) < $aaaaa) {
                                                                echo 'color:#E19494;background-color: #E3F9FE; padding: 2px; margin-right: 5px;border-radius: 0.15rem; text-align: center ';
                                                            } elseif (floor($row['unit']) > $aaaaa) {
                                                                echo 'color: #B0D9CD; background-color: #E3F9FE; padding: 2px; margin-right: 5px;border-radius: 0.15rem; text-align: center ';
                                                            } elseif (floor($row['unit']) == $aaaaa) {
                                                                echo 'color: #ffd700; background-color: #E3F9FE; padding: 2px; margin-right: 5px;border-radius: 0.15rem; text-align: center ';
                                                            }
                                                            ?>">
                                                                <?php
                                                                echo $aaaaa;
                                                                ?>
                                                            </i> Plan Not Yet Checkout
                                                        </span>
                                                    </div>
                                                    <div class="col-1"></div>
                                                    <div class="col-3" style="margin-top: 17px;">
                                                        <center>
                                                            <?php
                                                            if (floor($row['unit']) < $aaaaa) {
                                                                echo ' <div class="row mb-3">
                                                                <input type="color" value="#E19494" disabled>
                                                            </div>';
                                                            } elseif (floor($row['unit']) > $aaaaa) {
                                                                echo ' <div class="row mb-3">
                                                                <input type="color" value="#B0D9CD" disabled>
                                                            </div>';
                                                            } elseif (floor($row['unit']) == $aaaaa) {
                                                                echo ' <div class="row mb-3">
                                                                <input type="color" value="#ffd700" disabled>
                                                            </div>';
                                                            }
                                                            ?>
                                                            <a href=" #" type="button" data-toggle="modal" data-target="#myModal<?php echo $antrian ?>">
                                                                <span class="fa-stack">
                                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                                    <i class="fa fa-dashboard fa-stack-1x fa-inverse"></i>
                                                                </span>
                                                            </a>
                                                            <div class="modal fade" id="myModal<?php echo $antrian ?>" role="dialog">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Resume Kabinet Piano <?php echo $ambilloop['name_piano'] ?></h4>
                                                                            <button type="button" class="close" data-dismiss="modal">
                                                                                <span></span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="accordion mb-2" id="accordionExample">
                                                                                <div class="accordion-item">
                                                                                    <h2 class="accordion-header" id="headingOne1<?php echo $antrian ?>">
                                                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1<?php echo $antrian ?>" aria-expanded="true" aria-controls="collapseOne1<?php echo $antrian ?>">
                                                                                            Grafik Kabinet
                                                                                        </button>
                                                                                    </h2>
                                                                                    <div id="collapseOne1<?php echo $antrian ?>" class="accordion-collapse collapse show" aria-labelledby="headingOne1<?php echo $antrian ?>" data-bs-parent="#accordionExample">
                                                                                        <div class="accordion-body">
                                                                                            <div class="card mb-2">
                                                                                                <div class="card-body">
                                                                                                    <div class="row">
                                                                                                        <div class="col-12">
                                                                                                            <canvas id="myChart<?php echo $antrian ?>"></canvas>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <script src="cdnchart.min.js"></script>
                                                                                            <script src="plugindatalabels.js"></script>
                                                                                            <script>
                                                                                                Chart.register(ChartDataLabels);
                                                                                                const labels<?php echo $antrian ?> = [
                                                                                                    <?php
                                                                                                    $sql1 = mysqli_query($conn, "SELECT b.name_cabinet as name_cabinet, a.gmc_c, a.pcs FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c where b.name_piano = '$ambilloop[name_piano]' GROUP BY b.gmc_c ORDER BY b.dest, a.pcs asc");
                                                                                                    while ($data = mysqli_fetch_array($sql1)) {
                                                                                                        echo "'" . $data['name_cabinet'] . "'" . ",";
                                                                                                    }
                                                                                                    ?>
                                                                                                ];
                                                                                                const data<?php echo $antrian ?> = {
                                                                                                    labels: labels<?php echo $antrian ?>,
                                                                                                    datasets: [{
                                                                                                        label: 'Kabinet',
                                                                                                        color: '#fff',
                                                                                                        backgroundColor: ['rgb(54,162,235,0.50)'],
                                                                                                        borderColor: 'rgb(255,255,255)',
                                                                                                        borderWidth: 1,
                                                                                                        data: [
                                                                                                            <?php
                                                                                                            $sql = mysqli_query($conn, "SELECT b.name_cabinet, a.gmc_c, a.pcs as pcs FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c where b.name_piano = '$ambilloop[name_piano]' GROUP BY b.gmc_c ORDER BY dest, a.pcs asc");
                                                                                                            while ($data = mysqli_fetch_array($sql)) {
                                                                                                                echo $data['pcs'] . ",";
                                                                                                            }
                                                                                                            ?>
                                                                                                        ],
                                                                                                    }, ]
                                                                                                };
                                                                                                const config<?php echo $antrian ?> = {
                                                                                                    type: 'bar',
                                                                                                    data: data<?php echo $antrian ?>,
                                                                                                    options: {
                                                                                                        responsive: true,
                                                                                                        interaction: {
                                                                                                            mode: 'index',
                                                                                                            intersect: false,
                                                                                                        },
                                                                                                        plugins: {
                                                                                                            legend: {
                                                                                                                display: false,
                                                                                                            },
                                                                                                            datalabels: {
                                                                                                                font: {
                                                                                                                    weight: "bold"
                                                                                                                },
                                                                                                                color: "#fff"
                                                                                                            },
                                                                                                        },
                                                                                                        scales: {
                                                                                                            yAxes: [{
                                                                                                                ticks: {
                                                                                                                    min: 0
                                                                                                                }
                                                                                                            }]
                                                                                                        }
                                                                                                    },
                                                                                                };
                                                                                            </script>
                                                                                            <script>
                                                                                                const myChart<?php echo $antrian ?> = new Chart(
                                                                                                    document.getElementById('myChart<?php echo $antrian ?>'),
                                                                                                    config<?php echo $antrian ?>
                                                                                                );
                                                                                            </script>
                                                                                            <!-- end chart  -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12 mb-2">
                                                                                    <div class="card">
                                                                                        <div class="card-body">
                                                                                            <h5 style="color: black; text-align: center">
                                                                                                Destination G 130 - G 150 - G 200 <?php echo $ambilloop['name_piano'] ?>
                                                                                            </h5>
                                                                                            <div style="overflow-y: scroll; height: 300px; display: block">
                                                                                                <table style="font-size : 16px; border-radius: 0.25rem; border: 1px solid #ddd" id="myTable" class="table table-responsive tableFixHead">
                                                                                                    <thead style="background-color: #f1f1f1; text-align: center">
                                                                                                        <tr>
                                                                                                            <th>No</th>
                                                                                                            <th>Cabinet</th>
                                                                                                            <th>Dest</th>
                                                                                                            <th>Quantity(pcs)</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <?php
                                                                                                        $no = 0;
                                                                                                        $qry = mysqli_query($conn, "SELECT b.name_cabinet, a.gmc_c, a.pcs as pcs, b.dest as dest FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c where b.name_piano = '$ambilloop[name_piano]' GROUP BY b.gmc_c ORDER BY b.dest, a.pcs asc");
                                                                                                        while ($row = mysqli_fetch_array($qry)) {
                                                                                                            $no++;
                                                                                                            echo "
                                                                                                            <tr>
                                                                                                                <td style= 'text-align: center' >" . $no . "</td>
                                                                                                                <td>" . $row['name_cabinet'] . "</td>
                                                                                                                <td>" . $row['dest'] . "</td>
                                                                                                                <td style= 'text-align: center' >" . $row['pcs'] . "</td>
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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                        </center>
                                                    </div>
                                                    <div class="col-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pie Chart Jabatan -->
        <?php
        include('../../_footer.php');
    } ?>