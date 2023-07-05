<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));
$yesterday = date('Y-m-d', strtotime("-1day", strtotime($now)));

# UP
// get stock
$q1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialuserp) AS up_stock FROM qa_userp WHERE c_used IS NOT NULL AND c_packed IS NULL AND c_location = 'packing up'");
$d1 = mysqli_fetch_array($q1);
$up_stock = $d1['up_stock'];
// get today used
$q2 = mysqli_query($connect_pro, "SELECT COUNT(c_serialuserp) AS today_used FROM qa_userp WHERE c_used IS NOT NULL AND c_packed IS NOT NULL AND c_packed LIKE '$today%' AND c_location = 'packing up'");
$d2 = mysqli_fetch_array($q2);
$up_today_used = $d2['today_used'];
// get all time used
$q3 = mysqli_query($connect_pro, "SELECT COUNT(c_serialuserp) AS alltime_used FROM qa_userp WHERE c_used IS NOT NULL AND c_packed IS NOT NULL AND c_location = 'packing up'");
$d3 = mysqli_fetch_array($q3);
$up_alltime_used = $d3['alltime_used'];

# GP
// get stock
$q4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialuserp) AS up_stock FROM qa_userp WHERE c_used IS NOT NULL AND c_packed IS NULL AND c_location = 'packing gp'");
$d4 = mysqli_fetch_array($q4);
$gp_stock = $d4['up_stock'];
// get today used
$q5 = mysqli_query($connect_pro, "SELECT COUNT(c_serialuserp) AS today_used FROM qa_userp WHERE c_used IS NOT NULL AND c_packed IS NOT NULL AND c_packed LIKE '$today%' AND c_location = 'packing gp'");
$d5 = mysqli_fetch_array($q5);
$gp_today_used = $d5['today_used'];
// get all time used
$q6 = mysqli_query($connect_pro, "SELECT COUNT(c_serialuserp) AS alltime_used FROM qa_userp WHERE c_used IS NOT NULL AND c_packed IS NOT NULL AND c_location = 'packing gp'");
$d6 = mysqli_fetch_array($q6);
$gp_alltime_used = $d6['alltime_used'];

echo json_encode(array("upstock" => $up_stock, "gpstock" => $gp_stock, "uptod" => $up_today_used, "gptod" => $gp_today_used, "upall" => $up_alltime_used, "gpall" => $gp_alltime_used));
