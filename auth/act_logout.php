<?php
require_once "../_config/koneksi.php";

session_destroy();
echo "<script>window.location='" . base_url('auth') . "';</script>";
