<?php
$con_prodinfo = mysqli_connect("localhost","root","","prod_info") ;

if (!$con_prodinfo)
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>