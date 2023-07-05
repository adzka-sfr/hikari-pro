<?php
if (empty($_SESSION['dateshow'])) {
?>
    <script>
        window.location = "main.php?p=pdf";
    </script>
<?php
}

$dateshow = date('Y-m-d', strtotime($_SESSION['dateshow']));
?>
<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-8">
                <form method="post">
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="col-md-11 xdisplay_inputx form-group row has-feedback">
                                    <input disabled type="text" value="<?= $_SESSION['dateshow'] ?>" name="tgl" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
            </div>
            <div class="col-4">
                <button name="submit1" class="btn btn-danger" style="width: 100px;">Clear</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12" style=" padding-bottom: 10px; padding-left: 30%;">
                OR
            </div>
        </div>

        <div class="row">

            <div class="col-8">
                <form method="post">
                    <select disabled class="ngen" style="width: 100% " name="serial">
                        <option></option>
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_finishoutcheck3 != ''");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <option value="<?= $data['c_serialnumber'] ?>"><?= $data['c_serialnumber'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
            </div>
            <div class="col-4">
                <button disabled name="submit2" class="btn btn-success" style="width: 100px;">Search</button>
                </form>
            </div>

        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-12" style="text-align: right;">
                <h3>All Piano Passes Checking</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: right;">
                <?php
                $sql1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as jumlah FROM formng_register WHERE c_finishoutcheck3 != ''");
                $data1 = mysqli_fetch_array($sql1);
                ?>
                <h1><?= $data1['jumlah'] ?> Unit</h1>
            </div>
        </div>
    </div>
</div>

<div class="separator"></div>

<div class="row">
    <div class="col-12">
        <h5>Information by Date : <?= $dateshow ?></h5>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table">
            <thead>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 20%;">Serial Number</th>
                <th>Piano Name</th>
                <th style="text-align: center; width: 20%;">Passed Inspection</th>
                <th style="text-align: center; width: 20%;">Action</th>
            </thead>
            <tbody>
                <?php
                $sql3 = mysqli_query($connect_pro, "SELECT id FROM formng_register WHERE c_finishoutcheck3 LIKE '$dateshow%'");
                $data3 = mysqli_fetch_array($sql3);

                if (!empty($data3['id'])) {
                    $no = 0;
                    $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_finishoutcheck3 LIKE '$dateshow%' ORDER BY c_serialnumber");
                    while ($data2 = mysqli_fetch_array($sql2)) {
                        $no++;
                ?>
                        <tr>
                            <td style="text-align: center;"><?= $no ?></td>
                            <td><?= $data2['c_serialnumber'] ?></td>
                            <td><?= $data2['c_pianoname'] ?></td>
                            <td style="text-align: center;"><?= $data2['c_finishoutcheck3'] ?></td>
                            <td style="text-align: center;">

                                <form method="post">
                                    <button class="btn btn-primary btn-sm" name="b<?= $data2['id'] ?>">Preview</button>
                                </form>
                                <?php
                                if (isset($_POST['b' . $data2['id']])) {
                                    $_SESSION['pdf'] = $data2['c_serialnumber'];
                                    $_SESSION['gmcpdf'] = $data2['c_gmc'];
                                    $_SESSION['namepianopdf'] = $data2['c_pianoname']
                                ?>
                                    <script>
                                        window.location = "export-content/show.php";
                                    </script>
                                <?php
                                }
                                ?>

                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Data not found</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php
if (isset($_POST['submit1'])) {
    unset($_SESSION['dateshow']);
?>
    <script>
        window.location = "main.php?p=pdf";
    </script>
<?php
}

if (isset($_POST['submit2'])) {
    unset($_SESSION['serialshow']);
?>
    <script>
        window.location = "main.php?p=pdf";
    </script>
<?php
}
?>