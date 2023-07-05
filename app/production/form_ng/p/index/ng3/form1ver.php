<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <div class="row">
        <div class="separator" style="margin: 0px; padding: 0px;"></div>
        <div class="col-10">
            <!-- <h3 style="font-size: 20px;"><?= $_SESSION['serialnumber_outside2'] ?> - <?= $_SESSION['pianoname_outside2'] ?></h3> -->
        </div>

        <div class="col-2" style="text-align: right;">
            <i>Polyester</i>
            <?php
            $serial_number = $_SESSION['serialnumber_outside2'];
            $pianoname = $_SESSION['pianoname_outside2'];
            $process = 'oc2';
            ?>
        </div>


    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
            include 'reguler/verif2.php';
            ?>
        </div>
    </div>
</div>
<!-- isi hasil scan slip number -->