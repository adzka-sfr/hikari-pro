<?php include('../../_header.php'); ?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
    <!-- <div class="container body"> -->
    <!-- <div class="main_container"> -->
    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">

                <h3 style="letter-spacing: 2px; padding-left: 50px;"><u><b>HIKARI</b></u></h3>

            </div>
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('_assets/production/images/profile.png') ?>" alt="profile"><?php echo $_SESSION['nama'] ?>
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url('dashboard') ?>"> Dashboard</a>
                            <a class="dropdown-item" href="<?= base_url('panel/profile') ?>">Profile</a>
                            <a class="dropdown-item" href="<?= base_url('panel/settings') ?>">Settings</a>
                            <a class="dropdown-item" href="<?= base_url('auth/act_logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="dashboard_graph" style="background-color: #F7F7F7;">

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Help</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="row">
                                <div class="col-md-12">
                                    <h2><b>How to use</b></h2>
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor quia at eaque officiis nobis. Minus veniam saepe, tempora quam quis dolores dolore dolorem numquam porro reiciendis perferendis odio esse assumenda.
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor quia at eaque officiis nobis. Minus veniam saepe, tempora quam quis dolores dolore dolorem numquam porro reiciendis perferendis odio esse assumenda.
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor quia at eaque officiis nobis. Minus veniam saepe, tempora quam quis dolores dolore dolorem numquam porro reiciendis perferendis odio esse assumenda.
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor quia at eaque officiis nobis. Minus veniam saepe, tempora quam quis dolores dolore dolorem numquam porro reiciendis perferendis odio esse assumenda.
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor quia at eaque officiis nobis. Minus veniam saepe, tempora quam quis dolores dolore dolorem numquam porro reiciendis perferendis odio esse assumenda.
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor quia at eaque officiis nobis. Minus veniam saepe, tempora quam quis dolores dolore dolorem numquam porro reiciendis perferendis odio esse assumenda.
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor quia at eaque officiis nobis. Minus veniam saepe, tempora quam quis dolores dolore dolorem numquam porro reiciendis perferendis odio esse assumenda.
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor quia at eaque officiis nobis. Minus veniam saepe, tempora quam quis dolores dolore dolorem numquam porro reiciendis perferendis odio esse assumenda.
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor quia at eaque officiis nobis. Minus veniam saepe, tempora quam quis dolores dolore dolorem numquam porro reiciendis perferendis odio esse assumenda.
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <h2><b>How it works</b></h2>
                                    <ul>
                                        <li>Department</li>
                                        <li>Section</li>
                                        <li>Group</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /page content -->

    <?php include('../../_footer.php'); ?>