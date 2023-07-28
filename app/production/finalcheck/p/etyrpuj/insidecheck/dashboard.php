<?php
require('../config.php');
?>
<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<div class="row">
    <div class="col-12 mt-3">
        <h5>Hasil hari ini, <?= date('d M', strtotime($now)) ?> (<?= $_SESSION['nama'] ?>)</h5>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <b>Total : 15 piano</b>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered" style="font-size: 20px;">
            <thead style="text-align: center;">
                <th style="width: 5%;">No</th>
                <th>No Seri</th>
                <th>NG</th>
                <th>OK</th>
            </thead>
            <tbody style="text-align: center;">
                <tr>
                    <td>1</td>
                    <td>J7638237</td>
                    <td>23-09-2023 12:20 AM</td>
                    <td>23-09-2023 12:50 AM</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>J7638237</td>
                    <td>-</td>
                    <td>23-09-2023 12:50 AM</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>