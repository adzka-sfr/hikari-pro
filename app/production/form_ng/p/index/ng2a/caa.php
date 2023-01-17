<?php
session_start();
$cardno =  $_POST['hasil'];

$_SESSION['cardnumber_repairo1'] = $cardno;
