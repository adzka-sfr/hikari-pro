<?php include('../_header.php'); ?>

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li class="active"><a><i class="fa fa-desktop"></i> Dashboard</a>
            </li>
            <li><a><i class="fa fa-edit"></i> Data Input <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('data_input/total_time/data_kelompok.php') ?>">Total Time</a></li>
                    <li><a href="<?= base_url('data_input/total_input/data.php') ?>">Total Input</a></li>
                </ul>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
            <li><a href="<?= base_url('history') ?>"><i class="fa fa-history"></i> History</a>
            </li>
        </ul>
    </div>

</div>

<!-- sidebar menu -->
<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a> -->
    <!-- <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> -->
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url('auth/act_logout.php') ?>">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars pb-2"></i></a>
        </div>
    </div>
</div>
<!-- /top navigation -->
<!-- page content -->
<div class="right_col" role="main">
    <center>
        <h1>Selamat Datang <b> <?php echo $_SESSION['nama'] ?> </b>di System Efficiency </h1>
    </center>
    <?php include('../_footer.php'); ?>