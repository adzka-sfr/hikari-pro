<?php

if ($_GET['p'] == 'add') {
    include "employee/add/index.php";
} elseif ($_GET['p'] == 'edit') {
    include "employee/edit/index.php";
} else {
    include "dashboard/index.php";
}
