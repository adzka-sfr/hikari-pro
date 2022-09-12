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

$qry_maxtime = mysqli_query($connect, "SELECT waktu from last_run where wc = 'b450'");
$arr_maxtime = mysqli_fetch_array($qry_maxtime);
$dt_maxtime = $arr_maxtime['waktu'];

$sql1 = "SELECT TO_CHAR(LA_ACTY.D0040.INSTDT,'YYYY-MM-DD HH24:MI:SS')  AS TANGGAL, LA_ACTY.D0040.HMCD AS GMC, LA_ACTY.D0040.ACTUALQTY AS QTY FROM LA_ACTY.D0040
WHERE LA_ACTY.D0040.MAKEKTCD ='B450' AND TO_CHAR(LA_ACTY.D0040.INSTDT,'YYYY/MM/DD hh24:mi:ss') > TO_CHAR(TO_DATE('$dt_maxtime','YYYY/MM/DD hh24:mi:ss'), 'YYYY/MM/DD hh24:mi:ss') ORDER BY LA_ACTY.D0040.INSTDT";

$statment1 = oci_parse($connection, $sql1);
oci_execute($statment1);

while ($ora_result_ck = oci_fetch_array($statment1)) {
  $q_1 = mysqli_query($connect, "SELECT * from step1 where gmc_c = '$ora_result_ck[GMC]'");
  $d_1 = mysqli_fetch_array($q_1);

  // data
  $phb = $d_1['penghubung'];
  $waktu = date("Y-m-d H:i:s", strtotime($ora_result_ck['TANGGAL']));
  $gmc = $ora_result_ck['GMC'];
  $nama_item = $d_1['nama_tampil'];

  mysqli_query($connect, "INSERT into sd_b450 set penghubung = '$phb', waktu = '$waktu', gmc = '$gmc', nama_item = '$nama_item'");

  // kebutuhan ambil hasil
  $tanggal = date("Y-m-d");
  $sql2 = mysqli_query($connect, "SELECT * FROM hasil where tanggal = '$tanggal'");
  $data2 = mysqli_fetch_array($sql2);
  if (empty($data2)) {
    mysqli_query($connect, "INSERT INTO hasil set tanggal = '$tanggal', b450 = 1");
  } else {
    $hasil = $data2['b450'] + 1;
    mysqli_query($connect, "UPDATE hasil set b450 = $hasil where tanggal = '$tanggal'");
  }

  // update untuk hasil harian
  $sql3 = mysqli_query($connect, "SELECT b450 from act_daily where phb = '$phb'");
  $data3 = mysqli_fetch_array($sql3);
  $act_daily = $data3['b450'] + 1;
  mysqli_query($connect, "UPDATE act_daily set b450 = $act_daily where phb = '$phb'");

  // update last_run time
  mysqli_query($connect, "UPDATE last_run set waktu = '$waktu' where wc = 'b450'");
}
