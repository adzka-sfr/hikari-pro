<?php
include('../../../../../../../_header.php');
include('../../../app_name.php');
include('../../_config/pro_koneksi.php');
$_SESSION['jenis'] = 'case';
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
                                    <li class="dashboard"><a href="../dashboard/"><i class="fa fa-pencil"></i>Adjust Safety Stock</a></li>
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
                <script src="<?= base_url('_assets/src/add/sweetalert2.all.min.js') ?>"></script>
                <script src="<?= base_url('_assets/src/add/chartJS/chart.js') ?>"></script>

                <div class="row">
                    <center>
                        <div class="col-12 p-4" style="text-align: left;  border-radius: 0.25rem; background-color: white; box-shadow:0px 1px 5px rgba(0,0,0,0.8);">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="act_sf.php" method="POST">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-2">
                                                <label class="col-form-label">Model</label>
                                            </div>
                                            <div class="col-auto">
                                                <div class="btn-group">
                                                    <select id="kon" name="model_piano" style="width: 130px;">
                                                        <option value="" selected disabled>Pilih Model</option>
                                                        <?php
                                                        $sql_list = mysqli_query($conn, "SELECT DISTINCT nama_piano from piano_bd");
                                                        ?>
                                                        <?php while ($data_list = mysqli_fetch_array($sql_list)) {
                                                            echo '<option value="' . $data_list['nama_piano'] . '">' . $data_list['nama_piano'] . '</option>';
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center" style="margin-top: 1px;">
                                            <div class="col-2">
                                                <label class="col-form-label">Safety Stock</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="text" class="form-control" name="sf" id="sf" style="width: 130px; border-radius: 0.25rem; text-align: center;" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center" style="margin-top: 1px;">
                                            <div class="col-1">
                                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>

                <div class="row ">
                    <center>
                        <div class="col-12 p-4" style="text-align: left; margin-bottom: 50px;  border-radius: 0.25rem; background-color: white; box-shadow:0px 1px 5px rgba(0,0,0,0.8);">
                            <div class="row">
                                <div class="col-md-12">
                                    <canvas id="myChart" height="50"></canvas>
                                    <script>
                                        const labels = [<?php
                                                        $nama_sql = mysqli_query($conn, "SELECT nama_piano from ratio_set order by nama_piano asc limit 0,17");
                                                        while ($nama = mysqli_fetch_array($nama_sql)) {
                                                            echo "'" . strtoupper($nama['nama_piano']) . "',";
                                                        }
                                                        ?>];

                                        const data = {
                                            labels: labels,
                                            datasets: [{
                                                    type: 'bar',
                                                    label: 'Ratio Set',
                                                    data: [<?php
                                                            $bar_sql = mysqli_query($conn, "SELECT qty from ratio_set order by nama_piano asc limit 0,17");
                                                            while ($bar = mysqli_fetch_array($bar_sql)) {
                                                                echo "'" . round($bar['qty']) . "',";
                                                            }
                                                            ?>],
                                                    borderColor: 'rgb(255, 99, 132)',
                                                    backgroundColor: 'rgba(255, 99, 132, 0.2)'
                                                },
                                                {
                                                    type: 'line',
                                                    label: 'Safety Stock',
                                                    data: [<?php
                                                            $line_sql = mysqli_query($conn, "SELECT safety_stock from ratio_set order by nama_piano asc limit 0,17");
                                                            while ($line = mysqli_fetch_array($line_sql)) {
                                                                echo "'" . round($line['safety_stock']) . "',";
                                                            }
                                                            ?>],
                                                    fill: false,
                                                    borderColor: 'rgb(54, 162, 235)'
                                                }
                                            ]
                                        };

                                        const config = {
                                            type: 'line',
                                            data: data,
                                            options: {
                                                responsive: true,
                                                interaction: {
                                                    mode: 'index',
                                                    intersect: false,
                                                },
                                                stacked: false,
                                                scales: {
                                                    y: {
                                                        type: 'linear',
                                                        display: true,
                                                        position: 'left',
                                                    },
                                                }
                                            }
                                        };
                                    </script>

                                    <script>
                                        const myChart = new Chart(
                                            document.getElementById('myChart'),
                                            config
                                        );
                                    </script>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <canvas id="myChart2" height="50"></canvas>
                                    <script>
                                        const labels2 = [<?php
                                                            $nama_sql = mysqli_query($conn, "SELECT nama_piano from ratio_set order by nama_piano asc limit 17,50");
                                                            while ($nama = mysqli_fetch_array($nama_sql)) {
                                                                echo "'" . strtoupper($nama['nama_piano']) . "',";
                                                            }
                                                            ?>];

                                        const data2 = {
                                            labels: labels2,
                                            datasets: [{
                                                    type: 'bar',
                                                    label: 'Ratio Set',
                                                    data: [<?php
                                                            $bar_sql = mysqli_query($conn, "SELECT qty from ratio_set order by nama_piano asc limit 17,50");
                                                            while ($bar = mysqli_fetch_array($bar_sql)) {
                                                                echo "'" . round($bar['qty']) . "',";
                                                            }
                                                            ?>],
                                                    borderColor: 'rgb(255, 99, 132)',
                                                    backgroundColor: 'rgba(255, 99, 132, 0.2)'
                                                },
                                                {
                                                    type: 'line',
                                                    label: 'Safety Stock',
                                                    data: [<?php
                                                            $line_sql = mysqli_query($conn, "SELECT safety_stock from ratio_set order by nama_piano asc limit 17,34");
                                                            while ($line = mysqli_fetch_array($line_sql)) {
                                                                echo "'" . round($line['safety_stock']) . "',";
                                                            }
                                                            ?>],
                                                    fill: false,
                                                    borderColor: 'rgb(54, 162, 235)'
                                                }
                                            ]
                                        };

                                        const config2 = {
                                            type: 'line',
                                            data: data2,
                                            options: {
                                                responsive: true,
                                                interaction: {
                                                    mode: 'index',
                                                    intersect: false,
                                                },
                                                stacked: false,
                                                scales: {
                                                    y: {
                                                        type: 'linear',
                                                        display: true,
                                                        position: 'left',
                                                    },
                                                }
                                            }
                                        };
                                    </script>

                                    <script>
                                        const myChart2 = new Chart(
                                            document.getElementById('myChart2'),
                                            config2
                                        );
                                    </script>
                                </div>
                            </div>


                            <hr style="margin-bottom: 5px ;">
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
                $.getJSON("rem_cs.php", function(data) {
                    $("#rem").empty();
                    var no = 1;
                    $.each(data.result_rem, function() {
                        $("#rem").append("<tr><td>" + this['nama_piano'] + "</td><td style='text-align: right;'>" + this['rem_cs'] + "</td></tr>");
                    });
                });
            }

            function update_stck() {
                $.getJSON("stock_cs.php", function(data) {
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