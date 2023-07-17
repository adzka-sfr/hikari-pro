<?php
// DATA UNTUK INFORMASI PADA AREA PROGRESS BAR ON PROCESS
$op1 = mysqli_query($con_pro, "SELECT * FROM TARGETAN WHERE KODE = 'op'");
$op1d = mysqli_fetch_array($op1);

// panel - on process
$op_p_bb = $op1d['bb_p'];
$op_p_ba = $op1d['ba_p'];
$op_p_mx = $op1d['max_p'];

// small short - on process
$op_ss_bb = $op1d['bb_ss'];
$op_ss_ba = $op1d['ba_ss'];
$op_ss_mx = $op1d['max_ss'];

// small long - on process
$op_sl_bb = $op1d['bb_sl'];
$op_sl_ba = $op1d['ba_sl'];
$op_sl_mx = $op1d['max_sl'];

$op2 = mysqli_query($con_pro, "SELECT SUM(qty) AS jumlah FROM ONGOING_SLIP WHERE muka = 'on process' AND kategori = 'panel'");
$op2d = mysqli_fetch_array($op2);
$op_p_act = $op2d['jumlah'];
$op_p_persen = round((($op_p_act / $op_p_mx) * 100), 2);

$op3 = mysqli_query($con_pro, "SELECT SUM(qty) AS jumlah FROM ONGOING_SLIP WHERE muka = 'on process' AND kategori = 'small short'");
$op3d = mysqli_fetch_array($op3);
$op_ss_act = $op3d['jumlah'];
$op_ss_persen = round((($op_ss_act / $op_ss_mx) * 100), 2);

$op4 = mysqli_query($con_pro, "SELECT SUM(qty) AS jumlah FROM ONGOING_SLIP WHERE muka = 'on process' AND kategori = 'small long'");
$op4d = mysqli_fetch_array($op4);
$op_sl_act = $op4d['jumlah'];
$op_sl_persen = round((($op_sl_act / $op_sl_mx) * 100), 2);
