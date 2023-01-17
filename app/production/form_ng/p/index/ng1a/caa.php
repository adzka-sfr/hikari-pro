<?php
session_start();
$slip =  $_POST['hasil'];

$_SESSION['cardnumber_repair'] = $slip;
