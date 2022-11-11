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
$sql = mysqli_query($connect_pro, "SELECT last_run FROM production_lastrun_batch WHERE section = 'production_result'");
$data = mysqli_fetch_array($sql);
$dt_maxtime = $data['last_run'];

$sql1 = "SELECT TO_CHAR(LA_ACTY.D0040.INSTDT,'YYYY-MM-DD hh24:mi:ss')  AS RESULT_DATE,
                LA_ACTY.D0040.HMCD AS GMC,
                LA_ACTY.D0040.MAKEKTCD AS WORK_CENTER,
                LA_ACTY.D0040.ACTUALQTY AS QTY,
                LA_ACTY.D0040.INSTID AS INSTALL_ID,
                LA_ACTY.D0040.INSTTERM AS INSTALL_TERM,
                LA_ACTY.D0040.INSTPRGNM AS INSTALL_PROGRAM
                    FROM LA_ACTY.D0040 WHERE 
                        TO_CHAR(LA_ACTY.D0040.INSTDT,'YYYY/MM/DD hh24:mi:ss') > TO_CHAR(TO_DATE('$dt_maxtime','YYYY/MM/DD hh24:mi:ss'),'YYYY/MM/DD hh24:mi:ss') 
                            ORDER BY LA_ACTY.D0040.INSTDT";

$statment = oci_parse($connection, $sql1);
oci_execute($statment);

while ($oracle = oci_fetch_array($statment)) {
    $update_last_run = $oracle['RESULT_DATE'];
    $sql2 = mysqli_query($connect_pro, "INSERT INTO production_result set 
                                                    instdt = '$oracle[RESULT_DATE]', 
                                                    hmcd = '$oracle[GMC]',
                                                    makektcd = '$oracle[WORK_CENTER]',
                                                    actualqty = $oracle[QTY],
                                                    instid = '$oracle[INSTALL_ID]',
                                                    instterm = '$oracle[INSTALL_TERM]',
                                                    instprgnm = '$oracle[INSTALL_PROGRAM]'
                                        ");
}

// update last run
if (empty($update_last_run)) {
    $update_last_run = $dt_maxtime;
}
mysqli_query($connect_pro, "UPDATE production_lastrun_batch set last_run = '$update_last_run' where section = 'production_result'");

// log 
$ip = $_SERVER['REMOTE_ADDR'];
$computer_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$script = $_SERVER['SCRIPT_NAME'];
$host = $_SERVER['HTTP_HOST'];
$sql_log = mysqli_query($connect_log, "INSERT INTO batch_log set 
                                                            log_time = '$now',
                                                            system_name = 'Production Result',
                                                            process_name = 'Batch',
                                                            query = 'insert',
                                                            employee_name = 'SYSTEM',
                                                            employee_id = 'SYSTEM',
                                                            computer_ip = '$ip',
                                                            computer_name = '$computer_name',
                                                            script_name = '$script',
                                                            host = '$host'");
