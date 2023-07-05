<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <?php
    $type_piano = 'f';
    $serial_number = $_SESSION['serialnumber_repairo1'];
    $pianoname = $_SESSION['pianoname'];
    $process = $_SESSION['process'];
    ?>
    <div class="row">
        <div class="separator" style="margin: 0px; padding: 0px;"></div>
        <div class="col-10">
            <?php
            if (isset($_POST['or'])) {
                $_SESSION['queue'] = 'or';
            } elseif (isset($_POST['cr'])) {
                $_SESSION['queue'] = 'cr';
            }
            ?>
            <?php
            // color default
            $btn_or = 'background-color: #FFBF00; border-color: #FFBF00;';
            $btn_cr = 'background-color: #FFBF00; border-color: #FFBF00;';

            $dis_or = '';
            $dis_cr = '';

            if ($_SESSION['queue'] == 'or') {
                $btn_or = 'background-color: #6C757D; border-color: #6C757D;';
                $dis_or = 'disabled';
            } elseif ($_SESSION['queue'] == 'cr') {
                $btn_cr = 'background-color: #6C757D; border-color: #6C757D;';
                $dis_cr = 'disabled';
            }

            // cek jumlah ng pada masing-masing page
            // page outside
            $orj_sql = mysqli_query($connect_pro, "SELECT COUNT(DISTINCT c_cabinet) as jumlah_kabinet FROM formng_resultong WHERE c_serialnumber = '$serial_number' AND c_repairdate IS NULL");
            $orj_data = mysqli_fetch_array($orj_sql);

            // page completeness
            if ($process == 'oc3') {
                $crj_sql = mysqli_query($connect_pro, "SELECT COUNT(c_result3) as jumlah_complete FROM formng_resultc WHERE c_serialnumber = '$serial_number' AND c_result3 = 'NO' AND c_repairdate3 IS NULL");
                $crj_data = mysqli_fetch_array($crj_sql);
            } elseif ($process == 'oc2') {
                $crj_sql = mysqli_query($connect_pro, "SELECT COUNT(c_result2) as jumlah_complete FROM formng_resultc WHERE c_serialnumber = '$serial_number' AND c_result2 = 'NO' AND c_repairdate2 IS NULL");
                $crj_data = mysqli_fetch_array($crj_sql);
            } elseif ($process == 'oc1') {
                $crj_sql = mysqli_query($connect_pro, "SELECT COUNT(c_result1) as jumlah_complete FROM formng_resultc WHERE c_serialnumber = '$serial_number' AND c_result1 = 'NO' AND c_repairdate1 IS NULL");
                $crj_data = mysqli_fetch_array($crj_sql);
            }

            ?>
            <form method="post">
                <a><button <?= $dis_or ?> name="or" class="btn btn-secondary" style="<?= $btn_or ?> font-weight: bold; width: 250px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Outside Repair (<?= $orj_data['jumlah_kabinet'] ?>)</button></a>
                <a><button <?= $dis_cr ?> name="cr" class="btn btn-secondary" style="<?= $btn_cr ?> font-weight: bold; width: 250px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Completeness Repair (<?= $crj_data['jumlah_complete'] ?>)</button></a>
            </form>
        </div>

        <div class="col-2" style="text-align: right;">
            <i>Furniture</i>
        </div>
    </div>

    <div class="row" style="padding-top: 10px;">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 40%;">
                            <div class="row">
                                <div class="col-4">
                                    No.Seri :
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" style="text-align: center; font-size: 15px;"><u><?= $serial_number ?></u></div>
                            </div>
                        </th>
                        <th>
                            <div class="row">
                                <div class="col-4">
                                    Model :
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" style="text-align: center; font-size: 15px;"><u><?= $pianoname ?></u></div>
                            </div>
                        </th>
                    </tr>

                </thead>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <tr style="text-align: center;">
                    <td><i class="fa fa-pencil" style="color: #DC4646 ;"></i> Outside Check 1 : <b><?= $_SESSION['checker1repair'] ?></b></td>
                    <td><i class="fa fa-pencil" style="color: #5AA65A ;"></i> Outside Check 2 : <b><?= $_SESSION['checker2repair'] ?></b></td>
                    <td><i class="fa fa-pencil" style="color: #1340FF ;"></i> Outside Check 3 : <b><?= $_SESSION['checker3repair'] ?></b></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- isi gambar -->
            <!-- gambar 1 -->
            <?php
            // session untuk menyimpan halaman terakhir
            if (empty($_SESSION['queue'])) {
                $_SESSION['queue'] = "or";
            } else {
                if ($_SESSION['queue'] == "or") {
                    include 'furniture/outside.php';
                } elseif ($_SESSION['queue'] == "cr") {
                    include 'furniture/completeness.php';
                }
            }
            ?>
        </div>
    </div>


</div>
<!-- isi hasil scan slip number -->