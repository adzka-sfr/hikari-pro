<?php
if ($_GET['page'] == 'dashboard-up') {
    include "dashboard/indexup.php"; // Packing UP
} elseif ($_GET['page'] == 'dashboard-gp') {
    include "dashboard/indexgp.php"; // Packing GP
} elseif ($_GET['page'] == 'st-bench') {
    include "stock/bench.php"; // Bench Stock
} elseif ($_GET['page'] == 'st-bench-stckup') {
    include "stock/bench_up/stock.php"; // Bench Stock > UP Stock
} elseif ($_GET['page'] == 'st-bench-tousedup') {
    include "stock/bench_up/toused.php"; // Bench Stock > UP Today Used
} elseif ($_GET['page'] == 'st-bench-alltimup') {
    include "stock/bench_up/alltim.php"; // Bench Stock > UP All Time Used
} elseif ($_GET['page'] == 'st-bench-stckgp') {
    include "stock/bench_gp/stock.php"; // Bench Stock > GP Stock
} elseif ($_GET['page'] == 'st-bench-tousedgp') {
    include "stock/bench_gp/toused.php"; // Bench Stock > GP Today Used
} elseif ($_GET['page'] == 'st-bench-alltimgp') {
    include "stock/bench_gp/alltim.php"; // Bench Stock > GP All Time Used
} elseif ($_GET['page'] == 'st-userp') {
    include "stock/userp.php"; // User Package Stock
} elseif ($_GET['page'] == 'st-userp-stckup') {
    include "stock/userp_up/stock.php"; // User Package > UP Stock
} elseif ($_GET['page'] == 'st-userp-tousedup') {
    include "stock/userp_up/toused.php"; // User Package > UP Today Used
} elseif ($_GET['page'] == 'st-userp-alltimup') {
    include "stock/userp_up/alltim.php"; // User Package > UP All Time Used
} elseif ($_GET['page'] == 'st-userp-stckgp') {
    include "stock/userp_gp/stock.php"; // User Package > GP Stock
} elseif ($_GET['page'] == 'st-userp-tousedgp') {
    include "stock/userp_gp/toused.php"; // User Package > GP Today Used
} elseif ($_GET['page'] == 'st-userp-alltimgp') {
    include "stock/userp_gp/alltim.php"; // User Package > GP All Time Used
} elseif ($_GET['page'] == 'st-userpac') {
    include "stock/userp.php"; // User Package Stock
} elseif ($_GET['page'] == 'adjust-bench') {
    include "stock/adjust_bench.php"; // Adjust bench
} elseif ($_GET['page'] == 'adjustlog-bench') {
    include "stock/log_adjustbench.php"; // Adjust bench
} elseif ($_GET['page'] == 'log-bench') {
    include "log/log_bench.php"; // Log bench
} elseif ($_GET['page'] == 'adjust-userp') {
    include "stock/adjust_userp.php"; // Adjust userp
} elseif ($_GET['page'] == 'adjustlog-userp') {
    include "stock/log_adjustuserp.php"; // Adjust user package
} elseif ($_GET['page'] == 'log-userp') {
    include "log/log_userp.php"; // Log bench
} elseif ($_GET['page'] == 'st-info-up') {
    include "log/up_area.php"; // UP Area
} elseif ($_GET['page'] == 'st-info-gp') {
    include "log/gp_area.php"; // GP Area
} elseif ($_GET['page'] == 'control') {
    include "function/index.php"; // Function Control 
} elseif ($_GET['page'] == 'emcon') {
    // include "email/index.php"; // Email Control 
    include "dashboard/indexup.php";
} elseif ($_GET['page'] == 'errlog') {
    include "errorlog/index.php"; // Error Log
} elseif ($_GET['page'] == 'respac') {
    include "respacc/index.php"; // Reset Packing
} elseif ($_GET['page'] == 'help') {
    include "manual/index.php"; // Help
} else {
    include "dashboard/indexup.php";
}
