<?php
if ($_GET['p'] == 'dash') {
    if (!empty($_SESSION['repair_id'])) {
        include "dashboard.php";
    } else {
        include "pic-repair.php";
    }
} elseif ($_GET['p'] == 'help') {
    include "_help/index.php";
}
