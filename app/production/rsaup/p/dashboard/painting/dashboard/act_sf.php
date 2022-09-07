<?php
include '../../_config/pro_koneksi.php';

$model = $_POST['model_piano'];
$sf = $_POST['sf'];

$sql = mysqli_query($conn, "UPDATE piano_bd set safety_stock = $sf where nama_piano = '$model'");
$sql2 = mysqli_query($conn, "UPDATE ratio_set set safety_stock = $sf where nama_piano = '$model'");

header('Location: dashboard.php');