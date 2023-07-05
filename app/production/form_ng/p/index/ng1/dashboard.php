<div class="row">
    <div class="col-12">
        <h3>Inside Check <span style="font-size: 10px;">(Checker now : <?= $_SESSION['nama'] ?>)</span> </h3>
        <div class="separator"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="row">

            <div class="col-md-5 col-sm-5  form-group has-feedback">
                <form method="POST">
                    <!-- <select class="cari_slip" style="width: 100%;" name="acard" onchange="this.form.submit();">
                                            <option value="" selected disabled>Select Slip Number</option>
                                            <?php
                                            $sql_list = mysqli_query($connect_p, "SELECT DISTINCT c_no_slip, c_piano from on_progress");
                                            ?>
                                            <?php while ($data_list = mysqli_fetch_array($sql_list)) {
                                                echo '<option value="' . $data_list['c_no_slip'] . '">' . $data_list['c_no_slip'] . ' - ' . $data_list['c_piano'] . '</option>';
                                            } ?>
                                        </select> -->

                    <input type="text" name="acard" class="form-control has-feedback-left" placeholder="A-Card No / Serial No">
                    <span class="fa fa-barcode form-control-feedback left"></span>
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
                    unset($_SESSION['cardnumber']);
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
// create session
if (isset($_POST['acard'])) {
    $_SESSION['cardnumber'] = $_POST['acard'];
}
?>

