<?php
if ($_GET['page'] == 'print') {
    include "print/index.php";
} elseif ($_GET['page'] == 'help') {
    include "manual/index.php";
} else {
    include "print/index.php";
}
