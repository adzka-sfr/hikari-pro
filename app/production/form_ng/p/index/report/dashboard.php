<div class="row">
    <div class="col-12" style="margin-top: 0px; padding-top: 0px;">
        <?php
        if (empty($_SESSION['dashboard-ratio'])) {
            $_SESSION['dashboard-ratio'] = 'daily';
        }

        if (isset($_POST['daily'])) {
            $_SESSION['dashboard-ratio'] = 'daily';
        }

        if (isset($_POST['monthly'])) {
            $_SESSION['dashboard-ratio'] = 'monthly';
        }

        if ($_SESSION['dashboard-ratio'] == 'daily') {
            $in = 'disabled';
            $out = '';
        } elseif ($_SESSION['dashboard-ratio'] == 'monthly') {
            $in = '';
            $out = 'disabled';
        }
        ?>
        <form method="post">
            <button <?= $in ?> name="daily" class="btn btn-secondary btn-sm" style="width: 100px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">Daily</button>
            <button <?= $out ?> name="monthly" class="btn btn-secondary btn-sm" style="width: 100px; margin-bottom: 0px; border-top-left-radius: 10px; border-top-right-radius: 10px;">Monthly</button>
        </form>
    </div>
</div>
<hr style="padding: 0px; margin: 0px;">

<?php


if ($_SESSION['dashboard-ratio'] == 'daily') {
    include 'dashboard-ratio/daily.php';
} elseif ($_SESSION['dashboard-ratio'] == 'monthly') {
    include 'dashboard-ratio/monthly.php';
}
?>