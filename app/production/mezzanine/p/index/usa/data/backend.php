<?php
include '../koneksi.php';
$datashowtime = date('D, d M Y H:i:s');
include 'DataHours2.php';
include 'DataHours16.php';

if ($_GET['p'] == 'csn') {
    // include "createslip.php";
} elseif ($_GET['p'] == 'kon') {
    // include "create_slip/create_slip2.php";
} else {
    // include "create_slip/create_slip.php";
}
