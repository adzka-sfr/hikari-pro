<?php
$conn = mysqli_connect("localhost","root","","prod_info") ;

if (!$conn)
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>