<!-- isi hasil scan A card -->
<?php
// selama session masih kosong include no form
if (empty($_SESSION['cardnumber'])) {
    include('noform.php');
} else {
    // == cek awalan U/J == //
    $ptng = substr($_SESSION['cardnumber'], 0, 1);
    if ($ptng == 'U' or $ptng == 'u') {
        // == CEK PADA K-Staff == //
        $acard = $_SESSION['cardnumber'];
        $acard = strtoupper($acard);
        $sql1 =
            "SELECT B_ACTY.D0610.PLNNO 
                                , B_ACTY.D0610.ACARDNO 
                                , B_ACTY.D0610.HMCD 
                                , B_ACTY.D0130.SEIBAN
                                , B_ACTY.M0010.HMNM
                                , COUNT(B_ACTY.D0610.ACARDNO) AS QTY_ACARD
                            FROM B_ACTY.D0610,
                                B_ACTY.D0130
                                , B_ACTY.M0010
                            WHERE  B_ACTY.D0610.PLNNO = B_ACTY.D0130.PLNNO
                                AND B_ACTY.D0610.HMCD = B_ACTY.M0010.HMCD
                                AND B_ACTY.D0610.ACARDNO = '$acard'
                                AND B_ACTY.D0610.PLNNO LIKE 'UP%'
                            GROUP BY B_ACTY.D0610.PLNNO, B_ACTY.D0610.ACARDNO 
                                , B_ACTY.D0610.HMCD
                                , B_ACTY.D0130.SEIBAN
                                , B_ACTY.M0010.HMNM";

        $statment1 = oci_parse($connection, $sql1);
        oci_execute($statment1);
        $data = oci_fetch_array($statment1);
        // == Cek apakah ada isi pada k-staff == //
        if (!empty($data['PLNNO'])) {
            // result piano dari b45 - u700 -> D0600
            // result semuanya -> D0130
            // Acard UP -> D0610
            // Acard GP -> D0780
            // BOM -> M0031
            // MASTER -> M0010
            $sql2 = "SELECT B_ACTY.D0600.ACTUALDT, B_ACTY.D0600.HMCD AS GMC, B_ACTY.D0600.QTY AS QTY, B_ACTY.D0600.PLNNO AS PNUMBER, B_ACTY.D0600.MAKEKTCD AS WC FROM B_ACTY.D0600 WHERE B_ACTY.D0600.PLNNO = '$data[PLNNO]' AND B_ACTY.D0600.MAKEKTCD = 'U400'";
            $statment2 = oci_parse($connection, $sql2);
            oci_execute($statment2);
            $data2 = oci_fetch_array($statment2);

            // == Cek data pada U400 == //
            if ($data2['ACTUALDT'] == "") {
                // == jika gada unset session dan kirim pop up == //
                unset($_SESSION['cardnumber']);
?>
                <script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'Info',
                            text: 'Data belum selesai pada proses sebelumnya!',
                            type: 'info',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location = 'index.php';
                        });
                    });
                </script>
                <?php
                // == jika gada unset session dan kirim pop up == //

            } else {
                // == jika ada lanjut insert ke tabel register jika data belum pernah diinput == //
                $sql3 = mysqli_query($connect_pro, "SELECT id FROM formng_register WHERE c_ctrlnumber = '$data[ACARDNO]'");
                if (empty(mysqli_fetch_array($sql3))) {
                    $tgl_register = date('Y-m-d H:i:s', strtotime($now));
                    mysqli_query($connect_pro, "INSERT INTO formng_register SET c_ctrlnumber = '$data[ACARDNO]', c_plannumber = '$data[PLNNO]', c_gmc = '$data[HMCD]', c_serialnumber = '$data[SEIBAN]', c_pianoname = '$data[HMNM]', c_register = '$tgl_register'");
                }
                // == jika ada lanjut insert ke tabel register jika data belum pernah diinput == //

                $sql1 = mysqli_query($connect_pro, "SELECT * from formng_register where c_ctrlnumber = '$_SESSION[cardnumber]'");
                $data1 = mysqli_fetch_row($sql1);
                if ($data1 == 0) {
                    unset($_SESSION['cardnumber']);
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
                    $sql1 = mysqli_query($connect_pro, "SELECT * from formng_register where c_ctrlnumber = '$_SESSION[cardnumber]'");
                    $data1 = mysqli_fetch_array($sql1);

                    $_SESSION['serialnumber_inside'] = $data1['c_serialnumber'];
                    $_SESSION['pianoname_inside'] = $data1['c_pianoname'];

                    $sql2 = mysqli_query($connect_pro, "SELECT id FROM formng_resulti WHERE c_serialnumber = '$_SESSION[serialnumber_inside]'");
                    $data2 = mysqli_fetch_array($sql2);

                    if (empty($data2)) {
                        include('form.php');
                    } else {
                        include('verif.php');
                    }
                }
            }
            // ==  Cek data pada U400 == //

        } else {
            unset($_SESSION['cardnumber']);
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
        }
        // == Cek apakah ada isi pada k-staff == //
        // == CEK PADA K-Staff == //
    } elseif ($ptng == 'J' or $ptng == 'j') {
        // cek apakah sudah pernah dilakukan scan pada inside
        $sql1 = mysqli_query($connect_pro, "SELECT * from formng_register where c_serialnumber = '$_SESSION[cardnumber]'");
        $data1 = mysqli_fetch_row($sql1);

        if ($data1 == 0) { // ini harusnya dari pengecekan U400
            unset($_SESSION['cardnumber']);
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

            $sql1 = mysqli_query($connect_pro, "SELECT * from formng_register where c_serialnumber = '$_SESSION[cardnumber]'");
            $data1 = mysqli_fetch_array($sql1);

            $_SESSION['serialnumber_inside'] = $data1['c_serialnumber'];
            $_SESSION['pianoname_inside'] = $data1['c_pianoname'];

            $sql2 = mysqli_query($connect_pro, "SELECT id FROM formng_resulti WHERE c_serialnumber = '$_SESSION[serialnumber_inside]'");
            $data2 = mysqli_fetch_array($sql2);

            if (empty($data2)) {
                include('form.php');
            } else {
                include('verif.php');
            }
        }
    } else {
        unset($_SESSION['cardnumber']);
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
    }
}


?>
<!-- isi hasil scan slip number -->