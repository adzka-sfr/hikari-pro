<?php
include('../../_config/koneksi.php');
date_default_timezone_set('Asia/Jakarta');
error_reporting(0);

// ada tanggal
if ($_POST["query"] != "") {
	$_SESSION['search_tanggal'] = $_POST["query"];
	if ($_SESSION['search_tanggal'] != '') {
		$search_array = explode(",", $_SESSION['search_tanggal']);
		$search_text = "'" . implode("', '", $search_array) . "'";
		$query = "SELECT * FROM planing WHERE tanggal IN (" . $search_text . ") ORDER BY id_plan DESC";
		$_SESSION['search_tanggal'] = $search_text;
		$_SESSION['search_tanggal'] = str_replace("'", " ", $_SESSION['search_tanggal']);
	}
} else {
	if ($_SESSION['search_tanggal'] != '') {
		$search_array = explode(",", $_SESSION['search_tanggal']);
		$search_text = "'" . implode("', '", $search_array) . "'";
		$query = "SELECT * FROM planing ORDER BY id_plan DESC";
	}
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '';
$no = 0;


$output = '
<div style="overflow-y: scroll; height: 300px; display: block">
	<table style="font-size : 16px; border-radius: 0.25rem; border: 1px solid #ddd" id="myTable" class="table tableFixHead">
						<thead style = "background-color: #f1f1f1;">
                        <tr>
						<th style="min-width: 40px; text-align: center ">No</th>
						<th style="width: 20%; text-align: center;">Date</th>
						<th style="width: 20%; text-align: center;">Model</th>
						<th style="width: 10%; text-align: center;">Plan</th>
						<th style="width: 20%; text-align: center;">CO (RatioSet)</th>
						<th style="width: 20%; text-align: center;">Act</th>
                        </tr>
                    </thead>
';
// ada row/isi
if ($total_row > 0) {
	foreach ($result as $row) {
		$no++;
		$output .= '
		<tr>
			<td style ="text-align:center">' . $no . '</td>
			<td style="text-align: center;">' . $row["tanggal"] . '</td>
			<td style="text-align: left;">' . $row["name_piano"] . '</td>
			<td style="text-align: center;">' . $row["qty"] . '</td>
			<td style="text-align: center;">' . $row["qtyCo"] . '</td>
			<td style = "text-align:center" >
				<a href="del.php?id_plan= ' . $row["id_plan"] . ' "onclick= return confirm("Yakin hapus data ?")" class="btn btn-danger"><i class="fa fa-trash" disabled></i></a>
			</td>
		</tr>
		';
	}
} else {
	// tidak ada row
	$output .= '
	<tr>
		<td colspan="8" style="text-align: center;">No Data Found</td>
	</tr>
	';
}
$output .= '</table></div>';
echo $output;
