<?php
require '../../../config.php';

$serialnumber = $_POST['serialnumber'];

// cek terdaftar atau tidak (scan di inside)
$q1 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_register WHERE c_serialnumber = '$serialnumber'");
$d1 = mysqli_fetch_array($q1);
if ($d1['total'] == 0) {
    echo json_encode(array("status" => "not-found"));
} else {
    $q2 = mysqli_query($connect_pro, "SELECT c_repair_outsidetiga_o FROM finalcheck_repairtime WHERE c_serialnumber = '$serialnumber'");
    $d2 = mysqli_fetch_array($q2);
    if ($d2['c_repair_outsidetiga_o'] != '') {
        echo json_encode(array("status" => "closed"));
    } else {
        // get name piano
        $q3 = mysqli_query($connect_pro, "SELECT b.c_name FROM finalcheck_register a INNER JOIN finalcheck_list_piano b ON a.c_gmc = b.c_gmc WHERE a.c_serialnumber = '$serialnumber'");
        $d3 = mysqli_fetch_array($q3);
        $namepiano = $d3['c_name'];

        // get validation text
        $nama_val = strtolower($namkar);
        $serialnumber_val = strtolower($serialnumber);
        $text = "saya " . $nama_val . " yakin reset piano " . $serialnumber_val;
        echo json_encode(array("status" => "berhasil", "serialnumberform" => $serialnumber, "nameform" => $namepiano, "validationtext" => $text));
    }
}
