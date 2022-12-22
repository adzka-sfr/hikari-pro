<?php
include 'koneksi.php';

if ($_GET['p'] == 'assy') {
    include "assy.php";
} elseif ($_GET['p'] == 'paint') {
    include "painting1.php";
} elseif ($_GET['p'] == 'paint1') {
    include "painting.php";
} elseif ($_GET['p'] == 'ww') {
    include "woodworking1.php";
} elseif ($_GET['p'] == 'ww1') {
    include "woodworking.php";
} elseif ($_GET['p'] == 'help') {
    include "_help/index.php";
} else {
    include "dashboard.php";
}
