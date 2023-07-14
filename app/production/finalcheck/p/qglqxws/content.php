<?php
if ($_GET['page'] == 'onrp') {
    include "repairoutside/index.php";
} elseif ($_GET['page'] == 'help') {
    include "manual/index.php";
} else {
    include "repairoutside/index.php";
}
