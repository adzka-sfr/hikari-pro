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

$qry_maxtime = mysqli_query($connect, "SELECT waktu from last_run where wc = 'U400'");
$arr_maxtime = mysqli_fetch_array($qry_maxtime);
$dt_maxtime = $arr_maxtime['waktu'];
// $batas = date("Y-m-d H:i:s", strtotime($dt_maxtime . '+12 hours'));

$sql1 = "SELECT TO_CHAR(LA_ACTY.D0040.INSTDT,'YYYY-MM-DD HH24:MI:SS')  AS TANGGAL, LA_ACTY.D0040.HMCD AS GMC, LA_ACTY.D0040.ACTUALQTY AS QTY FROM LA_ACTY.D0040
WHERE LA_ACTY.D0040.MAKEKTCD ='U400' AND TO_CHAR(LA_ACTY.D0040.INSTDT,'YYYY/MM/DD hh24:mi:ss') > TO_CHAR(TO_DATE('$dt_maxtime','YYYY/MM/DD hh24:mi:ss'), 'YYYY/MM/DD hh24:mi:ss') ORDER BY LA_ACTY.D0040.INSTDT";

$statment1 = oci_parse($connection, $sql1);
oci_execute($statment1);

while ($ora_result_ck = oci_fetch_array($statment1)) {

  $cek_model_sql = mysqli_query($connect, "SELECT model from penghubung where gmc_p = '$ora_result_ck[GMC]'");
  $arr_model = mysqli_fetch_array($cek_model_sql);

  $tgl = date("Y-m-d", strtotime($ora_result_ck['TANGGAL']));
  $tanggal = date("Y-m-d H:i:s", strtotime($ora_result_ck['TANGGAL']));
  if (empty($arr_model['model'])) {
    $model = "not registered";
  } else {
    $model = $arr_model['model'];
  }

  $jenis = "case";
  $keytag = $tgl . "|" . $model . "|" . $jenis;

  // buat cek
  // echo $keytag . " " . $ora_result_ck['GMC'] . "<br>";

  // mengubah data pada tabel pekerjaan assy
  $cek_keytag_sql = mysqli_query($connect, "SELECT * from achieved where keytag = '$keytag'");
  $arr_keytag = mysqli_fetch_row($cek_keytag_sql);
  if ($arr_keytag == 0) {
    mysqli_query($connect, "INSERT INTO achieved set keytag = '$keytag', tanggal = '$tgl', jenis = '$jenis', nama_piano = '$model', qty = '$ora_result_ck[QTY]'");
    mysqli_query($connect, "INSERT INTO plan set keytag = '$keytag', tanggal = '$tgl', jenis = '$jenis', nama_piano = '$model', qty = 0");
  } else {
    mysqli_query($connect, "UPDATE achieved set qty = qty + '$ora_result_ck[QTY]' where keytag = '$keytag'");
  }

  // mengubah data pada tabel cab_stock
  $cab_stock_sql = mysqli_query($connect, "SELECT gmc_c from penghubung where gmc_p = '$ora_result_ck[GMC]'");
  while ($arr_cab_stock = mysqli_fetch_array($cab_stock_sql)) {
    $cab_sql = mysqli_query($connect, "SELECT qty from cab_stock where gmc_kabinet = '$arr_cab_stock[gmc_c]'");
    $arr_cab = mysqli_fetch_array($cab_sql);
    $qty = $arr_cab['qty'] - $ora_result_ck['QTY'];
    mysqli_query($connect, "UPDATE cab_stock set qty = '$qty' where gmc_kabinet = '$arr_cab_stock[gmc_c]'");
  }
  mysqli_query($connect, "UPDATE last_run set waktu = '$tanggal' where wc = 'U400'");
}
