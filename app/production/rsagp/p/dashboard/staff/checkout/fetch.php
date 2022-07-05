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
		// $query = "SELECT p.id_plan ,p.tanggal, p.update_co, p.qtyCoG0, p.qtyCoG2, p.qtyCo, p.qtyCoUp, p.qty ,p.name_piano ,MIN(a.pcs) as qtyy FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc = b.gmc INNER JOIN planing p ON p.name_piano = a.name_piano  WHERE p.tanggal IN (" . $search_text . ") GROUP BY p.name_piano,qty ORDER BY p.tanggal desc";
		$query = "SELECT b.name_cabinet, p.id_plan ,p.tanggal, p.update_co, p.qtyCoG0, p.qtyCoG1, p.qtyCoG2, p.qtyCo, p.qtyCoUp, p.qty as plan,p.name_piano, MIN(a.pcs) as minpcsinf,b.qtyperunit, MIN(a.pcs/b.qtyperunit) as unit FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c INNER JOIN planing p ON p.name_piano = b.name_piano WHERE p.tanggal IN (" . $search_text . ")  GROUP BY p.name_piano, qty ORDER BY p.tanggal desc";
		$_SESSION['search_tanggal'] = $search_text;
		$_SESSION['search_tanggal'] = str_replace("'", " ", $_SESSION['search_tanggal']);
	}
} else {
	// tidak ada tanggal yang di input tp ada tanggal diluar input query, misalnya dari default $today
	if ($_SESSION['search_tanggal'] != '') {
		$search_array = explode(",", $_SESSION['search_tanggal']);
		$search_text = "'" . implode("', '", $search_array) . "'";
		// $query = "SELECT p.id_plan ,p.tanggal, p.update_co, p.qtyCoG0, p.qtyCoG2, p.qtyCo, p.qtyCoUp, p.qty ,p.name_piano FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c INNER JOIN planing p ON p.name_piano = b.name_piano GROUP BY p.name_piano,qty ORDER BY p.tanggal desc";
		$query = "SELECT b.name_cabinet, p.id_plan ,p.tanggal, p.update_co, p.qtyCoG0, p.qtyCoG1,p.qtyCoG2, p.qtyCo, p.qtyCoUp, p.qty as plan,p.name_piano, MIN(a.pcs) as minpcsinf,b.qtyperunit, MIN(a.pcs/b.qtyperunit) as unit FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c INNER JOIN planing p ON p.name_piano = b.name_piano GROUP BY p.name_piano, qty ORDER BY p.tanggal desc";
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
						<th style="width: 15%; text-align: center;">Date</th>
						<th style="width: 20%; text-align: center;">Model</th>
						<th style="width: 10%; text-align: center;">Plan(u)</th>
						<th style="width: 10%; text-align: center;">CO G130</th>
						<th style="width: 10%; text-align: center;">CO G150</th>
						<th style="width: 10%; text-align: center;">CO G200</th>
						<th style="width: 10%; text-align: center;">Set(u)</th>
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
		<td style="text-align: center;">' . $row["plan"] . '</td>
		<td style="text-align: center;">' . $row["qtyCoG0"] . '</td>
		<td style="text-align: center;">' . $row["qtyCoG1"] . '</td>
		<td style="text-align: center;">' . $row["qtyCoG2"] . '</td>
		<td style="text-align: center; color:  skyblue; font-weight: 900">' . floor($row["unit"]) . '</td>

			<td style = "text-align:center" >
				' . '<a  href="#" class="btn btn-success btn btn-md" data-toggle="modal" data-target="#myModall' . $row["id_plan"] . '"> <i  class="fa fa-shopping-cart"></i></a>' . '
					<div class="modal fade" id="myModall' . $row["id_plan"] . '" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Checkout Kabinet items</h4>
								</div>
								<div class="modal-body" style = "text-align=left">
									<form method="get" action="co.php" >
										<?php
										$id = "' . $row["id_plan"] . '";
										$query_edit = mysqli_query($conn, "SELECT * FROM planing WHERE id_plan= $id");
										while ($row = mysqli_fetch_array($query_edit)) {
										?>
											<input type="hidden" name="id_plan" value="' . $row["id_plan"] . '">
											<div class="form-group row">
												<label for="tanggal" style="text-align: left;" class=" col-sm-4 col-form-label">Tanggal</label>
												<div class="col-sm-8">
												<input disabled style = "border-radius: 0.25rem; text-align: center " type="text" name="tanggal" class="form-control" value="' . $row["tanggal"] . '">
												</div>
											</div>
											<div class="form-group row">
												<label for="piano" style="text-align: left;" class=" col-sm-4 col-form-label">Piano</label>
												<div class="col-sm-8">
												<input disabled style = "border-radius: 0.25rem; text-align: center " type="text" name="piano_name" class="form-control" value="' . $row["name_piano"] . '">
												</div>
											</div>
											<div class="form-group row">
												<label for="quantity" style="text-align: left;" class=" col-sm-4 col-form-label">CO QTY</label>
												<div class="col-sm-8">
													<div class="row">
														<div class="col-4">
															<input type="number" style = "border-radius: 0.25rem; text-align: center;" name="qtycog0" class="form-control"placeholder = "G 130">
														</div>
														<div class="col-4">
															<input type="number" style = "border-radius: 0.25rem; text-align: center;" name="qtycog1" class="form-control"placeholder = "G 150">
														</div>
														<div class="col-4">
															<input type="number" style = "border-radius: 0.25rem; text-align: center;" name="qtycog2" class="form-control"placeholder = "G 200">
														</div>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submittt"  data-target="checkout.php" class="btn btn-success">Checkout</button>
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
