<?php include('../../../../../_header.php'); ?>
<?php include('../koneksi.php') ?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <!-- <a style="padding-top: 5px;"> -->
                <!-- <h3 style="letter-spacing: 2px; padding-left: 50px;"><u><b>HIKARI</b></u></h3> -->
                <a href="<?= base_url('dashboard/') ?>" style="padding-top:15px; padding-left: 30px;"><img src="<?= base_url('_assets/production/images/yamaha_purple_no_waves.png') ?>" alt="logo_yamaha" height="30"></a>
                <!-- </a> -->
            </div>
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt=""><?php echo $_SESSION['nama'] ?>
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <!-- <a class="dropdown-item" href="index2.php" style="background-color: #DEEDFF;"> Fixing Frame</a> -->
                            <a class="dropdown-item" href="<?= base_url('dashboard/') ?>"> Dashboard</a>
                            <a class="dropdown-item" href="../"> Display</a>
                            <a class="dropdown-item" href="<?= base_url('panel/profile') ?>"> Profile</a>
                            <a class="dropdown-item" href="<?= base_url('panel/settings') ?>">Settings</a>
                            <a class="dropdown-item" href="<?= base_url('panel/help') ?>">Help</a>
                            <a class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- page content -->
    <div class="right_col" role="main">

        <div class="dashboard_graph" style="padding-bottom: 0px;">
            <div class="row">
                <div class="col-md-9">
                    <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 23px; color: #212529;">COMPATIBILITY MODEL</h2>
                </div>
                <div class="col-md-3">
                    <span style="text-align: right ; margin-top: 0px;">

                        <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                            <h2 style="color: #2A3F54; padding-right: 10px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun . " " ?><span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                    </span>
                </div>
            </div>
            <div class="separator" style="margin-bottom: 10px;"></div>
        </div>
        <div class="dashboard_graph" style="padding-top: 0px;">
            <div class="row">
                <div class="col-12">
                    <?php
                    $cekmax = mysqli_query($connect_cm, "SELECT MAX(tanggal) as maks from plan");
                    $dcekmax = mysqli_fetch_array($cekmax);
                    $mmx = $dcekmax['maks']; // 2022-08-31

                    // array untuk menyimpan informasi tabel berikutnya //
                    $k_date = array(); // tanggal, bisa di pake di semua tabel
                    $k_day = array(); // hari, bisa di pake di semua tabel
                    $b45_kplan = array();
                    $b44u20_kplan = array();
                    // array actual
                    $b45_kactual = array();
                    $b44_kactual = array();
                    $u20_kactual = array();
                    // array status
                    $b45_kstatus = array();
                    $b44_kstatus = array();
                    $u20_kstatus = array();

                    // array untuk menyimpan informasi tabel berikutnya //

                    $cpl = mysqli_query($connect_cm, "SELECT DISTINCT tanggal from plan order by tanggal");
                    $index = 0;
                    while ($data_cpl = mysqli_fetch_array($cpl)) {
                        // mengambil tanggal dan dimasukkan ke dalm array //
                        $k_date[$index] = $data_cpl['tanggal'];
                        $k_day[$index] = date('l', strtotime($data_cpl['tanggal']));

                        // mengambil tanggal hari besok, karena base nya b450
                        $cpl_date_tom = date('Y-m-d', strtotime('+1 days', strtotime($data_cpl['tanggal'])));
                        $plb45 = 0;

                        if ($data_cpl['tanggal'] == $mmx) {
                            $plb45 = 1;
                        }

                        // mengambil plan b450//
                        $cpl2 = mysqli_query($connect_cm, "SELECT count(tanggal) as plan_qty from plan where tanggal = '$cpl_date_tom'");
                        $datacpl2 = mysqli_fetch_array($cpl2);

                        // karena pada b450 mengambil plan keesokan harinya pada u200, oleh karena itu perlu dilakukan pengecekan apakah besokknya hari libur atau tidak
                        if ($datacpl2['plan_qty'] != 0) {
                            $plb45 = $datacpl2['plan_qty'];
                        } else {
                            while ($plb45 == 0) {
                                $cpl_date_tom = date('Y-m-d', strtotime('+1 days', strtotime($cpl_date_tom)));
                                $cpl2u = mysqli_query($connect_cm, "SELECT count(tanggal) as plan_qty from plan where tanggal = '$cpl_date_tom'");


                                $datacpl2u = mysqli_fetch_array($cpl2u);
                                if ($datacpl2u['plan_qty'] == 0) {
                                    $plb45 = 0;
                                } else {
                                    $plb45 = $datacpl2u['plan_qty'];
                                }
                            }
                        }
                        if ($plb45 == 1) {
                            $plb45 = 0;
                        }
                        $b45_kplan[$index] = $plb45;

                        // mengambil plan b440 dan u200 //
                        $sqlp44200 = mysqli_query($connect_cm, "SELECT count(tanggal) as plan_qty from plan where tanggal = '$data_cpl[tanggal]'");
                        $datap44200 = mysqli_fetch_array($sqlp44200);
                        $b44u20_kplan[$index] = $datap44200['plan_qty'];
                        $plb44u20 = $datap44200['plan_qty'];



                        // mengambil plan //


                        // mengambil actual //
                        $cal2 = mysqli_query($connect_cm, "SELECT * from hasil where tanggal = '$data_cpl[tanggal]'");
                        $cald2 = mysqli_fetch_array($cal2);

                        if (empty($cald2)) {
                            $actd245 = 0;
                            $actd244 = 0;
                            $actd220 = 0;
                            $b45_kactual[$index] = $actd245;
                            $b44_kactual[$index] = $actd244;
                            $u20_kactual[$index] = $actd220;
                        } else {
                            $actd245 = $cald2['b450'];
                            $actd244 = $cald2['b440'];
                            $actd220 = $cald2['u200'];
                            $b45_kactual[$index] = $cald2['b450'];
                            $b44_kactual[$index] = $cald2['b440'];
                            $u20_kactual[$index] = $cald2['u200'];
                        }
                        // mengambil actual //

                        // mengambil status //
                        $status45 =  $actd245 - $plb45;
                        $status44 = $actd244 - $plb44u20;
                        $status20 = $actd220 - $plb44u20;

                        // insert to array status
                        $b45_kstatus[$index] = $status45;
                        $b44_kstatus[$index] = $status44;
                        $u20_kstatus[$index] = $status20;
                        // mengambil status //

                        $index++;
                    }
                    $listofdate = count($k_date);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <div class="card w-100">
                        <div class="d-md-flex testimony-29101">
                            <div class="card-body">
                                <div id="main45" style="height:420px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5 ">
                    <div class="row">
                        <div class="col-6">
                            <h2>Data Schedule / Actual B450</h2>
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <!-- <a href="#" style="margin-left: 10px;" onclick="B45o()">Export to kntol Excel<i class="fa fa-file-excel-o" style="font-size: 25px; margin-left: 5px; margin-right: 15px;"></i></a> -->
                            <button type="button" class="btn btn-outline-success btn-sm" onclick="B45o()">Export to Excel<i class="fa fa-file-excel-o" style="font-size: 25px; margin-left: 5px;"></i></button>
                            <script>
                                var myWindow;

                                function B45o() {
                                    myWindow = window.open("export/b450.php", "_blank");
                                    setTimeout(B45c, 2000)
                                }

                                function B45c() {
                                    myWindow.close();
                                }
                            </script>
                        </div>
                    </div>
                    <hr style="margin-top: 0px; margin-bottom: 10px;">
                    <div class="row">
                        <div class="col-12 tableFixHead-4">
                            <table class="table table-bordered">
                                <thead style="text-align: center;">
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Plan</th>
                                    <th>Actual</th>
                                    <th>Status(+/-)</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $index = 0;
                                    $i = $listofdate;
                                    while ($i > 0) {
                                        if ($b45_kstatus[$index] > 0) {
                                            $warna = '#9C5700';
                                            $bg = '#FFEB9C';
                                        } elseif ($b45_kstatus[$index] < 0) {
                                            $warna = '#9C0006';
                                            $bg = '#FFC7CE';
                                        } else {
                                            $warna = '#006100';
                                            $bg = '#C6EFCE';
                                        } ?>
                                        <tr>
                                            <td style="width: 20%; text-align: center;"><?php echo $k_date[$index] ?></td>
                                            <td style="width: 20%;"><?php echo $k_day[$index] ?></td>
                                            <td style="text-align: center; width: 15%;"><?php echo $b45_kplan[$index] ?></td>
                                            <td style="text-align: center; width: 15%;"><?php echo $b45_kactual[$index] ?></td>
                                            <td style="text-align: center; width: 15%; font-weight: bold; background-color: <?= $bg ?>; color: <?= $warna ?>;"><?php
                                                                                                                                                                if ($b45_kstatus[$index] > 0) {
                                                                                                                                                                    echo "+" . $b45_kstatus[$index];
                                                                                                                                                                } elseif ($b45_kstatus[$index] < 0) {
                                                                                                                                                                    echo $b45_kstatus[$index];
                                                                                                                                                                } else {
                                                                                                                                                                    echo $b45_kstatus[$index];
                                                                                                                                                                }
                                                                                                                                                                ?></td>
                                        </tr>
                                    <?php
                                        $i--;
                                        $index++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator" style="margin-bottom: 20px;"></div>

            <div class="row">
                <div class="col-7">
                    <div class="card w-100">
                        <div class="d-md-flex testimony-29101">
                            <div class="card-body">
                                <div id="main44" style="height:420px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-6">
                            <h2>Data Schedule / Actual B440</h2>
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <!-- <a href="#" style="margin-left: 10px;" onclick="B44o()">Export to Excel<i class="fa fa-file-excel-o" style="font-size: 25px; margin-left: 5px; margin-right: 15px;"></i></a> -->
                            <button type="button" class="btn btn-outline-success btn-sm" onclick="B44o()">Export to Excel<i class="fa fa-file-excel-o" style="font-size: 25px; margin-left: 5px;"></i></button>
                            <script>
                                var myWindow;

                                function B44o() {
                                    myWindow = window.open("export/b440.php", "_blank");
                                    setTimeout(B44c, 2000)
                                }

                                function B44c() {
                                    myWindow.close();
                                }
                            </script>
                        </div>
                    </div>
                    <hr style="margin-top: 0px; margin-bottom: 10px;">
                    <div class="row">
                        <div class="col-12 tableFixHead-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr style="background-color: #1890ff;">
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Status(+/-)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $index = 0;
                                    $i = $listofdate;
                                    while ($i > 0) {
                                        if ($b44_kstatus[$index] > 0) {
                                            $warna = '#9C5700';
                                            $bg = '#FFEB9C';
                                        } elseif ($b44_kstatus[$index] < 0) {
                                            $warna = '#9C0006';
                                            $bg = '#FFC7CE';
                                        } else {
                                            $warna = '#006100';
                                            $bg = '#C6EFCE';
                                        }
                                    ?>
                                        <tr>
                                            <td style="width: 20%; text-align: center;"><?php echo $k_date[$index] ?></td>
                                            <td style="width: 20%;"><?php echo $k_day[$index] ?></td>
                                            <td style="text-align: center; width: 15%;"><?php echo $b44u20_kplan[$index] ?></td>
                                            <td style="text-align: center; width: 15%;"><?php echo $b44_kactual[$index] ?></td>
                                            <td style="text-align: center; width: 15%; font-weight: bold; background-color: <?= $bg ?>; color: <?= $warna ?>;"><?php
                                                                                                                                                                if ($b44_kstatus[$index] > 0) {
                                                                                                                                                                    echo "+" . $b44_kstatus[$index];
                                                                                                                                                                } elseif ($b44_kstatus[$index] < 0) {
                                                                                                                                                                    echo $b44_kstatus[$index];
                                                                                                                                                                } else {
                                                                                                                                                                    echo $b44_kstatus[$index];
                                                                                                                                                                }
                                                                                                                                                                ?></td>
                                        </tr>
                                    <?php
                                        $i--;
                                        $index++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator" style="margin-bottom: 20px;"></div>

            <div class="row">
                <div class="col-7">
                    <div class="card w-100">
                        <div class="d-md-flex testimony-29101">
                            <div class="card-body">
                                <div id="main20" style="height:420px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5 ">
                    <div class="row">
                        <div class="col-6">
                            <h2>Data Schedule / Actual U200</h2>
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <!-- <a href="#" style="margin-left: 10px;" onclick="U20o()">Export to Excel<i class="fa fa-file-excel-o" style="font-size: 25px; margin-left: 5px; margin-right: 15px;"></i></a> -->
                            <button type="button" class="btn btn-outline-success btn-sm" onclick="U20o()">Export to Excel<i class="fa fa-file-excel-o" style="font-size: 25px; margin-left: 5px;"></i></button>
                            <script>
                                var myWindow;

                                function U20o() {
                                    myWindow = window.open("export/u200.php", "_blank");
                                    setTimeout(U20c, 2000)
                                }

                                function U20c() {
                                    myWindow.close();
                                }
                            </script>
                        </div>
                    </div>
                    <hr style="margin-top: 0px; margin-bottom: 10px;">
                    <div class="row">
                        <div class="col-12 tableFixHead-4">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Plan</th>
                                    <th>Actual</th>
                                    <th>Status(+/-)</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $index = 0;
                                    $i = $listofdate;
                                    while ($i > 0) {
                                        if ($u20_kstatus[$index] > 0) {
                                            $warna = '#9C5700';
                                            $bg = '#FFEB9C';
                                        } elseif ($u20_kstatus[$index] < 0) {
                                            $warna = '#9C0006';
                                            $bg = '#FFC7CE';
                                        } else {
                                            $warna = '#006100';
                                            $bg = '#C6EFCE';
                                        }
                                    ?>
                                        <tr>
                                            <td style="width: 20%; text-align: center;"><?php echo $k_date[$index] ?></td>
                                            <td style="width: 20%;"><?php echo $k_day[$index] ?></td>
                                            <td style="text-align: center; width: 15%;"><?php echo $b44u20_kplan[$index] ?></td>
                                            <td style="text-align: center; width: 15%;"><?php echo $u20_kactual[$index] ?></td>
                                            <td style="text-align: center; font-weight: bold; width: 15%; background-color:  <?= $bg ?>; color: <?= $warna ?>;"><?php
                                                                                                                                                                if ($u20_kstatus[$index] > 0) {
                                                                                                                                                                    echo "+" . $u20_kstatus[$index];
                                                                                                                                                                } elseif ($u20_kstatus[$index] < 0) {
                                                                                                                                                                    echo $u20_kstatus[$index];
                                                                                                                                                                } else {
                                                                                                                                                                    echo $u20_kstatus[$index];
                                                                                                                                                                }
                                                                                                                                                                ?></td>
                                        </tr>
                                    <?php
                                        $i--;
                                        $index++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator" style="margin-top: 50px;"></div>

            <span for="Logic untuk grafik">
                <?php
                $index = 0; // untuk index array
                $label_a = array(); // array untuk label
                $p_a = array(); // array plan 45
                $a_a = array(); // array actual 45
                $r_a = array(); // array remaining 45

                $p_b = array(); // array plan 44
                $a_b = array(); // array actual 44
                $r_b = array(); // array remaining 44

                $p_c = array(); // array plan 20
                $a_c = array(); // array actual 20
                $r_c = array(); // array remaining 20

                // melakukan pengecekan data paling banyak
                $dm1 = mysqli_query($connect_cm, "SELECT MAX(tanggal) as maks from plan");
                $dm = mysqli_fetch_array($dm1);
                $tgl_plan_max = $dm['maks'];
                // melakukan pengecekan data paling banyak

                for ($i = 10; $i >= 0; $i--) { // untuk menentukan seberapa banyak data kebelakang yang akan ditampilkan -> next kalau bisa yang ditampilkan
                    $tgl = date('Y-m-d', strtotime('-' . $i . ' days')); // deklarasi tanggal pada perulangan pertama
                    $hari = date('D', strtotime($tgl));
                    $plan = 0; // untuk menyimpan nilai plan pada suatu hari sebelum dimasukkan ke dalam array

                    // melakukan cek apakah hari yang dimaksud ada pekerjaan atau tidak, karena base utamanya adalah berdasarkan hasil pekerjaan
                    // kemudian baru dilakukan cek plan pada hari tersebut
                    $sql_hasil = mysqli_query($connect_cm, "SELECT * from hasil where tanggal = '$tgl'");
                    $data_hasil = mysqli_fetch_array($sql_hasil);


                    if (!empty($data_hasil)) { // melakukan cek pada hari yang maksud ada pekerjaan atau tidak, jika ada maka tanggal tersebut ditampilkan sebagai label x dan diambil plan nya
                        $hasilb45 = $data_hasil['b450'];
                        $hasilb40 = $data_hasil['b440'];
                        $hasilu20 = $data_hasil['u200'];

                        // batas atas mengambil plan (b440 == 200)
                        $splf = mysqli_query($connect_cm, "SELECT COUNT(tanggal) as plan_qty from plan where tanggal = '$data_hasil[tanggal]'");
                        $splfd = mysqli_fetch_array($splf);
                        $planf = $splfd['plan_qty'];
                        // batas bawah mengambil plan (b440 == 200)

                        // batas atas mengambil plan (b450)
                        $tgl_tom = date('Y-m-d', strtotime('+1 days', strtotime($tgl))); // mengambil hari esok

                        $spl = mysqli_query($connect_cm, "SELECT COUNT(tanggal) as plan_qty from plan where tanggal = '$tgl_tom'"); // menghitung jumlah plan pada hari yg dimaksud (b450)
                        $spld = mysqli_fetch_array($spl);

                        // pengecekan apakah nilai yang dikembalikan null atu tidak
                        // jika nilai null maka akan di kasih nilai default 0
                        if ($spld['plan_qty'] == 0) {
                            $plan = 0;
                        } else {
                            $plan = $spld['plan_qty'];
                        }

                        // jika tanggal perulangan sama dengan tanggal maksimal pada plan maka dikasih nilai default untuk plan yaitu 1jt
                        if ($tgl == $tgl_plan_max) {
                            $plan = 1000000;
                        }
                        if ($hari != 'Sat' and $hari != 'Sun') { // dilakukan pengecekan jika hari adalah sabtu dan minggu maka plan akan tetap 0 atau tidak diusahakan di hari berikutnya

                            if ($plan == 0) {
                                while ($plan == 0) {
                                    $tgl_tom = date('Y-m-d', strtotime('+1 days', strtotime($tgl_tom)));
                                    $spl2 = mysqli_query($connect_cm, "SELECT COUNT(tanggal) as plan_qty from plan where tanggal = '$tgl_tom'");
                                    $spld2 = mysqli_fetch_array($spl2);

                                    if ($spld2['plan_qty'] == 0) {
                                        $plan = 0;
                                    } else {
                                        $plan = $spld2['plan_qty'];
                                    }

                                    if ($tgl_tom == $tgl_plan_max) {
                                        $plan == 1000000;
                                    }
                                }
                            }
                        }

                        if ($plan == 1000000) {
                            $plan == 0;
                        }

                        // batas akhir mengambil plan

                        // insert data ke array b450 //
                        $remaining = $plan - $hasilb45;
                        if ($remaining <= 0) {
                            $remaining = 0;
                        }

                        $p_a[$index] = $plan;
                        $a_a[$index] = $hasilb45;
                        $r_a[$index] = $remaining;
                        // insert data ke array b450 //

                        // insert data ke array b440 //
                        $remainingf = $planf - $hasilb40;
                        if ($remainingf <= 0) {
                            $remainingf = 0;
                        }

                        $p_b[$index] = $planf;
                        $a_b[$index] = $hasilb40;
                        $r_b[$index] = $remainingf;
                        // insert data ke array b440 //

                        // insert data ke array b440 //
                        $remainingf2 = $planf - $hasilu20;
                        if ($remainingf2 <= 0) {
                            $remainingf2 = 0;
                        }

                        $p_c[$index] = $planf;
                        $a_c[$index] = $hasilu20;
                        $r_c[$index] = $remainingf2;
                        // insert data ke array b440 //

                        // memasukkan data hasil perulangan ke array untuk hasil dari b440 dan u200 -> done
                        // membuat tabel resume dari grafik -> satu bulan kayaknya bagus datanya
                        // tabel resume berisi salah satunya apakah pada hari tersebut actual plus atau minus

                        // label
                        $lb_a = date('D, d-M', strtotime($tgl));
                        $label_a[$index] = $lb_a;

                        $index++;
                    }
                }
                ?>
            </span>
            <script type="text/javascript">
                // Initialize the echarts instance based on the prepared dom
                var b450 = echarts.init(document.getElementById('main45'));
                var b440 = echarts.init(document.getElementById('main44'));
                var u200 = echarts.init(document.getElementById('main20'));

                // Specify the configuration items and data for the chart
                opb450 = {
                    color: ['#f5222d', '#91ca8c', '#eedd78'],
                    title: {
                        text: 'Plan vs Actual B450',
                        subtext: <?php
                                    $updated = date('h:i:s d-m-Y');
                                    echo "'Updated " . $updated . "'";
                                    ?>
                    },
                    subtextStyle: {
                        fontStyle: 'italic'
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    toolbox: {
                        feature: {
                            restore: {
                                show: true
                            },
                            saveAsImage: {
                                show: true
                            }
                        }
                    },
                    legend: {
                        top: 'bottom',
                    },
                    grid: {
                        left: '5%',
                        right: '4%',
                        containLabel: false
                    },
                    xAxis: [{
                        type: 'category',
                        axisLabel: {
                            fontSize: 10,
                            rotate: 20
                        },
                        data: [
                            '<?php
                                echo implode("','", $label_a);
                                ?>'
                        ]
                    }],
                    yAxis: [{
                        type: 'value'
                    }],
                    series: [{
                            name: 'Plan',
                            type: 'line',
                            // label: {
                            //     show: true
                            // },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [
                                <?php
                                echo implode(",", $p_a);
                                ?>
                            ]
                        },
                        {
                            name: 'Actual',
                            type: 'bar',
                            stack: 'Ad',
                            label: {
                                show: true
                            },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [
                                <?php
                                echo implode(",", $a_a);
                                ?>
                            ]
                        },
                        {
                            name: 'Remaining',
                            type: 'bar',
                            stack: 'Ad',
                            label: {
                                show: true
                            },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [
                                <?php
                                echo implode(",", $r_a);
                                ?>
                            ]
                        }
                    ]
                };

                opb440 = {
                    color: ['#f5222d', '#7289ab', '#eedd78'],
                    title: {
                        text: 'Plan vs Actual B440',
                        subtext: <?php
                                    $updated = date('h:i:s d-m-Y');
                                    echo "'Updated " . $updated . "'";

                                    ?>
                    },
                    subtextStyle: {
                        fontStyle: 'italic'
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    toolbox: {
                        feature: {
                            restore: {
                                show: true
                            },
                            saveAsImage: {
                                show: true
                            }
                        }
                    },
                    legend: {
                        top: 'bottom',
                    },
                    grid: {
                        left: '5%',
                        right: '4%',
                        containLabel: false
                    },
                    xAxis: [{
                        type: 'category',
                        axisLabel: {
                            fontSize: 10,
                            rotate: 20
                        },
                        data: [
                            '<?php
                                echo implode("','", $label_a);
                                ?>'
                        ]
                    }],
                    yAxis: [{
                        type: 'value'
                    }],
                    series: [{
                            name: 'Plan',
                            type: 'line',
                            // label: {
                            //     show: true
                            // },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [
                                <?php
                                echo implode(",", $p_b);
                                ?>
                            ]
                        },
                        {
                            name: 'Actual',
                            type: 'bar',
                            stack: 'Ad',
                            label: {
                                show: true
                            },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [
                                <?php
                                echo implode(",", $a_b);
                                ?>
                            ]
                        },
                        {
                            name: 'Remaining',
                            type: 'bar',
                            stack: 'Ad',
                            label: {
                                show: true
                            },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [
                                <?php
                                echo implode(",", $r_b);
                                ?>
                            ]
                        }
                    ]
                };

                opu200 = {
                    color: ['#f5222d', '#759aa0', '#eedd78'],
                    title: {
                        text: 'Plan vs Actual U200',
                        subtext: <?php
                                    $updated = date('h:i:s d-m-Y');
                                    echo "'Updated " . $updated . "'";

                                    ?>
                    },
                    subtextStyle: {
                        fontStyle: 'italic'
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    toolbox: {
                        feature: {
                            restore: {
                                show: true
                            },
                            saveAsImage: {
                                show: true
                            }
                        }
                    },
                    legend: {
                        top: 'bottom',
                    },
                    grid: {
                        left: '5%',
                        right: '4%',
                        containLabel: false
                    },
                    xAxis: [{
                        type: 'category',
                        axisLabel: {
                            fontSize: 10,
                            rotate: 20
                        },
                        data: [
                            '<?php
                                echo implode("','", $label_a);
                                ?>'
                        ]
                    }],
                    yAxis: [{
                        type: 'value'
                    }],
                    series: [{
                            name: 'Plan',
                            type: 'line',
                            // label: {
                            //     show: true
                            // },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [
                                <?php
                                echo implode(",", $p_c);
                                ?>
                            ]
                        },
                        {
                            name: 'Actual',
                            type: 'bar',
                            stack: 'Ad',
                            label: {
                                show: true
                            },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [
                                <?php
                                echo implode(",", $a_c);
                                ?>
                            ]
                        },
                        {
                            name: 'Remaining',
                            type: 'bar',
                            stack: 'Ad',
                            label: {
                                show: true
                            },
                            emphasis: {
                                focus: 'series'
                            },
                            data: [
                                <?php
                                echo implode(",", $r_c);
                                ?>
                            ]
                        }
                    ]
                };

                // Display the chart using the configuration items and data just specified.
                b450.setOption(opb450);
                b440.setOption(opb440);
                u200.setOption(opu200);
            </script>
        </div>

    </div>
    <!-- /page content -->

    <?php
    include('../_footer_local.php');
    include('../../../../../_footer.php'); ?>