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
		$query = "SELECT * FROM inventory_hist WHERE pcs > 0 and tanggal IN (" . $search_text . ") ORDER BY updated DESC";
		$_SESSION['search_tanggal'] = $search_text;
		$_SESSION['search_tanggal'] = str_replace("'", " ", $_SESSION['search_tanggal']);
	}
} else {
	// tidak ada tanggal yang di input tp ada tanggal diluar input query, misalnya dari default $today
	if ($_SESSION['search_tanggal'] != '') {
		$search_array = explode(",", $_SESSION['search_tanggal']);
		$search_text = "'" . implode("', '", $search_array) . "'";
		$query = "SELECT * FROM inventory_hist where pcs > 0 ORDER BY updated DESC";
	}
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '';
$no = 0;

$output = '
<div style="overflow-y: scroll; height: 300px;">
	<table style="font-size : 16px; border-radius: 0.25rem; border: 1px solid #ddd" id="myTable" class="table table-responsive tableFixHead">
					<thead style = "background-color: #f1f1f1;">
                        <tr>
						<th style="min-width: 40px; text-align: center ">No</th>
						<th style="width: 25%; text-align: center;">Date</th>
						<th style="width: 40%; text-align: center;">Cabintet</th>
						<th style="width: 10%; text-align: center;">Dest</th>
						<th style="width: 10%; text-align: center;">Qty</th>
						<th style="width: 15%; text-align: center;">Act</th>
                        </tr>
                    </thead>
';
// ada row/isi
if ($total_row > 0) {
	foreach ($result as $row) {
		$no++;
		$output .= '
		<tr>
		<td style = "text-align:center">' . $no . '</td>
		<td style="text-align: center;">' . $row["updated"] . '</td>
		<td style="text-align: left;">' . $row["name_cabinet"] . '</td>
		<td style="text-align: center;">' . $row["dest"] . '</td>
		<td style="text-align: center;">' . $row["pcs"] . '</td>
			<td style = "text-align:center" >
				<a href="del.php?id_inventory_hist= ' . $row["id_inventory_hist"] . '" onclick="return confirm(Yakin hapus data ?)" class="btn btn-danger" style="background-color: rgb(224, 47, 47,0.8)"><i class="fa fa-trash"></i></a>
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
