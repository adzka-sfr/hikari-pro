<?php

$status = $_POST['status'];

if ($status == "OK") {
    $jenis_ng = "nope";
}else{
    $jenis_ng = $_POST['jenis_ng'];
}

echo $status . "</br>" . $jenis_ng;
