<?php
// agar varibel null tertutup
// error_reporting(0);
include('../../_config/koneksi.php');

// cek weekend
$tanggal = date('Y-m-d');
$weekend = strtotime($tanggal);
$day = date('l', $weekend);
if ($day !== 'Saturday' && $day !== 'Sunday') {
	$name_cabinet = $_POST['name_cabinet'];
	$qty = $_POST['qty'];
	$gmc = $_POST['gmc'];
	$status_ng = $_POST['ng'];
	// input inventory acc
	// ambil dulu qty ng 
	$qry = mysqli_query($conn, "SELECT distinct(p.name_cabinet) as name_cabinet, i.gmc_c, p.gmc_c, i.pcs as ipcs, ng.pcs as ngpcs FROM inventory_fix i JOIN bd_piano_fix p ON p.gmc_c = i.gmc_c JOIN inventory_ng ng ON p.name_cabinet = ng.name_cabinet WHERE p.name_cabinet = '$name_cabinet' AND (i.pcs != 0 OR ng.pcs != 0)  ORDER BY p.name_cabinet ASC");
	$ambil = mysqli_fetch_array($qry);
	if ($status_ng == "notgood") {
		$cekminus = $ambil['ipcs'] - $qty;
		if ($cekminus < 0) {
			echo "<script>
				document.location.href = 'dataacc.php';
				alert('Please input qty repair under qty inventory')
				;</script>";
		} else {
			$pcs_baru = $ambil['ipcs'] - $qty;
			mysqli_query($conn, "UPDATE inventory_fix SET pcs = $pcs_baru WHERE gmc_c = '$gmc'");
			// input ng_hist
			$pcs_baru_ng = $ambil['ngpcs'] + $qty;
			mysqli_query($conn, "UPDATE inventory_ng SET updated = NOW(), pcs = $pcs_baru_ng WHERE name_cabinet = '$name_cabinet'");

			// ambil pcs terbaru dari inventory_fix
			$qrypcs = mysqli_query($conn, "SELECT bd.name_cabinet, iff.pcs as pcs FROM `bd_piano_fix` bd JOIN inventory_fix iff ON bd.gmc_c = iff.gmc_c WHERE iff.gmc_c = '$gmc' GROUP by iff.pcs");
			$ambilpcs = mysqli_fetch_array($qrypcs);
			// input ng ke prioritas
			$qryy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$gmc'");
			while ($ambill = mysqli_fetch_array($qryy)) {
				mysqli_query($conn, "UPDATE prioritas SET pcs_inventory = '$ambilpcs[pcs]' WHERE gmc_c = '$gmc'");
			}
			// update qty_prioritas
			$qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$gmc'");
			while ($ambilll = mysqli_fetch_array($qryyy)) {
				$qty_prior = $ambilll['pcs_inventory'] - $ambilll['pcs_plan'];
				mysqli_query($conn, "UPDATE prioritas SET pcs_prioritas = '$qty_prior' WHERE gmc_c = '$gmc'");
			}
			echo "<script>
			document.location.href = 'dataacc.php';
			alert('input qty ng is success');</script>";
		}
	} elseif ($status_ng == "repair") {
		$cekminus = $ambil['ngpcs'] - $qty;
		if ($cekminus < 0) {
			echo "<script>
			 document.location.href = 'dataacc.php';
			 alert('Please input qty repair under qty ng')
			 ;</script>";
		} else {
			$pcs = $ambil['ipcs'] + $qty;
			mysqli_query($conn, "UPDATE inventory_fix SET pcs = $pcs WHERE gmc_c = '$gmc'");
			// 	// input ng_hist
			$pcss_baru_ng = $ambil['ngpcs'] - $qty;
			mysqli_query($conn, "UPDATE inventory_ng SET updated = NOW(), pcs = $pcss_baru_ng WHERE name_cabinet = '$name_cabinet'");
			// ambil pcs terbaru dari inventory_fix
			$qrypcs = mysqli_query($conn, "SELECT bd.name_cabinet, iff.pcs as pcs FROM `bd_piano_fix` bd JOIN inventory_fix iff ON bd.gmc_c = iff.gmc_c WHERE iff.gmc_c = '$gmc' GROUP by iff.pcs");
			$ambilpcs = mysqli_fetch_array($qrypcs);
			// input ng ke prioritas
			$qryy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$gmc'");
			while ($ambill = mysqli_fetch_array($qryy)) {
				mysqli_query($conn, "UPDATE prioritas SET pcs_inventory = '$ambilpcs[pcs]' WHERE gmc_c = '$gmc'");
			}
			// update qty_prioritas
			$qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc_c = '$gmc'");
			while ($ambilll = mysqli_fetch_array($qryyy)) {
				$qty_prior = $ambilll['pcs_inventory'] - $ambilll['pcs_plan'];
				mysqli_query($conn, "UPDATE prioritas SET pcs_prioritas = '$qty_prior' WHERE gmc_c = '$gmc'");
			}
			echo "<script>
			document.location.href = 'dataacc.php';
			alert('input qty repair is success');</script>";
		}
	}
} else {
	echo "<script>
	     document.location.href = 'dataacc.php';
	     alert('Weekend! entry data failed')
	     ;</script>";
}
