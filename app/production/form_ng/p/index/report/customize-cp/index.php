<div class="row">
    <div class="col-12" style="margin-top: 0px; padding-top: 0px;">
        <?php
        if (empty($_SESSION['co-page'])) {
            $_SESSION['co-page'] = 'furniture';
        }

        if (isset($_POST['furniture'])) {
            $_SESSION['co-page'] = 'furniture';
        }

        if (isset($_POST['silent'])) {
            $_SESSION['co-page'] = 'silent';
        }

        if (isset($_POST['polyester'])) {
            $_SESSION['co-page'] = 'polyester';
        }

        if ($_SESSION['co-page'] == 'furniture') {
            $fur = 'disabled';
            $sil = '';
            $pol = '';
        } elseif ($_SESSION['co-page'] == 'silent') {
            $fur = '';
            $sil = 'disabled';
            $pol = '';
        } elseif ($_SESSION['co-page'] == 'polyester') {
            $fur = '';
            $sil = '';
            $pol = 'disabled';
        }
        ?>
        <form method="post">
            <button <?= $fur ?> name="furniture" class="btn btn-secondary btn-sm" style="width: 100px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">Furniture</button>
            <button <?= $sil ?> name="silent" class="btn btn-secondary btn-sm" style="width: 100px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">Silent</button>
            <button <?= $pol ?> name="polyester" class="btn btn-secondary btn-sm" style="width: 100px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">Polyester</button>
        </form>
    </div>
</div>
<hr style="padding: 0px; margin: 0px;">

<?php


if ($_SESSION['co-page'] == 'furniture') {
    include 'furniture.php';
} elseif ($_SESSION['co-page'] == 'silent') {
    include 'silent.php';
} elseif ($_SESSION['co-page'] == 'polyester') {
    include 'polyester.php';
}
?>