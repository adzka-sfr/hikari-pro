<!DOCTYPE html>
<html lang="en">
<?php
include '../koneksi.php';
session_start();
error_reporting(0);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lib</title>
    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
</head>

<body style="background-color: #ffffff;">

    <div class="row">
        <div class="col-12">
            <center>
                <div style="width: 500px; margin-top: 1%; padding: 10px;" class="card">
                    <div class="row">
                        <div class="col-12">
                            <h5>Add User Admin</h5>
                        </div>
                    </div>
                    <form method="POST">
                        <div class="row">
                            <div class="col-12" style="text-align: left;">
                                <label for="fullname">ID * :</label>
                                <input type="text" id="id" class="form-control" name="id" required />

                                <label for="fullname">Name * :</label>
                                <input type="text" id="name" class="form-control" name="name" required />

                                <label for="email">Dept * :</label>
                                <select name="dept" class="form-control">
                                    <option value="Woodworking">Woodworking</option>
                                    <option value="Painting">Painting</option>
                                    <option value="GP Assy">GP Assy</option>
                                    <option value="UP Assy">UP Assy</option>
                                    <option value="Quality Control">Quality Control</option>
                                </select>

                                <label for="email">Pass * :</label>
                                <input type="password" id="password" class="form-control" name="pass" data-parsley-trigger="change" required />

                                <div class="row">
                                    <div class="col-6">
                                        <label for="email">Auth * :</label>
                                        <input type="text" id="auth" class="form-control" name="auth" data-parsley-trigger="change" required />
                                    </div>
                                    <div class="col-6">
                                        <label for="email">Keygen * :</label>
                                        <input type="password" id="keygen" class="form-control" name="keygen" data-parsley-trigger="change" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <button type="submit" name="regis" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </center>
        </div>
    </div>
    <?php
    if (isset($_POST['regis'])) {
        $auth = md5($_POST['auth']);
        $pass = md5($_POST['keygen']);

        $cek = mysqli_query($conn, "SELECT * from authen where name = '$auth' and pass = '$pass'");
        $data = mysqli_fetch_array($cek);

        if (!empty($data)) {
            $c_data = mysqli_query($conn, "SELECT * from auth where id = '$_POST[id]'");
            $d_data = mysqli_fetch_array($c_data);

            if (empty($d_data)) {
                $id = $_POST['id'];
                $name = strtolower($_POST['name']);
                $name = ucfirst($name);
                $dept = $_POST['dept'];
                $kun = strtolower($_POST['pass']);
                $kunci = md5($kun);
                mysqli_query($conn, "INSERT into auth set id = '$id',nama = '$name', dept = '$dept', pass = '$kunci'");
                $_SESSION['berhasil_auth'] = "y";
            } else {
                $_SESSION['berhasil_auth'] = "n";
            }
        } else {
            $_SESSION['berhasil_auth'] = "t";
        }
    }
    ?>
    <div class="row" style="text-align: center;">
        <div class="col-12">
            <div class="separator">
                <div>
                    <h1>
                        <img src="../images/yamaha_purple_left.png" alt="logo-yamaha" style="width: 130px;">
                    </h1>
                    <p>©2022 All Rights Reserved. Yamaha Indonesia . Privacy and Terms</p>
                </div>
            </div>
        </div>
    </div>
    <!-- login and sweetalert -->
    <script src="../../src/add/jquery.min.js"></script>
    <script src="../../src/add/bootstrap.min.js"></script>
    <script src="../../src/add/sweetalert2.all.min.js"></script>

    <!-- cek login status -->
    <?php
    if ($_SESSION['berhasil_auth'] == "y") {
    ?>
        <script type='text/javascript'>
            $(document).ready(function() {
                Swal.fire({
                    type: 'success',
                    title: 'Success',
                    text: 'User has been added',
                    footer: '',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        <?php
                        unset($_SESSION['berhasil_auth']); ?>
                        window.location = 'lib_auth.php'
                    }
                });

            });
        </script>
    <?php
    } elseif ($_SESSION['berhasil_auth'] == "n") {
    ?>
        <script type='text/javascript'>
            $(document).ready(function() {
                Swal.fire({
                    type: 'error',
                    title: 'Warning',
                    text: 'User data already exists',
                    footer: '',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        <?php
                        unset($_SESSION['berhasil_auth']); ?>
                        window.location = 'lib_auth.php'
                    }
                });

            });
        </script>
    <?php
    } elseif ($_SESSION['berhasil_auth'] == "t") {
    ?>
        <script type='text/javascript'>
            $(document).ready(function() {
                Swal.fire({
                    type: 'error',
                    title: 'Danger',
                    text: 'Auth or keygen incorect',
                    footer: '',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        <?php
                        unset($_SESSION['berhasil_auth']); ?>
                        window.location = 'lib_auth.php'
                    }
                });

            });
        </script>
    <?php
    }
    ?>
</body>

</html>