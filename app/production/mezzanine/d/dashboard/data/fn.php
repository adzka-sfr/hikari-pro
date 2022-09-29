<?php
$fn1 = mysqli_query($con_pro, "SELECT * FROM TARGETAN WHERE KODE = 'fn'");
$fn1d = mysqli_fetch_array($fn1);

// panel - finish
$fn_p_bb = $fn1d['bb_p'];
$fn_p_ba = $fn1d['ba_p'];
$fn_p_mx = $fn1d['max_p'];

// small short - finish
$fn_ss_bb = $fn1d['bb_ss'];
$fn_ss_ba = $fn1d['ba_ss'];
$fn_ss_mx = $fn1d['max_ss'];

// small long - finish
$fn_sl_bb = $fn1d['bb_sl'];
$fn_sl_ba = $fn1d['ba_sl'];
$fn_sl_mx = $fn1d['max_sl'];

$fn2 = mysqli_query($con_pro, "SELECT SUM(qty) AS jumlah FROM ONGOING_SLIP WHERE muka = 'finish' AND kategori = 'panel'");
$fn2d = mysqli_fetch_array($fn2);
$fn_p_act = $fn2d['jumlah'];
$fn_p_persen = round((($fn_p_act / $fn_p_mx) * 100), 2);

$fn3 = mysqli_query($con_pro, "SELECT SUM(qty) AS jumlah FROM ONGOING_SLIP WHERE muka = 'finish' AND kategori = 'small short'");
$fn3d = mysqli_fetch_array($fn3);
$fn_ss_act = $fn3d['jumlah'];
$fn_ss_persen = round((($fn_ss_act / $fn_ss_mx) * 100), 2);

$fn4 = mysqli_query($con_pro, "SELECT SUM(qty) AS jumlah FROM ONGOING_SLIP WHERE muka = 'finish' AND kategori = 'small long'");
$fn4d = mysqli_fetch_array($fn4);
$fn_sl_act = $fn4d['jumlah'];
$fn_sl_persen = round((($fn_sl_act / $fn_sl_mx) * 100), 2);