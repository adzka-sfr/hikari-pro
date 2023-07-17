<?php
// DATA UNTUK MENAMPILKAN INFORMASI PADA AREA DOUGHNUT CHART - 2 HOURS
// date_default_timezone_set('Asia/Jakarta');
$day3 = date('Y-m-d H:i:s', strtotime('-3 days'));

// PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL
$sql_16rak_p = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where kategori = 'PANEL'");
$data_16rak_p = mysqli_fetch_array($sql_16rak_p);
if ($data_16rak_p['total'] == "") {
    $all_rak_p16 = 0;
} else {
    $all_rak_p16 = $data_16rak_p['total'];
}

$sql_16pcs_p = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where kategori = 'PANEL'");
$data_16pcs_p = mysqli_fetch_array($sql_16pcs_p);
if ($data_16pcs_p['total'] == "") {
    $all_pcs_p16 = 0;
} else {
    $all_pcs_p16 = $data_16pcs_p['total'];
}

// less
$less16p = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where time_out > '$now' and kategori = 'PANEL'");
$dataless16p = mysqli_fetch_array($less16p);
if ($dataless16p['total'] == "") {
    $less16pcsp = 0;
} else {
    $less16pcsp = $dataless16p['total'];
}

$lessr16p = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where time_out > '$now' and kategori = 'PANEL'");
$datalessr16p = mysqli_fetch_array($lessr16p);
if ($datalessr16p['total'] == "") {
    $less16rakp = 0;
} else {
    $less16rakp = $datalessr16p['total'];
}

// mid
$mid116p = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where  time_in >= '$day3' and time_out <= '$now'  and kategori = 'PANEL'");
$datamid16p = mysqli_fetch_array($mid116p);
if ($datamid16p['total'] == "") {
    $mid16pcsp = 0;
} else {
    $mid16pcsp = $datamid16p['total'];
}

$midr16p = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where  time_in >= '$day3' and time_out <= '$now'  and kategori = 'PANEL'");
$datamidr16p = mysqli_fetch_array($midr16p);
if ($datamidr16p['total'] == "") {
    $mid16rakp = 0;
} else {
    $mid16rakp = $datamidr16p['total'];
}

// more
$more116p = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where  time_in < '$day3' and kategori = 'PANEL'");
$datamore16p = mysqli_fetch_array($more116p);
if ($datamore16p['total'] == "") {
    $more16pcsp = 0;
} else {
    $more16pcsp = $datamore16p['total'];
}

$morer16p = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where  time_in < '$day3' and kategori = 'PANEL'");
$datamorer16p = mysqli_fetch_array($morer16p);
if ($datamorer16p['total'] == "") {
    $more16rakp = 0;
} else {
    $more16rakp = $datamorer16p['total'];
}

// PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL - PANEL

// SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT
$sql_16rak_ss = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where kategori = 'SMALL SHORT'");
$data_16rak_ss = mysqli_fetch_array($sql_16rak_ss);
if ($data_16rak_ss['total'] == "") {
    $all_rak_ss16 = 0;
} else {
    $all_rak_ss16 = $data_16rak_ss['total'];
}

$sql_16pcs_ss = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where kategori = 'SMALL SHORT'");
$data_16pcs_ss = mysqli_fetch_array($sql_16pcs_ss);
if ($data_16pcs_ss['total'] == "") {
    $all_pcs_ss16 = 0;
} else {
    $all_pcs_ss16 = $data_16pcs_ss['total'];
}

// less
$less16ss = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where time_out > '$now' and kategori = 'SMALL SHORT'");
$dataless16ss = mysqli_fetch_array($less16ss);
if ($dataless16ss['total'] == "") {
    $less16pcsss = 0;
} else {
    $less16pcsss = $dataless16ss['total'];
}

$lessr16ss = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where time_out > '$now' and kategori = 'SMALL SHORT'");
$datalessr16ss = mysqli_fetch_array($lessr16ss);
if ($datalessr16ss['total'] == "") {
    $less16rakss = 0;
} else {
    $less16rakss = $datalessr16ss['total'];
}

