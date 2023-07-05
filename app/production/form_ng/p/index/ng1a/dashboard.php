<div class="row">
    <div class="col-12">
        <h3>Repair Inside</h3>
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
                    unset($_SESSION['cardnumber_repair']);
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
    $_SESSION['cardnumber_repair'] = $_POST['acard'];
}
?>

<!-- isi hasil scan A card -->
<?php
// selama session masih kosong include no form
if (empty($_SESSION['cardnumber_repair'])) {
    include('noform.php');
} else {
    $sql1 = mysqli_query($connect_pro, "SELECT id FROM formng_resulti where c_serialnumber = '$_SESSION[cardnumber_repair]'");
    $data1 = mysqli_fetch_row($sql1);

    if ($data1 == 0) { // ini harusnya dari pengecekan U400
        unset($_SESSION['cardnumber_repair']);
?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Data Not Found',
                    text: 'Slip number unregistered!',
                    type: 'warning',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'index.php';
                });
            });
        </script>
<?php
    } else {
        $sql2 = mysqli_query($connect_pro, "SELECT DISTINCT c_serialnumber, c_pianoname FROM formng_resulti WHERE c_serialnumber = '$_SESSION[cardnumber_repair]'");
        $data2 = mysqli_fetch_array($sql2);

        $_SESSION['serialnumber_repair'] = $data2['c_serialnumber'];
        $_SESSION['pianoname_repair'] = $data2['c_pianoname'];
        include 'verif.php';
    }
}



?>
<!-- isi hasil scan slip number -->