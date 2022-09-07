<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Show data P530</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

  <table class="table table-bordered">
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

    include '../koneksi.php';

    $qry_maxtime = mysqli_query($connect, "SELECT waktu from last_run where wc = 'P530'");
    $arr_maxtime = mysqli_fetch_array($qry_maxtime);
    $dt_maxtime = $arr_maxtime['waktu'];

    $sql1 = "SELECT TO_CHAR(LA_ACTY.D0040.INSTDT,'YYYY-MM-DD HH24:MI:SS')  AS TANGGAL, LA_ACTY.D0040.HMCD AS GMC, LA_ACTY.D0040.ACTUALQTY AS QTY FROM LA_ACTY.D0040
WHERE LA_ACTY.D0040.MAKEKTCD ='P530' AND TO_CHAR(LA_ACTY.D0040.INSTDT,'YYYY/MM/DD hh24:mi:ss') > TO_CHAR(TO_DATE('$dt_maxtime','YYYY/MM/DD hh24:mi:ss'), 'YYYY/MM/DD hh24:mi:ss') ORDER BY LA_ACTY.D0040.INSTDT";

    $statment1 = oci_parse($connection, $sql1);
    oci_execute($statment1);
    ?>
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>GMC</th>
        <th>Stock</th>
        <th>TR</th>
        <th>Hasil</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($ora_result_ck = oci_fetch_array($statment1)) {

        $q_1 = mysqli_query($connect, "SELECT * from cab_stock where gmc_kabinet = '$ora_result_ck[GMC]'");
        $d_1 = mysqli_fetch_array($q_1);

        // data
        $qty = $d_1['qty'] + $ora_result_ck['QTY'];
        $tanggal = date("Y-m-d H:i:s", strtotime($ora_result_ck['TANGGAL']));
      ?>
        <tr>
          <td><?= $tanggal ?></td>
          <td><?= $ora_result_ck['GMC'] ?></td>
          <td><?= $d_1['qty'] ?></td>
          <td><?= $ora_result_ck['QTY'] ?></td>
          <td><?= $qty ?></td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>