// mid
$mid116ss = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where  time_in >= '$day3' and time_out <= '$now'  and kategori = 'SMALL SHORT'");
$datamid16ss = mysqli_fetch_array($mid116ss);
if ($datamid16ss['total'] == "") {
    $mid16pcsss = 0;
} else {
    $mid16pcsss = $datamid16ss['total'];
}

$midr16ss = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where  time_in >= '$day3' and time_out <= '$now'  and kategori = 'SMALL SHORT'");
$datamidr16ss = mysqli_fetch_array($midr16ss);
if ($datamidr16ss['total'] == "") {
    $mid16rakss = 0;
} else {
    $mid16rakss = $datamidr16ss['total'];
}

// more
$more116ss = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where  time_in < '$day3' and kategori = 'SMALL SHORT'");
$datamore16ss = mysqli_fetch_array($more116ss);
if ($datamore16ss['total'] == "") {
    $more16pcsss = 0;
} else {
    $more16pcsss = $datamore16ss['total'];
}

$morer16ss = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where  time_in < '$day3' and kategori = 'SMALL SHORT'");
$datamorer16ss = mysqli_fetch_array($morer16ss);
if ($datamorer16ss['total'] == "") {
    $more16rakss = 0;
} else {
    $more16rakss = $datamorer16ss['total'];
}
// SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT - SMALL SHORT

// SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG
$sql_16rak_sl = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where kategori = 'SMALL LONG'");
$data_16rak_sl = mysqli_fetch_array($sql_16rak_sl);
if ($data_16rak_sl['total'] == "") {
    $all_rak_sl16 = 0;
} else {
    $all_rak_sl16 = $data_16rak_sl['total'];
}

$sql_16pcs_sl = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where kategori = 'SMALL LONG'");
$data_16pcs_sl = mysqli_fetch_array($sql_16pcs_sl);
if ($data_16pcs_sl['total'] == "") {
    $all_pcs_sl16 = 0;
} else {
    $all_pcs_sl16 = $data_16pcs_sl['total'];
}

// less
$less16sl = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where time_out > '$now' and kategori = 'SMALL LONG'");
$dataless16sl = mysqli_fetch_array($less16sl);
if ($dataless16sl['total'] == "") {
    $less16pcssl = 0;
} else {
    $less16pcssl = $dataless16sl['total'];
}

$lessr16sl = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where time_out > '$now' and kategori = 'SMALL LONG'");
$datalessr16sl = mysqli_fetch_array($lessr16sl);
if ($datalessr16sl['total'] == "") {
    $less16raksl = 0;
} else {
    $less16raksl = $datalessr16sl['total'];
}

// mid
$mid116sl = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where  time_in >= '$day3' and time_out <= '$now'  and kategori = 'SMALL LONG'");
$datamid16sl = mysqli_fetch_array($mid116sl);
if ($datamid16sl['total'] == "") {
    $mid16pcssl = 0;
} else {
    $mid16pcssl = $datamid16sl['total'];
}

$midr16sl = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where  time_in >= '$day3' and time_out <= '$now'  and kategori = 'SMALL LONG'");
$datamidr16sl = mysqli_fetch_array($midr16sl);
if ($datamidr16sl['total'] == "") {
    $mid16raksl = 0;
} else {
    $mid16raksl = $datamidr16sl['total'];
}

// more
$more116sl = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where  time_in < '$day3' and kategori = 'SMALL LONG'");
$datamore16sl = mysqli_fetch_array($more116sl);
if ($datamore16sl['total'] == "") {
    $more16pcssl = 0;
} else {
    $more16pcssl = $datamore16sl['total'];
}

$morer16sl = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip where  time_in < '$day3' and kategori = 'SMALL LONG'");
$datamorer16sl = mysqli_fetch_array($morer16sl);
if ($datamorer16sl['total'] == "") {
    $more16raksl = 0;
} else {
    $more16raksl = $datamorer16sl['total'];
}
// SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG - SMALL LONG

// SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK
$semua16 = mysqli_query($con_pro, "SELECT count(distinct slip) as total from ongoing_slip");
$data_semua16 = mysqli_fetch_array($semua16);
if ($data_semua16['total'] == "") {
    $semua16jam = 0;
} else {
    $semua16jam = $data_semua16['total'];
}


// SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK - SEMUA RAK
