<?php
require_once "../_config/koneksi.php";

// log activity
$token = $_SESSION['token'];
$l_t = $now;
$sy_n = "Hikari";
$p_n = "Logout";
$q = "select";
$e_n = $_SESSION['nama'];
$e_i = $_SESSION['id'];
$c_i = $_SERVER['REMOTE_ADDR'];
$c_n = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$s_n = $_SERVER['SCRIPT_NAME'];
$h = $_SERVER['HTTP_HOST'];
mysqli_query($connect_log, "INSERT INTO activity_log set
                                    token = '$token',
                                    log_time = '$l_t',
                                    system_name = '$sy_n',
                                    process_name = '$p_n',
                                    query = '$q',
                                    employee_name = '$e_n',
                                    employee_id = '$e_i',
                                    computer_ip = '$c_i',
                                    computer_name = '$c_n',
                                    script_name = '$s_n',
                                    host = '$h'");

session_destroy();
echo "<script>window.location='" . base_url('auth') . "';</script>";
