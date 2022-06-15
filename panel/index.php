<?php
require "../_config/koneksi.php";
if (isset($_SESSION['id'])) {
    echo "<script>window.location='" . base_url('dashboard') . "';</script>";
} else {
    echo "<script>window.location='" . base_url('auth') . "';</script>";
}
