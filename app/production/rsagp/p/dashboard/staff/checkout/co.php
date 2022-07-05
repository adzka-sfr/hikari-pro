<?php
include('../../_config/koneksi.php');
// agar ketika inputan kosong tetap bisa berjalan seperti menginputkan nilai 0
error_reporting(0);

$id = $_GET['id_plan'];
$qtycog0 = $_GET['qtycog0'];
$qtycog1 = $_GET['qtycog1'];
$qtycog2 = $_GET['qtycog2'];

//query update cek
$qry = mysqli_query($conn, "SELECT * FROM planing WHERE id_plan = '$id'");
$qryco = mysqli_fetch_array($qry);
// $qrycek = mysqli_query($conn, "SELECT p.tanggal,p.qty,p.name_piano, MIN(a.pcs/b.qtyperunit) as qtyy FROM planing p JOIN inventory_fix a  ON p.name_piano = a.name_piano JOIN bd_piano_fix b ON a.gmc = b.gmc where p.name_piano = '$qryco[name_piano]'");
$qrycek = mysqli_query($conn, "SELECT p.tanggal,p.qty as plan,p.name_piano, MIN(a.pcs/b.qtyperunit) as unit FROM planing p JOIN bd_piano_fix b  ON p.name_piano = b.name_piano JOIN inventory_fix a ON a.gmc_c = b.gmc_c where p.name_piano = '$qryco[name_piano]' AND p.tanggal = '$qryco[tanggal]' GROUP BY p.tanggal");
$ambilcek = mysqli_fetch_array($qrycek);
if ($ambilcek['unit'] < $qtycog0 || $ambilcek['unit'] < $qtycog1 || $ambilcek['unit'] < $qtycog2) {
    echo "<script>
    document.location.href = 'checkout.php';
    alert('Checkout is failed, please input checkout quantity under minimum from inventory quantity');</script>";
} elseif ($qtycog0 < 0 || $qtycog1 < 0 || $qtycog2 < 0) {
    if (abs($qtycog0) > $qryco['qtyCoG0'] || abs($qtycog1) > $qryco['qtyCoG1'] || abs($qtycog2) > $qryco['qtyCoG2']) {
        echo "<script>
        document.location.href = 'checkout.php';
        alert('Failed. Please input minus under quantity unit before');</script>";
    } else {
        // update checkout di planing
        $last_result_g0 =  $qryco['qtyCoG0'] + $qtycog0;
        $last_result_g1 =  $qryco['qtyCoG1'] + $qtycog1;
        $last_result_g2 =  $qryco['qtyCoG2'] + $qtycog2;
        mysqli_query($conn, "UPDATE planing SET update_co = NOW(), qtyCoG0='$last_result_g0', qtyCoG1='$last_result_g1', qtyCoG2='$last_result_g2' WHERE id_plan='$id'");
        // update qtyco_ratio || ratio paling kecil

        $qry = mysqli_query($conn, "SELECT * FROM planing WHERE id_plan = '$id'");
        $qryco = mysqli_fetch_array($qry);

        if (($qryco['qtyCoG0'] <= $qryco['qtyCoG1']) && ($qryco['qtyCoG0'] <= $qryco['qtyCoG2'])) {
            $ambill = $qryco['qtyCoG0'];
            mysqli_query($conn, "UPDATE planing SET qtyCo='$ambill' WHERE id_plan='$id'");
        } elseif (($qryco['qtyCoG1'] <= $qryco['qtyCoG0']) && ($qryco['qtyCoG1'] <= $qryco['qtyCoG2'])) {
            $ambill = $qryco['qtyCoG1'];
            mysqli_query($conn, "UPDATE planing SET qtyCo='$ambill' WHERE id_plan='$id'");
        } elseif (($qryco['qtyCoG2'] <= $qryco['qtyCoG0']) && ($qryco['qtyCoG2'] <= $qryco['qtyCoG1'])) {
            $ambill = $qryco['qtyCoG2'];
            mysqli_query($conn, "UPDATE planing SET qtyCo='$ambill' WHERE id_plan='$id'");
        }
        // update qtycoUp_ratio || ratio paling tinggi
        if (($qryco['qtyCoG0'] >= $qryco['qtyCoG1']) && ($qryco['qtyCoG0'] >= $qryco['qtyCoG2'])) {
            $ambil = $qryco['qtyCoG0'];
            mysqli_query($conn, "UPDATE planing SET qtyCoUp='$ambil' WHERE id_plan='$id'");
        } elseif (($qryco['qtyCoG1'] >= $qryco['qtyCoG0']) && ($qryco['qtyCoG1'] >= $qryco['qtyCoG2'])) {
            $ambil = $qryco['qtyCoG1'];
            mysqli_query($conn, "UPDATE planing SET  qtyCoUp='$ambil' WHERE id_plan='$id'");
        } elseif (($qryco['qtyCoG2'] >= $qryco['qtyCoG0']) && ($qryco['qtyCoG2'] >= $qryco['qtyCoG1'])) {
            $ambil = $qryco['qtyCoG2'];
            mysqli_query($conn, "UPDATE planing SET  qtyCoUp='$ambil' WHERE id_plan='$id'");
        }

        $qryy = mysqli_query($conn, "SELECT b.name_cabinet as name_cabinet, b.name_piano, b.qtyperunit as qtyperunit, b.pcs_plan FROM inventory_fix a INNER JOIN prioritas b ON a.gmc_c = b.gmc_c WHERE b.name_piano = '$name_piano'");
        while ($ambill = mysqli_fetch_array($qryy)) {
            $tambah_qtyy = $ambill['pcs_plan'] + ($qty * $ambill['qtyperunit']);
            mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$tambah_qtyy' WHERE name_cabinet = '$ambill[name_cabinet]' AND name_piano = '$name_piano'");
        }

        // bermasalah. G130 dan G150 G200
        $qryg130 = mysqli_query($conn, "SELECT b.name_piano as name_piano, a.gmc_c, a.name_cabinet as name_kabinet, b.qtyperunit as qtyperunit, a.pcs as pcs FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c where b.name_piano = '$qryco[name_piano]' AND b.dest = 'G 130'");
        while ($ambilg130 = mysqli_fetch_array($qryg130)) {
            $unitToPcs = $qtycog0 * $ambilg130['qtyperunit'];
            $ambilg130['pcs'] = $ambilg130['pcs'] - $unitToPcs;
            mysqli_query($conn, "UPDATE inventory_fix SET  pcs='$ambilg130[pcs]' WHERE gmc_c='$ambilg130[gmc_c]'");
            mysqli_query($conn, "UPDATE prioritas SET  pcs_inventory='$ambilg130[pcs]' WHERE gmc_c='$ambilg130[gmc_c]'");
        }
        $qryg150 = mysqli_query($conn, "SELECT b.name_piano as name_piano, a.gmc_c, a.name_cabinet as name_kabinet, b.qtyperunit as qtyperunit, a.pcs as pcs FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c where b.name_piano = '$qryco[name_piano]' AND b.dest = 'G 150'");
        while ($ambilg150 = mysqli_fetch_array($qryg150)) {
            $unitToPcs = $qtycog1 * $ambilg150['qtyperunit'];
            $ambilg150['pcs'] = $ambilg150['pcs'] - $unitToPcs;
            mysqli_query($conn, "UPDATE inventory_fix SET  pcs='$ambilg150[pcs]' WHERE gmc_c='$ambilg150[gmc_c]'");
            mysqli_query($conn, "UPDATE prioritas SET  pcs_inventory='$ambilg150[pcs]' WHERE gmc_c='$ambilg150[gmc_c]'");
        }
        $qryg200 = mysqli_query($conn, "SELECT b.name_piano as name_piano, a.gmc_c, a.name_cabinet as name_kabinet, b.qtyperunit as qtyperunit, a.pcs as pcs FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c where b.name_piano = '$qryco[name_piano]' AND b.dest = 'G 200'");
        while ($ambilg200 = mysqli_fetch_array($qryg200)) {
            $unitToPcs = $qtycog2 * $ambilg200['qtyperunit'];
            $ambilg200['pcs'] = $ambilg200['pcs'] - $unitToPcs;
            mysqli_query($conn, "UPDATE inventory_fix SET  pcs='$ambilg200[pcs]' WHERE gmc_c='$ambilg200[gmc_c]'");
            mysqli_query($conn, "UPDATE prioritas SET  pcs_inventory='$ambilg200[pcs]' WHERE gmc_c='$ambilg200[gmc_c]'");
        }

        // db Prioritas
        // kurangi qtyplan semua kabinet G0
        $qryg130okeplan = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan, gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 130\"");
        while ($ambilg130okeplan = mysqli_fetch_array($qryg130okeplan)) {
            $unitToPcs = $qtycog0 * $ambilg130okeplan['qtyperunit'];
            $update_pcs_plan = $ambilg130okeplan['pcs_plan'] - $unitToPcs;
            mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$update_pcs_plan' WHERE name_cabinet = '$ambilg130okeplan[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 130\"");
        }

        $qryg150okeplan = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan, gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 150\"");
        while ($ambilg150okeplan = mysqli_fetch_array($qryg150okeplan)) {
            $unitToPcs = $qtycog1 * $ambilg150okeplan['qtyperunit'];
            $update_pcs_plan = $ambilg150okeplan['pcs_plan'] - $unitToPcs;
            mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$update_pcs_plan' WHERE name_cabinet = '$ambilg150okeplan[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 150\"");
        }

        $qryg200okeplan = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan, gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 200\"");
        while ($ambilg200okeplan = mysqli_fetch_array($qryg200okeplan)) {
            $unitToPcs = $qtycog2 * $ambilg200okeplan['qtyperunit'];
            $update_pcs_plan = $ambilg200okeplan['pcs_plan'] - $unitToPcs;
            mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$update_pcs_plan' WHERE name_cabinet = '$ambilg200okeplan[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 200\"");
        }

        // kurangi qtyco semua kabinet G130
        $qryg130oke = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan,unit_co ,gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 130\"");
        while ($ambilg130oke = mysqli_fetch_array($qryg130oke)) {
            $ambilg130oke['unit_co'] = $ambilg130oke['unit_co'] + $qtycog0;
            mysqli_query($conn, "UPDATE prioritas SET  unit_co='$ambilg130oke[unit_co]' WHERE name_cabinet = '$ambilg130oke[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 130\"");
        }
        // kurangi qtyco semua kabinet G150
        $qryg150oke = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan,unit_co ,gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 150\"");
        while ($ambilg150oke = mysqli_fetch_array($qryg150oke)) {
            $ambilg150oke['unit_co'] = $ambilg150oke['unit_co'] + $qtycog1;
            mysqli_query($conn, "UPDATE prioritas SET  unit_co='$ambilg150oke[unit_co]' WHERE name_cabinet = '$ambilg150oke[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 150\"");
        }
        // kurangi qtyco semua kabinet G200
        $qryg200oke = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan,unit_co ,gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 200\"");
        while ($ambilg200oke = mysqli_fetch_array($qryg200oke)) {
            $ambilg200oke['unit_co'] = $ambilg200oke['unit_co'] + $qtycog2;
            mysqli_query($conn, "UPDATE prioritas SET  unit_co='$ambilg200oke[unit_co]' WHERE name_cabinet = '$ambilg200oke[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 200\"");
        }
        // update qty_prioritas
        $qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE name_piano = '$name_piano'");
        while ($ambilll = mysqli_fetch_array($qryyy)) {
            $qty_prior = $ambilll['pcs_inventory'] - $ambilll['pcs_plan'];
            mysqli_query($conn, "UPDATE prioritas SET pcs_prioritas = '$qty_prior' WHERE name_cabinet = '$ambilll[name_cabinet]' AND name_piano = '$name_piano'");
        }
        echo "<script>
