<?php
include_once '../../../../_config/koneksi.php';
include 'app_name.php';
// ubah c_dir sesuai dengan nama folder
$cek_prev = mysqli_query($connect, "SELECT * from t_previlege where c_dir = '$app_dir'");
$row_prev = mysqli_fetch_row($cek_prev);
if (empty($row_prev)) {
    $cek = mysqli_query($connect, "SELECT c_status, c_name, c_dir, c_manual from t_app where c_dir = '$app_dir'");
    $data = mysqli_fetch_array($cek);

    if ($data['c_status'] == 'develop') {
        $_SESSION['app_error'] = $data['c_name'];
        echo "<script>window.location='" . base_url('_error') . "';</script>";
    } elseif ($data['c_status'] == 'deploy') {
        $_SESSION['manual'] = $data['c_manual'];
        echo "<script>window.location='" . base_url('app/production/' . $data['c_dir'] . '/dashboard') . "';</script>";
    }
} else {
    $cek = mysqli_query($connect, "SELECT c_status, c_name, c_dir from t_previlege where c_dir = '$app_dir' and c_id = '$_SESSION[id]'");
    $data = mysqli_fetch_array($cek);

    if ($data['c_status'] == 'develop') {
        $_SESSION['app_error'] = $data['c_name'];
        echo "<script>window.location='" . base_url('_error') . "';</script>";
    } elseif ($data['c_status'] == 'deploy') {
        echo "<script>window.location='" . base_url('app/production/' . $data['c_dir'] . '/dashboard') . "';</script>";
    }
}
