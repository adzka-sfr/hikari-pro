<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <div class="row">
        <div class="col-11">
            <h3 style="font-size: 20px;"><?= $_SESSION['serialnumber_outside3'] ?> - <?= $_SESSION['pianoname_outside3'] ?></h3>
        </div>

        <div class="col-1" style="text-align: right;">
            <i>Furniture</i>
            <?php 
            $serial_number = $_SESSION['serialnumber_outside3']; // $slip
            $pianoname = $_SESSION['pianoname_outside3']; // berupa session juga harusnya //4 $model
            $process = 'oc3';
            ?>
        </div>
        <div class="separator" style="margin: 0px; padding: 0px;"></div>

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