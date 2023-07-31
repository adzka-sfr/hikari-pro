<?php
require('../config.php');
?>
<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('_bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<div class="row">
    <div class="col-12 mt-3">
        <h5>Hasil <b><?= $_SESSION['nama'] ?></b> hari ini, <b><?= date('d-m-Y', strtotime($now)) ?></b></h5>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <?php
        $hari_ini = date('Y-m-d', strtotime($now));
        $q1 = mysqli_query($connect_pro, "SELECT COUNT(a.c_serialnumber) as total FROM finalcheck_pic a INNER JOIN finalcheck_timestamp b ON a.c_serialnumber = b.c_serialnumber WHERE a.c_outsidedua = '$_SESSION[nama]' AND b.c_outsidedua_o LIKE '$hari_ini%' ");
        $d1 = mysqli_fetch_array($q1);
        $total_piano = $d1['total'];
        ?>
        <h6>Total : <?= $total_piano ?> piano</b>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered" style="font-size: 20px;">
            <thead style="text-align: center;">
                <tr>
                    <th rowspan="2" style="width: 5%;">No</th>
                    <th rowspan="2">No Seri</th>
                    <th colspan="2" style="width: 36%;">Completeness</th>
                    <th colspan="2" style="width: 36%;">Outside</th>
                </tr>
                <tr>
                    <th style="width: 18%;">NG</th>
                    <th style="width: 18%;">OK</th>
                    <th style="width: 18%;">NG</th>
                    <th style="width: 18%;">OK</th>
                </tr>
            </thead>
            <?php
            ?>
            <tbody style="text-align: center;">
                <?php
                if ($total_piano == 0) {
                ?>
                    <tr>
                        <td colspan="6">No Data</td>
                    </tr>
                    <?php
                } else {
                    $no = 0;
                    $q2 = mysqli_query($connect_pro, "SELECT a.c_serialnumber FROM finalcheck_pic a INNER JOIN finalcheck_timestamp b ON a.c_serialnumber = b.c_serialnumber WHERE a.c_outsidedua = '$_SESSION[nama]' AND b.c_outsidedua_o LIKE '$hari_ini%'");
                    while ($d2 = mysqli_fetch_array($q2)) {
                        $no++;
                        // cek apakah kode yang di scan sudah di close statusnya alias sudah selesai sampai cek 3
                        $q5 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_repairtime WHERE c_serialnumber = '$d2[c_serialnumber]' AND c_repair_outsidetiga_o != ''");
                        $d5 = mysqli_fetch_array($q5);

                        if ($d5['total'] == 0) {
                            // get ng date from fetch table
                            // get ng date completeness
                            $q6 = mysqli_query($connect_pro, "SELECT c_resultdua_date FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$d2[c_serialnumber]' AND c_resultdua = 'N'");
                            $d6 = mysqli_fetch_array($q6);

                            if (empty($d6['c_resultdua_date'])) {
                                $ng_completeness = '-';
                            } else {
                                $ng_completeness = date('h:i A', strtotime($d6['c_resultdua_date']));
                            }

                            // get ng date outside
                            // cek apakah ada ng
                            $q9 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) AS total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$d2[c_serialnumber]' AND c_process = 'oc2'");
                            $d9 = mysqli_fetch_array($q9);
                            if ($d9['total'] == 0) {
                                $q10 = mysqli_query($connect_pro, "SELECT c_outsidedua_o FROM finalcheck_timestamp WHERE c_serialnumber = '$d2[c_serialnumber]'");
                                $d10 = mysqli_fetch_array($q10);
                                if (empty($d10['c_outsidedua_o'])) {
                                    $ng_outside = 'Masih check';
                                } else {
                                    $ng_outside = '-';
                                }
                            } else {
                                $q10 = mysqli_query($connect_pro, "SELECT c_outsidedua_o FROM finalcheck_timestamp WHERE c_serialnumber = '$d2[c_serialnumber]'");
                                $d10 = mysqli_fetch_array($q10);
                                if (empty($d10['c_outsidedua_o'])) {
                                    $ng_outside = 'Masih check';
                                } else {
                                    $q11 = mysqli_query($connect_pro, "SELECT MAX(c_result_date) as maks FROM finalcheck_fetch_outside WHERE c_serialnumber = '$d2[c_serialnumber]' AND c_process = 'oc2'");
                                    $d11 = mysqli_fetch_array($q11);
                                    $ng_outside = date('h:i A', strtotime($d11['maks']));
                                }
                            }

                            // get ok date completeness
                            // cek apakah terdapat ng pada completeness
                            $q7 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_completeness WHERE c_Serialnumber = '$d2[c_serialnumber]' AND c_resultdua = 'N'");
                            $d7 = mysqli_fetch_array($q7);
                            if ($d7['total'] == 0) {
                                $q8 = mysqli_query($connect_pro, "SELECT c_completenessdua_o FROM finalcheck_timestamp WHERE c_serialnumber = '$d2[c_serialnumber]'");
                                $d8 = mysqli_fetch_array($q8);
                                $ok_completeness = date('h:i A', strtotime($d8['c_completenessdua_o']));
                            } else {
                                $q8 = mysqli_query($connect_pro, "SELECT c_repair_outsidedua_o FROM finalcheck_repairtime WHERE c_serialnumber = '$d2[c_serialnumber]'");
                                $d8 = mysqli_fetch_array($q8);
                                if (empty($d8['c_repair_outsidedua_o'])) {
                                    $ok_completeness = 'Proses repair';
                                } else {
                                    $ok_completeness = date('h:i A', strtotime($d8['c_repair_outsidedua_o']));
                                }
                            }

                            // get ok date outside
                            $q12 = mysqli_query($connect_pro, "SELECT c_repair_outsidedua_o FROM finalcheck_repairtime WHERE c_serialnumber = '$d2[c_serialnumber]'");
                            $d12 = mysqli_fetch_array($q12);
                            if (empty($d12['c_repair_outsidedua_o'])) {
                                $ok_outside = 'Proses repair';
                            } else {
                                $ok_outside = date('h:i A', strtotime($d12['c_repair_outsidedua_o']));
                            }
                        } else {
                            // get ng date from main table
                            // get ng date completeness
                            $q6 = mysqli_query($connect_pro, "SELECT c_resultdua_date FROM finalcheck_completeness WHERE c_serialnumber = '$d2[c_serialnumber]' AND c_resultdua = 'N'");
                            $d6 = mysqli_fetch_array($q6);

                            if (empty($d6['c_resultdua_date'])) {
                                $ng_completeness = '-';
                            } else {
                                $ng_completeness = date('h:i A', strtotime($d6['c_resultdua_date']));
                            }

                            // get ng date outside
                            // cek apakah ada ng
                            $q9 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) AS total FROM finalcheck_outside WHERE c_serialnumber = '$d2[c_serialnumber]' AND c_process = 'oc2'");
                            $d9 = mysqli_fetch_array($q9);
                            if ($d9['total'] == 0) {
                                $q10 = mysqli_query($connect_pro, "SELECT c_outsidedua_o FROM finalcheck_timestamp WHERE c_serialnumber = '$d2[c_serialnumber]'");
                                $d10 = mysqli_fetch_array($q10);
                                if (empty($d10['c_outsidedua_o'])) {
                                    $ng_outside = 'Masih check';
                                } else {
                                    $ng_outside = '-';
                                }
                            } else {
                                $q10 = mysqli_query($connect_pro, "SELECT c_outsidedua_o FROM finalcheck_timestamp WHERE c_serialnumber = '$d2[c_serialnumber]'");
                                $d10 = mysqli_fetch_array($q10);
                                if (empty($d10['c_outsidedua_o'])) {
                                    $ng_outside = 'Masih check';
                                } else {
                                    $q11 = mysqli_query($connect_pro, "SELECT MAX(c_result_date) as maks FROM finalcheck_outside WHERE c_serialnumber = '$d2[c_serialnumber]' AND c_process = 'oc2'");
                                    $d11 = mysqli_fetch_array($q11);
                                    $ng_outside = date('h:i A', strtotime($d11['maks']));
                                }
                            }

                            // get ok date completeness
                            // cek apakah terdapat ng pada completeness
                            $q7 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_completeness WHERE c_Serialnumber = '$d2[c_serialnumber]' AND c_resultdua = 'N'");
                            $d7 = mysqli_fetch_array($q7);
                            if ($d7['total'] == 0) {
                                $q8 = mysqli_query($connect_pro, "SELECT c_completenessdua_o FROM finalcheck_timestamp WHERE c_serialnumber = '$d2[c_serialnumber]'");
                                $d8 = mysqli_fetch_array($q8);
                                $ok_completeness = date('h:i A', strtotime($d8['c_completenessdua_o']));
                            } else {
                                $q8 = mysqli_query($connect_pro, "SELECT c_repair_outsidedua_o FROM finalcheck_repairtime WHERE c_serialnumber = '$d2[c_Serialnumber]'");
                                $d8 = mysqli_fetch_array($q8);
                                if (empty($d8['c_repair_outsidedua_o'])) {
                                    $ok_completeness = 'Proses repair';
                                } else {
                                    $ok_completeness = date('h:i A', strtotime($d8['c_repair_outsidedua_o']));
                                }
                            }

                            // get ok date outside
                            $q12 = mysqli_query($connect_pro, "SELECT c_repair_outsidedua_o FROM finalcheck_repairtime WHERE c_serialnumber = '$d2[c_serialnumber]'");
                            $d12 = mysqli_fetch_array($q12);
                            if (empty($d12['c_repair_outsidedua_o'])) {
                                $ok_outside = 'Proses repair';
                            } else {
                                $ok_outside = date('h:i A', strtotime($d12['c_repair_outsidedua_o']));
                            }
                        }

                        // get ng date
                        $q3 = mysqli_query($connect_pro, "SELECT c_result_date FROM finalcheck_inside WHERE c_serialnumber = '$d2[c_serialnumber]' AND c_result = 'NG'");
                        $d3 = mysqli_fetch_array($q3);

                        // get ok date
                        $q4 = mysqli_query($connect_pro, "SELECT c_repair_inside_o FROM finalcheck_repairtime WHERE c_serialnumber = '$d2[c_serialnumber]'");
                        $d4 = mysqli_fetch_array($q4);
                        if (empty($d4['c_repair_inside_o'])) {
                            $ok_date = "Proses repair";
                        } else {
                            $ok_date = date('h:i A', strtotime($d4['c_repair_inside_o']));
                        }

                        if (empty($d3['c_result_date'])) {
                            $ng_date = '-';
                        } else {
                            $ng_date = $d3['c_result_date'];
                            $ng_date = date('h:i A', strtotime($ng_date));
                        }
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $d2['c_serialnumber'] ?></td>
                            <td><?= $ng_completeness ?></td>
                            <td><?= $ok_completeness ?></td>
                            <td><?= $ng_outside ?></td>
                            <td><?= $ok_outside ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>