<?php
if ($_GET['p'] == 'dash') {
    include "dashboard.php";
} elseif ($_GET['p'] == 'data') {
    include "data.php";
} elseif ($_GET['p'] == 'data2') {
    include "data2.php";
} elseif ($_GET['p'] == 'pdf') {
    include "exportpdf.php";
} elseif ($_GET['p'] == 'wkejfgheukj') {
    include "exportpdfgod.php";
} elseif ($_GET['p'] == 'leigjwiroeh') {
    include "exportpdfgos.php";
} elseif ($_GET['p'] == 'picp') {
    include "picp/index.php";
} elseif ($_GET['p'] == 'ng') {
    include "customize-ng/index.php";
} elseif ($_GET['p'] == 'cab') {
    include "customize-cab/index.php";
} elseif ($_GET['p'] == 'ip') {
    include "customize-ip/index.php";
} elseif ($_GET['p'] == 'cp') {
    include "customize-cp/index.php";
} elseif ($_GET['p'] == 'ap') {
    include "customize-ap/index.php";
} elseif ($_GET['p'] == 'ip') {
    include "customize-ip/index.php";
} elseif ($_GET['p'] == 'ngtrend') {
    include "dashboard-ngtrend/index.php";
} elseif ($_GET['p'] == 'proc') {
    include "dashboard-process/index.php";
}
