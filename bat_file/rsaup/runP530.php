<?php
date_default_timezone_set('Asia/Jakarta');

$username = "B_ACTY";
$password = "SYSTEM";
$db = "(DESCRIPTION =
			(ADDRESS_LIST =
			  (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521))
			)
			(CONNECT_DATA =
			  (SERVICE_NAME = YIKSTAFF)
			)
		)";

$connection = oci_connect($username, $password, $db);

if (!$connection) {
  $e = oci_error();
  echo htmlentities($e['message']);
  exit();
}

include 'koneksi.php';

$qry_maxtime = mysqli_query($connect, "SELECT waktu from last_run where wc = 'P530'");
$arr_maxtime = mysqli_fetch_array($qry_maxtime);
$dt_maxtime = $arr_maxtime['waktu'];

$sql1 = "SELECT TO_CHAR(LA_ACTY.D0040.INSTDT,'YYYY-MM-DD HH24:MI:SS')  AS TANGGAL, LA_ACTY.D0040.HMCD AS GMC, LA_ACTY.D0040.ACTUALQTY AS QTY FROM LA_ACTY.D0040
WHERE LA_ACTY.D0040.MAKEKTCD ='P530' AND TO_CHAR(LA_ACTY.D0040.INSTDT,'YYYY/MM/DD hh24:mi:ss') > TO_CHAR(TO_DATE('$dt_maxtime','YYYY/MM/DD hh24:mi:ss'), 'YYYY/MM/DD hh24:mi:ss') ORDER BY LA_ACTY.D0040.INSTDT";

$statment1 = oci_parse($connection, $sql1);
oci_execute($statment1);

while ($ora_result_ck = oci_fetch_array($statment1)) {
  $q_1 = mysqli_query($connect, "SELECT * from cab_stock where gmc_kabinet = '$ora_result_ck[GMC]'");
  $d_1 = mysqli_fetch_array($q_1);

  // data
  $qty = $d_1['qty'] + $ora_result_ck['QTY'];
  $tanggal = date("Y-m-d H:i:s", strtotime($ora_result_ck['TANGGAL']));

  mysqli_query($connect, "UPDATE cab_stock SET qty = $qty, updated = '$tanggal'  WHERE gmc_kabinet = '$ora_result_ck[GMC]'");

  // update last_run time
  mysqli_query($connect, "UPDATE last_run set waktu = '$tanggal' where wc = 'P530'");
}
