<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <div class="row">
        <div class="separator" style="margin: 0px; padding: 0px;"></div>
        <div class="col-10">
            <!-- <h3 style="font-size: 20px;"><?= $_SESSION['serialnumber_outside2'] ?> - <?= $_SESSION['pianoname_outside2'] ?></h3> -->
        </div>

        <div class="col-2" style="text-align: right;">
            <i>Furniture</i>
            <?php
            $serial_number = $_SESSION['serialnumber_outside2']; // $slip
            $pianoname = $_SESSION['pianoname_outside2']; // berupa session juga harusnya //4 $model
            $process = 'oc2';
            ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
            include 'furniture/verif2.php';
            ?>
        </div>
    </div>
</div>
<!-- isi hasil scan slip number -->