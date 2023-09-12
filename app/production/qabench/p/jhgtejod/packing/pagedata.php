<?php
//koneksi oracle ---->
date_default_timezone_set('Asia/Jakarta');

$username = "B_ACTY";
$password = "SYSTEM";
$db = "(DESCRIPTION =
			(ADDRESS_LIST =
			  (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521))
			)
			(CONNECT_DATA =
			  (SERVICE_NAME = YIKSTAFF)
			)
		)";
$connection = oci_connect($username, $password, $db);

if (!$connection) {
    $e = oci_error();
    echo htmlentities($e['message']);
    exit();
}

//koneksi local
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
$koneksi = mysqli_connect("localhost", "root", "", "db_check_packing");
$now = date('Y-m-d H:i:s');
session_start();
$location = $_SESSION['role'];
$today = date('Y-m-d', strtotime($now));

// get data lemparan
$acard_post = isset($_POST['AcardNo']) ? $_POST['AcardNo'] : '';

if ($acard_post !== "") {
    if ($location == 'packing up') {
        $qry_stock = " SELECT B_ACTY.D0610.PLNNO
    		, B_ACTY.D0610.ACARDNO
    		, B_ACTY.D0610.HMCD
    		, B_ACTY.D0130.SEIBAN
    		, B_ACTY.M0010.HMNM
    		, COUNT(B_ACTY.D0610.ACARDNO) AS QTY_ACARD
    		FROM B_ACTY.D0610,
    			 B_ACTY.D0130,
    			 B_ACTY.M0010
    		WHERE  B_ACTY.D0610.PLNNO = B_ACTY.D0130.PLNNO
    		AND B_ACTY.D0610.HMCD = B_ACTY.M0010.HMCD
    		AND B_ACTY.D0610.ACARDNO = '$acard_post'
    		AND B_ACTY.D0610.PLNNO LIKE 'UP%'
    		GROUP BY B_ACTY.D0610.PLNNO, B_ACTY.D0610.ACARDNO , B_ACTY.D0610.HMCD, B_ACTY.D0130.SEIBAN, B_ACTY.M0010.HMNM";
    } elseif ($location == 'packing gp') {
        $qry_stock = " SELECT B_ACTY.D0780.PLNNO
    		, B_ACTY.D0780.ACARDNO
    		, B_ACTY.D0780.HMCD
    		, B_ACTY.D0130.SEIBAN
    		, B_ACTY.M0010.HMNM
    		, COUNT(B_ACTY.D0780.ACARDNO) AS QTY_ACARD
    		FROM B_ACTY.D0780,
    			 B_ACTY.D0130,
    			 B_ACTY.M0010
    		WHERE  B_ACTY.D0780.PLNNO = B_ACTY.D0130.PLNNO
    		AND B_ACTY.D0780.HMCD = B_ACTY.M0010.HMCD
    		AND B_ACTY.D0780.ACARDNO = '$acard_post'
    		AND B_ACTY.D0780.PLNNO LIKE 'GP%'
    		GROUP BY B_ACTY.D0780.PLNNO, B_ACTY.D0780.ACARDNO , B_ACTY.D0780.HMCD, B_ACTY.D0130.SEIBAN, B_ACTY.M0010.HMNM";
    }

    $exc_ora = oci_parse($connection, $qry_stock);

    oci_execute($exc_ora);
    $piano = oci_fetch_array($exc_ora);


    //jika jumlah record didapatkan / lebih dari Nol
    if (isset($piano['QTY_ACARD']) and $piano['QTY_ACARD'] > 0) {

        $gmc =  $piano['HMCD'];
        $serial = $piano['SEIBAN'];

        // apakah menggunakan bench ?
        $qry_bom_bench = "SELECT M_ACTY.M0031.OYAHMCD, M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM
		FROM M_ACTY.M0031
		JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD
		WHERE M_ACTY.M0031.OYAHMCD = '$gmc'
		AND M_ACTY.M0010.HMSNM LIKE 'BENCH%'
		AND M_ACTY.M0010.HMSNM NOT LIKE '%CQ%'
		AND M_ACTY.M0010.HMSTATUS != 'CI'";

        $querybom = oci_parse($connection, $qry_bom_bench);
        oci_execute($querybom);

        $row_bench = oci_fetch_array($querybom);

        $gmc_bench = isset($row_bench['KOHMCD']) ? $row_bench['KOHMCD'] : "";
        $nm_bench = isset($row_bench['HMSNM']) ? $row_bench['HMSNM'] : "";

        if ($gmc_bench != "") {
            $b_infobench = "Yes";
            $b_colorbench = "blue";
        } else {
            $b_infobench = "No";
            $b_colorbench = "red";
        }

        $query2 = " SELECT * FROM tb_material where parent = '$gmc'";
        $data2  = mysqli_query($koneksi, $query2);
        $pianoinfo = mysqli_fetch_array($data2);
        $parentname = $piano['HMNM'];

        // apakah menggunakan user package ?
        $qry_bom_userp = "SELECT M_ACTY.M0031.OYAHMCD, M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM
                FROM M_ACTY.M0031
                JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD
                WHERE M_ACTY.M0031.OYAHMCD = '$gmc'
                AND M_ACTY.M0010.HMSNM LIKE 'USER PACKAGE SET%'
                AND M_ACTY.M0010.HMSNM NOT LIKE '%CQ%'
                AND M_ACTY.M0010.HMSTATUS != 'CI'";

        $querybom_userp = oci_parse($connection, $qry_bom_userp);
        oci_execute($querybom_userp);
        $row_userp = oci_fetch_array($querybom_userp);

        $gmc_userp = isset($row_userp['KOHMCD']) ? $row_userp['KOHMCD'] : "";
        $nm_userp = isset($row_userp['HMSNM']) ? $row_userp['HMSNM'] : "";

        if ($gmc_userp != "") {
            $b_infouserp = "Yes";
            $b_coloruserp = "blue";
        } else {
            // cek apakah gmc yang di maksud adalah piano gp, karena kalau gp ambil dari tingkat yang berbeda
            if ($location == 'packing gp') {
                $temp_parent = $gmc;
                $hasilcek = '';
                $perulangan_ke = 0;
                do {
                    $perulangan_ke++;
                    $qry_bom_userp_gp = "SELECT M_ACTY.M0031.OYAHMCD, M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM, M_ACTY.M0010.MAKEKTCD
                FROM M_ACTY.M0031
                JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD
                WHERE M_ACTY.M0031.OYAHMCD = '$temp_parent' AND M_ACTY.M0010.HMSNM LIKE 'PIANO %' AND M_ACTY.M0010.MAKEKTCD != '3010'";
                    $querybom_userp_gp = oci_parse($connection, $qry_bom_userp_gp);
                    oci_execute($querybom_userp_gp);
                    $row_userp_gp = oci_fetch_array($querybom_userp_gp);

                    $gmc_userp_gp = isset($row_userp_gp['KOHMCD']) ? $row_userp_gp['KOHMCD'] : "";
                    $nm_userp_gp = isset($row_userp_gp['HMSNM']) ? $row_userp_gp['HMSNM'] : "";
                    $MKTCD = isset($row_userp_gp['MAKEKTCD']) ? $row_userp_gp['MAKEKTCD'] : "";

                    // jika yang terdeteksi adalah piano tanpa userpackage
                    $temp_parent = $gmc_userp_gp;
                    if ($MKTCD == "G200") {
                        $hasilcek = 'gada';
                        break;
                    }

                    // jaga-jaga jika yang terdeteksi adalah piano UP
                    if ($MKTCD == "U400") {
                        $hasilcek = 'gada';
                        break;
                    }

                    // jaga-jaga jika tidak kunjung ditemukan juga
                    if ($perulangan_ke == 7) {
                        $hasilcek = 'gada';
                        break;
                    }
                } while ($MKTCD != "G230");

                if ($hasilcek == 'gada') {
                    echo " gada";
                    $b_infouserp = "No";
                    $b_coloruserp = "red";
                } else {
                    $qry_bom_userp_gp1 = "SELECT M_ACTY.M0031.OYAHMCD, M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM
                FROM M_ACTY.M0031
                JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD
                WHERE M_ACTY.M0031.OYAHMCD = '$gmc_userp_gp'
                AND M_ACTY.M0010.HMSNM LIKE 'USER PACKAGE SET%'
                AND M_ACTY.M0010.HMSNM NOT LIKE '%CQ%'
                AND M_ACTY.M0010.HMSTATUS != 'CI'";

                    $querybom_userp_gp1 = oci_parse($connection, $qry_bom_userp_gp1);
                    oci_execute($querybom_userp_gp1);
                    $row_userp_gp1 = oci_fetch_array($querybom_userp_gp1);

                    $gmc_userp = isset($row_userp_gp1['KOHMCD']) ? $row_userp_gp1['KOHMCD'] : "";
                    $nm_userp = isset($row_userp_gp1['HMSNM']) ? $row_userp_gp1['HMSNM'] : "";

                    $b_infouserp = "Yes";
                    $b_coloruserp = "blue";
                }
            } else {
                $b_infouserp = "No";
                $b_coloruserp = "red";
            }
        }

        // menggunakan owner kit tipe apa ?
        $qry_bom_owner = "SELECT M_ACTY.M0030.OYAHMCD, M_ACTY.M0030.KOHMCD, M_ACTY.M0010.HMSNM
                FROM M_ACTY.M0030
                JOIN M_ACTY.M0010 ON M_ACTY.M0030.KOHMCD = M_ACTY.M0010.HMCD
                WHERE M_ACTY.M0030.OYAHMCD = '$gmc'
                AND M_ACTY.M0010.HMSNM LIKE 'OWNERS KIT%'
                AND M_ACTY.M0010.HMSNM NOT LIKE '%CQ%'
                AND M_ACTY.M0010.HMSTATUS != 'CI'";

        $querybom_owner = oci_parse($connection, $qry_bom_owner);
        oci_execute($querybom_owner);
        $row_owner = oci_fetch_array($querybom_owner);

        $gmc_owner = isset($row_owner['KOHMCD']) ? $row_owner['KOHMCD'] : "";
        $nm_owner = isset($row_owner['HMSNM']) ? $row_owner['HMSNM'] : "";

        if ($gmc_owner != '') {
            $b_infoowner = "Yes";
            $b_colorowner = "blue";
        } else {
            $b_infoowner = "No";
            $b_colorowner = "blue";
        }

        // if ($gmc_owner == "ZX43630") {
        //     $b_infoowner = "Japan";
        //     $b_colorowner = "blue";
        // } elseif ($gmc_owner == "ZX43610" or $gmc_owner == "Q806ZX43610D") {
        //     $b_infoowner = "Global";
        //     $b_colorowner = "blue";
        // } else {
        //     $b_infoowner = "No";
        //     $b_colorowner = "red";
        // }

?>

        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <b><u>Piano Info</u></b>
                        <input type="hidden" id="acard" value="<?= $acard_post ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table>
                            <tr>
                                <td><i class="ace-icon fa fa-caret-right blue"></i>GMC</td>
                                <td>: <b class="blue"><?php echo $gmc; ?></b></td>
                            </tr>
                            <tr>
                                <td><i class="ace-icon fa fa-caret-right blue"></i>Piano Model</td>
                                <td>: <b class="blue"><?php echo $parentname; ?></b></td>
                            </tr>
                            <tr>
                                <td><i class="ace-icon fa fa-caret-right blue"></i>Serial No</td>
                                <td>: <b class="blue"><?php echo $serial; ?></b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <b><u>Item Info</u></b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table>
                            <tr>
                                <td><i class="ace-icon fa fa-caret-right blue"></i>Bench</td>
                                <td>: <b class="<?= $b_colorbench ?>"><?php echo $b_infobench; ?></b></td>
                            </tr>
                            <tr>
                                <td><i class="ace-icon fa fa-caret-right blue"></i>User Package</td>
                                <td>: <b class="<?= $b_coloruserp ?>"><?php echo $b_infouserp; ?></b></td>
                            </tr>
                            <tr>
                                <td><i class="ace-icon fa fa-caret-right blue"></i>Owner Kit</td>
                                <td>: <b class="<?= $b_colorowner ?>"><?php echo $b_infoowner; ?></b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3">
                <table class="table table-bordered" style="margin-bottom: 0px;">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Item Name</th>
                            <th>GMC</th>
                            <th style="width: 200px;">Serial</th>
                            <th style="width: 200px;">Status</th>
                            <!-- <th style="width: 200px;">Image</th> -->
                        </tr>
                    </thead>

                    <tbody>
                        <input id="serialpiano" type="hidden" value="<?= $serial ?>">
                        <input id="namepiano" type="hidden" value="<?= $parentname ?>">
                        <input id="gmcpiano" type="hidden" value="<?= $gmc ?>">

                        <!-- BENCH -->
                        <?php
                        if ($gmc_bench != "") {
                        ?>
                            <tr>
                                <td style="font-size: large;">
                                    <h4></h4>
                                    <?php echo $nm_bench; ?>
                                </td>
                                <td style="text-align: center; font-size: large;">
                                    <h4></h4><?php echo $gmc_bench; ?>
                                    <input type="hidden" id="gmchiddenbench" value="<?= $gmc_bench ?>">
                                </td>
                                <td>
                                    <h4></h4><input type="text" id="serialbenchpacking" class="form-control" />
                                </td>

                                <td style="text-align: center; font-size: 20px;">
                                    <div id="status2"></div>
                                    <input id="statusbench" type="hidden">
                                    <input id="qtybench" type="hidden" value="1">
                                    <input id="namebench" type="hidden" value="<?= $nm_bench ?>">
                                    <input id="gmcbench" type="hidden" value="<?= $gmc_bench ?>">

                                </td>
                                <!-- <td style="text-align: center;">
                                    <div class="input-group mb-3">
                                        <input id="fileupload" style="display: none;" type="file" size="60">
                                    </div>
                                    <form runat="server">
                                        <img style="width: 100%;" id="blah" src="#" alt="your image" />
                                    </form>
                                    <button style="width: 50px;" id="upload" onclick="uploadgambar()" class="btn btn-primary"><i class="fa fa-plus-square"></i></button>

                                </td> -->
                            </tr>
                        <?php
                        } else {
                        ?>
                            <input type="hidden" id="serialbenchpacking" value="-">
                            <input type="hidden" id="gmchiddenbench" value="-">
                            <input id="statusbench" type="hidden" value="ok">
                            <input id="qtybench" type="hidden" value="0">
                            <input id="namebench" type="hidden" value="-">
                            <input id="gmcbench" type="hidden" value="-">
                        <?php
                        }
                        ?>

                        <!-- USER PACKAGE -->
                        <?php
                        if ($gmc_userp != "") {
                        ?>
                            <tr>
                                <td style="font-size: large;">
                                    <h4></h4>
                                    <?php echo $nm_userp; ?>
                                </td>
                                <td style="text-align: center; font-size: large;">
                                    <h4></h4><?php echo $gmc_userp; ?>
                                    <input type="hidden" id="gmchiddenuserp" value="<?= $gmc_userp ?>">
                                </td>
                                <td>
                                    <h4></h4><input type="text" id="serialuserppacking" class="form-control" />
                                </td>

                                <td style="text-align: center; font-size: 20px;">
                                    <div id="status3"></div>
                                    <input id="statususerp" type="hidden">
                                    <input id="qtyuserp" type="hidden" value="1">
                                    <input id="nameuserp" type="hidden" value="<?= $nm_userp ?>">
                                    <input id="gmcuserp" type="hidden" value="<?= $gmc_userp ?>">

                                </td>
                            </tr>
                        <?php
                        } else {
                        ?>
                            <input type="hidden" id="serialuserppacking" value="-">
                            <input type="hidden" id="gmchiddenuserp" value="-">
                            <input id="statususerp" type="hidden" value="ok">
                            <input id="qtyuserp" type="hidden" value="0">
                            <input id="nameuserp" type="hidden" value="-">
                            <input id="gmcuserp" type="hidden" value="">
                        <?php
                        }
                        ?>

                        <!-- OWNER KIT -->
                        <?php
                        if ($gmc_owner != "") {
                        ?>
                            <tr>
                                <td style="font-size: large;">
                                    <h4></h4>
                                    <?php echo $nm_owner; ?>
                                </td>
                                <td style="text-align: center; font-size: large;">
                                    <h4></h4><?php echo $gmc_owner; ?>
                                    <input type="hidden" id="gmchiddenuserp" value="<?= $gmc_userp ?>">
                                </td>
                                <td style="text-align: center;">
                                    <h4>-</h4>
                                </td>

                                <td style="text-align: center; font-size: 20px;">
                                    <!-- <div id="owner-ok" style="display: none;"><span class='green'><i class='ace-icon fa fa-check-square-o'></i> OK</span></div> -->
                                    <!-- <div><button class="btn btn-success">Checked</button></div> -->
                                    <input type="checkbox" id="owner" style="height: 30px; width: 30px;" name="owner" value="ok">
                                    <input id="statususerp" type="hidden">
                                    <input id="qtyuserp" type="hidden" value="1">
                                    <input id="nameuserp" type="hidden" value="<?= $nm_userp ?>">
                                    <input id="gmcuserp" type="hidden" value="<?= $gmc_userp ?>">

                                </td>
                            </tr>
                        <?php
                        } ?>

                        <?php
                        // Jika kosong semuanya
                        if ($gmc_bench == "" && $gmc_userp == "" && $gmc_owner == "") {
                        ?>
                            <tr>
                                <td style="text-align: center; background-color: #F8D7DA;" colspan="4">
                                    Tidak menggunakan apapun
                                    <input type="hidden" id="serialbenchpacking" value="-" class="form-control" />
                                    <input type="hidden" id="serialuserppacking" value="-" class="form-control" />
                                    <input type="hidden" id="statusbench" value="ok" class="form-control" />
                                    <input type="hidden" id="statususerp" value="ok" class="form-control" />
                                    <input type="checkbox" checked id="owner" style="height: 30px; width: 30px; display: none;" name="owner" value="ok">
                                    <input id="qtybench" type="hidden" value="0">
                                    <input id="qtyuserp" type="hidden" value="0">
                                    <input id="namebench" type="hidden" value="-">
                                    <input id="nameuserp" type="hidden" value="-">
                                    <input id="gmcbench" type="hidden" value="-">
                                    <input id="gmcuserp" type="hidden" value="-">
                                    <script>
                                        $(document).ready(function() {
                                            $('#packing').focus();
                                        })
                                    </script>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <i style="margin-top: 0px;">Note : Jika menuliskan serial secara manual, jangan lupa klik "Enter" atau "Return" untuk melakukan pengecekan</i>
            </div>
        </div>

        <!-- Fitur Ambil Gambar -->
        <!-- <div class="row">
            <div class="col-12">
                <b><u>Packing Image</u></b>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <table class="table table-bordered">
                    <thead style="text-align: center">
                        <th>Image</th>
                        <th style="width: 20%; ;">Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center">
                                <img id="imgplaceholder" style="width: 50px; opacity: 40%; display: none;" src="image/box.png" />
                                <img id="blah" style="width: 100%; display: none;" src="#" alt="your image" />
                            </td>
                            <td style="text-align: center">
                                <div class="input-group mb-3">
                                    <input id="fileupload" style="display: none;" type="file" size="60">
                                </div>
                                <button id="upload" onclick="uploadgambar()" class="btn btn-primary">
                                    <i id="camera" class="fa fa-camera" style="display: none;"></i>
                                    <i id="retake" class="fa fa-refresh" style="display: none;"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->
        <!-- Fitur Ambil Gambar -->

        <div class="row">
            <div class="col-12 mb-5" style="text-align: center;">
                <button id="packing" class="btn btn-primary" style="width: 200px;">Packing <i id="spinner-packing" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                // cek apakah menggunakan bench
                var gmcbench = $('#gmchiddenbench').val();
                if (gmcbench != '-') {
                    // menggunakan bench
                    $('#serialbenchpacking').focus();
                    $('#serialbenchpacking').keypress(function(e) {
                        if (e.which == 13) {
                            var dataString = {
                                gmcbench: $("#gmchiddenbench").val(),
                                serialbench: $("#serialbenchpacking").val()
                            };
                            $.ajax({
                                url: "packing/check_bench.php",
                                type: "POST",
                                data: dataString,
                                success: function(data) {
                                    var data = JSON.parse(data);
                                    if (data.status == "bench-tidak-terdaftar") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'Bench tidak terdaftar!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialbenchpacking').val("");
                                        $("#status2").html("");
                                        return false;
                                    } else if (data.status == "bench-belum-terdaftar") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'Bench belum terdaftar!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialbenchpacking').val("");
                                        $("#status2").html("");
                                    } else if (data.status == "bench-bagian-lain") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'Bench tidak terdaftar pada <?= $_SESSION['role'] ?>!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialbenchpacking').val("");
                                        $("#status2").html("");
                                    } else if (data.status == "bench-tidak-match") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'Bench tidak sesuai spesifikasi!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialbenchpacking').val("");
                                        $("#status2").html("");
                                    } else if (data.status == "bench-sudah-digunakan") {
                                        Swal.fire({
                                            title: 'Ditolak!',
                                            html: data.jenis + ' <b>' + data.info + '</b> seharusnya sudah dipacking!<br><div style="text-align: left; padding-top: 5px;"><span> Info packing: </span><table class = "table"><tr><td>No Seri Piano</td><td>:</td><td>' + data.serialpiano + '</td></tr><tr><td>Nama Piano</td><td>:</td><td>' + data.namepiano + '</td></tr><tr><td>Bench</td><td>:</td><td>' + data.serialbench + '</td></tr><tr><td>User Package</td><td>:</td><td>' + data.serialuserp + '</td></tr><tr><td>Waktu Packing</td><td>:</td><td>' + data.packingdate + '</td></tr></table></div>',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                        $('#serialbenchpacking').val("");
                                        $("#status2").html("");
                                    } else if (data.status == "bench-match") {
                                        $('#serialbenchpacking').attr("readonly", true);
                                        $("#status2").html("<span class='green'><i class='ace-icon fa fa-check-square-o'></i> MATCH</span>");
                                        $('#statusbench').val("ok");

                                        var gmcuserp = $('#gmchiddenuserp').val();
                                        if (gmcuserp != '-') {
                                            $('#serialuserppacking').focus();
                                        } else {
                                            $('#packing').focus();
                                        }

                                    } else {
                                        swal({
                                            title: "Warning",
                                            text: "Bench Tidak Sesuai",
                                            icon: "warning",
                                            confirmButtonClass: 'btn-danger',
                                            confirmButtonText: 'OK'
                                        });
                                        $('#serialbenchpacking').val("");
                                        $("#status2").html("");
                                        return false;

                                    }

                                }
                            });
                        }
                    });

                    // lanjut isi user package
                    // tidak menggunakan bench
                    $('#serialuserppacking').keypress(function(e) {
                        if (e.which == 13) {
                            var dataString2 = {
                                gmcuserp: $("#gmchiddenuserp").val(),
                                serialuserp: $("#serialuserppacking").val()
                            };
                            $.ajax({
                                url: "packing/check_userp.php",
                                type: "POST",
                                data: dataString2,
                                success: function(data2) {
                                    var data2 = JSON.parse(data2);
                                    if (data2.status == "userp-tidak-terdaftar") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'User Package tidak terdaftar!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                        return false;
                                    } else if (data2.status == "userp-belum-terdaftar") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'User Package belum terdaftar!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                    } else if (data2.status == "userp-bagian-lain") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'User Package tidak terdaftar pada <?= $_SESSION['role'] ?>!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                    } else if (data2.status == "userp-tidak-match") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'User Package tidak sesuai spesifikasi!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                    } else if (data2.status == "userp-sudah-digunakan") {
                                        Swal.fire({
                                            title: 'Ditolak!',
                                            html: data2.jenis + ' <b>' + data2.info + '</b> seharusnya sudah dipacking!<br><div style="text-align: left; padding-top: 5px;"><span> Info packing: </span><table class = "table"><tr><td>No Seri Piano</td><td>:</td><td>' + data2.serialpiano + '</td></tr><tr><td>Nama Piano</td><td>:</td><td>' + data2.namepiano + '</td></tr><tr><td>Bench</td><td>:</td><td>' + data2.serialbench + '</td></tr><tr><td>User Package</td><td>:</td><td>' + data2.serialuserp + '</td></tr><tr><td>Waktu Packing</td><td>:</td><td>' + data2.packingdate + '</td></tr></table></div>',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                    } else if (data2.status == "userp-match") {
                                        $('#serialuserppacking').attr("readonly", true);
                                        $("#status3").html("<span class='green'><i class='ace-icon fa fa-check-square-o'></i> MATCH</span>");
                                        $('#statususerp').val("ok");
                                        $('#packing').focus();
                                    } else {
                                        swal({
                                            title: "Warning",
                                            text: "User Package Tidak Sesuai",
                                            icon: "warning",
                                            confirmButtonClass: 'btn-danger',
                                            confirmButtonText: 'OK'
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                        return false;
                                    }
                                }
                            });
                        }
                    });
                } else {
                    // tidak menggunakan bench
                    $('#serialuserppacking').focus();
                    $('#serialuserppacking').keypress(function(e) {
                        if (e.which == 13) {
                            var dataString2 = {
                                gmcuserp: $("#gmchiddenuserp").val(),
                                serialuserp: $("#serialuserppacking").val()
                            };
                            $.ajax({
                                url: "packing/check_userp.php",
                                type: "POST",
                                data: dataString2,
                                success: function(data2) {
                                    var data2 = JSON.parse(data2);
                                    if (data2.status == "userp-tidak-terdaftar") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'User Package tidak terdaftar!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: true,
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                        return false;
                                    } else if (data2.status == "userp-belum-terdaftar") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'User Package belum terdaftar!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                    } else if (data2.status == "userp-bagian-lain") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'User Package tidak terdaftar pada <?= $_SESSION['role'] ?>!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                    } else if (data2.status == "userp-tidak-match") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'User Package tidak sesuai spesifikasi!',
                                            icon: 'error',
                                            timer: 5000,
                                            showConfirmButton: false,
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                    } else if (data2.status == "userp-sudah-digunakan") {
                                        Swal.fire({
                                            title: 'Ditolak!',
                                            html: data2.jenis + ' <b>' + data2.info + '</b> seharusnya sudah dipacking!<br><div style="text-align: left; padding-top: 5px;"><span> Info packing: </span><table class = "table"><tr><td>No Seri Piano</td><td>:</td><td>' + data2.serialpiano + '</td></tr><tr><td>Nama Piano</td><td>:</td><td>' + data2.namepiano + '</td></tr><tr><td>Bench</td><td>:</td><td>' + data2.serialbench + '</td></tr><tr><td>User Package</td><td>:</td><td>' + data2.serialuserp + '</td></tr><tr><td>Waktu Packing</td><td>:</td><td>' + data2.packingdate + '</td></tr></table></div>',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                    } else if (data2.status == "userp-match") {
                                        $('#serialuserppacking').attr("readonly", true);
                                        $("#status3").html("<span class='green'><i class='ace-icon fa fa-check-square-o'></i> MATCH</span>");
                                        $('#statususerp').val("ok");
                                        $('#packing').focus();
                                    } else {
                                        swal({
                                            title: "Warning",
                                            text: "User Package Tidak Sesuai",
                                            icon: "warning",
                                            confirmButtonClass: 'btn-danger',
                                            confirmButtonText: 'OK'
                                        });
                                        $('#serialuserppacking').val("");
                                        $("#status3").html("");
                                        return false;
                                    }
                                }
                            });
                        }
                    });
                }



                // packing
                $('#packing').click(function() {
                    $('#packing').attr("disabled", true);
                    $('#spinner-packing').show();
                    if ($('#owner').is(':checked')) {
                        var owner = "ok";
                    } else {
                        var owner = "";
                    }
                    var serialbench = $('#serialbenchpacking').val();
                    var serialuserp = $('#serialuserppacking').val();
                    var statusbench = $('#statusbench').val();
                    var statususerp = $('#statususerp').val();
                    // var jepretan = $('#fileupload').val();
                    // || jepretan == '' // ini dimasukkan kedalam pengecekan
                    if (serialbench == '' || statusbench != 'ok' || serialuserp == '' || statususerp != 'ok' || owner != 'ok') {
                        Swal.fire({
                            title: 'Packing ditolak!',
                            text: 'Masih terdapat data yang kosong!',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                        });

                        // cek mana yang kosong
                        if (gmcbench != '-') {
                            $('#serialbenchpacking').focus();
                        } else {
                            $('#serialuserppacking').focus();
                        }
                        $('#packing').attr("disabled", false);
                        $('#spinner-packing').hide();
                    } else {

                        // var dataString = new FormData();
                        // dataString.append('acard', $('#acard').val());
                        // dataString.append('serialbench', $('#serialbenchpacking').val());
                        // dataString.append('serialuserp', $('#serialuserppacking').val());
                        // dataString.append('namebench', $('#namebench').val());
                        // dataString.append('nameuserp', $('#nameuserp').val());
                        // dataString.append('gmcbench', $('#gmcbench').val());
                        // dataString.append('gmcuserp', $('#gmcuserp').val());
                        // dataString.append('serialpiano', $('#serialpiano').val());
                        // dataString.append('namepiano', $('#namepiano').val());
                        // dataString.append('gmcpiano', $('#gmcpiano').val());
                        // dataString.append('qtypiano', 1);
                        // dataString.append('qtybench', $('#qtybench').val());
                        // dataString.append('qtyuserp', $('#qtyuserp').val());

                        // dataString.append('jepretan', $('input[type=file]')[0].files[0]);

                        // {
                        //     serialbench: $('#serialbenchpacking').val(),
                        //     serialuserp: $('#serialuserppacking').val(),
                        //     namebench: $('#namebench').val(),
                        //     nameuserp: $('#nameuserp').val(),
                        //     gmcbench: $('#gmcbench').val(),
                        //     gmcuserp: $('#gmcuserp').val(),
                        //     serialpiano: $('#serialpiano').val(),
                        //     namepiano: $('#namepiano').val(),
                        //     gmcpiano: $('#gmcpiano').val(),
                        //     qtypiano: 1,
                        //     qtybench: $('#qtybench').val(),
                        //     qtyuserp: $('#qtyuserp').val(),
                        //     jepretan: $('#fileupload').val()
                        // };
                        $.ajax({
                            url: 'packing/packing_data.php',
                            type: 'POST',
                            data: {
                                acard: $('#acard').val(),
                                serialbench: $('#serialbenchpacking').val(),
                                serialuserp: $('#serialuserppacking').val(),
                                namebench: $('#namebench').val(),
                                nameuserp: $('#nameuserp').val(),
                                gmcbench: $('#gmcbench').val(),
                                gmcuserp: $('#gmcuserp').val(),
                                serialpiano: $('#serialpiano').val(),
                                namepiano: $('#namepiano').val(),
                                gmcpiano: $('#gmcpiano').val(),
                                qtypiano: 1,
                                qtybench: $('#qtybench').val(),
                                qtyuserp: $('#qtyuserp').val(),
                                // jepretan: $('#fileupload').val()
                            },
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 'packing-berhasil') {
                                    // jika packing berhasil
                                    Swal.fire({
                                        title: 'Packing berhasil!',
                                        text: 'Good job!',
                                        icon: 'success',
                                        timer: 3000,
                                        showConfirmButton: false,
                                    }).then(() => {
                                        window.location = "main.php?page=packing";
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Server busy!',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                    $('#packing').attr("disabled", false);
                                    $('#spinner-packing').hide();
                                }
                            }
                        });
                    }
                });
            })

            // function uploadgambar() {
            //     $('#fileupload').trigger("click");
            // }

            // $('#imgplaceholder').show();
            // $('#camera').show();
            // fileupload.onchange = evt => {
            //     $('#imgplaceholder').hide();
            //     $('#camera').hide();
            //     const [file] = fileupload.files
            //     if (file) {
            //         blah.src = URL.createObjectURL(file)
            //     }
            //     $('#blah').show();
            //     $('#retake').show();
            // }
        </script>

<?php
    } else {
        echo "<div class='center'><h5 class='red'><b>Nomor A-card salah atau belum terdaftar</b></h5></div>";
    }
}
