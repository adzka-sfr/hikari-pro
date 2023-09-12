<?php
if ($_GET['page'] == 'register') {
    include "register/index.php";
} elseif ($_GET['page'] == 'staking') {
    include "staking/index.php";
} elseif ($_GET['page'] == 'resultst') {
    include "staking/result_staking.php";
} elseif ($_GET['page'] == 'packing') {
    include "packing/index.php";
} elseif ($_GET['page'] == 'packing2') {
    include "packing/index2.php";
} elseif ($_GET['page'] == 'history') {
    include "history/index.php";
} elseif ($_GET['page'] == 'help') {
    include "manual/index.php";
} elseif ($_GET['page'] == 'print') {
    include "print/index.php";
} else {
    include "print/index.php";
}
