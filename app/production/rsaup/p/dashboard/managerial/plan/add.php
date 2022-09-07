<?php
include '../../_config/pro_koneksi.php';
$type = $_POST['p_type'];
$date = $_POST['p_date'];
$model = $_POST['p_model'];
$qty = $_POST['p_qty'];

// cek isian data
if ($type != "" && $date != "" && $model != "" && $qty != "") {
	// cek duplikasi data
	$ck_sql = mysqli_query($conn, "SELECT * FROM plan WHERE keytag = '$date|$model|$type'");
	$ck_result = mysqli_num_rows($ck_sql);
	if ($ck_result > 0) {
		echo json_encode(array("statusCode" => "101"));
	} else {
		// cek tanggal kemarin
		$ck_day = date('Y-m-d');
		if ($date < $ck_day) {
			echo json_encode(array("statusCode" => "102"));
		} else {
			$sql = "INSERT INTO plan set keytag = '$date|$model|$type', tanggal = '$date', jenis = '$type', nama_piano = '$model', qty = $qty";

			// cek apakah sudah dimaasukkan dari taking result
			$cek_sql2 = mysqli_query($conn, "SELECT * FROM achieved WHERE keytag = '$date|$model|$type'");
			$cek_result2 = mysqli_fetch_row($cek_sql2);
			if ($cek_result2 == 0) {
				$sql2 = "INSERT INTO achieved set keytag = '$date|$model|$type', tanggal = '$date', jenis = '$type', nama_piano = '$model', qty = 0";
			}


			// pastikan data masuk juga pada tabel achieved
			if (mysqli_query($conn, $sql)) {
				mysqli_query($conn, $sql2);
				$_SESSION['model_piano'] = $model;
				echo json_encode(array("statusCode" => 200));
			} else {
				echo json_encode(array("statusCode" => 201));
			}
		}
	}
} else {
	echo json_encode(array("statusCode" => "103"));
}



mysqli_close($conn);
