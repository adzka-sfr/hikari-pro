<?php
session_start();
$_SESSION['model_piano'] = $_POST['model_piano'];

echo "<script>window.location='plan_cs.php';</script>";
