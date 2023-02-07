<div class="row">
    <div class="col-12">
        <h3>Outside Repair</h3>
        <div class="separator"></div>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="row">

            <div class="col-md-4 col-sm-4  form-group has-feedback">
                <input id="input_karyawan" readonly type="text" name="idkaryawan" class="form-control has-feedback-left" value="<?= $_SESSION['repair_name'] ?>">
                <span class="fa fa-male form-control-feedback left"></span>
                <script type="text/javascript">
                    let x = document.getElementById("input_karyawan");
                    x.style.color = "red";

                    function changeColor() {
                        x.style.color = x.style.color == "red" ? "black" : "red";
                    }
                    window.setInterval(changeColor, 200);
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
                    unset($_SESSION['cardnumber_repairo1']);
                    unset($_SESSION['repair_id']);
                    unset($_SESSION['repair_name']);
                ?>
                    <script>
                        window.location = 'index.php';
                    </script>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="row">

            <div class="col-md-4 col-sm-4  form-group has-feedback">
                <form method="POST">
                    <input type="text" name="acard" class="form-control has-feedback-left" placeholder="Serial No" autofocus>
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
</div>
<?php
// create session
if (isset($_POST['acard'])) {
    $_SESSION['cardnumber_repairo1'] = $_POST['acard'];
}
?>

<!-- isi hasil scan slip number -->
<?php
// selama session masih kosong include no form
if (empty($_SESSION['cardnumber_repairo1'])) {
    include('noform.php');
} else {
    // cek apakah slip terdaftar atau tidak
    $sql1 = mysqli_query($connect_pro, "SELECT id FROM formng_register where c_serialnumber = '$_SESSION[cardnumber_repairo1]'");
    $data1 = mysqli_fetch_row($sql1);

    if ($data1 == 0) {
        // jika tidak ada data muncul alert dan unset session
        unset($_SESSION['cardnumber_repairo1']);
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

        $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber_repairo1]'");
        $data1 = mysqli_fetch_array($sql1);

        if (empty($data1['c_serialnumber'])) {
            unset($_SESSION['cardnumber_repairo1']);
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
        } else {

            $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber_repairo1]'");
            $data1 = mysqli_fetch_array($sql1);

            $_SESSION['serialnumber_repairo1'] = $data1['c_serialnumber'];
            $_SESSION['pianoname_repairo1'] = $data1['c_pianoname'];
            if (empty($_SESSION['queue'])) {
                $_SESSION['queue'] = 'tbo';
            }

            $sql2 = mysqli_query($connect_pro, "SELECT c_category FROM formng_category WHERE c_gmc = '$data1[c_gmc]' ");
            $data2 = mysqli_fetch_array($sql2);
            if (!empty($data2)) {
                $sql2 = mysqli_query($connect_pro, "SELECT c_category FROM formng_category WHERE c_gmc = '$data1[c_gmc]' ");
                $data2 = mysqli_fetch_array($sql2);



                // get process
                $sql4 = mysqli_query($connect_pro, "SELECT c_process, c_checker FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber_repairo1]' AND c_process = 'oc3'");
                $data4 = mysqli_fetch_array($sql4);
                if (!empty($data4['c_process'])) {
                    $_SESSION['last_process'] = 'oc3';
                    $_SESSION['checker1'] = $data4['c_checker']; // get name checker
                } else {
                    $sql4 = mysqli_query($connect_pro, "SELECT c_process, c_checker FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber_repairo1]' AND c_process = 'oc2'");
                    $data4 = mysqli_fetch_array($sql4);
                    if (!empty($data4['c_process'])) {
                        $_SESSION['last_process'] = 'oc2';
                        $_SESSION['checker1'] = $data4['c_checker']; // get name checker
                    } else {
                        $sql4 = mysqli_query($connect_pro, "SELECT c_process, c_checker FROM formng_resultro WHERE c_serialnumber = '$_SESSION[cardnumber_repairo1]' AND c_process = 'oc1'");
                        $data4 = mysqli_fetch_array($sql4);
                        if (!empty($data4['c_process'])) {
                            $_SESSION['last_process'] = 'oc1';
                            $_SESSION['checker1'] = $data4['c_checker']; // get name checker
                        }
                    }
                }

                if ($data2['c_category'] == 'p') {
                    include('form1.php');
                } elseif ($data2['c_category'] == 'f') {
                    include('form2.php');
                }
            } else {
                unset($_SESSION['cardnumber_repairo1']);
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