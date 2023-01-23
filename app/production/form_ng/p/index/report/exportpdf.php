
<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-8">
                <form method="post">
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="col-md-11 xdisplay_inputx form-group row has-feedback">
                                    <input type="text" name="tgl" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
            </div>
            <div class="col-4">
                <button name="submit1" class="btn btn-success" style="width: 100px;">Search</button>
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
                    <select class="ngen" style="width: 100% " name="serial">
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
                <button name="submit2" class="btn btn-success" style="width: 100px;">Search</button>
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

<?php
if (isset($_POST['submit1'])) {
    $_SESSION['dateshow'] = $_POST['tgl'];
?>
    <script>
        window.location = "main.php?p=wkejfgheukj";
    </script>
<?php
}

if (isset($_POST['submit2'])) {
    $_SESSION['serialshow'] = $_POST['serial'];
?>
    <script>
        window.location = "main.php?p=leigjwiroeh";
    </script>
<?php
}
?>