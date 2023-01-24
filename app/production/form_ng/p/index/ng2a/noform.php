<!-- isi hasil scan slip number -->
<!-- To Stop Form Resubmission -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<!-- To Stop Form Resubmission -->
<div class="dashboard_graph" style="margin-top: 10px;">

    <div class="row">
        <div class="col-12">
            <h5><u>Already to Print & Repair</u></h5>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-4" style="text-align: center;">
            <div class="row">
                <div class="col-12">
                    <h6><u>Outside Check 1</u></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <div style="display: flex; flex-direction: column;  align-content: center; ">
                        <?php
                        // WHERE reg.c_incheckby = ''
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT res.c_serialnumber, reg.c_ctrlnumber FROM formng_resultro res JOIN formng_register reg ON res.c_serialnumber = reg.c_serialnumber WHERE reg.c_outcheck1by = '' AND res.c_process = 'oc1' order by c_ctrlnumber asc");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <form method="post">
                                <button name="b1<?= $data['c_serialnumber'] ?>" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                            </form>
                            <?php
                            if (isset($_POST['b1' . $data['c_serialnumber']])) {
                                $_SESSION['in_serialprint'] = $data['c_serialnumber'];
                                $_SESSION['outside'] = '1';
                            ?>
                                <script>
                                    window.location = "print.php";
                                </script>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4" style="text-align: center;">
            <div class="row">
                <div class="col-12">
                    <h6><u>Outside Check 2</u></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div style="display: flex; flex-direction: column; align-content: flex-start; gap: 1em;">
                        <?php
                        // WHERE reg.c_incheckby = ''
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT res.c_serialnumber, reg.c_ctrlnumber FROM formng_resultro res JOIN formng_register reg ON res.c_serialnumber = reg.c_serialnumber WHERE reg.c_outcheck2by = '' AND res.c_process = 'oc2' order by c_ctrlnumber asc");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <form method="post">
                                <button name="b2<?= $data['c_serialnumber'] ?>" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                            </form>
                            <?php
                            if (isset($_POST['b2' . $data['c_serialnumber']])) {
                                $_SESSION['in_serialprint'] = $data['c_serialnumber'];
                                $_SESSION['outside'] = '2';
                            ?>
                                <script>
                                    window.location = "print.php";
                                </script>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4" style="text-align: center;">
            <div class="row">
                <div class="col-12">
                    <h6><u>Outside Check 3</u></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div style="display: flex; flex-direction: column; align-content: flex-start; gap: 1em;">
                        <?php
                        // WHERE reg.c_incheckby = ''
                        $sql = mysqli_query($connect_pro, "SELECT DISTINCT res.c_serialnumber, reg.c_ctrlnumber FROM formng_resultro res JOIN formng_register reg ON res.c_serialnumber = reg.c_serialnumber  WHERE reg.c_outcheck3by = '' AND res.c_process = 'oc3' order by c_ctrlnumber asc");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <form method="post">
                                <button name="b3<?= $data['c_serialnumber'] ?>" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                            </form>
                            <?php
                            if (isset($_POST['b3' . $data['c_serialnumber']])) {
                                $_SESSION['in_serialprint'] = $data['c_serialnumber'];
                                $_SESSION['outside'] = '3';
                            ?>
                                <script>
                                    window.location = "print.php";
                                </script>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- isi hasil scan slip number -->