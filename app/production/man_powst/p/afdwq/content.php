<?php
if ($_GET['page'] == 'dash') {
    include "dashboard/index.php";
} elseif ($_GET['page'] == 'aust') {
    include "uploadst/index.php";
} elseif ($_GET['page'] == 'help') {
    include "_manual/index.php";
} else {
    include "dashboard/index.php";
}
