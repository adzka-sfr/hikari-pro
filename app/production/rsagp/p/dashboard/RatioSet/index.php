<?php
require "_config/koneksi.php";
if (isset($_SESSION['nama'])) {
    if ($_SESSION['role'] == "managerial") {
        echo "<script>window.location='" . base_url('managerial/dashboard') . "';</script>";
    } elseif ($_SESSION['role'] == "staff") {
        echo "<script>window.location='" . base_url('staff/input_data/data.php') . "';</script>";
    } elseif ($_SESSION['role'] == "superadmin") {
        echo "<script>window.location='" . base_url('dashboard') . "';</script>";
    }
} else {
    echo "<script>window.location='" . base_url('auth') . "';</script>";
}
