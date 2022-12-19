<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <div class="row">
        <div class="col-11">
            <?php
            $sql = mysqli_query($connect_p, "SELECT distinct c_piano from on_progress where c_no_slip = '$_SESSION[no_slip]' ");
            $data = mysqli_fetch_array($sql);
            ?>
            <h3><?= $_SESSION['no_slip'] ?> - <?= $data['c_piano'] ?></h3>

        </div>

        <div class="col-1" style="text-align: right;">
            <i>T2</i>
        </div>
        <div class="separator"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- isi gambar -->

            <!-- gambar 1 -->
            <?php
            include 'furniture/top_board_outside.php';
            ?>
            <div class="separator"></div>
            <!-- gambar 2 -->
            <?php
            include 'furniture/top_board_inside.php';
            ?>
            <div class="separator"></div>
            <!-- gambar 3 -->
            <?php
            include 'furniture/upper_keyboard.php';
            ?>
            <div class="separator"></div>
            <!-- gambar 4 -->
            <?php
            include 'furniture/body.php';
            ?>
            <div class="separator"></div>
            <!-- gambar 4 -->
            <?php
            include 'furniture/body_back.php';
            ?>
        </div>
    </div>
</div>
<!-- isi hasil scan slip number -->