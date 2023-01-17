<?php
session_start();
$cardno =  $_POST['hasil'];

$_SESSION['cardnumber_outside2'] = $cardno;
