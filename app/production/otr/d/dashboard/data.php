<?php
include('../../../../../_header.php');
include('../app_name.php');
include('koneksi.php');

// data show sesuai dengan grafik yang di chat
$dataget = explode("+", $_GET['model']);
$dat_status = $dataget[0];
$dat_series = $dataget[1];

switch ($dat_status) {
    case "< 2 hours":
        $taser = "<u>Less</u> than 2 hours";
        $warna = '#9C0006';
        $bg = '#FFC7CE';
        $status = "NOT READY";

        $dat_qc = mysqli_query($con_pro, "SELECT * from to_ongoing_slip where kategori = '$dat_series' and time_out >= '$now'");
        $dat_q = mysqli_query($con_pro, "SELECT * from to_ongoing_slip where kategori = '$dat_series' and time_out >= '$now'");
        break;

    case "> 2 hours":
        $taser = "<u>More</u> than 2 hours";
        $dat_waktu = date('Y-m-d H:i:s', strtotime('-2 hours'));
        $warna = '#006100';
        $bg = '#C6EFCE';
        $status = "READY";

        $dat_qc = mysqli_query($con_pro, "SELECT * from to_ongoing_slip where kategori = '$dat_series' and time_in < '$dat_waktu'");
        $dat_q = mysqli_query($con_pro, "SELECT * from to_ongoing_slip where kategori = '$dat_series' and time_in < '$dat_waktu'");
        break;

    case "< 16 hours":
        $taser = "<u>Less</u> than 16 hours";
        $warna = '#9C0006';
        $bg = '#FFC7CE';
        $status = "NOT READY";

        $dat_qc = mysqli_query($con_pro, "SELECT * from ongoing_slip where kategori = '$dat_series' and time_out >= '$now'");
        $dat_q = mysqli_query($con_pro, "SELECT * from ongoing_slip where kategori = '$dat_series' and time_out >= '$now'");
        break;

    case "> 16 hours & < 3 days":
        $taser = "<u>More</u> than 16 hours & <u>Less</u> 3 days";
        $dat_waktu = date('Y-m-d H:i:s', strtotime('-16 hours'));
        $dat_waktu2 = date('Y-m-d H:i:s', strtotime('-3 days'));
        $warna = '#006100';
        $bg = '#C6EFCE';
        $status = "READY";

        $dat_qc = mysqli_query($con_pro, "SELECT * from ongoing_slip where kategori = '$dat_series' and time_in < '$dat_waktu' and time_in > '$dat_waktu2'");
        $dat_q = mysqli_query($con_pro, "SELECT * from ongoing_slip where kategori = '$dat_series' and time_in < '$dat_waktu' and time_in > '$dat_waktu2'");
        break;

    case "> 3 days":
        $taser = "<u>More</u> than 3 days";
        $dat_waktu2 = date('Y-m-d H:i:s', strtotime('-3 days'));
        $warna = '#9C5700';
        $bg = '#FFEB9C';
        $status = "READY";

        $dat_qc = mysqli_query($con_pro, "SELECT * from ongoing_slip where kategori = '$dat_series' and time_in < '$dat_waktu2'");
        $dat_q = mysqli_query($con_pro, "SELECT * from ongoing_slip where kategori = '$dat_series' and time_in < '$dat_waktu2'");
        break;
}
?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a style="padding-top:15px; padding-bottom:15px; padding-left: 30px;"><img src="<?= base_url('_assets/production/images/yamaha_purple_no_waves.png') ?>" alt="logo_yamaha" height="30"></a>
            </div>
        </div>
    </div>

    <!-- page content -->
    <div class="right_col" role="main">

        <div class="dashboard_graph" style="padding-bottom: 0px;">
            <div class="row">
                <div class="col-md-9">
                    <h2 style="font-weight: bold; padding-left: 10px; margin-top: 0px; font-size: 23px; color: #212529;"><?= $dat_series . " - " . $taser ?></h2>
                </div>
                <div class="col-md-3">
                    <span style="text-align: right ; margin-top: 0px;">

                        <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
                            <h2 style="color: #2A3F54; padding-right: 10px; margin-top: 0px;"><?= $hari . ", " . $tanggal . " " . $bulan . " " . $tahun . " " ?><span style="font-weight: bold; color: #2A3F54;" id="clock"></span> WIB</h2>
                    </span>
                </div>
            </div>
            <hr style="margin: 0px;">
        </div>

        <div class="dashboard_graph" style="margin-top: 10px; margin-bottom: 50px;">
            <script src="js/jquery-3.5.1.js"></script>
            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <button class="btn btn-danger" onclick="window.close()">Close</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Slip</th>
                                        <th>GMC</th>
                                        <th>Cabinet Name</th>
                                        <th>On Process / Finish</th>
                                        <th>Category</th>
                                        <th>Qty</th>
                                        <th>Settled Down</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $cek = mysqli_fetch_row($dat_qc);
                                    if ($cek > 1) {
                                        // echo "ada isi";
                                        while ($dat_d = mysqli_fetch_array($dat_q)) {
                                            $awal = new DateTime($dat_d['time_in']);
                                            $akhir = new DateTime($now);
                                            $diff = $awal->diff($akhir);
                                    ?>
                                            <tr>
                                                <td style="font-weight: bold; background-color: <?= $bg ?>; color: <?= $warna ?>;"><?= $dat_d['slip'] ?></td>
                                                <td><?= $dat_d['kode'] ?></td>
                                                <td><?= $dat_d['nama_kabinet'] ?></td>
                                                <td><?= $dat_d['muka'] ?></td>
                                                <td><?= $dat_d['kategori'] ?></td>
                                                <td><?= $dat_d['qty'] ?></td>
                                                <td><?php
                                                    echo $diff->d . ' hari ';
                                                    echo $diff->h . ' jam ';
                                                    echo $diff->i . ' menit ';
                                                    ?></td>
                                                <td style="font-weight: bold; background-color: <?= $bg ?>; color: <?= $warna ?>;"><?= $status ?></td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        // echo "gada isi";
                                        ?>
                                        <tr>
                                            <td colspan="8" style="text-align: center; font-weight: bold;">Data not found</td>
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
    <!-- /page content -->
</body>

<?php
//================== ACTIVITY LOG START ==================//
// log activity record  
$now = date('Y-m-d H:i:s');
$token = $_SESSION['token'];

$l_t = $now;
$sy_n = "Mezzanine"; // Nama Sistem
$p_n = "opened data " . $dat_series . " " . $taser; // Nama Proses
$q = "read"; // Query
$e_n = $_SESSION['nama']; // Nama Karyawan
$e_i = $_SESSION['id']; // ID Karyawan
$c_i = $_SERVER['REMOTE_ADDR'];
$c_n = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$s_n = $_SERVER['SCRIPT_NAME'];
$h = $_SERVER['HTTP_HOST'];
mysqli_query($connect_log, "INSERT INTO activity_log set
                                    token = '$token',
                                    log_time = '$l_t',
                                    system_name = '$sy_n',
                                    process_name = '$p_n',
                                    query = '$q',
                                    employee_name = '$e_n',
                                    employee_id = '$e_i',
                                    computer_ip = '$c_i',
                                    computer_name = '$c_n',
                                    script_name = '$s_n',
                                    host = '$h'");

//================== ACTIVITY LOG FINISH ==================//
?>
<?php
include('../../../../../_footer.php'); ?>