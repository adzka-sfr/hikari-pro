<?php
include '../koneksi.php';

if ($_GET['p'] == 'cs') {
    include "create_slip/create_slip.php";
} elseif ($_GET['p'] == 'dh') {
    include "_help/index.php";
} else {
    include "create_slip/create_slip.php";
}
