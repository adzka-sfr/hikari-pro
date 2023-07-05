<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <div class="row">
        <div class="col-11">
            <h3 style="font-size: 20px;"><?= $_SESSION['serialnumber_repairo1'] ?> - <?= $_SESSION['pianoname_repairo1'] ?></h3>
        </div>

        <div class="col-1" style="text-align: right;">
            <i>Furniture</i>
            <?php
            $type_piano = 'f';
            $serial_number = $_SESSION['serialnumber_repairo1'];
            $piano_name = $_SESSION['pianoname_repairo1'];

            ?>
        </div>
        <div class="separator" style="margin: 0px; padding: 0px;"></div>

    </div>
    <div class="row" style="padding-top: 0px;">
        <div class="col-md-9" style=" text-align: left; ">
            <?php
            if (isset($_POST['tbo'])) {
                $_SESSION['queue'] = 'tbo';
            } elseif (isset($_POST['tbi'])) {
                $_SESSION['queue'] = 'tbi';
            } elseif (isset($_POST['uk'])) {
                $_SESSION['queue'] = 'uk';
            } elseif (isset($_POST['b'])) {
                $_SESSION['queue'] = 'b';
            } elseif (isset($_POST['bb'])) {
                $_SESSION['queue'] = 'bb';
            } elseif (isset($_POST['cn'])) {
                $_SESSION['queue'] = 'cn';
            }
            ?>
            <?php
            // color default
            $btn_tbo = 'background-color: #FFBF00; border-color: #FFBF00;';
            $btn_tbi = 'background-color: #FFBF00; border-color: #FFBF00;';
            $btn_uk = 'background-color: #FFBF00; border-color: #FFBF00;';
            $btn_b = 'background-color: #FFBF00; border-color: #FFBF00;';
            $btn_bb = 'background-color: #FFBF00; border-color: #FFBF00;';
            $btn_cn = 'background-color: #FFBF00; border-color: #FFBF00;';

            $dis_tbo = '';
            $dis_tbi = '';
            $dis_uk = '';
            $dis_b = '';
            $dis_bb = '';
            $dis_cn = '';

            if ($_SESSION['queue'] == 'tbo') {
                $btn_tbo = 'background-color: #6C757D; border-color: #6C757D;';
                $dis_tbo = 'disabled';
            } elseif ($_SESSION['queue'] == 'tbi') {
                $btn_tbi = 'background-color: #6C757D; border-color: #6C757D;';
                $dis_tbi = 'disabled';
            } elseif ($_SESSION['queue'] == 'uk') {
                $btn_uk = 'background-color: #6C757D; border-color: #6C757D;';
                $dis_uk = 'disabled';
            } elseif ($_SESSION['queue'] == 'b') {
                $btn_b = 'background-color: #6C757D; border-color: #6C757D;';
                $dis_b = 'disabled';
            } elseif ($_SESSION['queue'] == 'bb') {
                $btn_bb = 'background-color: #6C757D; border-color: #6C757D;';
                $dis_bb = 'disabled';
            } elseif ($_SESSION['queue'] == 'cn') {
                $btn_cn = 'background-color: #6C757D; border-color: #6C757D;';
                $dis_cn = 'disabled';
            }
            ?>

            <form method="post">
                <a><button <?= $dis_tbo ?> name="tbo" class="btn btn-secondary" style="<?= $btn_tbo ?> font-weight: bold; width: 100px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">TBO</button></a>
                <a><button <?= $dis_tbi ?> name="tbi" class="btn btn-secondary" style="<?= $btn_tbi ?> font-weight: bold; width: 100px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">TBI</button></a>
                <a><button <?= $dis_uk ?> name="uk" class="btn btn-secondary" style="<?= $btn_uk ?> font-weight: bold; width: 100px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">UK</button></a>
                <a><button <?= $dis_b ?> name="b" class="btn btn-secondary" style="<?= $btn_b ?> font-weight: bold; width: 100px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">B</button></a>
                <a><button <?= $dis_bb ?> name="bb" class="btn btn-secondary" style="<?= $btn_bb ?> font-weight: bold; width: 100px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">BB</button></a>
            </form>

        </div>
        <div class="col-3">
            <form method="post">
                <a><button <?= $dis_cn ?> name="cn" class="btn btn-secondary" style="<?= $btn_cn ?> font-weight: bold; width: 150px; height: 30px; padding-top: 2px; padding-bottom: 2px; border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-right-radius:15px;border-bottom-left-radius:15px; ">Completeness</button></a>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- isi gambar -->
            <!-- gambar 1 -->
            <?php
            // session untuk menyimpan halaman terakhir
            if (empty($_SESSION['queue'])) {
                $_SESSION['queue'] = "tbo";
            } else {
                if ($_SESSION['queue'] == "tbo") {
                    include 'furniture/top_board_outside.php';
                } elseif ($_SESSION['queue'] == "tbi") {
                    include 'furniture/top_board_inside.php';
                } elseif ($_SESSION['queue'] == "uk") {
                    include 'furniture/upper_keyboard.php';
                } elseif ($_SESSION['queue'] == "b") {
                    include 'furniture/body.php';
                } elseif ($_SESSION['queue'] == "bb") {
                    include 'furniture/body_back.php';
                } elseif ($_SESSION['queue'] == "cn") {
                    include 'furniture/completeness.php';
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- isi hasil scan slip number -->