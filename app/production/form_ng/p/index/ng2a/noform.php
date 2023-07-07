<!-- isi hasil scan slip number -->
<!-- To Stop Form Resubmission -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<!-- To Stop Form Resubmission -->
<hr>
<div class="dashboard_graph" style="margin-top: 10px; margin-bottom: 100px;">

    <div class="row">
        <div class="col-12">
            <h5><u>Siap untuk Print & Repair<button onclick="window.location.reload()" class="btn btn-primary ml-4"><i class="fa fa-refresh"></i></button></u></h5>
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
                    <div style="display: flex; flex-direction: column; align-content: flex-start; gap: 1em;">
                        <?php
                        $sql = mysqli_query($connect_pro, "SELECT rep.c_serialnumber, reg.c_complete1by FROM formng_repairdata rep JOIN formng_register reg ON rep.c_serialnumber = reg.c_serialnumber WHERE c_endprocess IS NULL  AND c_process = 'oc1' ORDER BY c_startprocess");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <form method="post">
                                <button name="b1<?= $data['c_serialnumber'] ?>" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                            </form>
                            <?php
                            if (isset($_POST['b1' . $data['c_serialnumber']])) {
                                $_SESSION['in_serialprint'] = $data['c_serialnumber'];
                                $_SESSION['checker'] = $data['c_complete1by'];
                                $_SESSION['process'] = 'oc1';
                            ?>
                                <script>
                                    window.location = "print1.php";
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
                        $sql = mysqli_query($connect_pro, "SELECT rep.c_serialnumber, reg.c_complete2by FROM formng_repairdata rep JOIN formng_register reg ON rep.c_serialnumber = reg.c_serialnumber WHERE c_endprocess IS NULL  AND c_process = 'oc2' ORDER BY c_startprocess");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <form method="post">
                                <button name="b2<?= $data['c_serialnumber'] ?>" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                            </form>
                            <?php
                            if (isset($_POST['b2' . $data['c_serialnumber']])) {
                                $_SESSION['in_serialprint'] = $data['c_serialnumber'];
                                $_SESSION['checker'] = $data['c_complete2by'];
                                $_SESSION['process'] = 'oc2';
                            ?>
                                <script>
                                    window.location = "print1.php";
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
                        $sql = mysqli_query($connect_pro, "SELECT rep.c_serialnumber, reg.c_complete3by FROM formng_repairdata rep JOIN formng_register reg ON rep.c_serialnumber = reg.c_serialnumber WHERE c_endprocess IS NULL  AND c_process = 'oc3' ORDER BY c_startprocess");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <form method="post">
                                <button name="b3<?= $data['c_serialnumber'] ?>" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                            </form>
                            <?php
                            if (isset($_POST['b3' . $data['c_serialnumber']])) {
                                $_SESSION['in_serialprint'] = $data['c_serialnumber'];
                                $_SESSION['checker'] = $data['c_complete3by'];
                                $_SESSION['process'] = 'oc3';
                            ?>
                                <script>
                                    window.location = "print1.php";
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
    <!-- <div class="col-4" style="text-align: center;">
        <div class="row">
            <div class="col-12">
                <h6><u>Outside Check 2aaa</u></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div style="display: flex; flex-direction: column; align-content: flex-start; gap: 1em;">
                    <?php
                    // WHERE reg.c_incheckby = ''
                    $sql = mysqli_query($connect_pro, "SELECT DISTINCT res.c_serialnumber, reg.c_ctrlnumber, res.c_checker FROM formng_resultro res JOIN formng_register reg ON res.c_serialnumber = reg.c_serialnumber WHERE reg.c_outcheck2by = '' AND res.c_process = 'oc2' order by c_ctrlnumber asc");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <form method="post">
                            <button name="b2<?= $data['c_serialnumber'] ?>" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                        </form>
                        <?php
                        if (isset($_POST['b2' . $data['c_serialnumber']])) {
                            $_SESSION['in_serialprint'] = $data['c_serialnumber'];
                            $_SESSION['outside'] = '2';
                            $_SESSION['checker'] = $data['c_checker'];
                        ?>
                            <script>
                                window.location = "print2.php";
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
                    $sql = mysqli_query($connect_pro, "SELECT DISTINCT res.c_serialnumber, reg.c_ctrlnumber, res.c_checker FROM formng_resultro res JOIN formng_register reg ON res.c_serialnumber = reg.c_serialnumber  WHERE reg.c_outcheck3by = '' AND res.c_process = 'oc3' order by c_ctrlnumber asc");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <form method="post">
                            <button name="b3<?= $data['c_serialnumber'] ?>" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                        </form>
                        <?php
                        if (isset($_POST['b3' . $data['c_serialnumber']])) {
                            $_SESSION['in_serialprint'] = $data['c_serialnumber'];
                            $_SESSION['outside'] = '3';
                            $_SESSION['checker'] = $data['c_checker'];
                        ?>
                            <script>
                                window.location = "print3.php";
                            </script>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div> -->
</div>


</div>
<!-- isi hasil scan slip number -->