<?php include('../../../_header.php'); ?>

<body class="nav-md footer_fixed" style="background-color: #F7F7F7;">
    <!-- <div class="container body"> -->
    <!-- <div class="main_container"> -->
    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a href="<?= base_url('dashboard') ?>" style="padding-top: 5px; text-decoration: none; color: inherit;">
                    <h3 style="letter-spacing: 2px; padding-left: 50px; text-decoration: none;"><u><b>HIKARI</b></u></h3>
                </a>
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
                            <form>
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
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">Old Password</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input id="old_pass" name="old_pass" type="password" class="form-control" placeholder="to make sure that's you">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-4 label-align" style="padding-top: 10px;">New Password</label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <input id="new_pass" name="new_pass" type="password" class="form-control" placeholder="type new password">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <!-- Button trigger modal -->
                                        <button type="button" id="save" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="ln_solid"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /page content -->
    <!-- login and sweetalert -->
    <script src="../../../_assets/src/add/jquery.min.js"></script>
    <script src="../../../_assets/src/add/bootstrap.min.js"></script>
    <script src="../../../_assets/src/add/sweetalert2.all.min.js"></script>


    <script>
        $(document).ready(function() {

            $("#save").click(function() {

                var old_pass = $("#old_pass").val();
                var new_pass = $("#new_pass").val();

                $.ajax({

                    url: "ubah.php",
                    type: "POST",
                    data: {
                        "old_pass": old_pass,
                        "new_pass": new_pass
                    },

                    success: function(response) {

                        if (response == "oke") {

                            Swal.fire({
                                    type: 'success',
                                    title: 'Success!',
                                    text: 'Password has been change',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                })
                                .then(function() {
                                    window.location.href = "../index.php";
                                });

                        } else {

                            Swal.fire({
                                type: 'error',
                                title: 'Failed!',
                                text: 'Wrong old password'
                            });

                        }

                        console.log(response);

                    },

                    error: function(response) {

                        Swal.fire({
                            type: 'error',
                            title: 'Opps!',
                            text: 'server error!'
                        });

                        console.log(response);

                    }
                });
            });
        });
    </script>

    <?php include('../../../_footer.php'); ?>