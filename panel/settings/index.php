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
                            <h3 style="text-align: center;">Settings</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content" style="text-align: center;">

                            <img style="border-radius: 50%; margin-bottom: 10px;" src="<?= base_url('_assets/production/images/profile.png') ?>" alt="">
                            <br />

                            <?php
                            $sql1 = mysqli_query($connect, "SELECT * from auth where id = '$_SESSION[id]'");
                            $data1 = mysqli_fetch_array($sql1);
                            ?>

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
                                <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Password</label>
                                <div class="col-md-4 col-sm-4 ">
                                    <?php
                                    $length_pass = strlen($data1['pass']);

                                    function generatestar($len)
                                    {
                                        $shw = "";
                                        for ($j = 0; $j < $len; $j++) {
                                            $shw = "*" . $shw;
                                        }
                                        return $shw;
                                    }
                                    $show_star = generatestar($length_pass);


                                    ?>
                                    <input id="middle-name" type="password" class="form-control" value="<?= $show_star ?>" disabled>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <!-- Button trigger modal -->
                                    <a href="change_pass">
                                        <button type="button" class="btn btn-primary">
                                            Change password
                                        </button>
                                    </a>
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