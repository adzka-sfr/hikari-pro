<?php
include('../../../../../_config/koneksi.php');
if (isset($_SESSION['id'])) {
    if ($_SESSION['role'] == "managerial") {
        echo "<script>window.location='" . base_url('app/production/rsagp/p/dashboard/managerial/dashboard') . "';</script>";
    } elseif ($_SESSION['role'] == "pic") {
        echo "<script>window.location='" . base_url('app/production/rsagp/p/dashboard/staff/input_data/data.php') . "';</script>";
    }
} else {
    echo "<script>window.location='" . base_url('auth') . "';</script>";
}
