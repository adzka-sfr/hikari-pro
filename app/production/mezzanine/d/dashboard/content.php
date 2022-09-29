<?php
include 'koneksi.php';

if ($_GET['p'] == 'dash') {
    include "dashboard.php";
} elseif ($_GET['p'] == 'help') {
    include "_help/index.php";
} else {
    include "dashboard.php";
}
