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
                            <a class="dropdown-item" href="<?= base_url('panel/settings') ?>">Settings</a>
                            <a class="dropdown-item" href="<?= base_url('panel/help') ?>">Help</a>
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
                            <h3 style="text-align: center;">Profile</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content" style="text-align: center;">

                            <img style="border-radius: 50%; margin-bottom: 10px;" src="<?= base_url('_assets/production/images/profile.png') ?>" alt="">
                            <br />

                            <?php
                            $sql1 = mysqli_query($connect, "SELECT * from auth where id = '$_SESSION[id]'");
                            $data1 = mysqli_fetch_array($sql1);
                            ?>
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">ID</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input type="text" class="form-control" value="<?= $data1['id'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Name</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input type="text" class="form-control" value="<?= $data1['nama'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Position</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input type="text" class="form-control" value="<?= $data1['jabatan'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Department</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input id="middle-name" class="form-control" value="<?= $data1['dept'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Gender</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input id="middle-name" class="form-control" value="<?= $data1['jenkel'] ?>" disabled>
                                    </div>
                                </div>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /page content -->

    <?php include('../../_footer.php'); ?>