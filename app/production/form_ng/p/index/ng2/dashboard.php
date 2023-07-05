<div class="row">
    <div class="col-12">
        <h3>Outside Check 1 <span style="font-size: 10px;">(Checker now : <?= $_SESSION['nama'] ?>)</span> </h3>
        <div class="separator"></div>
    </div>
</div>


<div class="row">
    <div class="col-md-10">
        <div class="row">

            <div class="col-md-4 col-sm-4  form-group has-feedback">
                <form method="POST">
                    <input type="text" name="acard" class="form-control has-feedback-left" placeholder="Serial No">
                    <span class="fa fa-qrcode form-control-feedback left"></span>
                </form>
            </div>

            <div class="col-md-1 col-sm-1  form-group has-feedback">
                <a href="scan.php" style="text-decoration: none;"><button onmouseover="mouseOver()" onmouseout="mouseOut()" class="btn btn-outline-secondary" style="padding: 5px;"><img src="barcode.png" id="barcode" width="25px" height="25px" /></button></a>
                <script type="text/javascript">
                    function mouseOver() {
                        document.getElementById("barcode").src = "barcode-w.png";
                    }

                    function mouseOut() {
                        document.getElementById("barcode").src = "barcode.png"
                    }
                </script>
            </div>

        </div>
    </div>
    <div class="col-md-2" style="text-align: right;">
        <div class="row">
            <div class="col-md-12 col-sm-12  form-group has-feedback">
                <form method="POST">
                    <button class="btn btn-danger" type="submit" name="reset">Clear</button>
                </form>
                <?php
                if (isset($_POST['reset'])) {
                    unset($_SESSION['cardnumber_outside1']);
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
// create session
if (isset($_POST['acard'])) {
    $_SESSION['cardnumber_outside1'] = $_POST['acard'];
}
?>

<!-- isi hasil scan slip number -->
<?php
// selama session masih kosong include no form
if (empty($_SESSION['cardnumber_outside1'])) {
    include('noform.php');
} else {
    // cek apakah slip terdaftar atau tidak
    $sql1 = mysqli_query($connect_pro, "SELECT id FROM formng_register where c_serialnumber = '$_SESSION[cardnumber_outside1]'");
    $data1 = mysqli_fetch_row($sql1);

    if ($data1 == 0) {
        // jika tidak ada data muncul alert dan unset session
        unset($_SESSION['cardnumber_outside1']);
?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Data tidak ditemukan',
                    text: 'No serial tidak terdaftar!',
                    type: 'warning',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'index.php';
                });
            });
        </script>
        <?php
    } else {

        $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
        $data1 = mysqli_fetch_array($sql1);

        if (empty($data1['c_finishincheck'])) {
            unset($_SESSION['cardnumber_outside1']);
        ?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Data ditemukan',
                        text: 'No serial belum selesai pada proses sebelumnya!',
                        type: 'info',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location = 'index.php';
                    });
                });
            </script>
            <?php
        } elseif (empty($data1['c_finishcomplete1'])) {
            $sql1 = mysqli_query($connect_pro, "SELECT r.c_serialnumber, r.c_pianoname, c.c_category2 FROM formng_register r JOIN formng_category c ON r.c_gmc = c.c_gmc WHERE r.c_serialnumber = '$_SESSION[cardnumber_outside1]'");
            $data1 = mysqli_fetch_array($sql1);

            $_SESSION['serialnumber_outside1'] = $data1['c_serialnumber'];
            $_SESSION['pianoname_outside1'] = $data1['c_pianoname'];
            $_SESSION['complete_outside1'] = $data1['c_category2'];

            include 'formcomplete.php';
        } else {

            $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
            $data1 = mysqli_fetch_array($sql1);

            $_SESSION['serialnumber_outside1'] = $data1['c_serialnumber'];
            $_SESSION['pianoname_outside1'] = $data1['c_pianoname'];
            if (empty($_SESSION['queue'])) {
                $_SESSION['queue'] = 'tbo';
            }

            $sql2 = mysqli_query($connect_pro, "SELECT c_category FROM formng_category WHERE c_gmc = '$data1[c_gmc]' ");
            $data2 = mysqli_fetch_array($sql2);
            if (!empty($data2)) {
                $sql2 = mysqli_query($connect_pro, "SELECT c_category FROM formng_category WHERE c_gmc = '$data1[c_gmc]' ");
                $data2 = mysqli_fetch_array($sql2);

                if ($data2['c_category'] == 'p') {
                    $sql3 = mysqli_query($connect_pro, "SELECT c_checker FROM formng_resultong WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]' AND c_process = 'oc1'");
                    $data3 = mysqli_fetch_array($sql3);
                    if (!empty($data3)) {
                        $sql3 = mysqli_query($connect_pro, "SELECT c_checker FROM formng_resultong WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]' AND c_process = 'oc1'");
                        $data3 = mysqli_fetch_array($sql3);

                        if ($data3['c_checker'] == $_SESSION['nama']) {

                            // cek jika sudah ada isi
                            $sql4 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1 FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                            $data4 = mysqli_fetch_array($sql4);

                            if (empty($data4['c_finishoutcheck1'])) {
                                $sql5 = mysqli_query($connect_pro, "SELECT id FROM formng_repairdata WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]' AND c_process = 'oc1'");
                                $data5 = mysqli_fetch_array($sql5);

                                if (empty($data5)) {
                                    include('form1.php');
                                } else {
                                    include('form1ver.php');
                                }
                            } else {
                                include('form1ver.php');
                            }
                        } else {
                            unset($_SESSION['cardnumber_outside1']);
            ?>
                            <script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        title: 'Piano sudah pernah di cek!',
                                        html: 'Silahkan menghubungi checker sebelumnya<br><b><?= $data3['c_checker'] ?></b>',
                                        type: 'info',
                                        confirmButtonText: 'OK'
                                    }).then(function() {
                                        window.location = 'index.php';
                                    });
                                });
                            </script>
                        <?php
                        }
                    } else {
                        // cek jika sudah ada isi
                        $sql4 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1 FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                        $data4 = mysqli_fetch_array($sql4);

                        if (empty($data4['c_finishoutcheck1'])) {
                            $sql5 = mysqli_query($connect_pro, "SELECT id FROM formng_repairdata WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]' AND c_process = 'oc1'");
                            $data5 = mysqli_fetch_array($sql5);

                            if (empty($data5)) {
                                include('form1.php');
                            } else {
                                include('form1ver.php');
                            }
                        } else {
                            include('form1ver.php');
                        }
                    }
                } elseif ($data2['c_category'] == 'f') {
                    $sql3 = mysqli_query($connect_pro, "SELECT c_checker FROM formng_resultong WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]' AND c_process = 'oc1'");
                    $data3 = mysqli_fetch_array($sql3);
                    if (!empty($data3)) {
                        $sql3 = mysqli_query($connect_pro, "SELECT c_checker FROM formng_resultong WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]' AND c_process = 'oc1'");
                        $data3 = mysqli_fetch_array($sql3);
                        if ($data3['c_checker'] == $_SESSION['nama']) {

                            // cek jika sudah ada isi
                            $sql4 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1 FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                            $data4 = mysqli_fetch_array($sql4);

                            if (empty($data4['c_finishoutcheck1'])) {
                                $sql5 = mysqli_query($connect_pro, "SELECT id FROM formng_repairdata WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'  AND c_process = 'oc1'");
                                $data5 = mysqli_fetch_array($sql5);

                                if (empty($data5)) {
                                    include('form2.php');
                                } else {
                                    include('form2ver.php');
                                }
                            } else {
                                include('form2ver.php');
                            }
                        } else {
                            unset($_SESSION['cardnumber_outside1']);
                        ?>
                            <script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        title: 'Piano sudah pernah di cek!',
                                        html: 'Silahkan menghubungi checker sebelumnya<br><b><?= $data3['c_checker'] ?></b>',
                                        type: 'info',
                                        confirmButtonText: 'OK'
                                    }).then(function() {
                                        window.location = 'index.php';
                                    });
                                });
                            </script>
                <?php
                        }
                    } else {
                        // cek jika sudah ada isi
                        $sql4 = mysqli_query($connect_pro, "SELECT c_finishoutcheck1 FROM formng_register WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]'");
                        $data4 = mysqli_fetch_array($sql4);

                        if (empty($data4['c_finishoutcheck1'])) {
                            $sql5 = mysqli_query($connect_pro, "SELECT id FROM formng_repairdata WHERE c_serialnumber = '$_SESSION[cardnumber_outside1]' AND c_process = 'oc1'");
                            $data5 = mysqli_fetch_array($sql5);

                            if (empty($data5)) {
                                include('form2.php');
                            } else {
                                include('form2ver.php');
                            }
                        } else {
                            include('form2ver.php');
                        }
                    }
                }
            } else {
                unset($_SESSION['cardnumber_outside1']);
                ?>
                <script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'Kode GMC tidak ditemukan',
                            text: 'Silahkan menghubungi management!',
                            type: 'info',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location = 'index.php';
                        });
                    });
                </script>
<?php
            }
        }
    }
}
?>
<!-- isi hasil scan slip number -->