<?php
require_once "../_config/koneksi.php";

unset($_SESSION['id']);
echo "<script>window.location='" . base_url('auth') . "';</script>";
