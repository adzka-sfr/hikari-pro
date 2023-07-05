<?php

require __DIR__ . '/vendor/mike42/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$thn = date('y', strtotime($now));
$bln = date('m', strtotime($now));
$thismonth = date('Y-m');

if ($bln == '01') {
    $monthcode = 'A';
} elseif ($bln == '02') {
    $monthcode = 'B';
} elseif ($bln == '03') {
    $monthcode = 'C';
} elseif ($bln == '04') {
    $monthcode = 'D';
} elseif ($bln == '05') {
    $monthcode = 'E';
} elseif ($bln == '06') {
    $monthcode = 'F';
} elseif ($bln == '07') {
    $monthcode = 'G';
} elseif ($bln == '03') {
    $monthcode = 'H';
} elseif ($bln == '09') {
    $monthcode = 'I';
} elseif ($bln == '10') {
    $monthcode = 'J';
} elseif ($bln == '11') {
    $monthcode = 'K';
} elseif ($bln == '12') {
    $monthcode = 'L';
}
?>
<form method="post" class="form-horizontal form-label-left">
    <!-- <div class="row">
        <div class="col-3">
            <script>
                $(document).ready(function() {
                    // $("#gmc").keydown(function() {
                    //     $("#gmc").css("background-color", "yellow");
                    // });
                    $("#gmc").keyup(function() {

                        var isia = $("#gmc").val();
                        $.ajax({
                            url: "print/search.php",
                            method: "POST",
                            data: {
                                isia: isia
                            },
                            success: function(data) {
                                $('#name').val(data);
                                $('#gmc').keypress(function(e) {
                                    if (e.which == 13) {
                                        $('#qty').focus();
                                    }
                                });
                            }
                        });
                    });
                });
            </script>
            <input id="gmc" name="gmc" style="text-align: center; border-radius: 5px;" type="text" class="form-control" placeholder="GMC" autofocus>
        </div>
        <div class="col-9">
            <input id="name" readonly name="pianoname" style="border-radius: 5px;" type="text" class="form-control" placeholder="Bench Name">
        </div>
    </div> -->
    <div class="row">
        <div class="col-12">
            <h5>Select GMC of Bench
                <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <label class="control-label col-md-4" for="first-name">Name of Bench</span>
                    </label>
                    <div class="col-md-8">
                        <select class="cari_basic" style="width: 100% " required name="gmc">
                            <option></option>
                            <?php
                            $username = "B_ACTY";
                            $password = "SYSTEM";
                            $db = "(DESCRIPTION =(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521)))(CONNECT_DATA = (SERVICE_NAME = YIKSTAFF)))";
                            $connection = oci_connect($username, $password, $db);

                            $sql1 = "SELECT DISTINCT M_ACTY.M0031.KOHMCD, M_ACTY.M0010.HMSNM FROM M_ACTY.M0031 JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD WHERE M_ACTY.M0010.HMSNM LIKE 'BENCH NO%' OR M_ACTY.M0010.HMSNM LIKE 'BENCH ASSY%' AND M_ACTY.M0010.HMSNM NOT LIKE '%CQ%' AND M_ACTY.M0010.HMSTATUS != 'CI'";
                            $statment1 = oci_parse($connection, $sql1);
                            oci_execute($statment1);
                            while ($ora_result_case = oci_fetch_array($statment1)) {
                            ?>
                                <option value="<?= $ora_result_case['KOHMCD'] ?>">(<?= $ora_result_case['KOHMCD'] ?>) <?= $ora_result_case['HMSNM'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label class="control-label col-md-4 mt-3" for="first-name">QTY</span>
                    </label>
                    <div class="col-md-2 mt-3">
                        <input required id="qty" name="qty" style="text-align: center; border-radius: 5px;" type="text" class="form-control" placeholder="QTY" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12 text-center" style="padding: 0px;;">
                    <button style="width: 90%; " class="btn btn-lg btn-success" type="submit" name="print">Print</button>
                </div>
            </div>
        </div>
    </div>


</form>
<?php
if (isset($_POST['print'])) {
    $c_gmc = $_POST['gmc']; // qa_bench.c_gmc
    // get nama bench
    $sql2 = "SELECT M_ACTY.M0010.HMSNM FROM M_ACTY.M0031 JOIN M_ACTY.M0010 ON M_ACTY.M0031.KOHMCD = M_ACTY.M0010.HMCD WHERE M_ACTY.M0031.KOHMCD = '$c_gmc'";
    $statment2 = oci_parse($connection, $sql2);
    oci_execute($statment2);
    $ora_result_case2 = oci_fetch_array($statment2);
    $c_name = $ora_result_case2['HMSNM']; // qa_bench.c_name

    // cek no bench terakhir pada bulan ini
    $sql3 = mysqli_query($connect_pro, "SELECT id FROM qa_bench WHERE c_gmc = '$c_gmc' AND c_created LIKE '$thismonth%'");
    $data3 = mysqli_fetch_array($sql3);

    if (!empty($data3['id'])) {
        $sql3 = mysqli_query($connect_pro, "SELECT MAX(c_serialbench) AS maks FROM qa_bench WHERE c_gmc = '$c_gmc' AND c_created LIKE '$thismonth%'");
        $data3 = mysqli_fetch_array($sql3);

        $potong = substr($data3['maks'], 10);
        $no_urut = $potong;
    } else {
        $no_urut = 0;
    }

    $sebanyak = $_POST['qty'];
    $c_created = date('Y-m-d H:i:s', strtotime($now));
    for ($a = 0; $a < $sebanyak; $a++) {
        $no_urut = $no_urut + 1;
        if ($no_urut < 10) {
            $no_urut = "000" . $no_urut;
        } elseif ($no_urut < 100) {
            $no_urut = "00" . $no_urut;
        } elseif ($no_urut < 1000) {
            $no_urut = "0" . $no_urut;
        }

        $c_serialbench = $c_gmc . $thn . $monthcode . $no_urut; // qa_bench.c_serialbench

        // echo $no_urut . "</br>";
        mysqli_query($connect_pro, "INSERT INTO qa_bench SET c_gmc = '$c_gmc', c_serialbench = '$c_serialbench', c_name = '$c_name', c_created = '$c_created'");

        try {
            $connector = new WindowsPrintConnector("smb://Adzka/POS-80");
            $printer = new Printer($connector);
            $printer->initialize();
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode();
            $printer->setEmphasis(true);
            $printer->text($c_name . "\n");
            $printer->setEmphasis(false);
            $printer->setBarcodeHeight(60);
            $printer->setBarcodeWidth(2);
            $printer->barcode($c_serialbench, Printer::BARCODE_CODE93);
            $printer->selectPrintMode();
            $printer->text($c_serialbench . "\n");
            //$printer->feed();
            $printer->cut();
            $printer->pulse();
            $printer->close();
        } catch (Exception $e) {
            echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
        }
    }

    // INSERT QALOG
    $sql_qalog = mysqli_query($connect_pro, "INSERT INTO qa_log SET 
    c_action = 'print label',
    c_serialbench = '-',
    c_namebench = '$c_name',
    c_gmcbench = '$c_gmc',
    c_serialpiano = '-',
    c_namepiano = '-',
    c_gmcpiano = '-',
    c_qty = '$sebanyak',
    c_pic = '$_SESSION[id]',
    c_date = '$c_created'");
}
?>
<hr>
<script>
    $(document).ready(function() {
        $('#infobench').DataTable({
            paging: false,
            "dom": '<"wrapper"flipt>'
        });
    });
</script>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered" id="infobench">
            <thead style="text-align: center;">
                <th>No</th>
                <th>GMC</th>
                <th>Serial Bench</th>
                <th>Nama Bench</th>
                <th>Created</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM qa_bench ORDER BY c_created DESC");
                while ($data = mysqli_fetch_array($sql)) {
                    $no++;

                    // get status
                    if ($data['c_used'] == '') {
                        $status = "FREE";
                        $color = "success";
                    } else {
                        if ($data['c_packed'] == '') {
                            $status = "USED";
                            $color = "primary";
                        } else {
                            $status = "PACKED";
                            $color = "danger";
                        }
                    }

                    // get location
                    if ($data['c_location'] == 'packing up') {
                        $location = 'Packing UP';
                    } elseif ($data['c_location'] == 'packing gp') {
                        $location = 'Packing GP';
                    }
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $no ?></td>
                        <td style="text-align: center;"><?= $data['c_gmc'] ?></td>
                        <td style="text-align: center;"><?= $data['c_serialbench'] ?></td>
                        <td><?= $data['c_name'] ?></td>
                        <td><?= $data['c_created'] ?></td>
                        <td style="text-align: center;">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#<?= $data['c_serialbench'] ?>" class="btn btn-sm btn-outline-<?= $color ?>" style="padding-top: 0px;padding-bottom: 0px; width:100px"><?= $status ?></button>

                            <!-- Modal -->
                            <div class="modal fade" id="<?= $data['c_serialbench'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Information of Bench</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 mt-2 label-align">Serial Number</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="text" readonly class="form-control" value="<?= $data['c_serialbench'] ?>">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 mt-2 label-align">Name</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="text" readonly class="form-control" value="<?= $data['c_name'] ?>">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 mt-2 label-align">GMC</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="text" readonly class="form-control" value="<?= $data['c_gmc'] ?>">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 mt-2 label-align">Label Created</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="text" readonly class="form-control" value="<?= $data['c_created'] ?>">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 mt-2 label-align">Register Stock</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="text" readonly class="form-control" value="<?php
                                                                                                                if ($data['c_used'] == '') {
                                                                                                                    echo "-";
                                                                                                                } else {
                                                                                                                    echo $data['c_used'] . " - in " . $location;
                                                                                                                }
                                                                                                                ?>">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 mt-2 label-align">Packed</span>
                                                    </label>
                                                    <div class="col-md-8 col-sm-8 ">
                                                        <input type="text" readonly class="form-control" value="<?php
                                                                                                                if ($data['c_packed'] == '') {
                                                                                                                    echo "-";
                                                                                                                } else {
                                                                                                                    echo $data['c_packed'];
                                                                                                                }
                                                                                                                ?>">
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <hr>
    </div>
</div>