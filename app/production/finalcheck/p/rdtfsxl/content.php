<?php
if ($_GET['page'] == 'mnar') {
    include "management/a_ratio/index.php";
} elseif ($_GET['page'] == 'mnbp') {
    include "management/b_process/index.php";
} elseif ($_GET['page'] == 'mncn') {
    include "management/c_ngtrend/index.php";
} elseif ($_GET['page'] == 'mnds') {
    include "management/d_summaryng/index.php";
} elseif ($_GET['page'] == 'mnep') {
    include "management/e_picprev/index.php";
} elseif ($_GET['page'] == 'mnfd') {
    include "management/f_datang/index.php";
} elseif ($_GET['page'] == 'mngd') {
    include "management/g_datacabinet/index.php";
} elseif ($_GET['page'] == 'mnhd') {
    include "management/h_datainside/index.php";
} elseif ($_GET['page'] == 'mnid') {
    include "management/i_datacompleteness/index.php";
} elseif ($_GET['page'] == 'mnjd') {
    include "management/j_datapiano/index.php";
} elseif ($_GET['page'] == 'mnkr') {
    include "management/k_reset/index.php";
} elseif ($_GET['page'] == 'mnle') {
    include "management/l_export/index.php";
} elseif ($_GET['page'] == 'help') {
    include "manual/index.php";
} else {
    include "management/a_ratio/index.php";
}
