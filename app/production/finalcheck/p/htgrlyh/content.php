<?php
if ($_GET['page'] == 'inrp') {
    include "repairinside/index.php";
} elseif ($_GET['page'] == 'help') {
    include "manual/index.php";
} else {
    include "repairinside/index.php";
}
