<script src="<?= base_url('_assets/src/add/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>
<div class="row">
    <div class="col-12">
        <h3>Outside Repair <i class="fa fa-gear fa-spin"></i></h3>

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
                    unset($_SESSION['checker1repair']);
                    unset($_SESSION['checker2repair']);
                    unset($_SESSION['checker3repair']);
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

        $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_repairdata WHERE c_serialnumber = '$_SESSION[cardnumber_repairo1]' AND c_endprocess IS NULL");
        $data1 = mysqli_fetch_array($sql1);

        if (empty($data1['c_serialnumber'])) {
            unset($_SESSION['cardnumber_repairo1']);
        ?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Data ditemukan',
                        text: 'Piano masih dalam pengecekan!',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location = 'index.php';
                    });
                });
            </script>
            <?php
        } else {

            $sql1 = mysqli_query($connect_pro, "SELECT * FROM formng_repairdata WHERE c_serialnumber = '$_SESSION[cardnumber_repairo1]' AND c_endprocess IS NULL");
            $data1 = mysqli_fetch_array($sql1);

            $_SESSION['serialnumber_repairo1'] = $data1['c_serialnumber'];
            $_SESSION['process'] = $data1['c_process'];

            $sql2 = mysqli_query($connect_pro, "SELECT fc.c_category FROM formng_resultong fr JOIN formng_register freg ON fr.c_serialnumber = freg.c_serialnumber JOIN formng_category fc ON freg.c_gmc = fc.c_gmc WHERE fr.c_serialnumber = '$_SESSION[serialnumber_repairo1]' limit 1");
            $data2 = mysqli_fetch_array($sql2);
            if (!empty($data2)) {
                $sql2 = mysqli_query($connect_pro, "SELECT freg.c_pianoname, fc.c_category FROM formng_resultong fr JOIN formng_register freg ON fr.c_serialnumber = freg.c_serialnumber JOIN formng_category fc ON freg.c_gmc = fc.c_gmc WHERE fr.c_serialnumber = '$_SESSION[serialnumber_repairo1]' limit 1");
                $data2 = mysqli_fetch_array($sql2);
                $_SESSION['pianoname'] = $data2['c_pianoname'];

                // get name of checker 
                $sql3a = mysqli_query($connect_pro, "SELECT c_complete1by FROM formng_register WHERE c_serialnumber  = '$_SESSION[cardnumber_repairo1]'");
                $data3a = mysqli_fetch_array($sql3a);
                if ($data3a['c_complete1by'] != '') {
                    $sql3a = mysqli_query($connect_pro, "SELECT c_complete1by FROM formng_register WHERE c_serialnumber  = '$_SESSION[cardnumber_repairo1]'");
                    $data3a = mysqli_fetch_array($sql3a);
                    $_SESSION['checker1repair'] = $data3a['c_complete1by'];
                } else {
                    $_SESSION['checker1repair'] = '-';
                }

                $sql3b = mysqli_query($connect_pro, "SELECT c_complete2by FROM formng_register WHERE c_serialnumber  = '$_SESSION[cardnumber_repairo1]'");
                $data3b = mysqli_fetch_array($sql3b);
                if ($data3b['c_complete2by'] != '') {
                    $sql3b = mysqli_query($connect_pro, "SELECT c_complete2by FROM formng_register WHERE c_serialnumber  = '$_SESSION[cardnumber_repairo1]'");
                    $data3b = mysqli_fetch_array($sql3b);
                    $_SESSION['checker2repair'] = $data3b['c_complete2by'];
                } else {
                    $_SESSION['checker2repair'] = '-';
                }

                $sql3c = mysqli_query($connect_pro, "SELECT c_complete3by FROM formng_register WHERE c_serialnumber  = '$_SESSION[cardnumber_repairo1]'");
                $data3c = mysqli_fetch_array($sql3c);
                if ($data3c['c_complete3by'] != '') {
                    $sql3c = mysqli_query($connect_pro, "SELECT c_complete3by FROM formng_register WHERE c_serialnumber  = '$_SESSION[cardnumber_repairo1]'");
                    $data3c = mysqli_fetch_array($sql3c);
                    $_SESSION['checker3repair'] = $data3c['c_complete3by'];
                } else {
                    $_SESSION['checker3repair'] = '-';
                }

                if (empty($_SESSION['queue'])) {
                    $_SESSION['queue'] = 'or';
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