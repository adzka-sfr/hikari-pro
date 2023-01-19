<?php
require '../_config/koneksi.php';

$id = $_POST['id'];
$pass = $_POST['pass'];

//query
$query  = "SELECT * FROM auth WHERE id='$id' AND pass='$pass'";
$result     = mysqli_query($connect, $query);
$row   = mysqli_fetch_array($result);

if (!empty($row)) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['pass'] = $row['pass'];
    $_SESSION['role'] = strtolower($row['role']);
    $_SESSION['dept'] = $row['dept'];
    $_SESSION['jabatan'] = $row['jabatan'];

    // log create token
    $tok_date = strtotime(date('YmdHis'));
    $_SESSION['token'] = bin2hex(random_bytes(10) . $tok_date);
    echo "oke";

    // log activity record  
    $token = $_SESSION['token'];
    $l_t = $now;
    $sy_n = "Hikari";
    $p_n = "Login";
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
} else {
    echo "error";
}
