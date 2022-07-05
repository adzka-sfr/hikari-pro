<?php
require_once "../_config/koneksi.php";

unset($_SESSION['id']);
unset($_SESSION['search_tanggal']);
session_destroy();
echo "<script>window.location='" . base_url('index.php') . "';</script>";
