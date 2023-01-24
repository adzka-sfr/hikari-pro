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
        <div class="col-12">
            <div style="display: flex; flex-wrap: wrap; align-content: flex-start; gap: 1em;">
                <?php
                $sql = mysqli_query($connect_pro, "SELECT DISTINCT res.c_serialnumber, reg.c_ctrlnumber FROM formng_resulti res JOIN formng_register reg ON res.c_serialnumber = reg.c_serialnumber WHERE reg.c_incheckby = '' order by c_ctrlnumber asc");
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <form method="post">
                        <button name="b<?= $data['c_serialnumber'] ?>" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                    </form>
                    <?php
                    if (isset($_POST['b' . $data['c_serialnumber']])) {
                        $_SESSION['in_serialprint'] = $data['c_serialnumber'];
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
<!-- isi hasil scan slip number -->