<?php
// agar varibel null tertutup
// error_reporting(0);
include('../_config/koneksi.php');

// cek weekend
$tanggal = date('Y-m-d');
$weekend = strtotime($tanggal);
$day = date('l', $weekend);
if ($day !== 'Saturday' && $day !== 'Sunday') {
	$name_kabinet = $_POST['name_kabinet'];
	$qty = $_POST['qty'];
	$gmc = $_POST['gmc'];
	$status_ng = $_POST['ng'];
	// SELECT p.name_cabinet,p.name_piano,p.name_ori_cabinet, p.gmc_c,p.gmc_inventory, p.dest, p.ratiounit as ratio, i.unit as iunit, ng.unit as ngunit FROM inventory_use i JOIN bd_piano_use p ON p.gmc_inventory = i.gmc_inventory JOIN inventory_ng_use ng ON p.gmc_inventory = ng.gmc_inventory WHERE i.unit != 0 OR ng.unit != 0 ORDER BY p.name_cabinet ASC
	// input inventory acc
	$qry = mysqli_query($conn, "SELECT * FROM inventory_use WHERE gmc_c = '$gmc'");
	$ambil = mysqli_fetch_array($qry);
	// ambil dulu qty ng 
	$qry1 = mysqli_query($conn, "SELECT * FROM inventory_ng_use WHERE gmc_c = '$gmc'");
	$ambil1 = mysqli_fetch_array($qry1);
	if ($status_ng == "notgood") {
		$hitungRatioUnit = $qty / $ambil['ratio'];
		$cekminus = $ambil['qty'] - $hitungRatioUnit;
		if ($cekminus < 0) {
			echo "<script>
			document.location.href = 'dataacc.php';
			alert('Please input qty repair under qty inventory')
			;</script>";
		} else {
			$qty_baru = $ambil['qty'] - $qty;
			mysqli_query($conn, "UPDATE inventory SET qty = $qty_baru WHERE gmc = '$gmc'");
			// input ng_hist
			$qty_baru_ng = $ambil1['qty'] + $qty;
			mysqli_query($conn, "UPDATE ng_hist SET updated = NOW(), qty = $qty_baru_ng WHERE gmc = '$gmc'");
			// inputkan nilai qty inventory asli ke db qty_inventory di prioritas
			$qryy = mysqli_query($conn, "SELECT * from inventory WHERE gmc = '$gmc'");
			$ambill = mysqli_fetch_array($qryy);
			mysqli_query($conn, "UPDATE prioritas SET qty_inventory = $ambill[qty] WHERE gmc = '$gmc'");
			// update qty_prioritas
			$qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc = '$gmc'");
			$ambilll = mysqli_fetch_array($qryyy);
			$qty_prior = $ambilll['qty_inventory'] - $ambilll['qty_plan'];
			mysqli_query($conn, "UPDATE prioritas SET qty_prioritas = '$qty_prior' WHERE gmc = '$gmc'");
			echo "<script>
		document.location.href = 'dataacc.php';
		alert('input qty ng is success');</script>";
		}
	} elseif ($status_ng == "repair") {
		$cekminus = $ambil1['qty'] - $qty;
		if ($cekminus < 0) {
			echo "<script>
	     document.location.href = 'dataacc.php';
	     alert('Please input qty repair under qty ng')
	     ;</script>";
		} else {
			$qty_baru = $ambil['qty'] + $qty;
			mysqli_query($conn, "UPDATE inventory SET qty = $qty_baru WHERE gmc = '$gmc'");
			// input ng_hist
			$qty_baru_ng = $ambil1['qty'] - $qty;
			mysqli_query($conn, "UPDATE ng_hist SET updated = NOW(), qty = $qty_baru_ng WHERE gmc = '$gmc'");
			// inputkan nilai qty inventory asli ke db qty_inventory di prioritas
			$qryy = mysqli_query($conn, "SELECT * from inventory WHERE gmc = '$gmc'");
			$ambill = mysqli_fetch_array($qryy);
			mysqli_query($conn, "UPDATE prioritas SET qty_inventory = $ambill[qty] WHERE gmc = '$gmc'");
			// update qty_prioritas
			$qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE gmc = '$gmc'");
			$ambilll = mysqli_fetch_array($qryyy);
			$qty_prior = $ambilll['qty_inventory'] - $ambilll['qty_plan'];
			mysqli_query($conn, "UPDATE prioritas SET qty_prioritas = '$qty_prior' WHERE gmc = '$gmc'");

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




// ambil dulu qty ng 
	// $qry1 = mysqli_query($conn, "SELECT * FROM ng_hist WHERE gmc = '$gmc'");
	// $ambil1 = mysqli_fetch_array($qry1);
	// $beforeqtyng = $qty - $ambil1['qty'];
	// $qtyyy = $ambil['qty'] - $beforeqtyng;
	// mysqli_query($conn, "UPDATE inventory SET qty = $qtyyy WHERE gmc = '$gmc'");
	// input ng_hist
	// mysqli_query($conn, "UPDATE ng_hist SET updated = NOW(), qty = $qty WHERE gmc = '$gmc'");
	// input ke prioritas
	// input ke prioritas | karena qty actual sudah dikurangi dengan CO maka harus buat sendiri lagi  qry nya