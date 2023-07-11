<?php
if ($_GET['page'] == 'inch') {
    include "insidecheck/index.php";
} elseif ($_GET['page'] == 'help') {
    include "manual/index.php";
} else {
    include "insidecheck/index.php";
}
