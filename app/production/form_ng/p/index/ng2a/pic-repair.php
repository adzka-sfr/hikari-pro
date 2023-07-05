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
                <form method="POST">
                    <input required type="text" name="idkaryawan" class="form-control has-feedback-left" placeholder="ID Karyawan" autofocus>
                    <span class="fa fa-male form-control-feedback left"></span>
            </div>

            <div class="col-md-1 col-sm-1  form-group has-feedback">
                <button class="btn btn-primary" name="ok" style="padding: 5px;">OK</button>
                </form>
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
                    unset($_SESSION['cardnumber_repair']);
                    unset($_SESSION['repair_id']);
                    unset($_SESSION['repair_name']);
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
                    <input disabled type="text" name="acard" class="form-control has-feedback-left" placeholder="Serial No" autofocus>
                    <span class="fa fa-qrcode form-control-feedback left"></span>
                </form>
            </div>

            <div class="col-md-1 col-sm-1  form-group has-feedback">
                <button disabled onmouseover="mouseOver()" onmouseout="mouseOut()" class="btn btn-outline-secondary" style="padding: 5px;"><img src="barcode.png" id="barcode" width="25px" height="25px" /></button>
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
if (isset($_POST['idkaryawan'])) {
    $_SESSION['repair_id'] = $_POST['idkaryawan'];
}

if (isset($_POST['ok'])) {
    $_SESSION['repair_id'] = $_POST['idkaryawan'];
}
?>

<!-- isi hasil scan slip number -->
<?php
// selama session masih kosong include no form
if (empty($_SESSION['repair_id'])) {
    include('noform.php');
} else {
    $sql1 = mysqli_query($connect, "SELECT id FROM auth where id = '$_SESSION[repair_id]' AND role = 'repair outcheck'");
    $data1 = mysqli_fetch_row($sql1);

    if ($data1 == 0) {
        unset($_SESSION['repair_id']);
?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Akses ditolak!',
                    text: 'Anda bukan PIC repair!',
                    type: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'index.php';
                });
            });
        </script>
    <?php
    } else {
        $sql1 = mysqli_query($connect, "SELECT nama FROM auth where id = '$_SESSION[repair_id]' AND role = 'repair outcheck'");
        $data1 = mysqli_fetch_array($sql1);
        $_SESSION['repair_name'] = $data1['nama'];
    ?>
        <script>
            window.location = 'index.php';
        </script>
<?php
    }
}
?>
<!-- isi hasil scan slip number -->