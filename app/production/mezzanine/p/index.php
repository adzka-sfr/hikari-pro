<?php
include_once '../../../../_config/koneksi.php';
include 'app_name.php';
// ubah c_dir sesuai dengan nama folder
$cek_prev = mysqli_query($connect, "SELECT * from t_previlege where c_dir = '$app_dir'");
$row_prev = mysqli_fetch_row($cek_prev);
if (empty($row_prev)) {
    // jika aplikasi biasa
    $cek = mysqli_query($connect, "SELECT c_status, c_name, c_dir from t_app where c_dir = '$app_dir'");
    $data = mysqli_fetch_array($cek);

    if ($data['c_status'] == 'develop') {
        $_SESSION['app_error'] = $data['c_name'];
        echo "<script>window.location='" . base_url('_error') . "';</script>";
    } elseif ($data['c_status'] == 'deploy') {
        echo "<script>window.location='" . base_url('app/production/' . $data['c_dir'] . '/dashboard') . "';</script>";
    }
} else {
    // jika aplikasi yang menggunakan previlege
    $cek = mysqli_query($connect, "SELECT c_status, c_name, c_dir from t_previlege where c_dir = '$app_dir' and c_id = '$_SESSION[id]'");
    $data = mysqli_fetch_array($cek);

    if ($data['c_status'] == 'develop') {
        $_SESSION['app_error'] = $data['c_name'];
        echo "<script>window.location='" . base_url('_error') . "';</script>";
    } elseif ($data['c_status'] == 'deploy') {
        if ($_SESSION['role'] == 'managerial' and $_SESSION['dept'] == 'Assembly UP') {
            echo "<script>window.location='" . base_url('app/' . $data['c_dir'] . '/index') . "';</script>";
        } elseif ($_SESSION['role'] == 'managerial' and $_SESSION['dept'] == 'Painting') {
            echo "<script>window.location='" . base_url('app/' . $data['c_dir'] . '/dashboard/painting/dashboard') . "';</script>";
        } else {
            // jika role dan departemen tidak sesuai namun masih ada pada tabel pevilege
            echo "<script>window.location='../';</script>";
        }
    }
}
