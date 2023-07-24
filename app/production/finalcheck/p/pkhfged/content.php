<?php
if ($_GET['page'] == 'oach') {
    include "outside3/index.php";
} elseif ($_GET['page'] == 'help') {
    include "manual/index.php";
} else {
    include "outside1/index.php";
}
