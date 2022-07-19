<?php
include('../../_config/pro_koneksi.php');
$today = date("Y-m-d");

// stock cs
$stock_cs_sql = mysqli_query($conn, "SELECT p.tanggal, p.nama_piano,SUM( p.qty) AS plan, SUM(a.qty) AS achvd, SUM(a.qty - p.qty) as rem_cs  FROM plan p JOIN achieved a ON p.keytag = a.keytag WHERE p.tanggal < '$today' and p.jenis = 'case' group by p.nama_piano order by rem_cs desc, p.nama_piano asc");

while ($stock_cs_row = mysqli_fetch_assoc($stock_cs_sql)) {
    if ($stock_cs_row['rem_cs'] > 0) {
        $stock_cs_data[] = $stock_cs_row;
    }
}

echo json_encode(array("result_stck" => $stock_cs_data));
