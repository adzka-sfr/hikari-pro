<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <div class="row">
        <div class="col-11">
            <h3 style="font-size: 20px;"><?= $_SESSION['serialnumber_outside1'] ?> - <?= $_SESSION['pianoname_outside1'] ?></h3>
        </div>

        <div class="col-1" style="text-align: right;">
            <i>Polyester</i>
            <?php
            $type_piano = 'p';
            $serial_number = $_SESSION['serialnumber_outside1'];
            $piano_name = $_SESSION['pianoname_outside1'];

            ?>
        </div>
        <div class="separator" style="margin: 0px; padding: 0px;"></div>

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