<?php 

$con = mysqli_connect("localhost","root","","prod_info");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>