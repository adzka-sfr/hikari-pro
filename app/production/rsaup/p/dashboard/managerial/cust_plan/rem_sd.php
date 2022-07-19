<?php
include('../../_config/pro_koneksi.php');
$today = date("Y-m-d");
// remaining cs
$rem_cs_sql = mysqli_query($conn, "SELECT p.tanggal, p.nama_piano, SUM(p.qty) AS plan, SUM(a.qty) AS achvd, SUM(p.qty - a.qty) as rem_cs  FROM plan p JOIN achieved a ON p.keytag = a.keytag WHERE p.tanggal < '$today' and p.jenis = 'side' group by p.nama_piano order by rem_cs desc, p.nama_piano asc");

while ($rem_cs_row = mysqli_fetch_assoc($rem_cs_sql)) {
    if ($rem_cs_row['rem_cs'] > 0) {
        $rem_cs_data[] = $rem_cs_row;
    }
}

echo json_encode(array("result_rem" => $rem_cs_data));
