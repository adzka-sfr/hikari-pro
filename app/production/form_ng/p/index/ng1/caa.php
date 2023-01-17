<?php
session_start();
$slip =  $_POST['hasil'];

$_SESSION['cardnumber'] = $slip;
