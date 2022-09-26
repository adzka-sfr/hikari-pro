<?php
session_start();
$asu =  $_POST['hasil'];

$_SESSION['no_slip'] = $asu;