document.location.href = 'checkout.php';
alert('update success');</script>";
    }
} else {
    // update checkout di planing
    $last_result_g0 =  $qryco['qtyCoG0'] + $qtycog0;
    $last_result_g1 =  $qryco['qtyCoG1'] + $qtycog1;
    $last_result_g2 =  $qryco['qtyCoG2'] + $qtycog2;
    mysqli_query($conn, "UPDATE planing SET update_co = NOW(), qtyCoG0='$last_result_g0', qtyCoG1='$last_result_g1', qtyCoG2='$last_result_g2' WHERE id_plan='$id'");
    // update qtyco_ratio || ratio paling kecil

    $qry = mysqli_query($conn, "SELECT * FROM planing WHERE id_plan = '$id'");
    $qryco = mysqli_fetch_array($qry);

    if (($qryco['qtyCoG0'] <= $qryco['qtyCoG1']) && ($qryco['qtyCoG0'] <= $qryco['qtyCoG2'])) {
        $ambill = $qryco['qtyCoG0'];
        mysqli_query($conn, "UPDATE planing SET qtyCo='$ambill' WHERE id_plan='$id'");
    } elseif (($qryco['qtyCoG1'] <= $qryco['qtyCoG0']) && ($qryco['qtyCoG1'] <= $qryco['qtyCoG2'])) {
        $ambill = $qryco['qtyCoG1'];
        mysqli_query($conn, "UPDATE planing SET qtyCo='$ambill' WHERE id_plan='$id'");
    } elseif (($qryco['qtyCoG2'] <= $qryco['qtyCoG0']) && ($qryco['qtyCoG2'] <= $qryco['qtyCoG1'])) {
        $ambill = $qryco['qtyCoG2'];
        mysqli_query($conn, "UPDATE planing SET qtyCo='$ambill' WHERE id_plan='$id'");
    }
    // update qtycoUp_ratio || ratio paling tinggi
    if (($qryco['qtyCoG0'] >= $qryco['qtyCoG1']) && ($qryco['qtyCoG0'] >= $qryco['qtyCoG2'])) {
        $ambil = $qryco['qtyCoG0'];
        mysqli_query($conn, "UPDATE planing SET qtyCoUp='$ambil' WHERE id_plan='$id'");
    } elseif (($qryco['qtyCoG1'] >= $qryco['qtyCoG0']) && ($qryco['qtyCoG1'] >= $qryco['qtyCoG2'])) {
        $ambil = $qryco['qtyCoG1'];
        mysqli_query($conn, "UPDATE planing SET  qtyCoUp='$ambil' WHERE id_plan='$id'");
    } elseif (($qryco['qtyCoG2'] >= $qryco['qtyCoG0']) && ($qryco['qtyCoG2'] >= $qryco['qtyCoG1'])) {
        $ambil = $qryco['qtyCoG2'];
        mysqli_query($conn, "UPDATE planing SET  qtyCoUp='$ambil' WHERE id_plan='$id'");
    }

    $qryy = mysqli_query($conn, "SELECT b.name_cabinet as name_cabinet, b.name_piano, b.qtyperunit as qtyperunit, b.pcs_plan FROM inventory_fix a INNER JOIN prioritas b ON a.gmc_c = b.gmc_c WHERE b.name_piano = '$name_piano'");
    while ($ambill = mysqli_fetch_array($qryy)) {
        $tambah_qtyy = $ambill['pcs_plan'] + ($qty * $ambill['qtyperunit']);
        mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$tambah_qtyy' WHERE name_cabinet = '$ambill[name_cabinet]' AND name_piano = '$name_piano'");
    }

    // bermasalah. G130 dan G150 G200
    $qryg130 = mysqli_query($conn, "SELECT b.name_piano as name_piano, a.gmc_c, a.name_cabinet as name_kabinet, b.qtyperunit as qtyperunit, a.pcs as pcs FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c where b.name_piano = '$qryco[name_piano]' AND b.dest = 'G 130'");
    while ($ambilg130 = mysqli_fetch_array($qryg130)) {
        $unitToPcs = $qtycog0 * $ambilg130['qtyperunit'];
        $ambilg130['pcs'] = $ambilg130['pcs'] - $unitToPcs;
        mysqli_query($conn, "UPDATE inventory_fix SET  pcs='$ambilg130[pcs]' WHERE gmc_c='$ambilg130[gmc_c]'");
        mysqli_query($conn, "UPDATE prioritas SET  pcs_inventory='$ambilg130[pcs]' WHERE gmc_c='$ambilg130[gmc_c]'");
    }
    $qryg150 = mysqli_query($conn, "SELECT b.name_piano as name_piano, a.gmc_c, a.name_cabinet as name_kabinet, b.qtyperunit as qtyperunit, a.pcs as pcs FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c where b.name_piano = '$qryco[name_piano]' AND b.dest = 'G 150'");
    while ($ambilg150 = mysqli_fetch_array($qryg150)) {
        $unitToPcs = $qtycog1 * $ambilg150['qtyperunit'];
        $ambilg150['pcs'] = $ambilg150['pcs'] - $unitToPcs;
        mysqli_query($conn, "UPDATE inventory_fix SET  pcs='$ambilg150[pcs]' WHERE gmc_c='$ambilg150[gmc_c]'");
        mysqli_query($conn, "UPDATE prioritas SET  pcs_inventory='$ambilg150[pcs]' WHERE gmc_c='$ambilg150[gmc_c]'");
    }
    $qryg200 = mysqli_query($conn, "SELECT b.name_piano as name_piano, a.gmc_c, a.name_cabinet as name_kabinet, b.qtyperunit as qtyperunit, a.pcs as pcs FROM inventory_fix a INNER JOIN bd_piano_fix b ON a.gmc_c = b.gmc_c where b.name_piano = '$qryco[name_piano]' AND b.dest = 'G 200'");
    while ($ambilg200 = mysqli_fetch_array($qryg200)) {
        $unitToPcs = $qtycog2 * $ambilg200['qtyperunit'];
        $ambilg200['pcs'] = $ambilg200['pcs'] - $unitToPcs;
        mysqli_query($conn, "UPDATE inventory_fix SET  pcs='$ambilg200[pcs]' WHERE gmc_c='$ambilg200[gmc_c]'");
        mysqli_query($conn, "UPDATE prioritas SET  pcs_inventory='$ambilg200[pcs]' WHERE gmc_c='$ambilg200[gmc_c]'");
    }

    // db Prioritas
    // kurangi qtyplan semua kabinet G0
    $qryg130okeplan = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan, gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 130\"");
    while ($ambilg130okeplan = mysqli_fetch_array($qryg130okeplan)) {
        $unitToPcs = $qtycog0 * $ambilg130okeplan['qtyperunit'];
        $update_pcs_plan = $ambilg130okeplan['pcs_plan'] - $unitToPcs;
        mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$update_pcs_plan' WHERE name_cabinet = '$ambilg130okeplan[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 130\"");
    }

    $qryg150okeplan = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan, gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 150\"");
    while ($ambilg150okeplan = mysqli_fetch_array($qryg150okeplan)) {
        $unitToPcs = $qtycog1 * $ambilg150okeplan['qtyperunit'];
        $update_pcs_plan = $ambilg150okeplan['pcs_plan'] - $unitToPcs;
        mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$update_pcs_plan' WHERE name_cabinet = '$ambilg150okeplan[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 150\"");
    }

    $qryg200okeplan = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan, gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 200\"");
    while ($ambilg200okeplan = mysqli_fetch_array($qryg200okeplan)) {
        $unitToPcs = $qtycog2 * $ambilg200okeplan['qtyperunit'];
        $update_pcs_plan = $ambilg200okeplan['pcs_plan'] - $unitToPcs;
        mysqli_query($conn, "UPDATE prioritas SET pcs_plan = '$update_pcs_plan' WHERE name_cabinet = '$ambilg200okeplan[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 200\"");
    }

    // kurangi qtyco semua kabinet G130
    $qryg130oke = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan,unit_co ,gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 130\"");
    while ($ambilg130oke = mysqli_fetch_array($qryg130oke)) {
        $ambilg130oke['unit_co'] = $ambilg130oke['unit_co'] + $qtycog0;
        mysqli_query($conn, "UPDATE prioritas SET  unit_co='$ambilg130oke[unit_co]' WHERE name_cabinet = '$ambilg130oke[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 130\"");
    }
    // kurangi qtyco semua kabinet G150
    $qryg150oke = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan,unit_co ,gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 150\"");
    while ($ambilg150oke = mysqli_fetch_array($qryg150oke)) {
        $ambilg150oke['unit_co'] = $ambilg150oke['unit_co'] + $qtycog1;
        mysqli_query($conn, "UPDATE prioritas SET  unit_co='$ambilg150oke[unit_co]' WHERE name_cabinet = '$ambilg150oke[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 150\"");
    }
    // kurangi qtyco semua kabinet G200
    $qryg200oke = mysqli_query($conn, "SELECT name_piano, name_cabinet, qtyperunit, pcs_plan,unit_co ,gmc_c FROM prioritas where name_piano = '$qryco[name_piano]' AND dest = \"G 200\"");
    while ($ambilg200oke = mysqli_fetch_array($qryg200oke)) {
        $ambilg200oke['unit_co'] = $ambilg200oke['unit_co'] + $qtycog2;
        mysqli_query($conn, "UPDATE prioritas SET  unit_co='$ambilg200oke[unit_co]' WHERE name_cabinet = '$ambilg200oke[name_cabinet]' AND name_piano = '$qryco[name_piano]' AND dest = \"G 200\"");
    }
    // update qty_prioritas
    $qryyy = mysqli_query($conn, "SELECT * from prioritas WHERE name_piano = '$name_piano'");
    while ($ambilll = mysqli_fetch_array($qryyy)) {
        $qty_prior = $ambilll['pcs_inventory'] - $ambilll['pcs_plan'];
        mysqli_query($conn, "UPDATE prioritas SET pcs_prioritas = '$qty_prior' WHERE name_cabinet = '$ambilll[name_cabinet]' AND name_piano = '$name_piano'");
    }
    echo "<script>
document.location.href = 'checkout.php';
alert('update success');</script>";
}
