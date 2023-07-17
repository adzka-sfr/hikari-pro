<?php
// DATA UNTUK MENAMPILKAN INFORMASI PADA AREA DOUGHNUT CHART - 2 HOURS

// PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL

// menghitung semua
$all_p = mysqli_query($con_pro, "SELECT SUM(qty) as total from to_ongoing_slip where kategori = 'PANEL'");
$data_allp = mysqli_fetch_array($all_p);
if ($data_allp['total'] == "") {
    $all_pcs_p = 0;
} else {
    $all_pcs_p = $data_allp['total'];
}

$all_p2 = mysqli_query($con_pro, "SELECT count(distinct slip) as total from to_ongoing_slip where kategori = 'PANEL'");
$data_allp2 = mysqli_fetch_array($all_p2);
if ($data_allp2['total'] == "") {
    $all_rak_p = 0;
} else {
    $all_rak_p = $data_allp2['total'];
}

// menghitung < 2 jam
$less1 = mysqli_query($con_pro, "SELECT SUM(qty) as total from to_ongoing_slip where time_out >= '$now' and kategori = 'PANEL'");
$lessa = mysqli_fetch_array($less1);
if ($lessa['total'] == "") {
    $less_pcs_p = 0;
} else {
    $less_pcs_p = $lessa['total'];
}

$less2 = mysqli_query($con_pro, "SELECT COUNT(distinct slip) as total from to_ongoing_slip where time_out >= '$now' and kategori = 'PANEL'");
$lessb = mysqli_fetch_array($less2);
if ($lessb['total'] == "") {
    $less_rak_p = 0;
} else {
    $less_rak_p = $lessb['total'];
}

// menghitung > 2 jam
$more1 = mysqli_query($con_pro, "SELECT SUM(qty) as total from to_ongoing_slip where time_out < '$now' and kategori = 'PANEL'");
$morea = mysqli_fetch_array($more1);
if ($morea['total'] == "") {
    $more_pcs_p = 0;
} else {
    $more_pcs_p = $morea['total'];
}

$more2 = mysqli_query($con_pro, "SELECT COUNT(distinct slip) as total from to_ongoing_slip where time_out < '$now' and kategori = 'PANEL'");
$moreb = mysqli_fetch_array($more2);
if ($moreb['total'] == "") {
    $more_rak_p = 0;
} else {
    $more_rak_p = $moreb['total'];
}
// PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL

// SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT
$all_ss = mysqli_query($con_pro, "SELECT SUM(qty) as total from to_ongoing_slip where kategori = 'SMALL SHORT'");
$data_allss = mysqli_fetch_array($all_ss);
if ($data_allss['total'] == "") {
    $all_pcs_ss = 0;
} else {
    $all_pcs_ss = $data_allss['total'];
}

$all_ss2 = mysqli_query($con_pro, "SELECT count(distinct slip) as total from to_ongoing_slip where kategori = 'SMALL SHORT'");
$data_allss2 = mysqli_fetch_array($all_ss2);
if ($data_allss2['total'] == "") {
    $all_rak_ss = 0;
} else {
    $all_rak_ss = $data_allss2['total'];
}

// menghitung < 2 jam
$less3 = mysqli_query($con_pro, "SELECT SUM(qty) as total from to_ongoing_slip where time_out >= '$now' and kategori = 'SMALL SHORT'");
$lessc = mysqli_fetch_array($less3);
if ($lessc['total'] == "") {
    $less_pcs_ss = 0;
} else {
    $less_pcs_ss = $lessc['total'];
}

$less4 = mysqli_query($con_pro, "SELECT COUNT(distinct slip) as total from to_ongoing_slip where time_out >= '$now' and kategori = 'SMALL SHORT'");
$lessd = mysqli_fetch_array($less4);
if ($lessd['total'] == "") {
    $less_rak_ss = 0;
} else {
    $less_rak_ss = $lessd['total'];
}

// menghitung > 2 jam
$more3 = mysqli_query($con_pro, "SELECT SUM(qty) as total from to_ongoing_slip where time_out < '$now' and kategori = 'SMALL SHORT'");
$morec = mysqli_fetch_array($more3);
if ($morec['total'] == "") {
    $more_pcs_ss = 0;
} else {
    $more_pcs_ss = $morec['total'];
}

$more4 = mysqli_query($con_pro, "SELECT COUNT(distinct slip) as total from to_ongoing_slip where time_out < '$now' and kategori = 'SMALL SHORT'");
$mored = mysqli_fetch_array($more4);
if ($mored['total'] == "") {
    $more_rak_ss = 0;
} else {
    $more_rak_ss = $mored['total'];
}
// SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT

// SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG
$all_sl = mysqli_query($con_pro, "SELECT SUM(qty) as total from to_ongoing_slip where kategori = 'SMALL LONG'");
$data_allsl = mysqli_fetch_array($all_sl);
if ($data_allsl['total'] == "") {
    $all_pcs_sl = 0;
} else {
    $all_pcs_sl = $data_allsl['total'];
}

$all_sl2 = mysqli_query($con_pro, "SELECT count(distinct slip) as total from to_ongoing_slip where kategori = 'SMALL LONG'");
$data_allsl2 = mysqli_fetch_array($all_sl2);
if ($data_allsl2['total'] == "") {
    $all_rak_sl = 0;
} else {
    $all_rak_sl = $data_allsl2['total'];
}

// menghitung < 2 jam
$less5 = mysqli_query($con_pro, "SELECT SUM(qty) as total from to_ongoing_slip where time_out >= '$now' and kategori = 'SMALL LONG'");
$lesse = mysqli_fetch_array($less5);
if ($lesse['total'] == "") {
    $less_pcs_sl = 0;
} else {
    $less_pcs_sl = $lesse['total'];
}

$less6 = mysqli_query($con_pro, "SELECT COUNT(distinct slip) as total from to_ongoing_slip where time_out >= '$now' and kategori = 'SMALL LONG'");
$lessf = mysqli_fetch_array($less6);
if ($lessf['total'] == "") {
    $less_rak_sl = 0;
} else {
    $less_rak_sl = $lessf['total'];
}

// menghitung > 2 jam
$more5 = mysqli_query($con_pro, "SELECT SUM(qty) as total from to_ongoing_slip where time_out < '$now' and kategori = 'SMALL LONG'");
$moree = mysqli_fetch_array($more5);
if ($moree['total'] == "") {
    $more_pcs_sl = 0;
} else {
    $more_pcs_sl = $moree['total'];
}

$more6 = mysqli_query($con_pro, "SELECT COUNT(distinct slip) as total from to_ongoing_slip where time_out < '$now' and kategori = 'SMALL LONG'");
$moref = mysqli_fetch_array($more6);
if ($moref['total'] == "") {
    $more_rak_sl = 0;
} else {
    $more_rak_sl = $moref['total'];
}
// SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG

// SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK
$semua2 = mysqli_query($con_pro, "SELECT count(distinct slip) as total from to_ongoing_slip");
$data_semua2 = mysqli_fetch_array($semua2);
if ($data_semua2['total'] == "") {
    $semua2jam = 0;
} else {
    $semua2jam = $data_semua2['total'];
}
// SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK
