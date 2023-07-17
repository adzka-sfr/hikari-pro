<?php
include '../koneksi.php';

if ($_GET['p'] == 'cs') {
    include "create_slip/create_slip.php";
} elseif ($_GET['p'] == 'csn') {
    include "create_slip/create_slip2.php";
} else {
    include "create_slip/create_slip.php";
}
