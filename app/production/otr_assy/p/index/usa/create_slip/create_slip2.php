<?php
?>
<script src="<?= base_url('_assets/src/add/sweetalert2.all.min.js') ?>"></script>
<div class="dashboard_graph" style="padding-top: 10px;">
    <div class="row">
        <div class="col-12">
            <h2>Create Slip</h2>
        </div>
        <div class="separator"></div>
    </div>

    <div class="row">
        <div class="col-12">
            <form method="POST" id="fupForm" data-parsley-validate class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Slip
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" name="slip" readonly id="slip" value="<?= $_SESSION['kode_slip'] ?>" class="form-control " style="border-radius: 5px;">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Cabinet Name
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <select id="cari" name="code" style="width: 100%;" required>
                            <?php

                            // $sql_list = mysqli_query($conn, "SELECT DISTINCT nama_piano from piano_bd WHERE nama_piano NOT IN ('$_SESSION[model_piano]')");

                            ?>
                            <option disabled value="" selected>
                                <?php
                                $list_cab = mysqli_query($con_pro, "SELECT * from kabinet order by nama_kabinet");
                                while ($data_cab = mysqli_fetch_array($list_cab)) {
                                ?>
                            <option value="<?= $data_cab['kode'] ?>"><?= $data_cab['nama_kabinet'] ?></option>
                        <?php
                                }
                        ?>
                        </option>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Qty</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input class="form-control" required type="number" id="qty" name="qty" style="border-radius: 5px; width: 30%;">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">On Process/Finish</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="radio" class="flat" name="status" id="op" value="On Process" required /> On Process
                        <input type="radio" class="flat" name="status" id="f" value="Finish" /> Finish
                    </div>
                </div>
                <!-- <div class="ln_solid"></div> -->
                <div class="item form-group" style="text-align: right;">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" id="butadd" name="butadd" class="btn btn-primary" style="width: 100px;">Add</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="separator"></div>


    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">Slip Number:<br> <?php echo "<img src='create_slip/barcode.php?text=" . $_SESSION['kode_slip'] . "&codetype=code39&print=true&size=25'  />" ?></th>
                        <th rowspan="3">Control Stock Seasoning 2&16 Hours</th>
                        <th colspan="2">Work Center</th>
                        <th colspan="4">P200/P210</th>
                    </tr>
                    <tr>
                        <th colspan="2">Estimate finished 2 hours:</th>
                        <th>20-10-2022</th>
                        <th colspan="3">10:32 WIB</th>
                    </tr>
                    <tr>
                        <th>Issue Date: 20-10-2022</th>
                        <th colspan="2">Estimate finished 16 hours:</th>
                        <th>20-10-2022</th>
                        <th colspan="3">00:32:00 WIB</th>
                    </tr>
                    <tr>
                        <th>GMC</th>
                        <th>CABINET NAME</th>
                        <th>ON PROCESS/FINISH</th>
                        <th>QTY</th>
                        <th>REMAINING</th>
                        <th>CATEGORY</th>
                        <th>UOM</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>