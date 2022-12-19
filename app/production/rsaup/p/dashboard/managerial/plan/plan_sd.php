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
                                    <li><a><i class="fa fa-edit"></i> Entry Plan <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?= base_url('app/production/rsaup/p/dashboard/managerial/plan/plan_cs.php') ?>"><i class=" fa fa-calendar-plus-o"></i> Case</a></li>
                                            <li class="active"><a href="<?= base_url('app/production/rsaup/p/dashboard/managerial/plan/plan_sd.php') ?>"><i class=" fa fa-calendar-plus-o"></i> Side</a></li>
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
                            <h3 style="font-weight: bold;  margin-top: 0px; font-size: 18px; "><?= strtoupper($app_name) ?> - Set Plan Side</h3>
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
                        <div class="col-12 p-4" style="text-align: left; margin-bottom: 50px;  border-radius: 0.25rem; background-color: white; box-shadow:0px 1px 5px rgba(0,0,0,0.8);">
                            <div class="row">
                                <!-- content dropdown -->
                                <div class="col-12" style="text-align: left;">
                                    <div class="btn-group">
                                        <?php
                                        // set session awal
                                        if (empty($_SESSION['model_piano'])) {
                                            $_SESSION['model_piano'] = "B1 PE";
                                        }
                                        // jika ada change berdasarkan dropdown
                                        if (isset($_POST['model_piano'])) {
                                            $_SESSION['model_piano'] = $_POST['model_piano'];
                                        }
                                        ?>
                                        <form method="post">
                                            <select id="cari" name="model_piano" style="width: 150px;" onchange="this.form.submit();">
                                                <?php

                                                $sql_list = mysqli_query($conn, "SELECT DISTINCT nama_piano from piano_bd WHERE nama_piano NOT IN ('$_SESSION[model_piano]')");

                                                ?>
                                                <option disabled value="" selected>
                                                    <?php
                                                    echo $_SESSION['model_piano'];
                                                    ?>
                                                </option>
                                                <?php while ($data_list = mysqli_fetch_array($sql_list)) {
                                                    echo '<option value="' . $data_list['nama_piano'] . '">' . $data_list['nama_piano'] . '</option>';
                                                } ?>
                                            </select>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div class="row" style="font-size: 16px">
                                <!-- content diagram -->
                                <div class="col-12">
                                    <!-- ratio set -->
                                    <canvas id="myChart" height="70px"></canvas>
                                    <script src="../../js/cdnchart.min.js"></script>
                                    <script src="../../js/plugindatalabels.js"></script>
                                    <script>
                                        Chart.register(ChartDataLabels);
                                        const labels = [
                                            <?php
                                            $sql = mysqli_query($conn, "SELECT * FROM piano_bd pb JOIN cab_stock cs ON pb.gmc_kabinet = cs.gmc_kabinet WHERE pb.nama_piano = '$_SESSION[model_piano]' and pb.jenis = '$_SESSION[jenis]' order by cs.nama_tampil asc");
                                            while ($data = mysqli_fetch_array($sql)) {
                                                echo "'" . $data['nama_tampil'] . "',";
                                            }
                                            ?>
                                        ];
                                        const data = {
                                            labels: labels,
                                            datasets: [{
                                                label: 'Kabinet',
                                                color: '#fff',
                                                backgroundColor: ['rgb(54,162,235,0.50)'],
                                                borderColor: 'rgb(255,255,255)',
                                                borderWidth: 1,
                                                data: [
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM piano_bd pb JOIN cab_stock cs ON pb.gmc_kabinet = cs.gmc_kabinet WHERE pb.nama_piano = '$_SESSION[model_piano]' and pb.jenis = '$_SESSION[jenis]' order by cs.nama_tampil asc");
                                                    while ($data = mysqli_fetch_array($sql)) {
                                                        echo $data['qty'] . ",";
                                                    }
                                                    ?>
                                                ],
                                            }, ]
                                        };
                                        const config = {
                                            type: 'bar',
                                            data: data,
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
                                                            weight: "bold",
                                                        },
                                                        color: "#fff"
                                                    }
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
                                        const myChart = new Chart(
                                            document.getElementById('myChart'),
                                            config
                                        );
                                    </script>
                                </div>
                            </div>

                            <hr style="margin-bottom: 5px ;">

                            <div class="row">
                                <!-- Content pagination -->
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <center>
                                        <div class="pagination">
                                            <?php
                                            $k1 = date('d F', strtotime('-' . 4 . ' days'));
                                            for ($k = 0; $k < 7; $k++) {
                                                $k1 = date('d F', strtotime('+' . 1 . ' days', strtotime($k1)));
                                            ?>
                                                <a href="#" <?php
                                                            $now = date('d F');
                                                            if ($k1 == $now) {
                                                                echo 'class="active"';
                                                            }
                                                            ?> data-toggle="modal" data-target="#his<?= $k ?>"><?= $k1 ?></a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="his<?= $k ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Plan of <?= date('l, d F Y', strtotime($k1)) ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <?php
                                                            $sel = date('Y-m-d', strtotime($k1));
                                                            // cek apakah data plan tersedia atau tidak
                                                            $sql_ck = mysqli_query($conn, "SELECT * FROM plan WHERE tanggal = '$sel' and jenis = '$_SESSION[jenis]'");
                                                            $data_ck = mysqli_fetch_array($sql_ck);
                                                            if (empty($data_ck)) {
                                                            ?>
                                                                <div class="modal-body">
                                                                    <table class="table table-hover ">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Model</th>
                                                                                <th scope="col" style="text-align: right;">Plan</th>
                                                                                <th scope="col" style="text-align: right;">Achvd</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td colspan="4" style="text-align: center;">Data not found</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <div class="modal-body tableFixHead-3" style="padding-top: 0px; padding-bottom: 0px;">
                                                                    <table class="table table-hover ">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Model</th>
                                                                                <th scope="col" style="text-align: right; ">Plan</th>
                                                                                <th scope="col" style="text-align: right;">Achvd</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            // menampilkan data plan berdasarkan tanggal yang ditekan
                                                                            $sql_dp = mysqli_query($conn, "SELECT p.nama_piano as model, p.qty as plan, a.qty as acvd FROM plan p JOIN achieved a ON p.keytag = a.keytag where p.tanggal = '$sel' and p.jenis = '$_SESSION[jenis]'");
                                                                            while ($data_dp = mysqli_fetch_array($sql_dp)) {
                                                                            ?>
                                                                                <tr <?php
                                                                                    if ($_SESSION['model_piano'] == $data_dp['model']) {
                                                                                        echo ' style="font-weight: bold; font-size: 16px;"';
                                                                                    }
                                                                                    ?>>
                                                                                    <td><?= $data_dp['model'] ?></td>
                                                                                    <td style="text-align: right;"><?= $data_dp['plan'] ?></td>
                                                                                    <td style="text-align: right;"><?= $data_dp['acvd'] ?></td>
                                                                                </tr>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th scope="col">Total</th>
                                                                                <th scope="col" style="text-align: right;">
                                                                                    <?php
                                                                                    $sql_tplan = mysqli_query($conn, "SELECT SUM(qty) as total_plan FROM plan WHERE tanggal = '$sel' and jenis = '$_SESSION[jenis]'");
                                                                                    $data_tplan = mysqli_fetch_array($sql_tplan);
                                                                                    echo $data_tplan['total_plan'];
                                                                                    ?>
                                                                                    unit</th>
                                                                                <th scope="col" style="text-align: right;">
                                                                                    <?php
                                                                                    $sql_tachvd = mysqli_query($conn, "SELECT SUM(qty) as total_acvd FROM achieved WHERE tanggal = '$sel'  and jenis = '$_SESSION[jenis]'");
                                                                                    $data_tachvd = mysqli_fetch_array($sql_tachvd);
                                                                                    echo $data_tachvd['total_acvd'];
                                                                                    ?> unit</th>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>


                                        </div>
                                    </center>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="Resfresh" onclick="location.reload(true)">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                            </div>

                            <hr style="margin-top: 0px;">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="POST" id="fupForm" name="form1">
                                                <div class="alert alert-success " id="success">
                                                </div>
                                                <div class="alert alert-danger " id="duplicate">
                                                </div>
                                                <div class="alert alert-warning " id="yesterday">
                                                </div>
                                                <div class="alert alert-info " id="empty">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="p_type" id="p_type" value="side">
                                                    <label>Date</label>
                                                    <input type="date" name="p_date" class="form-control" id="tanggal">
                                                </div>
                                                <div class="form-group">
                                                    <label>Model</label>
                                                    <input type="email" name="p_model" id="p_model" class="form-control" value="<?= $_SESSION['model_piano'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Qty</label>
                                                    <input type="text" name="p_qty" id="p_qty" class="form-control" placeholder="Qty" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                </div>
                                                <div style="text-align: right;">
                                                    <button type="button submit" name="save" class="btn btn-success" id="butsave">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="vl"></div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2>History of <b> <?= $_SESSION['model_piano'] ?></b></h2>
                                            <hr style="margin: 0px ;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 tableFixHead-2">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="text-align: center;">Date</th>
                                                        <th scope="col" style="text-align: center;">Type</th>
                                                        <th scope="col" style="text-align: center;">Plan</th>
                                                        <th scope="col" style="text-align: center;">Achvd</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="side">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                        url: "add.php",
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
        <script>
            $(document).ready(function() {
                selesai();
            });

            function selesai() {
                setTimeout(function() {
                    update();
                    selesai();
                }, 200);
            }

            function update() {
                $.getJSON("data_sd.php", function(data) {
                    $("#side").empty();
                    var no = 1;
                    $.each(data.result, function() {
                        $("#side").append("<tr style ='padding-bottom : 0px; '><td>" + this['tanggal'] + "</td><td style='text-align:center'>" + this['jenis'] + "</td><td style='text-align:center'>" + this['plan'] + "</td><td style='text-align:center'>" + this['achieved'] + "</td></tr>");
                    });
                });
            }
        </script>

    <?php

    include('../../../../../../../_footer.php');
} ?>