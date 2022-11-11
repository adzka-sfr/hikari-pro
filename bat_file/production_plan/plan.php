<?php
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-d-m H:i:s');
$username = "LA_ACTY";
$password = "SYSTEM";
$db = "(DESCRIPTION =(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.17.192.6)(PORT = 1521)))(CONNECT_DATA = (SERVICE_NAME = YIKSTAFF)))";

$connection = oci_connect($username, $password, $db);

if (!$connection) {
    $e = oci_error();
    echo htmlentities($e['message']);
    exit();
}

include 'koneksi_hikari.php';
// get last run 
$sql = mysqli_query($connect_pro, "SELECT last_run FROM production_lastrun_batch WHERE section = 'production_plan'");
$data = mysqli_fetch_array($sql);
$dt_maxtime = date('Y/m/d H:i:s', strtotime($data['last_run']));
$tgl_str = strtotime($dt_maxtime);
$dt_maxtime2 = date('Y/m/d H:i:s', strtotime('+2 days', $tgl_str));

$sql1 = "SELECT TO_CHAR(LA_ACTY.D0010.STARTDT, 'YYYY-MM-DD hh24:mi:ss') AS START_DT,
                 LA_ACTY.D0010.PLANDT AS PLAN_DT,
                 LA_ACTY.D0010.HMCD AS GMC,
                 LA_ACTY.D0010.MAKEPROCECD AS WORK_CENTER,
                 LA_ACTY.D0010.PLANQTY AS QTY,
                 LA_ACTY.D0010.INSTID AS INSTALL_ID,
                 LA_ACTY.D0010.INSTTERM AS INSTALL_TERM,
                 LA_ACTY.D0010.INSTPRGNM AS INSTALL_PROGRAM
                    FROM LA_ACTY.D0010 WHERE 
                        TO_CHAR(LA_ACTY.D0010.STARTDT,'YYYY/MM/DD hh24:mi:ss') > TO_CHAR(TO_DATE('$dt_maxtime','YYYY/MM/DD hh24:mi:ss'),'YYYY/MM/DD hh24:mi:ss') 
                        AND TO_CHAR(LA_ACTY.D0010.STARTDT,'YYYY/MM/DD hh24:mi:ss') < TO_CHAR(TO_DATE('$dt_maxtime2','YYYY/MM/DD hh24:mi:ss'),'YYYY/MM/DD hh24:mi:ss') 
                            ORDER BY LA_ACTY.D0010.STARTDT";

$statment = oci_parse($connection, $sql1);
oci_execute($statment);

while ($oracle = oci_fetch_array($statment)) {
    $update_last_run = $oracle['START_DT'];
    // plan date substring
    $plan_dt = $oracle['PLAN_DT'];
    $tahun = substr($plan_dt, 0, 4);
    $bulan = substr($plan_dt, 4, 2);
    $tanggal = substr($plan_dt, 6, 2);
    $plan_dt = $tahun . "-" . $bulan . "-" . $tanggal;
    $sql2 = mysqli_query($connect_pro, "INSERT INTO production_plan set 
                                                    startdt = '$oracle[START_DT]', 
                                                    plandt = '$plan_dt',
                                                    hmcd = '$oracle[GMC]',
                                                    makeprocecd = '$oracle[WORK_CENTER]',
                                                    planqty = $oracle[QTY],
                                                    instid = '$oracle[INSTALL_ID]',
                                                    instterm = '$oracle[INSTALL_TERM]',
                                                    instprgnm = '$oracle[INSTALL_PROGRAM]'
                                        ");
}

// update last run
if (empty($update_last_run)) {
    $update_last_run = date('Y/m/d H:i:s', strtotime('+1 days', $tgl_str));
}
mysqli_query($connect_pro, "UPDATE production_lastrun_batch set last_run = '$update_last_run' where section = 'production_plan'");

// log 
$ip = $_SERVER['REMOTE_ADDR'];
$computer_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$script = $_SERVER['SCRIPT_NAME'];
$host = $_SERVER['HTTP_HOST'];
$sql_log = mysqli_query($connect_log, "INSERT INTO batch_log set 
                                                            log_time = '$now',
                                                            system_name = 'Production Plan',
                                                            process_name = 'Batch',
                                                            query = 'insert',
                                                            employee_name = 'SYSTEM',
                                                            employee_id = 'SYSTEM',
                                                            computer_ip = '$ip',
                                                            computer_name = '$computer_name',
                                                            script_name = '$script',
                                                            host = '$host'");
