<div class="row">
    <div class="col-12" style="margin-top: 0px; padding-top: 0px;">
        <?php
        if (empty($_SESSION['ng-page-dash'])) {
            $_SESSION['ng-page-dash'] = 'inside';
        }

        if (isset($_POST['inside'])) {
            $_SESSION['ng-page-dash'] = 'inside';
        }

        if (isset($_POST['outside'])) {
            $_SESSION['ng-page-dash'] = 'outside';
        }

        if ($_SESSION['ng-page-dash'] == 'inside') {
            $in = 'disabled';
            $out = '';
        } elseif ($_SESSION['ng-page-dash'] == 'outside') {
            $in = '';
            $out = 'disabled';
        }
        ?>
        <form method="post">
            <button <?= $in ?> name="inside" class="btn btn-secondary btn-sm" style="width: 100px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">Inside</button>
            <button <?= $out ?> name="outside" class="btn btn-secondary btn-sm" style="width: 100px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">Outside</button>
        </form>
    </div>
</div>
<hr style="padding: 0px; margin: 0px;">

<?php


if ($_SESSION['ng-page-dash'] == 'inside') {
    include 'inside.php';
} elseif ($_SESSION['ng-page-dash'] == 'outside') {
    include 'outside.php';
}
?>