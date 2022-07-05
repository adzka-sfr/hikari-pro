<?php
include('../_config/koneksi.php');
date_default_timezone_set('Asia/Jakarta');
error_reporting(0);

// ada tanggal
if ($_POST["query"] != "") {
	$_SESSION['search_tanggal'] = $_POST["query"];
	if ($_SESSION['search_tanggal'] != '') {
		$search_array = explode(",", $_SESSION['search_tanggal']);
		$search_text = "'" . implode("', '", $search_array) . "'";
		$query = "SELECT * FROM inventory_hist WHERE qty > 0 and tanggal IN (" . $search_text . ") ORDER BY updated DESC";
		$_SESSION['search_tanggal'] = $search_text;
		$_SESSION['search_tanggal'] = str_replace("'", " ", $_SESSION['search_tanggal']);
	}
} else {
	// tidak ada tanggal yang di input tp ada tanggal diluar input query, misalnya dari default $today
	if ($_SESSION['search_tanggal'] != '') {
		$search_array = explode(",", $_SESSION['search_tanggal']);
		$search_text = "'" . implode("', '", $search_array) . "'";
		$query = "SELECT * FROM inventory_hist where qty > 0 ORDER BY updated DESC";
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
						<th style="width: 30%; text-align: center;">Kabinet</th>
						<th style="width: 10%; text-align: center;">Dest</th>
						<th style="width: 10%; text-align: center;">Qty</th>
						<th style="width: 25%; text-align: center;">Act</th>
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
		<td style="text-align: left;">' . $row["name_kabinet"] . '</td>
		<td style="text-align: center;">' . $row["destination"] . '</td>
		<td style="text-align: center;">' . $row["qty"] . '</td>
			<td style = "text-align:center" >
			' . '<a  href="#" class="btn btn-warning btn btn-md" data-toggle="modal" data-target="#myModal' . $row["id_inventory_hist"] . '"> <i  class="glyphicon glyphicon-edit"></i></a>' . '
						<div class="modal fade" id="myModal' . $row["id_inventory_hist"] . '" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Update Data Kabinet</h4>
								</div>
								<div class="modal-body" style = "text-align=left">
									<form method="get" action="ubah.php" >
										<?php
										$id = "' . $row["id_inventory_hist"] . '";
										$query_edit = mysqli_query($conn, "SELECT * FROM inventory_hist WHERE id_inventory_hist= $id");
										while ($row = mysqli_fetch_array($query_edit)) {
										?>
											<input type="hidden" name="id_inventory_hist" value="' . $row["id_inventory_hist"] . '">
											<div class="form-group row">
												<label for="piano" style="text-align: left;" class=" col-sm-4 col-form-label">Kabinet</label>
												<div class="col-sm-8">
												<input style = "border-radius: 0.25rem; text-align: center " type="text" name="name_kabinet" class="form-control" value="' . $row["name_kabinet"] . '" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label for="destination" style="text-align: left;" class=" col-sm-4 col-form-label">Destination</label>
												<div class="col-sm-8">
													<input disabled type="text" style = "border-radius: 0.25rem; text-align: center;" name="destination" class="form-control" value="' . $row["destination"] . '">
												</div>
											</div>
											<div class="form-group row">
												<label for="quantity" style="text-align: left;" class=" col-sm-4 col-form-label">Quantity</label>
												<div class="col-sm-8">
													<input type="number" style = "border-radius: 0.25rem; text-align: center;" name="qty" class="form-control" value="' . $row["qty"] . '">
												</div>
											</div>
											<div class="modal-footer">
												<button type="ubah"  data-target="ubah.php" class="btn btn-success">Update</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										<?php
										}
										?>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
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
