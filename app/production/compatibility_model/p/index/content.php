<?php
include 'koneksi.php';

if ($_GET['p'] == 'dash') {
    include "dashboard/dashboard.php";
} elseif ($_GET['p'] == 'help') {
    include "update_plan/index.php";
} else {
    include "dashboard/dashboard.php";
}
